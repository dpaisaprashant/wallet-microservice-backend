@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>{{$user->name}} user's permissions</strong>
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
                        <h5>{{ $user->name }} user's permissions</h5>
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
                        <form method="post" action="{{ route('backendUser.permission', $user->id) }}">
                            @csrf

                            <div class="form-group row"><label class="col-sm-2 col-form-label">Available permissions<br/></label>

                                <div class="col-sm-10">
                                    @foreach($allPermissions as $allPermission)
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" value="{{ $allPermission->name }}" name="permissions[]"

                                                       @foreach($permissions as $userPermission)
                                                           @if($userPermission->id == $allPermission->id )
                                                                checked
                                                           @endif
                                                       @endforeach
                                                >
                                                <i></i> {{ $allPermission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Update Permission</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('styles')
    @include('admin.asset.css.icheck')
@endsection

@section('scripts')
   @include('admin.asset.js.icheck')
@endsection


