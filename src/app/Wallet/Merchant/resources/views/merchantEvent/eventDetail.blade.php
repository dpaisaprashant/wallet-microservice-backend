@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit Merchant Event</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Merchant Event</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Edit Merchant Event</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <form method="post" action="{{ route('merchant.event.detail', $event) }}" enctype="multipart/form-data"
              id="agentForm">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Select User</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="col-md-12">
                                @include('admin.asset.notification.notify')
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Merchant</label>
                                <div class="col-sm-10">
                                    <input value="{{ $event->merchant->name }}" type="text" class="form-control"
                                           disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input value="{{ $event->title }}" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-10">
                                    <input value="{{ $event->location }}" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input value="{{ $event->date }}" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Start Time</label>
                                <div class="col-sm-10">
                                    <input value="{{ $event->time }}" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">End Time</label>
                                <div class="col-sm-10">
                                    <input value="{{ $event->time }}" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <input value="{{ $event->category }}" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea style="width: 100%" disabled>{{ $event->description }}</textarea>
                                </div>
                            </div>


                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Merchant Event Status</label>
                                <div class="col-sm-10">
                                    <select id="eventStatus" data-placeholder="Choose Status..." class="chosen-select"
                                            tabindex="2" name="status" required>
                                        <option value="" selected disabled>Status.</option>
                                        <option
                                            value="{{ \App\Models\Merchant\MerchantEvent::STATUS_ACCEPTED }}"
                                            {{ \App\Models\Merchant\MerchantEvent::STATUS_ACCEPTED == $event->status ? "selected" : "" }}
                                        >
                                            {{ \App\Models\Merchant\MerchantEvent::STATUS_ACCEPTED }}
                                        </option>

                                        <option
                                            value="{{ \App\Models\Merchant\MerchantEvent::STATUS_REJECTED }}"
                                            {{ \App\Models\Merchant\MerchantEvent::STATUS_REJECTED == $event->status ? "selected" : "" }}
                                        >
                                            {{ \App\Models\Merchant\MerchantEvent::STATUS_REJECTED }}
                                        </option>

                                        <option
                                            value="{{ \App\Models\Merchant\MerchantEvent::STATUS_PROCESSING }}"
                                            {{ \App\Models\Merchant\MerchantEvent::STATUS_PROCESSING == $event->status ? "selected" : "" }}
                                        >
                                            {{ \App\Models\Merchant\MerchantEvent::STATUS_PROCESSING }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Event Image</label>
                                <div class="col-sm-10">
                                    @if(!empty($event->image))
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="{{ config('dpaisa-api-url.merchant_event_url') . $event->image }}">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Event Logo</label>
                                <div class="col-sm-10">
                                    @if(!empty($event->logo))
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="{{ config('dpaisa-api-url.merchant_event_url') . $event->logo }}">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="table-responsive">
                                <h2>Event Tickets</h2>
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Sparrow SMS List">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($event->merchantEventTickets as $ticket)
                                        <tr class="gradeX">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                {{ $ticket->title }}
                                            </td>
                                            <td>
                                                Rs.{{ $ticket->price }}
                                            </td>
                                            <td class="center">
                                                {{ $ticket->description }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="hr-line-dashed"></div>


                            <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Edit Merchant
                                    Event</strong></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    {{--DISCOUNT--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Event Discount</h5>
                        </div>
                        <div class="ibox-content">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Discount type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="type">
                                        @if(!empty($event->eventCashback))
                                            <option value="FLAT"
                                                    @if($event->eventCashback->cashback_type == 'FLAT') selected @endif>Flat
                                            </option>
                                            <option value="PERCENTAGE"
                                                    @if($event->eventCashback->cashback_type == 'PERCENTAGE') selected @endif>
                                                Percentage
                                            </option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $event->eventCashback->cashback_value ?? ''}}" name="value"
                                           type="number" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Update Discount</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



@endsection

@section('styles')
    <link href="{{ asset('admin/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">

    <style>
        .note-editing-area{
            height: 150px;
        }
    </style>

    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datatable')

@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datatable')
@endsection

