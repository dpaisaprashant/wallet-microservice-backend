@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Locked Merchants</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Merchants</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Locked merchants view</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Users</h5>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Enter User Name" class="form-control" value="{{ !empty($_GET['name']) ? $_GET['name'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="number" placeholder="Enter Contact Number" class="form-control" value="{{ !empty($_GET['number']) ? $_GET['number'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="email" name="email" placeholder="Enter Email" class="form-control" value="{{ !empty($_GET['email']) ? $_GET['email'] : '' }}">
                                        </div>
                                    </div>
                                    <br>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('user.locked.list') }}"><strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('user.excel') }}"><strong>Excel</strong></button>
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
                        <h5>List of locked users</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Lock users list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($merchants as $merchant)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($merchants->perPage() * ($merchants->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                            <a  @can('User profile') href="{{route('user.profile', $merchant->id)}}" @endcan>{{ $merchant->name }}</a>
                                        </td>
                                        <td>
                                            @if(!empty($merchant->phone_verified_at))
                                                <i class="fa fa-check-circle" style="color: green;"></i> &nbsp;{{ $merchant->mobile_no }}
                                            @else
                                                <i class="fa fa-times-circle" style="color: red;"></i>&nbsp;{{ $merchant->mobile_no }}
                                            @endif
                                        </td>
                                        <td class="center">
                                            @if(!empty($merchant->email_verified_at))
                                                <i class="fa fa-check-circle" style="color: green;"></i> &nbsp;{{ $merchant->email }}
                                            @else
                                                <i class="fa fa-times-circle" style="color: red;"></i>&nbsp;{{ $merchant->email }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($merchant->isLocked())
                                                <span class="badge badge-danger">LOCKED</span>
                                            @else
                                                <span class="badge badge-primary">NOT LOCKED</span>
                                            @Endif
                                        </td>
                                        <td class="center">
                                            @can('Locked user login attempts view')
                                            <a style="margin-top: 5px;" href="{{route('merchant.login.attempts', $merchant->id)}}" class="btn btn-sm btn-icon btn-primary m-t-n-xs" title="view attempts"><i class="fa fa-eye"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $merchants->appends(request()->query())->links() }}
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
    <!-- Sweet Alert -->
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('.deactivate').click(function () {
            let url = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "This user's profile will be deactivated",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, deactivate user!",
                closeOnConfirm: false
            }, function () {
                //window.location.href="";
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'post',
                    url: url,
                    data:{
                        user: 1
                    },
                    success:function (resp) {
                        console.log(resp);
                        location.reload()
                    }, error:function (resp) {
                        console.log(resp);
                    }
                });
            })
        });
    </script>
    @include('admin.asset.js.datatable')
    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $merchants->firstItem() }} to {{ $merchants->lastItem() }} of {{ $merchants->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>
    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
   <script>
        let walletAmount = @if(!empty($_GET['wallet_balance'])) `{{ $_GET['wallet_balance'] }}`; @else '0;100000'; @endif
        let split = walletAmount.split(';');
        $(".ionrange_wallet_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        walletAmount = @if(!empty($_GET['transaction_payment'])) `{{ $_GET['transaction_payment'] }}`; @else '0;100000'; @endif
            split = walletAmount.split(';');

        $(".ionrange_payment_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        walletAmount = @if(!empty($_GET['transaction_loaded'])) `{{ $_GET['transaction_loaded'] }}`; @else '0;100000'; @endif
            split = walletAmount.split(';');

        $(".ionrange_loaded_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });


        walletAmount = @if(!empty($_GET['transaction_number'])) `{{ $_GET['transaction_number'] }}`; @else '0;1000'; @endif
            split = walletAmount.split(';');

        $(".ionrange_number").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: split[0],
            to: split[1],
        });
    </script>
@endsection


