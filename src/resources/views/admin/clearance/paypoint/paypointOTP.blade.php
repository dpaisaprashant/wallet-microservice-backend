
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DPaisa Clearance | OTP </title>

    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="loginColumns animated fadeInDown">
    <div class="row">

        <div class="col-md-12">
            @include('admin.asset.notification.notify')
        </div>

        <div class="col-md-6">
            <h2 class="font-bold">Clearance for <b>{{ $_GET['date'] }}</b></h2>

            <p>Enter otp code to view PayPoint clearance transactions </p>

        </div>
        <div class="col-md-6">

            <div class="ibox-content">
                <form class="m-t" role="form" action="{{ route('paypoint.clearance.otp') }}" method="post" autocomplete="off">
                    @csrf
                    <input type="hidden" name="date" value="{{ $date }}">
                    <div class="form-group">
                        <input type="text" name="otp" class="form-control" placeholder="OTP Code" required="">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Enter OTP</button>


                </form>
                <p class="m-t">
                    <small>Dpaisa admin panel all rights reserved &copy; {{ Date('Y') }}</small>
                </p>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            Copyright Goldmine Pvt. Ltd.
        </div>
        <div class="col-md-6 text-right">
            <small>© {{ Date('Y') }}</small>
        </div>
    </div>
</div>


</body>
<script src="{{ asset('admin/js/jquery-3.1.1.min.js') }} " ></script>
<script>
    $('.close').on('click', function (e) {
        $('.alert-danger').hide();
    });
</script>
</html>
