<?php


namespace App\Wallet\FundTransfer\Repository;


use App\Models\UserToUserFundTransfer;
use Illuminate\Http\Request;

class FundTransferRepository
{
    private $request;

    private $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return FundTransferRepository
     */
    public function setLength(int $length): FundTransferRepository
    {
        $this->length = $length;
        return $this;
    }

    public function sortedTransactions()
    {
        return UserToUserFundTransfer::with('toUser', 'fromUser', 'commission')->filter($this->request)->paginate($this->length);
    }

    public function latestTransactions()
    {
        return UserToUserFundTransfer::with('toUser', 'fromUser', 'commission')->latest()->filter($this->request)->paginate($this->length);
    }

    public function paginatedTransactions()
    {
        if (empty($this->request->sort))
        {
            return $this->latestTransactions();
        } else
        {
            return $this->sortedTransactions();
        }
    }

    public function detail($id)
    {
        return UserToUserFundTransfer::with('fromUser', 'toUser', 'commission')->where('id', $id)->firstOrFail();
    }
}
