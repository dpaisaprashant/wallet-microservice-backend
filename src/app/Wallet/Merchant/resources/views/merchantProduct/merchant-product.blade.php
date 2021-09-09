@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Merchant Product List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Merchant Products</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        @include('admin.asset.notification.notify')
{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <div class="ibox ">--}}
{{--                    <div class="ibox-title collapse-link">--}}
{{--                        <h5>Filter Merchant Products</h5>--}}
{{--                        <div class="ibox-tools">--}}
{{--                            <a class="collapse-link">--}}
{{--                                <i class="fa fa-chevron-up"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="ibox-content"--}}
{{--                         @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none" @endif>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <form role="form" method="get">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <input type="text" name="mobile_no" placeholder="Mobile Number"--}}
{{--                                                       class="form-control"--}}
{{--                                                       value="{{ !empty($_GET['mobile_no']) ? $_GET['mobile_no'] : '' }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="input-group date">--}}
{{--                                                <span class="input-group-addon">--}}
{{--                                                    <i class="fa fa-calendar"></i>--}}
{{--                                                </span>--}}
{{--                                                <input id="date_load_from" type="text" class="form-control date_from"--}}
{{--                                                       placeholder="From" name="from" autocomplete="off"--}}
{{--                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="input-group date">--}}
{{--                                                <span class="input-group-addon">--}}
{{--                                                    <i class="fa fa-calendar"></i>--}}
{{--                                                </span>--}}
{{--                                                <input id="date_load_to" type="text" class="form-control date_to"--}}
{{--                                                       placeholder="To" name="to" autocomplete="off"--}}
{{--                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <select data-placeholder="Sort By..." class="chosen-select" tabindex="2"--}}
{{--                                                        name="sort">--}}
{{--                                                    <option value="" selected disabled>Sort By...</option>--}}
{{--                                                    @if(!empty($_GET['sort']))--}}
{{--                                                        <option value="date"--}}
{{--                                                                @if($_GET['sort'] == 'date') selected @endif>Latest Date--}}
{{--                                                        </option>--}}
{{--                                                        <option value="amount"--}}
{{--                                                                @if($_GET['sort'] == 'rate') selected @endif>Highest--}}
{{--                                                            Rate--}}
{{--                                                        </option>--}}
{{--                                                    @else--}}
{{--                                                        <option value="date">Latest Date</option>--}}
{{--                                                        <option value="rate">Highest Rate</option>--}}
{{--                                                    @endif--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"--}}
{{--                                                formaction="{{ route('sparrow.view') }}"><strong>Filter</strong>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"--}}
{{--                                                type="submit" style="margin-right: 10px;"--}}
{{--                                                formaction="{{ route('sparrowSMS.excel') }}"><strong>Excel</strong>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                    @include('admin.asset.components.clearFilterButton')--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of Merchant Products</h5>
                    </div>
                    <div class="ibox-content">
                        <a href="{{ route('merchant.product.add')}}" class="btn btn-success btn-sm m-t-n-xs" style="margin-left: 15px;margin-top:5px"><i class="fa fa-plus"> &nbsp; <h6>Add Products</h6></i></a>
                        <div class="table-responsive" id="comparedTransactionId">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Merchant Products">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Type</th>
                                    <th>Json Data</th>
                                    <th>Merchant Name</th>
                                    <th>Merchant Phone Number</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($merchantProducts as $merchantProduct)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($merchantProducts->perPage() * ($merchantProducts->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                            {{ $merchantProduct->type }}
                                        </td>
                                        <td>
{{--                                            {{ $merchantProduct->json_data }}--}}
                                            @include('Merchant::merchantProduct/json-merchant-product', ['MerchantProduct' => $merchantProduct])
                                        </td>
                                        <td>
                                            @if(!empty($merchantProduct->merchantProductUsers->user->name))
                                                {{ $merchantProduct->merchantProductUsers->user->name }}
                                            @else
                                                No Merchant Name Found.
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($merchantProduct->merchantProductUsers->user->mobile_no))
                                                {{ $merchantProduct->merchantProductUsers->user->mobile_no }}
                                            @else
                                                No phone found.
                                            @endif
                                        </td>
                                        <td>
                                            {{ $merchantProduct->created_at }}
                                        </td>
                                        <td class="center">
{{--                                            @can('Delete merchant product')--}}
                                                <form action="{{ route('merchant.product.delete',$merchantProduct->id) }}" method="POST">
                                                    @csrf
                                                    <button class="reset btn btn-sm btn-danger m-t-n-xs" rel="{{ $merchantProduct->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                        <a href="{{ route('merchant.product.edit',$merchantProduct->id)}}" class="btn btn-success btn-sm m-t-n-xs"><i class="fa fa-edit"></i></a>
                                                </form>

{{--                                            @endcan--}}

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $merchantProducts->appends(request()->query())->links() }}
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
@endsection

@section('scripts')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datatable')
@endsection




