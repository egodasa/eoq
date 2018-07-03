<?php

$user=$_POST['user'];
$lama=$_POST['lama'];
$baru=$_POST['baru'];
$ulang=$_POST['ulang'];

$cek=mysql_query("select * from admin where password='$lama' and username='$user'");
if(mysql_num_rows($cek)==1){
	if($baru==$ulang){
		$b = $baru;
		mysql_query("update admin set password='$b' where username='$user'");
		?><script language="javascript">document.location.href="?page=ganti_pass&pesan=oke";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=ganti_pass&pesan=tdksama";</script><?php
		
	}
}else{
	?><script language="javascript">document.location.href="?page=ganti_pass&pesan=gagal";</script><?php

}

 ?>
