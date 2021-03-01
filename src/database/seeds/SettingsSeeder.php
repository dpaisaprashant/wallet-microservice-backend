<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'pp_ntc_topup_type' => 'FLAT',
            'pp_ntc_topup_value' => 10,
            'pp_ntc_epin_type' => 'FLAT',
            'pp_ntc_epin_value' => 10,
            'pp_ncell_type' => 'FLAT',
            'pp_ncell_value' => 10,
            'pp_smartcell_epin_type' => 'FLAT',
            'pp_smartcell_epin_value' => 10,
            'pp_smartcell_topup_type' => 'FLAT',
            'pp_smartcell_topup_value' => 10,
            'pp_utl_type' => 'FLAT',
            'pp_utl_value' => 10,
            'pp_dishhome_type' => 'FLAT',
            'pp_dishhome_value' => 10,
            'pp_simtv_type' => 'FLAT',
            'pp_simtv_value' => 10,
            'pp_nea_type' => 'FLAT',
            'pp_nea_value' => 10,
            'pp_websurfer_type' => 'FLAT',
            'pp_websurfer_value' => 10,
            'pp_arrownet_type' => 'FLAT',
            'pp_arrownet_value' => 10,
            'pp_worldlink_type' => 'FLAT',
            'pp_worldlink_value' => 10,
            'pp_subisu_type' => 'FLAT',
            'pp_subisu_value' => 10,
            'pp_nettv_type' => 'FLAT',
            'pp_nettv_value' => 10,
            'pp_vianet_type' => 'FLAT',
            'pp_vianet_value' => 10,
            'pp_nepal_water_type' => 'FLAT',
            'pp_nepal_water_value' => 10,
            'pp_khanepani_water_type' => 'FLAT',
            'pp_khanepani_water_value' => 10,
            'pp_merotv_type' => 'FLAT',
            'pp_merotv_value' => 10,
            'pp_sky_type' => 'FLAT',
            'pp_sky_value' => 10,

            'paypoint_service_enabled' => 1,
            'npay_service_enabled' => 1,

            //load limit
            "load_daily_limit" => 500000,
            "load_daily_verified_limit" => 2500000,
            "load_monthly_limit" => 2000000,
            "load_monthly_verified_limit" => 10000000,
            "load_transaction_limit" => 500000,
            "load_transaction_verified_limit" => 2500000,

            //payment limit
            "payment_daily_limit" => 500000,
            "payment_daily_verified_limit" => 2500000,
            "payment_monthly_limit" => 2000000,
            "payment_monthly_verified_limit" => 10000000,
            "payment_transaction_limit" => 500000,
            "payment_transaction_verified_limit" => 2500000,

            //transfer limit
            "transfers_daily_limit" => 500000,
            "transfers_daily_verified_limit" => 2500000,
            "transfers_monthly_limit" => 2000000,
            "transfers_monthly_verified_limit" => 10000000,
            "transfers_transaction_limit" => 500000,
            "transfers_transaction_verified_limit" => 2500000,

            //sct limit
            "sct_daily_limit" => 500000,
            "sct_daily_verified_limit" => 2500000,
            "sct_monthly_limit" => 2000000,
            "sct_monthly_verified_limit" => 10000000,
            "sct_transaction_limit" => 500000,
            "sct_transaction_verified_limit" => 2500000,

            //bank transfer limit
            "bank_transfer_daily_limit" => 500000,
            "bank_transfer_daily_verified_limit" => 2500000,
            "bank_transfer_monthly_limit" => 2000000,
            "bank_transfer_monthly_verified_limit" => 10000000,
            "bank_transfer_transaction_limit" => 500000,
            "bank_transfer_transaction_verified_limit" => 2500000,

        ];

        foreach($data as $key => $value){
            DB::table("settings")->insert([
                "option" => $key,
                "value" => $value,
            ]);
        }
    }
}
