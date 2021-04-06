@extends('admin.layouts.admin_design')
@section('content')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2>Clearance report</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        Clearance
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Clearance report</strong>
                    </li>
                </ol>
            </div>
            {{--<div class="col-lg-4">
                <div class="title-action">
                    <a href="invoice_print.html" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Report </a>
                </div>
            </div>--}}
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content p-xl">
                        <div class="row" style="display: block; margin-bottom: 80px;">
                            <h1 style="text-align: center !important; font-weight: 300">{{ strtoupper('PayPoint Clearance report for ' ) }} <span style="font-weight: 800">
                                    <br>
                                    {{ date('d M, Y', strtotime($date['from'])) . ' - ' . date('d M, Y', strtotime($date['to']))}}</span></h1>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <span style="font-size: 1.1em">Report summary: </span>
                                <address style="margin-top: 10px;">
                                    <strong>Transaction type: </strong> &nbsp;Paypoint <br>
                                    <strong>Transaction Count: </strong> &nbsp; {{ $transactions->count() }} <br>
                                    <strong>Total Transaction Amount: </strong> &nbsp; Rs. {{ $transactions->sum('amount') }} <br>
                                    <strong>Total Transaction Fee: </strong> &nbsp; Rs. {{ (new \App\Models\UserTransaction())->getTotalTransactionFee($transactions) }} <br>
                                    <strong>Total Commission Amount: </strong> &nbsp; Rs. {{ (new \App\Models\UserTransaction())->getTotalCommission($transactions) }}  <br>
                                    <strong>Total Cash Back Amount: </strong> &nbsp; Rs. {{ (new \App\Models\UserTransaction())->getTotalCashback($transactions) }}  <br>
                                    <strong>
                                        <?php
                                        $cleared = false;
                                        $index = 0;
                                        foreach ($transactions as $key => $transaction) {
                                            if ($transaction->clearanceTransactions != null){
                                                $index = $key;
                                                $cleared = true;
                                                break;
                                            }
                                        }
                                        ?>
                                        Cleared Status:
                                        @include('admin.clearance.status', ['clearanceTransactions' => [$transactions[$index]->clearanceTransactions]])
                                    </strong>
                                </address>
                            </div>
                                    <div class="col-sm-6 text-right">
                                        @if(!empty($transactions[0]->clearanceTransactions))
                                            <h4>Cleared By:
                                                <span class="text-navy">{{ auth()->user()->email }}</span>
                                            </h4>
                                        @else
                                            <h4>Cleared By:
                                                <span class="text-navy">Not cleared</span>
                                            </h4>
                                        @endif
                                    </div>
                        <div class="table-responsive m-t">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="PayPoint clearance transaction for {{ $date['from'] . ' to ' . $date['to'] }}">
                                <thead>
                                <tr>
                                    <th>RefStan</th>
                                    <th>Transaction Amount</th>
                                    <th>Vendor</th>
                                    <th>Transaction Fee</th>
                                    <th>Commission</th>
                                    <th>Cash Back</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                    <td>{{ $transaction->refStan }}</td>
                                    <td>Rs. {{ $transaction->amount }}</td>
                                    <td>{{ $transaction->vendor }}</td>
                                    <td>{{ $transaction->getTransactionFee() }}</td>
                                    <td>Rs. {{ $transaction->getCommission() }}</td>
                                    <td>Rs. {{ $transaction->getCashback() }}</td>
                                </tr>
                                @endforeach
                                <tr style="font-size: 1.1em; height: 15px;">
                                    <td style="padding-top: 10px;"><strong>TOTAL :</strong></td>
                                    <td  style="padding-top: 10px;"><strong>Rs. {{ $transactions->sum('amount') }}</strong></td>
                                    <td></td>
                                    <td  style="padding-top: 10px;"><strong>Rs.  {{ (new \App\Models\UserTransaction())->getTotalTransactionFee($transactions) }}  </strong></td>
                                    <td  style="padding-top: 10px;"><strong>Rs.  {{ (new \App\Models\UserTransaction())->getTotalCommission($transactions) }}  </strong></td>
                                    <td  style="padding-top: 10px;"><strong>Rs.  {{ (new \App\Models\UserTransaction())->getTotalCashback($transactions) }}  </strong></td>
                                </tr>
                                </tbody>
                            </table>
                           {{-- {{ $transactions->appends(request()->query())->links() }}--}}
                        </div><!-- /table-responsive -->

                        @can('Clearance paypoint clear transaction')
                        <div class="text-right" style="width: 100%">
                            <div class="col-md-4" style="float: right">
                                @if(($transactions[$index]->clearanceTransactions) === null)
                                    <form id="excelClearance" action="{{ route('clearance.payPoint') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="dateFrom" value="{{ $date['from'] }}">
                                    <input type="hidden" name="dateTo" value="{{ $date['to'] }}">
                                    <input type="hidden" name="transaction_type" value="payPoint">

                                    <div class="input-group date">
                                        <div class="custom-file" style="margin-right: 19px;">
                                            <input name="file" id="logo1" type="file" class="custom-file-input">
                                            <label for="logo1" class="custom-file-label">Upload excel file&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        </div>
                                    </div>
                                    <br>
                                    <button id="print" type="submit" class="btn btn-primary" formtarget="_blank" style="float: right; margin-right: 17px;">Clear All Transactions</button>
                                    <button id="printReport" type="submit" class="btn btn-primary clear" formtarget="_blank" rel="{{ route('clearance.payPoint') }}" style="display: none"></button>
                                </form>
                                @elseif($transactions[$index]->clearanceTransactions->clearances->clearance_status === "0")
                                    <span class="badge badge-warning" style="padding: 5px;">All Transaction cleared</span>
                                    <br>
                                    <a target="_blank" href="{{ route('paypoint.generateClearanceReport', $transactions[$index]->clearanceTransactions->clearance_id) }}" class="btn btn-primary">Get Report</a>
                                @elseif ($transactions[$index]->clearanceTransactions->clearances->clearance_status === "1")
                                    <span class="badge badge-warning" style="padding: 5px;">All Transaction signed</span>
                                    <br>
                                    <a target="_blank" href="{{ route('paypoint.generateClearanceReport', $transactions[$index]->clearanceTransactions->clearance_id) }}" class="btn btn-primary">Get Report</a>
                                @else
                                    <span class="badge badge-danger" style="padding: 5px;">Dispute in transactions</span>
                                @endif
                            </div>
                        </div>
                        @endcan
                        {{--<div class="well m-t"><strong>Comments</strong>
                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('styles')
    @include('admin.asset.css.datatable')
    <!-- Sweet Alert -->
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $('#print').on('click', function (e) {

            let excel = $('#logo1').val();

            if(!excel) {
                alert('import a excel file!!!!!!!');
                e.preventDefault();
                return;
            }

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "All the listed transaction will be cleared",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, clear Transactions!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#printReport').trigger('click');
                $('#print').hide();
                $('#excelClearance').hide();
                swal.close();

            })
        });
    </script>

    @include('admin.asset.js.datatableWithPaging')

        <script>
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
        </script>
@endsection
