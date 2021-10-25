@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Social Media Challenges</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Social Media Challenge</strong>
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
                        <h5>Filter Data of Social Challenges</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    {{--                    <div class="ibox-content">--}}
                    {{--                        <div class="row">--}}
                    {{--                            <div class="col-sm-12">--}}
                    {{--                                <form role="form" method="get" action="{{ route('socialmediachallenge.view') }}" id="filter">--}}
                    {{--                                    <div class="row">--}}
                    {{--                                        <div class="col-md-3">--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <input type="text" name="account_name" placeholder="Account Name"--}}
                    {{--                                                       class="form-control"--}}
                    {{--                                                       value="{{ !empty($_GET['account_name']) ? $_GET['account_name'] : '' }}">--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}

                    {{--                                        <div class="col-md-3">--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <input type="text" name="account_number" placeholder="Account Number"--}}
                    {{--                                                       class="form-control"--}}
                    {{--                                                       value="{{ !empty($_GET['account_number']) ? $_GET['account_number'] : '' }}">--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}

                    {{--                                        <div class="col-md-3">--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <input type="text" name="bank_code" placeholder="Bank Code"--}}
                    {{--                                                       class="form-control"--}}
                    {{--                                                       value="{{ !empty($_GET['bank_code']) ? $_GET['bank_code'] : '' }}">--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}

                    {{--                                        <div class="col-md-3">--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <input type="text" name="mobile_number" placeholder="Linked Account Mobile Number"--}}
                    {{--                                                       class="form-control"--}}
                    {{--                                                       value="{{ !empty($_GET['mobile_number']) ? $_GET['mobile_number'] : '' }}">--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}

                    {{--                                    <div class="row" style="margin-top: 20px">--}}
                    {{--                                        <div class="col-md-3">--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <select data-placeholder="Select Verified Status...." class="chosen-select"--}}
                    {{--                                                        tabindex="2" name="verified_status">--}}
                    {{--                                                    <option value="" selected disabled>Select Verified Status...</option>--}}
                    {{--                                                    @if(!empty($_GET['verified_status']))--}}
                    {{--                                                        @foreach($verified_status as $stat)--}}
                    {{--                                                            <option value="{{$stat}}"--}}
                    {{--                                                                @if($_GET['verified_status']  == $stat) selected @endif >{{$stat}}</option>--}}
                    {{--                                                        @endforeach--}}
                    {{--                                                    @else--}}
                    {{--                                                        @foreach($verified_status as $stat)--}}
                    {{--                                                            <option value="{{$stat}}">{{$stat}}</option>--}}
                    {{--                                                        @endforeach--}}
                    {{--                                                    @endif--}}
                    {{--                                                </select>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}

                    {{--                                        <div class="col-md-3">--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <select data-placeholder="Select Register Status...." class="chosen-select"--}}
                    {{--                                                        tabindex="2" name="register_status">--}}
                    {{--                                                    <option value="" selected disabled>Select Register Status...</option>--}}
                    {{--                                                    @if(!empty($_GET['register_status']))--}}
                    {{--                                                        @foreach($register_status as $stat)--}}
                    {{--                                                            <option value="{{$stat}}"--}}
                    {{--                                                                @if($_GET['register_status']  == $stat) selected @endif >{{$stat}}</option>--}}
                    {{--                                                        @endforeach--}}
                    {{--                                                    @else--}}
                    {{--                                                        @foreach($register_status as $stat)--}}
                    {{--                                                            <option value="{{$stat}}">{{$stat}}</option>--}}
                    {{--                                                        @endforeach--}}
                    {{--                                                    @endif--}}
                    {{--                                                </select>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}

                    {{--                                        <div class="col-md-3">--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <input type="text" name="user_id" placeholder="User ID"--}}
                    {{--                                                       class="form-control"--}}
                    {{--                                                       value="{{ !empty($_GET['user_id']) ? $_GET['user_id'] : '' }}">--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}

                    {{--                                        <div class="col-md-3">--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <input type="text" name="user_phone_number" placeholder="Wallet User Phone Number"--}}
                    {{--                                                       class="form-control"--}}
                    {{--                                                       value="{{ !empty($_GET['user_phone_number']) ? $_GET['user_phone_number'] : '' }}">--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}

                    {{--                                    </div>--}}

                    {{--                                    <div class="row" style="margin-top: 20px;">--}}

                    {{--                                        <div class="col-md-3">--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <input type="text" name="reference_id" placeholder="Reference ID"--}}
                    {{--                                                       class="form-control"--}}
                    {{--                                                       value="{{ !empty($_GET['reference_id']) ? $_GET['reference_id'] : '' }}">--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}

                    {{--                                        <div class="col-md-3">--}}
                    {{--                                            <div class="input-group date">--}}
                    {{--                                                <span class="input-group-addon">--}}
                    {{--                                                    <i class="fa fa-calendar"></i>--}}
                    {{--                                                </span>--}}
                    {{--                                                <input id="date_from" type="text" class="form-control date_from"--}}
                    {{--                                                       placeholder="From Created At" name="from" autocomplete="off"--}}
                    {{--                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}

                    {{--                                        <div class="col-md-3">--}}
                    {{--                                            <div class="input-group date">--}}
                    {{--                                                <span class="input-group-addon">--}}
                    {{--                                                    <i class="fa fa-calendar"></i>--}}
                    {{--                                                </span>--}}
                    {{--                                                <input id="date_to" type="text" class="form-control date_to"--}}
                    {{--                                                       placeholder="To Created At" name="to" autocomplete="off"--}}
                    {{--                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}

                    {{--                                    </div>--}}

                    {{--                                    <div style="margin-top: 10px;">--}}
                    {{--                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"--}}
                    {{--                                                formaction="{{ route('socialmediachallenge.view') }}"><strong>Filter</strong>--}}
                    {{--                                        </button>--}}
                    {{--                                    </div>--}}
                    {{--                                    @include('admin.asset.components.clearFilterButton')--}}
                    {{--                                </form>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
        @include('admin.asset.notification.notify')
        {{--        @if(!empty($_GET))--}}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of all Social Media Challenges</h5>
                        @can('Add social media challenge')
                            <a href="{{ route('socialmediachallenge.create') }}" class="btn btn-sm btn-primary btn-xs"
                               style="float: right;margin-top: -5px;">Create a new Challenge</a>
                        @endcan
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Complete Requests List">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Allowed Attempts per User</th>
                                    <th>Expiry Date</th>
                                    <th>Created At</th>
                                    <th style='width: 100px'>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($socialMediaChallenges as $socialMediaChallenge)
                                    <tr class="gradeC">
                                        <td>{{ $loop->index + ($socialMediaChallenges->perPage() * ($socialMediaChallenges->currentPage() - 1)) + 1 }}</td>
                                        <td>{{ $socialMediaChallenge->title }}</td>
                                        <td>{{ $socialMediaChallenge->code }}</td>
                                        <td>{{ $socialMediaChallenge->type }}</td>
                                        <td>
                                            <span class="badge {{$socialMediaChallenge->status == 1 ? "badge-primary" : "badge-danger"}}">{{ $socialMediaChallenge->status==1 ? "Active":"Inactive" }}</span>
                                        </td>
                                        <td>{{ $socialMediaChallenge->attempts_per_user }}</td>
                                        <td>{{ $socialMediaChallenge->expired_at }}</td>
                                        <td>{{ $socialMediaChallenge->created_at }}</td>
                                        <td>
                                            @can('Delete social media challenge')
                                                <form action="{{ route('socialmediachallenge.delete',$socialMediaChallenge->id) }}" method="POST">
                                                    @csrf
                                                    <button
                                                        class="reset btn btn-sm btn-danger btn-icon m-t-n-xs"
                                                        rel="{{ $socialMediaChallenge->id }}"><i
                                                            class="fa fa-trash"></i>
                                                    </button>

                                                    <button id="resetBtn-{{ $socialMediaChallenge->id }}"
                                                            style="display: none" type="submit"
                                                            href="{{ route('socialmediachallenge.delete',$socialMediaChallenge->id) }}"
                                                            class="resetBtn btn btn-sm btn-danger m-t-n-xs">
                                                        <i class="fa fa-trash"></i></button>

                                                    @can('Edit social media challenge')
                                                        <a href="{{ route('socialmediachallenge.edit',$socialMediaChallenge->id)}}" class="btn btn-icon btn-success btn-sm m-t-n-xs"><i class="fa fa-edit"></i></a>
                                                    @endcan
                                                    @include('SocialMediaChallenge::buttons', ['socialMediaChallenge' => $socialMediaChallenge])

                                                    <a href="{{ route('socialmediachallenge.user.view',$socialMediaChallenge->id)}}" class="btn btn-icon btn-success btn-sm m-t-n-xs"><i class="fa fa-users"></i></a>
                                                </form>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $socialMediaChallenges->appends(request()->query())->links() }}
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
    @include('admin.asset.css.sweetalert')

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
            let a = "Showing {{ $socialMediaChallenges->firstItem() }} to {{ $socialMediaChallenges->lastItem() }} of {{ $socialMediaChallenges->total() }} entries";
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
                text: "The selected challenge will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + socialChallengeId).trigger('click');
                swal.close();

            })
        });
    </script>
@endsection


