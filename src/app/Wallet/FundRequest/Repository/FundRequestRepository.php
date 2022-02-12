<?php


namespace App\Wallet\FundRequest\Repository;


use App\Models\FundRequest;
use Illuminate\Http\Request;

class FundRequestRepository
{
    private $request;

    private $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return FundRequestRepository
     */
    public function setLength(int $length): FundRequestRepository
    {
        $this->length = $length;
        return $this;
    }

    public function sortedTransactions()
    {
        return FundRequest::with('toUser', 'fromUser', 'commission')->filter($this->request)->paginate($this->length);
    }

    public function latestTransactions()
    {
        return FundRequest::with('toUser', 'fromUser', 'commission')->latest()->filter($this->request)->paginate($this->length);
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
        return FundRequest::with('fromUser', 'toUser', 'commission','transactions')->where('id', $id)->firstOrFail();
    }
}
