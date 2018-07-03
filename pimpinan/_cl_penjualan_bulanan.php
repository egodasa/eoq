<?php
include '../config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',20);
$pdf->Image('../foto/logo.png',3,1,4,2);
$pdf->SetX(10);            
$pdf->MultiCell(19.5,0.5,'Toko Amsterdame Game Shop',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'',0,'L');    
$pdf->SetFont('Times','B',10);
$pdf->SetX(10.5);
$pdf->MultiCell(19.5,0.5,'JL. Lintau - Payakumbuh  No. 12 NoHp. 0823 8441 0506',0,'L');
$pdf->SetX(12.5);
$pdf->MultiCell(19.5,0.5,'Kecamatan Lintau Buo Utara',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(23.5,0.7,"Laporan Penjualan Bulanan",0,10,'C');
$pdf->ln(1);
$pdf->SetX(11.5);
$pdf->SetFont('Times','B',10);
$tgl= $_GET['bulan'];
$th= $_GET['th'];
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




$pdf->ln(1);
$pdf->Cell(23.5,0.7,"Bulan : ".$bulan."  Tahun : ".$th,0,0,'C');
$pdf->ln(1);
$pdf->SetX(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal Faktur', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Total', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
     if(isset($_GET['bulan'])){
        $cari=mysql_real_escape_string($_GET['bulan']);
        $view=mysql_query("select * from penjualan where month(tgl_faktur)='$cari' order by tgl_faktur");

        $no=1;
            while($row=mysql_fetch_array($view)){
                $harga = $row['harga'];
                $harga_a = number_format($harga,2,",",".");
                $total = $row['total'];
                $total_a = number_format($total,2,",",".");


     $pdf->SetX(10);
    $pdf->Cell(1, 0.8, $no++ , 1, 0, 'C');
    $pdf->Cell(4, 0.8, $row['tgl_faktur'],1, 0, 'L');
    $pdf->Cell(4, 0.8, "Rp.". $total_a."-," , 1, 1,'C');

}
}
if(isset($_GET['bulan'])){
            $x=mysql_query("select sum(total) as total2 from penjualan where month(tgl_faktur)='$cari' "); 
            $xx=mysql_fetch_array($x);
            $xx3=number_format($xx['total2'],2,",","."); 
$pdf->Cell(20,0.7,"Total : ",0,0,'C');
$pdf->SetX(15);
$pdf->Cell(4, 0.8, "Rp.". $xx3 ."-,", 1, 1,'C');
}
$pdf->ln(1);
$pdf->SetX(17.7);
$pdf->Cell(4,2,"Lintau Buo Utara, ".date("d/m/Y"),0,0,'C');
$pdf->ln(2);
$pdf->SetX(18);
$pdf->Cell(5,2,'Pimpinan Toko',0,0,'C');

$pdf->Output("laporan.pdf","I");

?>

