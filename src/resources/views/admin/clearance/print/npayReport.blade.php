<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NPay Clearance-{{ \Carbon\Carbon::now() }}</title>

    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="white-bg">
<div class="wrapper wrapper-content p-xl">
    <div class="ibox-content p-xl">

        <div class="row" style="display: block; margin-bottom: 80px;">
            <h1 style="text-align: center !important; font-weight: 300">{{ strtoupper('Npay Clearance report for ' ) }} <span style="font-weight: 800">
                   <br>
                    {{ date('d M, Y', strtotime($clearance->transaction_from_date)) . ' - ' . date('d M, Y', strtotime($clearance->transaction_to_date))}}</span></h1>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <h4>Cleared By:
                    <span class="text-navy">{{ auth()->user()->name }}</span>
                </h4>

                <p style="margin-top: 20px;">
                    <?php
                    $date = explode(' ', $clearance->created_at );
                    ?>
                    <span><strong>Clearance Date:</strong> {{ date('d M, Y', strtotime($date[0]))}}</span><br/>
                    <span><strong>Time:</strong> {{ date('h:i a', strtotime($date[1]))}}</span>
                </p>
            </div>

        </div>

        <div class="table-responsive m-t">
            <table class="table">
                <thead>
                <tr>
                    <th>Report Summary</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Transaction type: Load Fund</td>
                </tr>

                <tr>
                    <td>Total Transaction count: {{ $clearance->total_transaction_count }}</td>
                </tr>

                <tr>
                    <td>Successful Transaction count: {{ $successfulTransactions->count() }}</td>
                </tr>

                <tr>
                    <td>Unsuccessful Transaction count: {{ $unsuccessfulTransactions->count() }}</td>
                </tr>

                <tr>
                    <td>Successful transaction amount: Rs. {{ $successfulTransactions->sum('amount') }}</td>
                </tr>

                <tr>
                    <td>Unsuccessful transaction amount: Rs. {{ $unsuccessfulTransactions->sum('amount') }}</td>
                </tr>

                <tr>
                    <td>Total transaction amount: Rs. {{ $clearance->total_transaction_amount }}</td>
                </tr>

                <tr>
                    <td>Total Transaction Fee: Rs. {{ (new \App\Models\UserLoadTransaction())->getTotalTransactionFee($transactions)  }} </td>
                </tr>

                <tr>
                    <td>Total Commission Amount: Rs.  {{ (new \App\Models\UserLoadTransaction())->getTotalCommission($transactions)  }} </td>
                </tr>

                <tr>
                    <td>Total Cash Back Amount: Rs.  {{ (new \App\Models\UserLoadTransaction())->getTotalCashback($transactions)  }} </td>
                </tr>

                </tbody>
            </table>
        </div><!-- /table-responsive -->

        {{--<div class="well m-t"><strong>Comments</strong>
            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less
        </div>--}}

        <div class="row" style="margin-top: 50px">
            <div class="col-md-6">
                <span style=" padding:10px; border-top: 1px solid gray">Created By</span>
            </div>
            <div class="col-md-6">
                <span style=" padding:10px; border-top: 1px solid gray">Approved By</span>
            </div>
        </div>
    </div>

</div>

<!-- Mainly scripts -->
<script src="{{ asset('admin/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('admin/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.js') }}"></script>
<script src="{{ asset('admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('admin/js/inspinia.js') }}"></script>

<script type="text/javascript">
    window.print();
</script>

</body>

</html>
