@extends('admin.layouts.admin_design')
@section('content')

    <body>

        <div class="ibox-content">

            <h2>Add Khalti Services</h2>
            <form action="{{route('store-service')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="label">Label</label>
                    <input type="text" class="form-control" id="label" placeholder="Label" name="label" value="{{ old('label') }}">
                    @error('label')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

           <div class="form-group">
            <label for="service">Wallet Service</label>
            <input type="text" class="form-control" id="service" placeholder="Enter services" name="service" value="{{ old('service') }}">
            @error('service')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

                
            <div class="form-group">
                    <label for="step">twoSteps</label>
                    <select name="step" id="step" class="form-control">
                        <option value="">Select step</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                    @error('step')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
            </div>
                <div class="form-group">
                    <label for="forms">Forms</label>
                    <button type="button" id="addForm">Add Form</button>
                    <div id="formsContainer"></div>
                    @error('forms')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

<script>
    document.getElementById('addForm').addEventListener('click', function() {
        var formsContainer = document.getElementById('formsContainer');

        var formDiv = document.createElement('div');

        var formlabelInput = document.createElement('input');
        formlabelInput.setAttribute('name', 'forms[][formlabel]');
        formlabelInput.setAttribute('placeholder', 'Form Label');
        formDiv.appendChild(formlabelInput);

        var placeholderInput = document.createElement('input');
        placeholderInput.setAttribute('name', 'forms[][placeholder]');
        placeholderInput.setAttribute('placeholder', 'Placeholder');
        formDiv.appendChild(placeholderInput);

        var bebodyInput = document.createElement('input');
        bebodyInput.setAttribute('name', 'forms[][beBody]');
        bebodyInput.setAttribute('placeholder', 'beBody');
        formDiv.appendChild(bebodyInput);

        var inputDataTypeInput = document.createElement('input');
        inputDataTypeInput.setAttribute('name', 'forms[][inputDataType]');
        inputDataTypeInput.setAttribute('placeholder', 'Input Data Type');
        formDiv.appendChild(inputDataTypeInput);

        formsContainer.appendChild(formDiv);
    });
</script>

                <div>
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
