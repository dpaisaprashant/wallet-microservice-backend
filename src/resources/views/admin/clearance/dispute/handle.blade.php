@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Handle Dispute</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a >Dispute</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>#{{ $disputeTransaction->disputeable->id }} transaction's dispute handle</strong>
                </li>

            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('dispute.handle', $disputeTransaction->id) }}" >

                    @if($disputeTransaction->disputeable instanceof \App\Models\UserLoadTransaction)
                        @include('admin.clearance.dispute.type.npay')
                    @elseif($disputeTransaction->disputeable instanceof \App\Models\UserTransaction)
                        @include('admin.clearance.dispute.type.paypoint')
                    @endif

                </form>
            </div>
        </div>
    </div>



@endsection

@section('styles')
    @include('admin.asset.css.chosen')
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')

    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endsection

