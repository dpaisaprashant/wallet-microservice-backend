@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Transaction Types</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>{{ $vendorName }} Vendor Transaction Types</strong>
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
                        <h5>Filter Transaction Type</h5>
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
                                <form role="form" method="get">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Enter User Name"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['name']) ? $_GET['name'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="number" placeholder="Enter Contact Number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['number']) ? $_GET['number'] : '' }}">
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <input type="email" name="email" placeholder="Enter Email"
                                                   class="form-control"
                                                   value="{{ !empty($_GET['email']) ? $_GET['email'] : '' }}">
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="sort">
                                                    <option value="" selected disabled>Sort By...</option>
                                                    @if(!empty($_GET['sort']))
                                                        <option value="wallet_balance"
                                                                @if($_GET['sort']  == 'wallet_balance') selected @endif >
                                                            Wallet Balance
                                                        </option>
                                                        <option value="transaction_number"
                                                                @if($_GET['sort'] == 'transaction_number') selected @endif>
                                                            Transaction Number
                                                        </option>
                                                        <option value="transaction_payment"
                                                                @if($_GET['sort'] == 'transaction_payment') selected @endif>
                                                            Transaction Payment
                                                        </option>
                                                        <option value="transaction_loaded"
                                                                @if($_GET['sort'] == 'transaction_loaded') selected @endif>
                                                            Transaction Loaded
                                                        </option>
                                                    @else
                                                        <option value="wallet_balance">Wallet Balance</option>
                                                        <option value="transaction_number">Transaction Number</option>
                                                        <option value="transaction_payment">Transaction Payment</option>
                                                        <option value="transaction_loaded">Transaction Loaded</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('architecture.vendor.transaction', $vendorName) }}">
                                            <strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{route('architecture.excel.vendor.transaction',$vendorName)}}"><strong>Excel</strong></button>
                                    </div>

                                    <div>
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
                        <h5>List of registered users</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Wallet user's list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User Type</th>
                                    <th>Vendor</th>
                                    @if($vendorName == "BFI")
                                        <th>BFI Name</th>
                                    @endif
                                    <th>Transaction Category</th>
                                    <th>Service Type</th>
                                    <th>Service</th>
                                    <th>Service Enabled</th>
                                    <th>Payment Type</th>
                                    <th>Specials</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($walletTransactionTypes as $transactionType)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @if($transactionType->user_type == \App\Models\User::class)
                                                User
                                            @elseif($transactionType->user_type == \App\Models\Merchant\Merchant::class)
                                                Merchant
                                            @endif
                                        </td>
                                        <td>
                                            {{ $transactionType->vendor }}
                                            @if($vendorName == "BFI")
                                                @if($transactionType->special1 == null)
                                                    <span class="badge badge-danger"></span>
                                                @else
                                                    <span class="badge badge-success"> {{ $transactionType->special1 }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        @if($vendorName == "BFI")
                                            @if($transactionType->special2 == null)
                                            <td>  </td>
                                            @else
                                                <td> <span class="badge badge-success">{{ $transactionType->special2 }}</span></td>
                                                @endif
                                        @endif
                                        <td>
                                            {{ $transactionType->transaction_category }}
                                        </td>
                                        <td>
                                            {{ $transactionType->service_type }}
                                        </td>
                                        <td>
                                            {{ $transactionType->service }}
                                        </td>
                                        <td>
                                            @if($transactionType->service_enabled == 1)
                                                <span class="badge badge-success">Enabled</span>
                                            @else
                                                <span class="badge badge-danger">Disabled</span>
                                            @endif
                                        </td>

                                        <td>{{ $transactionType->payment_type }}</td>
                                        <td>{{ $transactionType->special1 }} @if($transactionType->special1) | {{ $transactionType->special2 }} @endif</td>
                                        <td class="center">
                                            <a style="margin-top: 5px;"
                                               href="{{ route('architecture.transaction.cashback', $transactionType->id) }}"
                                               class="btn btn-sm btn-success m-t-n-xs" title="Transaction Cashbacks"><i
                                                    class="fa fa-refresh"></i> Transaction Cashback</a>
                                            <a style="margin-top: 5px;"
                                               href="{{ route('architecture.transaction.commission', $transactionType->id) }}"
                                               class="btn btn-sm btn-info m-t-n-xs" title="Transaction Commissions"><i
                                                    class="fa fa-dollar"></i> Transaction Commission</a>
                                            <br>
                                            @can('Add cashback to single user')
                                                <a style="margin-top: 5px;"
                                                   href="{{ route('architecture.user.cashback', $transactionType->id) }}"
                                                   class="btn btn-sm btn-success m-t-n-xs" title="User Cashbacks"><i
                                                        class="fa fa-refresh"></i> User Cashback</a>
                                            @endcan
                                            @can('Add commission to single user')
                                                <a style="margin-top: 5px;"
                                                   href="{{ route('architecture.user.commission', $transactionType->id) }}"
                                                   class="btn btn-sm btn-info m-t-n-xs" title="User Commissions"><i
                                                        class="fa fa-dollar"></i> User Commission</a>
                                            @endcan
                                            <a style="margin-top: 5px;"
                                               href="{{ route('walletBonus.index', $transactionType->id) }}"
                                               class="btn btn-sm btn-warning m-t-n-xs" title="User Commissions"><i
                                                    class="fa fa-dollar"></i>&nbsp;Bonus</a>
                                            @can('Add merchant revenue')
                                                <a style="margin-top: 5px;"
                                                   href="{{ route('architecture.wallet.merchantRevenue', $transactionType->id) }}"
                                                   class="btn btn-sm btn-info m-t-n-xs" title="User Commissions"><i
                                                        class="fa fa-dollar"></i> Merchant Revenue</a>
                                            @endcan

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

@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')


@endsection





