<script language="javascript">
  $(document).ready(function() {
    $("#kd_b").change(function() {
        var nisp = $('#kd_b').val();		
		$.post('load_data.php', // request ke file load_data.php
		{parent_id: nisp},
		function(data){
			 $('#nama_b').val(data[0].nama_barang);
			  $('#biaya_p').val(data[0].biaya_pesan);
			  $('#biaya_s').val(data[0].biaya_simpan);
			  $('#lead_t').val(data[0].lead_time);
			  $('#stok').val(data[0].stok);
		},'json'
      );
   });
   });
  </script>
<?php


	if(isset($_POST['proses'])){


	$tgl=$_POST['tgl'];
	$th=substr($tgl,0,4);
	$kd_b=$_POST['kd_b'];
	$nama_b=$_POST['nama_b'];
	$biaya_p=$_POST['biaya_p'];
	$biaya_s=$_POST['biaya_s'];
	$lead_t=$_POST['lead_t'];
	$jum=$_POST['jumlah'];
	$eoq=$_POST['eoq'];
	$rqp=$_POST['rop'];

	$q = (2 * $biaya_p * $jum) / ($biaya_s);	
	$qh = sqrt($q); //rumus q mencari kebutuhan ekonomis

	$f = ($biaya_s * $jum) / (2 * $biaya_p);

	$fh = sqrt($f); // rumus frekuensi

	$v= 1 / $fh * 365;
	$vh = $v; //rumus interval

	$sql=mysql_fetch_array(mysql_query("select * from barang where kd_barang='$kd_b' "));
	$p = $sql['hrg_beli']; 


	$e = (2 * $jum * $biaya_p) / ($p * $biaya_s);
	$eh= sqrt($e); // rumus eoq

	$sqlrop=mysql_fetch_array(mysql_query("select SUM(jumlah)AS jumlah from penjualan where year(tgl_faktur)='$th'"));
	$k = $sqlrop['jumlah'];
	$krata2= $k / 365 ;

	$ro = $k * $lead_t * $jum;





	$query=mysql_query("insert into eoq values('','$tgl','$kd_b','$nama_b','$biaya_p','$biaya_s','$lead_t','$jum','$rqp','$eoq')");

	if($query){
		?><script language="javascript">document.location.href="?page=analisa_eoq&x=2";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=analisa_eoq&x=4";</script><?php
	}


}else if(isset($_POST['edit'])){
	$id=$_POST['id'];
	$tgl=$_POST['tgl'];
	$th=substr($tgl,0,4);
	$kd_b=$_POST['kd_b'];
	$nama_b=$_POST['nama_b'];
	$biaya_p=$_POST['biaya_p'];
	$biaya_s=$_POST['biaya_s'];
	$lead_t=$_POST['lead_t'];
	$jum=$_POST['jumlah'];


	$q = (2 * $biaya_p * $jum) / ($biaya_s);	
	$qh = sqrt($q); //rumus q mencari kebutuhan ekonomis

	$f = ($biaya_s * $jum) / (2 * $biaya_p);

	$fh = sqrt($f); // rumus frekuensi

	$v= 1 / $fh * 365;
	$vh = $v; //rumus interval

	$sql=mysql_fetch_array(mysql_query("select * from barang where kd_barang='$kd_b' "));
	$p = $sql['hrg_beli']; 


	$e = (2 * $jum * $biaya_p) / ($p * $biaya_s);
	$eh= sqrt($e); // rumus eoq

	$sqlrop=mysql_fetch_array(mysql_query("select SUM(jumlah)AS jumlah from penjualan where year(tgl_faktur)='$th'"));
	$k = $sqlrop['jumlah'];
	$krata2= $k / 365 ;

	$ro = $k * $lead_t * $jum;


	$query=mysql_query("update eoq set tanggal='$tgl', kd_barang='$kd_b', nama_barang='$nama_b', biaya_pesan='$biaya_p', biaya_simpan='$biaya_s', 
											lead_time='$lead_t', jumlah='$jum', kebutuhan='$qh', frekuensi='$fh', rqp='$ro', eoq='$eh', interv='$vh' where id_eoq='$id'");

	if($query){
		?><script language="javascript">document.location.href="?page=analisa_eoq&x=3";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=analisa_eoq&x=4";</script><?php
	}
}else if(isset($_GET['id'])){//hapus

	mysql_query("delete from eoq where id_eoq='$_GET[id]'");
	?><script language="javascript">document.location.href="?page=analisa_eoq&x=5";</script><?php


}else{
	unset($_POST['submit']);
}


?>

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
<center><h3><span class="glyphicon glyphicon-refresh"></span>  Analisa EOQ</h3></center>
				
	<form name='autoSumForm' action="" method="post">
		<table class="table">
				<tr>
					<td style="width: 150px;"><label>Tanggal</label></td>
					<td><input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off" style="width: 160px;" required></td>
					
					
				</tr>

				<tr>
					<td>Kode Barang</td>							
							<td><select class="form-control" name="kd_b" id="kd_b" style="width: 160px;">
							<option>Pilih Kode Barang</option>
								<?php 
								$brg=mysql_query("select * from barang");
								while($b=mysql_fetch_array($brg)){
									?>	
									<option value="<?php echo $b['kd_barang']; ?>"><?php echo $b['kd_barang'] ?> </option>
									<?php 
								}
								?>
							</select></td>

				</tr>
				<tr>
					<td><label>Nama Barang</label></td>
					<td><input name="nama_b" id="nama_b" type="text" class="form-control" style="width: 160px;" required></td>
				</tr>
				<tr>
					<td><label>Jumlah Stok</label></td>
					<td><input name="stok" id="stok" type="text" class="form-control" style="width: 160px;" required></td>
				</tr>
				<tr>
					<td><label>Biaya Pesan</label></td>
					<td><input name="biaya_p" id="biaya_p" type="text" class="form-control" style="width: 160px;" required></td>
				</tr>
				<tr>
					<td><label>Biaya Simpan</label></td>
					<td><input name="biaya_s" id="biaya_s" type="text" class="form-control" style="width: 160px;" required></td>
				</tr>
				<tr>
					<td><label>Lead Time</label></td>
					<td><input name="lead_t" id="lead_t" type="text" class="form-control" style="width: 160px;" required></td>
				</tr>
				<tr>
					<td><label>Jumlah</label></td>
					<td><input name="jumlah" id="jumlah" type="text" class="form-control" style="width: 160px;" onkeyup="hitungRop(); hitungEoq();" required></td>
				</tr>
				<tr>
					<td><label>ROP</label></td>
					<td><input name="rop" id="rop" type="number" class="form-control" style="width: 150px;" required ></td>
				</tr>
				<tr>
					<td><label>EOQ</label></td>
					<td><input name="eoq" id="eoq" type="number" class="form-control" style="width: 150px;" required ></td>
				</tr>-->


					
					</table>
					<div style="width: 500px;" class="modal-footer">
						<input type="submit" name="proses" class="btn btn-info" class="glyphicon glyphicon-refresh" value="Proses">
					</div>
				

				<!--<table class="table">
				<tr>
				 	<td style="width: 150px;"><label>Kebutuhan</label></td>
					<td><input name="keb" type="number" class="form-control" style="width: 150px;" ></td>
				</tr>
				<tr>
					<td><label>interval</label></td>
					<td><input name="interval" type="number" class="form-control" style="width: 150px;" ></td>
				</tr>
				<tr>
					<td><label>Frekuensi</label></td>
					<td><input name="frek" type="number" class="form-control" style="width: 150px;" ></td>
				</tr>
				<tr>
					<td><label>ROP</label></td>
					<td><input name="rop" type="number" class="form-control" style="width: 150px;" ></td>
				</tr>
				<tr>
					<td><label>EOQ</label></td>
					<td><input name="eoq" type="number" class="form-control" style="width: 150px;" ></td>
				</tr>-->

		</table>
				
	</form>

<center><h3> List EOQ</h3></center>
<br/>
<table class="table table-striped table-bordered table-responsive">
	<tr class="info">
		<th class="col-md-1" >No</th>
		
		<th class="col-md-1">Tgl</th>
		<th class="col-md-1">kd barang</th>
		<th class="col-md-2">Nama Barang</th>
		<th class="col-md-2">biaya pesan</th>
		<th class="col-md-2">biaya simpan</th>
		<th class="col-md-2">lead time</th>
		<th class="col-md-2">jumlah</th>
		<th class="col-md-2">ROP</th>
		<th class="col-md-2">EOQ</th>
		<th class="col-md-4">Aksi</th>
	</tr>
	 <?php
		$view=mysql_query("select * from eoq order by tanggal");

		$no=1;
			while($row=mysql_fetch_array($view)){
						
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $row['tanggal'] ?></td>
			<td><?php echo $row['kd_barang'] ?></td>
			<td><?php echo $row['nama_barang'] ?></td>
			<td><?php echo $row['biaya_pesan'] ?></td>
			<td><?php echo $row['biaya_simpan'] ?></td>
			<td><?php echo $row['lead_time'] ?></td>
			<td><?php echo $row['jumlah'] ?></td>
			<td><?php echo $row['rqp'] ?></td>
			<td><?php echo $row['eoq'] ?></td>

			<td>
				<a href="?page=edit_eoq&id=<?php echo $row['id_eoq']; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='?page=analisa_eoq&id=<?php echo $row['id_eoq']; ?>' }" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>
			</td>
		</tr>
		<?php
	}
	?>

</table>
<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
		function hitungRop(){
			document.getElementById('rop').value = Math.ceil(document.getElementById('jumlah').value/30) * document.getElementById('lead_t').value
		}
		function hitungEoq(){
			var q = (2 * document.getElementById('biaya_p').value * document.getElementById('jumlah').value) / (document.getElementById('biaya_s').value);	
			var qh = Math.sqrt(q); //rumus q mencari kebutuhan ekonomis
			document.getElementById('eoq').value = Math.ceil(qh)
		}
	</script>
