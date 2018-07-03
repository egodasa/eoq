<?php
include '../config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',20);
$pdf->Image('../foto/logo.png',3,1,4,2);
$pdf->SetX(10.8);            
$pdf->MultiCell(19.5,0.5,'Toko Amsterdam Game Shop',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'',0,'L');    
$pdf->SetFont('Times','B',10);
$pdf->SetX(9.5);
$pdf->MultiCell(19.5,0.5,'JL. Raya Balai Tangah - Sitangkai KM.1 Kapalo Labuah Tepi Selo - Lintau',0,'L');
$pdf->SetX(112.8);
$pdf->MultiCell(19.5,0.5,'Kecamatan Lintau Buo Utara',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(23.5,0.7,"Laporan Pembelian Barang",0,10,'C');
$pdf->ln(1);
$pdf->SetX(11.5);
$pdf->SetFont('Times','B',10);

$pdf->ln(0);
$pdf->Cell(23.5,0.7,"Tanggal Transaksi : ".$_GET['tanggal'],0,0,'C');
$pdf->ln(1);
$pdf->SetX(3);
$pdf->SetFont('Times','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Kode Barang', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Jumlah', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Harga', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Total', 1, 1, 'C');
$pdf->SetFont('Times','',10);
$no=1;
     if(isset($_GET['tanggal'])){
        $cari=mysql_real_escape_string($_GET['tanggal']);
        $view=mysql_query("select * from pembelian where tgl_transaksi like '$cari' order by tgl_transaksi");

        $no=1;
            while($row=mysql_fetch_array($view)){
                $harga = $row['harga'];
                $harga_a = number_format($harga,2,",",".");
                $total = $row['total'];
                $total_a = number_format($total,2,",",".");


     $pdf->SetX(3);
    $pdf->Cell(1, 0.8, $no++ , 1, 0, 'C');
    $pdf->Cell(4, 0.8, $row['kd_barang'],1, 0, 'L');
    $pdf->Cell(6, 0.8, $row['nama_brg'], 1, 0,'L');
    $pdf->Cell(3, 0.8, $row['jumlah'],1, 0, 'C');
     $pdf->Cell(4, 0.8,"Rp.". $harga_a."-,",1, 0, 'C');
    $pdf->Cell(4, 0.8, "Rp.". $total_a."-," , 1, 1,'C');


  
}
}
if(isset($_GET['tanggal'])){
            $x=mysql_query("select sum(total) as total2 from pembelian where tgl_transaksi='$cari' "); 
            $xx=mysql_fetch_array($x);
            $xx3=number_format($xx['total2'],2,",","."); 
$pdf->Cell(30,0.7,"Total Bayar : ",0,0,'C');
$pdf->SetX(21);
$pdf->Cell(4, 0.8, "Rp.". $xx3 ."-,", 1, 1,'C');
}
$pdf->ln(3);
$pdf->SetX(17.7);
$pdf->Cell(5,2,"Lintau Buo Utara, ".date("d/m/Y"),0,0,'C');
$pdf->ln(2);
$pdf->SetX(18);
$pdf->Cell(5,2,'Pimpinan Toko',0,0,'C');

$pdf->Output("laporan.pdf","I");

?>

