@isset($disputeDetail->disputeable->refStan)
    <input type="hidden" value="{{ \App\Models\Dispute::VENDOR_TYPE_PAYPOINT }}" name="vendor_type">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Dispute Details</h5>
                </div>
                <div class="ibox-content">
                    <div id="nPayTransactionDetailDiv">
                        <h2>PayPoint Transaction Details</h2>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>User: {{ $disputeDetail->disputeable->user['name'] }}</h4>
                                <h4>Email: {{ $disputeDetail->disputeable->user['email'] }}</h4>
                                <h4>Contact: {{ $disputeDetail->disputeable->user['mobile_no'] }}</h4>
                            </div>

                            <div class="col-md-5">
                                <h4>RefStan: {{ $disputeDetail->disputeable->refStan }}</h4>
                                <h4>Bill
                                    Number: {{ $disputeDetail->disputeable->checkTransaction->bill_number }}</h4>
                                <h4>Code: {{ $disputeDetail->disputeable->checkTransaction->code }}</h4>

                            </div>

                            @isset($disputeDetail->disputeable->userTransaction)
                                <div class="col-md-4">
                                    <h4>Vendor: {{ $disputeDetail->disputeable->vendor }}</h4>
                                    <h4>Amount: {{ $disputeDetail->disputeable->amount }}</h4>
                                    <h4>Created at: {{ $disputeDetail->disputeable->created_at }}</h4>
                                </div>
                            @endisset
                        </div>
                        <div class="hr-line-dashed"></div>
                        <h2>Create Dispute Transaction Detail</h2>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Vendor Status: {{ $disputeDetail->vendor_status }}</h4>
                                <h4>Vendor Amount: Rs. {{ $disputeDetail->vendor_amount }}</h4>
                            </div>

                            <div class="col-md-3">
                                <h4>User Status: {{ $disputeDetail->user_status ?? 'null' }}</h4>
                                <h4>User Amount: {{ 'Rs. ' . $disputeDetail['user_amount'] ?? 'null' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Transaction Response</h5>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        @isset($disputeDetail->disputeable->checkTransaction->request)
                            <div class="col-md-6">
                                <h3>Check Payment Request</h3>
                                <dl class="row m-t-md">
                                    <?php
                                        $request = json_decode($disputeDetail->disputeable->checkTransaction->request, true);
                                        if (is_string($request)) {
                                            $request = json_decode($request, true);
                                        }
                                    ?>

                                    <?php foreach ($request as $key => $value) { ?>

                                    <dt class="col-md-3 text-right">{{ $key }}</dt>

                                    <dd class="col-md-8">{{ $value }}</dd>
                                    <?php }?>

                                </dl>
                            </div>
                            <div class="col-md-6"></div>
                        @endisset
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">

                        @isset($disputeDetail->disputeable->executeTransaction)
                            @foreach($disputeDetail->disputeable->executeTransaction as $execute)
                                <div class="col-md-6">
                                    <h3>Execute Payment Request (Attempt {{ $loop->index + 1 }})</h3>
                                    <dl class="row m-t-md">
                                        <?php $request = json_decode($execute->request, true);

                                        if (is_string($request)) {
                                            $request = json_decode($request, true);
                                        }

                                        ?>

                                        <?php foreach (($request) as $key => $value) { ?>

                                        <dt class="col-md-3 text-right">{{ $key }}</dt>

                                        <dd class="col-md-8">{{ $value }}</dd>
                                        <?php }?>

                                    </dl>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="col-md-6">
                                    <h3>Execute Payment Response (Attempt {{ $loop->index + 1 }})</h3>
                                    <dl class="row m-t-md">
                                        <?php $request = json_decode($execute->response, true);


                                        if (is_string($request)) {
                                            $request = json_decode($request, true);
                                        }

                                        ?>

                                        <?php foreach (($request) as $key => $value) { ?>

                                        <dt class="col-md-3 text-right">{{ $key }}</dt>

                                        <dd class="col-md-8">{{ $value }}</dd>
                                        <?php }?>

                                    </dl>
                                </div>
                            @endforeach
                        @endisset

                    </div>

                </div>
            </div>
        </div>
    </div>
@endisset
