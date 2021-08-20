@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Permission Transaction</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>View Wallet Permission Transaction</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">


        {{--        <div class="row">--}}
        {{--            <div class="col-lg-12">--}}
        {{--                <div class="ibox">--}}
        {{--                    <div class="ibox-title collapse-link">--}}
        {{--                        <h5>Filter Transaction Type</h5>--}}
        {{--                        <div class="ibox-tools">--}}
        {{--                            <a class="collapse-link">--}}
        {{--                                <i class="fa fa-chevron-up"></i>--}}
        {{--                            </a>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="ibox-content"--}}
        {{--                         @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none" @endif>--}}
        {{--                        <div class="row">--}}
        {{--                            <div class="col-sm-12">--}}
        {{--                                <form role="form" method="get">--}}

        {{--                                    <div class="row">--}}
        {{--                                        <div class="col-md-3">--}}
        {{--                                            <div class="form-group">--}}
        {{--                                                <select data-placeholder="Choose transaction status..."--}}
        {{--                                                        class="chosen-select" tabindex="2" name="sort">--}}
        {{--                                                    <option value="" selected disabled>Sort By...</option>--}}
        {{--                                                    @if(!empty($_GET['sort']))--}}
        {{--                                                        <option value="wallet_balance"--}}
        {{--                                                                @if($_GET['sort']  == 'wallet_balance') selected @endif >--}}
        {{--                                                            Wallet Balance--}}
        {{--                                                        </option>--}}
        {{--                                                        <option value="transaction_number"--}}
        {{--                                                                @if($_GET['sort'] == 'transaction_number') selected @endif>--}}
        {{--                                                            Transaction Number--}}
        {{--                                                        </option>--}}
        {{--                                                        <option value="transaction_payment"--}}
        {{--                                                                @if($_GET['sort'] == 'transaction_payment') selected @endif>--}}
        {{--                                                            Transaction Payment--}}
        {{--                                                        </option>--}}
        {{--                                                        <option value="transaction_loaded"--}}
        {{--                                                                @if($_GET['sort'] == 'transaction_loaded') selected @endif>--}}
        {{--                                                            Transaction Loaded--}}
        {{--                                                        </option>--}}
        {{--                                                    @else--}}
        {{--                                                        <option value="wallet_balance">Wallet Balance</option>--}}
        {{--                                                        <option value="transaction_number">Transaction Number</option>--}}
        {{--                                                        <option value="transaction_payment">Transaction Payment</option>--}}
        {{--                                                        <option value="transaction_loaded">Transaction Loaded</option>--}}
        {{--                                                    @endif--}}
        {{--                                                </select>--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="col-md-3">--}}
        {{--                                        <div class="form-group">--}}
        {{--                                            <input type="text" name="number" placeholder="Enter Contact Number"--}}
        {{--                                                   class="form-control"--}}
        {{--                                                   value="{{ !empty($_GET['number']) ? $_GET['number'] : '' }}">--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}


        {{--                                    <div class="col-md-3">--}}
        {{--                                        <input type="email" name="email" placeholder="Enter Email"--}}
        {{--                                               class="form-control"--}}
        {{--                                               value="{{ !empty($_GET['email']) ? $_GET['email'] : '' }}">--}}
        {{--                                    </div>--}}

        {{--                                    <div class="col-md-3">--}}
        {{--                                        <div class="form-group">--}}
        {{--                                            <select data-placeholder="Choose transaction status..."--}}
        {{--                                                    class="chosen-select" tabindex="2" name="sort">--}}
        {{--                                                <option value="" selected disabled>Sort By...</option>--}}
        {{--                                                @if(!empty($_GET['sort']))--}}
        {{--                                                    <option value="wallet_balance"--}}
        {{--                                                            @if($_GET['sort']  == 'wallet_balance') selected @endif >--}}
        {{--                                                        Wallet Balance--}}
        {{--                                                    </option>--}}
        {{--                                                    <option value="transaction_number"--}}
        {{--                                                            @if($_GET['sort'] == 'transaction_number') selected @endif>--}}
        {{--                                                        Transaction Number--}}
        {{--                                                    </option>--}}
        {{--                                                    <option value="transaction_payment"--}}
        {{--                                                            @if($_GET['sort'] == 'transaction_payment') selected @endif>--}}
        {{--                                                        Transaction Payment--}}
        {{--                                                    </option>--}}
        {{--                                                    <option value="transaction_loaded"--}}
        {{--                                                            @if($_GET['sort'] == 'transaction_loaded') selected @endif>--}}
        {{--                                                        Transaction Loaded--}}
        {{--                                                    </option>--}}
        {{--                                                @else--}}
        {{--                                                    <option value="wallet_balance">Wallet Balance</option>--}}
        {{--                                                    <option value="transaction_number">Transaction Number</option>--}}
        {{--                                                    <option value="transaction_payment">Transaction Payment</option>--}}
        {{--                                                    <option value="transaction_loaded">Transaction Loaded</option>--}}
        {{--                                                @endif--}}
        {{--                                            </select>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                            </div>--}}
        {{--                            <br>--}}
        {{--                            <div>--}}
        {{--                                --}}{{--                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"--}}
        {{--                                --}}{{--                                                formaction="{{ route('architecture.vendor.transaction', $vendorName) }}">--}}
        {{--                                <strong>Filter</strong></button>--}}
        {{--                            </div>--}}

        {{--                            <div>--}}
        {{--                            </div>--}}
        {{--                            @include('admin.asset.components.clearFilterButton')--}}
        {{--                            </form>--}}
        {{--                        </div>--}}

        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>List of wallet permission transaction type users</h5>
                        @can('Add wallet permission transaction type')
                            <div class="ibox-tools" style="top: 8px;">
                                <a href="{{ route('wallet.permission.transaction.type.create') }}">
                                    <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add
                                        Wallet Permission Transaction
                                    </button>
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            @include('admin.asset.notification.notify')
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Icash user's list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User type id</th>
                                    <th>User type</th>
                                    <th>Wallet tranasction type id</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($walletPermissionTransactions as $key=>$walletPermissionTransaction)
                                    <tr>
                                        <td>{{ $key+1 }}</td>

                                        @if($walletPermissionTransaction->user_type == 'App\Models\UserType')
                                            @foreach($userTypes as $key=>$userType)
                                                @if($userType->id == $walletPermissionTransaction->user_type_id)
                                                    <td><span class="badge badge-inverse">{{$userType->name}}</span>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @elseif($walletPermissionTransaction->user_type == 'App\Models\Merchant\MerchantType')
                                            @foreach($merchantTypes as $key=>$merchantType)
                                                @if($merchantType->id == $walletPermissionTransaction->user_type_id)
                                                    <td><span class="badge badge-success">{{$merchantType->name}}</span>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @elseif($walletPermissionTransaction->user_type == 'App\Models\AgentType')
                                            @foreach($agentTypes as $key=>$agentType)
                                                @if($agentType->id == $walletPermissionTransaction->user_type_id)
                                                    <td><span class="badge badge-primary">{{$agentType->name}}</span>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @endif

                                        @if($walletPermissionTransaction->user_type == 'App\Models\AgentType')
                                            <td><span class="badge badge-primary">Agent Type</span></td>
                                        @elseif($walletPermissionTransaction->user_type == 'App\Models\Merchant\MerchantType')
                                            <td><span class="badge badge-success">Merchant Type</span></td>
                                        @elseif($walletPermissionTransaction->user_type == 'App\Models\UserType')
                                            <td><span class="badge badge-inverse">User Type</span></td>
                                        @endif

                                        @foreach($transactionTypes as $key=>$transactionType)
                                            @if($walletPermissionTransaction->wallet_transaction_type_id == $transactionType->id)
                                                <td><span
                                                        class="badge badge-pill">TransactionType : {{$transactionType->transaction_type}}</span>
                                                    <span
                                                        class="badge badge-pill">Service : {{$transactionType->service == null ? 'Null' : $transactionType->service}}</span>
                                                    <span
                                                        class="badge badge-pill">Service Type : {{$transactionType->service_type}}</span>
                                                    <span
                                                        class="badge badge-pill">Micro service : {{$transactionType->microservice}}</span>
                                                </td>
                                            @endif
                                        @endforeach

                                        <td>
                                            <form
                                                action="{{ route('wallet.permission.transaction.type.delete',$walletPermissionTransaction->id) }}"
                                                method="post">
                                                @csrf
                                                @can('Delete wallet permission transaction type')
                                                    <button
                                                        href="{{ route('wallet.permission.transaction.type.delete',$walletPermissionTransaction->id) }}"
                                                        class="reset btn btn-sm btn-danger m-t-n-xs"
                                                        rel="{{ $walletPermissionTransaction->id }}"><i
                                                            class="fa fa-trash"></i>
                                                    </button>

                                                    <button id="resetBtn-{{ $walletPermissionTransaction->id }}"
                                                            style="display: none" type="submit"
                                                            href="{{ route('wallet.permission.transaction.type.delete',$walletPermissionTransaction->id) }}"
                                                            class="resetBtn btn btn-sm btn-danger m-t-n-xs">
                                                        <i class="fa fa-trash"></i></button>
                                                @endcan
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


    @include('admin.asset.css.datepicker')

    @include('admin.asset.css.chosen')

    @include('admin.asset.css.datatable')

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

    @include('admin.asset.css.sweetalert')

@endsection

@section('scripts')

    @include('admin.asset.js.sweetalert')
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "Wallet permission transaction will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')

    @include('admin.asset.js.sweetalert')


@endsection

