@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Agent Type Hierarchy Cashback</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Agent Type Hierarchy Cashback</strong>
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
                    <div class="ibox-title collapse-link">
                        <h5>Filter by agent type</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get"
                                      action="{{ route('view.agent.type.hierarchy.cashback') }}" id="filter">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select data-placeholder="Sort By..." class="chosen-select" tabindex="2"
                                                        name="agent_type">
                                                    <option value="" selected disabled>-- Agent Type --</option>
                                                    @foreach($agentTypes as $key=>$agentType)
                                                        <option value="{{ $agentType->id }}"
                                                                @if(isset($_GET['agent_type']) == true)
                                                                @if($_GET['agent_type'] == $agentType->id)
                                                                selected
                                                            @endif
                                                            @endif
                                                        >{{ $agentType->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select data-placeholder="Sort By..." class="chosen-select" tabindex="2"
                                                        name="wallet_transaction_type_id">
                                                    <option value="" selected disabled>-- Wallet transaction type --
                                                    </option>
                                                    @foreach($walletTransactionTypes as $key=>$walletTransactionType)
                                                        <option value="{{ $walletTransactionType->id }}"
                                                                @if(isset($_GET['wallet_transaction_type_id']) == true)
                                                                @if($_GET['wallet_transaction_type_id'] == $walletTransactionType->id)
                                                                selected
                                                            @endif
                                                            @endif
                                                        >
                                                            Vendor : {{ $walletTransactionType->vendor }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            @if($walletTransactionType->service != null)
                                                                Service : {{ $walletTransactionType->service }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                @elseif($walletTransactionType->service == null && $walletTransactionType->service_type != null)
                                                                Service Type : {{ $walletTransactionType->service_type }}
                                                                @elseif($walletTransactionType->service_type == null && $walletTransactionType->transaction_category != null)
                                                                Transaction Category : {{ $walletTransactionType->transaction_category }}

                                                                @if(!empty($walletTransactionType->special1))
                                                                    | Special1: {{ $walletTransactionType->special1 }}
                                                                @endif

                                                                @if(!empty($walletTransactionType->special2))
                                                                    | Special2: {{ $walletTransactionType->special2 }}
                                                                @endif
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                    </div>


                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('view.agent.type.hierarchy.cashback') }}"><strong>Filter</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('view.agent.type.hierarchy.cashback') }}">
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>List of agent type hierarchy cashback</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                @include('admin.asset.notification.notify')
                                <table id="editable"
                                       class="table table-striped table-bordered table-hover data dataTables-example"
                                       title="Agent Commission">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th style="display: none">Id</th>
                                        <th>Agent type</th>
                                        <th>Parent agent type</th>
                                        <th>Title</th>
                                        <th>Cashback type</th>
                                        <th>Cashback value (Rs.)</th>
                                        <th>Slab from</th>
                                        <th>Slab to</th>
                                        <th>Description</th>
                                        <th>Wallet transaction type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($agentTypeHierarchyCashbacks as $key=>$agentTypeHierarchyCashback)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td style="display: none">{{$agentTypeHierarchyCashback->id}}</td>
                                            <td>{{ optional($agentTypeHierarchyCashback->agentType)->name ?? "Null" }}</td>
                                            <td>{{ optional($agentTypeHierarchyCashback->parentAgentType)->name ?? "" }}</td>
                                            <td>{{ $agentTypeHierarchyCashback->title}}</td>
                                            <td>{{ $agentTypeHierarchyCashback->cashback_type  }}</td>
                                            <td>{{ $agentTypeHierarchyCashback->cashback_type == "FLAT" ? $agentTypeHierarchyCashback->cashback_value/100 : $agentTypeHierarchyCashback->cashback_value }}</td>
                                            <td>{{ $agentTypeHierarchyCashback->slab_from  }}</td>
                                            <td>{{ $agentTypeHierarchyCashback->slab_to }}</td>
                                            <td>{{ $agentTypeHierarchyCashback->description }}</td>
                                            <td>
                                                <b>Vendor</b>
                                                : {{ $agentTypeHierarchyCashback->walletTransactionType->vendor }}
                                                <br>
                                                @if($agentTypeHierarchyCashback->walletTransactionType->service != null)
                                                    <b>Service</b>
                                                    : {{ $agentTypeHierarchyCashback->walletTransactionType->service }}
                                                @elseif($agentTypeHierarchyCashback->walletTransactionType->service == null && $agentTypeHierarchyCashback->walletTransactionType->service_type != null)
                                                    <b>Service Type</b>
                                                    : {{$agentTypeHierarchyCashback->walletTransactionType->service_type}}
                                                @elseif($agentTypeHierarchyCashback->walletTransactionType->service_type == null && $agentTypeHierarchyCashback->walletTransactionType->transaction_category != null)
                                                    <b>Transaction Category</b>
                                                    : {{ $agentTypeHierarchyCashback->walletTransactionType->transaction_category }}
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
            </div>
        @endif
    </div>
@endsection
@section('styles')


    @include('admin.asset.css.datepicker')

    @include('admin.asset.css.chosen')

    @include('admin.asset.css.datatable')


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

    @include('admin.asset.js.sweetalert')

    @include('admin.asset.js.datatable')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.tableedit')
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                }
            });

            $('#editable').Tabledit({
                deleteButton: false,
                url: '{{ route('update.agent.type.hierarchy.cashback') }}',
                dataType: "json",
                columns: {
                    identifier: [1, 'id'],
                    editable: [[4, 'title'], [5, 'cashback_type', '{"PERCENTAGE":"PERCENTAGE","FLAT":"FLAT"}'], [6, 'cashback_value'], [9, 'description']]
                },
                restoreButton: false,

                onSuccess: function (textStatus, jqXHR, response) {
                    console.log(response);
                    // $('#'+response.responseJSON['id']).remove();

                    swal({
                        type: 'success',
                        title: 'Row updated successfully',
                    });

                    // if (data.action == 'delete') {
                    //     $('#'+response.requestJSON.id).remove();
                    // }
                    //
                    // if(data.action == 'delete'){
                    //     swal({
                    //         type:"success",
                    //         title: 'Item have been deleted successfully'
                    //     },function(){
                    //        location.reload();
                    //     });
                    // }
                    $("#overlay").fadeOut(300);
                },
                onFail: function (data) {
                    console.log('error');
                    console.log(data.responseJSON['message']);
                    swal({
                        type: "warning",
                        confirmButtonColor: "#DD6B55",
                        title: data.responseJSON['message'],
                    }, function () {
                        location.reload();
                    });
                    $("#overlay").fadeOut(300);

                },

            });
        });
    </script>


@endsection

