<?php

namespace App\Wallet\Clearance\Interfaces;

interface IClearance
{

    public function checkDateOfUploadedFile($thirdPartyTransactionList, $date);
    public function uploadTransaction($third_party_transaction_list, $clearanceId);
    public function isClearanceCorrect($clearanceId);
    public function getDisputedTransactionList($clearanceId);
    public function getCorrectTransactionList($clearanceId);

}
