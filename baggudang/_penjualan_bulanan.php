
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from penjualan");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['p'])) ? (int)$_GET['p'] : 1;
$start = ($page - 1) * $per_hal;
?>

<center><h3> <span class="glyphicon glyphicon-list-alt"></span> Laporan Penjualan Bulanan</h3></center>

<br/>
<form action="cari_bulan.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="bulan" class="form-control" onchange="this.form.submit()">
			<option>Pilih Bulan ..</option>
					
				<?php

				$view2=mysql_query("select tgl_faktur from penjualan where month(tgl_faktur) GROUP by month(tgl_faktur) asc");		
					while($row2=mysql_fetch_array($view2)){ 
						$tgl=substr($row2['tgl_faktur'],5,2);
						$th=substr($row2['tgl_faktur'],0,4);
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
                            }?>
										    
					    <option value="<?php echo $tgl; ?>&th=<?php echo $th; ?>"><?php echo $bulan; ?>-<?php echo $th; ?></option>
					   <?php
					}
					?>			
		</select>
	</div>

</form>
<br>
<?php 
if(isset($_GET['bulan'])){
	$bulan=mysql_real_escape_string($_GET['bulan']);
	$th=mysql_real_escape_string($_GET['th']);
	$tg="_cl_penjualan_bulanan.php?bulan=$bulan&th=$th";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a><?php
}else{
	$tg="lap_barang_laku.php";
}
?>
<br/>
<table class="table table-striped table-bordered table-responsive">
	<tr class="info">
		<th class="col-md-1" style="width: 10px;" >No</th>
		<th class="col-md-1" style="width: 10px;" >Tgl F</th>
		<th class="col-md-1" style="width: 10px;">NO Faktur</th>
		<th class="col-md-2" style="width: 10px;">Kode barang</th>
		<th class="col-md-2" style="width: 10px;">Nama Barang</th>
		<th class="col-md-1" style="width: 10px;">Jumlah</th>
		<th class="col-md-2" style="width: 10px;">Harga</th>
		<th class="col-md-2" style="width: 10px;">Total</th>
		
	</tr>
	 <?php
	 if(isset($_GET['bulan'])){
		$bulan=mysql_real_escape_string($_GET['bulan']);
		$th=mysql_real_escape_string($_GET['th']);
		$view=mysql_query("select * from penjualan where month(tgl_faktur)='$bulan' and year(tgl_faktur)='$th' order by tgl_faktur desc");
	}else{
		$view=mysql_query("select * from penjualan order by id_penjualan desc ");
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
			<td><?php echo $row['tgl_faktur'] ?></td>
			<td><?php echo $row['no_faktur'] ?></td>
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
			if(isset($_GET['bulan'])){
			$x=mysql_query("select sum(total) as total2 from penjualan where month(tgl_faktur)='$bulan' ");	
			$xx=mysql_fetch_array($x);
			$xx3=$xx['total2'];		
			echo "<b> Rp.". number_format($xx3,2,",",".").",-</b>";	
			} else {
			$x=mysql_query("select sum(total) as total2 from penjualan ");	
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