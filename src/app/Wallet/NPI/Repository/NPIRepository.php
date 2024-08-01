<?php


namespace App\Wallet\NPI\Repository;


use App\Models\NPIBiller;
use Illuminate\Http\Request;

class NPIRepository
{
    private $request;

    private $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return NPIRepository
     */
    public function setLength(int $length): NPIRepository
    {
        $this->length = $length;
        return $this;
    }

    public function sortedTransactions()
    {
        return NPIBiller::with('user', 'transactionEvents', 'preTransaction')->latest()->filter($this->request)->paginate($this->length);
    }

    public function latestTransactions()
    {
        return NPIBiller::with('user','transactions','preTransaction')->latest()->filter($this->request)->paginate($this->length);
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
        return NPIBiller::with('user','transactionEvents')->where('id', $id)->firstOrFail();
    }

    public function getNPIRepositoryCount(){
        return NPIBiller::filter($this->request)->count();
    }

    public function getNPIRepositorySum(){
        return NPIBiller::filter($this->request)->sum('amount');
    }
}
