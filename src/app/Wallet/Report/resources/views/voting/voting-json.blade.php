@if(!empty($participant))
    <a data-toggle="modal" href="#ParticipantInfoJson{{$participant->id}} ">
        <button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button>
    </a>
    <div id="ParticipantInfoJson{{ $participant->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Participant Info</h3>
                            <hr>
                            @php
                                $json = json_decode($participant->json_form_data,true);
                            @endphp
                            @if(!empty($json))
                                <dl class="row m-t-md">
                                    @if (is_array($json) || is_object($json))
                                        @if(isset($json['password']))
                                            @php
                                                unset($json['password'])
                                            @endphp
                                        @endif
                                        @foreach ($json as $key=>$value)
                                            @if(!is_array($value))
                                                <dt class="col-md-5 text-left">{{ $key }} :</dt>
                                                <dd class="col-lg-offset-1"></dd>
                                                <dd class="col-md-5 text-left">{{ $value == null ? 'Null' : $value }} </dd>
                                            @else
                                                <hr>
                                                <dt class="col-md-5 text-left">{{ $key }} :</dt>
                                                <dd class="col-lg-offset-1"></dd>
                                                <dd class="col-md-5 text-left"></dd>
                                                <hr>

                                                @php
                                                    $secondLevelResponse = $value;
                                                @endphp
                                                @if (is_array($secondLevelResponse) || is_object($secondLevelResponse))
                                                    @foreach($secondLevelResponse as $key=>$value)

                                                        @if(is_string($value))
                                                            <dt class="col-md-5 text-left">{{ $key }} :</dt>
                                                            <dd class="col-md-7 text-left">{{ $value == null ? 'Null' : ($value) }} </dd>
                                                        @endif

                                                    @endforeach
                                                @endif
                                            @endif
                                        @endforeach
                                    @else
                                        {{(string)$json}}
                                    @endif

                                </dl>
                            @else
                                <dt class="text-left">No Data</dt>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
