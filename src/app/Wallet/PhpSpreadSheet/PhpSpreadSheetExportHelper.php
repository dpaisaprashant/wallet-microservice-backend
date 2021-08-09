<?php
namespace App\Wallet\PhpSpreadSheet;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class PhpSpreadSheetExportHelper
{

    public function ExportToExcel(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $drawing = new Drawing();
        $sheet->mergeCells("A1:J4");
        $drawing->setName('Company Logo');
        $drawing->setDescription('Company logo image');
        $drawing->setPath(public_path('img/logo.png'));
        $drawing->setWidth(100);
        $drawing->setHeight(40);
        $drawing->setCoordinates('A1');
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        //TITLE
        $sheet->setCellValue('A5', 'Pre-Transaction Report');
        $sheet->getStyle('A5')->getFont()->setBold(1)->setSize(16);
        $sheet->mergeCells("A5:J5");


        // setting up loop parameters
        $rowNumber = 6;
        $filteringData = request()->get();
        $dataCount = count($filteringData);
        $ArrayCount = 0;
        $CellNames = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');


        foreach ($filteringData as $key=>$value){

        }



    }

}
