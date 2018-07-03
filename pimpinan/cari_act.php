<?php if(isset($_GET['cari'])){
$cari=$_GET['cari'];
header("location:index.php?page=data_barang&cari=$cari");
} else if(isset($_GET['caris'])){
$cari2=$_GET['caris'];
header("location:index.php?page=data_supplier&cari=$cari2");
}else {
$cari3=$_GET['faktur'];
header("location:index.php?page=_faktur_penjualan&cari=$cari3");
}
?>
