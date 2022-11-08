<?php include('partials-front/menu.php'); ?>

<section class="produk-search">
  <div class="container">
    <?php
      $search = $_POST['search'];
    ?>
    <h2>Hasil Pencarian <a href="#" class="text-dark">"<?php echo $search; ?>"</a></h2>
  </div>
</section>

<section id="produk" class="produk">
  <div class="container mb-4">
    <h3 class="text-center mb-3">Daftar Produk</h3>
    <div class="row row-cols-1 row-cols-md-4">
      <?php
        $sql2 = "SELECT * FROM tbl_produk WHERE namaProduk LIKE '%$search%' OR deskripsi LIKE '%$search%'";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        if ($count2 > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $namaProduk = $row2['namaProduk'];
                $harga = $row2['harga'];
                $namaGambar = $row2['namaGambar'];
                $deskripsi = $row2['deskripsi'];
                $stok = $row2['stok'];
        ?>
      
      <div class="col mb-4">
        <div class="card h-100">
          <?php
              if ($namaGambar == "") {
                echo "<div class='text-muted'>Gambar Tidak Tersedia</div>";
              } else {
          ?>
          <img src="<?php echo SITEURL; ?>images/product/<?php echo $namaGambar; ?>" class="card-img-top" alt="<?php echo $namaGambar; ?>">
          <?php
            }
          ?>
          <div class="card-body">
            <h5 class="card-title"><?php echo $namaProduk; ?></h5>
            <p class="card-text text-muted">Rp. <?php echo number_format($harga,0,',','.'); ?></p>
            <p class="card-text"><?php echo $deskripsi; ?></p>
            <p class="card-text text-muted">Stok Tersedia <?php echo $stok; ?></p>
          </div>
          <div class="card-footer">
            <a href="<?php echo SITEURL; ?>beli.php?id=<?php echo $id; ?>" class="btn btn-outline-success text-success">Keranjang</a>
          </div>
        </div>
      </div>
        <?php
            }
        } else {
            echo "<div class='text-muted'>Produk Tidak Tersedia</div>";
        }
        ?>
    </div>
  </div>
</section>

<?php include('partials-front/footer.php'); ?>