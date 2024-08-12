@extends('admin.layouts.admin_design')
@section('content')
       
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all feedbacks from customers</h5>

                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover dataTables-example" title="General settings list">
                                    <thead>
                                        <tr>
                                            <th>Services</th>
                                            <th>Description</th>
                                            <th>Suppporting image</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($feedbacks as $feedback)
                                            <tr>
                                                <td>{{$feedback->services}}</td>
                                                <td>{{$feedback->description}}</td>
                                                <td>    @if($feedback->image)
                                                    <img src="{{ 'http://172.31.251.2:5052/storage/'.$feedback->image }}" alt="Feedback Image" style="width:100px;height:auto;">
                                                @else
                                                    No Image
                                                @endif</td>

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
