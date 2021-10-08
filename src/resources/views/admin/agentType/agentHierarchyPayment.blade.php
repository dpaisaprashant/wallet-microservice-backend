@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Agent Hierarchy Payments</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Agent Hierarchy Payments</strong>
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
                    <div class="ibox-title collapse-link">
                        <h5>Filter Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('agent.hierarchy.payments') }}"
                                      id="filter">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="pre_transaction_id"
                                                       placeholder="Pre Transaction Id" class="form-control"
                                                       value="{{ !empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="parent_agent"
                                                       placeholder="Parent Agent Name" class="form-control"
                                                       value="{{ !empty($_GET['parent_agent']) ? $_GET['parent_agent'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="sub_agent"
                                                       placeholder="Sub Agent Name" class="form-control"
                                                       value="{{ !empty($_GET['sub_agent']) ? $_GET['sub_agent'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="parent_agent_number"
                                                       placeholder="Parent Agent Number" class="form-control"
                                                       value="{{ !empty($_GET['parent_agent_number']) ? $_GET['parent_agent_number'] : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 20px">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="sub_agent_number"
                                                       placeholder="Sub Agent Number" class="form-control"
                                                       value="{{ !empty($_GET['sub_agent_number']) ? $_GET['sub_agent_number'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="From Amount"
                                                       name="from_amount" autocomplete="off"
                                                       value="{{ !empty($_GET['from_amount']) ? $_GET['from_amount'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="To Amount"
                                                       name="to_amount" autocomplete="off"
                                                       value="{{ !empty($_GET['to_amount']) ? $_GET['to_amount'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Status...." class="chosen-select"
                                                        tabindex="2" name="status">
                                                    <option value="" selected disabled>Select Status...</option>
                                                    @if(!empty($_GET['status']))
                                                        @foreach($status as $stat)
                                                            <option value="{{$stat}}"
                                                                    @if($_GET['status']  == $stat) selected @endif >{{$stat}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($status as $stat)
                                                            <option value="{{$stat}}">{{$stat}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="margin-top: 40px;">



                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Service...." class="chosen-select"
                                                        tabindex="2" name="service">
                                                    <option value="" selected disabled>Select Service...</option>
                                                    @if(!empty($_GET['service']))
                                                        @foreach($services as $service)
                                                            <option value="{{$service}}"
                                                                    @if($_GET['service']  == $service) selected @endif >{{$service}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($services as $service)
                                                            <option value="{{$service}}">{{$service}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('agent.hierarchy.payments') }}">
                                            <strong>Filter</strong>
                                        </button>
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
                            <h5>List of Agent Hierarchy Payments</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Agent Hierarchy Payment">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Tansaction ID</th>
                                        <th>Payment Done By (Parent Agent)</th>
                                        <th>Parent Agent Number</th>
                                        <th>Payment Done For (Sub Agent)</th>
                                        <th>Sub Agent Number</th>
                                        <th>Service</th>
                                        <th>Amount (NRP)</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($agentHierarchyPayments as $agentHierarchyPayment)
                                        <tr class="gradeX">
                                            <td>{{ $loop->index + ($agentHierarchyPayments->perPage() * ($agentHierarchyPayments->currentPage() - 1)) + 1 }}</td>
                                            <td>
                                                {{ $agentHierarchyPayment->pre_transaction_id }}
                                            </td>
                                            <td>
                                                {{ optional($agentHierarchyPayment->parentAgent)->name }}
                                            </td>
                                            <td>
                                                {{ optional($agentHierarchyPayment->parentAgent)->mobile_no }}
                                            </td>
                                            <td>
                                                {{ optional($agentHierarchyPayment->subAgent)->name }}
                                            </td>
                                            <td>
                                                {{ optional($agentHierarchyPayment->subAgent)->mobile_no }}
                                            </td>
                                            <td>
                                                {{ $agentHierarchyPayment->service }}
                                            </td>
                                            <td>
                                                {{ ($agentHierarchyPayment->amount ?? 0)/100 }}
                                            </td>
                                            <td>
                                                {{ $agentHierarchyPayment->status }}
                                            </td>

                                            <td class="center">
                                                @include('admin.agentType.agentHierarchyResponse',['agentHierarchyPayment' => $agentHierarchyPayment])
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $agentHierarchyPayments->appends(request()->query())->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endif
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

            let a = "Showing {{ $agentHierarchyPayments->firstItem() }} to {{ $agentHierarchyPayments->lastItem() }} of {{ $agentHierarchyPayments->total() }} entries";

            $('.dataTables_info').text(a);
        });
    </script>


    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

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





