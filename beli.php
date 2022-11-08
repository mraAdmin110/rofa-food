<?php 
session_start();
//dapatkan id produk dari url
$id_produk=$_GET['id'];

//jk sudah ada produk di keranjang,maka di +1
if (isset($_SESSION['keranjang'][$id_produk])) 
{
	$_SESSION['keranjang'][$id_produk]+=1;
}

//selain itu(blm ada di keranjang),maka dianggap dibeli 1
else
{
	$_SESSION['keranjang'][$id_produk]=1;
}


echo "<script>alert('Produk telah masuk kedalam keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>