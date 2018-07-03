<script>

function startCalc(){
interval = setInterval("calc()",1);}
function calc(){
one = document.autoSumForm.jumlah.value;
two = document.autoSumForm.harga.value;
document.autoSumForm.total.value = (one * 1) * (two * 1) ;}
function stopCalc(){
clearInterval(interval);}
</script>
<script language="javascript">
  $(document).ready(function() {
    $("#kd_brg").change(function() {
        var nisp = $('#kd_brg').val();		
		$.post('load_data.php', // request ke file load_data.php
		{parent_id: nisp},
		function(data){
			 $('#nama_barang').val(data[0].nama_barang);
			 $('#hrg_jual').val(data[0].hrg_jual);	  
		},'json'
      );
   });
   });
  </script>

<?php

	if(isset($_POST['simpan'])){


	$tgl=$_POST['tgl'];
	$kd_supp=$_POST['kd_supp'];
	$no_t=$_POST['no_transaksi'];
	$kd_b=$_POST['kd_brg'];
	$nama_b=$_POST['nama_b'];
	$jum=$_POST['jumlah'];
	$harga=$_POST['harga'];
	$total=$_POST['total'];




	/*$cek = mysql_num_rows(mysql_query("SELECT * FROM pembelian WHERE no_transaksi='$no_t'"));

	if($cek > 0) {
		?><script language="javascript">document.location.href="?page=data_pembelian&x=1";</script><?php
	}else{ */



	$query=mysql_query("insert into pembelian values('','$no_t','$tgl','$kd_supp','$nama_p','$kd_b','$nama_b','$jum','$harga','$total')");

	if($query){
		?><script language="javascript">document.location.href="?page=data_pembelian&x=2";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_pembelian&x=4";</script><?php
	}

/*}*/
}else if(isset($_POST['edit'])){
	$id=$_POST['id'];

	$tgl=$_POST['tgl'];
	$no_t=$_POST['no_transaksi'];
	$kd_b=$_POST['kd_brg'];
	$nama_b=$_POST['nama_b'];
	$jum=$_POST['jumlah'];
	$harga=$_POST['harga'];
	$total=$_POST['total'];
	

	$query=mysql_query("update pembelian set no_transaksi='$no_t', tgl_transaksi='$tgl', kd_barang='$kd_b', nama_brg='$nama_b', jumlah='$jum'
										 , harga='$harga' , total='$total' where id_pembelian='$id'");

	if($query){
		?><script language="javascript">document.location.href="?page=data_pembelian&x=3";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_pembelian&x=4";</script><?php
	}
}else if(isset($_GET['id'])){//hapus

	mysql_query("delete from pembelian where id_pembelian='$_GET[id]'");
	?><script language="javascript">document.location.href="?page=data_pembelian&x=5";</script><?php


}else{
	unset($_POST['submit']);
}


?>
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from pembelian");
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

<center><h3><span class="glyphicon glyphicon-usd"></span>  Transaksi Pembelian</h3></center>
<button style="margin-bottom:30px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Entry Pembelian</button>
<br/>
<table class="table table-striped table-bordered table-responsive">
	<tr class="info">
		<th class="col-md-1" style="width: 10px;" >No</th>
		<th class="col-md-2"  style="width: 80px;">tgl Transaksi</th>
		<th class="col-md-2" style="width: 80px;">No Transaksi</th>
		<th class="col-md-2" style="width: 80px;">Kode barang</th>
		<th class="col-md-2" style="width: 80px;">Nama Barang</th>
		<th class="col-md-1" style="width: 80px;">Jumlah</th>
		<th class="col-md-1" style="width: 80px;">Harga</th>
		<th class="col-md-1"style="width: 60px;">Total</th>
		<th class="col-md-2">Aksi</th>
	</tr>
	 <?php
		$view=mysql_query("select * from pembelian order by id_pembelian desc ");

		$no=1;
			while($row=mysql_fetch_array($view)){
				$harga = $row['harga'];
				$harga_a = number_format($harga,2,",",".");
				$total = $row['total'];
				$total_a = number_format($total,2,",",".");
					

			

           
						
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $row['tgl_transaksi'] ?></td>
			<td><?php echo $row['no_transaksi'] ?></td>
			<td><?php echo $row['kd_barang'] ?></td>
			<td><?php echo $row['nama_brg'] ?></td>
			<td><?php echo $row['jumlah'] ?></td>
			<td>Rp.<?php echo $harga_a; ?>-,</td>
			<td>Rp.<?php echo $total_a; ?>-,</td>

			<td>
				<a href="?page=edit_pembelian&id=<?php echo $row['id_pembelian']; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='?page=data_pembelian&id=<?php echo $row['id_pembelian']; ?>' }" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
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
				<li><a href="?page=data_pembelian&p=<?php echo $x ?>"><?php echo $x ?></a></li>
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
				<center><h3 class="modal-title">Entry Pembelian</h3></center>
			</div>
			<div class="modal-body">
				<form name='autoSumForm' action="?page=data_pembelian" method="post">
				<table class="table">
				<tr>
					<td><label>Tanggal</label></td>
					<td><input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off" required></td>
				</tr>
				<tr>
					<td><label>No Transaksi</label></td>
					<td><input name="no_transaksi" type="text" class="form-control" required></td>
					
				</tr>
				<tr>
				<tr>
					<td>Kode Barang</td>							
							<td><select class="form-control" name="kd_brg" id="kd_brg" >
								<option>Pilih Kode Barang</option>
								<?php 
								$brg=mysql_query("select * from barang");
								while($b=mysql_fetch_array($brg)){
									?>	
									<option value="<?php echo $b['kd_barang']; ?>"><?php echo $b['kd_barang'] ?></option>
									<?php 
								}
								?>
							</select></td>

				</tr>
				</tr>
				<tr>
					<td><label>Nama Barang </label></td>
					<td><input name="nama_b" id="nama_barang" type="text" class="form-control" required></td>
					
				</tr>
				<tr>
					<td><label>Jumlah </label></td>
					<td><input name="jumlah" type="number" class="form-control" onFocus="startCalc();" onBlur="stopCalc();" required></td>
					
				</tr>
				<tr>
					<td><label>Harga</label></td>
					<td><input name="harga" type="number" class="form-control" onFocus="startCalc();" onBlur="stopCalc();" required></td>			
				</tr>
				<tr>
					<td><label>Total </label></td>
					<td><input name="total" type="number" class="form-control" onchange='tryNumberFormat(this.form.thirdBox);'></td>			
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
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>





