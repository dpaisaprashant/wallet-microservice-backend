@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Nchl Bank Transfer Audit Trial</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Audit Trial</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Nchl Bank Transfer</strong>
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
                        <h5>Filter Audit Trials</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" >
                                    <div class="row">
                                        <div class="col-md-6" >
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6" >
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <br>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('auditTrail.nchl.bankTransfer') }}"><strong>Filter</strong></button>
                                    </div>
                                    {{--<div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('npayAuditTrail.excel') }}"><strong>Excel</strong></button>
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
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Transaction audit trials</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="SajiloPay Audit Trial - Nchl Bank Transfer">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Vendor</th>
                                    <th>Transaction Id</th>
                                    <th>Status</th>
                                    <th style="width: 1%">Vendor Commission</th>
                                    <th style="width: 1%">User Commission</th>
                                    <th style="width: 1%">Cash Back</th>
                                    <th>Amount</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php global $balance; $balance = 0?>
                                @foreach($events as $event)
                                    @if($event instanceof \App\Models\NchlBankTransfer)
                                        @include('admin.auditTrial.types.nchlBankTransfer')
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            {{ $events->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datatable')
    @include('admin.asset.css.datepicker')
@endsection

@section('scripts')
   @include('admin.asset.js.chosen')
   @include('admin.asset.js.datepicker')
   @include('admin.asset.js.datatable')
   <script>
       $(document).ready(function (e) {
           let a = "Showing {{ $events->firstItem() }} to {{ $events->lastItem() }} of {{ $events->total() }} entries";
           $('.dataTables_info').text(a);
       });
   </script>
@endsection


