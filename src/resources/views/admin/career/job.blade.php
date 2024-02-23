@extends('admin.layouts.admin_design')
@section('content')
       
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all career opportunities</h5>

                            <div class="ibox-tools" style="top: 8px;">
                                <a class="btn btn-primary" href="{{ route('career.add_job')}} "> <i class="fa fa-plus-circle"></i> Add New Job</a>
                            </div>

                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover dataTables-example" title="General settings list">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>No. of opening</th>
                                            <th>Domain</th>
                                            <th>Location</th>
                                            <th>Salary</th>
                                            <th>Job Description</th>
                                            <th>Job Specification</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($jobs as $job)
                                            <tr>
                                                <td>{{ $job->title }}</td>
                                                <td>{{ $job->opening }}</td>
                                                <td>{{ $job->domain }}</td>
                                                <td>{{ $job->location }} </td>
                                                <td>{{ $job->salary }}</td>
                                                <td>{!! $job->description !!}</td>
                                                <td>{!! $job->specification !!}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{route('edit-job', $job->id)}}"><button
                                                                type="button" class="btn btn-primary">Edit</button></a>
                                                        <a href="{{ route('delete-job', $job->id) }}"><button
                                                                    type="button" class="btn btn-danger">Delete</button></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
@endsection
@if(session('status'))
    <script>
        alert('{{ session('status') }}');
    </script>
@endif

@if(session('success'))
  <script>
      alert('{{ session('success') }}');
  </script> 
@endif   

@if(session('error'))
  <script>
      alert('{{ session('error') }}');
  </script> 
@endif
