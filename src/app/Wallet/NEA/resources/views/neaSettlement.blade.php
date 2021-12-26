@extends('admin.layouts.admin_design')
@section('content')
    <?php
    use App\Models\Dispute;
    ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            @include('admin.asset.notification.notify')
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
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox ">
                                    <div class="ibox-title collapse-link">
                                        <h5>Filter NEA Settlements</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form role="form" method="get">

                                                    <div class="row" style="margin-top: 20px">
                                                        <div class="col-md-6">
                                                            <div class="input-group date">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
                                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                                       placeholder="From" name="from" autocomplete="off"
                                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div style="padding-top: 50px">
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

                    </div>
                </div>
            </div>
        </div>

        @if(!empty($_GET))
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of Nea settlement per branch</h5>
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
                                            @php
                                              $from = date("Y-m-d", strtotime($_GET['from']));
                                            @endphp
                                            @if(!$nea_settlements->count())
                                                <form action="{{route('SettleNea')}}" method="post">
                                                    @csrf
                                                    {{-- hidden fields starts--}}
                                                    <input type="text" name="nea_branch_code" value="{{$nea_information['branch_code']}}" class="form-control" style="display: none">
                                                    <input type="text" name="nea_branch_name" value="{{$nea_information['branch_name']}}" class="form-control" style="display: none">
                                                    <input type="text" name="transaction_count" value="{{$nea_information['transaction_count']}}" class="form-control" style="display: none">
                                                    <input type="text" name="transaction_sum" value="{{$nea_information['transaction_sum']}}" class="form-control" style="display: none">
                                                    <input id="date_load_from" type="text" class="form-control date_from"
                                                           placeholder="From" name="date_from" autocomplete="off"
                                                           value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}" style="display: none">
                                                    {{-- hidden fields end--}}
                                                    <button href="#" class="reset btn btn-sm btn-success m-t-n-xs" rel="{{ $loop->iteration }}"><strong>Settle</strong></button>
                                                    <button id="resetBtn-{{ $loop->iteration }}" style="display: none" type="submit" href="#"  class="resetBtn btn btn-sm btn-success m-t-n-xs"><strong>Settle</strong></button>
                                                </form>
                                            @else
                                                @foreach($nea_settlements as $nea_settlement)
                                                    @if(($from >= $nea_settlement->date_from && $from <= $nea_settlement->date_to )&& $nea_settlement->nea_branch_code == $nea_information['branch_code'] && $nea_settlement->status == "SUCCESS")
                                                        @php($form_needed = "no")
                                                        @break
                                                    @else
                                                        @php($form_needed = "yes")
                                                    @endif
                                                @endforeach
                                                @if($form_needed == "no")
                                                    <p>Already Setteled</p>
                                                @else
                                                        <form action="{{route('SettleNea')}}" method="post">
                                                            @csrf
                                                            {{-- hidden fields starts--}}
                                                            <input type="text" name="nea_branch_code" value="{{$nea_information['branch_code']}}" class="form-control" style="display: none">
                                                            <input type="text" name="nea_branch_name" value="{{$nea_information['branch_name']}}" class="form-control" style="display: none">
                                                            <input type="text" name="transaction_count" value="{{$nea_information['transaction_count']}}" class="form-control" style="display: none">
                                                            <input type="text" name="transaction_sum" value="{{$nea_information['transaction_sum']}}" class="form-control" style="display: none">
                                                            <input id="date_load_from" type="text" class="form-control date_from"
                                                                   placeholder="From" name="date_from" autocomplete="off"
                                                                   value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}" style="display: none">
                                                            {{-- hidden fields end--}}
                                                            <button href="#" class="reset btn btn-sm btn-success m-t-n-xs" rel="{{ $loop->iteration }}"><strong>Settle</strong></button>
                                                            <button id="resetBtn-{{ $loop->iteration }}" style="display: none" type="submit" href="#"  class="resetBtn btn btn-sm btn-success m-t-n-xs"><strong>Settle</strong></button>
                                                        </form>
                                                @endif
                                            @endif
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

    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">


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
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "The Funds Will Be Transferred to The Nea Branches' Bank Account",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, settle funds",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>
@endsection



