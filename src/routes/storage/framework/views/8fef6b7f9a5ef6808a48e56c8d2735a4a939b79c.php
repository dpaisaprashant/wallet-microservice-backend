<script src="<?php echo e(asset('admin/js/plugins/dataTables/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')); ?>"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){

        $('.dataTables-example').each(function () {

            let table = this;

            console.log(table.title);

            $(table).DataTable({
                paging: false,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: table.title},
                    {extend: 'pdf', title: table.title},
                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '12px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit')
                                .css('color', 'black');

                            $(win.document.body).find('h1').css('font-size', 'bold').css('color', 'black');
                            $(win.document.body).find('td:last-child').css('display', 'none');
                            $(win.document.body).find('th:last-child').css('display', 'none');
                        },
                        title: table.title
                    }
                ]
            });
        });
    });
</script>
<?php /**PATH /var/www/html/resources/views/admin/asset/js/datatable.blade.php ENDPATH**/ ?>