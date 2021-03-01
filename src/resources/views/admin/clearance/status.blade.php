@if(($clearanceTransactions) === null || count($clearanceTransactions) === 0 || $clearanceTransactions[0] === null)
    <span style="color: red">Not Cleared</span>
@elseif($clearanceTransactions[0]->clearances->clearance_status === "0")
    <span  style="color: green">Transactions cleared</span>
@elseif ($clearanceTransactions[0]->clearances->clearance_status === "1")
    <span style="color: green">Transaction signed</span>
@else
    <span style="color: red">Dispute in transactions</span>
@endif
