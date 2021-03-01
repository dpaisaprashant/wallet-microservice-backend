<?php

namespace App\Listeners;

use App\Models\PaypointToDpaisaClearanceTransaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PaypointToDpaisaTransactionExcelUploadListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return array
     */
    public function handle($event)
    {

        try {
            $spreadsheet = IOFactory::load($event->file);
            $worksheet = $spreadsheet->getActiveSheet();

            $highestRow = $worksheet->getHighestDataRow();
            $highestColumn = $worksheet->getHighestDataColumn();
            $highestColumn++;


            if ($highestColumn == 'W') {
                $column = [
                    'A' => 'sn',
                    'B' => 'user_id',
                    'C' => 'city',
                    'D' => 'address',
                    'E' => 'dealer_name',
                    'G' => 'institution',
                    'H' => 'company_name',
                    'I' => 'service_code',
                    'J' => 'registration_date',
                    'K' => 'account',
                    'L' => 'amount',
                    'M' => 'amount_transferred',
                    'N' => 'commission',
                    'O' => 'revenue',
                    'S' => 'currency',
                    'T' => 'refStan',
                    'V' => 'status'
                ];

                for ($row = 1; $row <= $highestRow; ++$row) {
                    //$data[$row]['clearance_id'] = $event->clearanceId;
                    for ($col = 'E'; $col != $highestColumn; ++$col) {
                        if (array_key_exists($col, $column)) {
                            $data[$row][$column[$col]] = $worksheet->getCell($col . $row)->getFormattedValue();
                            if ($col == 'O') {
                                $data[$row][$column[$col]] = (int) (  ((double) str_replace(',', '',trim($data[$row][$column[$col]]))) * 100) ;
                            }
                        }
                    }

                }

                $data = array_slice($data, 2, -2);

                //PaypointToDpaisaClearanceTransaction::insert($data);

                return $data;
            } else {

                $column = [
                    'A' => 'sn',
                    'B' => 'user_id',
                    'C' => 'city',
                    'D' => 'address',
                    'E' => 'dealer_name',
                    'F' => 'institution',
                    'G' => 'company_name',
                    'H' => 'service_code',
                    'I' => 'registration_date',
                    'J' => 'account',
                    'K' => 'amount',
                    'L' => 'amount_transferred',
                    'M' => 'commission',
                    'N' => 'currency',
                    'O' => 'refStan',
                    'P' => 'status'
                ];

                for ($row = 1; $row <= $highestRow; ++$row) {

                    for ($col = 'E'; $col != $highestColumn; ++$col) {
                        $data[$row][$column[$col]] = $worksheet->getCell($col . $row)->getFormattedValue();
                    }

                }

                $data = array_slice($data, 2, -2);

                //PaypointToDpaisaClearanceTransaction::insert($data);

                return $data;
            }


        } catch (\Exception $e) {
            dd('wrong excel file uploaded');
        }

    }
}
