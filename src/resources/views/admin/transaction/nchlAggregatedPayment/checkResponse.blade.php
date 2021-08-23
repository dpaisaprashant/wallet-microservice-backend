@if(!empty($nchlAggregatedPayment->check_response))
    <a data-toggle="modal" href="#modal-form-nchl-bank-transfer-account{{$id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="modal-form-nchl-bank-transfer-account{{ $id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 700px">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Check Response</h3>
                            <hr>
                            <dl class="row m-t-md">
                                <?php $response = json_decode($nchlAggregatedPayment->check_response, true)?>
                                <?php foreach ($response as $key => $value) { ?>

                                <dt class="col-md-5 text-right">{{ $key }} :</dt>


                                <dd class="col-md-6">
                                    @if(is_array($value) || is_object($value))
                                        @foreach($value as $key=>$newValue)
                                            <b>{{ $key }} :</b>

                                            @if(!is_array($newValue) || !is_object($newValue))
                                                    {{print_r($newValue)}}
                                                <br>
                                            @else
                                                {{ print_r($newValue) }}
                                                @endif
                                            @endforeach
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
@endif
