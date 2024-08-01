@extends('admin.layouts.admin_design')
@section('content')

<body>
    <form action="" method='post'>
        <h1>Domain</h1>
        <div >
        <input id="domain" nmame="domain" class="form-control" placeholder="Enter Domain name" ></input>
        <button class= "btn btn-primary" >Submit</button>
        </div>
    </form>
</body>

@endsection