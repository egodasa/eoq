
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from pembelian");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['p'])) ? (int)$_GET['p'] : 1;
$start = ($page - 1) * $per_hal;
?>


<center><h3><span class="glyphicon glyphicon-list-alt"></span> Laporan Pembelian Barang</h3></center>
<br>
<br/>
<form action="cari_tgl.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tanggalp" class="form-control" onchange="this.form.submit()">
			<option>Pilih tanggal ..</option>
			<?php 
			$pil=mysql_query("select distinct tgl_transaksi from pembelian order by tgl_transaksi desc");
			while($p=mysql_fetch_array($pil)){
				?>
				<option><?php echo $p['tgl_transaksi'] ?></option>
				<?php
			}
			?>			
		</select>
	</div>

</form>
<br>
<?php 
if(isset($_GET['tanggal'])){
	$tanggal=mysql_real_escape_string($_GET['tanggal']);
	$tg="_cl_pembelian_barang.php?tanggal=$tanggal";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a><?php
}else{
	$tg="lap_barang_laku.php";
}
?>
<table class="table table-striped table-bordered table-responsive">
	<tr class="info">
		<th class="col-md-1" style="width: 10px;" >No</th>
		<th class="col-md-1" style="width: 10px;">Tgl Transaksi</th>
		<th class="col-md-1" style="width: 10px;">No. Transaksi</th>
		<th class="col-md-2" style="width: 10px;">Kode barang</th>
		<th class="col-md-2" style="width: 10px;">Nama Barang</th>
		<th class="col-md-1" style="width: 10px;">Jumlah</th>
		<th class="col-md-2" style="width: 10px;">Harga</th>
		<th class="col-md-2" style="width: 10px;">Total</th>
		
		
	</tr>
	 <?php
	 if(isset($_GET['tanggal'])){
		$tanggal=mysql_real_escape_string($_GET['tanggal']);
		$view=mysql_query("select * from pembelian where tgl_transaksi like '$tanggal' order by tgl_transaksi asc");
	}else{
		$view=mysql_query("select * from pembelian order by tgl_transaksi asc ");
	}
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
		</tr>
		<?php
	}
	?>
<tr>
		<td colspan="7">Total </td>

		<td>			
		<?php 
		
			$x=mysql_query("select sum(total) as total2 from pembelian");	
			$xx=mysql_fetch_array($x);
			$xx3=$xx['total2'];		
			echo "<b> Rp.". number_format($xx3,2,",",".").",-</b>";		
		?>
		</td>
	</tr>
</table>
<ul class="pagination">			
			<?php 
			for($x=1;$x<=$halaman;$x++){
				?>
				<li><a href="?page=_pembelian_barang&p=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>						
		</ul>