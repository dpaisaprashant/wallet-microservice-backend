@if(!empty($transaction->preTransaction->json_request))
    <a data-toggle="modal" href="#modal-request-nepalqr{{$transaction->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="modal-request-nepalqr{{ $transaction->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Transaction Request Info</h3>
                            <hr>
                            <dl class="row m-t-md">

                                <?php
                                    $request =  json_decode($transaction->preTransaction->json_request, true);
                                    
                                ?>
                                <dt class="col-md-12">Amount: {{ $request['amount'] }}</dt>
                                <dt class="col-md-12">QrString: {{ $request['tran_id'] }}</dt>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
