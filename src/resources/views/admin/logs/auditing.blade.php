@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Logs</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Logs</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Auditing Log</strong>
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
                        <h5>Filter Session Log</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="display: none">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('filter.profile.transaction') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="from_user" placeholder="From User" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="to_user" placeholder="To User" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2">
                                                    <option value="" selected disabled>Select Device...</option>
                                                    <option value="Complete">Mobile</option>
                                                    <option value="Incomplete">Laptop</option>
                                                    <option value="Pending">Tab</option>
                                                    <option value="Pending">Android</option>
                                                    <option value="Pending">IOS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="agent" placeholder="User Agent" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="input-group date">

                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>




                                    <br>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Filter</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Basic Data Tables example with responsive plugin</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Public Id</th>
                                    <th>Device</th>
                                    <th>User Agent</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile', 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                         Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile', 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                        Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile' , 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                        Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile' , 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                        Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile' , 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                        Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile' , 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                        Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>


                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile' , 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                        Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>


                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile' , 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                        Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>


                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile' , 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                        Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>


                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile' , 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                        Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>


                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile' , 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                        Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>


                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile' , 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                        Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>


                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <a href="{{route('user.profile' , 1)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Avaya Baniya</strong></a>
                                    </td>
                                    <td>172.16.0.23</td>
                                    <td class="center">Laptop</td>
                                    <td class="center">
                                        Mozilla/5.0 (Windows NT 6.1; Win64) Gecko/20100101 Firefox/47.0
                                    </td>
                                    <td>
                                        2019-09-05
                                    </td>
                                </tr>


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Public Id</th>
                                    <th>Device</th>
                                    <th>User Agent</th>
                                    <th>Created At</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection



@section('styles')
    <link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">

    <style>
        .chosen-container-single .chosen-single{
            height: 35px !important;
            border-radius: 0px;
        }

        .chosen-container-single .chosen-single span{
            margin-top: 5px;
            margin-left: 5px;
        }
    </style>


    {{--<link href="{{ asset('admin/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">

@endsection

@section('scripts')

    <!-- Chosen -->
    <script src="{{ asset('admin/js/plugins/chosen/chosen.jquery.js') }}"></script>

    <script>
        $('.chosen-select').chosen({width: "100%"});
    </script>

    <!-- Data picker -->
    {{-- <script src="{{ asset('admin/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(".date_from").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd M, yyyy',
            keyboardNavigation: false,
        });

    </script>

    <script>
        $(".date_from").change(function () {
            var start_date = $(this).val();

            $(".date_to").val('');
            $(".date_to").removeAttr('readonly');
            $(".date_to").datepicker('destroy');
            $(".date_to").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate:new Date(start_date),
                format: 'dd M, yyyy'
            });
        });

        $(".date_to").keyup(function () {
            $(this).val('');
        });
    </script>


    <script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });

        });

    </script>


@endsection
