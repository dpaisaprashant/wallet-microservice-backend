@extends('admin.layouts.admin_design')
@section('content')

<html>
<body>
    <form action="{{ route('store-type') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="d-flex">
        <div class="form-group mb-0 mr-2">
            <label for="name">Enter Blog Type:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter type">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
             @enderror
        </div>
          <button class="btn btn-primary align-self-end">Submit</button>
      </div>
    </form>

<br>
<h2>Type-list</h2>
  <div class="ibox-content">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example" title="General settings list">
            <thead>
              
              <tr>
                <th>Type</th>
                <th>Action</th>
              </tr>
            </thead>
    <tbody>
      
       @foreach($types as $type)
      <tr>
        <td type="text">{{$type->name}}</td>
        <td><div class="btn-group" role="group" aria-label="Basic example">
          <a href="{{route('edit-type' ,$type->id)}}"><button type="button" class="btn btn-primary" >Edit</button></a> 
          <a href="{{route('delete-type' ,$type->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
      </div> </td>
        
      </tr>
     @endforeach  
    </tbody>
  </table>
</div> 
</div>
</body>
</html>
@endsection