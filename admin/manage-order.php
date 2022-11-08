<?php include('partials/menu.php'); ?>

  <!-- Awal Konten -->
    <div class="konten">
      <div class="container mt-3 p-5">
        <h1 class="h2 mb-3">Pengaturan Pesanan</h1>
        <div class="table-responsive mb-4">
          <table class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Pelanggan</th>
                  <th scope="col">Tanggal Pembelian</th>
                  <th scope="col">Status Pembelian</th>
                  <th scope="col">Total Pembelian</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $nomor=1; ?>
                <?php $ambil=$conn->query("SELECT * FROM tbl_order"); ?>
                <?php while($pecah=$ambil->fetch_assoc()){ ?>
                <tr>
                  <td><?php echo $nomor ?></td>
                  <td><?php echo $pecah['nama_pelanggan']; ?></td>
                  <td><?php echo $pecah['tanggal_pembelian']; ?></td>
                  <td><?php echo $pecah['status']; ?></td>
                  <td>Rp. <?php echo number_format($pecah['total_pembelian'],0,',','.'); ?></td>
                  <td>
                    <a href="<?php echo SITEURL; ?>admin/detail-pembelian.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info mb-3">Detail</a>

                    <?php if ($pecah['status']=="Pesan Masuk, belum dikonfirmasi"): ?>
                      <a href="<?php echo SITEURL; ?>admin/konfirmasi-pembayaran.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-success">Pembayaran</a>
                    <?php endif ?>
                  </td>
                </tr>
                <?php $nomor++ ?>
                <?php } ?>
              </tbody>
            </table>
      </div>
    </div>
    <!-- Akhir Konten -->

<?php include('partials/footer.php'); ?>