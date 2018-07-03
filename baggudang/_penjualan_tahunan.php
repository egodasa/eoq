
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from penjualan");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['p'])) ? (int)$_GET['p'] : 1;
$start = ($page - 1) * $per_hal;
?>

<center><h3><span class="glyphicon glyphicon-list-alt"></span>  Laporan Penjualan Tahunan</h3></center>

<br/>
<form action="cari_bulan.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tahun" class="form-control" onchange="this.form.submit()">
			<option>Pilih Tahun ..</option>
				<?php

				$view2=mysql_query("select tgl_faktur from penjualan where year(tgl_faktur) GROUP BY year(tgl_faktur) ");		
					while($row2=mysql_fetch_array($view2)){ 
						$th=substr($row2['tgl_faktur'],0,4);?>
										    
					    <option value="<?php echo $th; ?>"><?php echo $th; ?></option>
					   <?php
					}
					?>		
		</select>
	</div>

</form>
<br>
<?php 
if(isset($_GET['tahun'])){
	$tahun=mysql_real_escape_string($_GET['tahun']);
	$tg="_cl_penjualan_tahunan.php?tahun=$tahun";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a><?php
}else{
	$tg="lap_barang_laku.php";
}
?>
	 <?php
	 if(isset($_GET['tahun'])){
	 	?>
<br/>
<table class="table table-striped table-bordered table-responsive">
	<tr class="info">
		<th class="col-md-1" style="width: 10px;" >No</th>
		<th class="col-md-1" style="width: 10px;" >Bulan</th>
		<th class="col-md-1" style="width: 10px;">Penjualan</th>

		
	</tr>
	
	 <?php
	 
		$tahun=mysql_real_escape_string($_GET['tahun']);
		$view=mysql_query("select tgl_faktur, SUM(total)AS total from penjualan where year(tgl_faktur)='$tahun' GROUP BY month(tgl_faktur), DATE_FORMAT(`tgl_faktur`, '%M') ");
	
		$no=1;
			while($row=mysql_fetch_array($view)){ 
				$tgl = substr($row['tgl_faktur'],5,2);
				$total = $row['total'];
				$total_a = number_format($total,2,",",".");

						
            			

            				 if ($tgl=="01") {
								$bulan= "Januari"; 
							}elseif ($tgl=="02") {
								$bulan= "Februari";
							}elseif ($tgl=="03") {
								$bulan= "Maret";
							}elseif ($tgl=="04") {
								$bulan= "April";
							}elseif ($tgl=="05") {
								$bulan= "Mei";
							}elseif ($tgl=="06") {
								$bulan= "Juni";
							}elseif ($tgl=="07") {
								$bulan= "Juli";
							}elseif ($tgl=="08") {
								$bulan= "Agustus";
							}elseif ($tgl=="09") {
								$bulan= "September";
							}elseif ($tgl=="10") {
								$bulan= "Oktober";
							}elseif ($tgl=="11") {
								$bulan= "November";
							}elseif ($tgl=="12") {
								$bulan= "Desember";	
							}
							else{
								$bulan="";
							}
						

						
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $bulan; ?></td>
			<td><?php echo $total_a; ?></td>
			

			
		</tr>
		<?php
	}
	?>
	<tr><td colspan="2">Total </td>
		<td>			
		<?php 
			if(isset($_GET['tahun'])){
			$x=mysql_query("select sum(total) as total2 from penjualan where year(tgl_faktur)='$tahun' ");	
			$xx=mysql_fetch_array($x);
			$xx3=$xx['total2'];		
			echo "<b> Rp.". number_format($xx3,2,",",".").",-</b>";	
			} else {
			$x=mysql_query("select sum(total) as total2 from penjualan where year(tgl_faktur)");	
			$xx=mysql_fetch_array($x);
			$xx3=$xx['total2'];		
			echo "<b> Rp.". number_format($xx3,2,",",".").",-</b>";	
		}
		?>
		</td>
	</tr>

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
<?php  }?>