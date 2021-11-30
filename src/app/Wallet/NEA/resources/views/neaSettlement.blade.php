@extends('admin.layouts.admin_design')
@section('content')
    <?php
    use App\Models\Dispute;
    ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NEA Settlement</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    NEA Settlement
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
                        <h5>Filter NEA Settlement</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" >
                                    <div class="row">
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
                                        <div style="padding-left: 10px; padding-right: 10px">
                                            <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                    formaction="{{ route('ViewNEASettlement') }}"><strong>Filter</strong>
                                            </button>
                                        </div>

                                        <div>
                                            <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                    type="submit" style="margin-right: 10px;"
                                                    formaction="#">
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
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of disputed transactions</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <h5>Transaction Count Total: {{$transaction_count_total}}</h5>
                            <h5>Transaction Sum Total: {{$transaction_sum_total}}</h5>
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Dispute transactions list">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Branch</th>
                                        <th>Transaction Count</th>
                                        <th>Transaction Sum</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($nea_informations as $nea_information)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$nea_information['branch_name']}}</td>
                                        <td>{{$nea_information['transaction_count']}}</td>
                                        <td>{{$nea_information['transaction_sum']}}</td>
                                        <td>
                                            <a data-toggle="modal" href="{{'#modal-settle-nea'.$loop->iteration}}">
                                                <button style="margin-top: 5px;" class="btn btn-primary m-t-n-xs"
                                                        rel="{{ route('user.forcePasswordChange') }}"><strong>Settle</strong></button>
                                            </a>
                                            <div id="{{'modal-settle-nea'.$loop->iteration}}" class="modal fade" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h3 class="m-t-none m-b">NEA Real Time Settlement</h3>
                                                                    <hr>
                                                                    <form action="{{route('SettleNea')}}" method="post">
                                                                        @csrf
                                                                        <input type="text" name="bank" placeholder="Enter Bank Name" class="form-control" style="margin-bottom: 15px">
                                                                        <input type="text" name="branch_name" placeholder="Enter Bank Branch" class="form-control" style="margin-bottom: 15px">
                                                                        <input type="text" name="account_name" placeholder="Enter Account Name" class="form-control" style="margin-bottom: 15px">
                                                                        <input type="text" name="account_number" placeholder="Enter Account Number" class="form-control" style="margin-bottom: 15px">
{{--                                                                        hidden fields starts--}}
                                                                        <input type="text" name="nea_branch_code" value="{{$nea_information['branch_code']}}" class="form-control" style="display: none">
                                                                        <input type="text" name="nea_branch_name" value="{{$nea_information['branch_name']}}" class="form-control" style="display: none">
                                                                        <input type="text" name="transaction_count" value="{{$nea_information['transaction_count']}}" class="form-control" style="display: none">
                                                                        <input type="text" name="transaction_sum" value="{{$nea_information['transaction_sum']}}" class="form-control" style="display: none">
{{--                                                                        hidden fields end--}}
                                                                        <button class="btn btn-primary" type="submit">Settle</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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

    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datatable')
{{--    <script>--}}
{{--        $(document).ready(function (e) {--}}
{{--            let a = "Showing {{ $disputes->firstItem() }} to {{ $disputes->lastItem() }} of {{ $disputes->total() }} entries";--}}
{{--            $('.dataTables_info').text(a);--}}
{{--        });--}}
{{--    </script>--}}
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
    <script>
        $('#forcePasswordChange').on('click', function (e) {

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "This user will be forced to change password",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ed5565",
                confirmButtonText: "Yes, force password change!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#forcePasswordChangeBtn').trigger('click');
                swal.close();

            })
        });
    </script>
@endsection


