@extends('back.layout')

@section('css')
<style>
    textarea { resize: vertical; }
</style>
<link href="{{ asset('adminlte/plugins/colorbox/colorbox.css') }}" rel="stylesheet">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
@endsection

@section('main')

@yield('form-open')
{{ csrf_field() }}

<div class="row">

    <div class="col-md-8">
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

        @include('back.partials.boxinput', [
            'box' => [
                'type' => 'box-primary',
                'title' => __('Title'),
            ],
            'input' => [
                'name' => 'title',
                'value' => isset($post) ? $post->title : '',
                'input' => 'text',
                'required' => true,
            ],
            ])

        @include('back.partials.boxinput', [
            'box' => [
                'type' => 'box-primary',
                'title' => __('Short Description'),
            ],
            'input' => [
                'name' => 'excerpt',
                'value' => isset($post) ? $post->excerpt : '',
                'input' => 'textarea',
                'rows' =>2,
                'required' => false,
            ],
            ])

            <div class="course">

             @component('back.components.box')
             @slot('type')
             primary
             @endslot
             @slot('boxTitle')
             Course Details
             @endslot
             {{--   <div class="col-md-4">
                 <div class="form-group">
                    <label for="menus">Lessons</label>
                    <input type="text" class="form-control" name="lessons" id="lessons" value="{{ isset($post) ? $post->lessons : '' }} "/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="menus">Duration</label>
                    <input type="text" class="form-control" id="duration" name="duration" value="{{ isset($post) ? $post->duration : '' }} "/>
                </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                <label for="menus">Viewers</label>
                <input class="form-control" type="text" id="viewers" name="viewers" value="{{ isset($post) ? $post->viewers : '' }}"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="menus">Prequisite</label>
                <input class="form-control" type="text" id="prequisite" name="prequisite" value="{{ isset($post) ? $post->prequisite : '' }}"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="menus">Certificate</label>
                <input class="form-control" type="text" id="certificate" name="certificate" value="{{ isset($post) ? $post->certificate : '' }}"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="menus">Language</label>
                <input class="form-control" type="text" id="language" name="language" value="{{ isset($post) ? $post->language : '' }}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="menus">Skill</label>
                <input class="form-control" type="text" id="skill" name="skill" value="{{ isset($post) ? $post->skill : '' }}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="menus">Assessment</label>
                <input class="form-control" type="text" id="assessment" name="assessment" value="{{ isset($post) ? $post->assessment : '' }}"/>
            </div>
        </div> --}}
        @endcomponent
    </div>

    <div class="body">
        @component('back.components.box')
        @slot('type')
        primary
        @endslot
        @slot('boxTitle')
        @lang('Banner Image')
        @endslot
        <img id="imgBanner" src="@isset($post) {{ $post->banner_image }} @endisset" alt="" class="img-responsive img-fluid">
        @slot('footer')
        <div class="{{ $errors->has('banner_image') ? 'has-error' : '' }}">
            <div class="input-group">
                <div class="input-group-btn">
                    <a href="" class="popup_selector_banner btn btn-primary" data-inputid_banner="banner_image">@lang('Select an image')</a>
                </div>
                <!-- /btn-group -->
                <input class="form-control" type="text" id="banner_image" name="banner_image" value="{{ old('banner_image', isset($post) ? $post->banner_image : '') }}">
            </div>
            {!! $errors->first('banner_image', '<span class="help-block">:message</span>') !!}
        </div>
        @endslot
        @endcomponent


        @include('back.partials.boxinput', [
            'box' => [
                'type' => 'box-success',
                'title' => 'Long Description',
            ],
            'input' => [
                'name' => 'body',
                'value' => isset($post) ? $post->body : '',
                'input' => 'textarea',
                'rows' => 10,
                'required' => true,
            ],
            ])

            <div class="body1">
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-success',
                        'title' => 'long_desc1',
                    ],
                    'input' => [
                        'name' => 'body1',
                        'value' => isset($post) ? $post->body1 : '',
                        'input' => 'textarea',
                        'rows' => 10,
                        'required' => true,
                    ],
                    ])
                </div>

                <div class="body2">
                    @include('back.partials.boxinput', [
                        'box' => [
                            'type' => 'box-success',
                            'title' => 'long_desc2',
                        ],
                        'input' => [
                            'name' => 'body2',
                            'value' => isset($post) ? $post->body2 : '',
                            'input' => 'textarea',
                            'rows' => 10,
                            'required' => true,
                        ],
                        ])
                    </div>
                </div>

            </div>

            <div class="col-md-4">

               @component('back.components.box')
               @slot('type')
               primary
               @endslot
               @slot('boxTitle')
               Menu
               @endslot

               <div class="form-group">
                <label for="menus">Parent Menu</label>

                <select id="parent_menu_id" name="parent_menu_id" class="form-control" required="">
                    @foreach($parent_menus as $id => $parent_menu_id)
                    <option value="{{ $id }}" {{($actual_parent_menu == $id)? 'selected' : ''}}>{{ $parent_menu_id }}</option>
                    @endforeach
                </select>

            </div>

            <div class="form-group">
                <label for="submenus">Sub Menu</label>
                <select id="sub_menu_id" name="sub_menu_id" value ="sub_menu_id" class="form-control">
                </select>
            </div>

            <div class="form-group">
                <label for="childmenus">Child Menu</label>
                <select id="child_menu_id" name="child_menu_id" value = "child_menu_id" class="form-control">
                </select>
            </div>

