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
use Illuminate\Support\Facades\Storage;
use App\Models\NPSAccountLinkLoad;

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
      
        $total = count($request->all());
        $test = $request->all();
            
        if(count($test) > 0) {
            $filter = 8;
            foreach($test as $key=>$value){
                $activeSheet->setCellValue('A'.$filter , $key);
                $cellRange='A' .$filter. ':B'.$filter;
                $activeSheet->mergeCells($cellRange);
                $activeSheet->setCellValue('C'.$filter , $value);
                $cell_Range='C' .$filter. ':D'.$filter;
                $activeSheet->mergeCells($cell_Range);
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

        $date = date('d-m-y-'.substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "requestInfo_".$date.".xlsx";
        $Excel_writer->save($filename);
        $content = file_get_contents($filename);
        header("Content-Disposition: attachment; filename=".$filename);
        unlink($filename);
        exit($content);
    }

    public function NPSAccountLinkLoad(Request $request){
     
       
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
        $activeSheet->setCellValue('A5', 'Load Wallet Report');
        $activeSheet->getStyle('A5')->getFont()->setBold(1)->setSize(16);
        $activeSheet->mergeCells("A5:J6");

        $activeSheet->setCellValue('A7', 'Filtered Options');
        $activeSheet->getStyle('A7')->getFont()->setBold(1)->setSize(12);
        $activeSheet->mergeCells("A7:B7");

        //Filtered Options
      
        $total = count($request->all());
        $test = $request->all();
            
        if(count($test) > 0) {
            $filter = 8;
            foreach($test as $key=>$value){
                $activeSheet->setCellValue('A'.$filter , $key);
                $cellRange='A' .$filter. ':B'.$filter;
                $activeSheet->mergeCells($cellRange);
                $activeSheet->setCellValue('C'.$filter , $value);
                $cell_Range='C' .$filter. ':D'.$filter;
                $activeSheet->mergeCells($cell_Range);
                $filter++;
            }
        }
        
        foreach (range('A','J') as $col) {
            $activeSheet->getColumnDimension($col)->setAutoSize(true);
         }
       
        $activeSheet->setCellValue('A17', 'ID');
        $activeSheet->setCellValue('B17', 'Amount');
        $activeSheet->setCellValue('C17', 'Gateway Transaction ID');
        $activeSheet->setCellValue('D17', 'Load Status');
        $activeSheet->setCellValue('E17', 'Load Time Stamp');
        $activeSheet->setCellValue('F17', 'Merchant Txn ID');
        $activeSheet->setCellValue('G17', 'Reference ID');
        $activeSheet->setCellValue('H17', 'User Phone Number');
        $activeSheet->setCellValue('I17', 'Linked Account ID');
        $activeSheet->setCellValue('J17', 'Created At');
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

        $query = NPSAccountLinkLoad::filter(request())->get();
        
        if($query->count() > 0) {
            $i = 18;
            foreach($query as $row){
                $activeSheet->setCellValue('A'.$i , $row['id']);
                $activeSheet->setCellValueExplicit('B'.$i , $row['amount'], DataType::TYPE_STRING);
                $activeSheet->setCellValue('C'.$i , $row['gateway_transaction_id']);
                $activeSheet->setCellValue('D'.$i , $row['load_status']);
                $activeSheet->setCellValue('E'.$i , $row['load_time_stamp']);
                $activeSheet->setCellValue('F'.$i , $row['merchant_txn_id']);
                $activeSheet->setCellValue('G'.$i , $row['reference_id']);
                $activeSheet->setCellValue('H'.$i , $row['phone_no']);
                $activeSheet->setCellValue('I'.$i , $row['linked_id']);
                $activeSheet->setCellValue('J'.$i , $row['created_at']);
                $i++;
            }
        }

        $date = date('d-m-y-'.substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "loadWallet_".$date.".xlsx";
        $Excel_writer->save($filename);
        $content = file_get_contents($filename);
        header("Content-Disposition: attachment; filename=".$filename);
        unlink($filename);
        exit($content);
    }

}
