<?php

namespace App\Listeners;

use App\Models\NpayToDpaisaClearanceTransaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use PhpOffice\PhpSpreadsheet\IOFactory;

class NpayToDpaisaTransactionExcelUploadListener
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
     * @return void
     */
    public function handle($event)
    {


        try {

            $spreadsheet = IOFactory::load($event->file);
            $worksheet = $spreadsheet->getActiveSheet();

            $highestRow = $worksheet->getHighestDataRow();
            $highestColumn = $worksheet->getHighestDataColumn();
            $highestColumn++;

            $column = [
                'A' => 'sn',
                'B' => 'gateway_ref_no',
                'C' => 'merchant',
                'D' => 'username',
                'E' => 'GatewayRoute', //SKIP
                'F' => 'card_no',
                'G' => 'customer_transaction_id',
                'H' => 'sct_id',
                'I' => 'amount',
                'J' => 'service_charge',
                'K' => 'net_amount',
                'L' => 'cbs_status',
                'M' => 'transaction_date',
                'N' => 'updated_at',
                'O' => 'nth',

            ];

            for ($row = 1; $row <= $highestRow; ++$row) {
                for ($col = 'A'; $col != $highestColumn; ++$col) {
                    if ($col != 'E') {
                        $data[$row][$column[$col]] = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', (trim($worksheet->getCell($col . $row)->getFormattedValue())));
                    }
                }
            }

            $data = array_slice($data, 2, -1);
            return $data;

        }catch (\Exception $e) {
            dd('Wrong excel file uploaded');
        }


    }
}
