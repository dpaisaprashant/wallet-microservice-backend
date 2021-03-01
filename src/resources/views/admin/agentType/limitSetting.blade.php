@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ ucwords(strtolower($agentType->name)) }} Limit Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>{{ ucwords(strtolower($agentType->name)) }} Limit Settings</strong>
                </li>

            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('agent.type.limit', $agentType->id) }}" >
                    @csrf
                    {{-- Load--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Load (Currency in paisa)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'load_daily_limit'] ?? '' }}" name="{{$agent}}load_daily_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'load_daily_verified_limit'] ?? '' }}" name="{{$agent}}load_daily_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'load_monthly_limit'] ?? '' }}" name="{{$agent}}load_monthly_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'load_monthly_verified_limit'] ?? '' }}" name="{{$agent}}load_monthly_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'load_transaction_limit'] ?? '' }}" name="{{$agent}}load_transaction_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'load_transaction_verified_limit'] ?? '' }}" name="{{$agent}}load_transaction_verified_limit" type="text" class="form-control">
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Limits setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>


                        </div>
                    </div>


                    {{-- Payment--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Payment (Currency in paisa)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'payment_daily_limit'] ?? '' }}" name="{{$agent}}payment_daily_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'payment_daily_verified_limit'] ?? '' }}" name="{{$agent}}payment_daily_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'payment_monthly_limit'] ?? '' }}" name="{{$agent}}payment_monthly_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'payment_monthly_verified_limit'] ?? '' }}" name="{{$agent}}payment_monthly_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'payment_transaction_limit'] ?? '' }}" name="{{$agent}}payment_transaction_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'payment_transaction_verified_limit'] ?? '' }}" name="{{$agent}}payment_transaction_verified_limit" type="text" class="form-control">
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Limits setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>


                        </div>
                    </div>

                    {{-- Transfers--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Transfers (Currency in paisa)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'transfers_daily_limit'] ?? '' }}" name="{{$agent}}transfers_daily_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'transfers_daily_verified_limit'] ?? '' }}" name="{{$agent}}transfers_daily_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'transfers_monthly_limit'] ?? '' }}" name="{{$agent}}transfers_monthly_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'transfers_monthly_verified_limit'] ?? '' }}" name="{{$agent}}transfers_monthly_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'transfers_transaction_limit'] ?? '' }}" name="{{$agent}}transfers_transaction_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'transfers_transaction_verified_limit'] ?? '' }}" name="{{$agent}}transfers_transaction_verified_limit" type="text" class="form-control">
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Limits setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>


                    {{--Card fund load (SCT)--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Card SCT (Currency in paisa)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'sct_daily_limit'] ?? '' }}" name="{{$agent}}sct_daily_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'sct_daily_verified_limit'] ?? '' }}" name="{{$agent}}sct_daily_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'sct_monthly_limit'] ?? '' }}" name="{{$agent}}sct_monthly_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'sct_monthly_verified_limit'] ?? '' }}" name="{{$agent}}sct_monthly_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'sct_transaction_limit'] ?? '' }}" name="{{$agent}}sct_transaction_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'sct_transaction_verified_limit'] ?? '' }}" name="{{$agent}}sct_transaction_verified_limit" type="text" class="form-control">
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Limits setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--bank_transfer--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Bank Transfer (Currency in paisa)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'bank_transfer_daily_limit'] ?? '' }}" name="{{$agent}}bank_transfer_daily_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'bank_transfer_daily_verified_limit'] ?? '' }}" name="{{$agent}}bank_transfer_daily_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'bank_transfer_monthly_limit'] ?? '' }}" name="{{$agent}}bank_transfer_monthly_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'bank_transfer_monthly_verified_limit'] ?? '' }}" name="{{$agent}}bank_transfer_monthly_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'bank_transfer_transaction_limit'] ?? '' }}" name="{{$agent}}bank_transfer_transaction_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'bank_transfer_transaction_verified_limit'] ?? '' }}" name="{{$agent}}bank_transfer_transaction_verified_limit" type="text" class="form-control">
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Limits setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
    <script>
        $('#resetDailyLimit').on('click', function(e){
            e.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: 'post',
                url: '',
                async: true,
                data: {

                },
                beforeSend: function (resp) {

                },
                success: function (resp) {

                },

                error: function (resp) {

                }
            });

        })
    </script>

    <script>
        $('#resetMonthlyLimit').on('click', function (e) {
            e.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: 'post',
                url: '',
                async: true,
                data: {

                },
                beforeSend: function (resp) {

                },
                success: function (resp) {

                },

                error: function (resp) {

                }
            });

        })
    </script>
@endsection

