@extends('admin.layouts.admin_design')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Admin Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Admin Report</strong>
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


                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
{{--                                  --}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="input-group date">--}}
{{--                                                <br>--}}
{{--                                                <input id="date_load_to" type="text" class="form-control date_to"--}}
{{--                                                       placeholder="To" name="to" autocomplete="off"--}}
{{--                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                <input id="email" type="text" class="form-control"
                                                       placeholder="Email" name="email" autocomplete="off"
                                                       value="{{ !empty($_GET['email']) ? $_GET['email'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('report.adminKyc') }}"><strong>Generate
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
                @if(!empty($_GET))
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Paypoint report from {{ $_GET['from'] . ' to ' . $_GET['to'] }}</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Dpasis user's list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Admin name</th>
                                        <th>Admin email</th>
                                        <th>Kyc accepted</th>
                                        <th>Kyc rejected</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getAdminDatas as $getAdminData)
                                        @if(!empty($_GET['email']))
                                            @if($_GET['email'] == $getAdminData->email)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$getAdminData->name}}</td>
                                            <td>{{$getAdminData->email}}</td>
                                            <td>{{$getAdminData->accept_count}}</td>
                                            <td>{{$getAdminData->reject_count}}</td>
                                        </tr>
                                                @endif
                                        @else
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$getAdminData->name}}</td>
                                                <td>{{$getAdminData->email}}</td>
                                                <td>{{$getAdminData->accept_count}}</td>
                                                <td>{{$getAdminData->reject_count}}</td>
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






