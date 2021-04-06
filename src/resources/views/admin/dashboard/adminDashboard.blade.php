<h2 style="margin-top: -5px; margin-left: 5px;">Admin Dashboard</h2>
<div class="row">
    @can('Dashboard all transactions sum')
        @include('admin.dashboard.widgets.allTransactionSum')
    @endcan

    @can('Dashboard successful transactions count')
        @include('admin.dashboard.widgets.successfulTransactionCount')
    @endcan

    @can('Dashboard total KYC not filled users')
        @include('admin.dashboard.widgets.totalKYCNotFilledUsers')
    @endcan

    @can('Dashboard total KYC filled users')
        @include('admin.dashboard.widgets.totalKYCFilledUsers')
    @endcan

    @can('Dashboard total KYC accepted by backend user count')
        @include('admin.dashboard.widgets.acceptedKYCByBackendUserCount')
    @endcan

    @can('Dashboard total KYC rejected by backend user count')
        @include('admin.dashboard.widgets.rejectedKYCByBackendUserCount')
    @endcan

    @can('Dashboard total NPay clearance cleared by backend user count')
        @include('admin.dashboard.widgets.npayClearanceClearedByBackendUserCount')
    @endcan

    @can('Dashboard total Paypoint clearance cleared by backend user count')
        @include('admin.dashboard.widgets.paypointClearanceClearedByBackendUserCount')
    @endcan
</div>

@can('Dashboard users transactions graph')
    {{--Paypoint Graph--}}
    @include('admin.dashboard.widgets.graph.paypoint')

    {{--Npay Graph--}}
    @include('admin.dashboard.widgets.graph.npay')


    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5 id="timeElapsedTitle">Execute Payment time elapsed</h5>
                </div>
                <div class="ibox-content" style="height: 400px;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="flot-chart" id="timeElapsed">
                                <div class="flot-chart-content" id="chart-time-elapsed"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endcan


@include('admin.dashboard.clearanceDashboard')

@include('admin.dashboard.kycVerifierDashboard')

{{--@can('Dashboard highest transactions table')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Highest Transactions</h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>

                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny">
                        <thead>
                        <tr>
                            <th data-toggle="true">Amount</th>
                            <th>User</th>
                            <th>Vendor</th>
                            <th>Service Type</th>
                            <th data-hide="all">Email</th>
                            <th data-hide="all">Number</th>
                            <th data-hide="all">Date</th>
                            <th data-hide="all">Time</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($highestTransactions as $transaction)
                            <tr>
                                <td>Rs. {{ $transaction->amount }}</td>
                                <td>{{ $transaction->user->name ?? "Unknown" }}</td>
                                <td>{{ $transaction->vendor }}</td>
                                <td>{{ $transaction->service_type }}</td>
                                <td>{{ $transaction->user->email ?? "u@known.com" }}</td>
                                <td>{{ $transaction->user->mobile_no ?? "98" }}</td>
                                <td>{{ date('d M, Y', strtotime($transaction->created_at))  }}</td>
                                <td>{{ date('H:i:s', strtotime($transaction->created_at))  }}</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endcan--}}
