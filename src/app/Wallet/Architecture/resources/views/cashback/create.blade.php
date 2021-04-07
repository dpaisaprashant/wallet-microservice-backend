@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Wallet Transaction Type Cashback</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Create General Page Settings</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Wallet Transaction Type</h5>
                    </div>
                    <div class="ibox-content">
                        <h3>
                            <span class="font-bold">User Type:
                            </span> @if($walletTransactionType->user_type == \App\Models\User::class)
                                User
                            @elseif($walletTransactionType->user_type == \App\Models\Merchant\Merchant::class)
                                Merchant
                            @endif

                            | <span class="font-bold">Vendor: </span> {{ $walletTransactionType->vendor }}
                            | <span class="font-bold">Transaction Category: </span> {{ $walletTransactionType->transaction_category }}
                            | <span class="font-bold">Service Type: </span> {{ $walletTransactionType->service_type }}
                            @isset($walletTransactionType->service)
                                | <span class="font-bold">Service: </span> {{ $walletTransactionType->service }}</h3>
                        @endisset
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Add new cashback</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('architecture.trasnaction.cashback.create', $walletTransactionType->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input name="title" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">User Type</label>
                                <div class="col-sm-10">
                                    <select id="selectUserType" data-placeholder="ChooseUser Type..." class="chosen-select"  tabindex="2" name="user_type" required>
                                        <option value="" selected disabled>-- Select User Type --</option>
                                        @foreach($userTypes as $key => $userType)
                                            <option value="{{ $userType }}" >{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">User Type Name</label>
                                <div class="col-sm-10">
                                    <select id="selectUserType" data-placeholder="ChooseUser Type..." class="chosen-select"  tabindex="2" name="user_type" required>
                                        <option value="" selected disabled>-- Select User Type Name--</option>
                                        {{--@foreach($userTypes as $key => $userType)
                                            <option value="{{ $userType }}" >{{ $key }}</option>
                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @include('admin.asset.css.summernote')
    @include('admin.asset.css.chosen')

@endsection

@section('scripts')
    @include('admin.asset.js.summernote')
    @include('admin.asset.js.chosen')
@endsection

