@extends('back.layout')

@section('css')
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<style>
    input, th span {
        cursor: pointer;
    }
</style>
@endsection

@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
             
             
                {!! Form::open(array('route' => 'prospects.graduation-download','class'=>'form-horizontal loadingForm','method'=>'post','id'=>'exportData','name'=>'exportData')) !!}

                <div class="col-md-3">
                    <label for="menus"> From Date</label>
                    
                    <div class="input-group input-append date" id="datePicker1">
                        

                       {!! Form::text('from_date', Request::get('from_date',null), array('id' => 'from_date','class'=>'form-control','placeholder'=>'dd/mm/yyyy')) !!}

                       <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                   </div>
                   
               </div>

               <div class="col-md-3">
                <label for="menus"> To Date</label>
                
                <div class="input-group input-append date" id="datePicker2">

                    {!! Form::text('to_date', Request::get('to_date',null), array('id' => 'to_date','class'=>'form-control','placeholder'=>'dd/mm/yyyy')) !!}
                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                
            </div>
            <br/>
            <div class="col-md-3">
               <button class="btn btn-success mt-5" type="submit" id="exportData" style="margin-top: 5px"><i class="fa fa-file-excel-o"></i> Download</button>
           </div>

       </form>
       
       <input type="text" class="pull-right" id="searchContent">

       <div id="spinner" class="text-center"></div>
   </div>
   <div class="box-body table-responsive">
    <table id="users" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="display:none;">#</th>
                <th>@lang('Name')</th>
                <th>@lang('Email')</th>
                <th>@lang('Mobile')</th>
                           {{--  <th>@lang('Job Title')</th>
                           <th style="text-align: center">@lang('Resume')</th> --}}
                           <th style="text-align: center">@lang('Delete')</th>
                           <th style="text-align: center">@lang('View')</th>
                       </tr>
                   </thead>
                   
                   <tbody id="pannel">

                    @include('back.downloads.graduation-table', compact('registered_forms'))
                </tbody>
            </table>
            <div class="pull-right">
                {!! $registered_forms->render() !!}
            </div>
        </div>

        

    </div>
    <!-- /.box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->

@endsection

@section('js')
<script src="{{ asset('adminlte/js/back.js') }}"></script>
<script>

    var post = (function () {
        var url = '{{ route('prospects.graduation-index') }}'
        var swalTitle = '@lang('Really destroy the file ?')'
        var confirmButtonText = '@lang('Yes')'
        var cancelButtonText = '@lang('No')'
        var errorAjax = '@lang('Looks like there is a server issue...')'

        var onReady = function () {
            $('#pagination').on('click', 'ul.pagination a', function (event) {
                back.pagination(event, $(this), errorAjax)
            })
            $('#pannel').on('change', ':checkbox[name="status"]', function () {
                back.status(url, $(this), errorAjax)
            })
            .on('click', 'td a.btn-danger', function (event) {
                event.preventDefault()
                var target = $(this).attr('href');
                var closest_tr = $(this).closest('tr');
                swal({
                    title: swalTitle,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: cancelButtonText
                }).then(function () {
                    back.spin()
                    $.ajax({
                        url: target,
                        type: 'DELETE'
                    })
                    .done(function () {
                        back.unSpin()
                        closest_tr.remove();
                    })
                    .fail(function () {
                        back.fail('@lang('Looks like there is a server issue...')')
                    }
                    )
                })
            })
            $('th span').click(function () {
                back.ordering(url, $(this), errorAjax)
            })
            $('.box-header :radio, .box-header :checkbox').click(function () {
                back.filters(url, errorAjax)
            })
            $(document).on('keyup', '#searchContent', function (event) {
                back.search(url, $(this), errorAjax)
            })
        }

        return {
            onReady: onReady
        }

    })()

    $(document).ready(post.onReady)

</script>
<script>



   $(document).ready(function() {
    var date = new Date();
    $('#datePicker1')
    .datepicker({
        format: 'dd/mm/yyyy',
        endDate:  new Date(),
    })
});

   $(document).ready(function() {
    var date = new Date();
    $('#datePicker2')
    .datepicker({
        format: 'dd/mm/yyyy',
        endDate:  new Date(),
    })
});
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
@endsection
