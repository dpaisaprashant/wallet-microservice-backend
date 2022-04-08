@extends('admin.layouts.admin_design')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>User Device Info Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>User Device Info Report</strong>
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
                                                <span
                                                    class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                <span
                                                    class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                 <span
                                                     class="input-group-addon">
                                                    <i class="fa fa-mobile"></i>
                                                </span>
                                                <input id="mobile_no" type="text" class="form-control"
                                                       placeholder="User Mobile No" name="mobile_no" autocomplete="off"
                                                       value="{{ !empty($_GET['mobile_no']) ? $_GET['mobile_no'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('report.device.info') }}"><strong>Generate
                                                Report</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
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
                            <h5>User Device Info Report</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Wallet user's list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>User Name</th>
                                        <th>User Mobile</th>
                                        <th>Device Type</th>
                                        <th>Device Id</th>
                                        <th>Created at</th>
                                        <th>User Agent</th>
                                        <th>Base os</th>
                                        <th>Brand</th>
                                        <th>Build id</th>
                                        <th>Battery level</th>
                                        <th>Build number</th>
                                        <th>Carrier</th>
                                        <th>Device</th>
                                        <th>Display</th>
                                        <th>First install time</th>
                                        <th>Free disk storage</th>
                                        <th>Hardware</th>
                                        <th>Host</th>
                                        <th>Ip address</th>
                                        <th>Model</th>
                                        <th>System name</th>
                                        <th>System version</th>
                                        <th>Total disk capacity</th>
                                        <th>Total memory</th>
                                        <th>Unique id</th>
                                        <th>Version</th>
                                        <th>Device info json</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($deviceInfos as $deviceInfo)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$deviceInfo->user->name}}</td>
                                            <td>{{$deviceInfo->user->mobile_no}}</td>
                                            <td>{{$deviceInfo->device_type}}</td>
                                            <td>{{$deviceInfo->device_id}}</td>
                                            <td>{{$deviceInfo->created_at}}</td>
                                            <td>{{$deviceInfo->user_agent}}</td>
                                            <td>{{$deviceInfo->base_os}}</td>
                                            <td>{{$deviceInfo->brand}}</td>
                                            <td>{{$deviceInfo->build_id}}</td>
                                            <td>{{$deviceInfo->battery_level}}</td>
                                            <td>{{$deviceInfo->build_number}}</td>
                                            <td>{{$deviceInfo->carrier}}</td>
                                            <td>{{$deviceInfo->device}}</td>
                                            <td>{{$deviceInfo->display}}</td>
                                            <td>{{$deviceInfo->first_install_time}}</td>
                                            <td>{{$deviceInfo->free_disk_storage}}</td>
                                            <td>{{$deviceInfo->hardware}}</td>
                                            <td>{{$deviceInfo->host}}</td>
                                            <td>{{$deviceInfo->ip_address}}</td>
                                            <td>{{$deviceInfo->model}}</td>
                                            <td>{{$deviceInfo->system_name}}</td>
                                            <td>{{$deviceInfo->system_version}}</td>
                                            <td>{{$deviceInfo->total_disk_capacity}}</td>
                                            <td>{{$deviceInfo->total_memory}}</td>
                                            <td>{{$deviceInfo->unique_id}}</td>
                                            <td>{{$deviceInfo->version}}</td>
                                            <td>
                                                @include('WalletReport::deviceInfo.device-info-json', ['deviceInfo' => $deviceInfo])
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                                {{ $deviceInfos->appends(request()->query())->links() }}
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






