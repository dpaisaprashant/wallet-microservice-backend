@extends('admin.layouts.admin_design')
@section('content')
    <?php
    use App\Models\Dispute;
    ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>View All Dispute</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    Disputes
                </li>

                <li class="breadcrumb-item active">
                    <strong>View</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Dispute</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content"
                         @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none" @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" >
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction Id"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="User"
                                                       class="form-control date"
                                                       value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose vendor type..." class="chosen-select"
                                                        tabindex="2" name="vendor_type">
                                                    <option value="" selected disabled>Select vendor type...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['vendor_type']))
                                                        <option value="NPAY"
                                                                @if($_GET['vendor_type']  == Dispute::VENDOR_TYPE_NPAY) selected @endif >{{Dispute::VENDOR_TYPE_NPAY}}</option>
                                                        <option value="PAYPOINT"
                                                                @if($_GET['vendor_type']  == 'PAYPOINT' ) selected @endif >{{ Dispute::VENDOR_TYPE_PAYPOINT }}</option>
                                                    @else
                                                        <option value="NPAY">{{Dispute::VENDOR_TYPE_NPAY}}</option>
                                                        <option value="PAYPOINT">{{ Dispute::VENDOR_TYPE_PAYPOINT }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose dispute type..." class="chosen-select"
                                                        tabindex="2" name="dispute_type">
                                                    <option value="" selected disabled>Select dispute type...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['dispute_type']))
                                                        <option value="CLEARANCE"
                                                                @if($_GET['dispute_type']  == Dispute::DISPUTE_TYPE_CLEARANCE) selected @endif >{{Dispute::DISPUTE_TYPE_CLEARANCE}}</option>
                                                        <option value="SINGLE"
                                                                @if($_GET['dispute_type']  == Dispute::DISPUTE_TYPE_SINGLE ) selected @endif >{{ Dispute::DISPUTE_TYPE_SINGLE }}</option>
                                                    @else
                                                        <option value="CLEARANCE">{{Dispute::DISPUTE_TYPE_CLEARANCE}}</option>
                                                        <option value="SINGLE">{{ Dispute::DISPUTE_TYPE_SINGLE }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose error source..." class="chosen-select"
                                                        tabindex="2" name="error_source">
                                                    <option value="" selected disabled>Select error source...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['error_source']))
                                                        <option value="SAJILOPAY"
                                                                @if($_GET['error_source']  == Dispute::SOURCE_SAJILOPAY) selected @endif >{{Dispute::SOURCE_SAJILOPAY}}</option>
                                                        <option value="PAYPOINT"
                                                                @if($_GET['error_source']  == Dispute::SOURCE_PAYPOINT ) selected @endif >{{ Dispute::SOURCE_PAYPOINT }}</option>
                                                        <option value="NPAY"
                                                                @if($_GET['error_source']  == Dispute::SOURCE_NPAY ) selected @endif >{{ Dispute::SOURCE_NPAY }}</option>
                                                    @else
                                                        <option value="SAJILOPAY">{{Dispute::SOURCE_SAJILOPAY}}</option>
                                                        <option value="PAYPOINT">{{ Dispute::SOURCE_PAYPOINT }}</option>
                                                        <option value="NPAY">{{ Dispute::SOURCE_NPAY }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select handler..." class="chosen-select"
                                                        tabindex="2" name="handler">
                                                    <option value="" selected disabled>Select handler...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['handler']))
                                                        <option value="AUTOMATIC"
                                                                @if($_GET['handler']  == Dispute::HANDLER_AUTOMATIC) selected @endif >{{Dispute::HANDLER_AUTOMATIC}}</option>
                                                        <option value="MANUAL_REIMBURSE"
                                                                @if($_GET['handler']  == Dispute::HANDLER_MANUAL_REIMBURSE ) selected @endif >{{ Dispute::HANDLER_MANUAL_REIMBURSE }}</option>
                                                        <option value="MANUAL_REIMBURSE"
                                                                @if($_GET['handler']  == Dispute::HANDLER_MANUAL_DEDUCTION ) selected @endif >{{ Dispute::HANDLER_MANUAL_DEDUCTION }}</option>
                                                        <option value="CLEARANCE"
                                                                @if($_GET['handler']  == Dispute::HANDLER_CLEARANCE ) selected @endif >{{ Dispute::HANDLER_CLEARANCE }}</option>
                                                        <option value="DO_NOTHING"
                                                                @if($_GET['handler']  == Dispute::HANDLER_DO_NOTHING ) selected @endif >{{ Dispute::HANDLER_DO_NOTHING }}</option>
                                                    @else
                                                        <option
                                                            value="AUTOMATIC">{{Dispute::HANDLER_AUTOMATIC}}</option>
                                                        <option
                                                            value="MANUAL_REIMBURSE">{{ Dispute::HANDLER_MANUAL_REIMBURSE }}</option>
                                                        <option
                                                            value="MANUAL_DEDUCTION">{{ Dispute::HANDLER_MANUAL_DEDUCTION }}</option>
                                                        <option
                                                            value="CLEARANCE">{{ Dispute::HANDLER_CLEARANCE }}</option>
                                                        <option
                                                            value="DO_NOTHING">{{ Dispute::HANDLER_DO_NOTHING }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select user dispute status..."
                                                        class="chosen-select" tabindex="2" name="user_dispute_status">
                                                    <option value="" selected disabled>Select user dispute status...
                                                    </option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['user_dispute_status']))
                                                        <option value="STARTED"
                                                                @if($_GET['user_dispute_status']  == Dispute::USER_DISPUTE_STATUS_STARTED) selected @endif >{{Dispute::USER_DISPUTE_STATUS_STARTED}}</option>
                                                        <option value="PROCESSING"
                                                                @if($_GET['user_dispute_status']  == Dispute::USER_DISPUTE_STATUS_PROCESSING ) selected @endif >{{ Dispute::USER_DISPUTE_STATUS_PROCESSING }}</option>
                                                        <option value="REPOSTED"
                                                                @if($_GET['user_dispute_status']  == Dispute::USER_DISPUTE_STATUS_REPOSTED ) selected @endif >{{ Dispute::USER_DISPUTE_STATUS_REPOSTED }}</option>
                                                        <option value="CLEARED"
                                                                @if($_GET['user_dispute_status']  == Dispute::USER_DISPUTE_STATUS_CLEARED ) selected @endif >{{ Dispute::USER_DISPUTE_STATUS_CLEARED }}</option>
                                                        <option value="REJECTED"
                                                                @if($_GET['user_dispute_status']  == Dispute::USER_DISPUTE_STATUS_REJECTED ) selected @endif >{{ Dispute::USER_DISPUTE_STATUS_REJECTED }}</option>
                                                    @else
                                                        <option
                                                            value="STARTED">{{Dispute::USER_DISPUTE_STATUS_STARTED}}</option>
                                                        <option
                                                            value="PROCESSING">{{ Dispute::USER_DISPUTE_STATUS_PROCESSING }}</option>
                                                        <option
                                                            value="REPOSTED">{{ Dispute::USER_DISPUTE_STATUS_REPOSTED }}</option>
                                                        <option
                                                            value="CLEARED">{{ Dispute::USER_DISPUTE_STATUS_CLEARED }}</option>
                                                        <option
                                                            value="REJECTED">{{ Dispute::USER_DISPUTE_STATUS_REJECTED }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select clearance dispute status..."
                                                        class="chosen-select" tabindex="2"
                                                        name="clearance_dispute_status">
                                                    <option value="" selected disabled>Select clearance dispute
                                                        status...
                                                    </option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['clearance_dispute_status']))
                                                        <option value="STARTED"
                                                                @if($_GET['clearance_dispute_status']  == Dispute::CLEARANCE_DISPUTE_STATUS_STARTED) selected @endif >{{Dispute::CLEARANCE_DISPUTE_STATUS_STARTED}}</option>
                                                        <option value="PROCESSING"
                                                                @if($_GET['clearance_dispute_status']  == Dispute::CLEARANCE_DISPUTE_STATUS_PROCESSING ) selected @endif >{{ Dispute::CLEARANCE_DISPUTE_STATUS_PROCESSING }}</option>
                                                        <option value="CLEARED"
                                                                @if($_GET['clearance_dispute_status']  == Dispute::CLEARANCE_DISPUTE_STATUS_CLEARED ) selected @endif >{{ Dispute::CLEARANCE_DISPUTE_STATUS_CLEARED }}</option>
                                                    @else
                                                        <option
                                                            value="STARTED">{{Dispute::CLEARANCE_DISPUTE_STATUS_STARTED}}</option>
                                                        <option
                                                            value="PROCESSING">{{ Dispute::CLEARANCE_DISPUTE_STATUS_PROCESSING }}</option>
                                                        <option
                                                            value="CLEARED">{{ Dispute::CLEARANCE_DISPUTE_STATUS_CLEARED }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <label for="total_transaction_amount">Total Vendor Amount</label>
                                            <input type="text" name="total_vendor_amount"
                                                   class="ionrange_total_transaction_amount">
                                        </div>

                                    </div>
                                    <br>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('dispute.view.all') }}"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('dispute.excel') }}"><strong>Excel</strong></button>
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
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of disputed transactions</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Dispute transactions list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Transaction Id</th>
                                    <th>User</th>
                                    <th>Vendor Type</th>
                                    <th>Dispute Type</th>
                                    <th>Vendor Amount</th>
                                    <th>Error Source</th>
                                    <th>Handler</th>
                                    <th>User Dispute Status</th>
                                    <th>Clearance Dispute Status</th>
                                    <th>Dispute created at</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($disputes as $dispute)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($disputes->perPage() * ($disputes->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                            @if($dispute->vendor_type == \App\Models\Dispute::VENDOR_TYPE_PAYPOINT)
                                                {{ $dispute->disputeable->refStan }}
                                            @elseif($dispute->vendor_type == \App\Models\Dispute::VENDOR_TYPE_NPAY)
                                                {{ $dispute->disputeable['transaction_id'] }}
                                            @else
                                                {{ $dispute->disputeable['transaction_id'] }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $dispute->disputeable->user['mobile_no'] }}
                                        </td>
                                        <td>
                                            {{ $dispute->vendor_type }}
                                        </td>
                                        <td>
                                            {{ $dispute->dispute_type }}
                                        </td>
                                        <td>
                                            Rs. {{ $dispute->vendor_amount ?? 0}}
                                        </td>
                                        <td>
                                            {{ $dispute->source }}
                                        </td>
                                        <td>
                                            {{ $dispute->handler }}
                                        </td>

                                        <td>
                                            @include('admin.dispute.status.userStatus', ['dispute' => $dispute])
                                        </td>

                                        <td>
                                            @include('admin.dispute.status.clearanceStatus', ['dispute' => $dispute])
                                        </td>

                                        <td>
                                            {{ date('d M, Y H:i:s', strtotime($dispute->created_at)) }}
                                        </td>
                                        <td class="center">
                                            <a style="margin-top: 5px;" class="btn btn-sm btn-danger m-t-n-xs btn-icon"
                                               href="{{ route('dispute.detail', $dispute->id) }}"
                                               title="Resolve User Dispute"><i class="fa fa-user-times"></i></a>

                                            <a style="margin-top: 5px;"
                                               class="btn btn-sm btn-warning m-t-n-xs btn-icon"
                                               href="{{ route('dispute.detail.clearance', $dispute->id) }}"
                                               title="Resolve Clearance Dispute"><i class="fa fa-money"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $disputes->appends(request()->query())->links() }}
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

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datatable')
    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $disputes->firstItem() }} to {{ $disputes->lastItem() }} of {{ $disputes->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>
    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let stats = @if(!empty($_GET['total_vendor_amount'])) `{{ $_GET['total_vendor_amount'] }}`; @else '0;100000'; @endif
        let split = stats.split(';');

        $(".ionrange_total_transaction_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });
    </script>
@endsection


