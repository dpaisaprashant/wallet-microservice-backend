@extends('admin.layouts.admin_design')
@section('content')

<body>
    <form action="{{ route('update-tag', $tag->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="d-flex">
          <div class="form-group mb-0 mr-2">
              <label for="name">Enter Blog Tag:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter type" value="{{ $tag->name }}">
          </div>
          <button class="btn btn-primary align-self-end">Submit</button>
      </div>
</form>
@endsection