@extends('admin.layouts.admin_design')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <hr>
            <h3 class="m-t-none m-b">NCHL API</h3>
            <hr>
            <dl class="row m-t-md">
                <dd class="col-lg-offset-1"></dd>
                @php
                    $response = $nchlAPI;
                @endphp
                @if(!empty($response))
                    @if (is_array($response) || is_object($response))
                        <table class="table table-bordered center"
                               style="width: 95%;  margin-left: auto; margin-right: auto;">
                            <thead>
                            <tr>
                                <th scope="col" style="background-color: #2f4050 !important; color:ghostwhite;">Key</th>
                                <th scope="col" style="background-color: #2f4050 !important; color: ghostwhite;">Value
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($response as $key=>$value)
                                <tr>
                                    <td>{{$key}}</td>
                                    @if(is_array($value))
                                        @foreach($value as $secondKey=>$secondValue)
                                            <td>{{$secondKey}} : <br>
                                                @if(is_array($secondValue))
                                                    @foreach($secondValue as $thirdKey=>$thirdValue)
                                                        {{$thirdKey}} : {{$thirdValue}} <br>
                                                    @endforeach
                                                @else
                                                    {{$secondValue}}<br></td>
                                                @endif
                                        @endforeach
                                    @else
                                        <td>{{$value}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                @else
                    <dl class="text-left">No Data</dl>
                @endif
            </dl>
        </div>
    </div>

@endsection

@section('styles')
    @include('admin.asset.css.datatable')
    @include('admin.asset.css.chosen')

@endsection

@section('scripts')
    @include('admin.asset.js.chosen')

    @include('admin.asset.css.sweetalert')
    <!-- Page-Level Scripts -->
    @include('admin.asset.js.datatable')
    @include('admin.asset.js.sweetalert')
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let blockedIP_Id = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "Blocked IP will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + blockedIP_Id).trigger('click');
                swal.close();

            })
        });
    </script>

@endsection




