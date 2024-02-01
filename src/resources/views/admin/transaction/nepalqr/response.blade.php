@if(!empty($transaction->preTransaction->json_response))
    <a data-toggle="modal" href="#modal-response-nepalqr{{$transaction->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="modal-response-nepalqr{{ $transaction->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Transaction Response Info</h3>
                            <hr>
                            <dl class="row m-t-md" style="word-wrap    : break-word;
                            overflow-wrap: break-word;">
                                <?php 
                                    $request =  json_decode($transaction->preTransaction->json_response, true);
                                    foreach ($request['data'] as $key => $value) { ?>
                                        <dt class="col-md-5">{{ $key }}</dt>
                                        <dd class="col-md-6">
                                            <?php print_r($value) ?>
                                        </dd>
                                <?php }?>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
