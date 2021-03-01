<?php


namespace App\Wallet\Clearance\Repository;


use App\Models\AdminOTP;
use App\Models\Clearance;
use App\Models\ClearanceTransaction;
use App\Models\UserTransaction;
use Illuminate\Http\Request;

class PayPointClearanceRepository
{
    private $request;

    private $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * @param int $length
     * @return PayPointClearanceRepository
     */
    public function setLength(int $length): PayPointClearanceRepository
    {
        $this->length = $length;
        return $this;
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

    public function clearanceInDate($date)
    {
        return Clearance::with('clearanceTransactions')
            ->where('clearance_type', 'payPoint')
            ->whereDate('transaction_date', $date)
            ->firstOrFail();
    }

    public function transactionsInClearance($clearance)
    {
        $clearanceTransactions = ClearanceTransaction::where('transaction_type', UserTransaction::class)->pluck('transaction_id');
        /*return UserTransaction::with('clearanceTransactions')
            ->whereHas('dpaisa.clearanceTransactions', function ($query) use ($clearance) {
                return $query->where('clearance_id', $clearance->id);
            })->get();*/

        return UserTransaction::with('clearanceTransactions')->whereIn('id', $clearanceTransactions)->get();
    }

    public function transactionsInDate($date)
    {
         return UserTransaction::whereDate('created_at', $date)
            ->with('clearanceTransactions')
            ->get();
    }

    public function transactionsInDateRange($date)
    {
        return UserTransaction::whereDate('created_at', '>=', $date['from'])
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

        return Clearance::whereClearanceType(Clearance::TYPE_PAYPOINT)
            ->where(function ($query) use ($date){
                $query->whereBetween('transaction_from_date', ($date))
                    ->orWhereBetween('transaction_to_date', ($date));
            })
            ->count();
    }

    public function clearanceEqualToDate($date)
    {
       return Clearance::whereClearanceType(Clearance::TYPE_PAYPOINT)
            ->where('transaction_to_date', $date['to'])
            ->where('transaction_from_date', $date['from'])
            ->first();
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
            ->where('clearance_type' , '=', 'payPoint')
            ->filter($this->request)
            ->paginate($this->length);
    }


}
