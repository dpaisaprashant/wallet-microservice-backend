@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Transaction Fee Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transaction Fee Settings</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <form method="post" enctype="multipart/form-data" id="notificationForm">
                    @csrf
                    @include('admin.setting.transactionFee.npay')

                    {{--PAYPOINT--}}
                    {{--NTC--}}
                    @include('admin.setting.transactionFee.ntc')

                    {{--NCELL--}}
                    @include('admin.setting.transactionFee.ncell')

                    {{--Smartcell--}}
                    @include('admin.setting.transactionFee.smartcell')

                    {{--UTL--}}
                    @include('admin.setting.transactionFee.utl')

                    {{--Dishhome--}}
                    @include('admin.setting.transactionFee.dishhome')

                    {{--SimTv--}}
                    @include('admin.setting.transactionFee.simtv')

                    {{--NEA--}}
                    @include('admin.setting.transactionFee.nea')

                    {{--websurfer--}}
                    @include('admin.setting.transactionFee.webserfer')

                    {{--Arrownet--}}
                    @include('admin.setting.transactionFee.arrownet')

                    {{--Worldlink--}}
                    @include('admin.setting.transactionFee.worldlink')

                    {{--subisu--}}
                    @include('admin.setting.transactionFee.subishu')

                    {{--NetTv--}}
                    @include('admin.setting.transactionFee.nettv')

                    {{--Vianet--}}
                    @include('admin.setting.transactionFee.vianet')

                    {{--Nepal Water--}}
                    @include('admin.setting.transactionFee.nepalwater')

                    {{--Khanepani Water--}}
                    @include('admin.setting.transactionFee.khanepaniwater')

                    {{--Mero Tv--}}
                    @include('admin.setting.transactionFee.merotv')

                    {{--Sky--}}
                    @include('admin.setting.transactionFee.sky')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @include('admin.asset.css.summernote')
@endsection

@section('scripts')
   @include('admin.asset.js.summernote')

    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endsection

