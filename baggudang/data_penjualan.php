
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
	$no_f=$_POST['no_f'];
	$tgl=$_POST['tgl'];
	$kd_b=$_POST['kd_brg'];
	$nama_b=$_POST['nama_b'];
	$jum=$_POST['jumlah'];
	$harga=$_POST['harga'];
	$total=$_POST['total'];

	$car=mysql_fetch_array(mysql_query("select * from barang where kd_barang='$kd_b'"));
	$stok= $car['stok'];

	if($stok < $jum) {
		  ?><script language="javascript">document.location.href="?page=data_penjualan&x=6";</script><?php
		}else {


	$query=mysql_query("insert into penjualan values('','$nama_p','$no_f','$tgl','$kd_b','$nama_b','$jum','$harga','$total')");
	$query=mysql_query("update barang set stok='$jum'-stok where kd_barang='$kd_b' ");

	if($query){
		?><script language="javascript">document.location.href="?page=data_penjualan&x=2";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_penjualan&x=4";</script><?php
	}
	

}
}else if(isset($_POST['edit'])){
	$id=$_POST['id'];
	$no_f=$_POST['no_f'];
	$tgl=$_POST['tgl'];
	$kd_b=$_POST['kd_brg'];
	$nama_b=$_POST['nama_b'];
	$jum=$_POST['jumlah'];
	$harga=$_POST['harga'];
	$total=$_POST['total'];

	$query=mysql_query("update penjualan set tgl_faktur='$tgl', no_faktur='$no_f', kd_barang='$kd_b',
										 nama_brg='$nama_b', jumlah='$jum', harga='$harga', total='$total'
										  where id_penjualan='$id'");
	$query=mysql_query("update barang set stok='$jum'-stok where kd_barang='$kd_b' ");

	if($query){
		?><script language="javascript">document.location.href="?page=data_penjualan&x=3";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_penjualan&x=4";</script><?php
	}
}else if(isset($_GET['id'])){//hapus

	mysql_query("delete from penjualan where id_penjualan='$_GET[id]'");
	?><script language="javascript">document.location.href="?page=data_penjualan&x=5";</script><?php


}else if(isset($_POST['tambah'])){
	$no_f=$_POST['no_f'];
	$tgl=$_POST['tgl'];
	$kd_b=$_POST['kd_brg'];
	$nama_b=$_POST['nama_b'];
	$jum=$_POST['jumlah'];
	$harga=$_POST['harga'];
	$total=$_POST['total'];

	$car=mysql_fetch_array(mysql_query("select * from barang where kd_barang='$kd_b'"));
	$stok= $car['stok'];

	if($stok < $jum) {
		  ?><script language="javascript">document.location.href="?page=data_penjualan&x=6";</script><?php
		}else {


	$query=mysql_query("insert into penjualan values('','$nama_p','$no_f','$tgl','$kd_b','$nama_b','$jum','$harga','$total')");
	$query=mysql_query("update barang set stok='$jum'-stok where kd_barang='$kd_b' ");

	$sjum=mysql_fetch_array(mysql_query("select count(*) from penjualan where no_faktur='$no_f'"));
	$jum1 = $sjum[0];

	if($query){
		?><script language="javascript">document.location.href="?page=data_penjualan&x=2&no=<?php echo $no_f ?>&tgl=<?php echo $tgl ?>&jum=<?php echo $jum1 ?>#myModal";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_penjualan&x=4";</script><?php
	}
	

}
}else{
	unset($_POST['submit']);
}


?>
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from penjualan");
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
			}elseif ($pesan=="6"){
			echo "<div class=\"alert alert-warning\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Peringatan !</strong> Stok barang Tidak Mencukupi.</div>";
			}

		}
		?>

