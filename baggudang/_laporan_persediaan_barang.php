<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from barang");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['p'])) ? (int)$_GET['p'] : 1;
$start = ($page - 1) * $per_hal;
?>
<center><h3><span class="glyphicon glyphicon-list-alt"></span>  Laporan Persediaan Barang</h3></center>
<a href="cetak_laporan.php" onclick="window.open('_cl_persediaan.php', 'newwindow', 'width=1000, height=1200'); return false;" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-print"></span> cetak laporan</a></button>
<br>
<br>
<br/>

<br/>
<table class="table table-striped table-bordered table-responsive">
	<tr class="info">
		<th class="col-md-1" style="width: 10px;" >No</th>
		
		<th class="col-md-1" style="width: 100px;">Kode Barang</th>
		<th class="col-md-2">Nama Barang</th>
		<th class="col-md-2">Supplier</th>
		<th class="col-md-2">Harga Beli</th>
		<th class="col-md-2">Harga Jual</th>
		<th class="col-md-1">Stok Awal</th>
		<th class="col-md-1">Stok Akhir</th>
	</tr>
	  <?php
	   if(isset($_GET['cari'])){
		$cari=mysql_real_escape_string($_GET['cari']);
		$view=mysql_query("select * from barang where kd_barang like '$cari'");
		}else{
		$view=mysql_query("select * from barang order by kd_barang asc ");
	}
	
		$no=1;
			while($row=mysql_fetch_array($view)){
				$harga = $row['hrg_beli'];
				$harga_a = number_format($harga,2,",",".");
				$total = $row['hrg_jual'];
				$total_a = number_format($total,2,",",".");
           
						
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $row['kd_barang'] ?></td>
			<td><?php echo $row['nama_barang'] ?></td>
			<td><?php echo $row['nm_supp'] ?></td>
			<td>Rp.<?php echo $harga_a; ?>-,</td>
			<td>Rp.<?php echo $total_a; ?>-,</td>
			<td><?php echo $row['stok'] ?></td>
			
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
