<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="Ccrd0O601muvXeyoy1iqpGewMg5Gfh6OcFEXEIWl" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Laravel Datatables basic demo">

    <title>Laravel Datatables</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.bootstrap.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300|Open+Sans:400,600,700,800' rel='stylesheet'
        type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css' rel='stylesheet'
        type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="col-md-12">
        <h1 class="" style="">Basic Demo</h1>
        <table id="something-table" class="table table-condensed">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Level1</th>
                    <th>Level2</th>
                    <th>Level3</th>
                    <th>Level4</th>
                    <th>Kecamatan</th>
                    <th>Satuan</th>
                    <th>Value</th>
                    <th>Produsen</th>
                </tr>
            </thead>
        </table>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables.bootstrap.js') }}"></script>
    {{-- <script src="https://datatables.yajrabox.com/js/handlebars.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.0.0/jquery.mark.min.js"></script>
    <script>
        $(function() {
            var $input = $("input[name='keyword']"),
                $context = $(".keyword");
            $input.on("input", function() {
                var term = $(this).val();
                $context.show().unmark();
                if (term) {
                    $context.mark(term, {
                        done: function() {
                            $context.not(":has(mark)").hide();
                        }
                    });
                }
            });
            $('#search-filter').focus();
        });

    </script>
    <script type="text/javascript">
        $(function() {
            $('#something-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('table.data') }}',
                columns: [
                    {data: 'id'},
                    {data: 'level1'},
                    {data: 'level2'},
                    {data: 'level3'},
                    {data: 'level4'},
                    {data: 'kecamatan'},
                    {data: 'satuan'},
                    {data: 'value'},
                    {data: 'produsen'}
                ]
            });
        });

    </script>
</body>

</html>
