@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Agent Types</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Agent Types</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        @include('admin.asset.notification.notify')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of agent types</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Agent type's list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Agent Types</th>
                                    <th>Sub Agent of</th>
                                    {{--<th>Default Cash Out Type | Value </th>
                                    <th>Default Cash In Type | Value </th>--}}
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($agentTypes as $type)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($agentTypes->perPage() * ($agentTypes->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                            {{ $type->name }}
                                        </td>
                                        <td>
                                            {{ optional($type->parentAgentType)->name }}
                                        </td>
                                        {{--<td>
                                            {{ $type->default_cash_out_type }} | {{ $type->default_cash_out_type == 'FLAT' ? 'Rs.' . ($type->default_cash_out_value ?? 0) / 100 :  $type->default_cash_out_value}}
                                        </td>

                                        <td>
                                            {{ $type->default_cash_in_type }} | {{ $type->default_cash_in_type == 'FLAT' ? 'Rs.' . ($type->default_cash_in_value ?? 0) / 100 :  $type->default_cash_in_value}}

                                        </td>--}}


                                        <td class="center">
                                           {{-- <a href="{{ route('agent.type.cashback', $type->id) }}" style="margin-top: 5px;"
                                                    title="Cashback"
                                                    class="btn btn-sm btn-icon btn-warning m-t-n-xs"
                                                    ><i class="fa fa-refresh"></i></a>--}}

                                            <a href="{{ route('agent.type.limit', $type->id) }}" style="margin-top: 5px;"
                                               title="Limit"
                                               class="btn btn-sm btn-icon btn-info m-t-n-xs"
                                            ><i class="fa fa-file"></i></a>

                                            <a href="{{ route('agent.type.update', $type) }}" style="margin-top: 5px;"
                                               title="Edit"
                                               class="btn btn-sm btn-icon btn-success m-t-n-xs"
                                            ><i class="fa fa-pencil"></i></a>

                                            <form action="{{ route('agent.type.delete', $type->id) }}" method="post" style="display: inline-block">
                                                @csrf
                                                <button style="margin-top: 5px; display: inline-block"
                                                        class="reset btn btn-sm btn-icon btn-danger m-t-n-xs"
                                                        rel="{{ $type->id }}"><i class="fa fa-trash"></i></button>
                                                <button id="resetBtn-{{ $type->id }}" style="display: none"
                                                        type="submit"><strong>Reset Password</strong></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $agentTypes->appends(request()->query())->links() }}
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
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')

    <script>
        $(document).ready(function (e) {

            let a = "Showing {{ $agentTypes->firstItem() }} to {{ $agentTypes->lastItem() }} of {{ $agentTypes->total() }} entries";

            $('.dataTables_info').text(a);
        });
    </script>


    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>
        let walletAmount = @if(!empty($_GET['wallet_balance'])) `{{ $_GET['wallet_balance'] }}`;
        @else '0;100000'; @endif
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

        walletAmount = @if(!empty($_GET['transaction_payment'])) `{{ $_GET['transaction_payment'] }}`;
        @else '0;100000';
        @endif
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

        walletAmount = @if(!empty($_GET['transaction_loaded'])) `{{ $_GET['transaction_loaded'] }}`;
        @else '0;100000';
        @endif
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


        walletAmount = @if(!empty($_GET['transaction_number'])) `{{ $_GET['transaction_number'] }}`;
        @else '0;1000';
        @endif
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

    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "This user will be removed from agent",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, remove",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>
@endsection





