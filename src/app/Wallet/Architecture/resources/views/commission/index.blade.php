@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Transaction Types Commissions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('architecture.vendor.transaction', $walletTransactionType->vendor) }}">Wallet Transaction Type</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Commission</strong>
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
                    <div class="ibox-title">
                        <h5>Wallet Transaction Type</h5>
                    </div>
                    <div class="ibox-content">
                        <h3>
                            <span class="font-bold">User Type:
                            </span> @if($walletTransactionType->user_type == \App\Models\User::class)
                                User
                            @elseif($walletTransactionType->user_type == \App\Models\Merchant\Merchant::class)
                                Merchant
                            @endif

                        | <span class="font-bold">Vendor: </span> {{ $walletTransactionType->vendor }}
                        | <span class="font-bold">Transaction Category: </span> {{ $walletTransactionType->transaction_category }}
                        | <span class="font-bold">Service Type: </span> {{ $walletTransactionType->service_type }}
                        @isset($walletTransactionType->service)
                        | <span class="font-bold">Service: </span> {{ $walletTransactionType->service }}</h3>
                        @endisset
                        | <span class="font-bold">Special 1: </span>{{ $walletTransactionType->special1 != null ? $walletTransactionType->special1 : '' }}
                        |
                        <span class="font-bold">Special 2: </span>{{ $walletTransactionType->special2 != null ? $walletTransactionType->special2 : '' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Commissions</h5>
                        <div class="ibox-tools" style="top: 8px;">
                            <a href="{{ route('architecture.transaction.commission.create', $walletTransactionType->id) }}"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Create New Commission</button></a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>User Type</th>
                                    <th>User Type Name</th>
                                    <th>Slab From</th>
                                    <th>Slab To</th>
                                    <th>Commission Service</th>
                                    <th>Commission Type</th>
                                    <th>Commission Value</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($walletTransactionType->walletTransactionTypeCommissions as $commission)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            {{ $commission->title }}
                                        </td>
                                        <td>
                                            {{ $commission->user_type }}
                                        </td>
                                        <td>
                                            {{ $commission->transactionCommissionable->name }}
                                        </td>
                                        <td>
                                            @isset($commission->slab_from)
                                                Rs. {{ $commission->slab_from / 100 }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset($commission->slab_to)
                                                Rs. {{ $commission->slab_to / 100 }}
                                            @endisset
                                        </td>
                                        <td>
                                            {{ $commission->description ?? "Normal Commission" }}
                                        </td>

                                        <td>{{ $commission->commission_type }}</td>

                                        <td>
                                            @if($commission->commission_type == 'FLAT')
                                                Rs. {{ $commission->commission_value / 100 }}
                                            @else
                                                {{ $commission->commission_value }}
                                            @endif
                                        </td>

                                        <td class="center">
                                            {{--<a href="{{ route('architecture.transaction.commission.update', $commission->id) }}"><button class="btn btn-info btn-icon" type="button"><i class="fa fa-edit"></i></button></a>--}}
                                            <form action="{{ route('architecture.transaction.commission.delete') }}" method="post" id="deactivateForm" style="display: inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $commission->id }}">
                                                <button class="btn btn-danger btn-icon deactivate" rel="{{ $commission->id }}"><i class="fa fa-trash"></i></button>
                                                <button id="deactivateBtn-{{ $commission->id }}" type="submit" style=" display:none;"  rel="{{ route('architecture.transaction.commission.delete') }}"></button>
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

    <style>
        h3 {
            font-weight: normal;
        }
    </style>

    @include('admin.asset.css.chosen')

    @include('admin.asset.css.datatable')

    @include('admin.asset.css.sweetalert')



@endsection

@section('scripts')


    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')

    @include('admin.asset.js.sweetalert')

    <script>
        $('.deactivate').on('click', function (e) {

            e.preventDefault();
            let id = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "This commission will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ed5565",
                confirmButtonText: "Yes, delete!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                let deactivateButton = '#deactivateBtn-' + id;
                $(deactivateButton).trigger('click');
                swal.close();
            })
        });
    </script>


@endsection





