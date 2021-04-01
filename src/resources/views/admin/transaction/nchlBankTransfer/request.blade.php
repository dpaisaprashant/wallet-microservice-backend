@if(!empty($transaction->request))
    <a data-toggle="modal" href="#modal-form-nchl-bank-transfer-request-debtor{{$transaction->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="modal-form-nchl-bank-transfer-request-debtor{{ $transaction->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Debtor Request Info</h3>
                            <hr>
                            <dl class="row m-t-md">

                                <?php
                                    $request =  json_decode($transaction->request, true);
                                    $debtorRequest = $request['cipsBatchDetail'] ?? [];
                                    $creditorRequest = $request['cipsTransactionDetailList'][0] ?? [];
                                ?>



                                <?php foreach ($debtorRequest as $key => $value) { ?>

                                <dt class="col-md-5 text-right">{{ $key }}</dt>
                                <dd class="col-md-6">
                                    @if($key == 'txnAmt')
                                        {{ $value / 100 }}
                                    @else
                                            <?php print_r($value) ?>

                                    @endif
                                </dd>


                                <?php }?>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a data-toggle="modal" href="#modal-form-nchl-bank-transfer-request-creditor{{$transaction->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="modal-form-nchl-bank-transfer-request-creditor{{ $transaction->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Creditor Request Info</h3>
                            <hr>
                            <dl class="row m-t-md">


                                <?php foreach ($creditorRequest as $key => $value) { ?>

                                    @if(!empty($value))
                                        <dt class="col-md-5 text-right">{{ $key }}</dt>
                                        <dd class="col-md-6">
                                            @if($key == 'txnAmt')
                                                {{ $value / 100 }}
                                            @else
                                                <?php print_r($value) ?>

                                            @endif
                                        </dd>
                                    @endif
                                <?php }?>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
