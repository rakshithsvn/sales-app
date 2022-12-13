@extends('back.layout')

@section('css')
<style>
    textarea { resize: vertical; }
    .select2-container .select2-selection--single  {height: 35px !important}
</style>
<link href="{{ asset('adminlte/plugins/colorbox/colorbox.css') }}" rel="stylesheet">
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection

@section('main')

@yield('form-open')
{{ csrf_field() }}

<div class="row">

    <div class="col-md-6">

     @component('back.components.box')
     @slot('type')
     primary
     @endslot
     @slot('boxTitle')
     Event
     @endslot

     <div class="form-group">
        <label for="menus">Select Event</label>

        <select id="event_id" name="event_id" class="js-example-basic-single form-control" required="true">
            @foreach($event_list as $id => $event_id)
            <option value="{{ $id }}" {{($actual_event == $id)? 'selected' : ''}}>{{ $event_id }}</option>
            @endforeach
        </select>
    </div>

    {{--  <div class="form-group">
        <label for="submenus">Select Tab Section</label>
            <select id="post_tab_id" name="post_tab_id" value ="post_tab_id" class="form-control">
            </select>
        </div> --}}

        @endcomponent
 </div>

 <div class="col-md-6">
        @component('back.components.box')
        @slot('type')
        primary
        @endslot
        @slot('boxTitle')
        Users
        @endslot

        <div class="form-group">
            <label for="menus">Select User</label>

            <select id="event_user_id" name="event_user_id" class="js-example-basic-single form-control" required="true">
                @foreach($user_names as $id => $event_user_id)
                <option value="{{ $id }}" {{($actual_user_name == $id)? 'selected' : ''}}>{{ $event_user_id }}</option>
                @endforeach
            </select>
        </div>

        @endcomponent
  </div>

</div>
        @include('back.partials.boxinput', [
            'box' => [
                'type' => 'box-primary',
                'title' => __('Status'),
            ],
            'input' => [
                'name' => 'active',
                'value' => isset($link_users) ? $link_users->active : true,
                'input' => 'checkbox',
                'label' => __('Active'),
            ],
            ])

            <button type="submit" class="btn btn-primary">@lang('Submit')</button>

            <a href="{{route('link-users.index')}}" class="btn btn-default">@lang('Cancel')</a> 
       
  </div>

    <!-- /.row -->
</form>

@endsection

@section('js')

<script src="{{ asset('adminlte/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>
<!-- <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> -->
<script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $('.js-example-basic-single').select2({
          placeholder: 'Select an option',
          // allowClear: true
      });
    });     

    var actual_post_tab = '{{$actual_post_tab}}';
    var user_names   = [@foreach($user_names as $k => $info)
                           '{{ $info }}',
                             @endforeach ];   

    $('#slug').keyup(function () {
        $(this).val(v.slugify($(this).val()))
    })

    $('#slug').parent().parent().parent().hide();
    $('#hierarchy').prop('readonly', true);

    $('#title').keyup(function () {
        $('#slug').val(v.slugify($(this).val()))
    })

</script>
<script src="{{ asset('js/link-user.js') }}" type="text/javascript"></script>

@endsection