<?php include('partials/menu.php'); ?>

    <!-- Awal Konten -->
    <div class="konten">
      <div class="container mt-3 p-5">
        <h1 class="h2">Selamat Datang di Dashboard, Admin!</h1>
        <?php 
          if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
          }
        ?>
        <div class="row mt-4">
          <div class="col-sm-3 mb-2">
            <div class="card border-primary shadow py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php
                          $sql = "SELECT * FROM tbl_kategori";
                          $res = mysqli_query($conn, $sql);
                          $count = mysqli_num_rows($res);

                        ?>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-0">Kategori</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>  
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-folder fa-2x"></i>
                    </div>
                </div>
              </div>
            </div>
        </div>

        <div class="col-sm-3 mb-2">
          <div class="card border-info shadow py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <?php
                        $sql2 = "SELECT * FROM tbl_produk";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);

                      ?>
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-0">Produk</div>
                      <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo $count2; ?></div>  
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-list-ul fa-2x"></i>
                    </div>
                </div>
              </div>
          </div>
        </div>

        <div class="col-sm-3 mb-2">
          <div class="card border-success shadow py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php
                          $sql3 = "SELECT * FROM tbl_order";
                          $res3 = mysqli_query($conn, $sql3);
                          $count3 = mysqli_num_rows($res3);
                        ?>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-0">Pesanan</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800"><?php echo $count3; ?></div>  
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-cart-arrow-down fa-2x"></i>
                    </div>
                </div>
              </div>
          </div>
        </div>

        <div class="col-sm-3 mb-2">
          <div class="card border-success shadow py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php
                          $sql4 = "SELECT SUM(total_pembelian) AS Total FROM tbl_order WHERE status='Produk Lunas dan dikirim'";
                          $res4 = mysqli_query($conn, $sql4);
                          $row4 = mysqli_fetch_assoc($res4);
                          $total_revenue = $row4['Total'];
                        ?>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-0">Penghasilan</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">Rp. <?php echo number_format($total_revenue,0,',','.'); ?></div>  
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-wallet fa-2x"></i>
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    <!-- Akhir Konten -->

<?php include('partials/footer.php'); ?>