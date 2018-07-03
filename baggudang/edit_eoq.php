<script language="javascript">
  $(document).ready(function() {
    $("#kd_b").change(function() {
        var nisp = $('#kd_b').val();		
		$.post('load_data.php', // request ke file load_data.php
		{parent_id: nisp},
		function(data){
			 $('#nama_b').val(data[0].nama_barang);
			  
		},'json'
      );
   });
   });
  </script>
<a class="btn" href="?page=data_eoq"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$sql = mysql_query("select * from eoq where id_eoq='$_GET[id]'");
	$r = mysql_fetch_array($sql);
	$l=$r['kd_barang'];
?>
<center><h3><span class="glyphicon glyphicon-refresh"></span>  Edit Analisa EOQ</h3></center>
				
	<form name='autoSumForm' action="?page=analisa_eoq" method="post">
		<table class="table">
				<td><input type="hidden" name="id" value="<?php echo $r['id_eoq'] ?>"></td>
				<tr>
					<td style="width: 150px;"><label>Tanggal</label></td>
					
					<td><input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off" style="width: 160px;" value="<?php echo $r['tanggal'] ?>" required></td>
					
					
					
				</tr>

				<tr>
					<td>Kode Barang</td>							
							<td><select class="form-control" name="kd_b" id="kd_b" style="width: 160px;">
							<option>Pilih Kode Barang</option>
								<?php 
								$brg=mysql_query("select * from barang");
								while($b=mysql_fetch_array($brg)){
									$h = $b['kd_barang'];
									?>	
									<option <?php if( $l==$h ) {echo "selected"; } ?> value="<?php echo $b['kd_barang']; ?>"><?php echo $b['kd_barang'] ?></option>
									<?php 
								}
								?>
							</select></td>

				</tr>
				<tr>
					<td><label>Nama Barang</label></td>
					<td><input name="nama_b" id="nama_b" type="text" class="form-control" style="width: 160px;" value="<?php echo $r['nama_barang'] ?>" required></td>
				</tr>
				<tr>
					<td><label>Biaya Pesan</label></td>
					<td><input name="biaya_p"  type="text" class="form-control" style="width: 160px;" value="<?php echo $r['biaya_pesan'] ?>" required></td>
				</tr>
				<tr>
					<td><label>Biaya Simpan</label></td>
					<td><input name="biaya_s" type="text" class="form-control" style="width: 160px;" value="<?php echo $r['biaya_simpan'] ?>" required></td>
				</tr>
				<tr>
					<td><label>Lead Time</label></td>
					<td><input name="lead_t" type="text" class="form-control" style="width: 160px;" value="<?php echo $r['lead_time'] ?>" required></td>
				</tr>
				<tr>
					<td><label>Jumlah</label></td>
					<td><input name="jumlah" type="text" class="form-control" style="width: 160px;" value="<?php echo $r['jumlah'] ?>" required></td>
				</tr>

					
					</table>
					<div style="width: 500px;" class="modal-footer">
						<input type="submit" name="edit" class="btn btn-info" class="glyphicon glyphicon-refresh" value="Edit">
					</div>

		</table>
<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>
				
	