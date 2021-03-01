@if(count($transaction->userExecutePayment) > 0)
    @foreach($transaction->userExecutePayment as $key => $execute)

        @if($transaction->userExecutePayment->count() ==  1 )
            <?php $color = 'warning' ?>
        @elseif($execute->code == 000)
            <?php $color = 'primary' ?>
        @else
            <?php $color = 'danger' ?>
        @endif


        <a data-toggle="modal" title="Request" href="#modal-form-request-paypoint{{$key .'-'. $transaction->id}}"><button class="btn btn-{{$color}} btn-icon" type="button"><i class="fa fa-info"></i></button></a>
        <div id="modal-form-request-paypoint{{ $key .'-'. $transaction->id }}" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="m-t-none m-b">Execute Payment Request Detailed Information</h3>
                                <hr>
                                <dl class="row m-t-md">

                                    <?php $request =  json_decode($execute->request, true)?>
                                        @if(! is_array($request))
                                            <?php $request = json_decode($request) ?>
                                        @endif
                                    <?php foreach ($request as $key => $value) { ?>

                                    <dt class="col-md-3 text-right">{{ $key }}</dt>
                                    @if($key == 'amount' )
                                        <dd class="col-md-8">Rs. {{ empty($value) ? 0 : $value / 100 }}</dd>
                                    @else
                                        <dd class="col-md-8">{{ $value }}</dd>
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
    <a data-toggle="modal" href="#modal-form-request-paypoint{{$transaction->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="modal-form-request-paypoint{{ $transaction->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Check Payment Request Detailed Information</h3>
                            <hr>
                            <dl class="row m-t-md">

                                <?php $request = json_decode($transaction->request, true)?>
                                @if(! is_array($request))
                                    <?php $request = json_decode($request) ?>
                                @endif
                                @if($request != null)
                                    <?php foreach ($request as $key => $value) { ?>

                                    <dt class="col-md-3 text-right">{{ $key }}</dt>
                                    @if($key == 'amount' )
                                        <dd class="col-md-8">Rs. {{ empty($value) ? 0 : $value / 100 }}</dd>
                                    @else
                                        <dd class="col-md-8">{{ $value }}</dd>
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
