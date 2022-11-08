<?php include('partials/menu.php'); ?>

  <!-- Awal Konten -->
    <div class="konten">
      <div class="container mt-2 p-4">
        <h1 class="h2 mb-3">Konfirmasi Pembayaran</h1>
        <?php 
          $id_pembelian=$_GET['id'];
        ?>
        <form method="post">  
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status">
              <option value="">Pilih Status</option>
              <option value="Produk Lunas dan dikirim">Produk Lunas dan dikirim</option>
              <option value="batal">Batal</option>
            </select>
          </div>
          <button class="btn btn-primary" name="konfirmasi">Konfirmasi</button>
        </form>

        <?php 
          if (isset($_POST["konfirmasi"])) 
          {
            $status=$_POST['status'];
            $conn->query("UPDATE tbl_order SET status='$status' WHERE id_pembelian='$id_pembelian'");
            echo "<script>alert('data pembelian terupdate')</script>";
            echo "<script>location='manage-order.php';</script>";
          }
        ?>
      </div>
    </div>
    <!-- Akhir Konten -->

<?php include('partials/footer.php'); ?>