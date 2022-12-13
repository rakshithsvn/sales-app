@extends('back.layout')

@section('css')
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
<style>
  input, th span {
    cursor: pointer;
  }
  input[type="text"] {
    width: 40%;
}
</style>
@endsection

@section('main')

<div class="row">
  <div class="col-md-12">
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      <center style="color:white !important;">{!! Session::get('success') !!}</center>
    </div>
    @endif

    <form role="form" action="{{route('prospects.application-update')}}" method="post" enctype="multipart/formdata">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$application_details->id}}">
      <div class="box">
       <div class="box-body">
        <table class="table table-striped table-hover">
          <tr>
            <th>Medical Record Number</th>
            <td>{{$application_details->patient_id}}</td>   
            <th>Application Number</th>
            <td>{{$application_details->id}}</td>  
          </tr> 

          <tr>
            <th>Name</th>
            <td colspan="3">{{$application_details->full_name}}</td>

          </tr>
          <tr>
            <th>Age</th>
            <td>{{$application_details->age ? $application_details->age : ''}}</td>

            <th>Gender</th>
            <td>{{$application_details->gender}}</td>   
          </tr>

          <tr>
            <th>Contact Number</th>
            <td>{{$application_details->phone}}</td>            

            <th>Email Id</th>
            <td>{{$application_details->email}}</td>
          </tr>

          {{-- <tr>
            <th>Present Address</th>
            <td colspan="3">{{$application_details->present_address}}</td>
          </tr> --}}

          <tr>
            <th>Date</th>
            <td>{{ $application_details->date->format('d/m/Y') }}</td>            

            <th>Time</th>
            <td width="30%">
              @if($application_details->status == 'Accepted')

              <input type="text" value="{{ $application_details->time }}" disabled="">
              <input type="text" id="time" name="time" value="" required="">
             {{--  <select class="form-control" name="time">
                @foreach($timings as $time)
                <option value="{{ $time }}" {{ $application_details->time == $time ? 'selected="selected"' : '' }}>{{ $time }}</option>
                @endforeach
              </select> --}}             
              @else
              {{ $application_details->time }}
              @endif
            </td>

          </tr>

          <tr>
            <th>Doctor</th>
            <td>{{@$application_details->faculty->full_name}}</td>   

            <th>Department</th>
            <td>{{@$application_details->post->title}}</td>             

          </tr>

         {{--  <tr>
            <th>Payment Confirmed</th>
            <td>@if($application_details->confirm_payment == 1) YES @else NO @endif</td>            

            <th>Payment Method</th>
            <td>{{$application_details->payment_method}}</td>

          </tr>
 --}}
           <tr>
            <th>Medical Concern</th>
            <td>{{$application_details->concern}}</td>    
             <th>Appointment Status</th>
            <td>{{$application_details->status}}</td>              

          </tr>
        </table>
      </div><!-- /.box-body -->
    </div>
    <!-- /.box -->
    @if($application_details->status == 'Accepted')
    <button class="btn btn-success btn-sm" type="submit" title="@lang('Update Appointment')"><span class="fa fa-check"></span> Update and Send SMS</button>    
    {{-- <a class="btn btn-success btn-sm " href="{{ route('prospects.confirm', [$application_details->id]) }}" role="button"><span class="fa fa-check"></span> Send Confirm SMS</a> --}}
    @endif
    @if($application_details->status == 'Confirmed')
    <a class="btn btn-warning btn-sm " href="{{ route('prospects.review', [$application_details->id]) }}" role="button"><span class="fa fa-thumbs-up"></span> Send Thanks SMS</a>
    @endif
    <a href="{{route('prospects.application-index')}}" class="btn btn-default pull-right">@lang('Back')</a>   
  </form>

</div>
<!-- /.col -->
</div>
<!-- /.row -->

@endsection

@section('js')
<script src="{{ asset('adminlte/js/back.js') }}"></script>

@endsection
