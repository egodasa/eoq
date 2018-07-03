<?php
		include '../config.php';
		$data = explode(" ",$_POST['tgl_transaksi']);
		$sql="select sum(jumlah) as jumlah from penjualan where month(tgl_faktur) = ".$data[0]." and kd_barang = '".$_POST['kd_barang']."' and year(tgl_faktur) = $data[1]";
        $response = array(); // siapkan respon yang nanti akan di convert menjadi JSON
		$query = mysql_query($sql);		
		if($query){
			if(mysql_num_rows($query) > 0){
				while($row = mysql_fetch_object($query)){
					// masukan setiap baris data ke variable respon
					$response[] = $row; 
				}
			}else{
				$response['error'] = 'Data kosong'; // memberi respon ketika data kosong
			}
		}else{
			$response['error'] = mysql_error(); // memberi respon ketika query salah
		}
		die(json_encode($response)); // convert variable respon menjadi JSON, lalu tampilkan 
	
?>
