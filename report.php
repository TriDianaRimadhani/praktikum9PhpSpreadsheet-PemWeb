<?php
//memasukkan file dari luar yaitu file dari library PhpSpreasheet
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//mendeklarasikan variabel 
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
//mengatur isi tabel
$sheet->setCellValue('A1','Hello World !');
//menyimpan data pada file xlsx
$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');
?>