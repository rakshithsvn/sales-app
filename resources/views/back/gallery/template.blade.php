
@extends('back.layout')

@section('css')

<style>
  textarea { resize: vertical; }
  #custom_table {margin-bottom: 0px;}
  td {padding: 0px 8px !important;}
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

    <div class="col-md-12">
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

        @component('back.components.box')
            @slot('type')
                primary
            @endslot
            @slot('boxTitle')
                Event Info
            @endslot

        <div class="row">
        <div class="form-group col-md-4">
            <label for="menus">Select Event</label>

               <select id="event_id" name="event_id" class="js-example-basic-single form-control" required="true">
                      @foreach($project_page as $id => $event_id)
                      <option value="{{ $id }}" {{($actual_project_page == $id)? 'selected' : ''}}>{{ $event_id }}</option>
                  @endforeach
              </select>
              <input type="hidden" id="actual_post" name="event_id" value="{{$actual_project_page}}"/>
        </div>

         <div class="form-group col-md-4">
            <label for="menus">Select Date</label>

               <select id="event_tab_id" name="event_tab_id" class="js-example-basic-single form-control" required="true">
                  @foreach($event_page as $id => $event_tab_id)
                      <option value="{{ $id }}" {{($actual_project_tab_page == $id)? 'selected' : ''}}>{{ $event_tab_id }}</option>
                  @endforeach
              </select>
              <input type="hidden" id="actual_post_tab" name="event_tab_id" value="{{$actual_project_tab_page}}"/>
        </div>
        </div>

        @endcomponent

        <div id="tab">
          @include('back.partials.boxinput', [
          'box' => [
          'type' => 'box-primary',
          'title' => __('Content In Tab Section'),
          ],
          'input' => [
          'name' => 'tab_section',
          'value' => 'Y',
          'input' => 'checkbox',
          'label' => __('Yes'),
          ],
          ])
        </div>

        <div class="tabContent">

            <table class="table custom_table" id="custom_table" style="">
                  <thead></thead>
                    <tbody id="tbl1">
                       @if(empty($post_tabs))
                       <tr>
                        <td style="display:none;"><input type="hidden" name="content_id[]" value="0" class="tab_id"> </td>
                         <td>
                           @include('back.partials.boxinput', [
                           'box' => [
                           'type' => 'box-primary',
                           'title' => __('Time'),
                           ],
                           'input' => [
                           'name' => 'tab_time[0]',
                           'value' => isset($post_tabs) ? $post_tabs[0]->tab_time: '',
                           'input' => 'text',
                           'required' => true,
                           ],
                          ])
                        </td>
                        <td>
                           @include('back.partials.boxinput', [
                           'box' => [
                           'type' => 'box-primary',
                           'title' => __('Title'),
                           ],
                           'input' => [
                           'name' => 'tab_title[0]',
                           'value' => isset($post_tabs) ? $post_tabs[0]->tab_title: '',
                           'input' => 'text',
                           'required' => true,
                           ],
                          ])
                        </td>
                         <td>
                          {{-- @include('back.partials.boxinput', [
                           'box' => [
                           'type' => 'box-primary',
                           'title' => __('Speaker'),
                           ],
                          ]) --}}
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Speaker</h3>
                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          </div>
                        </div>
                      <div class="box-body">
                        <div class="form-group">
                          <select id="speaker_id" name="speaker_id[0]" class="js-example-basic-single form-control" required="true">
                            @foreach($speakers as $id => $name)
                            <option value="{{ $id }}" {{(@$post_tabs[0]->speaker_id == $id)? 'selected' : ''}}>{{ $name }}</option>
                            @endforeach
                          </select>
                          <input type="hidden" id="speakers" name="speaker_id" value="{{@$post_tabs[0]->speaker_id}}"/>
                        </div></div></div></td>
                           
                        <td></td><td></td>

                   </tr>
                   @else
                   @foreach($post_tabs as $key=>$tabs)
                   <tr value="{{$tabs->id}}">
                    <td style="display:none;"><input type="hidden" name="content_id[]" value="{{$tabs->id}}" class="tab_id"> </td>
                     <td>
                        @include('back.partials.boxinput', [
                        'box' => [
                        'type' => 'box-primary',
                        'title' => __('Time'),
                        ],
                        'input' => [
                        'name' => 'tab_time['.$tabs->id.']['.$key.']',
                        'value' => isset($post_tabs) ? $tabs->tab_time: '',
                        'input' => 'text',
                        'required' => true,
                        ],
                        ])
                    </td>
                    <td>
                        @include('back.partials.boxinput', [
                        'box' => [
                        'type' => 'box-primary',
                        'title' => __('Title'),
                        ],
                        'input' => [
                        'name' => 'tab_title['.$tabs->id.']['.$key.']',
                        'value' => isset($post_tabs) ? $tabs->tab_title: '',
                        'input' => 'text',
                        'required' => true,
                        ],
                        ])
                        </td>
                         <td>

                          <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Speaker</h3>
                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          </div>
                        </div>
                      <div class="box-body">
                        <div class="form-group">
                          <select id="speaker_id" name="speaker_id[{{$tabs->id}}][{{$key}}]" class="form-control" required="true">
                            @foreach($speakers as $id => $name)
                            <option value="{{ $id }}" {{(@$tabs->speaker_id == $id)? 'selected' : ''}}>{{ $name }}</option>
                            @endforeach
                          </select>
                          <!-- <input type="hidden" id="speakers" name="speaker_id['.$tabs->id.']['.$key.']" value="{{@$tabs->speaker_id}}"/> -->
                        </div></div></div>
                                              
                        </td>
                    <td>
                      <a class="btn btn-danger btn-xs btn-block tbl_rem" style="margin-bottom: 15px;" href="javascript:void(0)"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>

        </table>


        <a class="btn btn-success btn-xs" style="margin: 0 10px 10px;" id='tbl_add' href="javascript:void(0)"><i class="fa fa-plus"></i></a>


    </div>

    {{-- @include('back.partials.boxinput', [
    'box' => [
    'type' => 'box-primary',
    'title' => __('Status'),
    ],
    'input' => [
    'name' => 'active',
    'value' => true,
    'input' => 'checkbox',
    'label' => __('Active'),
    ],
    ]) --}}

    <button type="submit" class="btn btn-primary" id="submitPost">@lang('Submit')</button>
    <a href="{{route('gallery.index')}}" class="btn btn-default">@lang('Cancel')</a>

