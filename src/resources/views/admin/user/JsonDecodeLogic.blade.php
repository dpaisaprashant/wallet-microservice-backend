@if(!empty($response))
    <dl class="row m-t-md">
        @if (is_array($response) || is_object($response))

            @foreach ($response as $key=>$value)
                @if(!is_array($value))
                    <dt class="col-md-5 text-left" >{{ $key }} :</dt>
                    <dd class="col-lg-offset-1"></dd>
                    <dd class="col-md-5 text-right">{{ $value == null ? 'Null' : $value }} </dd>
                @else
                    <hr>
                    <dt class="col-md-5 text-left">{{ $key }} :</dt>
                    <dd class="col-lg-offset-1"></dd>
                    <dd class="col-md-5 text-left"> </dd><hr>

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
            {{(string)$response}}
        @endif

    </dl>
@else

    <dt class="text-left">No Data</dt>

@endif
