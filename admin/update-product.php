<?php include('partials/menu.php')?>

<?php 
  if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM tbl_produk WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($res);

    $namaProduk = $row['namaProduk'];
    $harga = $row['harga'];
    $current_image = $row['namaGambar'];
    $deskripsi = $row['deskripsi'];
    $current_category = $row['kategori_id'];
    $featured = $row['featured'];
    $active = $row['active'];
    $satuan = $row['satuan'];
    $stok = $row['stok'];
  } else {
    header('location:'.SITEURL.'admin/manage-product.php');
  }
?>

<div class="container mt-3 p-5">
  <h2 class="my-2">Form Update Produk</h2>
  <br>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="table-responsive mb-4">
      <table class="table table-borderless table-sm">
        <tr>
          <td>Masukkan Nama Produk: </td>
          <td>
            <input type="text" name="namaProduk" value="<?php echo $namaProduk;?>">
          </td>
        </tr>
        <tr>
          <td>Masukkan harga Produk: </td>
          <td>
            <input type="number" name="harga" value="<?php echo $harga;?>">
          </td>
        </tr>
        <tr>
          <td>Gambar Terbaru: </td>
          <td>
            <?php
              if($current_image == ""){
                echo "<div class='text-muted'>Gambar Tidak Tersedia</div>";
              } else {
                ?>
                <img src="<?php echo SITEURL;?>images/product/<?php echo $current_image; ?>" alt="<?php echo $namaProduk;?>" width="150px">
                <?php
              }
            ?>
          </td>
        </tr>
        <tr>
          <td>Pilih Gambar Baru: </td>
          <td>
            <input type="file" name="namaGambar">
          </td>
        </tr>
        <tr>
          <td>Masukkan Deskripsi: </td>
          <td>
            <textarea name="deskripsi" cols="30" rows="5"><?php echo $deskripsi; ?></textarea>
          </td>
        </tr>
        <tr>
          <td>Masukkan Kategori: </td>
          <td>
            <select name="kategori">
              <?php 
                $sql2 = "SELECT * FROM tbl_kategori WHERE active='Yes'";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2 > 0){
                  while($row2 = mysqli_fetch_assoc($res2)){
                    $namaKategori = $row2['namaKategori'];
                    $kategori_id = $row2['id'];
                    ?>
                    <option <?php if($current_category == $kategori_id){echo "selected";}?> value="<?php echo $kategori_id; ?>"><?php echo $namaKategori; ?></option>
                    <?php
                  }
                } else {
                  echo "<option value='0'>Kategori tidak ditemukan.</option>";
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Featured: </td>
          <td>
            <input type="radio" <?php if($featured == "Yes"){echo "checked"; }?> name="featured" value="Yes">Yes
            <input type="radio" <?php if($featured == "No"){echo "checked"; }?> name="featured" value="No">No
          </td>
        </tr>
        <tr>
          <td>Active: </td>
          <td>
            <input type="radio" <?php if($active == "Yes"){echo "checked"; }?> name="active" value="Yes">Yes
            <input type="radio" <?php if($active == "No"){echo "checked"; }?> name="active" value="No">No
          </td>
        </tr>
        <tr>
          <td>Satuan: </td>
          <td>
            <input type="text" name="satuan" value="<?php echo $satuan; ?>">
          </td>
        </tr>
        <tr>
          <td>Stok: </td>
          <td>
            <input type="number" name="stok" value="<?php echo $stok; ?>">
          </td>
        </tr>
        <tr>
          <td>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="submit" name="submit" value="Update Produk" class="btn btn-primary">
          </td>
        </tr>
      </table>
    </div>
  </form>

  <?php 
    if(isset($_POST['submit'])){
      $id = $_POST['id'];
      $namaProduk = $_POST['namaProduk'];
      $harga = $_POST['harga'];
      $current_image = $_POST['current_image'];
      $deskripsi = $_POST['deskripsi'];
      $kategori = $_POST['kategori'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];
      $satuan = $_POST['satuan'];
      $stok = $_POST['stok'];

      if(isset($_FILES['namaGambar']['name'])){
              $namaGambar = $_FILES['namaGambar']['name'];

              if($namaGambar != ""){
                $tmp = explode('.', $namaGambar);
                $ext = end($tmp);

                $namaGambar = "Produk_".rand(0000,9999).'.'.$ext;

                $source_path = $_FILES['namaGambar']['tmp_name'];
                $destination_path = "../images/product/".$namaGambar;

                $upload = move_uploaded_file($source_path, $destination_path);

                if($upload == FALSE) {
                  $_SESSION['upload'] = "<div class='alert alert-error' role='alert'>
                  Gagal Mengupload Gambar!
                  </div>";
                  header("location:".SITEURL.'admin/manage-product.php');
                  die();
                }

                if($current_image != ""){
                  $remove_path = "../images/product/".$current_image;
                  $remove = unlink($remove_path);

                  if($remove == FALSE){
                    $_SESSION['failed-remove'] = "<div class='alert alert-error' role='alert'>
                    Gagal Menghapus Gambar!
                    </div>";
                    header("location:".SITEURL.'admin/manage-product.php');
                    die();
                  }
                }
                
              } else {
                $namaGambar = $current_image;
              }
            } else {
              $namaGambar = $current_image;
            }

      $sql3 = "UPDATE tbl_produk SET
        namaProduk = '$namaProduk',
        harga = $harga,
        namaGambar = '$namaGambar',
        deskripsi = '$deskripsi',
        kategori_id = '$kategori',
        featured = '$featured',
        active = '$active',
        satuan = '$satuan',
        stok = '$stok'
        WHERE id=$id
      ";

      $res3 = mysqli_query($conn, $sql3);

      if($res3 == TRUE ){
        $_SESSION['update'] = "<div class='alert alert-success'>Berhasil Mengupdate Produk.</div>";
        header('location:'.SITEURL.'admin/manage-product.php');
      } else {
        $_SESSION['update'] = "<div class='alert alert-danger'>Gagal Mengupdate Produk.</div>";
        header('location:'.SITEURL.'admin/manage-product.php');
      }
    }
  
  ?>
</div>

<?php include('partials/footer.php')?>