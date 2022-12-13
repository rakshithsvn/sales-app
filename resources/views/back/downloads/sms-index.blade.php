@extends('back.layout')

@section('css')
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
{{-- <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" rel="stylesheet"> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

<style>
  input, th span {
    cursor: pointer;
  }
  textarea { resize: vertical; }
  .select2-container .select2-selection--single {height: 34px !important}
  span.select2-dropdown.select2-dropdown--below {width: 220px !important}
  .select2-container .select2-selection--single .select2-selection__rendered {padding-left: 0px !important; padding-right: 5px !important}
  .btn{margin-bottom: 10px}

  /*page preloader*/
  .preloader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #ffffff;
    z-index: 13000;
    height: 100%;
  }

  .preloader_image {
    width: 100px;
    height: 100px;
    position: absolute;
    left: 50%;
    top: 50%;
    background: url(../img/preloader.gif) no-repeat 50% 50% transparent;
    margin: -50px 0 0 -50px;
  }
</style>
@endsection

@section('main')

{{-- <div class="preloader">
  <div class="preloader_image"></div>
</div> --}}

<div class="row">
  <div class="col-md-12">

    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      <center style="color:white !important;">{!! Session::get('success') !!}</center>
    </div>
    @endif

    @if(Session::has('danger'))
    <div class="alert alert-danger alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      <center style="color:white !important;">{!! Session::get('danger') !!}</center>
    </div>
    @endif

    <div class="box">
      <div class="box-header with-border">

        {!! Form::open(array('route' => 'prospects.post-sms-index','class'=>'form-horizontal loadingForm','method'=>'post','id'=>'filterData','name'=>'filterData')) !!}

        <div class="col-md-2">
          <label for="menus"> From Date</label>

          <div class="input-group input-append date" id="datePicker1">

           {!! Form::text('from_date', Request::get('from_date',null), array('id' => 'from_date','class'=>'form-control','placeholder'=>'DD/MM/YYYY','autocomplete'=>'off')) !!}

           <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
         </div>

       </div> 

       <div class="col-md-2">
        <label for="menus"> To Date</label>

        <div class="input-group input-append date" id="datePicker2">

          {!! Form::text('to_date', Request::get('to_date',null), array('id' => 'to_date','class'=>'form-control','placeholder'=>'DD/MM/YYYY','autocomplete'=>'off')) !!}
          <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>                
      </div>

      
      <div class="col-md-2">
       <label for="menus">Message Status</label>

       <div class="input-group input-append date" id="datePicker2">
        <select class="form-control" name="status" id="status">
          @foreach(@$status_list as $id => $type)
          <option value="{{ $id }}"  {{(@$actual_status == $id)? 'selected' : ''}}>{{ $type }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="col-md-1"><br>
      <button class="btn btn-success mt-5" type="submit" id="filter" name="filter" style="margin-top: 5px"><i class="fa fa-filter"></i> FILTER</button></div>

      <div class="col-md-1"><br> 
        <input type="hidden" name="exportData" value="1">         
        <button class="btn btn-primary mt-5" type="submit" id="exportData" name="exportData" value="1" style="margin-top: 5px"><i class="fa fa-file-excel-o"></i> DOWNLOAD</button></div>

        <div class="col-md-1"><br>
         <button class="btn btn-danger mt-5" type="reset" id="clear" name="clear" value="1" style="margin-top: 5px; margin-left: 30px"><i class="fa fa-refresh"></i> CLEAR</button>
       </div><br/>

       {!! Form::close() !!}
       
     </div>
   </div>

   <div class="box">           
    <div class="box-header with-border">
      <div class="box-body table-responsive">  
        <button type="submit" form="frm-id" class="btn btn-warning btn-sm pull-right" title="@lang('RESEND SMS')"><span class="fa fa-repeat"> </span>  RESEND SMS</button><br/>
        <form id="frm-id" method="POST" action="{{route('prospects.resend')}}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <table id="users" class="table table-striped table-bordered display hover" style="width:100%">
            <thead>
              <tr>
                {{-- <th width="10%"></th>  --}}
                <th width="10%">#</th>
                {{-- <th style="display: none"></th>  --}}
                <th width="10%">@lang('Job Id')</th>
                <th width="10%">@lang('Mobile No')</th>
                <th width="50%">@lang('Message')</th>
                <th width="10%">@lang('Status')</th>
                <th width="10%">@lang('Time')</th>
                <th width="5%">@lang('Action')</th>     
              </tr>
            </thead>

               {{--  <tbody id="pannel">
                  @include('back.downloads.application-table', compact('registered_forms'))
                </tbody> --}}
              </table>  
            </form> <br/>  
            <button type="submit" form="frm-id" class="btn btn-warning btn-sm pull-left" title="@lang('RESEND SMS')"><span class="fa fa-repeat"> </span>  RESEND SMS</button>        

           {{--  <div class="pull-right">
                {!! $registered_forms->render() !!}
              </div> --}}
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>    

      {{-- <script src="{{ asset('front_js/main.js') }}"></script> --}}

      {{-- <script type="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script> --}}
      <script>

       $('.preloader').ajaxStart(function() {
        $(this).show();
      }).ajaxComplete(function() {
        $(this).hide();
      });

      $(document).ready(function() {

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        oTable = $('#users').DataTable({
          "processing": true,
          "serverSide": true,            
          "responsive": true,
          "order":[0,"desc"],   
          "ajax": {
            url:"{{ route('datatable.getsms') }}",
            type:"get",
            data: function (d) {
              d.from_date = $('#from_date').val();
              d.to_date = $('#to_date').val();
              d.status = $('#status').val();
            }
          },
          "columns": [
          {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
          // {data: 'id', name: 'id', orderable: false, searchable: false},
          // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'job_id', name: 'job_id'},
          {data: 'mobile_number', name: 'mobile_number'},
          {data: 'message', name: 'message'},
          {data: 'status', name: 'status'},
          {data: 'done_timestamp', name: 'done_timestamp'},
          {data: 'action', name: 'action', orderable: false, searchable: false}

          ]
        });

        $('#filterData').submit(function(e){
         e.preventDefault();
         $('#users').DataTable().draw(true);
       });

        $("#exportData").click(function(e) {

              e.preventDefault(); // avoid to execute the actual submit of the form.
              $.ajax({
               type: "POST",
               url: "{{ route('prospects.post-sms-index') }}",
               data: $("#filterData").serialize(), 

               success: function(data)
               {
                if(data.status==="success"){
                  window.location = data.url;
                }else{
                  swal('No response from server');
                }                     
              }
            });
            });

        $("#clear").click(function(e){
          location.reload(true);
        })


        $('.js-example-basic-single').select2();

        $('.js-example-basic-single').select2({
          placeholder: 'Select an option',
            // allowClear: true
          });

         //  $('#users').DataTable({

         //   // "scrollY": "500px",
         //   // "scrollCollapse": true,
         //   // "bSort": false,
         //   // "paging": true
         // });

         $('#frm-id').on('submit', function(e){

          if($('input[type=checkbox]:checked').length == 0)
          {
            swal('Please select the Rows','','error');
            return false;   
          }else{           
            return true;   
          }        
          
        });   

         {{-- var actual_faculty_name = '{{$actual_faculty_name}}'; --}}

         $('.js-example-basic-single').select2();

         $('.js-example-basic-single').select2({
          // placeholder: 'Select an option',

          // allowClear: true
        });


       });


      var post = (function () {
        var url = '{{ route('prospects.application-index') }}'
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
        todayHighlight: true,
      })
    });

     $(document).ready(function() {
      var date = new Date();
      $('#datePicker2')
      .datepicker({
        format: 'dd/mm/yyyy',
        endDate:  new Date(),
        todayHighlight: true,
      })
    });
  </script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  @endsection
