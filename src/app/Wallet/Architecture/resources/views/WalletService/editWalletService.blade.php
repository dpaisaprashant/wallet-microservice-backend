@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Service</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Wallet Service</strong>
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
                        <h5>Create Wallet Service</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form method="post" action="{{route('wallet.service.update',$selectedWalletService->id)}}">
                                    @csrf
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Wallet Service</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="service"
                                        value="{{$selectedWalletService->service}}"           placeholder="Wallet Service" required>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Micro Service URL</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="microservice_url"
                                        value="{{$selectedWalletService->core_to_microservice_url}}"          placeholder="Micro Service URL" required>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Wallet Transaction Type ID</label>
                                        <div class="col-sm-10">
                                            <select class="chosen-select" tabindex="2" name="wallet_transaction_type_id" required>
                                            <option value=""disabled>Select Wallet Transaction Type</option>
                                            @foreach($all_wallet_transaction_id as $wallet_transaction_id)
                                                @if($wallet_transaction_id->id == $selectedWalletService->wallet_transaction_type_id)
                                                    <option value="{{$wallet_transaction_id->id}}">
                                                        <p style="font-weight: bolder">Transaction Type&nbsp;&nbsp;:&nbsp;&nbsp;</p>
                                                        {{$wallet_transaction_id['transaction_type']}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;User Type&nbsp;&nbsp;:&nbsp;&nbsp;{{$wallet_transaction_id['user_type']}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;MicroService&nbsp;&nbsp;:&nbsp;&nbsp;{{$wallet_transaction_id['microservice']}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Service&nbsp;&nbsp;:&nbsp;&nbsp;{{$wallet_transaction_id['service'] == null ?'Null':$wallet_transaction_id['service']}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Service Type&nbsp;&nbsp;:&nbsp;&nbsp;{{$wallet_transaction_id['service_type'] == null ? 'Null' : $wallet_transaction_id['service_type']}}
                                                    </option>
                                                @endif

                                            <option value="{{$wallet_transaction_id->id}}">
                                                <p style="font-weight: bolder">Transaction Type&nbsp;&nbsp;:&nbsp;&nbsp;</p>
                                                {{$wallet_transaction_id['transaction_type']}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;User Type&nbsp;&nbsp;:&nbsp;&nbsp;{{$wallet_transaction_id['user_type']}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;MicroService&nbsp;&nbsp;:&nbsp;&nbsp;{{$wallet_transaction_id['microservice']}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Service&nbsp;&nbsp;:&nbsp;&nbsp;{{$wallet_transaction_id['service'] == null ?'Null':$wallet_transaction_id['service']}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Service Type&nbsp;&nbsp;:&nbsp;&nbsp;{{$wallet_transaction_id['service_type'] == null ? 'Null' : $wallet_transaction_id['service_type']}}
                                            </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Validate Payment</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Choose transaction status..."
                                                    class="chosen-select" tabindex="2" name="validate_payment" required>
                                                <option value="" disabled>Validate Payment</option>
                                                @if($selectedWalletService->validate_payment == 1)
                                                    <option selected>Valid</option>
                                                    <option>Invalid</option>
                                                @else
                                                <option>Valid</option>
                                                <option selected>Invalid</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Handle Payment</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Choose transaction status..."
                                                    class="chosen-select" tabindex="2" name="handle_payment" required>
                                                    <option value="" disabled>Validate Payment</option>
                                                @if($selectedWalletService->handle_payment == 1)
                                                    <option selected>Handeled</option>
                                                    <option>Unhandeled</option>
                                                @else
                                                <option>Handeled</option>
                                                <option selected>Unhandeled</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>



                                    <div class="hr-line-dashed"></div>


                                    <div class="form-group row">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

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

@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')


@endsection
