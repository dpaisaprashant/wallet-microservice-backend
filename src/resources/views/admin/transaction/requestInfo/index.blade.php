@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Transactions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Request Infos</strong>
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
                        <h5>Filter Requests</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('requestinfo.index') }}" id="filter">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="request_id" placeholder="Request ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['request_id']) ? $_GET['request_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="uid" placeholder="User ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['uid']) ? $_GET['uid'] : '' }}">
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="description" placeholder="Description"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['description']) ? $_GET['description'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="url" placeholder="URL"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['url']) ? $_GET['url'] : '' }}">
                                            </div>
                                        </div> --}}
                                      
                                    </div>

                                    <div class="row" style="margin-top: 20px">
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
                                                            <option
                                                                value="{{$stat}}">{{$stat}}</option>
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

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Sort By..." class="chosen-select" tabindex="2"
                                                        name="latest_date">
                                                    <option value="" selected disabled>Sort By...</option>
                                                    @if(!empty($_GET['latest_date']))
                                                        <option value="date"
                                                                @if($_GET['latest_date'] == 'date') selected @endif>Latest Date
                                                        </option>
                                                        
                                                    @else
                                                        <option value="date">Latest Date</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 40px;">
                                        

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Vendor...." class="chosen-select"
                                                        tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['vendor']))

                                                        @foreach($getAllUniqueVendors as $getAllUniqueVendor)
                                                            <option value="{{$getAllUniqueVendor}}"
                                                                    @if($_GET['vendor']  == $getAllUniqueVendor) selected @endif >{{$getAllUniqueVendor}}</option>
                                                        @endforeach

                                                    @else
                                                        @foreach($getAllUniqueVendors as $getAllUniqueVendor)
                                                            <option
                                                                value="{{$getAllUniqueVendor}}">{{$getAllUniqueVendor}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="service">
                                                    <option value="" selected disabled>Select Service Type...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['service']))
                                                        @foreach($serviceTypes as $serviceType)
                                                            <option value="{{ $serviceType }}"
                                                                    @if($_GET['service'] == $serviceType) selected @endif>{{ $serviceType }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($serviceTypes as $serviceType)
                                                            <option
                                                                value="{{ $serviceType }}"> {{ $serviceType }} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction type..."
                                                        class="chosen-select" tabindex="2" name="transaction_type">
                                                    <option value="" selected disabled>Select Micro-Service Type...
                                                    </option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['microservice_type']))
                                                        @foreach($microServiceTypes as $key => $microServiceType)
                                                            <option value="{{ $key }}"
                                                                    @if($_GET['microservice_type'] == $key) selected @endif>{{ $microServiceType }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($microServiceTypes as $key => $microServiceType)
                                                            <option value="{{ $key }}"> {{ $microServiceType }} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('requestinfo.index') }}"><strong>Filter</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('transaction.requestInfo.excel') }}">
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
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all Requests</h5>
                        </div>
                        <div class="ibox-content">                            
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Complete Requests List">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Request ID</th>
                                        <th>UID</th>
                                        <th>Description</th>
                                        <th>Vendor</th>
                                        <th>Service Type</th>
                                        <th>Micro-Service Type</th>
                                        <th>URL</th>
                                        <th>Status</th> 
                                        <th>Date</th>                                        
                                        <th style='width: 100px'>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($requestInfos as $requestInfo)
                                        <tr class="gradeC">
                                            <td>{{ $loop->index + ($requestInfos->perPage() * ($requestInfos->currentPage() - 1)) + 1 }}</td>
                                            <td>{{ $requestInfo->request_id }}</td>
                                            <td>{{ $requestInfo->user_id ?? '---' }}</td>
                                            <td>
                                                @if(!empty($requestInfo->description))
                                                    {{ $requestInfo->description }}                                                
                                                @else
                                                    <p>No Description Provided.</p>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $requestInfo->vendor }}
                                            </td>
                                            <td>
                                                {{ $requestInfo->service_type }}
                                            </td>
                                            <td>
                                                {{ $requestInfo->microservice_type }}
                                            </td>
                                            <td>
                                                {{ $requestInfo->url }}
                                            </td>
                                            <td>
                                                {{ $requestInfo->status }}
                                            </td>      
                                            <td class="center">{{ $requestInfo->created_at }}</td>  
                                            <td>
                                                @include('admin.transaction.requestInfo.requestInfoActionButtons', ['requestInfo' => $requestInfo])
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $requestInfos->appends(request()->query())->links() }}
                            </div>
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

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    <script>
        @if(!empty($_GET))
        $(document).ready(function (e) {
            let a = "Showing {{ $requestInfos->firstItem() }} to {{ $requestInfos->lastItem() }} of {{ $requestInfos->total() }} entries";
            $('.dataTables_info').text(a);
        }); 
        @endif
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`;
        @else '0;100000'; @endif
        let split = amount.split(';');
        $(".ionrange_amount").ionRangeSlider({
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
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

@endsection


