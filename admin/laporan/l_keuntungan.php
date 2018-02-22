<?php
// memanggil library FPDF
require('../fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
//$pdf = new FPDF('L','mm','A5');
$pdf=new FPDF('P','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
$pdf->Cell(10,10,'',0,1);
// mencetak string 
$pdf->Cell(190,7,'LAPORAN HASIL KEUNTUNGAN PENJUALAN BUKU',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'HIMPUNAN MAHASISWA JURUSAN TEKNIK INFORMATIKA',0,1,'C');
$pdf->Cell(190,7,'STMIK AKAKOM YOGYAKARTA',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No.',1,0,'C');
$pdf->Cell(60,6,'No Penjualan',1,0);
$pdf->Cell(57,6,'Tanggal',1,0);
$pdf->Cell(57,6,'Waktu',1,1);

include '../../confiq/koneksi.php';
$penjualan = mysqli_query($kon, "select * from data_keuntungan group by id_penjualan");
$token = 0;
$no = 1;
while ($r = mysqli_fetch_array($penjualan)){
	$bulanind = array("Januari", "February", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$tahun = substr($r['tgl'], 0, 4);
	$bulan = substr($r['tgl'], 5, 2);
	$hari = substr($r['tgl'], 8, 2);
	$hasiltgl = $hari." ".$bulanind[(int)$bulan-1]." ".$tahun;

	$pdf->SetFont('Arial','',10);
    $pdf->Cell(10,6,$no,1,0,'C');
	$pdf->Cell(60,6,$r['id_penjualan'],1,0);
	$pdf->Cell(57,6,$hasiltgl,1,0);
	$pdf->Cell(57,6,$r['waktu'],1,1);

	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(50,6,'Judul Buku',0,0);
	$pdf->Cell(10,6,'Qty',0,0);
	$pdf->Cell(30,6,'Harga',0,0);
	$pdf->Cell(30,6,'Harga Penerbit',0,0);
	$pdf->Cell(30,6,'Harga Jual',0,0);
	$pdf->Cell(30,6,'Keuntungan',0,1);
	
	$detail = mysqli_query($kon, "select * from data_keuntungan where id_penjualan = '$r[id_penjualan]'");
	$to_keuntungan = 0;
	while($rw=mysqli_fetch_array($detail)){
		$hdispen = $rw['harga'] - ($rw['harga'] * $rw['diskon_penerbit'] / 100);
		$keuntungan = $rw['qty'] * ($rw['harga_jual'] - $hdispen);
		$to_keuntungan = $to_keuntungan + $keuntungan;
		$token = $token + $keuntungan;

		$pdf->SetFont('Arial','',9);
		$pdf->Cell(10,6,'',0,0);
		$pdf->Cell(50,6,$rw['judul_buku'],0,0);
		$pdf->Cell(10,6,$rw['qty'],0,0);
		$pdf->Cell(30,6,"Rp ".number_format($rw['harga'],0,",","."),0,0);
		$pdf->Cell(30,6,"Rp ".number_format($hdispen,0,",","."),0,0);
		$pdf->Cell(30,6,"Rp ".number_format($rw['harga_jual'],0,",","."),0,0);
		$pdf->Cell(30,6,"Rp ".number_format($keuntungan,0,",","."),0,1);

	}
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(50,6,'Total Keuntungan :',0,0);
	$pdf->Cell(100,6,'',0,0);
	$pdf->Cell(30,6,"Rp ".number_format($to_keuntungan,0,",","."),0,1);

	$pdf->Cell(10,2,'',0,1);
    $no++;
}
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,30,'Total Keuntungan :',0,0);
$pdf->Cell(100,30,'',0,0);
$pdf->Cell(30,30,"Rp ".number_format($token,0,",","."),0,1);
$pdf->Output();

