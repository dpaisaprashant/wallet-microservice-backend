@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Generated Active Inactive User Report (w/ Amount)</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Generated Active Inactive User Report (w/ Amount)</strong>
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
                        <h5>List of Generated Active/Inactive User Reports</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Generated Active/Inactive User Reports">
                                <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>As of Date</th>
                                    <th>Amount From (Rs.)</th>
                                    <th>Amount To (Rs.)</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($generatedReports as $key => $report)
                                    @php
                                        $convertedDate= \Carbon\Carbon::parse($report->as_of_date)->format('d M, Y');
                                    @endphp
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$report->as_of_date}}</td>
                                        <td>@if(($report->slab_from/100) == -1000000) 0 @else {{$report->slab_from/100}} @endif</td>
                                        <td>{{$report->slab_to/100}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning m-t-n-xs"
                                               style="margin-right: 10px;"
                                               href="{{ route('report.active.inactive.user.slab',['from'=>$convertedDate,'from_amount'=>$report->slab_from/100,'to_amount'=>$report->slab_to/100]) }}">
                                                <strong><i class="fa fa-bar-chart"></i> &nbsp;View More</strong></a>

                                            <button
                                                class="reset btn btn-sm btn-danger m-t-n-xs"
                                                rel="{{ $report->id }}"><i
                                                    class="fa fa-trash"></i>
                                            </button>

                                            <form action="{{ route('report.active.inactive.user.slab.delete',$report->id) }}"
                                                  method="POST">
                                                @csrf
                                                <button id="resetBtn-{{ $report->id }}"
                                                        style="display: none" type="submit"
                                                        href="{{ route('report.active.inactive.user.slab.delete',$report->id) }}"
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


