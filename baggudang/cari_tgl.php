<?php 
if ($cari=$_GET['tanggal']) {
	$cari=$_GET['tanggal'];
	header("location:index.php?page=_penjualan_harian&tanggal=$cari");
}elseif($cari=$_GET['tanggalp']) {
	$cari=$_GET['tanggalp'];
	header("location:index.php?page=_pembelian_barang&tanggal=$cari");
}

?>
