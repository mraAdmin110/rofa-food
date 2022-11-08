<?php include('partials-front/menu.php'); ?>
<?php
  if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
  {
    echo "<script>alert('Keranjang kosong,silahkan belanja');</script>";
    echo "<script>location='index.php';</script>";
  }
?>
<div class="keranjang">
  <div class="container">
    <h3>Keranjang</h3>

    <div class="table-responsive">
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Sub Harga</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php foreach($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
					<!--menampilkan produk yang diperulangkan berdasarkan id-->
					<?php 
            $ambil=$conn->query("SELECT * FROM tbl_produk 
              WHERE id='$id_produk'");
            $pecah=$ambil->fetch_assoc();
            $subharga=$pecah["harga"]*$jumlah;
					?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah["namaProduk"]; ?></td>
            <td>Rp. <?php echo number_format($pecah["harga"],0,',','.'); ?></td>
            <td><?php echo $jumlah; ?></td>
            <td>Rp. <?php echo number_format($subharga,0,',','.'); ?></td>
            <td>
              <a href="hapus-keranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
            </td>
          </tr>
				<?php $nomor++; ?>
				<?php endforeach ?>
        </tbody>
      </table>
      <div>
        <a href="categories-product.php" class="btn btn-outline-secondary">Lanjutkan Belanja</a>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
      </div>
    </div>
  </div>
</div>

<?php include('partials-front/footer.php'); ?>