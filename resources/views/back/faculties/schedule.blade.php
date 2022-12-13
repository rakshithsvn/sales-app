@extends('back.layout')

@section('css')

@endsection

@section('button')
{{-- <a class="btn btn-primary" href="{{ route('prospects.application-index') }}">@lang('Dealers Registration')</a> --}}
@endsection

@section('main')

@if (session('post-ok'))
  @component('back.components.alert')
  @slot('type')
  success
  @endslot
  {!! session('post-ok') !!}
  @endcomponent
@endif

@if (session('post-danger'))
  @component('back.components.alert')
  @slot('type')
  danger
  @endslot
  {!! session('post-danger') !!}
  @endcomponent
@endif

  <div id="app">
  <form @submit.prevent="saveSchedule">
    
    <div v-for="(data, index) in schedules" :key="index" class="row" style="margin: 10px; padding: 15px;background: #ffff;">
      
      <div class="col-md-3">
     <select class="form-control" title="Select Doctor" v-model="data.faculty_id" placeholder="Doctor" required>
      <option disabled selected>---Select Doctor--- </option>
        <option v-for="doctor in doctors" :value="doctor.id">@{{ doctor.name }} @{{ doctor.last_name }}</option>
      </select>
      </div>
      <div class="col-md-2">
        <select class="form-control" title="Select Day" v-model="data.day" placeholder="Day" required>
      <option disabled selected>---Select Day--- </option>
        <option v-for="day in days" >@{{ day }}</option>
      </select>
      </div>
      <div class="col-md-2">
        <input type="time" class="form-control" v-model="data.from_time" placeholder="From Time" required>
      </div>
    <div class="col-md-2">
       <input type="time" class="form-control" v-model="data.to_time" placeholder="To Time" required>
      </div>
      <div class="col-md-2">
      <input type="text" class="form-control" v-model="data.location" placeholder="Location" >
      </div>
       
      <div class="col-md-1">
        <a class="btn btn-danger btn-xs" @click="deleteScheduleRow(index,data)" v-show="index || ( !index && schedules.length > 1)" style="margin-right: 10px"><span class="fa fa-minus"></span></a>
        <a class="btn btn-success btn-xs" @click="addScheduleRow" v-show="index == schedules.length-1"><span class="fa fa-plus"></span></a>
      </div>
    </div>
  <button type="submit" class="btn btn-primary" id="submitPost" style="margin-left: 10px">@lang('Submit')</button>&nbsp;
   <a href="{{route('faculties.index')}}" class="btn btn-default">@lang('Cancel')</a> 
</form>
<vue-snotify></vue-snotify>
</div>
@endsection

@section('js')

<script src="{{ asset('js/backVue.js') }}"></script>

@endsection