@extends('admin.layouts.admin_design')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox ">
                <div class="ibox-title" style="width: 95%;  margin-top: 2%;margin-left: auto; margin-right: auto;">
                    <h5>NCHL Bank Transfer Transaction Info</h5>
                </div>
                <div class="ibox-content" style="width: 95%;  margin-left: auto; margin-right: auto;">
                    <table class="table table-striped table-bordered table-hover dataTables-example"
                           style="width: 95%;  margin-left: auto; margin-right: auto;">
                        <thead>
                        <tr>
                            <th scope="col">Key</th>
                            <th scope="col">Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>ID</td>
                            <td>{{$nchlBankTransfer->id}}</td>
                        </tr>
                        <tr>
                            <td>Pre Transaction ID</td>
                            <td>{{$nchlBankTransfer->pre_transaction_id}}</td>
                        </tr>
                        <tr>
                            <td>Transaction ID</td>
                            <td>{{$nchlBankTransfer->transaction_id}}</td>
                        </tr>
                        <tr>
                            <td>Request ID</td>
                            <td>{{$nchlBankTransfer->request_id}}</td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td>{{$nchlBankTransfer->amount}}</td>
                        </tr>
                        <tr>
                            <td>Debit Status</td>
                            <td>{{$nchlBankTransfer->debit_status}}</td>
                        </tr>
                        <tr>
                            <td>Credit Status</td>
                            <td>{{$nchlBankTransfer->credit_status}}</td>
                        </tr>
                        <tr>
                            <td>Debit Response Message</td>
                            <td>{{$nchlBankTransfer->debit_response_message}}</td>
                        </tr>

                        <tr>
                            <td>Vendor</td>
                            <td>{{$nchlBankTransfer->vendor}}</td>
                        </tr>
                        <tr>
                            <td>Created At</td>
                            <td>{{$nchlBankTransfer->created_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox ">
                <div class="ibox-title" style="width: 95%;  margin-top: 2%;margin-left: auto; margin-right: auto;">
                    <h5>Response from NCHL API</h5>
                </div>

                @php
                    $response = $nchlAPI;
                @endphp

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
                                            @if(is_array($secondValue))
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

@endsection

@section('styles')

    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datatable')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    @include('admin.asset.css.datepicker')

@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatableWithPaging')

    <!-- IonRangeSlider -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

@endsection


