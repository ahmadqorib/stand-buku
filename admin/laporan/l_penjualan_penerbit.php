<?php
session_start();
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
if($_POST['pen']==""){
	$pdf->Cell(190,7,'Seluruh Penerbit',0,1,'C');
}else{
	$pdf->Cell(190,7,'Penerbit '.$_POST['pen'],0,1,'C');
}
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'HIMPUNAN MAHASISWA JURUSAN TEKNIK INFORMATIKA',0,1,'C');
$pdf->Cell(190,7,'STMIK AKAKOM YOGYAKARTA',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No.',1,0,'C');
$pdf->Cell(55,6,'No Penjualan',1,0);
$pdf->Cell(55,6,'Tanggal',1,0);
$pdf->Cell(55,6,'Waktu',1,1);

$pdf->SetFont('Arial','',10);

include '../../confiq/koneksi.php';
$penjualan = mysqli_query($kon, "select * from data_penjualan_penerbit where penerbit like '%$_POST[pen]%' group by id_penjualan");
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
	$pdf->Cell(55,6,$r['id_penjualan'],1,0);
	$pdf->Cell(55,6,$hasiltgl,1,0);
	$pdf->Cell(55,6,$r['waktu'],1,1);

	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(50,6,'Judul Buku',0,0);
	$pdf->Cell(10,6,'Qty',0,0);
	$pdf->Cell(25,6,'Harga',0,0);
	$pdf->Cell(15,6,'Diskon',0,0);
	$pdf->Cell(40,6,'Harga Setelah Diskon',0,0);
	$pdf->Cell(25,6,'Total',0,1);

	$detail = mysqli_query($kon, "select * from data_penjualan_penerbit where id_penjualan = '$r[id_penjualan]' and penerbit like '%$_POST[pen]%'");
	$tohar = 0;
	while($rw=mysqli_fetch_array($detail)){
		$hsd = $rw['harga'] - ($rw['harga'] * $rw['diskon'] / 100);
		$total = $rw['qty'] * $hsd;
		$topen = $topen + $total;
		$jumlah = $jumlah + $rw['qty'];

		$pdf->SetFont('Arial','',9);
		$pdf->Cell(10,6,'',0,0);
		$pdf->Cell(50,6,$rw['judul_buku'],0,0);
		$pdf->Cell(10,6,$rw['qty'],0,0);
		$pdf->Cell(25,6,"Rp ".number_format($rw['harga'],0,",","."),0,0);
		$pdf->Cell(15,6,$rw['diskon']." %");
		$pdf->Cell(40,6,"Rp ".number_format($hsd,0,",","."),0,0);
		$pdf->Cell(25,6,"Rp ".number_format($total,0,",","."),0,1);

		$tohar = $tohar + $total;
	}
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(50,6,'Total Harga :',0,0);
	$pdf->Cell(90,6,'',0,0);
	$pdf->Cell(25,6,"Rp ".number_format($tohar,0,",","."),0,1);

	$pdf->Cell(10,2,'',0,1);
    $no++;
}
$pdf->Cell(90,40,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,6,'Total Buku Terjual',0,0);
$pdf->Cell(20,6,':',0,0);
$pdf->Cell(90,6,'',0,0);
$pdf->Cell(36,6,$jumlah,0,1);

$pdf->Cell(40,6,'Total Pendapatan',0,0);
$pdf->Cell(20,6,':',0,0);
$pdf->Cell(90,6,'',0,0);
$pdf->Cell(36,6,"Rp ".number_format($topen,0,",","."),0,1);
$pdf->Output();

