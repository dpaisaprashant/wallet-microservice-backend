<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\RequestInfo;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use \PhpOffice\PhpSpreadsheet\Cell\DataType;

class PhpSpreadSheetController extends Controller
{
    
   public function requestInfo(Request $request){
       
        $spreadsheet = new Spreadsheet();
        $Excel_writer = new Xlsx($spreadsheet);
        
        $spreadsheet->setActiveSheetIndex(0);      
        $activeSheet = $spreadsheet->getActiveSheet();

        //Logo
        $activeSheet->mergeCells("A1:J4");   

        // if(config('redirect.logo') == 'sajilopay'){
        //     $image =  public_path('img/sajilopay_logo.png');
        // } elseif(config('redirect.logo') == 'icash'){
        //     $image =  public_path('img/icash_logo.png');
        // } elseif(config('redirect.logo') == 'dpaisa') {
        //     $image =  public_path('img/dpaisa_logo.png');
        // } 

        $image =  public_path('img/logo.png');

        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath($image);
        $drawing->setHeight(70);
        $drawing->setCoordinates('A1');
        $drawing->setWorksheet($activeSheet);

        //Title
        $activeSheet->setCellValue('A5', 'Requests Info Report');
        $activeSheet->getStyle('A5')->getFont()->setBold(1)->setSize(16);
        $activeSheet->mergeCells("A5:J6");

        $activeSheet->setCellValue('A7', 'Filtered Options');
        $activeSheet->getStyle('A7')->getFont()->setBold(1)->setSize(12);
        $activeSheet->mergeCells("A7:B7");

        //Filtered Options
        $activeSheet->mergeCells("A8:B8");
        $activeSheet->mergeCells("C8:D8");
        $activeSheet->mergeCells("A9:B9");
        $activeSheet->mergeCells("C9:D9");
        $activeSheet->mergeCells("A10:B10");
        $activeSheet->mergeCells("C10:D10");
        $activeSheet->mergeCells("A11:B11");
        $activeSheet->mergeCells("C11:D11");
        $activeSheet->mergeCells("A12:B12");
        $activeSheet->mergeCells("C12:D12");
        $activeSheet->mergeCells("A13:B13");
        $activeSheet->mergeCells("C13:D13");
        $activeSheet->mergeCells("A14:B14");
        $activeSheet->mergeCells("C14:D14");
        $activeSheet->mergeCells("A15:B15");
        $activeSheet->mergeCells("C15:D15");
        $activeSheet->mergeCells("A16:B16");
        $activeSheet->mergeCells("C16:D16");


        $total = count($request->all());
        $test = $request->all();
        $filter_row_start = 'A8';
            
        if(count($test) > 0) {
            $filter = 8;
            foreach($test as $key=>$value){
                $activeSheet->setCellValue('A'.$filter , $key);
                $cellRange='A' .$filter. ':B'.$filter;
                $activeSheet->mergeCells($cellRange);
                $activeSheet->setCellValue('C'.$filter , $value);
                $filter++;
            }
        }
        
        foreach (range('A','J') as $col) {
            $activeSheet->getColumnDimension($col)->setAutoSize(true);
         }
       
        $activeSheet->setCellValue('A17', 'ID');
        $activeSheet->setCellValue('B17', 'Request ID');
        $activeSheet->setCellValue('C17', 'User ID');
        $activeSheet->setCellValue('D17', 'Description');
        $activeSheet->setCellValue('E17', 'Vendor');
        $activeSheet->setCellValue('F17', 'Service Type');
        $activeSheet->setCellValue('G17', 'Micro-Service Type');
        $activeSheet->setCellValue('H17', 'URL');
        $activeSheet->setCellValue('I17', 'Status');
        $activeSheet->setCellValue('J17', 'Date');
        $activeSheet->getStyle('A17')->getFont()->setBold(1)->setSize(12);
        $activeSheet->getStyle('B17')->getFont()->setBold(1)->setSize(12);
        $activeSheet->getStyle('C17')->getFont()->setBold(1)->setSize(12);
        $activeSheet->getStyle('D17')->getFont()->setBold(1)->setSize(12);
        $activeSheet->getStyle('E17')->getFont()->setBold(1)->setSize(12);
        $activeSheet->getStyle('F17')->getFont()->setBold(1)->setSize(12);
        $activeSheet->getStyle('G17')->getFont()->setBold(1)->setSize(12);
        $activeSheet->getStyle('H17')->getFont()->setBold(1)->setSize(12);
        $activeSheet->getStyle('I17')->getFont()->setBold(1)->setSize(12);
        $activeSheet->getStyle('J17')->getFont()->setBold(1)->setSize(12);    

        $query = RequestInfo::filter(request())->get();
        
        if($query->count() > 0) {
            $i = 18;
            foreach($query as $row){
                $activeSheet->setCellValue('A'.$i , $row['id']);
                $activeSheet->setCellValueExplicit('B'.$i , $row['request_id'], DataType::TYPE_STRING);
                $activeSheet->setCellValue('C'.$i , $row['user_id']);
                $activeSheet->setCellValue('D'.$i , $row['description']);
                $activeSheet->setCellValue('E'.$i , $row['vendor']);
                $activeSheet->setCellValue('F'.$i , $row['service_type']);
                $activeSheet->setCellValue('G'.$i , $row['microservice_type']);
                $activeSheet->setCellValue('H'.$i , $row['url']);
                $activeSheet->setCellValue('I'.$i , $row['status']);
                $activeSheet->setCellValue('J'.$i , $row['created_at']);
                $i++;
            }
        }
        
        $filename = 'request-info-TEST.xlsx';
        

        $Excel_writer->save($filename);
    }




//     public function requestInfo(){

//     $spreadsheet = new Spreadsheet();
//     $sheet = $spreadsheet->getActiveSheet();

//     $sheet->mergeCells("A1:J4");

//     // if(config('redirect.logo') == 'sajilopay'){
//     //     $image =  public_path('img/sajilopay_logo.png');
//     // } elseif(config('redirect.logo') == 'icash'){
//     //     $image =  public_path('img/icash_logo.png');
//     // } elseif(config('redirect.logo') == 'dpaisa') {
//     //     $image =  public_path('img/dpaisa_logo.png');
//     // }

//     $drawing = new Drawing();
//     $drawing->setName('Logo');
//     $drawing->setDescription('Logo');
//     // $drawing->setPath($image);
//     $drawing->setHeight(70);
//     $drawing->setCoordinates('A1');
//     $drawing->setWorksheet($sheet);

//     //TITLE
//     $sheet->setCellValue('A5', 'Request Infos Report');
//     $sheet->getStyle('A5')->getFont()->setBold(1)->setSize(16);
//     $sheet->mergeCells("A5:J5");

//     //DATES
//     if (isset($this->data[0]['created_at'])) {
//         $sheet->setCellValue('A7', 'From Date');
//         $sheet->getStyle('A7')->getFont()->setBold(1);
//         $sheet->setCellValue('B7', $this->data[0]['created_at']);
//     }

//     if (isset(end($this->data)['created_at'])) {
//         $sheet->setCellValue('C7', 'To Date');
//         $sheet->getStyle('C7')->getFont()->setBold(1);
//         $sheet->setCellValue('D7', end($this->data)['created_at']);
//     }

//     $sheet->setCellValue('A8', 'Generated On');
//     $sheet->getStyle('A8')->getFont()->setBold(1);
//     $sheet->setCellValue('B8', now()->toDateTimeString());

//     //GENERATED BY
//     $sheet->setCellValue('A9', 'Generate By');
//     $sheet->getStyle('A9')->getFont()->setBold(1);
//     $sheet->setCellValue('B9', auth()->user()->name . "(" . auth()->user()->mobile_no . ")");


//     $tableStartRow = 12;
//     $header = ['SN', 'Request ID', 'User ID', "Description", "Vendor", "Service Type", "Micro-Service Type", "URL", "Status", "Date", "Time"];
//     $sheet->fromArray([$header], null, 'A' . $tableStartRow);
//     $highestColumn = $sheet->getHighestColumn();
//     $sheet->getStyle('A'. $tableStartRow.':' . $highestColumn . $tableStartRow )->getFont()->setBold(1);

//     $sn = 1;
//     $rowIndex = $tableStartRow + 1;
//     // foreach ($this->data as $row) {
//     //     $balance = AmountConverter::paisaToRs($row["balance"]);
//     //     $debit = AmountConverter::paisaToRs($row["debit"]);
//     //     $credit = AmountConverter::paisaToRs($row["credit"]);
//     //     $amount = AmountConverter::paisaToRs($row["amount"]);
//     //     $date = explode(" ", date('Y-m-d H:i:s', strtotime($row['created_at'])));
//     //     $account = str_replace('977', '', $row["account"]);
//     //     $sheet->fromArray([$sn, $row['vendor'], $row['service_type'], $account, $debit, $credit, $amount, $balance, $date[0], $date[1]], null, 'A'.$rowIndex);
//     //     $sn++;
//     //     $rowIndex++;
//     // }

//     $sheet->getRowDimension(1)->setRowHeight(-1); //auto
//     $sheet->getColumnDimension('A')->setAutoSize(1); //auto
//     $cols = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
//     foreach ($cols as $col) {
//         $sheet->getColumnDimension($col)->setAutoSize(1); //auto
//     }

//     $maxCol = $sheet->getHighestColumn();
//     $maxRow = $sheet->getHighestRow();

//     /*$sheet->getStyle('A1:' . $maxCol.$maxRow)
//         ->getNumberFormat()
//         ->setFormatCode(NumberFormat::FORMAT_TEXT);*/

//     $filename = storage_path(self::STORAGE_UPLOAD_LOCATION . $this->generateName());

//     $writer = new Xls($spreadsheet);
//     $writer->save($filename);

//     return $filename;
// }
}
