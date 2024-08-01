<?php


namespace App\Wallet\Khanepani\Repository;


use App\Models\KhanepaniTransaction;
use Illuminate\Http\Request;

class KhapaniRepository
{
    private $request;

    private $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return KhapaniRepository
     */
    public function setLength(int $length): KhapaniRepository
    {
        $this->length = $length;
        return $this;
    }

    public function sortedTransactions()
    {
        return Khanepani::with('user', 'transactionEvents', 'preTransaction')->latest()->filter($this->request)->paginate($this->length);
    }

    public function latestTransactions()
    {
        return Khanepani::with('user','transactions','preTransaction')->latest()->filter($this->request)->paginate($this->length);
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
        return Khanepani::with('user','transactionEvents')->where('id', $id)->firstOrFail();
    }

    public function getKhanepaniCount(){
        return Khanepani::filter($this->request)->count();
    }

    public function getKhanepaniSum(){
        return Khanepani::filter($this->request)->sum('amount');
    }
}
