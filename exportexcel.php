<?php
//memasukkan file dari luar yaitu file dari library PhpSpreasheet dan file koneksi ke database
include ('koneksidb2.php');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//mendeklarasikan variabel 
$spreadsheet =  new Spreadsheet();
$sheet = $spreadsheet->getActivesheet();
//mengatur isi tabel
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Jenis Pendaftaran');
$sheet->setCellValue('C1', 'Tanggal Masuk');
$sheet->setCellValue('D1', 'NIS');
$sheet->setCellValue('E1', 'Nomor Peserta');
$sheet->setCellValue('F1', 'Pernah/Tidak pernah PAUD');
$sheet->setCellValue('G1', 'Pernah/Tidak pernah TK');
$sheet->setCellValue('H1', 'Nomer Seri SKHUN');
$sheet->setCellValue('I1', 'Nomer Seri Ijazah');
$sheet->setCellValue('J1', 'Hobi');
$sheet->setCellValue('K1', 'Cita-cita');
$sheet->setCellValue('L1', 'Nama');
$sheet->setCellValue('M1', 'Jenis Kelamin');
$sheet->setCellValue('N1', 'NISN');
$sheet->setCellValue('O1', 'NIK');
$sheet->setCellValue('P1', 'Tempat Lahir');
$sheet->setCellValue('Q1', 'Tanggal Lahir');
$sheet->setCellValue('R1', 'Agama');
$sheet->setCellValue('S1', 'Berkebutuhan Khusus');
$sheet->setCellValue('T1', 'Alamat Jalan');
$sheet->setCellValue('U1', 'RT');
$sheet->setCellValue('V1', 'RW');
$sheet->setCellValue('W1', 'Dusun');
$sheet->setCellValue('X1', 'Kelurahan/Desa');
$sheet->setCellValue('Y1', 'Kecamatan');
$sheet->setCellValue('Z1', 'Kode Pos');
$sheet->setCellValue('AA1', 'Tempat Tinggal');
$sheet->setCellValue('AB1', 'Transportasi');
$sheet->setCellValue('AC1', 'No. HP');
$sheet->setCellValue('AD1', 'No. Telepon');
$sheet->setCellValue('AE1', 'Email');
$sheet->setCellValue('AF1', 'Penerima KPS/PKH/KIP');
$sheet->setCellValue('AG1', 'NO. KPS/PKH/KIP');
$sheet->setCellValue('AH1', 'Kewarganegaraan');
$sheet->setCellValue('AI1', 'Negara');

//mengirim statement pada database untuk mengambil query
$query = mysqli_query($koneksi,"select * from data_pribadi");
$i= 2;
$no = 1;
//mengambil data dari database dan memasukkan ke dalam tabel spreadsheet
while ($row = mysqli_fetch_array($query)) {
    $sheet->setCellValue('A'.$i, $no++);
    $sheet->setCellValue('B'.$i, $row['jenis_pendaftaran']);
    $sheet->setCellValue('C'.$i, $row['tgl_masuk']);
    $sheet->setCellValue('D'.$i, $row['nis']);
    $sheet->setCellValue('E'.$i, $row['nomor_peserta']);
    $sheet->setCellValue('F'.$i, $row['pernah_paud']);
    $sheet->setCellValue('G'.$i, $row['pernah_tk']);
    $sheet->setCellValue('H'.$i, $row['noseri_skhun']);
    $sheet->setCellValue('I'.$i, $row['noseri_ijasah']);
    $sheet->setCellValue('J'.$i, $row['hobi']);
    $sheet->setCellValue('K'.$i, $row['cita']);
    $sheet->setCellValue('L'.$i, $row['nama']);
    $sheet->setCellValue('M'.$i, $row['jenis_kel']);
    $sheet->setCellValue('N'.$i, $row['nisn']);
    $sheet->setCellValue('O'.$i, $row['nik']);
    $sheet->setCellValue('P'.$i, $row['tempat_lahir']);
    $sheet->setCellValue('Q'.$i, $row['tgl_lahir']);
    $sheet->setCellValue('R'.$i, $row['agama']);
    $sheet->setCellValue('S'.$i, $row['kebutuhan_khusus']);
    $sheet->setCellValue('T'.$i, $row['alamat_jln']);
    $sheet->setCellValue('U'.$i, $row['rt']);
    $sheet->setCellValue('V'.$i, $row['rw']);
    $sheet->setCellValue('W'.$i, $row['dusun']);
    $sheet->setCellValue('X'.$i, $row['kel_desa']);
    $sheet->setCellValue('Y'.$i, $row['kecamatan']);
    $sheet->setCellValue('Z'.$i, $row['kode_pos']);
    $sheet->setCellValue('AA'.$i, $row['tinggal']);
    $sheet->setCellValue('AB'.$i, $row['transportasi']);
    $sheet->setCellValue('AC'.$i, $row['no_hp']);
    $sheet->setCellValue('AD'.$i, $row['no_telp']);
    $sheet->setCellValue('AE'.$i, $row['email']);
    $sheet->setCellValue('AF'.$i, $row['kartu']);
    $sheet->setCellValue('AG'.$i, $row['no_kartu']);
    $sheet->setCellValue('AH'.$i, $row['kewarganegaraan']);
    $sheet->setCellValue('AI'.$i, $row['negara']);
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
$sheet->getStyle('A1:AI'.$i)->applyFromArray($styleArray);

//menyimpan data pada file xlsx
$writer = new Xlsx($spreadsheet);
$writer->save('Export Pendaftaran Siswa.xlsx');
?>