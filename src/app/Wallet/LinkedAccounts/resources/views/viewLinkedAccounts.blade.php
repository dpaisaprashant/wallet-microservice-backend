@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Linked Accounts</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Linked Accounts</strong>
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
                        <h5>Filter Data of Linked Accounts</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('linkedaccounts.view') }}" id="filter">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="account_name" placeholder="Account Name"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['account_name']) ? $_GET['account_name'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="account_number" placeholder="Account Number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['account_number']) ? $_GET['account_number'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="bank_code" placeholder="Bank Code"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['bank_code']) ? $_GET['bank_code'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="mobile_number" placeholder="Linked Account Mobile Number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['mobile_number']) ? $_GET['mobile_number'] : '' }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="margin-top: 20px">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Verified Status...." class="chosen-select"
                                                        tabindex="2" name="verified_status">
                                                    <option value="" selected disabled>Select Verified Status...</option>
                                                    @if(!empty($_GET['verified_status']))
                                                        @foreach($verified_status as $stat)
                                                            <option value="{{$stat}}"
                                                                @if($_GET['verified_status']  == $stat) selected @endif >{{$stat}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($verified_status as $stat)
                                                            <option value="{{$stat}}">{{$stat}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Register Status...." class="chosen-select"
                                                        tabindex="2" name="register_status">
                                                    <option value="" selected disabled>Select Register Status...</option>
                                                    @if(!empty($_GET['register_status']))
                                                        @foreach($register_status as $stat)
                                                            <option value="{{$stat}}"
                                                                @if($_GET['register_status']  == $stat) selected @endif >{{$stat}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($register_status as $stat)
                                                            <option value="{{$stat}}">{{$stat}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user_id" placeholder="User ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user_id']) ? $_GET['user_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user_phone_number" placeholder="Wallet User Phone Number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user_phone_number']) ? $_GET['user_phone_number'] : '' }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="margin-top: 20px;">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="reference_id" placeholder="Reference ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['reference_id']) ? $_GET['reference_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_from" type="text" class="form-control date_from"
                                                       placeholder="From Created At" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_to" type="text" class="form-control date_to"
                                                       placeholder="To Created At" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div style="margin-top: 10px;">
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('linkedaccounts.view') }}"><strong>Filter</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('linkedAccount.excel') }}">
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all Linked Accounts</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Complete Requests List">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Account Name</th>
                                        <th>Account Number</th>
                                        <th>Bank Code</th>
                                        <th>Date of Birth</th>
                                        <th>Linked Account Mobile Number</th>
                                        <th>Reference ID</th>
                                        <th>Register Date</th>
                                        <th>Register Status</th>
                                        <th>Time Stamp</th>
                                        <th>Token</th>
                                        <th>User ID</th>
                                        <th>Wallet User Phone Number</th>
                                        <th>Verified Status</th>
                                        <th>Verified Time Stamp</th>
                                        <th>Created At</th>
                                        <th style='width: 100px'>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($linkedAccounts as $linkedAccount)
                                        <tr class="gradeC">
                                            <td>{{ $loop->index + ($linkedAccounts->perPage() * ($linkedAccounts->currentPage() - 1)) + 1 }}</td>
                                            <td>{{ $linkedAccount->account_name }}</td>
                                            <td>{{ $linkedAccount->account_number }}</td>
                                            <td>{{ $linkedAccount->bank_code }}</td>
                                            <td>{{ $linkedAccount->dob }}</td>
                                            <td>{{ $linkedAccount->mobile_number }}</td>
                                            <td>{{ $linkedAccount->reference_id }}</td>
                                            <td>{{ $linkedAccount->register_date }}</td>
                                            <td>
                                                <span class="badge {{$linkedAccount->register_status=="Success" ? "badge-primary" : "badge-danger"}}">{{ $linkedAccount->register_status }}</span>
                                            </td>
                                            <td>{{ $linkedAccount->time_stamp }}</td>
                                            <td>{{ $linkedAccount->token }}</td>
                                            <td>{{ $linkedAccount->user_id }}</td>
                                            @if(!empty($linkedAccount->user->mobile_no))
                                                <td>{{ $linkedAccount->user->mobile_no }}</td>
                                            @else
                                                <td>No Data</td>
                                            @endif
                                            <td>
                                                <span class="badge {{$linkedAccount->verified_status=="Success" ? "badge-primary" : "badge-danger"}}">{{ $linkedAccount->verified_status }}</span>
                                            </td>
                                            <td>{{ $linkedAccount->verified_time_stamp }}</td>
                                            <td>{{ $linkedAccount->created_at }}</td>
                                            <td>
                                                @include('LinkedAccounts::jsonButtons', ['linkedAccount' => $linkedAccount])
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $linkedAccounts->appends(request()->query())->links() }}
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
    <script>
        @if(!empty($_GET))
        $(document).ready(function (e) {
            let a = "Showing {{ $linkedAccounts->firstItem() }} to {{ $linkedAccounts->lastItem() }} of {{ $linkedAccounts->total() }} entries";
            $('.dataTables_info').text(a);
        });
        @endif
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

@endsection


