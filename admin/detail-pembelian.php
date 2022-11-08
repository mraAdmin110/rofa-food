<?php include('partials/menu.php'); ?>

  <!-- Awal Konten -->
    <div class="konten">
      <div class="container mt-2 p-4">
        <h1 class="h2 mb-3">Detail Pembelian</h1>
        <?php 
          $ambil = $conn->query("SELECT * FROM tbl_order WHERE id_pembelian='$_GET[id]'"); 
          $detail=$ambil->fetch_assoc();
        ?>
        <!-- <pre><?php print_r($detail); ?></pre>  -->

        <div class="row">
          <div class="col-md-4">
            <h3 class="h4">Pembelian</h3>
            <p>
              Tanggal : <?php  echo $detail['tanggal_pembelian'] ?><br>
              Total : Rp. <?php  echo number_format($detail['total_pembelian'],0,',','.') ?> <br>
              Status : <?php echo $detail['status'] ?><br>
            </p>
          </div>
          <div class="col-md-4">
            <h3 class="h4">Pelanggan</h3>
            <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
            <p>
              <?php echo $detail['no_telp_pelanggan']; ?><br>
              <?php echo $detail['email_pelanggan']; ?><br>
              <?php echo $detail['alamat_pelanggan']; ?>
            </p>
          </div>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php $nomor=1; ?>
            <?php $ambil=$conn->query("SELECT * FROM tbl_order_produk JOIN tbl_produk ON tbl_order_produk.id_produk=tbl_produk.id WHERE tbl_order_produk.id_pembelian='$_GET[id]'"); ?>
            <?php while($pecah=$ambil->fetch_assoc()){ ?>
            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo $pecah['namaProduk']; ?></td>
              <td>Rp. <?php echo number_format($pecah['harga'],0,',','.'); ?></td>
              <td><?php echo $pecah['jumlah']; ?></td>
              <td>
                Rp. <?php echo number_format($pecah['harga']*$pecah['jumlah'],0,',','.'); ?>
              </td>			
            </tr>
            <?php $nomor++; ?>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Akhir Konten -->

<?php include('partials/footer.php'); ?>