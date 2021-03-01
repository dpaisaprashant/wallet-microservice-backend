<?php


namespace App\Wallet\Clearance\Repository;


use App\Models\AdminOTP;
use App\Models\Clearance;
use App\Models\UserLoadTransaction;
use Illuminate\Http\Request;

class NPayClearanceRepository
{
    private $request;

    private $length = 15;

    /**
     * @param mixed $length
     * @return NPayClearanceRepository
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function isValidOTP()
    {
        $otp = (new AdminOTP)->checkValidToken($this->request->otp);
        if (empty($otp) || $otp->admin_id != auth()->user()->id) {
            return false;
        }
        session(['hasClearanceOTP' => true]);
        return true;
    }

    public function transactionsInDate($date)
    {
        return UserLoadTransaction::whereDate('created_at', $date)
            ->with('clearanceTransactions')
            ->get();
    }

    public function transactionsInDateRange($date)
    {
        return UserLoadTransaction::whereDate('created_at', '>=', $date['from'])
            ->whereDate('created_at', '<=', $date['to'])
            ->with('clearanceTransactions')
            ->get();
    }

    public function checkClearanceInDateRange($date)
    {
        $clearance = $this->clearanceEqualToDate($date);

        if ($clearance) {
            return 0;
        }

        return Clearance::whereClearanceType(Clearance::TYPE_NPAY)
            ->where(function ($query) use ($date){
                $query->whereBetween('transaction_from_date', ($date))
                    ->orWhereBetween('transaction_to_date', ($date));
            })
            ->count();
    }

    public function clearanceEqualToDate($date)
    {
        return Clearance::whereClearanceType(Clearance::TYPE_NPAY)
            ->whereDate('transaction_to_date', $date['to'])
            ->whereDate('transaction_from_date', $date['from'])
            ->first();
    }

    public function clearanceInDate($date)
    {
        return Clearance::with('clearanceTransactions')
                ->where('clearance_type', 'nPay')
                ->whereDate('transaction_date', $date)
                ->firstOrFail();
    }

    public function transactionsInClearance($clearance)
    {
        return UserLoadTransaction::with('clearanceTransactions')
                ->whereHas('clearanceTransactions', function ($query) use ($clearance) {
                    return $query->where('clearance_id', $clearance->id);
                })->get();
    }

    public function hasDisputeInClearance($clearance)
    {
        if ($clearance->dispute_status === null) {
            return true;
        }
        return false;
    }

    public function paginatedClearanceList()
    {
        return Clearance::with('clearanceTransactions', 'admin')
                ->where('clearance_type', '=', 'nPay')
                ->filter($this->request)
                ->paginate($this->length);
    }

}
