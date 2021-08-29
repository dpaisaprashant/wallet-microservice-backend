<div role="tabpanel" id="wallet" class="tab-pane">
    <div class="panel-body">
        <dl class="row m-t-md">

            <dt class="col-md-3 text-right">Total Balance</dt>
            <dd class="col-md-8">Rs. {{ $merchant->wallet->balance }}</dd>

            <dt class="col-md-3 text-right">Bonous Amount</dt>
            <dd class="col-md-8">100</dd>

            <dt class="col-md-3 text-right">SajiloPay Points</dt>
            <dd class="col-md-8">25</dd>

            <dt class="col-md-3 text-right">Last transaction</dt>
            <dd class="col-md-8">{{ date('M d, Y', strtotime($merchant->wallet->updated_at)) }}</dd>

        </dl>
    </div>
</div>
