@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Merchant event List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Merchant event</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Merchant event</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="mobile_no" placeholder="Mobile Number" class="form-control" value="{{ !empty($_GET['mobile_no']) ? $_GET['mobile_no'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Sort By..." class="chosen-select"  tabindex="2" name="sort">
                                                    <option value="" selected disabled>Sort By...</option>
                                                    @if(!empty($_GET['sort']))
                                                        <option value="date" @if($_GET['sort'] == 'date') selected @endif>Latest Date</option>
                                                        <option value="amount" @if($_GET['sort'] == 'rate') selected @endif>Highest Rate</option>
                                                    @else
                                                        <option value="date">Latest Date</option>
                                                        <option value="rate">Highest Rate</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('sparrow.view') }}"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('sparrowSMS.excel') }}"><strong>Excel</strong></button>
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
                        <h5>List of Merchant event</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Merchant event List">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Merchant</th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Logo</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $event)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($events->perPage() * ($events->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                            {{ $event->merchant->name }}
                                        </td>
                                        <td>
                                            {{ $event->title }}
                                        </td>
                                        <td>
                                            {{ $event->location }}
                                        </td>
                                        <td>
                                            {{ $event->date }}
                                        </td>
                                        <td>
                                            {{ $event->time }}
                                        </td>
                                        <td>
                                            {{ $event->end_time }}
                                        </td>
                                        <td>
                                            {{ $event->category }}
                                        </td>
                                        <td>
                                            {{ $event->description }}
                                        </td>
                                        <td>
                                            @include('Merchant::merchantEvent.status')
                                        </td>
                                        <td>
                                            @isset($event->image)
                                                <img style="width: 100%" src="{{ config('dpaisa-api-url.merchant_event_url') . $event->image }}" alt="">
                                            @endisset
                                        </td>
                                        <td>
                                            @isset($event->logo)
                                                <img style="width: 100%" src="{{ config('dpaisa-api-url.merchant_event_url') . $event->logo }}" alt="">
                                            @endisset
                                        </td>
                                        <td>
                                            <a style="margin-top: 5px;" href="{{route('merchant.event.detail', $event)}}" class="btn btn-sm btn-icon btn-primary m-t-n-xs" title="Event Details"><i class="fa fa-info"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $events->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')
@endsection

@section('scripts')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datatable')
@endsection


