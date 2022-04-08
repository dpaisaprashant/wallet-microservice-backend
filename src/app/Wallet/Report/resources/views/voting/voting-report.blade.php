@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Campaign Voting Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Campaign Voting Report</strong>
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
                        <h5>Filter Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    {{--                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>--}}
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('report.voting') }}"
                                      id="filter">
                                    <br>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Select Campaign</label>
                                        <div class="col-4" style="text-align: center !important;">
                                            <select class="chosen-select" tabindex="2"
                                                    name="event_code" required>
                                                <option value="" selected disabled>-- Select Campaign --</option>

                                                @foreach($events as $event)
                                                    <option value="{{ $event->event_code }}"
                                                            @if(!empty($_GET['event_code']) && $_GET['event_code'] == $event->event_code) selected @endif> {{ $event->name }}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                        </div>

                                        <div class="col-4" style="text-align: center !important;">
                                            <select class="chosen-select" tabindex="2"
                                                    name="status" >
                                                <option value="" selected  disabled> -- Select Status --</option>
                                                <option value="1"
                                                        @if(!empty($_GET['status']) && $_GET['status'] == 1) selected @endif > Qualified </option>
                                                <option value="-1"
                                                        @if(!empty($_GET['status']) && $_GET['status'] == -1) selected @endif> Disqualified </option>

                                            </select>
                                            <br>
                                        </div>
                                    </div>
<br>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Select Date</label>
                                        <div class="col-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text"
                                                       class="form-control date_from" placeholder="From"
                                                       name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}"
                                                >
                                            </div>
                                            <br>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group date">
                                                 <span class="input-group-addon">
                                                     <i class="fa fa-calendar"></i>
                                                 </span>
                                                <input id="date_load_to" type="text"
                                                       class="form-control date_to" placeholder="To" name="to"
                                                       autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('report.voting') }}">
                                            <strong>Generate Report</strong>
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
                @include('admin.asset.notification.notify')
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List Generated for Campaign Participants Report</h5>
                        </div>

                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Campaign Participants Report">
                                    <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($participants as $participant)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$participant->name}}</td>
                                            <td>{{$participant->mobile_no}}</td>
                                            <td>
                                                <a href="{{asset($baseUrl.$participant->image)}}" target="_blank">
                                                    <img src="{{asset($baseUrl.$participant->image)}}"
                                                         style="max-width: 200px !important;">
                                                </a>
                                            </td>

                                            <td>
                                                @if($participant->status == 1)
                                                    <span class="badge badge-primary">Qualified</span>
                                                @else
                                                    <span class="badge badge-danger">Disqualified</span>
                                                @endif
                                            </td>
                                            <td>{{$participant->created_at}}</td>
                                            <td>

                                                {{--                                                @can('Delete whitelisted ip')--}}
                                                <form action="{{ route('participant.disqualify',$participant->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    <button
                                                        class="reset btn btn-sm btn-warning m-t-n-xs"
                                                        rel="{{ $participant->id }}"><i class="fa fa-lock"></i> &nbsp;
                                                        <i class="fa fa-unlock"></i>
                                                    </button>

                                                    <button id="resetBtn-{{ $participant->id }}"
                                                            style="display: none" type="submit"
                                                            href="{{ route('participant.disqualify',$participant->id) }}"
                                                            class="resetBtn btn btn-sm btn-warning m-t-n-xs">
                                                        <i class="fa fa-lock"></i> &nbsp; <i class="fa fa-unlock"></i>
                                                    </button>
                                                </form>

                                                {{--                                                @endcan--}}

                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                                {{ $participants->appends(request()->query())->links() }}
                            </div>
                            {{--                            @endif--}}
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
    @include('admin.asset.css.sweetalert')

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    @include('admin.asset.js.sweetalert')

    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let participant_Id = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "Participant's status will be changed",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + participant_Id).trigger('click');
                swal.close();

            })
        });
    </script>
    <script>
        // if (typeof participants == 'undefined')
        $(document).ready(function (e) {
            let a = "Showing @if(isset($participants)) {{ $participants->firstItem() }} to {{ $participants->lastItem() }} of {{ $participants->total() }} @endif entries";
            $('.dataTables_info').text(a);
        });
    </script>

@endsection


