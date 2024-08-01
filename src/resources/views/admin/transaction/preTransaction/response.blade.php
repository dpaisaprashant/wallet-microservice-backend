@if(!empty($transaction->json_response))
    <a data-toggle="modal" title="Response" href="#modal-form-response-preTransaction-error{{$transaction->id}}">
        <button class="btn btn-danger btn-icon" type="button"><i class="fa fa-info"></i></button>
    </a>
    <div id="modal-form-response-preTransaction-error{{  $transaction->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Error Response</h3>
                            <hr>
                            <dl class="row m-t-md">

                                <?php $response = json_decode($transaction->json_response, true)?>
                                @if(! is_array($response))
                                    <?php $response = json_decode($response, true) ?>
                                @endif
                                    @if(is_array($response))
                                        <?php foreach ($response as $key => $value) { ?>

                                @if(is_array($value))
                                    @foreach($value as $key2 => $value2)
                                            <dt class="col-md-4 text-right">{{ $key2 }}</dt>
                                            <dd class="col-md-7"><?php print_r($value2) ?></dd>
                                    @endforeach
                                @else
                                        <dt class="col-md-4 text-right">{{ $key }}</dt>
                                        <dd class="col-md-7"><?php print_r($value) ?></dd>
                                @endif



                                <?php }?>
                                    @endif

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
