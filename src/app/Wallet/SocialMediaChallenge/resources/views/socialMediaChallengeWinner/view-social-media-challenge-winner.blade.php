@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Social Media Challenge Winners</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Social Media Challenge Winners</strong>
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
                    <div class="ibox-title">
                        <h5>List of all the Winners</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Complete Requests List">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User Name</th>
                                    <th>User Mobile Number</th>
                                    <th>Winner Of</th>
                                    <th>Won At</th>
{{--                                    <th style='width: 100px'>Actions</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($socialMediaChallengeWinners as $socialMediaChallengeWinner)
                                    <tr class="gradeC">
                                        <td>{{ $loop->index + ($socialMediaChallengeWinners->perPage() * ($socialMediaChallengeWinners->currentPage() - 1)) + 1 }}</td>
                                        <td>{{ $socialMediaChallengeWinner->user->name }}</td>
                                        <td>{{ $socialMediaChallengeWinner->user->mobile_no }}</td>
                                        <td>{{ $socialMediaChallengeWinner->socialMediaChallenge->title }}</td>
                                        <td>
                                        {{ \Carbon\Carbon::parse($socialMediaChallengeWinner->won_at)->format('Y-m-d')}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $socialMediaChallengeWinners->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    <script>
        @if(!empty($_GET))
        $(document).ready(function (e) {
            let a = "Showing {{ $socialMediaChallengeWinners->firstItem() }} to {{ $socialMediaChallengeWinners->lastItem() }} of {{ $socialMediaChallengeWinners->total() }} entries";
            $('.dataTables_info').text(a);
        });
        @endif
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>



@endsection


