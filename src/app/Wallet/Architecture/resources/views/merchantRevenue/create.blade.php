`@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Wallet Transaction Type Merchant Revenue</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Settings</a>
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

                        <div class="hr-line-dashed"></div>

                        <div class="alert alert-warning">
                            <i class="fa fa-info-circle"></i>
                            Merchant Revenue Type is always <b>percentage</b> and the value is always <b>100%</b>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Add new Merchant Revenue</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('architecture.wallet.merchantRevenue.create', $walletTransactionType->id) }}" enctype="multipart/form-data">
                            @csrf
                            @if(count($availableTitles) > 0)
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <select data-placeholder="Choose Title..." class="chosen-select"  tabindex="2" name="title" required>
                                            <option value="" selected disabled>-- Select Title --</option>
                                            @foreach($availableTitles as $key => $title)
                                                <option value="{{ $title }}" >{{ $title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input name="title" type="text" class="form-control" required>
                                        <small>Merchant Revenue is sent to frontend using this title</small>
                                    </div>
                                </div>
                            @endif


                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Merchant Revenue (description)</label>
                                    <div class="col-sm-10">
                                        <input name="description" type="text" class="form-control">
                                        <small>Empty for default</small>
                                    </div>
                                </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Merchant Revenue Type</label>
                                <div class="col-sm-10">
                                    <select id="selectCommissionType" data-placeholder="Choose Commission Type..." class="chosen-select"  tabindex="2" name="merchant_revenue_type" required>
                                        <option value="" selected disabled>-- Select Merchant Revenue Type --</option>
                                        <option value="PERCENTAGE" >PERCENTAGE</option>
                                        <option value="PERCENTAGE" >FLAT</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Merchant Revenue Value</label>
                                <div class="col-sm-10">
                                    <input name="merchant_revenue_value" type="number" min="0" step='0.1' class="form-control" required>
                                    <small>Value in percentage/  value flat in paisa</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Merchant</label>
                                <div class="col-sm-10">
                                    <select id="selectMerchant" data-placeholder="Choose Merchant..." class="chosen-select"  tabindex="2" name="user_id" required>
                                        <option value="" selected disabled>-- Select Merchant --</option>
                                        @foreach($merchants as $merchant)
                                            <option value="{{$merchant->id}}">{{$merchant->name. '-'. $merchant->mobile_no}}</option>
                                        @endforeach
                                    </select>
                                    <small>The amount will be transferred to this merchants account</small>
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
        $('#selectUserType').on('change', function (e){
            let userType = $(this).val();
            let url = `{{ route('architecture.userType.list') }}`


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:url,
                method:"POST",
                data: { user_type: userType},
                dataType:'JSON',
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

