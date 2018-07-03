<!DOCTYPE html>
<html>
<head>
	<?php
	session_start();
	include "cek.php";
	include '../config.php';
	?>
	<title>PENGOLAHAN DATA</title>
	<link rel="shourtcut icon" href="../foto/head.png">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>
	
</head>
<body>

	<div class="navbar navbar-new">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">PENGOLAHAN DATA </a>  <img src="../foto/header_userlogo.png" style="width:130px; margin-top:10px;">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a id="pesan_sedia" href="#" data-toggle="modal" data-target="#modalpesan"><span class='glyphicon glyphicon-comment'></span>  Pesan</a></li>
					<li><a class="dropdown-toggle" data-toggle="dropdown" role="button" href="#">  <?php echo $_SESSION['username']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"><span class=" caret"></span></span></a>
					<ul class="dropdown-menu">
      						<li><a href="?page=ganti_pass" ><span class="glyphicon glyphicon-lock"></span> Ganti password</a></li>
     						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        				</ul>
        			</li>
				</ul>
			</div>
		</div>
	</div>
	<div id="modalpesan" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pesan Notification</h4>
				</div>
				<div class="modal-body">
					<?php 
					$periksa=mysql_query("select * from barang where stok <=3");
					while($q=mysql_fetch_array($periksa)){	
						if($q['stok']<=3){			
							echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>". $q['nama_barang']."</a> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!</div>";	
						}
					}
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>						
				</div>
				
			</div>
		</div>
	</div>
<div class="thumbnail"></div>
<div class="thumbnail"></div>
	

	<div class="col-md-2 sidenav">
	

  <ul class="nav nav-pills nav-stacked well" style="position: fixed; ">
  <div class="row ">
	<div class="col-xs-6 col-md-12" >
					
				</div>
		

		</div>
			<li class="active "><a href="index.php"><span class="glyphicon glyphicon-home"></span>  HOME</a></li>
			<li><a href="?page=data_barang"><span class="glyphicon glyphicon-briefcase"></span>  Data Barang</a></li>
            
            <li><a class="dropdown-toggle" data-toggle="dropdown" role="button" href="#"><span class="glyphicon glyphicon-usd"></span>  Transaksi <span class=" caret"></span></span></a>
			<ul class="dropdown-menu">
							<li><a href="?page=data_pembelian" ><span class="glyphicon glyphicon-usd"> Pembelian</a></li>
							<li><a href="?page=data_penjualan" ><span class="glyphicon glyphicon-usd"> Penjualan</a></li>
      						
     						
        				</ul>
        			</li>
        	<li><a class="dropdown-toggle" data-toggle="dropdown" role="button" href="#"><span class="glyphicon glyphicon-list-alt"></span>  Laporan <span class=" caret"></span></span></a>
			<ul class="dropdown-menu">
							<li><a href="?page=_laporan_persediaan_barang" ><span class="glyphicon glyphicon-list-alt"> Persediaan Barang</a></li>
							<li><a href="?page=_faktur_penjualan" ><span class="glyphicon glyphicon-list-alt"> Faktur Penjualan</a></li>
							<li><a href="?page=_penjualan_harian" ><span class="glyphicon glyphicon-list-alt"> Penjualan Harian</a></li>
      						<li><a href="?page=_penjualan_bulanan" ><span class="glyphicon glyphicon-list-alt"> Penjualan Bulanan</a></li>
      						<li><a href="?page=_penjualan_tahunan" ><span class="glyphicon glyphicon-list-alt"> Penjualan Tahunan</a></li>
      						<li><a href="?page=_laporan_eoq" ><span class="glyphicon glyphicon-list-alt"> Laporan EOQ</a></li>
     						<li><a href="?page=_pembelian_barang" ><span class="glyphicon glyphicon-list-alt"> Pembelian Barang</a></li>
        				</ul>
        			</li>
        	
        	<li><a href="?page=analisa_eoq"><span class="glyphicon glyphicon-refresh"></span>  Analisa EOQ</a></li>

			
            <br><br><br><br><br>


		</ul>
	</div>
	<div class="col-md-10 "  >


