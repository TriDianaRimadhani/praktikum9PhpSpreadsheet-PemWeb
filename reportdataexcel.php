<?php
//memasukkan file dari luar yaitu file dari library PhpSpreasheet dan file koneksi pada database
include ('koneksi.php');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//mendeklarasikan variabel 
$spreadsheet =  new Spreadsheet();
$sheet = $spreadsheet->getActivesheet();
//mengatur isi tabel
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Kelas');
$sheet->setCellValue('D1', 'Alamat');

//mengirim statement pada database untuk mengambil query
$query = mysqli_query($koneksi,"select * from tb_siswa");
$i= 2;
$no = 1;
//mengambil data dari database dan memasukkan ke dalam tabel spreadsheet
while ($row = mysqli_fetch_array($query)) {
    $sheet->setCellValue('A'.$i, $no++);
    $sheet->setCellValue('B'.$i, $row['nama']);
    $sheet->setCellValue('C'.$i, $row['kelas']);
    $sheet->setCellValue('D'.$i, $row['alamat']);
    $i++;
}

//membuat border tabel
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];
$i = $i-1;
//menerapkan style membuat border
$sheet->getStyle('A1:D'.$i)->applyFromArray($styleArray);

//menyimpan data pada file xlsx
$writer = new Xlsx($spreadsheet);
$writer->save('Report Data Siswa.xlsx');
?>