<center><h3><span class="glyphicon glyphicon-usd"></span>  Transaksi Penjualan</h3></center>
<button style="margin-bottom:30px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Entry Penjualan</button>
<br/>
<table class="table table-striped table-bordered table-responsive">
	<tr class="info">
		<th class="col-md-1" style="width: 10px;" >No</th>
		<th class="col-md-1" style="width: 10px;" >Tgl F</th>
		<th class="col-md-1" style="width: 10px;">No.Faktur</th>
		<th class="col-md-2" style="width: 10px;">Kode barang</th>
		<th class="col-md-2" style="width: 10px;">Nama Barang</th>
		<th class="col-md-1" style="width: 10px;">Jumlah</th>
		<th class="col-md-2" style="width: 10px;">Harga</th>
		<th class="col-md-2" style="width: 10px;">Total</th>
		<th class="col-md-2">Aksi</th>
	</tr>
	 <?php
		$view=mysql_query("select * from penjualan order by id_penjualan desc ");

		$no=1;
			while($row=mysql_fetch_array($view)){
				$harga = $row['harga'];
				$harga_a = number_format($harga,2,",",".");
				$total = $row['total'];
				$total_a = number_format($total,2,",",".");
					

			

           
						
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $row['tgl_faktur'] ?></td>
			<td><?php echo $row['no_faktur'] ?></td>
			<td><?php echo $row['kd_barang'] ?></td>
			<td><?php echo $row['nama_brg'] ?></td>
			<td><?php echo $row['jumlah'] ?></td>
			<td>Rp.<?php echo $harga_a; ?>-,</td>
			<td>Rp.<?php echo $total_a; ?>-,</td>

			<td>
				<a href="?page=edit_penjualan&id=<?php echo $row['id_penjualan']; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='?page=data_penjualan&id=<?php echo $row['id_penjualan']; ?>' }" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
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
				<li><a href="?page=data_penjualan&p=<?php echo $x ?>"><?php echo $x ?></a></li>
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
				<center><h3 class="modal-title">Entry Penjualan</h3></center>
			</div>
			<div class="modal-body">
				<form name='autoSumForm' action="?page=data_penjualan" method="post">
				<table class="table">

				<?php  
				if(isset($_GET['tgl'])) { 
					 $tgl=$_GET['tgl']; 
					}else{
						$tgl="";
					} 

				if(isset($_GET['no'])) { 
					 $no=$_GET['no']; 
					}else{
						$no="";
					} 
				if(isset($_GET['jum'])) { 
					 $jum=$_GET['jum']; 
					}else{
						$jum="1";
					} 


					?>
				<tr>
						<td>Barang <?php  echo $tgl?></td> 
				</tr>

				<?php  
				if(isset($_GET['tgl'])) { 
					 $tgl=$_GET['tgl']; 
					}else{
						$tgl="";
					} 

				if(isset($_GET['no'])) { 
					 $no=$_GET['no']; 
					}else{
						$no="";
					} 


					?>
				<tr>
					<td><label>Tanggal Faktur</label></td>
					<td><input name="tgl" type="text" class="form-control" id="tgl" value="<?php echo $tgl ?>" autocomplete="off" required></td>
					
				</tr>
				<tr>
					<td><label>No Faktur</label></td>
					<td><input name="no_f" type="text" value="<?php echo $no ?>" class="form-control" required></td>
					
					
				</tr>
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
					<td><input name="harga" id="hrg_jual" type="number" class="form-control" onFocus="startCalc();" onBlur="stopCalc();" required></td>			
				</tr>
				<tr>
					<td><label>Total </label></td>
					<td><input name="total" type="number" class="form-control" onchange='tryNumberFormat(this.form.thirdBox);'></td>			
				</tr>
				<tr>
					<td><input type="submit" name="tambah" class="btn btn-primary" value="Tambah Transaksi"></td>
				</tr>
					
					</table>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});

			$(document).ready(function(){
				if(window.location.href.indexOf('#myModal'))
					$("#myModal").modal('show');							
		});


	</script>
	



