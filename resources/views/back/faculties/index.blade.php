@extends('back.layout')

@section('css')
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
<style>
  input, th span {
    cursor: pointer;
  }
  .switch {
    position: relative;
    display: inline-block;
    width: 75px;
    height: 30px;
  }

  .switch input {display:none;}

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ca2222;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 24px;
    width: 22px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2ab934;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(47px);
    -ms-transform: translateX(47px);
    transform: translateX(47px);
  }

  /*------ ADDED CSS ---------*/
  .on
  {
    display: none;
  }

  .on, .off
  {
    color: white;
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    font-size: 10px;
    font-family: Verdana, sans-serif;
  }

  input:checked+ .slider .on
  {display: block;}

  input:checked + .slider .off
  {display: none;}

  /*--------- END --------*/

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;}
  </style>
</style>
@endsection

@section('button')
@if(auth()->user())
<a class="btn btn-primary" href="{{ route('faculties.create') }}"><span class="fa fa-plus" aria-hidden="true"></span> @lang('New Member')</a>
{{-- <a class="btn btn-primary" href="{{ route('schedule.create') }}">@lang('Doctor Schedule')</a> --}}
{{-- <a class="btn btn-primary" href="{{ route('appointment.index') }}">@lang('Doctor Appointment')</a> --}}
@endif
@endsection

@section('main')

<div class="row">
  <div class="col-md-12">
    @if (session('category-ok'))
    @component('back.components.alert')
    @slot('type')
    success
    @endslot
    {!! session('category-ok') !!}
    @endcomponent
    @endif

    @if (session('category-danger'))
    @component('back.components.alert')
    @slot('type')
    danger
    @endslot
    {!! session('category-danger') !!}
    @endcomponent
    @endif
    <div class="box">
      <div class="box-header with-border">
        <input type="text" class="pull-right" id="searchContent">
        <div id="spinner" class="text-center"></div>
      </div>
      <div class="box-body table-responsive">
        <table id="users" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th style="display:none;">#</th>
              <th>@lang('Name')</th>
              <th>@lang('Thumb Image')</th>
              <th>@lang('Designation')</th>
              {{-- <th>@lang('Appointment')</th> --}}
              <th>@lang('Active')</th>
              <th>@lang('Creation')</th>
              <th>@lang('Action')</th>
              
            </tr>
          </thead>
          <tbody id="pannel">
            @include('back.faculties.table', compact('faculties'))
          </tbody>
        </table>
        <div class="pull-right">
          {!! $faculties->render() !!}
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
    var url = '{{ route('faculties.index') }}'
    var swalTitle = '@lang('Really destroy faculty ?')'
    var confirmButtonText = '@lang('Yes')'
    var cancelButtonText = '@lang('No')'
    var errorAjax = '@lang('Looks like there is a server issue...')'

    var onReady = function () {
      $('#pagination').on('click', 'ul.pagination a', function (event) {
        back.pagination(event, $(this), errorAjax)
      })
      $('#pannel').on('change', ':checkbox[name="appointment"]', function () {
        back.appoint(url, $(this), errorAjax)
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
@endsection
