
<?php


	if(isset($_POST['simpan'])){


	$kd=$_POST['kd_barang'];
	$nama=$_POST['nama_barang'];
	$supp=$_POST['nm_supp'];
	$h_beli=$_POST['hrg_beli'];
	$h_jual=$_POST['hrg_jual'];
	$stok1=$_POST['stok'];
	$biaya_p=$_POST['biaya_p'];
	$biaya_s=$_POST['biaya_s'];
	$lead_t=$_POST['lead_t'];



	$cek = mysql_num_rows(mysql_query("SELECT * FROM barang WHERE kd_barang='$kd'"));

	if($cek > 0) {
		?><script language="javascript">document.location.href="?page=data_barang&x=1";</script><?php
	}else{



	$query=mysql_query("insert into barang values('$kd','$nama','$supp','$h_beli','$h_jual','$stok1','$biaya_p','$biaya_s','$lead_t')");

	if($query){
		?><script language="javascript">document.location.href="?page=data_barang&x=2";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_barang&x=4";</script><?php
	}

}
}else if(isset($_POST['edit'])){
	$kd=$_POST['kd_barang'];
	$nama=$_POST['nama_barang'];
	$supp=$_POST['nm_supp'];
	$h_beli=$_POST['hrg_beli'];
	$h_jual=$_POST['hrg_jual'];
	$stok1=$_POST['stok'];
	$biaya_p=$_POST['biaya_p'];
	$biaya_s=$_POST['biaya_s'];
	$lead_t=$_POST['lead_t'];


	$query=mysql_query("update barang set nama_barang='$nama', nm_supp='$supp', hrg_beli='$h_beli', hrg_jual='$h_jual', stok='$stok1',biaya_pesan=$biaya_p,biaya_simpan=$biaya_p,lead_time=$lead_t where kd_barang='$kd'");

	if($query){
		?><script language="javascript">document.location.href="?page=data_barang&x=3";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_barang&x=4";</script><?php
	}
}else if(isset($_GET['kd'])){//hapus

	mysql_query("delete from barang where kd_barang='$_GET[kd]'");
	?><script language="javascript">document.location.href="?page=data_barang&x=5";</script><?php


}else{
	unset($_POST['submit']);
}
?>
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from barang");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['p'])) ? (int)$_GET['p'] : 1;
$start = ($page - 1) * $per_hal;


?>
<?php 
		if(isset($_GET['x'])){
			$pesan=mysql_real_escape_string($_GET['x']);
			if($pesan == "1"){
				echo "<div class=\"alert alert-warning\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Peringatan!</strong> data sudah ada.</div>";
			}elseif ($pesan=="2"){
			echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Terima Kasih.</strong> data berhasil di inputkan.</div>";
			}elseif ($pesan=="3"){
			echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Terima Kasih.</strong> data berhasil di edit.</div>";
			}elseif ($pesan=="4"){
			echo "<div class=\"alert alert-warning\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Peringatan!</strong> error.</div>";
			}elseif ($pesan=="5"){
			echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Terima Kasih.</strong> data berhasil di hapus.</div>";
			}

		}
		?>

<center><h3><span class="glyphicon glyphicon-briefcase"></span>  Data Barang</h3></center>
<button style="margin-bottom:30px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Entry Barang</button>
<br/>
<form action="cari_act.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari nama Barang .." aria-describedby="basic-addon1" name="caris">	
	</div>
</form>
<br>
<table class="table table-striped table-bordered table-responsive">
	<tr class="info">
		<th class="col-md-1" >No</th>
		
		<th class="col-md-2">Kode Barang</th>
		<th class="col-md-3">Nama Barang</th>
		<th class="col-md-2">Supplier</th>
		<th class="col-md-2">Harga Beli</th>
		<th class="col-md-2">Harga Jual</th>
		<th class="col-md-2">Stok</th>
		<th class="col-md-2">Biaya Pesan</th>
		<th class="col-md-2">Biaya Simpan</th>
		<th class="col-md-2">Lead Time</th>
		<th class="col-md-4">Aksi</th>
	</tr>
	 <?php
	 	 if(isset($_GET['cari'])){
		$cari=mysql_real_escape_string($_GET['cari']);
		$view=mysql_query("select * from barang where nama_barang like '$cari' or kd_barang like '$cari'");
		}else{
		$view=mysql_query("select * from barang order by kd_barang asc ");
	}

		$no=1;
			while($row=mysql_fetch_array($view)){

           
						
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $row['kd_barang'] ?></td>
			<td><?php echo $row['nama_barang'] ?></td>
			<td><?php echo $row['nm_supp'] ?></td>
			<td><?php echo $row['hrg_beli'] ?></td>
			<td><?php echo $row['hrg_jual'] ?></td>
			<td><?php echo $row['stok'] ?></td>
			<td><?php echo $row['biaya_pesan'] ?></td>
			<td><?php echo $row['biaya_simpan'] ?></td>
			<td><?php echo $row['lead_time'] ?></td>
			<td>
				<a href="?page=edit_barang&kd=<?php echo $row['kd_barang']; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='?page=data_barang&kd=<?php echo $row['kd_barang']; ?>' }" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
			</td>
		</tr>
		<?php
	}
	?>

</table>
<ul class="pagination">			
			<?php 
			for($x=1;$x<=$halaman;$x++){
				?>
				<li><a href="?page=data_barang&p=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>						
		</ul>
<br><br><br><br><br><br><br><br><br><br><br><br>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center><h3 class="modal-title">Entry Barang</h3></center>
			</div>
			<div class="modal-body">
				<form action="?page=data_barang" method="post">
				<table class="table">
				<tr>
					<td><label>Kode Barang</label></td>
					<td><input name="kd_barang" type="text" class="form-control"></td>
					
				</tr>
				<tr>
					<td><label>Nama Barang</label></td>
					<td><input name="nama_barang" type="text" class="form-control"></td>
					
				</tr>
				<tr>
					<td><label>Supplier</label></td>
					<td><input name="nm_supp" type="text" class="form-control"></td>
					
				</tr>
				<tr>
					<td><label>Harga Beli</label></td>
					<td><input name="hrg_beli" type="text" class="form-control"></td>
					
				</tr>
				<tr>
					<td><label>Harga Jual</label></td>
					<td><input name="hrg_jual" type="text" class="form-control"></td>
					
				</tr>
				<tr>
					<td><label>Stok</label></td>
					<td><input name="stok" type="number" class="form-control"></td>
					
				</tr>
				<tr>
					<td><label>Biaya Pesan</label></td>
					<td><input name="biaya_p"  type="text" class="form-control" style="width: 160px;" required></td>
				</tr>
				<tr>
					<td><label>Biaya Simpan</label></td>
					<td><input name="biaya_s" type="text" class="form-control" style="width: 160px;" required></td>
				</tr>
				<tr>
					<td><label>Lead Time</label></td>
					<td><input name="lead_t" type="text" class="form-control" style="width: 160px;" required></td>
				</tr>
					
					</table>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" name="simpan" class="btn btn-primary" value="Tambah">
				</div>
			</form>
		</div>
	</div>
</div>





