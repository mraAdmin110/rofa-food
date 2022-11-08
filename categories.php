<?php include('partials-front/menu.php'); ?>

<section class="kategori">
  <div class="container">
    <h2 class="text-center my-3">Kategori Menu Makan</h2>
    <div class="row row-cols-1 row-cols-md-4">
      <?php
          $sql = "SELECT * FROM tbl_kategori WHERE active='Yes'";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          if ($count > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                  $id = $row['id'];
                  $namaKategori = $row['namaKategori'];
                  $namaGambar = $row['namaGambar'];

        ?>
        <a href="<?php echo SITEURL; ?>categories-product.php?kategori_id=<?php echo $id; ?>">
          <div class="col mb-4">
            <div class="card h-100">
              <?php
                if ($namaGambar == "") {
                  echo "<div class='text-muted'>Tidak ada gambar</div>";
                } else {
              ?>
                <img src="<?php echo SITEURL; ?>images/category/<?php echo  $namaGambar; ?>" class="card-img-top" alt="<?php echo  $namaGambar; ?>">
              <?php
                }
              ?>
              <div class="card-body">
                <h5 class="card-title text-center text-dark"><?php echo $namaKategori; ?></h5>
              </div>
            </div>
          </div>
        </a>
        <?php
              }
            }else{
              echo "<div class='text-muted'>Kategori tidak ditemukan</div>";
            }
        ?>
    </div>
  </div>
</section>

<?php include('partials-front/footer.php'); ?>