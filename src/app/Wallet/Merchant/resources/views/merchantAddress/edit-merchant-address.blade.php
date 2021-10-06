@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit Merchant Address</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Merchant Address</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Edit Merchant Address</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <form method="post" action="{{ route('merchant.address.update',$merchantAddress->id) }}" id="merchantAddressForm">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Edit Merchant Address</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="col-md-12">
                                @include('admin.asset.notification.notify')
                            </div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Merchant Location</label>
                                <div class="col-sm-10">
                                    <input name="location" type="text" class="form-control" value="{{$merchantAddress->location}}">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Select Merchant</label>
                                <div class="col-sm-10">
                                    <select class="form-control chosen-select" name="merchant_id">
                                        @if(!empty($merchants))
                                            @foreach($merchants as $merchant)
                                                @if(!empty($merchant->user->id))
                                                    <option value="{{$merchant->id}}" @if($merchant->id == $merchantAddress->merchant_id) selected @endif>
                                                        Name : {{$merchant->user->name}} | Mobile Number : {{$merchant->user->mobile_no}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option>No Merchants Found.</option>
                                        @endif
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div style="margin-top: 20px">
{{--                            <div class="col-sm-4 col-sm-offset-2">--}}
                                <button class="btn btn-primary btn-sm" type="submit">Save Changes</button>
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

@endsection

@section('styles')

    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datatable')
    {{--    @include('admin.asset.css.jsonbubble')--}}
{{--    @include('admin.asset.css.jsoneditor')--}}


@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datatable')
    {{--    @include('admin.asset.js.jsonbubble')--}}
{{--    @include('admin.asset.js.jsoneditor')--}}


@endsection

