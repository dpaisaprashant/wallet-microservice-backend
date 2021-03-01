@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>View Paypoint Clearance</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    Paypoint Clearance
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
                        <h5>Filter Clearance</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="cleared_by" placeholder="Enter cleared by user's name" class="form-control" value="{{ !empty($_GET['cleared_by']) ? $_GET['cleared_by'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="transaction_date" placeholder="Select transaction date" class="form-control date" value="{{ !empty($_GET['transaction_date']) ? $_GET['transaction_date'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="clearance_date" placeholder="Select clearance date" class="form-control date" value="{{ !empty($_GET['clearance_date']) ? $_GET['clearance_date'] : '' }}">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2" name="status">
                                                    <option value="" selected disabled>Select status By...</option>
                                                    <option value="" >All</option>
                                                    @if(!empty($_GET['status']))
                                                        <option value="cleared" @if($_GET['status']  == 'cleared') selected @endif >CLEARED</option>
                                                        <option value="signed" @if($_GET['status']  == 'signed') selected @endif >SIGNED</option>
                                                    @else
                                                        <option value="cleared">CLEARED</option>
                                                        <option value="signed">SIGNED</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="transaction_count">Transaction Count</label>
                                            <input type="text" name="transaction_count" class="ionrange_transaction_count">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="total_transaction_amount">Total Transaction Amount</label>
                                            <input type="text" name="total_transaction_amount" class="ionrange_total_transaction_amount">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="total_transaction_commission">Total Transaction Commission</label>
                                            <input type="text" name="total_transaction_commission" class="ionrange_total_transaction_commission">
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" style="margin-top: 40px;">
                                                <select data-placeholder="Sort By..." class="chosen-select"  tabindex="2" name="sort">
                                                    <option value="" selected disabled>Sort By...</option>
                                                    <option value="" >All</option>
                                                    @if(!empty($_GET['sort']))
                                                        <option value="transaction_count" @if($_GET['sort']  == 'transaction_count') selected @endif>Transaction Count</option>
                                                        <option value="total_transaction_amount" @if($_GET['sort']  == 'total_transaction_amount') selected @endif>Total Transaction Amount</option>
                                                        <option value="total_transaction_commission" @if($_GET['sort']  == 'total_transaction_commission') selected @endif>Total Transaction Commission</option>
                                                        <option value="clearance_date" @if($_GET['sort']  == 'clearance_date') selected @endif>Clearance Date</option>
                                                        <option value="transaction_date" @if($_GET['sort']  == 'transaction_date') selected @endif>Transaction Date</option>
                                                    @else
                                                        <option value="transaction_count" >Transaction Count</option>
                                                        <option value="total_transaction_amount" >Total Transaction Amount</option>
                                                        <option value="total_transaction_commission" >Total Transaction Commission</option>
                                                        <option value="clearance_date" >Clearance Date</option>
                                                        <option value="transaction_date" >Transaction Date</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('clearance.paypointView') }}"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('clearance.paypoint.excel') }}"><strong>Excel</strong></button>
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
                        <h5>List of paypoint clearances</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="PayPoint clearance">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Clearance Date</th>
                                    <th>Transaction from Date</th>
                                    <th>Transaction to Date</th>
                                    <th>Total transaction count</th>
                                    <th>Total transaction amount</th>
                                    <th>Total transaction commission</th>
                                    <th>Transaction Type</th>
                                    <th>Cleared By</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clearances as $clearance)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($clearances->perPage() * ($clearances->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                            {{ date('d M, Y', strtotime($clearance->created_at)) }}
                                        </td>
                                        <td>
                                            {{ date('d M, Y', strtotime($clearance->transaction_from_date)) }}
                                        </td>
                                        <td>
                                            {{ date('d M, Y', strtotime($clearance->transaction_to_date)) }}
                                        </td>
                                        <td>
                                            {{ $clearance->total_transaction_count }}
                                        </td>
                                        <td>
                                            Rs. {{ $clearance->total_transaction_amount }}
                                        </td>
                                        <td>
                                            Rs. {{ $clearance->total_transaction_commission }}
                                        </td>
                                        <td>
                                            {{ $clearance->clearance_type }}
                                        </td>
                                        <td>
                                            {{ optional($clearance->admin)->email }}
                                        </td>
                                        <td>
                                            @if(!empty($clearance->image))
                                                <img src="{{ asset('storage/uploads/clearance/'. $clearance->image) }}" alt="" style="height: 120px;">
                                            @endif
                                        </td>
                                        <td>
                                            @if($clearance->clearance_status === "0")
                                                <span class="badge badge-primary">cleared</span>
                                            @elseif ($clearance->clearance_status === "1")
                                                <span class="badge badge-primary">signed</span>
                                            @else
                                                <span class="badge badge-danger">Dispute</span>
                                            @endif
                                        </td>
                                        <td class="center">
                                            @can('Clearance paypoint change status')

                                                @if($clearance->clearance_status !== null)
                                                    <a style="margin-top: 5px;"
                                                       class="btn btn-sm btn-primary m-t-n-xs btn-icon"
                                                       href="{{ route('clearance.changeStatus', $clearance->id) }}"
                                                       title="Change Status"><i class="fa fa-eye"></i></a>
                                                @endif
                                            @endcan

                                            @can('Clearance paypoint transactions view')
                                                <a style="margin-top: 5px;"
                                                   class="btn btn-sm btn-info m-t-n-xs btn-icon"
                                                   href="{{ route('paypoint.clearance.transactions', $clearance) }}"
                                                   title="View Transactions"><i class="fa fa-credit-card"></i></a>
                                            @endcan

                                            @if($clearance->clearance_status !== null)
                                                <a style="margin-top: 5px;"
                                                   class="btn btn-sm btn-info m-t-n-xs btn-icon"
                                                   href="{{route('paypoint.generateClearanceReport', $clearance->id)}}"
                                                   title="Clearance report"
                                                   target="_blank"><i class="fa fa-file"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $clearances->appends(request()->query())->links() }}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    @include('admin.asset.css.datepicker')
@endsection

@section('scripts')
    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')

    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $clearances->firstItem() }} to {{ $clearances->lastItem() }} of {{ $clearances->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>

        let stats = @if(!empty($_GET['total_transaction_amount'])) `{{ $_GET['total_transaction_amount'] }}`; @else '0;100000'; @endif
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

        stats = @if(!empty($_GET['total_transaction_commission'])) `{{ $_GET['total_transaction_commission'] }}`; @else '0;100000'; @endif
            split = stats.split(';');

        $(".ionrange_total_transaction_commission").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        stats = @if(!empty($_GET['transaction_count'])) `{{ $_GET['transaction_count'] }}`; @else '0;10000'; @endif
            split = stats.split(';');

        $(".ionrange_transaction_count").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 10000,
            from: split[0],
            to: split[1],
        });


    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(".date").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd M, yyyy',
            keyboardNavigation: false,
        });

    </script>
@endsection


