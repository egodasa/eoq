<?php
include '../config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',20);
$pdf->Image('../foto/tokoarena.png',3,1,4,2);
$pdf->SetX(12);            
$pdf->MultiCell(19.5,0.5,'Toko Arena',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(10.5);
$pdf->MultiCell(19.5,0.5,'JL. Imam Bonjol No. 64 Tlp 0752-82212',0,'L');
$pdf->SetX(12.5);
$pdf->MultiCell(19.5,0.5,'Padang Panjang',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(23.5,0.7,"Laporan EOQ",0,10,'C');
$pdf->ln(1);
$pdf->SetX(11.5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Tanggal : ".date("d/m/Y"),0,0,'C');
$pdf->ln(1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Tgl', 1, 0, 'C');
$pdf->Cell(2.3, 0.8, 'Kd barang', 1, 0, 'C');
$pdf->Cell(2.3, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(2.3, 0.8, 'Biaya Pesan', 1, 0, 'C');
$pdf->Cell(2.3, 0.8, 'Biaya Simpan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Lead Time', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'jumlah', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'kebutuhan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Interval', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Frekuensi', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'RQP', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'EOQ', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
     
      $view=mysql_query("select * from eoq order by tanggal");

        $no=1;
            while($row=mysql_fetch_array($view)){

    
    $pdf->Cell(1, 0.8, $no++ , 1, 0, 'C');
    $pdf->Cell(2, 0.8, $row['tanggal'],1, 0, 'L');
    $pdf->Cell(2.3, 0.8, $row['kd_barang'], 1, 0,'L');
    $pdf->Cell(2.3, 0.8, $row['nama_barang'],1, 0, 'L');
    $pdf->Cell(2.3, 0.8, $row['biaya_pesan'], 1, 0,'L');
    $pdf->Cell(2.3, 0.8, $row['biaya_simpan'],1, 0, 'L');
    $pdf->Cell(2, 0.8, $row['lead_time'], 1, 0,'C');
    $pdf->Cell(2, 0.8, $row['jumlah'],1, 0, 'C');
    $pdf->Cell(2, 0.8, $row['kebutuhan'], 1, 0,'C');
    $pdf->Cell(2, 0.8, $row['interv'],1, 0, 'C');
    $pdf->Cell(2, 0.8, $row['frekuensi'], 1, 0,'C');
    $pdf->Cell(2, 0.8, $row['rqp'],1, 0, 'C');
    $pdf->Cell(2, 0.8, $row['eoq'], 1, 1,'C');

  
}
$pdf->ln(3);
$pdf->SetX(17.7);
$pdf->Cell(5,2,"Padang Panjang, ".date("d/m/Y"),0,0,'C');
$pdf->ln(2);
$pdf->SetX(18);
$pdf->Cell(5,2,'Bagian Gudang',0,0,'C');

$pdf->Output("laporan.pdf","I");

?>

