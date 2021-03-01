@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Limits Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Limits Settings</strong>
                </li>

            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('settings.limit') }}" >
                    @csrf

                    {{--Reset Limit--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Reset Limits</h5>
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
                                <label class="col-sm-2 col-form-label">Reset Daily Limit</label>
                                <div class="col-sm-10">
                                    <a id="resetDailyLimit" href="" class="btn btn-primary"><b>Reset Limit</b></a>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Reset Monthly Limit</label>
                                <div class="col-sm-10">
                                    <a id="resetMonthlyLimit" href="" class="btn btn-primary"><b>Reset Limit</b></a>
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


                    {{--Load--}}
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
                                    <input value="{{ $settings['load_daily_limit'] ?? '' }}" name="load_daily_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['load_daily_verified_limit'] ?? '' }}" name="load_daily_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['load_monthly_limit'] ?? '' }}" name="load_monthly_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['load_monthly_verified_limit'] ?? '' }}" name="load_monthly_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['load_transaction_limit'] ?? '' }}" name="load_transaction_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['load_transaction_verified_limit'] ?? '' }}" name="load_transaction_verified_limit" type="text" class="form-control">
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
                                    <input value="{{ $settings['payment_daily_limit'] ?? '' }}" name="payment_daily_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['payment_daily_verified_limit'] ?? '' }}" name="payment_daily_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['payment_monthly_limit'] ?? '' }}" name="payment_monthly_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['payment_monthly_verified_limit'] ?? '' }}" name="payment_monthly_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['payment_transaction_limit'] ?? '' }}" name="payment_transaction_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['payment_transaction_verified_limit'] ?? '' }}" name="payment_transaction_verified_limit" type="text" class="form-control">
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
                                    <input value="{{ $settings['transfers_daily_limit'] ?? '' }}" name="transfers_daily_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['transfers_daily_verified_limit'] ?? '' }}" name="transfers_daily_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['transfers_monthly_limit'] ?? '' }}" name="transfers_monthly_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['transfers_monthly_verified_limit'] ?? '' }}" name="transfers_monthly_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['transfers_transaction_limit'] ?? '' }}" name="transfers_transaction_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['transfers_transaction_verified_limit'] ?? '' }}" name="transfers_transaction_verified_limit" type="text" class="form-control">
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
                                    <input value="{{ $settings['sct_daily_limit'] ?? '' }}" name="sct_daily_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['sct_daily_verified_limit'] ?? '' }}" name="sct_daily_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['sct_monthly_limit'] ?? '' }}" name="sct_monthly_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['sct_monthly_verified_limit'] ?? '' }}" name="sct_monthly_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['sct_transaction_limit'] ?? '' }}" name="sct_transaction_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['sct_transaction_verified_limit'] ?? '' }}" name="sct_transaction_verified_limit" type="text" class="form-control">
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
                                    <input value="{{ $settings['bank_transfer_daily_limit'] ?? '' }}" name="bank_transfer_daily_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daily Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['bank_transfer_daily_verified_limit'] ?? '' }}" name="bank_transfer_daily_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['bank_transfer_monthly_limit'] ?? '' }}" name="bank_transfer_monthly_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Monthly Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['bank_transfer_monthly_verified_limit'] ?? '' }}" name="bank_transfer_monthly_verified_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['bank_transfer_transaction_limit'] ?? '' }}" name="bank_transfer_transaction_limit" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Transaction Verified Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['bank_transfer_transaction_verified_limit'] ?? '' }}" name="bank_transfer_transaction_verified_limit" type="text" class="form-control">
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

