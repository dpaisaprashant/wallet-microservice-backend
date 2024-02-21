@extends('admin.layouts.admin_design')
@section('content')

    <body>
        <div class="ibox-content">

            <h2>Add Job</h2>
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="description">No. of Opening</label>
                    <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ old('title') }}">

                    {{-- <textarea class="form-control" id="description" placeholder="Description" rows="5" name="description">
                        {{ old('description') }}
                    </textarea> --}}
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="author">Domain</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">Select Type</option>
                    </select>                    @error('author')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Location</label>
                    <input type="file" class="form-control" id="image" placeholder="Image" name="image" >

                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tag">Salary</label>
                    <select name="tag" id="tag" class="form-control">

                    </select>
                    @error('tag')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="type">Job description</label>
                   
                    @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> 
                    <button class="btn btn-primary">Send</button>
                </div>

        </form>
       
    <br>
    @endsection


</body>

@if (session('status'))
    <script>
        alert('{{ session('status') }}');
    </script>
@endif

@if (session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif

@if (session('error'))
    <script>
        alert('{{ session('error') }}');
    </script>
@endif
