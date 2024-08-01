<?php


namespace App\Wallet\ReimburseTransaction\Repository;


use App\Models\UserReimburseEvent;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class ReimburseRepository
{
    use CollectionPaginate;

    private $request;

    private  $length = 200;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function setLength(int $length)
    {
        $this->length = $length;
        return $this;
    }

    private function latestTransactions()
    {
        return UserReimburseEvent::with('user', 'transactions')->latest()->filter($this->request)->paginate($this->length);
    }

    private function sortedTransactions()
    {
        return UserReimburseEvent::with('user', 'transactions')->filter($this->request)->paginate($this->length);
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
        return UserReimburseEvent::with('user', 'transactions')->where('id', $id)->firstOrFail();
    }
}