</div>

</div>
<!-- /.row -->
</form>

@endsection

@section('js')

<script src="{{ asset('adminlte/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>
<!--  <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> -->
<script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminlte/plugins/ckeditor/config.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script>
    var speakers = '{{ $speakers }}';
  
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $('.js-example-basic-single').select2({
          placeholder: 'Select an option',
          // allowClear: true
      });

      $('#tab').hide();
      @if($actual_project_page == null)
        $('#event_id').attr('disabled', false);
        $('#actual_post').attr('disabled', true);
      @else
        $('#event_id').attr('disabled', true);
        $('#actual_post').attr('disabled', false);
      @endif
       @if($actual_project_tab_page == null)
        $('#event_tab_id').attr('disabled', false);
        $('#actual_post_tab').attr('disabled', true);
      @else
        $('#event_tab_id').attr('disabled', true);
        $('#actual_post_tab').attr('disabled', false);
      @endif
});

  $('.popup_selector_tab').click( function (event) {
      event.preventDefault()
      var updateID = $(this).attr('data-inputid_tab')
      var elfinderUrl = '/elfinder/popup/'
      var triggerUrl = elfinderUrl + updateID
      $.colorbox({
          href: triggerUrl,
          fastIframe: true,
          iframe: true,
          width: '70%',
          height: '70%'
        })
    })

    var $thisSeletedButton = null;
    $(document).on('click','.popup_selector_tab_new, .popup_selector_tab',function(){
       // alert($(this).parent().parent().find('input').attr('id'))
        $thisSeletedButton = $(this);
    })

   function processSelectedFile(filePath, requestingField) {
     $('#' + requestingField).val('\\' + 'storage/' +filePath)
     if(requestingField == 'tab_image')
     {
      $($thisSeletedButton).parent().parent().parent().parent().parent().find('.tab_image').attr('src', '\\' + 'storage/' +filePath)
      $($thisSeletedButton).parent().parent().parent().parent().parent().find('.tab_image').attr('value', '\\' + 'storage/' +filePath)
    }
  }

  $('#slug').keyup(function () {
      $(this).val(v.slugify($(this).val()))
  })

  $('#title').keyup(function () {
      $('#slug').val(v.slugify($(this).val()))
  })

 </script>


<script src="{{ asset('js/gallery.js') }}"></script>

<script src="{{ asset('adminlte/js/back.js') }}"></script>

@endsection