{{-- <div class="form-group">
    <label for="childmenus">Sub Child Menu</label>
    <select id="sub_child_menu_id" name="sub_child_menu_id" value = "sub_child_menu_id" class="form-control">
    </select>
</div> --}}

@endcomponent


@component('back.components.box')
@slot('type')
info
@endslot
@slot('boxTitle')
SEO
@endslot
@include('back.partials.input', [
    'input' => [
        'name' => 'meta_description',
        'value' => isset($post) ? $post->meta_description : '',
        'input' => 'text',
        'title' => __('META Description'),
        'input' => 'textarea',
        'rows' => 2,
        'required' => true,
    ]
    ])
@include('back.partials.input', [
    'input' => [
        'name' => 'meta_keywords',
        'value' => isset($post) ? $post->meta_keywords : '',
        'input' => 'text',
        'title' => __('META Keywords'),
        'input' => 'textarea',
        'rows' => 2,
        'required' => true,
    ]
    ])
@include('back.partials.input', [
    'input' => [
        'name' => 'seo_title',
        'value' => isset($post) ? $post->seo_title : '',
        'input' => 'text',
        'title' => __('SEO Title'),
        'required' => true,
    ],
    ])
    @endcomponent

<div class="news">
@component('back.components.box')
 @slot('type')
 info
 @endslot
 @slot('boxTitle')
 Category
 @endslot

 <div class="form-group">
    <label for="menus">Category</label>
    <select id="category_id" name="category_id" class="form-control">
        <option value="">-- Select --</option>
        @foreach($categories as $id => $category_id)
        <option value="{{ $id }}" {{($actual_category == $id)? 'selected' : ''}}>{{ $category_id }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="menus">Read Time in Min.</label>
    <input class="form-control" type="number" id="time" name="time" value="{{ isset($post) ? $post->time : '' }}">
</div>
@endcomponent
</div>

<div class="image">
    @component('back.components.box')
    @slot('type')
    primary
    @endslot
    @slot('boxTitle')
    @lang('Thumb Image')
    @endslot
    <img id="img" src="@isset($post) {{ $post->image }} @endisset" alt="" class="img-responsive img-fluid">
    @slot('footer')
    <div class="{{ $errors->has('image') ? 'has-error' : '' }}">
        <div class="input-group">
            <div class="input-group-btn">
                <a href="" class="popup_selector btn btn-primary" data-inputid="image">@lang('Select an image')</a>
            </div>
            <!-- /btn-group -->
            <input class="form-control" type="text" id="image" name="image" value="{{ old('image', isset($post) ? $post->image : '') }}">
        </div>
        {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
    </div>
    @endslot
    @endcomponent
</div>

<div class="icon">
    @component('back.components.box')
    @slot('type')
    primary
    @endslot
    @slot('boxTitle')
    @lang('Icon Image')
    @endslot
    <img id="icons" src="@isset($post) {{ $post->icon }} @endisset" alt="" class="img-responsive img-fluid">
    @slot('footer')
    <div class="{{ $errors->has('icon') ? 'has-error' : '' }}">
        <div class="input-group">
            <div class="input-group-btn">
                <a href="" class="popup_selector btn btn-primary" data-inputid="icon">@lang('Select an image')</a>
            </div>
            <!-- /btn-group -->
            <input class="form-control" type="text" id="icon" name="icon" value="{{ old('icon', isset($post) ? $post->icon : '') }}">
        </div>
        {!! $errors->first('icon', '<span class="help-block">:message</span>') !!}
    </div>
    @endslot
    @endcomponent
</div>

<div class="news">
    @component('back.components.box')
    @slot('type')
    primary
    @endslot
    @slot('boxTitle')
    Event Date
    @endslot

    <div class="form-group">
        <label for="menus">Date</label>

        <div class="input-group input-append date" id="datePicker">
            <input type="text" class="form-control" name="event_date" placeholder="dd/mm/yyyy" id="event_date"/>
            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>


    </div>
    @endcomponent
</div>


{{--  @include('back.partials.boxinput', [
'box' => [
'type' => 'box-primary',
'title' => __('Download Brochure'),
],
'input' => [
'name' => 'brochure',
'value' => isset($post) ? $post->brochure : false,
'input' => 'checkbox',
'label' => __('Yes'),
],
])--}}


<div class="upcoming_events">
   @component('back.components.box')
   @slot('type')
   primary
   @endslot
   @slot('boxTitle')
   Event Venue
   @endslot

   <div class="form-group">
    <label for="menus">Date</label>

    <div class="input-group input-append date" id="datePicker1">
     {{--  <input type="text" class="form-control" name="event_date" placeholder="dd/mm/yyyy" id="event_date"/> --}}
     <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
 </div>
</div>

<div class="form-group">
    <label for="menus">Time</label>

    <div class="input-group input-append date" >
     {{--  <input type="text" class="form-control" id="timepicker1" name="event_time" placeholder="HH:MM"/> --}}
     <span class="input-group-addon add-on"><span class="glyphicon glyphicon-time"></span></span>
 </div>
</div>

<div class="form-group">
    <label for="menus">Location</label>
    <div class="input-group input-append" style="width: 100%">
        {{--   <textarea name="location" class="form-control" row="3" value="{{isset($post) ? $post->location : ''}}"></textarea> --}}
    </div>
</div>
@endcomponent
 {{--   @include('back.partials.boxinput', [
       'box' => [
           'type' => 'box-primary',
           'title' => __('Fixed Event'),
       ],
       'input' => [
           'name' => 'fixed_event',
           'value' => isset($post) ? $post->fixed_event : false,
           'input' => 'checkbox',
           'label' => __('Yes'),
       ],
       ])

   @include('back.partials.boxinput', [
       'box' => [
           'type' => 'box-primary',
           'title' => __('Multiple Day Event'),
       ],
       'input' => [
           'name' => 'multiple_day_event',
           'value' => isset($post) ? $post->multiple_day_event : false,
           'input' => 'checkbox',
           'label' => __('Yes'),
       ],
       ])

       @component('back.components.box')
       @slot('type')
       primary
       @endslot
       @slot('boxTitle')
       Event Date
       @endslot

       <div class="form-group">
        <label for="menus"> From Date</label>

        <div class="input-group input-append date" id="datePicker1">

          <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
      </div><br/>

      <div class="to-eventDate">

       <label for="menus"> To Date</label>

       <div class="input-group input-append date" id="datePicker2">

         <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
     </div>
 </div>

</div>
@endcomponent --}}

</div>
</div>

<div class="col-md-8">

    <div class="tab">
        @include('back.partials.boxinput', [
            'box' => [
                'type' => 'box-primary',
                'title' => __('Content In Tab Section'),
            ],
            'input' => [
                'name' => 'tab_section',
                'value' => isset($post) ? $post->tab_section : false,
                'input' => 'checkbox',
                'label' => __('Yes'),
            ],
            ])
        </div>

        <div class="tabContent">
            @component('back.components.box')
            @slot('type')
            primary
            @endslot
            @slot('boxTitle')
            <label class="tab_content">Tab Section Content</label>
            @endslot

            <table class="table table-bordered table-hover custom_table" id="custom_table">
                <thead>
                    <tbody id="tbl1">
                       @if(empty($post_tabs))
                       <tr>
                        <td>

                          @component('back.components.boxinputs')
                          @slot('type')
                          primary
                          @endslot
                          @slot('boxTitle')
                          @lang('Title')
                          @endslot
                          <div class="form-group">
                            <input type="text" name="tab_title[0]" id="tab_title[0]" value="{{ isset($post_tabs) ? $post_tabs[0]->tab_title: '' }}" class="form-control tab_title" required="">
                        </div>
                        @endcomponent

                    {{-- @component('back.components.box')
                    @slot('type')
                        primary
                    @endslot
                    @slot('boxTitle')
                        @lang('Thumb Image')
                    @endslot
                    <img id="tab_image" src="@isset($post) {{ $post->tab_image }} @endisset" alt="" class="img-responsive img-fluid tab_image">
                    @slot('footer')
                        <div class="{{ $errors->has('tab_image') ? 'has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <a href="" class="popup_selector_tab btn btn-primary" data-inputid_tab="tab_image">@lang('Select an image')</a>
                                </div>
                                <!-- /btn-group -->
                                <input class="form-control tab_image" type="text" id="tab_image" name="tab_image[0]" value="{{ old('tab_image', isset($post) ? $post->tab_image : '') }}">
                            </div>
                            {!! $errors->first('tab_image', '<span class="help-block">:message</span>') !!}
                        </div>
                    @endslot
                    @endcomponent  --}}
                    @component('back.components.boxinputs')
                    @slot('type')
                    primary
                    @endslot
                    @slot('boxTitle')
                    @lang('Description')
                    @endslot
                    <div class="form-group">
                        <input type="text" name="tab_image[0]" id="tab_image[0]" value="{{ isset($post_tabs) ? $post_tabs[0]->tab_image: '' }}" class="form-control tab_image" required="">
                    </div>
                    @endcomponent



                    @include('back.partials.boxinput', [
                       'box' => [
                           'type' => 'box-primary',
                           'title' => __('Long Description'),
                       ],
                       'input' => [
                           'name' => 'tab_body[0]',
                           'value' => isset($post_tabs) ? $post_tabs[0]->tab_body : '',
                           'input' => 'textarea',
                           'rows' => 10,
                           'required' => true,
                       ],
                       ])
                   </td>
               </tr>
               @else
               @foreach($post_tabs as $key=>$tabs)
               <tr value="{{$tabs->id}}">
                <td>
                    @component('back.components.boxinputs')
                    @slot('type')
                    primary
                    @endslot
                    @slot('boxTitle')
                    @lang('Title')
                    @endslot
                    <div class="form-group">
                        <input type="text" name="{{'tab_title['.$tabs->id.']['.$key.']'}}" id="{{'tab_title['.$tabs->id.']['.$key.']'}}" value="{{ isset($post_tabs) ? $tabs->tab_title: '' }}" class="form-control tab_title" required="">
                    </div>
                    @endcomponent


                 {{--    @component('back.components.box')
                    @slot('type')
                        primary
                    @endslot
                    @slot('boxTitle')
                        @lang('Thumb Image')
                    @endslot

                    <img id="tab_image" src="@isset($post_tabs) {{ $tabs->tab_image }} @endisset" alt="" class="img-responsive img-fluid tab_image">
                    @slot('footer')
                        <div class="{{ $errors->has('tab_image') ? 'has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <a href="" class="popup_selector_tab btn btn-primary tab_image" data-inputid_tab="tab_image">@lang('Select an image')</a>
                                </div>
                                <!-- /btn-group -->

                                {{Form::text('tab_image['.$tabs->id.']['.$key.'].', isset($post_tabs) ? $tabs->tab_image : '', array('class'=>'form-control tab_image','id'=>'tab_image'))}}

                            </div>
                            {!! $errors->first('tab_image', '<span class="help-block">:message</span>') !!}
                        </div>
                    @endslot
                    @endcomponent --}}

                    @component('back.components.boxinputs')
                    @slot('type')
                    primary
                    @endslot
                    @slot('boxTitle')
                    @lang('Description')
                    @endslot
                    <div class="form-group">
                        <input type="text" name="{{'tab_image['.$tabs->id.']['.$key.']'}}" id="{{'tab_image['.$tabs->id.']['.$key.']'}}" value="{{ isset($post_tabs) ? $tabs->tab_image: '' }}" class="form-control tab_image" required="">
                    </div>
                    @endcomponent


                    @include('back.partials.boxinput', [
                        'box' => [
                            'type' => 'box-primary',
                            'title' => __('Long Description'),
                        ],
                        'input' => [
                            'name' => 'tab_body['.$tabs->id.']['.$key.']',
                            'value' => isset($post_tabs) ? $tabs->tab_body : '',
                            'input' => 'textarea',
                            'rows' => 10,
                            'required' => true,
                        ],
                        ])
                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>

        </table>
        @endcomponent

        <a class="btn btn-success btn-xs" style="margin-bottom: 15px;" id='tbl_add' href="javascript:void(0)"><i class="fa fa-plus"></i></a>
        <a class="btn btn-danger btn-xs" style="margin-bottom: 15px;" id='tbl_rem' href="javascript:void(0)"><i class="fa fa-minus"></i></a>

    </div>

    @include('back.partials.boxinput', [
        'box' => [
            'type' => 'box-primary',
            'title' => __('Status'),
        ],
        'input' => [
            'name' => 'active',
            'value' => isset($post) ? $post->active : true,
            'input' => 'checkbox',
            'label' => __('Active'),
        ],
        ])
        <button type="submit" class="btn btn-primary" id="submitPost">@lang('Submit')</button>
        <a href="{{route('posts.index')}}" class="btn btn-default">@lang('Cancel')</a>

    </div>
</div>
<!-- /.row -->
</form>

@endsection

@section('js')

<script src="{{ asset('adminlte/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
{{-- <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script> --}}
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script> --}}
{{-- <script src="https://ckeditor.com/apps/ckfinder/3.4.5/ckfinder.js"></script> --}}
{{-- <script src="{{ asset('adminlte/plugins/ckeditor/config.js') }}" type="text/javascript"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" type="text/javascript"></script>

<script>

 $(document).ready(function() {

    var date = new Date();
    $('#datePicker')
    .datepicker({
        format: 'dd/mm/yyyy',
        endDate: date
    })
});

 $(document).ready(function() {
    var date = new Date();
    $('#datePicker1')
    .datepicker({
        format: 'dd/mm/yyyy',
        startDate: date
    })
});

 $(document).ready(function() {
    var date = new Date();
    $('#datePicker2')
    .datepicker({
        format: 'dd/mm/yyyy',
        startDate: date
    })
});

 $(document).ready(function() {
    $('#timepicker1').timepicker();
});

 var actual_parent_slug = '{{$actual_parent_slug}}';
 var actual_sub_slug = '{{$actual_sub_slug}}';
 var actual_parent_menu = '{{$actual_parent_menu}}';
 var actual_sub_menu = '{{$actual_sub_menu}}';
 var actual_child_menu = '{{$actual_child_menu}}';
 var actual_sub_child_menu = '{{$actual_sub_child_menu}}';
 var actual_event_date = '{{$actual_event_date}}';
 var actual_event_time = '{{$actual_event_time}}';
 var actual_event_to_date = '{{$actual_event_to_date}}';
 var actual_brochure = '{{$actual_brochure}}';
 var post_tabs = '{{$post_tabs}}';
 var title1 = '{{$title1}}';
 var title2 = '{{$title2}}';

// CKEDITOR.replace( 'body', {filebrowserBrowseUrl: '/tinyfilemanager.php'})
CKEDITOR.replace('body', {filebrowserBrowseUrl: '/ckfinder/ckfinder.html'})
// CKEDITOR.replace('body', {filebrowserBrowseUrl: '/elfinder/ckeditor'})

CKEDITOR.replace('body1', {filebrowserBrowseUrl: '/elfinder/ckeditor'})

CKEDITOR.replace('body2', {filebrowserBrowseUrl: '/elfinder/ckeditor'})

 @if(isset($tab_id))
 var tabKeyVal = {{$tab_id}};
 $.each(tabKeyVal, function( index, value ) {
   CKEDITOR.replace('tab_body['+value+']['+index+']', {filebrowserBrowseUrl: '/elfinder/ckeditor'})
});
 @else
 CKEDITOR.replace('tab_body[0]', {filebrowserBrowseUrl: '/elfinder/ckeditor'})
 @endif

 $('.popup_selector').click( function (event) {
  event.preventDefault()
  var updateID = $(this).attr('data-inputid')
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

 $('.popup_selector_banner').click( function (event) {
  event.preventDefault()
  var updateID = $(this).attr('data-inputid_banner')
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
   if(requestingField == 'banner_image')
   {
       $('#imgBanner').attr('src', '\\' + 'storage/' +filePath)
   }
   else if(requestingField == 'image')
   {
     $('#img').attr('src', '\\' + 'storage/' +filePath)
 }
 else if(requestingField == 'icon')
 {
     $('#icons').attr('src', '\\' + 'storage/' +filePath)
 }
 else if(requestingField == 'tab_image')
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


$('#excerpt').attr('maxlength','110');

</script>


<script src="{{ asset('js/post.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('adminlte/js/back.js') }}"></script>

@endsection
