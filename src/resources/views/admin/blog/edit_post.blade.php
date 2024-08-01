@extends('admin.layouts.admin_design')
@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <style>
        .ck-editor__editable {
            min-height: 100px;
        }
    </style>
    <body>
        <div class="ibox-content">
            <h2>Form</h2>
            <form action="{{ route('update-post', $posts->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                        value="{{ $posts->title }}">
                </div>
                 <div class="form-group">
                    <label for="title">Short-Title</label>
                    <input type="text" class="form-control" id="slug" placeholder="Short-Title" name="slug" value="{{ $posts->slug }}">
                    @error('slug')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" placeholder="Description" name="description">{!! old('description', $posts->description) !!}</textarea>
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" placeholder="Name" name="author"  
                        value="{{ $posts->author }} ">
                </div>

                <div class="form-group">
                    <label for="image">Feature Image</label>
                    <input type="file" class="form-control" id="image" placeholder="Image" name="image">
                    <img src="{{ asset('storage/' . $posts->image) }}" alt="User Image">
                </div>

                <div class="form-group">
                    <label for="tag">Tag</label>
                    <select name="tag[]" id="tag" class="form-control" multiple>

                        <option value="">Select Tag</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ $tag->id == $posts->tag ? 'selected' : '' }}>
                                {{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type">
                        <option value="">Select Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ $type->id == $posts->type ? 'selected' : '' }}>
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status">
                        <option value="draft" {{ $posts->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $posts->status == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                <div>
                <button class="btn btn-primary">Send</button>
                </div>

        </form>
        </div>
        <script>
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
                });
        </script>
<br>
    @endsection
<script>
    $(document).ready(function() {
        $('#tag').select2();
    });
</script>