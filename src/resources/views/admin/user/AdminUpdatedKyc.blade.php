'@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Admin Updated Kyc List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>View Admin Update Kyc List</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    @include('admin.asset.notification.notify')
                    <div class="ibox-title">
                        <h5>List of wallet service</h5>
                        @can('Add wallet service')
                            <div class="ibox-tools" style="top: 8px;">
                                <a href="{{ route('wallet.service.create') }}">
                                    <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add
                                        Wallet Service
                                    </button>
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Wallet Service List">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Admin</th>
                                    <th>User-Kyc</th>
                                    <th>user Kyc Before Edit</th>
                                    <th>User Kyc After Edit</th>
                                    <th>Edited At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($adminUpdatedKycs as $adminUpdatedKyc)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($adminUpdatedKycs->perPage() * ($adminUpdatedKycs->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                            &nbsp;{{ $adminUpdatedKyc->admin->name}}
                                        </td>
                                        <td>{{ $adminUpdatedKyc->userKyc->user->mobile_no}}</td>
                                        <td>@include('admin.user.AdmindUpdateKycJsonDecode', ['adminUpdatedKyc' => $adminUpdatedKyc,'type'=>"before_change"])</td>
                                        <td>@include('admin.user.AdmindUpdateKycJsonDecode', ['adminUpdatedKyc' => $adminUpdatedKyc,'type'=>"after_change"])</td>
                                        <td>{{$adminUpdatedKyc->updated_at}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ $adminUpdatedKycs->appends(request()->query())->links() }}
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

    @include('admin.asset.css.sweetalert')
@endsection

@section('scripts')

    @include('admin.asset.js.sweetalert')
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "Wallet service will be deleted'",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete service",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')

    @include('admin.asset.js.sweetalert')

    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $adminUpdatedKycs->firstItem() }} to {{ $adminUpdatedKycs->lastItem() }} of {{ $adminUpdatedKycs->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>

@endsection

