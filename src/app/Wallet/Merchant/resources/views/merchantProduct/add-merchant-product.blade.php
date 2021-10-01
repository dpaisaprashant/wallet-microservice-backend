@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Add Merchant Product</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Merchant Product</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Add Merchant Product</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <form method="post" action="{{ route('merchant.product.create') }}" id="merchantProductForm">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Add Merchant Product</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="col-md-12">
                                @include('admin.asset.notification.notify')
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Select Merchant</label>
                                <div class="col-sm-10">
                                    <select class="form-control chosen-select" name="merchant_id" required>
                                        @if(!empty($merchants))
                                            <option value="" disabled selected>Select Merchant</option>
                                            @foreach($merchants as $merchant)
                                                @if(!empty($merchant->id))
                                                    <option value="{{$merchant->id}}">
                                                        Name : {{optional($merchant->user)->name}} | Mobile Number
                                                        : {{optional($merchant->user)->mobile_no}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="">No Merchants Found.</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Product Type</label>
                                <div class="col-sm-10">
                                    <input name="type" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Product Name</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Product Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" type="text" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Product Price</label>
                                <div class="col-sm-10">
                                    <input name="price" type="number" step="0.01" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Service Charge</label>
                                <div class="col-sm-10">
                                    <input name="service_charge" type="number" step="0.01" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-primary btn-sm" type="submit">Create</button>
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

