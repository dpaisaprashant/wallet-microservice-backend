@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Blocked IPs</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Blocked IPs</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
       
        @include('admin.asset.notification.notify')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of Blocked IPs</h5>
                        {{-- @can('Add BlockedIP') --}}
                            <a href="{{ route('blockedip.create') }}" class="btn btn-sm btn-primary btn-xs"
                               style="float: right;margin-top: -5px;">Block an IP</a>
                        {{-- @endcan --}}
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>IP</th>
                                    <th>Description</th>
                                    <th>Blocked At</th>
                                    <th>Blocked Until</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($blockedIPs as $key=>$blockedIP)
                                    <tr>
                                        <td> {{ $key+1 }}</td>
                                        <td> {{ $blockedIP->ip }}</td>
                                        <td> {{ $blockedIP->description }}</td>
                                        <td> {{ $blockedIP->blocked_at }}</td>
                                        <td> {{ $blockedIP->block_duration }}</td>
                                        <td> {{ $blockedIP->status }}</td>                                        
                                        <td class="center">
                                            {{-- @can('Delete BlockedIP') --}}                                           
                                            <form action="{{ route('blockedip.delete',$blockedIP->id) }}" method="POST">
                                                @csrf
                                                <button                                                    
                                                    class="reset btn btn-sm btn-danger m-t-n-xs"
                                                    rel="{{ $blockedIP->id }}"><i
                                                        class="fa fa-trash"></i>
                                                </button>              

                                                <button id="resetBtn-{{ $blockedIP->id }}"
                                                    style="display: none" type="submit"
                                                    href="{{ route('blockedip.delete',$blockedIP->id) }}"
                                                    class="resetBtn btn btn-sm btn-danger m-t-n-xs">
                                                <i class="fa fa-trash"></i></button>     
                                                   
                                                {{-- @can('Edit BlockedIP') --}}                                            
                                                <a href="{{ route('blockedip.edit',$blockedIP->id)}}" class="btn btn-success btn-sm m-t-n-xs"><i class="fa fa-edit"></i></a>                                            
                                                {{-- @endcan --}}                                                              
                                            </form>                    
                                                              
                                            {{-- @endcan --}}
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{-- {{ $blockedIPs->appends(request()->query())->links() }} --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @include('admin.asset.css.datatable')
    @include('admin.asset.css.chosen')

@endsection

@section('scripts')
    @include('admin.asset.js.chosen')

    @include('admin.asset.css.sweetalert')
    <!-- Page-Level Scripts -->
    @include('admin.asset.js.datatable')
    @include('admin.asset.js.sweetalert')
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let blockedIP_Id = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "Blocked IP will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + blockedIP_Id).trigger('click');
                swal.close();

            })
        });
    </script>

@endsection


