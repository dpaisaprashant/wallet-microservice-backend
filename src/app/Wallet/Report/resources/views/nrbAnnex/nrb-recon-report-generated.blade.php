@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Generated NRB Reconciliation Reports</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Generated NRB Reconciliation Reports</strong>
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
                        <h5>List of Generated NRB Reconciliation Reports</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Generated NRB Reconciliation Reports">
                                <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Opening Balance</th>
                                    <th>Balance per Statement</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($generatedReports as $key => $report)
                                    @php
                                        $convertedFromDate= \Carbon\Carbon::parse($report->from_date)->format('d M, Y');
                                       $convertedToDate= \Carbon\Carbon::parse($report->to_date)->format('d M, Y');
                                    @endphp
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$report->from_date}}</td>
                                        <td>{{$report->to_date}}</td>
                                        <td>{{$report->opening_balance}}</td>
                                        <td>{{$report->balance_per_statement}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning m-t-n-xs"
                                               style="margin-right: 10px;"
                                               href="{{ route('report.nrb.annex.reconciliation', $report) }}">
                                                <strong><i class="fa fa-bar-chart"></i> &nbsp;View More</strong></a>

                                            <button
                                                class="reset btn btn-sm btn-danger m-t-n-xs"
                                                rel="{{ $report->id }}"><i
                                                    class="fa fa-trash"></i>
                                            </button>

                                            <form action="{{ route('report.nrb.annex.reconciliation.delete',$report->id) }}"
                                                  method="POST">
                                                @csrf
                                                <button id="resetBtn-{{ $report->id }}"
                                                        style="display: none" type="submit"
                                                        href="{{ route('report.nrb.annex.reconciliation.delete',$report->id) }}"
                                                        class="resetBtn btn btn-sm btn-danger m-t-n-xs">
                                                    <i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
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
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')
    @include('admin.asset.css.sweetalert')

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    @include('admin.asset.js.sweetalert')
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let report_id = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "The generated report data will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + report_id).trigger('click');
                swal.close();

            })
        });
    </script>

    <script>
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

@endsection


