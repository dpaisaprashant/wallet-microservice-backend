<a data-toggle="modal" href="#modal-form-json-request{{$merchantProduct->id}}">
    <button class="btn btn-warning btn-icon" type="button" title="Json Request"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-json-request{{$merchantProduct->id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 750px !important;">
        <div class="modal-content">
            <div class="modal-body">
{{--                <div class="row">--}}
{{--                    <div class="col-sm-12">--}}
{{--                        <h3 class="m-t-none m-b">Json Request</h3>--}}
{{--                        <hr>--}}
{{--                        @if(!empty($merchantProduct->json_data))--}}
{{--                            {{$merchantProduct->json_data}}--}}
{{--                        @else--}}
{{--                            <dl class="text-left">No Data</dl>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox ">
                            <div class="ibox-title" style="width: 95%;  margin-top: 2%;margin-left: auto; margin-right: auto;">
                                <h5>Json Data</h5>
                            </div>

                            @php
                                $response = json_decode($merchantProduct->json_data);
                            @endphp
{{--                            {{dd(($response))}}--}}
                            @if(!empty($response))
                                <div class="ibox-content" style="width: 95%;  margin-left: auto; margin-right: auto;">
                                    @if (is_array($response) || is_object($response))

                                        <table class="table table-striped table-bordered table-hover dataTables-example"
                                               style="width: 95%;  margin-left: auto; margin-right: auto;">
                                            <thead>
                                            <tr>
                                                <th scope="col">Key</th>
                                                <th scope="col">Value</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($response as $key=>$value)
                                                @if(!is_array($value))
                                                    <tr>
                                                        <td>{{$key}}</td>
                                                        <td>{{$value}}</td>
                                                    </tr>
                                                @elseif(is_array($value))
                                                    <tr>
                                                        <td>{{$key}}</td>
                                                        <td>&#x2935;</td>
                                                    </tr>
                                                    @foreach($value as $secondKey=>$secondValue)
                                                        @if(is_array($secondValue) || is_object($secondValue))
                                                            <tr>
                                                                <td>{{$secondKey}}</td>
                                                                <td>&#x2935;</td>
                                                            </tr>
                                                            @foreach($secondValue as $thirdKey=>$thirdValue)
                                                                <tr>
                                                                    <td>{{$thirdKey}}</td>
                                                                    <td>{{$thirdValue}}</td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td>{{$secondKey}}</td>
                                                                <td>{{$secondValue}}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            @else
                                <div class="ibox-content" style="width: 95%;  margin-left: auto; margin-right: auto;">No Data</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



