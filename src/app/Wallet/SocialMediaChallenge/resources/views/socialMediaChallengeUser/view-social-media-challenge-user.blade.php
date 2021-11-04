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
                                    <div class="alert alert-warning" style="width: 100%">
                                        <i class="fa fa-info-circle"></i>&nbsp; Note: <br><b>Methods of Selecting Lucky
                                            Winner</b><br></b>
                                        <b>Automatic : </b> Select Random Winner button will select a random user
                                        automatically. <br>
                                        <b>Manual : </b> You can edit the users and make them a winner. <br>
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
        {{--        @if(!empty($_GET))--}}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of all {{$socialMediaChallenge->title}}'s Users</h5>

                        <form id="randomWinnerForm" role="form" method="post"
                              action="{{ route('socialmediachallenge.winner.random',$socialMediaChallenge->id) }}">
                            <button id="randomWinnerBtn" class="btn btn-primary btn-sm m-t-n-xs" type="submit"
                                    title="Random Winner" style="margin-left: 90%">
                                Select Random Winner
                            </button>
                        </form>

                        <div id="winner-settings" class="modal fade" aria-hidden="true">
                        </div>
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
                                    <th>Video Links</th>
                                    <th>Facebook Links</th>
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
                                        <td>
                                            @if(!empty($socialMediaChallengeUser->link))
                                                <a href="{{$socialMediaChallengeUser->link}}"
                                                   target="_blank">Link</a><br><br>
                                            @else
                                                No Link.
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($socialMediaChallengeUser->facebook_link))
                                                <a href="{{$socialMediaChallengeUser->facebook_link}}"
                                                   target="_blank">Facebook Link</a><br>
                                                <br>
                                            @else
                                                No Link.
                                            @endif
                                        </td>
                                        <td>{{ $socialMediaChallengeUser->created_at }}</td>
                                        <td>
                                            <a href="{{ route('socialmediachallenge.user.edit',$socialMediaChallengeUser->id)}}"
                                               class="btn btn-icon btn-primary btn-sm m-t-n-xs" title="Edit"><i
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
        {{--        @endif--}}
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

    <!--    ****Random Winner Pop Up****    -->
    <script>
        $('#randomWinnerForm').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action');
            let winnerId = $(this).attr('rel');
            console.log(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "GET",
                data: new FormData(this),
                // dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                async: true,
                // beforeSend: function () {
                //     // $("#overlay").fadeIn(300);
                // },
                success: function (resp) {
                    let url = resp.url;
                    let user = resp.user;
                    swal({
                        title: "The Lucky Winner Is :\n Name : " + resp.user.user.name + ".\n Mobile Number : " + resp.user.user.mobile_no,
                        text: "The selected user will be crowned the lucky winner!",
                        type: "info",
                        confirmButtonColor: "#efbd02",
                        confirmButtonText: "Select Lucky Winner!",
                        showCancelButton: true,
                        closeOnConfirm: false
                    }, function (resp) {
                        console.log(resp);
                        if (resp === false) {
                            swal.close();
                        } else {
                            let formInstance = document.getElementById("randomWinnerForm")
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                method: "POST",
                                data: new FormData(formInstance),
                                // dataType: 'JSON',
                                url: url,
                                contentType: false,
                                cache: false,
                                processData: false,
                                async: true,
                                // beforeSend: function () {
                                //     $("#overlay").fadeIn(300);
                                // },
                                success: function (resp) {
                                    console.log(resp);
                                    swal({
                                        title: "The Lucky Winner Has Been Selected",
                                        text: "The lucky winner " + resp.user.name + ", Mobile Number : " + resp.user.mobile_no + " has been added successfully to the winners list.",
                                        type: "success",
                                        confirmButtonColor: "#efbd02",
                                        confirmButtonText: "Accept",
                                        // showCancelButton: true,
                                        closeOnConfirm: true
                                    })
                                }
                            })

                        }
                    })

                    // $(".stats").fadeIn(300);
                    // $("#overlay").fadeOut(100);

                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');
                }
            });


        });
    </script>

@endsection


