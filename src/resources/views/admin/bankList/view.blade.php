@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Bank List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Bank List</strong>
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
                        <h5>Filter Bank List</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="display: none">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" placeholder="Enter Bank Name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <div>
                                                    <select name="bank_type" data-placeholder="Choose a Country..." class="chosen-select"  tabindex="2">
                                                        <option value="" selected disabled>Select Bank Type...</option>
                                                        <option value="Mobile_banking">Mobile Banking</option>
                                                        <option value="Electronic_banking">Electronic Banking</option>
                                                        <option value="Test_banking">Test Banking</option>
                                                    </select>
                                                </div>
                                            </div>


                                            {{--<div class="form-group">
                                                <input type="text" placeholder="Enter Bank Type" class="form-control">
                                            </div>--}}
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" placeholder="Enter Bank Code" class="form-control">
                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2">
                                                    <option value="" selected disabled>Sort By...</option>
                                                    <option value="Pending">Highest Transaction Number</option>
                                                    <option value="Pending">Highest Transaction Amount</option>
                                                    <option value="Pending">Lowest Transaction Amount</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{--<div class="col-md-3">
                                            <input type="text" placeholder="Enter text" class="form-control">
                                        </div>--}}
                                    </div>
                                    <div>
                                        <button class="btn btn-primary float-right m-t-n-xs" type="submit"><strong>Filter</strong></button>
                                    </div>
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
                        <h5>List of Banks</h5>
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
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Bank list">
                                <thead>
                                <tr>
                                    <th>s.No.</th>
                                    <th>Bank Logo</th>
                                    <th>Bank Name</th>
                                    <th>Bank Type</th>
                                    <th>Bank Code</th>
                                    <th>Transaction <br>Number</th>
                                    <th>Transaction <br>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>
                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>

                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>


                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>


                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>
                                        <img alt="image"  src="{{ asset('admin/img/profile_small.jpg') }}" style="">
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>123</td>
                                    <td>Rs.220000</td>
                                    <td>
                                        <a href="{{route('bank.profile')}}" class="btn btn-sm btn-primary m-t-n-xs"><i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datatable')
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datatable')
@endsection


