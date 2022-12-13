@extends('back.layout')

@section('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        input, th span {
            cursor: pointer;
        }

.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
    /* color: #1a1919; */
    background: #f4f4f4;
    padding: 10px 15px 5px;
    margin-bottom: 15px;
}
.dataTables_wrapper .dataTables_filter input {
    margin-left: 0.5em;
    border: 1px solid #e7e7e7;
}
label{ font-weight: 400; }
table.dataTable thead th, table.dataTable thead td{    padding: 8px 20px; border: 0px; font-weight: 600;}
.fa.pull-right{ display: none; }
table.dataTable tbody th, table.dataTable tbody td {
    padding: 8px 20px; vertical-align: middle;}

table td:nth-last-child(-n+1)
{ float: left; width: 70% !important;  word-wrap: break-word; }
table td:nth-last-child(2) {
       padding: 10px 0px 10px 10px !important;
}

    </style>



@endsection



@section('main')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                <table class="table table-hover table-bordered table-striped datatable" >
                        <thead>
                        <tr>
                        <th>@lang('Sl.No')<span id="Sl.No" class="fa fa-sort pull-right"
                                                              aria-hidden="true"></span></th>
                            <th>@lang('Title')<span id="title" class="fa fa-sort pull-right"
                                                              aria-hidden="true"></span></th>
                            <th>@lang('Operation')</th>
                            <th>@lang('User')<span id="active" class="fa fa-sort pull-right"
                                                              aria-hidden="true"></span></th>
                            <th>@lang('Creation')<span id="created_at" class="fa fa-sort-desc pull-right"
                                                              aria-hidden="true"></span></th>
                            <th>@lang('Description')<span id="created_at" class="fa fa-sort-desc pull-right"
                                                              aria-hidden="true"></span></th>
                        </tr>
                        </thead>
                    </table>
                </div>

            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        order:[[0,'desc']],
        ajax: '{{ route('settings.ajaxlogs') }}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'subject_id', name: 'subject_id'},
            {data: 'description', name: 'description'},
            {data: 'causer_id', name: 'causer_id'},
            {data: 'created_at', name: 'created_at'},
            {data: 'properties', name: 'properties'},
        ],

    });
});
</script>
@endsection
