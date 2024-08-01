@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Non Real Time Bank Transfer</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Non Real Time Bank Transfer</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Non Real Time Bank Transfer</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post"
                              action="{{ route('nonRealTime.process') }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Bank List</label>
                                <div class="col-sm-10">
                                    <select id="bank_list" data-placeholder="Bank List..."
                                            class="chosen-select" tabindex="2" name="bank_list" required>
                                        <option value="" selected disabled>-- Select Bank List --</option>
                                        @foreach($bankList as $key=>$value)
                                            <option value="{{ $value['bankId'] . '#' . $value['bankName']}}">{{ $value['bankName'] }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Branch List</label>
                                <div class="col-sm-10">
                                    <select id="branch_list" data-placeholder="Branch List..."
                                            class="chosen-select" tabindex="2" name="branch_list" required>
                                        <option value="" selected disabled>-- Select Branch List--</option>
                                        {{--@foreach($userTypes as $key => $userType)
                                            <option value="{{ $userType }}" >{{ $key }}</option>
                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control form-control-sm" name="amount" placeholder="Enter amount">
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Account Number</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control form-control-sm" name="account_number" placeholder="Enter account number">
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Account Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" name="account_name" placeholder="Enter account name">
                                </div>
                            </div>





                            <div class="hr-line-dashed"></div>



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
        $('#bank_list').on('change', function (e) {
            let bankCode = $(this).val();

            let url = `{{ route('nonRealTime.branchList') }}`;


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {
                    bankCode: bankCode
                },

                cache: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {
                   /* console.log(resp)*/

                    let select = $('#branch_list');
                    select.find('option').remove().end();

                    $.each(resp, function (key, value) {
                       /* console.log(value.branchName);*/
                        let o = new Option(value.branchName, value.branchId+'#'+value.branchName, false, false);
                        select.append(o);
                    });

                    select.trigger("chosen:updated");

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    console.log(resp);
                    alert("Something went wrong!Please try again later");

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);
                }
            });
        });

    </script>
@endsection

