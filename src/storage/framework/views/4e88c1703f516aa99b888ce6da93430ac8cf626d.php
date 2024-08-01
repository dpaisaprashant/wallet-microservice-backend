<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content">
        <h2 style="margin-top: -5px; margin-left: 5px;">KYC Dashboard</h2>
        
        <div class="row">
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-success float-right">Total</span>
                        <h5>Total KYC</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo e($stats['kycFilledCount']); ?></h1>
                        <small>Total accepted + rejected + unverified KYCs </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px">
                        <span class="label label-info float-right">Total</span>
                        <h5>KYC Not Filled Users</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo e($stats['kycNotFilledCount']); ?></h1>
                        <small>Total KYC Not Filled Users</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px">
                        <span class="label label-primary float-right">Total</span>
                        <h5>Verified KYC</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo e($stats['acceptedKycCount']); ?></h1>
                        <small>Accepted KYC Count</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px">
                        <span class="label label-info float-right">Total</span>
                        <h5>Pending KYC</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo e($stats['unverifiedKycCount']); ?></h1>
                        <small>Total KYC not verified </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px";>
                        <span class="label label-danger float-right">Total</span>
                        <h5>Accepted KYC</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo e($stats['acceptedKycCount']); ?></h1>
                        <small>Accepted KYC Count</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-primary float-right">Total</span>
                        <h5>Rejected KYC</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo e($stats['rejectedKycCount']); ?></h1>
                        <small>Rejected KYC Count</small>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5 id="graphTitleKyc">User KYC Status</h5>
                    </div>
                    <div class="ibox-content" id="graph-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="flot-chart" id="monthly" style="height: 30vh;">
                                    <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-9">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5 id="graphTitleKyc">New Users Registration per Month (<?php echo e(date('Y')); ?>)</h5>
                    </div>
                    <div class="ibox-content" id="graph-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="flot-chart"  style="height: 30vh;">
                                    <div style="padding: 10px;" class="flot-chart-content" id="flot-dashboard-chart-new-users"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Latest filled KYCs</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="NPay transactions list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Contact No.</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Filled Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $kycs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kyc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeC">
                                        <td><?php echo e($loop->index + 1); ?></td>
                                        <td><?php echo e($kyc->user->name); ?></td>
                                        <td>
                                            <?php echo e($kyc->user->mobile_no); ?>

                                        </td>
                                        <td>
                                            <?php echo e($kyc->user->email); ?>

                                        </td>
                                        <td>
                                            <?php echo $__env->make('admin.user.kyc.status', ['kyc' => $kyc], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </td>
                                        <td>
                                            <?php echo e($kyc->created_at); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <style>
        #graph-content {
            padding: 0px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        let kycData = <?php echo $pieChart; ?>;
        let keys = Object.keys(kycData);
        let values = Object.values(kycData);

        var options = {
            series: values,
            chart: {
                width: 450,
                type: 'pie',
            },
            labels: keys,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#flot-dashboard-chart"), options);
        chart.render();
    </script>

    <script>
        let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        let data = <?php echo $newUsersPerMonth; ?>;

        let userCount = {};

        $.each(months, function (index, value) {
            data[value] !== undefined
                ? userCount[value] = data[value].count
                : userCount[value] = 0;
        });

        let userCountData = Object.values(userCount);

        var options = {
            series: [{
                name: 'Number of users',
                data: userCountData
            }],
            chart: {
                height: 250,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val;
                },
                offsetY: -10,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: months,
                position: 'bottom',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: false,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function (val) {
                        return val;
                    }
                },
                title: {
                    text: 'Number of Users',
                },

            },
        };

         chart = new ApexCharts(document.querySelector("#flot-dashboard-chart-new-users"), options);
        chart.render();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard.stats.dashboardDesign', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/dashboard/stats/kyc.blade.php ENDPATH**/ ?>