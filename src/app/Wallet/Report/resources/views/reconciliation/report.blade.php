@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Reconciliation Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Reconciliation</strong>
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
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="user_type" style="padding-top:10px">User Type</label>
                                                <select data-placeholder="Select CellPay User Transaction status..."
                                                        class="chosen-select" tabindex="2" name="report_type" required>
                                                    <option value="" selected disabled>Select Report Type: </option>
                                                    @if(!empty($_GET['report_type']))
                                                        <option value="agent"
                                                                @if($_GET['report_type']  == 'agent') selected @endif >
                                                            AGENT
                                                        </option>
                                                        <option value="user-only"
                                                                @if($_GET['report_type'] == 'user-only') selected @endif>
                                                            USER ONLY
                                                        </option>
                                                        <option value="all"
                                                                @if($_GET['report_type'] == "all") selected @endif>
                                                            ALL
                                                        </option>
                                                    @else
                                                        <option value="agent">AGENT</option>
                                                        <option value="user-only">USER ONLY</option>
                                                        <option value="all">ALL</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('report.reconciliation') }}"><strong>Generate Report</strong></button>
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
                @if(!empty($_GET['from']) && !empty($_GET['to']))
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Reconciliation report from {{ $_GET['from'] . ' to ' . $_GET['to'] }}</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" title="Wallet user's list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Particulars</th>
                                        <th>Total</th>
                                        <th>Transaction Type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($total = 0)
                                    @foreach($reports as $report)
                                        @php($total = $report->total + $total)
                                        <tr class="gradeX">
                                            <td>{{ $loop->iteration}}</td>
                                            <td>
                                                @if($report->transaction_type == \App\Models\BfiGatewayExecutePayment::class)
                                                    Bfi Gateway Execute Payment
                                                @elseif($report->transaction_type == \App\Models\BfiToUserFundTransfer::class)
                                                    Bfi to User Fund Transfer
                                                @elseif($report->transaction_type == 'App\Models\EventTicketSale')
                                                    Event Ticket Sale
                                                @elseif($report->transaction_type == \App\Models\FundRequest::class)
                                                    Fund Request
                                                @elseif($report->transaction_type == \App\Models\KhaltiUserTransaction::class)
                                                    Khalti User Transaction
                                                @elseif($report->transaction_type == \App\Models\LoadTestFund::class)
                                                    Load Test Fund
                                                @elseif($report->transaction_type == \App\Models\MerchantTransaction::class)
                                                    Merchant Transaction
                                                @elseif($report->transaction_type == \App\Models\NchlAggregatedPayment::class)
                                                    Nchl Aggregated Payment
                                                @elseif($report->transaction_type == \App\Models\NchlBankTransfer::class)
                                                    Nchl Bank Transfer
                                                @elseif($report->transaction_type == \App\Models\NchlLoadTransaction::class)
                                                    Nchl Load Transaction
                                                @elseif($report->transaction_type == \App\Models\NeaTransaction::class)
                                                    Nea Transaction
                                                @elseif($report->transaction_type == \App\Models\NPSAccountLinkLoad::class)
                                                    Nps Account Link Load
                                                @elseif($report->transaction_type == \App\Models\NpsLoadTransaction::class)
                                                    Nps Load Transaction
                                                @elseif($report->transaction_type == \App\Models\PaymentNepalLoadTransaction::class)
                                                    Payment Nepal Load Transaction
                                                @elseif($report->transaction_type == \App\Models\TicketSale::class)
                                                    Ticket Sale
                                                @elseif($report->transaction_type == \App\Models\UserLoadTransaction::class)
                                                    User Load Transaction
                                                @elseif($report->transaction_type == \App\Models\UserToBfiFundTransfer::class)
                                                    User To Bfi Fund Transfer
                                                @elseif($report->transaction_type == \App\Models\UserToUserFundTransfer::class)
                                                    User to User Fund Transfer
                                                @elseif($report->transaction_type == \App\Wallet\Commission\Models\Commission::class)
                                                    Commission
                                                @else
                                                    {{$report->transaction_type}}
                                                @endif
                                            </td>
                                            <td> Rs. {{$report->total}}</td>
                                            <td>{{$report->account_type}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td><b>Total Amount: </b></td>
                                        <td>Rs. {{ $total}}</td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
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





