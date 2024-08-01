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

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('socialmediachallenge.view') }}"
                                      id="filter">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="title" placeholder="Challenge Title"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['title']) ? $_GET['title'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="code" placeholder="Challenge Code"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['code']) ? $_GET['code'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="type" placeholder="Challenge Type"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['type']) ? $_GET['type'] : '' }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="margin-top: 20px">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="Select Status...." class="chosen-select"
                                                        tabindex="2" name="status">
                                                    <option value="" selected disabled>Select Status...</option>
                                                    @if(!empty($_GET['status']))
                                                        @foreach($status as $stat)
                                                            <option value="{{$stat}}"
                                                                    @if($_GET['status']  == $stat) selected @endif > @if($stat==1)
                                                                    Active @else Inactive @endif</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($status as $stat)
                                                            <option value="{{$stat}}"> @if($stat==1) Active @else
                                                                    Inactive @endif </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 20px;">
                                    </div>

                                    <div style="margin-top: 10px;">
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('socialmediachallenge.view') }}">
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
        @include('admin.asset.notification.notify')
{{--        @if(!empty($_GET))--}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all Social Media Challenges</h5>
                            @can('Add social media challenge')
                                <a href="{{ route('socialmediachallenge.create') }}"
                                   class="btn btn-sm btn-primary btn-xs"
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
                                            <span
                                                class="badge {{$socialMediaChallenge->status == 1 ? "badge-primary" : "badge-danger"}}">{{ $socialMediaChallenge->status==1 ? "Active":"Inactive" }}</span>
                                            </td>
                                            <td>{{ $socialMediaChallenge->attempts_per_user }}</td>
                                            <td>{{\Carbon\Carbon::parse($socialMediaChallenge->expired_at)->format('Y-m-d')}}</td>
                                            <td>{{\Carbon\Carbon::parse($socialMediaChallenge->created_at)->format('Y-m-d')}}</td>
                                            <td>
{{--                                                @can('Delete social media challenge')--}}
{{--                                                    <form--}}
{{--                                                        action="{{ route('socialmediachallenge.delete',$socialMediaChallenge->id) }}"--}}
{{--                                                        method="POST">--}}
{{--                                                        @csrf--}}
{{--                                                        <button--}}
{{--                                                            class="reset btn btn-sm btn-danger btn-icon m-t-n-xs"--}}
{{--                                                            rel="{{ $socialMediaChallenge->id }}"><i--}}
{{--                                                                class="fa fa-trash"></i>--}}
{{--                                                        </button>--}}

{{--                                                        <button id="resetBtn-{{ $socialMediaChallenge->id }}"--}}
{{--                                                                style="display: none" type="submit"--}}
{{--                                                                href="{{ route('socialmediachallenge.delete',$socialMediaChallenge->id) }}"--}}
{{--                                                                class="resetBtn btn btn-sm btn-danger m-t-n-xs">--}}
{{--                                                            <i class="fa fa-trash"></i></button>--}}

                                                        @can('Edit social media challenge')
                                                            <a href="{{ route('socialmediachallenge.edit',$socialMediaChallenge->id)}}"
                                                               class="btn btn-icon btn-success btn-sm m-t-n-xs"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endcan
                                                        @include('SocialMediaChallenge::buttons', ['socialMediaChallenge' => $socialMediaChallenge])
<br>
                                                <br>

                                                        <a href="{{ route('socialmediachallenge.user.view',$socialMediaChallenge->id)}}"
                                                           class="btn btn-primary btn-success btn-sm m-t-n-xs" ><i
                                                                class="fa fa-users"></i>&nbsp;View Participants</a>
{{--                                                    </form>--}}
{{--                                                @endcan--}}

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


