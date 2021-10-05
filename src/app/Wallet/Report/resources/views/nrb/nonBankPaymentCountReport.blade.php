@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Non Bank Payment</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Non-Bank Payment Count</strong>
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
                    <div class="ibox-title collapse-link">
                        <h5>Filter Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    {{--                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>--}}
                    <div class="ibox-content">
                        <form role="form" method="get" action="{{ route('report.nonBankPaymentCountReport') }}"
                              id="filter">
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                        <input id="date_load_from" type="text"
                                               class="form-control date_from" placeholder="From"
                                               name="from" autocomplete="off"
                                               value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                    </div>
                                    <br>
                                </div>
                                <div class="col-6">
                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                        <input id="date_load_to" type="text"
                                               class="form-control date_to" placeholder="To" name="to"
                                               autocomplete="off"
                                               value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div>
                                <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                        formaction="{{ route('report.nonBankPaymentCountReport') }}">
                                    <strong>Filter</strong>
                                </button>
                            </div>
                            @include('admin.asset.components.clearFilterButton')
                        </form>
                        <br>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if(!empty($_GET))
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Statement of Successful and Failed Transaction for Non Bank Payment Service
                            Providers @if(!empty($_GET['from'] && $_GET['to'])) from {{ $_GET['from'] . ' to ' . $_GET['to'] }} @endif</h5>
                    </div>

                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Non bank payment count report">

                                <thead>

                                <tr>
                                    <th>S.No.</th>
                                    <th>Particulars</th>
                                    <th>Success Count</th>
                                    <th>Failed Count</th>
                                </tr>
                                </thead>
                                <tbody>
{{--                                {{dd($nonBankPayments)}}--}}
                                @foreach($nonBankPayments as $particular=>$nonBankPaymentCount)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$particular}}</td>
                                        <td>{{$nonBankPaymentCount['Successful Count']}}</td>
                                        <td>{{$nonBankPaymentCount['Failed Count']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
{{--        </div>--}}
@endsection


@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    {{--    <script>--}}
    {{--        $(document).ready(function (e) {--}}
    {{--            let a = "Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries";--}}
    {{--            $('.dataTables_info').text(a);--}}
    {{--        });--}}
    {{--    </script>--}}


    <script>
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

@endsection


