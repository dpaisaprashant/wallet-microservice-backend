@extends('admin.layouts.admin_design')
@section('content')
       
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all blogs</h5>

                            <div class="ibox-tools" style="top: 8px;">
                                <a class="btn btn-primary" href="{{ route('blog.post_form') }}"> <i class="fa fa-plus-circle"></i> Add New
                                    Post</a>
                            </div>

                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover dataTables-example" title="General settings list">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Author</th>
                                            <th>Featured image</th>
                                            <th>Tag</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($posts as $value)
                                            <tr>
                                                <td>{{ $value->title }}</td>
                                                <td>{!! Str::limit($value->description, 100) !!}</td>
                                                <td>{{ $value->author }}</td>
                                                <td><img src="{{ asset('storage/' . $value->image) }}" alt="Post's Image" style="width: 600px; height: 200px;">
                                                </td>
                                                @foreach ($value->tags as $tag)
                                                    <td>{{ $tag->name }}</td>
                                                @endforeach
                                                <td>{{ $value->types->name }}</td>
                                                <td><a href="{{ route('changeStatus', $value->id) }}" class="btn btn-default">{{ $value->status }}</a></td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('edit-post', $value->id) }}"><button
                                                                type="button" class="btn btn-primary">Edit</button></a>
                                                        <a href="{{ route('delete-post', $value->id) }}"><button
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
