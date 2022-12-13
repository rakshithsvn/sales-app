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
  <form @submit.prevent="saveDealer">
    
    <div v-for="(data, index) in dealers" :key="index" class="row" style="margin: 10px; padding: 15px; background: #ffff;">
      
      <div class="col-md-4">
      <input type="text" class="form-control" v-model="data.title" placeholder="Job Title" required>
      </div>
       <div class="col-md-4">
      <input type="number" class="form-control" v-model="data.post" placeholder="No. of Posts" required>
      </div>
      <div class="col-md-3">
      <input type="text" class="form-control" v-model="data.expr" placeholder="Experience" required>
      </div>
       <div class="col-md-4"><br/>
      <textarea class="form-control" v-model="data.qual" placeholder="Qualification" row="3" required></textarea>
      </div>
      <div class="col-md-4"><br/>
      <textarea class="form-control" v-model="data.excerpt" placeholder="Description" row="3" ></textarea>
      </div>     
      <div class="col-md-3"><br/>
      {{-- <input type="text" class="form-control" v-model="data.dept" placeholder="Department" required> --}}
      <select class="form-control" title="Select Department" v-model="data.dept" placeholder="Department">
        <option value="">---Select----</option>
        <option v-for="dept in departments">@{{ dept.title }}</option>
      </select>
      </div>
     
     {{--  <div class="col-md-2">
          <input-file-image :file.sync="data.image" image-width="7em" image-height="7em"></input-file-image>
      </div> --}}     
      <div class="col-md-1">
        <a class="btn btn-danger btn-xs" @click="deleteRow(index,data)" v-show="index || ( !index && dealers.length > 1)" style="margin-right: 10px"><span class="fa fa-minus"></span></a>
        <a class="btn btn-success btn-xs" @click="addRow" v-show="index == dealers.length-1"><span class="fa fa-plus"></span></a>
      </div>
    </div>
  <button type="submit" class="btn btn-primary" id="submitPost" style="margin-left: 10px">@lang('Submit')</button>&nbsp;
   <a href="{{route('dashboard')}}" class="btn btn-default">@lang('Cancel')</a> 
</form>
<vue-snotify></vue-snotify>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="{{ asset('js/backVue.js') }}"></script>

@endsection