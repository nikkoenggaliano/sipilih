<?php 
require 'vendor/autoload.php';

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$reader->setReadDataOnly(true);
$spreadsheet = $reader->load("template.xlsx");
$sheetData = $spreadsheet->getActiveSheet()->toArray();
print_r($sheetData);