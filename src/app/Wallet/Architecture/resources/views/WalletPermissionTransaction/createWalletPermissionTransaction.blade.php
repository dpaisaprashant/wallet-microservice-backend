@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Wallet Permission Transaction Type </h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Create wallet permission transaction type</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Add new wallet permission transaction</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post"
                              action="{{route('wallet.permission.transaction.type.store')}}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">User Type</label>
                                <div class="col-sm-10">
                                    <select id="selectUserType" data-placeholder="ChooseUser Type..."
                                            class="chosen-select" tabindex="2" name="user_type" required>
                                        <option value="" selected disabled>-- Select User Type --</option>
                                        @foreach($userTypes as $key => $userType)
                                            <option value="{{ $userType }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">User Type Name</label>
                                <div class="col-sm-10">
                                    <select id="selectUserTypeName" data-placeholder="ChooseUser Type..."
                                            class="chosen-select" tabindex="2" name="user_type_id" required>
                                        <option value="" selected disabled>-- Select User Type Name--</option>
                                        {{--@foreach($userTypes as $key => $userType)
                                            <option value="{{ $userType }}" >{{ $key }}</option>
                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>



                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Wallet transaction
                                    type</label>
                                <div class="col-sm-10">
                                    <select id="selectCashbackType" data-placeholder="Choose wallet transaction type..."
                                            class="chosen-select" tabindex="2" name="wallet_transaction_type_id" required>
                                        <option value="" selected disabled>-- Select wallet transaction type --</option>
                                        @foreach($walletTransactionTypes as $key=>$walletTransactionType)
                                            <option value="{{$walletTransactionType->id}}"><p style="font-weight: bolder">Transaction Type&nbsp;&nbsp;:&nbsp;&nbsp;</p>{{$walletTransactionType['transaction_type']}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;User Type&nbsp;&nbsp;:&nbsp;&nbsp;{{$walletTransactionType['user_type']}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;MicroService&nbsp;&nbsp;:&nbsp;&nbsp;{{$walletTransactionType['microservice']}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Service&nbsp;&nbsp;:&nbsp;&nbsp;{{$walletTransactionType['service'] == null ?'Null':$walletTransactionType['service']}}&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Service Type&nbsp;&nbsp;:&nbsp;&nbsp;{{$walletTransactionType['service_type'] == null ? 'Null' : $walletTransactionType['service_type']}} </option>
                                        @endforeach
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

    <script>
        $('#selectUserType').on('change', function (e) {
            let userType = $(this).val();

            let url = `{{ route('architecture.userType.list') }}`


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {
                    user_type: userType
                },
                dataType: 'JSON',
                cache: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {
                    console.log(resp)

                    let select = $('#selectUserTypeName');
                    select.find('option').remove().end();

                    $.each(resp, function (key, value) {
                        let o = new Option(value.name, value.id, false, false);
                        select.append(o);
                    });
                    select.trigger("chosen:updated");

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);
                }
            });
        });

    </script>
@endsection

