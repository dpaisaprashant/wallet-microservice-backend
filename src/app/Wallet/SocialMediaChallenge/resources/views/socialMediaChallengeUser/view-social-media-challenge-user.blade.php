@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{$socialMediaChallenge->title}}'s Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('socialmediachallenge.view',$socialMediaChallenge->id) }}">Social
                        Media Challenges</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Social Media Challenge Users</strong>
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
                    <div class="ibox-title collapse-link">
                        <h5>Filter Fields</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('linkedaccounts.view') }}" id="filter">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="user_name" placeholder="User Name"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user_name']) ? $_GET['user_name'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="user_mobile" placeholder="User Mobile"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user_mobile']) ? $_GET['user_mobile'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="caption" placeholder="Caption"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['caption']) ? $_GET['caption'] : '' }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="margin-top: 20px">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Challenge Status...."
                                                        class="chosen-select"
                                                        tabindex="2" name="challenge_status">
                                                    <option value="" selected disabled>Select Challenge Status...
                                                    </option>
                                                    @if(!empty($_GET['challenge_status']))
                                                        @foreach($challenge_status as $stat)
                                                            <option value="{{$stat}}"
                                                                    @if($_GET['challenge_status']  == $stat) selected @endif >{{$stat}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($challenge_status as $stat)
                                                            <option value="{{$stat}}">{{$stat}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        {{--                                                            <div class="col-md-3">--}}
                                        {{--                                                                <div class="input-group date">--}}
                                        {{--                                                                    <span class="input-group-addon">--}}
                                        {{--                                                                        <i class="fa fa-calendar"></i>--}}
                                        {{--                                                                    </span>--}}
                                        {{--                                                                    <input id="date_from" type="text" class="form-control date_from"--}}
                                        {{--                                                                           placeholder="From Created At" name="from" autocomplete="off"--}}
                                        {{--                                                                           value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">--}}
                                        {{--                                                                </div>--}}
                                        {{--                                                            </div>--}}

                                        {{--                                                            <div class="col-md-3">--}}
                                        {{--                                                                <div class="input-group date">--}}
                                        {{--                                                                    <span class="input-group-addon">--}}
                                        {{--                                                                        <i class="fa fa-calendar"></i>--}}
                                        {{--                                                                    </span>--}}
                                        {{--                                                                    <input id="date_to" type="text" class="form-control date_to"--}}
                                        {{--                                                                           placeholder="To Created At" name="to" autocomplete="off"--}}
                                        {{--                                                                           value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">--}}
                                        {{--                                                                </div>--}}
                                        {{--                                                            </div>--}}

                                    </div>

                                    <div style="margin-top: 10px;">
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('socialmediachallenge.user.view',$socialMediaChallenge->id) }}">
                                            <strong>Filter</strong>
                                        </button>
                                    </div>

                                    @include('admin.asset.components.clearFilterButton')
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($_GET))
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all {{$socialMediaChallenge->title}}'s Users</h5>
{{--                            @include('SocialMediaChallenge::socialMediaChallengeUser/lucky-winner', ['socialMediaChallenge' => $socialMediaChallenge])--}}
{{--                            <a href="{{route('socialmediachallenge.winner.random',$socialMediaChallenge->id)}}"--}}
{{--                               class="btn btn-sm btn-primary btn-xs"--}}
{{--                               style="float: right;margin-top: -5px;">Select random winner</a>--}}
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
                                        <th>Caption</th>
                                        <th>Challenge Status</th>
                                        <th>Links</th>
                                        <th>Created At</th>
                                        <th style='width: 100px'>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($socialMediaChallengeUsers as $socialMediaChallengeUser)
                                        <tr class="gradeC">
                                            <td>{{ $loop->index + ($socialMediaChallengeUsers->perPage() * ($socialMediaChallengeUsers->currentPage() - 1)) + 1 }}</td>
                                            <td>{{ $socialMediaChallengeUser->user->name }}</td>
                                            <td>{{ $socialMediaChallengeUser->user->mobile_no }}</td>
                                            <td> {{ $socialMediaChallengeUser->caption }} </td>
                                            <td>
                                            <span
                                                class="badge badge-info">{{ $socialMediaChallengeUser->challenge_status }}</span>
                                            </td>
                                            <td>
                                                @include('SocialMediaChallenge::socialMediaChallengeUser/links', ['socialMediaChallengeUser' => $socialMediaChallengeUser])
                                            </td>
                                            <td>{{ $socialMediaChallengeUser->created_at }}</td>
                                            <td>
                                                <a href="{{ route('socialmediachallenge.user.edit',$socialMediaChallengeUser->id)}}"
                                                   class="btn btn-icon btn-primary btn-sm m-t-n-xs"><i
                                                        class="fa fa-edit"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $socialMediaChallengeUsers->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    @include('admin.asset.css.sweetalert')

@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    <script>
        @if(!empty($_GET))
        $(document).ready(function (e) {
            let a = "Showing {{ $socialMediaChallengeUsers->firstItem() }} to {{ $socialMediaChallengeUsers->lastItem() }} of {{ $socialMediaChallengeUsers->total() }} entries";
            $('.dataTables_info').text(a);
        });
        @endif
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <!-- Page-Level Scripts -->
    @include('admin.asset.js.sweetalert')
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let socialChallengeId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "The selected user will be crowned the lucky winner!",
                type: "success",
                confirmButtonColor: "#efbd02",
                confirmButtonText: "Select Lucky Winner!",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + socialChallengeId).trigger('click');
                swal.close();

            })
        });
    </script>

@endsection


