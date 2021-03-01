@if(!empty($transaction->id))
<a data-toggle="modal" href="#modal-form-npay-response{{$transaction->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
<div id="modal-form-npay-response{{ $transaction->id }}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">NPay Response</h3>
                        <hr>
                        <dl class="row m-t-md">

                            <?php $response =  json_decode($transaction->response, true)?>

                            <?php foreach (json_decode($response) as $key => $value) { ?>

                            <dt class="col-md-5 text-right">{{ $key }}</dt>
                            @if($key == 'AMOUNT' )
                                <dd class="col-md-6">Rs. {{ empty($value) ? 0 : $value }}</dd>
                            @else
                                <dd class="col-md-6">{{ $value }}</dd>
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
