<?php

session_start();

require_once "config.php";
require 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');

if (isset($_POST['submit'])) {
    $file_ext_name = $_POST['export-data'];
    $file_name = "datatrx";
    $dataquery = "SELECT usertrx.id, usertrx.userid, user.username, usertrx.trx, usertrx.trxdate FROM usertrx INNER JOIN user on user.id = usertrx.userid";
    $data = mysqli_query($conn, $dataquery);

    if (mysqli_num_rows($data) > 0) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID Transaksi');
        $sheet->setCellValue('B1', 'ID User');
        $sheet->setCellValue('C1', 'Username');
        $sheet->setCellValue('D1', 'Jumlah Transaksi');
        $sheet->setCellValue('E1', 'Tgl Transaksi');

        $rowdata = 2;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowdata, $row['id']);
            $sheet->setCellValue('B' . $rowdata, $row['userid']);
            $sheet->setCellValue('C' . $rowdata, $row['username']);
            $sheet->setCellValue('D' . $rowdata, $row['trx']);
            $sheet->setCellValue('E' . $rowdata, $row['trxdate']);
            $rowdata++;
        }

        if ($file_ext_name == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
            $final_file_name = $file_name . '.xlsx';
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attactment; filename ="' . urlencode($final_file_name) . '"');
        $writer->save('php://output');
    }
}
