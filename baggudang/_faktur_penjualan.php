<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from penjualan");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['p'])) ? (int)$_GET['p'] : 1;
$start = ($page - 1) * $per_hal;
?>


<center><h3><span class="glyphicon glyphicon-list-alt"></span>  Faktur Penjualan</h3></center>

<br/>
<form action="cari_act.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari No Faktur .." aria-describedby="basic-addon1" name="faktur">	
	</div>
</form>
<br>
<?php 
if(isset($_GET['cari'])){
	$cari=mysql_real_escape_string($_GET['cari']);
	$tg="_cl_faktur.php?fak=$cari";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a><?php
}else{
	$tg="lap_barang_laku.php";
}
?>
<br>
<table class="table table-striped table-bordered table-responsive">
	<tr class="info">
		<th class="col-md-1" style="width: 10px;" >No</th>
		
		<th class="col-md-1" style="width: 10px;">NO Faktur</th>
		<th class="col-md-1" style="width: 10px;" >Tgl F</th>
		<th class="col-md-2" style="width: 10px;">Kode barang</th>
		<th class="col-md-2" style="width: 10px;">Nama Barang</th>
		<th class="col-md-1" style="width: 10px;">Jumlah</th>
		<th class="col-md-2" style="width: 10px;">Harga</th>
		<th class="col-md-2" style="width: 10px;">Total</th>
	
	</tr>
	 <?php
	 if(isset($_GET['cari'])){
		$cari=mysql_real_escape_string($_GET['cari']);
		$view=mysql_query("select * from penjualan where no_faktur like '$cari'");
		}else{
		$view=mysql_query("select * from penjualan order by no_faktur asc ");
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
			<td><?php echo $row['no_faktur'] ?></td>
			<td><?php echo $row['tgl_faktur'] ?></td>
			<td><?php echo $row['kd_barang'] ?></td>
			<td><?php echo $row['nama_brg'] ?></td>
			<td><?php echo $row['jumlah'] ?></td>
			<td>Rp.<?php echo $harga_a; ?>-,</td>
			<td>Rp.<?php echo $total_a; ?>-,</td>

			
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