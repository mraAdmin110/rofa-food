<?php include('partials/menu.php'); ?>

  <!-- Awal Konten -->
  <div class="container mt-3 p-5">
    <h1 class="h2 mb-3">Form Tambah Product</h1>
    <?php 
      if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
      }

      if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
      }
    ?>
    
    <form action="" method="POST" enctype="multipart/form-data">

      <div class="table-responsive mb-4">
        <table class="table table-borderless table-sm">
                <tr>
                    <td>Masukkan Nama Produk: </td>
                    <td>
                        <input type="text" name="namaProduk" placeholder="Masukkan Produk">
                    </td>
                </tr>

                <tr>
                    <td>Masukkan Harga Produk: </td>
                    <td>
                        <input type="number" name="harga" placeholder="Masukkan Harga">
                    </td>
                </tr>
            
                <tr>
                    <td>Masukkan Gambar: </td>
                    <td>
                        <input type="file" name="namaGambar">
                    </td>
                </tr>

                <tr>
                    <td>Masukkan Deskripsi Produk: </td>
                    <td>
                        <textarea name="deskripsi" cols="30" rows="5" placeholder="Deskripsi Produk"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Kategori: </td>
                    <td>
                        <select name="kategori">
                          <?php 
                            $sql = "SELECT * FROM tbl_kategori WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if($count > 0){
                              while ($row = mysqli_fetch_assoc($res)) {
                                $id = $row['id'];
                                $namaKategori = $row['namaKategori'];
                              
                                ?>
                                  <option value="<?php echo $id; ?>"><?php echo $namaKategori; ?></option>
                                <?php
                              }
                            } else {
                              ?>
                              <option value="0">Tidak ada Kategori</option> 
                              <?php
                            }
                          ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes

                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Satuan: </td>
                    <td>
                        <input type="text" name="satuan" placeholder="Masukkan Satuan">
                    </td>
                </tr>

                <tr>
                    <td>Stok: </td>
                    <td>
                        <input type="number" name="stok" placeholder="Masukkan Stok">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Simpan" class="btn btn-primary mt-2">
                    </td>
                </tr>      

        </table>
      </div>
    </form>

    <?php 
      if(isset($_POST['submit'])){
        
        $namaProduk = $_POST['namaProduk'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $kategori = $_POST['kategori'];
        $satuan = $_POST['satuan'];
        $stok = $_POST['stok'];

        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        } else {
          $featured = "No";
        }

        if(isset($_POST['active'])){
          $active = $_POST['active'];
        } else {
          $active = "No";
        }

        if(isset($_FILES['namaGambar']['name'])){
          $namaGambar = $_FILES['namaGambar']['name'];
            
          if($namaGambar != "") {
            $tmp = explode('.', $namaGambar);
            $ext = end($tmp);

            $namaGambar = "Produk_".rand(000,999).'.'.$ext;

            $source_path = $_FILES['namaGambar']['tmp_name'];
            $destination_path = "../images/product/".$namaGambar;

            $upload = move_uploaded_file($source_path, $destination_path);

            if($upload == FALSE) {
              $_SESSION['upload'] = "<div class='alert alert-error' role='alert'>
                Gagal Mengupload Gambar!
              </div>";
              header("location:".SITEURL.'admin/add-product.php');
              die();
            }
          }
        } else {
          $namaGambar = "";
        }

        $sql2 = "INSERT INTO tbl_produk SET
          namaProduk = '$namaProduk',
          harga = $harga,
          namaGambar = '$namaGambar',
          deskripsi = '$deskripsi',
          kategori_id = '$kategori',
          featured = '$featured',
          active = '$active',
          satuan = '$satuan',
          stok = $stok
        ";

        $res2 = mysqli_query($conn, $sql2);

        if($res2 == TRUE) {
            $_SESSION['add'] = "<div class='alert alert-success' role='alert'>
            Berhasil Menambah Produk!
            </div>";
            header("location:".SITEURL.'admin/manage-product.php');
        } else {
            $_SESSION['add'] = "<div class='alert alert-danger' role='alert'>
            Gagal Menambah Produk!
            </div>";
            header("location:".SITEURL.'admin/add-product.php');
        }
      }
    ?>

  </div>
  <!-- Akhir Konten -->

<?php include('partials/footer.php'); ?>