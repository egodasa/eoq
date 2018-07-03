<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
    
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/js/jquery-ui/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
	
	<link type="text/css" href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="assets/css/theme.css" rel="stylesheet">
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.js"></script>
	<?php include 'config.php'; ?>
	<style type="text/css">
	.kotak{	
		margin-top: 15px;
	}

	.kotak .input-group{
		margin-bottom: 20px;
	}
	</style>
</head>
<body>	
<div class="navbar navbar-new">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="./" class="navbar-brand"><b>PENGOLAHAN DATA STOCK CONTROLLING </b></a>  
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			
		</div>
	</div>
<div class="wrapper">
	<div class="container">
	<div class="row">
		<?php 
		if(isset($_GET['pesan'])){
			$pesan=mysql_real_escape_string($_GET['pesan']);
			if($pesan == "gagal"){
				echo "<div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Peringatan!</strong> Kombinasi Username dan Password tidak valid.</div>";
			}elseif ($pesan=="lo"){
			echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Terima Kasih.</strong> Anda telah berhasil logout.</div>";
		}
		}
		?>
		
		<div class="module module-login span4 offset4">
			<form class="form-vertical" action="" method="post">
				<div class="module-head  kotak">
				<img class="img-responsive" src="foto/login.png">
					<h4><p align="center"><b>Login</p></b></h4>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" placeholder="Username" name="username">
					</div>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						<input type="password" class="form-control" placeholder="Password" name="password">
					</div>
					<div class="form-group">							
							<select class="form-control" name="level">
								
									<option value="1">Bag.Gudang</option>
									<option value="2">Karyawan</option>
									<option value="3">Pimpinan</option>
									
								
							</select>

					</div>	
					<div class="input-group">		
						<input type="submit" name="login" class="btn btn-primary" value="Login">
						<input type="submit" name="cancel" class="btn btn-primary" value="Cancel">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<div class="footer">
		<div class="content">
			<center><p>
				 &copy; <?=date("Y");?> <a href="#">| TOKO AMSTERDAM GAME SHOP</a>
			</p></center>
		</div>
	</div> <!-- /.footer -->
</div>	        
</body>
</html>
<?php 
session_start();
include 'config.php';


 if (isset($_POST['login'])){
	//koneksi terpusat

		$uname=$_POST['username'];
		$pass=$_POST['password'];
		$level=$_POST['level'];

	if($level=="1"){
		$query=mysql_query("select * from user where username='$uname' and password='$pass' and level='$level'");
		$cek=mysql_num_rows($query);
		$row=mysql_fetch_array($query);


		if($cek){
			$_SESSION['username']=$uname;


			header("location:baggudang/index.php");

		}else{
			header("location:index.php?pesan=gagal")or die(mysql_error());
		}
	}

	if($level=="2"){
		$query=mysql_query("select * from user where username='$uname' and password='$pass' and level='$level'");
		$cek=mysql_num_rows($query);
		$row=mysql_fetch_array($query);

		if($cek){
			$_SESSION['username']=$uname;

			header("location:karyawan/index.php");

		}else{
			header("location:index.php?pesan=gagal")or die(mysql_error());
		}
	}

	if($level=="3"){
		$query=mysql_query("select * from user where username='$uname' and password='$pass' and level='$level'");
		$cek=mysql_num_rows($query);
		$row=mysql_fetch_array($query);

		if($cek){
			$_SESSION['username']=$uname;

			header("location:pimpinan/index.php");

		}else{
			header("location:index.php?pesan=gagal")or die(mysql_error());
		}
	}





}else{
	unset($_POST['login']);
}
?>