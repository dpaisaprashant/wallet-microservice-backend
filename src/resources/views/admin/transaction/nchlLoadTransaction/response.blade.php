@if(!empty($transaction->validation_response))
    <a data-toggle="modal" href="#modal-form-nchl-load-transaction-validation-response{{$transaction->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="modal-form-nchl-load-transaction-validation-response{{ $transaction->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Validation Response</h3>
                            <hr>
                            <dl class="row m-t-md">

                                <?php $response =  json_decode($transaction->validation_response, true)?>

                                <?php foreach ($response as $key => $value) { ?>

                                <dt class="col-md-5 text-right">{{ $key }}</dt>
                                <dd class="col-md-6">
                                    @if($key == 'txnAmt')
                                        {{ $value / 100 }}
                                    @else
                                        {{ $value }}
                                    @endif
                                </dd>

                                <?php }?>
                                    <dt class="col-md-5 text-right">Reference Id</dt>
                                    <dd class="col-md-6">
                                        {{ $transaction->reference_id }}
                                    </dd>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else

@endif
