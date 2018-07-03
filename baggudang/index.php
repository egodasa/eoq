
<?php include 'header.php' ?>
<div class="wrap">

	<div class="col-md-14">
	<div class="col-sm-14 sidenav">
<div class="well2">	
				<?php
if(isset($_GET['page'])){
	$page=$_GET['page'];	
	$file="$page.php";
	
	if (!file_exists($file)){
		include ("dashboard.php");
	}else{
		include ("$page.php");
	}
}else{
	include ("dashboard.php");
}
?>
</div>
</div>	
<!-- kalender -->
<div class="pull-right">
	<div id="kalender"></div>
</div>

<?php 
include 'footer.php';

?>