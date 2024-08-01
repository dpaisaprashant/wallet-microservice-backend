'@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Service</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>View Wallet Service</strong>
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
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                @include('admin.asset.notification.notify')
                <div class="ibox-title">
                    <h5>List of wallet service</h5>
                    @can('Add wallet service')
                            <div class="ibox-tools" style="top: 8px;">
                                <a href="{{ route('wallet.service.create') }}">
                                    <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add
                                        Wallet Service
                                    </button>
                                </a>
                            </div>
                    @endcan
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example"
                               title="Wallet Service List">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Service</th>
                                <th>Micro Service URL</th>
                                <th>Micro Service Process</th>
                                <th>Wallet Transaction Type </th>
                                <th>Payment Validated</th>
                                <th>Payment Handeled</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                <tr class="gradeX">
                                    <td>{{ $loop->index + ($services->perPage() * ($services->currentPage() - 1)) + 1 }}</td>
                                    <td>
                                        &nbsp;{{ $service->service }}
                                    </td>
                                    <td>{{ $service->core_to_microservice_url }}</td>
                                    <td>{{ $service->microservice_process ?? '-' }}</td>
                                    <td>{{optional($service->walletTransactionType)->transaction_type}}</td>
                                    <td>
                                        @if($service->validate_payment == 1)
                                            <span class="badge badge-primary">Valid</span>
                                        @else
                                            <span class="badge badge-danger">Invalid</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($service->handle_payment == 1)
                                            <span class="badge badge-primary">Handeled</span>
                                        @else
                                            <span class="badge badge-danger">Unhandeled</span>
                                        @endif
                                    </td>
                                    <td class="-align-center">
                                        @can('Edit wallet service')
                                            <a style="margin-right: 5px; display: inline; height: 3px;width: 3px"
                                               href="{{route('wallet.service.edit', $service->id)}}"
                                                   class="btn btn-sm btn-primary m-t-n-xs"
                                                   title="user profile">
                                                <i class="fa fa-pencil"></i>
                                            </a>


                                        @endcan

                                        @can('Delete wallet service')
                                                <form action="{{ route('wallet.service.delete',$service->id) }}" method="post" style="display: inline">
                                                    @csrf
                                                    <input id="resetValue" type="hidden" name="admin_id" value="{{ $service->id }}">
                                                    <button href="{{ route('backendUser.role', $service->id) }}" class="reset btn btn-sm btn-danger m-t-n-xs" rel="{{ $service->id }}"><i class="fa fa-trash"></i></button>
                                                    <button id="resetBtn-{{ $service->id }}" style="display: none" type="submit" href="{{ route('backendUser.role', $service->id) }}"  class="resetBtn btn btn-sm btn-danger m-t-n-xs"><i class="fa fa-trash"></i></button>
                                                </form>
                                            @endcan
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $services->appends(request()->query())->links() }}
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
                text: "Wallet service will be deleted'",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete service",
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

    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $services->firstItem() }} to {{ $services->lastItem() }} of {{ $services->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>

@endsection

