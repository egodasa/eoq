<center><h3> List EOQ</h3></center>
<br/>
<a style="margin-bottom:10px" href="_cl_eoq.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a>
<br>
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
		<th class="col-md-2">Kebutuhan</th>
		<th class="col-md-2">Interval</th>
		<th class="col-md-2">frekuensi</th>
		<th class="col-md-2">RQP</th>
		<th class="col-md-2">EOQ</th>
		
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
			<td><?php echo $row['kebutuhan'] ?></td>
			<td><?php echo $row['interv'] ?></td>
			<td><?php echo $row['frekuensi'] ?></td>
			<td><?php echo $row['rqp'] ?></td>
			<td><?php echo $row['eoq'] ?></td>

			
		</tr>
		<?php
	}
	?>

</table>