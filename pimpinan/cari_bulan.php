<?php if(isset($_GET['bulan'])){
$cari=$_GET['bulan'];
$th=$_GET['th'];
header("location:index.php?page=_penjualan_bulanan&bulan=$cari");
}else {
$cari2=$_GET['tahun'];
header("location:index.php?page=_penjualan_tahunan&tahun=$cari2");
}
?>