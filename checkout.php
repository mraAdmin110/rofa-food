<?php include('partials-front/menu.php'); ?>

<div class="checkout">
  <div class="container">
    <h3>Checkout</h3>
    <div class="table-responsive">
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Sub Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php $totalbelanja=0; ?>
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
            <td>
              <?php echo $pecah["namaProduk"]; ?>
            </td>
            <td>Rp. 
              <?php echo number_format($pecah["harga"],0,',','.'); ?>
            </td>
            <td>
              <?php echo $jumlah; ?>
            </td>
            <td>Rp. <?php echo number_format($subharga,0,',','.'); ?></td>
          </tr>
				<?php $nomor++; ?>
        <?php $totalbelanja+=$subharga; ?>
				<?php endforeach ?>
        </tbody>
        <tfoot>
				<tr>
					<th colspan="4">Total Belanja</th>
					<th>Rp. <?php echo number_format($totalbelanja,0,',','.'); ?></th>
				</tr>
			</tfoot>
      </table>
    </div>
    <hr>
    <h3>Data Pelanggan</h3>
    <form action="" method="POST">
      <div class="form-group row">
        <label for="inputName3" class="col-sm-2 col-form-label">Nama Lengkap</label>
        <div class="col-sm-10">
          <input type="text" name="nama_pelanggan" class="form-control" id="inputName3" placeholder="Masukkan Nama" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Telepon</label>
        <div class="col-sm-10">
          <input type="tel" name="no_telp_pelanggan" class="form-control" id="inputEmail3" placeholder="Masukkan Telepon" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" name="email_pelanggan" class="form-control" id="inputEmail3" placeholder="Masukkan Email" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-10">
          <textarea name="alamat_pelanggan" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukkan Alamat" required></textarea>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
      </div>
    </form>
    
    <?php 
      if(isset($_POST['submit'])){
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $no_telp_pelanggan = $_POST['no_telp_pelanggan'];
        $email_pelanggan = $_POST['email_pelanggan'];
        $alamat_pelanggan = $_POST['alamat_pelanggan'];
        $tanggal_pembelian = date("Y-m-d");

        $total_pembelian = $totalbelanja;
        $status = "Pesan Masuk, belum dikonfirmasi";

        $conn->query("INSERT INTO tbl_order (nama_pelanggan,no_telp_pelanggan,email_pelanggan,alamat_pelanggan,tanggal_pembelian,total_pembelian, status) VALUES ('$nama_pelanggan','$no_telp_pelanggan','$email_pelanggan','$alamat_pelanggan','$tanggal_pembelian','$total_pembelian','$status') ");

        $id_pembelian_barusan = $conn->insert_id;

        foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
				{
					 	//mendapatkan data produk berdasarkan id_produk
					$ambil=$conn->query("SELECT * FROM tbl_produk WHERE id='$id_produk'");
					$perproduk=$ambil->fetch_assoc();

					$nama=$perproduk['namaProduk'];
					$harga=$perproduk['harga'];

					$subharga=$perproduk['harga']*$jumlah;
					$conn->query("INSERT INTO tbl_order_produk (id_pembelian,id_produk,jumlah,namaProduk,harga,subharga) VALUES ('$id_pembelian_barusan ','$id_produk','$jumlah','$nama','$harga','$subharga') ");

          $conn->query("UPDATE tbl_produk SET stok=stok-$jumlah WHERE id='$id_produk'");
					
				} 

					//mengkosongkan cart
					unset($_SESSION["keranjang"]);
					//tampilan dialihkan ke halaman nota
					echo "<script>alert('Pembelian sukses');</script>";
					echo "<script>location='sukses.php?id=$id_pembelian_barusan';</script>";
      }
    ?>
  </div>
</div>

<?php include('partials-front/footer.php'); ?>