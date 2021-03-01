@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ ucwords(strtolower($agentType->name)) }} Cashback Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>{{ ucwords(strtolower($agentType->name)) }} CashBack Settings</strong>
                </li>

            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('agent.type.cashback', $agentType->id) }}">

                    {{--NTC--}}
                    <div class="ibox ">
                    <div class="ibox-title">
                        <h5>NTC Settings (Currency in paisa)</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC Top up type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_ntc_topup_type">
                                        @if(!empty($settings[$agent . 'cb_ntc_topup_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_ntc_topup_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_ntc_topup_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC Top up value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_ntc_topup_value'] ?? ''}}" name="{{$agent}}cb_ntc_topup_value" type="text" class="form-control">
                                </div>
                            </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">NTC PostPaid type</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="{{$agent}}cb_ntc_postpaid_type">
                                    @if(!empty($settings[$agent . 'cb_ntc_postpaid_type']))
                                        <option value="FLAT" @if($settings[$agent . 'cb_ntc_postpaid_type'] == 'FLAT') selected @endif>Flat</option>
                                        <option value="PERCENTAGE" @if($settings[$agent . 'cb_ntc_postpaid_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                    @else
                                        <option value="FLAT">Flat</option>
                                        <option value="PERCENTAGE">Percentage</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">NTC PostPaid value</label>
                            <div class="col-sm-10">
                                <input value="{{ $settings[$agent . 'cb_ntc_postpaid_value'] ?? ''}}" name="{{$agent}}cb_ntc_postpaid_value" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC ePin type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_ntc_epin_type">
                                        @if(!empty($settings[$agent . 'cb_ntc_epin_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_ntc_epin_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_ntc_epin_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC ePin value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_ntc_epin_value'] ?? ''}}" name="{{$agent}}cb_ntc_epin_value" type="text" class="form-control">
                                </div>
                            </div>

                        <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                    </div>
                </div>

                    {{--LANDLINE--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>NTC Landline settings (Currency in paisa)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC Landline type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_ntc_landline_type">
                                        @if(!empty($settings[$agent . 'cb_ntc_landline_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_ntc_landline_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_ntc_landline_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC Landline value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_ntc_landline_value'] ?? ''}}" name="{{$agent}}cb_ntc_landline_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--NTC ADSL--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>NTC ADSL Settings (Currency in paisa)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC ADSL Unlimited type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_ntc_adslu_type">
                                        @if(!empty($settings[$agent . 'cb_ntc_adslu_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_ntc_adslu_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_ntc_adslu_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC ADSL Unlimited value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_ntc_adslu_value'] ?? ''}}" name="{{$agent}}cb_ntc_adslu_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC ADSL Volumn type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_ntc_adslv_type">
                                        @if(!empty($settings[$agent . 'cb_ntc_adslv_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_ntc_adslv_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_ntc_adslv_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC ADSL Volumn value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_ntc_adslv_value'] ?? ''}}" name="{{$agent}}cb_ntc_adslv_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--NTC CDMA--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>NTC CDMA Settings (Currency in paisa)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC CDMA type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_ntc_cdma_type">
                                        @if(!empty($settings[$agent . 'cb_ntc_cdma_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_ntc_cdma_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_ntc_cdma_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC CDMA value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_ntc_cdma_value'] ?? ''}}" name="{{$agent}}cb_ntc_cdma_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--NTC NTFTTH--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>NTC NTFTTH Settings (Currency in paisa)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC NTFTTH type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_ntc_ntftth_type">
                                        @if(!empty($settings[$agent . 'cb_ntc_ntftth_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_ntc_ntftth_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_ntc_ntftth_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC NTFTTH value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_ntc_ntftth_value'] ?? ''}}" name="{{$agent}}cb_ntc_ntftth_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--NTC NTWIMAX--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>NTC NTWIMAX Settings (Currency in paisa)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC NTWIMAX type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_ntc_ntwimax_type">
                                        @if(!empty($settings[$agent . 'cb_ntc_ntwimax_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_ntc_ntwimax_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_ntc_ntwimax_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NTC NTWIMAX value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_ntc_ntwimax_value'] ?? ''}}" name="{{$agent}}cb_ntc_ntwimax_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--NCELL--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>NCell Settings (Currency in paisa)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NCell Top up type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_ncell_type">
                                        @if(!empty($settings[$agent . 'cb_ncell_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_ncell_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_ncell_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NCell Top up value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_ncell_value'] ?? ''}}" name="{{$agent}}cb_ncell_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NCell Data Pack type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_ncell_data_pack_type">
                                        @if(!empty($settings[$agent . 'cb_ncell_data_pack_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_ncell_data_pack_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_ncell_data_pack_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NCell Data pack value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_ncell_data_pack_value'] ?? ''}}" name="{{$agent}}cb_ncell_data_pack_value" type="text" class="form-control">
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Smartcell--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>SmartCell Settings (Currency in paisa)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">SmartCell Top up type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_smartcell_topup_type">
                                        @if(!empty($settings[$agent . 'cb_smartcell_topup_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_smartcell_topup_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_smartcell_topup_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">SmartCell Top up value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_smartcell_topup_value'] ?? ''}}" name="{{$agent}}cb_smartcell_topup_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">SmartCell ePin type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_smartcell_epin_type">
                                        @if(!empty($settings[$agent . 'cb_smartcell_epin_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_smartcell_epin_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_smartcell_epin_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">SmartCell ePin value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_smartcell_epin_value'] ?? ''}}" name="{{$agent}}cb_smartcell_epin_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--UTL--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>UTL Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">UTL type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_utl_type">
                                        @if(!empty($settings[$agent . 'cb_utl_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_utl_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_utl_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">UTL value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_utl_value'] ?? ''}}" name="{{$agent}}cb_utl_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Dishhome--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Dishhome Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Dishhome type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_dishhome_type">
                                        @if(!empty($settings[$agent . 'cb_dishhome_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_dishhome_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_dishhome_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Dishhome value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_dishhome_value'] ?? ''}}" name="{{$agent}}cb_dishhome_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Dishhome Epin type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_dishhome_epin__type">
                                        @if(!empty($settings[$agent . 'cb_dishhome_epin__type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_dishhome_epin__type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_dishhome_epin__type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Dishhome value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_dishhome_epin__value'] ?? ''}}" name="{{$agent}}cb_dishhome_epin__value" type="text" class="form-control">
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--SimTv--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Sim Tv Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Sim Tv type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_simtv_type">
                                        @if(!empty($settings[$agent . 'cb_simtv_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_simtv_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_simtv_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">SimTv value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_simtv_value'] ?? ''}}" name="{{$agent}}cb_simtv_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--NEA--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>NEA Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NEA type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_nea_type">
                                        @if(!empty($settings[$agent . 'cb_nea_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_nea_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_nea_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NEA value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_nea_value'] ?? ''}}" name="{{$agent}}cb_nea_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--websurfer--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Web surfer Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Web surfer type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_websurfer_type">
                                        @if(!empty($settings[$agent . 'cb_websurfer_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_websurfer_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_websurfer_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Web surfer value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_websurfer_value'] ?? ''}}" name="{{$agent}}cb_websurfer_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Arrownet--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Arrownet Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Arrownet type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_arrownet_type">
                                        @if(!empty($settings[$agent . 'cb_arrownet_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_arrownet_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_arrownet_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Arrownet value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_arrownet_value'] ?? ''}}" name="{{$agent}}cb_arrownet_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Worldlink--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Worldlink Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Worldlink type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_worldlink_type">
                                        @if(!empty($settings[$agent . 'cb_worldlink_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_worldlink_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_worldlink_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Worldlink value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_worldlink_value'] ?? ''}}" name="{{$agent}}cb_worldlink_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--subisu--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Subisu Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Subisu type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_subisu_type">
                                        @if(!empty($settings[$agent . 'cb_subisu_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_subisu_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_subisu_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Subisu value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_subisu_value'] ?? ''}}" name="{{$agent}}cb_subisu_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--NetTv--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>NetTv Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NetTv type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_nettv_type">
                                        @if(!empty($settings[$agent . 'cb_nettv_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_nettv_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_nettv_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NetTv value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_nettv_value'] ?? ''}}" name="{{$agent}}cb_nettv_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Vianet--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Vianet Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Vianet type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_vianet_type">
                                        @if(!empty($settings[$agent . 'cb_vianet_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_vianet_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_vianet_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Vianet value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_vianet_value'] ?? ''}}" name="{{$agent}}cb_vianet_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Nepal Water--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Nepal Water Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Nepal Water type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_nepal_water_type">
                                        @if(!empty($settings[$agent . 'cb_nepal_water_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_nepal_water_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_nepal_water_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Nepal Water value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_nepal_water_value'] ?? ''}}" name="{{$agent}}cb_nepal_water_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Khanepani Water--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Khanepani Water Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Khanepani Water type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_khanepani_water_type">
                                        @if(!empty($settings[$agent . 'cb_khanepani_water_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_khanepani_water_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_khanepani_water_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Khanepani Water value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_khanepani_water_value'] ?? ''}}" name="{{$agent}}cb_khanepani_water_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Mero Tv--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Mero TV Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Mero TV type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_merotv_type">
                                        @if(!empty($settings[$agent . 'cb_merotv_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_merotv_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_merotv_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Mero TV value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_merotv_value'] ?? ''}}" name="{{$agent}}cb_merotv_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Sky--}}
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Sky Settings (Currency in paisa)</h5>
                        </div>
                        <div class="ibox-content">

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Sky Internet type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_sky_internet_type">
                                        @if(!empty($settings[$agent . 'cb_sky_internet_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_sky_internet_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_sky_internet_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Sky Internet value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_sky_internet_value'] ?? ''}}" name="{{$agent}}cb_sky_internet_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Sky TV type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="{{$agent}}cb_sky_tv_type">
                                        @if(!empty($settings[$agent . 'cb_sky_tv_type']))
                                            <option value="FLAT" @if($settings[$agent . 'cb_sky_tv_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings[$agent . 'cb_sky_tv_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Sky TV value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings[$agent . 'cb_sky_tv_value'] ?? ''}}" name="{{$agent}}cb_sky_tv_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Paypoint setting update')
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>



@endsection

@section('styles')
   @include('admin.asset.css.summernote')

    <style>
        select {
            height: 35.6px !important;
        }
    </style>
@endsection

@section('scripts')
    @include('admin.asset.js.summernote')

    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endsection

