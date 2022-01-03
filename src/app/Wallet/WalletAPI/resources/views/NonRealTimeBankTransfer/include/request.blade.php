<a data-toggle="modal" href="#modal-form-nchl-load-transaction-validation-response{{$transaction_id}}" title="Request">
    <button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-nchl-load-transaction-validation-response{{ $transaction_id }}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 700px;">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Request</h3>
                        <hr>
                        <dl class="row m-t-md">

                            <?php $response = json_decode($request, true)?>


                            {{--     <?php foreach ($response as $key => $value) { ?>--}}

                            {{--<dt class="col-md-5 text-right">{{ $key }}</dt>

                                @if(is_array($value) || is_object($value))
                                    @foreach($value as $newKey => $newValue)
                                        <dd class="col-md-5"> {{ $newKey }}</dd>
                                        <dd class="col-md-6">{{ print_r($newValue) }}</dd>
                                    @endforeach
                                @else
                                    {{ $value }}
                                @endif


                            <?php }?>--}}
                            <?php foreach($response as $key => $value) { ?>
                            <dt class="col-md-5 text-right">{{ $key }}</dt>
                            <dd class="col-md-6">

                                @if(is_array($value) || is_object($value))
                                    @foreach($value as $newKey=> $newValue)
                                        <b>{{ $newKey }} : </b>
                                        @if(is_array($newValue) || is_object($value))
                                            @foreach($newValue as $thirdLevelKey => $thirdLevelValue)
                                                <b>{{ $thirdLevelKey }} : </b>
                                                {{ $thirdLevelValue }}<br>
                                                @if(is_array($thirdLevelValue) || is_object($thirdLevelValue))
                                                    {{ print_r($thirdLevelValue) }}
                                                @endif
                                            @endforeach
                                        @else
                                            {{$newValue}}<br>
                                        @endif
                                    @endforeach
                                @else
                                    {{ $value }}
                                @endif

                            </dd>

                            <?php } ?>

                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

