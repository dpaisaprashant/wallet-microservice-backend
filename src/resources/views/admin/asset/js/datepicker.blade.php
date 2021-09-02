
    <script src="{{ asset('admin/js/datepicker.js') }}"></script>

    <script>
        $(".date_from").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd M, yyyy',
            keyboardNavigation: false,
        });

    </script>

    <script>
        $(".date_from").change(function () {
            var start_date = $(this).val();

            $(".date_to").val('');
            $(".date_to").removeAttr('readonly');
            $(".date_to").datepicker('destroy');
            $(".date_to").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate:new Date(start_date),
                format: 'dd M, yyyy'
            });
        });

        $(".date_to").keyup(function () {
            $(this).val('');
        });
    </script>

    <script>
        $(".select_date").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd M, yyyy',
            keyboardNavigation: false,
        });

    </script>
