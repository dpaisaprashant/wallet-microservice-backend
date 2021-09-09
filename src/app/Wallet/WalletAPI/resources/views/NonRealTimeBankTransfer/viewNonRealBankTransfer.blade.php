@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Non Real Bank Transfer</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>View Non Real Bank Transfer</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>All</strong>
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
                        <h5>Non Real Bank Transfer</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="" id="filter">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select data-placeholder="Select admin...." class="chosen-select"
                                                        tabindex="2" name="admin">
                                                    <option value="" selected disabled>Select admin...</option>

                                                    @if(!empty($_GET['admin']))
                                                        <option value="all"
                                                                @if($_GET['admin'] == 'all') selected @endif>All
                                                        </option>

                                                        @foreach($admins as $key=>$admin)
                                                            @foreach($nonRealTimeBankTransferDetails as $key=>$nonRealTimeBankTransferDetail)
                                                                @if($admin->id == $nonRealTimeBankTransferDetail->backendNonRealTime->user_id)
                                                                    <?php
                                                                    $adminName[] = $admin->name;
                                                                    $result = array_unique($adminName);
                                                                    ?>
                                                                @endif
                                                            @endforeach
                                                        @endforeach

                                                        @foreach($result as $key=>$value)
                                                            <option value="{{ $value }}"
                                                                    @if($_GET['admin'] == $value) selected @endif>{{ $value }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="all">All</option>
                                                        @foreach($admins as $key=>$admin)
                                                            @foreach($nonRealTimeBankTransferDetails as $key=>$nonRealTimeBankTransferDetail)
                                                                @if($admin->id == $nonRealTimeBankTransferDetail->backendNonRealTime->user_id)
                                                                    <?php
                                                                        $adminName[] = $admin->name;
                                                                        $result = array_unique($adminName);
                                                                    ?>
                                                                @endif
                                                            @endforeach
                                                        @endforeach

                                                        @foreach($result as $key=>$value)
                                                            <option value="{{ $value }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="Select Vendor...." class="chosen-select"
                                                        tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>

                                                    @if(!empty($_GET['vendor']))
                                                        <option value="all"
                                                                @if($_GET['vendor'] == 'all') selected @endif>All
                                                        </option>
                                                        @foreach($nonRealTimeBankTransferDetails as $key=>$nonRealTimeBankTransferDetail)
                                                            <?php
                                                            $vendor[] = $nonRealTimeBankTransferDetail->vendor;
                                                            $result = array_unique($vendor);
                                                            ?>
                                                        @endforeach
                                                        @foreach($result as $key=>$value)
                                                            <option value="{{ $value }}"
                                                                    @if($_GET['vendor'] == $value) selected @endif>{{ $value }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="all">All</option>
                                                        @foreach($nonRealTimeBankTransferDetails as $key=>$nonRealTimeBankTransferDetail)
                                                            <?php
                                                            $vendor[] = $nonRealTimeBankTransferDetail->vendor;
                                                            $result = array_unique($vendor);
                                                            ?>
                                                        @endforeach
                                                        @foreach($result as $key=>$value)
                                                            <option value="{{ $value }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="debit_status">
                                                    <option value="" selected disabled>Select debit status...</option>

                                                    @if(!empty($_GET['debit_status']))
                                                        <option value="all"
                                                                @if($_GET['debit_status'] == 'all') selected @endif>All
                                                        </option>
                                                        @foreach($nonRealTimeBankTransferDetails as $key=>$nonRealTimeBankTransferDetail)
                                                            <?php
                                                            $debitStatus[] = $nonRealTimeBankTransferDetail->debit_status;
                                                            $result = array_unique($debitStatus);
                                                            ?>
                                                        @endforeach
                                                        @foreach($result as $key=>$value)
                                                            <option value="{{ $value }}"
                                                                    @if($_GET['debit_status'] == $value) selected @endif>{{ $value }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="all">All</option>
                                                        @foreach($nonRealTimeBankTransferDetails as $key=>$nonRealTimeBankTransferDetail)
                                                            <?php
                                                            $debitStatus[] = $nonRealTimeBankTransferDetail->debit_status;
                                                            $result = array_unique($debitStatus);
                                                            ?>
                                                        @endforeach
                                                        @foreach($result as $key=>$value)
                                                            <option value="{{ $value }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction type..."
                                                        class="chosen-select" tabindex="2" name="credit_status">
                                                    <option value="" selected disabled>Select credit status...
                                                    </option>
                                                    @if(!empty($_GET['credit_status']))
                                                        <option value="all"
                                                                @if($_GET['credit_status'] == 'all') selected @endif>All
                                                        </option>
                                                        @foreach($nonRealTimeBankTransferDetails as $key=>$nonRealTimeBankTransferDetail)
                                                            <?php
                                                            $creditStatus[] = $nonRealTimeBankTransferDetail->credit_status;
                                                            $result = array_unique($creditStatus);
                                                            ?>
                                                        @endforeach
                                                        @foreach($result as $key=>$value)
                                                            <option value="{{ $value }}"
                                                                    @if($_GET['credit_status'] == $value) selected @endif>{{ $value }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="all">All</option>
                                                        @foreach($nonRealTimeBankTransferDetails as $key=>$nonRealTimeBankTransferDetail)
                                                            <?php
                                                            $creditStatus[] = $nonRealTimeBankTransferDetail->credit_status;
                                                            $result = array_unique($creditStatus);
                                                            ?>
                                                        @endforeach
                                                        @foreach($result as $key=>$value)
                                                            <option value="{{ $value }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('nonRealTime.view') }}"><strong>Filter</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('transaction.complete.excel') }}">
                                            <strong>Excel</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($_GET))
            <div class="alert alert-warning">
                <i class="fa fa-info-circle"></i>&nbsp;&nbsp; <b>Check status</b> sends request to NCHL to get updated response.<br>
                <i class="fa fa-info-circle"></i>&nbsp;&nbsp; <b>Response after transaction status</b> displays updated response
                from the NCHL.<br>
                <i class="fa fa-info-circle"></i>&nbsp;&nbsp; <b>Request</b> displays all the fields before sending
                request to NCHL<br>
                <i class="fa fa-info-circle"></i>&nbsp;&nbsp; <b>Response</b> displays the data that is received back
                from NCHL<br>
                <i class="fa fa-info-circle"></i>&nbsp;&nbsp; <b>Account</b> contains the data regarding creditor
                agent,creditor branch, creditor name and creditor account
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @include('admin.asset.notification.notify')

                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of non real time bank transfer</h5>

                        </div>

                        <div class="ibox-content">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Non Real Time Bank Transfer List">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Admin</th>
                                        <th>Transaction Id</th>
                                        <th>Amount</th>
                                        <th>Transaction Fee</th>
                                        <th>Debit Response Id</th>
                                        <th>Credit Response Id</th>
                                        <th>Debit Status</th>
                                        <th>Credit Status</th>
                                        {{--<th>UserType</th>--}}
                                        <th>Debit Response Message</th>
                                        <th>Credit Response Message</th>
                                        <th>Response After Transaction Status</th>
                                        <th>Vendor</th>
                                        <th>Check Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($nonRealTimeBankTransferDetails as $key=>$nonRealTimeBankTransferDetail)

                                        <tr>
                                            <td>{{ $loop->index + ($nonRealTimeBankTransferDetails->perPage() * ($nonRealTimeBankTransferDetails->currentPage() - 1)) + 1 }}</td>
                                            <td>{{ $nonRealTimeBankTransferDetail->backendNonRealTime->admin->name }}</td>
                                            <td>{{ $nonRealTimeBankTransferDetail->transaction_id }}</td>
                                            <td>{{ $nonRealTimeBankTransferDetail->amount }}</td>
                                            <td>{{ $nonRealTimeBankTransferDetail->transaction_fee }}</td>
                                            <td>{{ $nonRealTimeBankTransferDetail->debit_response_id }}</td>
                                            <td>{{ $nonRealTimeBankTransferDetail->credit_response_id }}</td>
                                            <td>
                                                @if($nonRealTimeBankTransferDetail->debit_status == '000')
                                                    <span class="badge badge-primary">000</span>
                                                @else
                                                    <span
                                                        class="badge badge-danger">{{ $nonRealTimeBankTransferDetail->debit_status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $nonRealTimeBankTransferDetail->credit_status }}</td>
                                            <td>{{ $nonRealTimeBankTransferDetail->debit_response_message }}</td>
                                            <td>{{ $nonRealTimeBankTransferDetail->credit_response_message }}</td>
                                            <td>@include('WalletAPI::NonRealTimeBankTransfer.include.responseAfterTransactionStatus',['response'=>$nonRealTimeBankTransferDetail->response_after_transaction_status,'transaction_id'=>$nonRealTimeBankTransferDetail->transaction_id])</td>
                                            <td>{{ $nonRealTimeBankTransferDetail->vendor }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('nonRealTime.check',$nonRealTimeBankTransferDetail->transaction_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-success btn-icon" type="submit"
                                                            title="Check NCHL Response"><i class="fa fa-paper-plane"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                @include('WalletAPI::NonRealTimeBankTransfer.include.request',['request' => $nonRealTimeBankTransferDetail->request,'transaction_id'=>$nonRealTimeBankTransferDetail->transaction_id.$nonRealTimeBankTransferDetail->id.'1'])
                                                @include('WalletAPI::NonRealTimeBankTransfer.include.response',['response' => $nonRealTimeBankTransferDetail->response,'transaction_id'=>$nonRealTimeBankTransferDetail->transaction_id.$nonRealTimeBankTransferDetail->id.'2'])
                                                @include('WalletAPI::NonRealTimeBankTransfer.include.action',['account' => $nonRealTimeBankTransferDetail->account,'transaction_id'=>$nonRealTimeBankTransferDetail->transaction_id.$nonRealTimeBankTransferDetail->id.'3'])
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                {{--     {{ $nonRealTimeBankTransferDetails->appends(request()->query())->links() }}--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
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
    {{--<script>
        @if(!empty($_GET))
        $(document).ready(function (e) {
            let a = "Showing {{ $nonRealTimeBankTransferDetails->firstItem() }} to {{ $nonRealTimeBankTransferDetails->lastItem() }} of {{ $nonRealTimeBankTransferDetails->total() }} entries";
            $('.dataTables_info').text(a);
        });
        @endif
    </script>--}}

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`;
        @else '0;100000'; @endif
        let split = amount.split(';');
        $(".ionrange_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });
    </script>

    <script>
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

@endsection


