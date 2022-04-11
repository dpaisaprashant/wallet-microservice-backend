@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Daily Information Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Daily Information</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title collapse-link">
                        <h5>Select Date</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="date" autocomplete="off"
                                                       value="{{ !empty($_GET['date']) ? $_GET['date'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('report.daily_info_report') }}"><strong>Generate
                                                Report</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
                                    {{-- <div>
                                         <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('user.excel') }}"><strong>Excel</strong></button>
                                     </div>--}}
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @if(!empty($_GET['date']))
                    <div class="ibox ">
                        <div class="ibox-title">
                            {{--                            <h5>Daily Report for {{$data['from_date']}} @if(isset($data['to_date'])) to {{$data['to_date']}} @endif</h5>--}}
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Wallet user's list">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Heading</th>
                                        <th>Particulars</th>
                                        <th>Total Number</th>
                                        <th>Data</th>
                                        <th>Previous Day Report</th>
                                        <th>Change</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reports as $report)
                                        @php
                                            $sn = $loop->iteration;
                                        @endphp
                                        @if($report['heading'] == "KYC")
                                            @for($i=0;$i<4;$i++)
                                                <tr>
                                                    @if($i == 0)
                                                        <td rowspan="4">{{$sn}}</td>
                                                        <td rowspan="4">{{$report['heading']}}</td>
                                                    @endif
                                                    <td>{{$report['particulars'][$i]}}</td>
                                                    <td>{{$report['total_number']}}</td>
                                                    <td>{{$report['data'][$i]}}</td>
                                                    <td>{{$report['previous_day_report'][$i]}}</td>
                                                    @if($report['change'][$i]['status'] == "positive")
                                                        <td style="color: green">{{$report['change'][$i]['change_value']}}</td>
                                                    @else
                                                        <td style="color: red">{{$report['change'][$i]['change_value']}}</td>
                                                    @endif
                                                </tr>
                                            @endfor
                                        @elseif($report['heading'] == "User's Transaction" || $report['heading'] == "Agent's Transaction" || $report['heading'] == "Total Transaction" || $report['heading'] == "Bank Load" || $report['heading'] == "Bank Transfer" || $report['heading'] == "P2P")
                                            @for($i=0;$i<2;$i++)
                                                <tr>
                                                    @if($i == 0)
                                                        <td rowspan="2">{{$sn}}</td>
                                                        <td rowspan="2">{{$report['heading']}}</td>
                                                    @endif
                                                    <td>{{$report['particulars'][$i]}}</td>
                                                    <td>{{$report['total_number']}}</td>
                                                    <td>{{$report['data'][$i]}}</td>
                                                    <td>{{$report['previous_day_report'][$i]}}</td>
                                                    @if($report['change'][$i]['status'] == "positive")
                                                        <td style="color: green">{{$report['change'][$i]['change_value']}}</td>
                                                    @else
                                                        <td style="color: red">{{$report['change'][$i]['change_value']}}</td>
                                                    @endif
                                                </tr>
                                            @endfor
                                        @else
                                            <tr>
                                                <td>{{$sn}}</td>
                                                <td>{{$report['heading']}}</td>
                                                <td>{{$report['particulars']}}</td>
                                                <td>{{$report['total_number']}}</td>
                                                <td>{{$report['data']}}</td>
                                                <td>{{$report['previous_day_report']}}</td>
                                                @if($report['change'] == "")
                                                    <td>{{$report['change']}}</td>
                                                @else
                                                    @if($report['change']['status'] == "positive")
                                                        <td style="color: green">{{$report['change']['change_value']}}</td>
                                                    @else
                                                        <td style="color: red">{{$report['change']['change_value']}}</td>
                                                    @endif
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('styles')


    @include('admin.asset.css.datepicker')

    @include('admin.asset.css.chosen')

    @include('admin.asset.css.datatable')

@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')

@endsection





