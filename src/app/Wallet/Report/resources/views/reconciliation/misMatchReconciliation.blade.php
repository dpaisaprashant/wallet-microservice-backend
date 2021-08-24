{{--
@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Mis Match Reconciliation Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Mis Match Reconciliation</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">


        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Mis Match Reconciliation Report</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Reconciliation Report">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Mobile Number</th>
                                    <th>Wallet Balance</th>
                                    <th>Main Balance</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($misMatchArray as $key=>$value)
                                    <tr>
                                        --}}
{{--{{ dd($value['walletMainBalance']) }}--}}{{--

                                        <td>{{ $key+1 }}</td>
                                        <td><a href="{{ route('report.reconciliation',['individual_user_number' => $value['mobileNumber']]) }}">{{ $value['mobileNumber'] }}</a></td>
                                        <td>Rs. {{ $value['walletMainBalance'] }}</td>
                                        <td>Rs. {{ $value['userMainBalance'] }}</td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
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





--}}
