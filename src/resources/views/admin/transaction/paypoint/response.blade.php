@if(count($transaction->userExecutePayment) > 0)
    @foreach($transaction->userExecutePayment as $key => $execute)

        @if($transaction->userExecutePayment->count() ==  1 )
            <?php $color = 'warning' ?>
        @elseif($execute->code == 000)
            <?php $color = 'primary' ?>
        @else
            <?php $color = 'danger' ?>
        @endif


        <a data-toggle="modal" title="Response" href="#modal-form-response-paypoint{{$key . '-' .$transaction->id}}">
            <button class="btn btn-{{ $color }} btn-icon" type="button"><i class="fa fa-info"></i></button>
        </a>
        <div id="modal-form-response-paypoint{{ $key . '-' . $transaction->id }}" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="m-t-none m-b">Execute Payment Response Detailed Information</h3>
                                <hr>
                                <dl class="row m-t-md">

                                    <?php $response = json_decode($execute->response, true)?>
                                        @if(! is_array($response))
                                            <?php $response = json_decode($response) ?>
                                        @endif
                                    <?php foreach ($response as $key => $value) { ?>

                                    <dt class="col-md-3 text-right">{{ $key }}</dt>
                                    @if($key == 'amount' )
                                        <dd class="col-md-8">Rs. {{ empty($value) ? 0 : $value / 100 }}</dd>
                                    @else
                                        <dd class="col-md-8"><?php print_r($value) ?></dd>
                                    @endif

                                    <?php }?>

                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <a data-toggle="modal" href="#modal-form-response-paypoint{{$transaction->id}}">
        <button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button>
    </a>
    <div id="modal-form-response-paypoint{{ $transaction->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Check Payment Response Detailed Information</h3>
                            <hr>
                            <dl class="row m-t-md">

                                <?php $response = json_decode($transaction->response, true)?>
                                @if(! is_array($response))
                                    <?php $response = json_decode($response) ?>
                                @endif

                                @if($response != null)
                                    <?php foreach ($response as $key => $value) { ?>


                                    @if($key == 'amount' )
                                        <dt class="col-md-3 text-right">{{ $key }}</dt>
                                        <dd class="col-md-8">Rs. {{ empty($value) ? 0 : $value / 100 }}</dd>
                                    @else
                                        @if(is_string($value))
                                            <dt class="col-md-3 text-right">{{ $key }}</dt>
                                            <dd class="col-md-8">{{ $value }}</dd>
                                        @else
                                            @if(is_array($value))
                                                @foreach($value as $key1 => $value1)
                                                    @if(is_string($value1))
                                                        <dt class="col-md-3 text-right">{{ $key1}}</dt>
                                                        <dd class="col-md-8">{{ $value1 }}</dd>
                                                    @else
                                                        @foreach((array)$value1 as $key2 => $value2)
                                                            @if(is_string($value2))
                                                                <dt class="col-md-3 text-right">{{ $key2}}</dt>
                                                                <dd class="col-md-8">{{ ($value2) }}</dd>
                                                            @else
                                                                @foreach((array)$value2 as $key3 => $value3)
                                                                    @if(is_string($value3))
                                                                        <dt class="col-md-3 text-right">{{ $key3}}</dt>
                                                                        <dd class="col-md-8">{{ ($value3) }}</dd>
                                                                    @else
                                                                        @foreach((array)$value3 as $key4 => $value4)
                                                                            @if(is_string($value4))
                                                                                <dt class="col-md-3 text-right">{{ $key4}}</dt>
                                                                                <dd class="col-md-8">{{ ($value4) }}</dd>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @else
                                                    <dt class="col-md-3 text-right">{{ $key }}</dt>
                                                    <dd class="col-md-8"><?php print_r($value) ?></dd>
                                            @endif
                                            <?php /*echo "<pre>"; print_r($value); */?>
                                        @endif
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
