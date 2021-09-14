'@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Admin Altered Agents List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>View Admin Altered Agent List</strong>
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
                        <h5>Filter Admin Altered Agents List</h5>
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

                                        <div class="col-md-6">
                                            <label for="user_number">Admin Name</label>
                                            <input type="text" name="admin_name" placeholder="Enter Admin Name"
                                                   class="form-control"
                                                   value="{{ !empty($_GET['admin_name']) ? $_GET['admin_name'] : '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="user_number">Agent Number</label>
                                            <input type="number" name="agent_number" placeholder="Enter Agent Number"
                                                   class="form-control"
                                                   value="{{ !empty($_GET['agent_number']) ? $_GET['agent_number'] : '' }}">
                                        </div>

                                        <div class="col-md-4">
                                                <label for="service_type" style="padding-top: 5px">Admin Action</label>
                                                <select data-placeholder="Select Admin Action" class="chosen-select"
                                                        tabindex="2" name="admin_action">
                                                    <option value="" selected disabled>Select Admin Action ...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['admin_action']))
                                                        @if($_GET['admin_action']  == 'Created')
                                                            <option value="Created" selected >Created</option>
                                                            <option value="Updated">Updated</option>

                                                        @else
                                                            <option value="Updated" selected >Updated</option>
                                                            <option value="Created">Created</option>

                                                        @endif

                                                    @else
                                                        <option value="Created">Created</option>
                                                        <option value="Updated">Updated</option>
                                                    @endif
                                                </select>
                                        </div>


                                        <div class="col-md-4" style="padding-top: 30px">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="padding-top: 30px">
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
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{route('agent.AdminAlteredAgents')}}"><strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="#"><strong>Excel</strong></button>
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
                    @include('admin.asset.notification.notify')
                    <div class="ibox-title">
                        <h5>List of Admin Updated/Created KYC</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Wallet Service List">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Admin</th>
                                    <th>Agent</th>
                                    <th>Admin Action</th>
                                    <th>Agent Before</th>
                                    <th>Agent After</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($adminAlteredAgents as $adminAlteredAgent)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($adminAlteredAgents->perPage() * ($adminAlteredAgents->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                            &nbsp;{{ $adminAlteredAgent->admin->name}}
                                        </td>
                                        <td>{{ $adminAlteredAgent->agent->user->mobile_no}}</td>
                                        <td>
                                            @php
                                            $response = json_decode($adminAlteredAgent->agent_before)
                                            @endphp
                                            @if($response == null)
                                                Created
                                            @else
                                                Updated
                                            @endif
                                        </td>
                                        <td>@include('admin.agent.AdminAlteredAgentJsonDecode', ['adminAlteredAgent' => $adminAlteredAgent,'type'=>"before_change"])</td>
                                        <td>@include('admin.agent.AdminAlteredAgentJsonDecode', ['adminAlteredAgent' => $adminAlteredAgent,'type'=>"after_change"])</td>
                                        <td>{{$adminAlteredAgent->created_at}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ $adminAlteredAgents->appends(request()->query())->links() }}
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
            let a = "Showing {{ $adminAlteredAgents->firstItem() }} to {{ $adminAlteredAgents->lastItem() }} of {{ $adminAlteredAgents->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>

@endsection

