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
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Penjualan</h3>
<a class="btn" href="?page=data_penjualan"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$sql = mysql_query("select * from penjualan where id_penjualan='$_GET[id]'");
	$r = mysql_fetch_array($sql);
$l=$r['kd_barang'];
?>					
	<form name='autoSumForm' action="?page=data_Penjualan" method="post">
		<table class="table">
				<tr>
					<td><label>Tanggal Faktur</label></td>
					<input name="id" type="hidden" class="form-control" value="<?php echo $r['id_penjualan'] ?>">
					<td><input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off" value="<?php echo $r['tgl_faktur'] ?>" required></td>
					
					
				</tr>
				<tr>
					<td><label>No Faktur</label></td>
					<td><input name="no_f" type="text" class="form-control" value="<?php echo $r['no_faktur'] ?>" required></td>
					
					
				</tr>
				<tr>
					<td>Kode Barang</td>							
							<td><select class="form-control" name="kd_brg">
								<?php 
								$brg=mysql_query("select * from barang");
								while($b=mysql_fetch_array($brg)){
									$s=$b['kd_barang'];
									?>	
									<option <?php if( $s==$l) {echo "selected"; } ?> value="<?php echo $b['kd_barang']; ?>"><?php echo $b['kd_barang'] ?>| <?php echo $b['nama_barang'] ?> </option>
									<?php 
								}
								?>
							</select></td>

				</tr>
				<tr>
					<td><label>Nama Barang </label></td>
					<td><input name="nama_b" type="text" class="form-control" value="<?php echo $r['nama_brg'] ?>"  required></td>
					
				</tr>
				<tr>
					<td><label>Jumlah </label></td>
					<td><input name="jumlah" type="number" class="form-control" onFocus="startCalc();" onBlur="stopCalc();" value="<?php echo $r['jumlah'] ?>" required></td>
					
				</tr>
				<tr>
					<td><label>Harga</label></td>
					<td><input name="harga" type="number" class="form-control" onFocus="startCalc();" onBlur="stopCalc();" value="<?php echo $r['harga'] ?>" required></td>			
				</tr>
				<tr>
					<td><label>Total </label></td>
					<td><input name="total" type="number" class="form-control" onchange='tryNumberFormat(this.form.thirdBox);' value="<?php echo $r['total'] ?>" ></td>			
				</tr>
					
					</table>
			<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" name="edit" class="btn btn-info" value="Edit">
				</div>
		</table>
	</form>
<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>