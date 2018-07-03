<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Barang</h3>
<a class="btn" href="?page=data_barang"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$sql = mysql_query("select * from barang where kd_barang='$_GET[kd]'");
	$r = mysql_fetch_array($sql);
?>					
	<form action="?page=data_barang" method="post">
		<table class="table">
				<tr>
					<td><label>Kode Barang</label></td>
					<td><input name="kd_barang" type="text" class="form-control" value="<?php echo $r['kd_barang'] ?>" readonly></td>
					
				</tr>
				<tr>
					<td><label>Kode Barang</label></td>
					<td><input name="nm_supp" type="text" class="form-control" value="<?php echo $r['nm_supp'] ?>" readonly></td>
					
				</tr>
				<tr>
					<td><label>Nama Barang</label></td>
					<td><input name="nama_barang" type="text" class="form-control" value="<?php echo $r['nama_barang'] ?>"></td>
					
				</tr>
				<tr>
					<td><label>Harga Beli</label></td>
					<td><input name="hrg_beli" type="text" class="form-control" value="<?php echo $r['hrg_beli'] ?>"></td>
					
				</tr>
				<tr>
					<td><label>Harga Jual</label></td>
					<td><input name="hrg_jual" type="text" class="form-control" value="<?php echo $r['hrg_jual'] ?>"></td>
					
				</tr>
				<tr>
					<td><label>Stok</label></td>
					<td><input name="stok" type="number" class="form-control" value="<?php echo $r['stok'] ?>"></td>
				</tr>
                <tr>
					<td><label>Biaya Pesan</label></td>
					<td><input name="biaya_p"  type="text" class="form-control" value="<?php echo $r['biaya_pesan'] ?>" required></td>
				</tr>
				<tr>
					<td><label>Biaya Simpan</label></td>
					<td><input name="biaya_s" type="text" class="form-control" value="<?php echo $r['biaya_simpan'] ?>" required></td>
				</tr>
				<tr>
					<td><label>Lead Time</label></td>
					<td><input name="lead_t" type="text" class="form-control" value="<?php echo $r['lead_time'] ?>" required></td>
				</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="edit" class="btn btn-info" value="Edit"></td>
			</tr>
		</table>
	</form>
