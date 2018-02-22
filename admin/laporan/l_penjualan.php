<?php
// memanggil library FPDF
require('../fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF('P','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
$pdf->Cell(10,10,'',0,1);
// mencetak string 
$pdf->Cell(190,7,'LAPORAN HASIL PENJUALAN BUKU',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'HIMPUNAN MAHASISWA JURUSAN TEKNIK INFORMATIKA',0,1,'C');
$pdf->Cell(190,7,'STMIK AKAKOM YOGYAKARTA',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No.',1,0,'C');
$pdf->Cell(50,6,'No Penjualan',1,0);
$pdf->Cell(50,6,'Tanggal',1,0);
$pdf->Cell(50,6,'Waktu',1,1);

$pdf->SetFont('Arial','',10);

include '../../confiq/koneksi.php';
$penjualan = mysqli_query($kon, "select id_penjualan, tgl, waktu, sum(total) as tot from data_penjualan group by id_penjualan");
$topen = 0;
$jumlah = 0;
$no = 1;
while ($r = mysqli_fetch_array($penjualan)){
	$bulanind = array("Januari", "February", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$tahun = substr($r['tgl'], 0, 4);
	$bulan = substr($r['tgl'], 5, 2);
	$hari = substr($r['tgl'], 8, 2);
	$hasiltgl = $hari." ".$bulanind[(int)$bulan-1]." ".$tahun;
    $pdf->Cell(10,6,$no,1,0,'C');
	$pdf->Cell(50,6,$r['id_penjualan'],1,0);
	$pdf->Cell(50,6,$hasiltgl,1,0);
	$pdf->Cell(50,6,$r['waktu'],1,1);

	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(50,6,'Judul Buku',0,0);
	$pdf->Cell(28,6,'Qty',0,0);
	$pdf->Cell(36,6,'Harga Jual',0,0);
	$pdf->Cell(36,6,'Total',0,1);

	$topen = $topen + $r['tot'];

	$pdf->SetFont('Arial','',10);
	$detail = mysqli_query($kon, "select * from data_penjualan where id_penjualan = '$r[id_penjualan]'");
	$tohar = 0;
	while($rw=mysqli_fetch_array($detail)){
		$pdf->Cell(10,6,'',0,0);
		$pdf->Cell(50,6,$rw['judul_buku'],0,0);
		$pdf->Cell(28,6,$rw['qty'],0,0);
		$pdf->Cell(36,6,"Rp ".number_format($rw['harga'],0,",","."),0,0);
		$pdf->Cell(36,6,"Rp ".number_format($rw['total'],0,",","."),0,1);

		$tohar = $tohar + $rw['total'];
		$jumlah = $jumlah + $rw['qty'];
	}
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(50,6,'Total Harga :',0,0);
	$pdf->Cell(64,6,'',0,0);
	$pdf->Cell(36,6,"Rp ".number_format($tohar,0,",","."),0,1);

	$pdf->Cell(10,2,'',0,1);
    $no++;
}
$pdf->SetFont('Arial','B',10);
$pdf->Cell(64,30,'',0,1);

$pdf->Cell(40,6,'Total Buku Terjual',0,0);
$pdf->Cell(20,6,':',0,0);
$pdf->Cell(64,6,'',0,0);
$pdf->Cell(36,6,$jumlah,0,1);

$pdf->Cell(40,6,'Total Pendapatan',0,0);
$pdf->Cell(20,6,':',0,0);
$pdf->Cell(64,6,'',0,0);
$pdf->Cell(36,6,"Rp ".number_format($topen,0,",","."),0,1);
$pdf->Output();

