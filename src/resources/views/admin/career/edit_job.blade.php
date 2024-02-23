@extends('admin.layouts.admin_design')
@section('content')

    <body>
        <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js" ></script>
        <style>
            .ck-editor__editable {
                    min-height: 100px;
                }
        </style>
        <div class="ibox-content">

            <h2>Add Job</h2>
                <form action="{{route('update-job', $jobs->id)}}" method="post" >
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{$jobs->title}}  ">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="opening">No. of Opening</label>
                    <input type="text" class="form-control" id="opening" placeholder="Openings" name="opening" value="{{ $jobs->opening }}">
                    @error('opening')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="domain">Domain</label>
                    <select name="domain" id="domain" class="form-control">
                        <option value="">Select Domain</option>
                        <option value="Information Technology" {{ $jobs->domain == "Information Technology" ? 'selected' : '' }}>Information Technology</option>
                    </select>                    
                    @error('domain')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Location</label>
                    <select name="location" id="location" class="form-control">
                        <option value="">Select Location</option>
                        <option value="New Baneshwor" {{ $jobs->location == "New Baneshwor" ? 'selected' : ''  }} >New Baneshwor</option>
                    </select>
                    @error('location')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="text" class="form-control" id="salary" placeholder="Salary" name="salary" value="{{ $jobs->salary }}">

                    @error('salary')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Job description</label>
                   <textarea class="form-control" id="description" placeholder="Job Description" rows="3" name="description">{!! $jobs->description !!}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> 

                <div class="form-group">
                    <label for="specification">Job Specification</label>
                   <textarea class="form-control" id="specification" placeholder="Job Specification" rows="3" name="specification">{!! $jobs->specification !!}</textarea>
                    @error('specification')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> 
                <div>
                    <button class="btn btn-primary">Send</button>
                </div>

        </form>
       <script>
        const names=['description', 'specification']
        names.forEach(name=> {
            ClassicEditor
                .create(document.querySelector(`[name="${name}"]`))
                .catch(error => {
                    console.error(error);
                });
                });
        </script>
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
