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
                'title' => __('Name'),
            ],
            'input' => [
                'name' => 'name',
                'value' => isset($dealer) ? $dealer->name : '',
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
                'value' => isset($dealer) ? $dealer->excerpt : '',
                'input' => 'textarea',
                'rows' =>2,
                'required' => false,
            ],
            ])
     
            @include('back.partials.boxinput', [
        'box' => [
            'type' => 'box-primary',
            'title' => __('Verified'),
        ],
        'input' => [
            'name' => 'is_verified',
            'value' => isset($dealer) ? $dealer->is_verified : true,
            'input' => 'checkbox',
            'label' => __('Yes'),
        ],
        ])
      

            </div>

            <div class="col-md-4">   

{{-- @component('back.components.box')
@slot('type')
info
@endslot
@slot('boxTitle')
SEO Details
@endslot
@include('back.partials.input', [
    'input' => [
        'name' => 'seo_title',
        'value' => isset($dealer) ? $dealer->seo_title : '',
        'input' => 'text',
        'title' => __('META Title'),
        'required' => true,
    ],
    ])
@include('back.partials.input', [
    'input' => [
        'name' => 'meta_description',
        'value' => isset($dealer) ? $dealer->meta_description : '',
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
        'value' => isset($dealer) ? $dealer->meta_keywords : '',
        'input' => 'text',
        'title' => __('META Keywords'),
        'input' => 'textarea',
        'rows' => 2,
        'required' => true,
    ]
    ])
    @endcomponent --}}


<div class="image">
    @component('back.components.box')
    @slot('type')
    primary
    @endslot
    @slot('boxTitle')
    @lang('Dealer Image')
    @endslot
    <img id="img" src="@isset($dealer) {{ $dealer->image }} @endisset" alt="" class="img-responsive img-fluid">
    @slot('footer')
    <div class="{{ $errors->has('image') ? 'has-error' : '' }}">
        <div class="input-group">
            <div class="input-group-btn">
                <a href="" class="popup_selector btn btn-primary" data-inputid="image">@lang('Select an image')</a>
            </div>
            <!-- /btn-group -->
            <input class="form-control" type="text" id="image" name="image" value="{{ old('image', isset($dealer) ? $dealer->image : '') }}">
        </div>
        {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
    </div>
    @endslot
    @endcomponent
</div>

<div class="">

 @component('back.components.box')
       @slot('type')
       primary
       @endslot
       @slot('boxTitle')
       Dealer Info
       @endslot

       <div class="form-group">
        <label for="menus">Mobile Number</label>
    <div class="input-group input-append mb-3" style="width: 100%">
        <input class="form-control" type="number" name="mobile_number" value="{{isset($dealer) ? $dealer->mobile_number : ''}}">
    </div>

    <div class="form-group">
        <label for="menus">Address</label>
    <div class="input-group input-append mb-3" style="width: 100%">
    <textarea class="form-control" name="address" row=5>{{isset($dealer) ? $dealer->address : ''}}</textarea>
    </div>

</div>
@endcomponent
</div>
</div>
    
</div>
</div>

<div class="col-md-8">   

    @include('back.partials.boxinput', [
        'box' => [
            'type' => 'box-primary',
            'title' => __('Status'),
        ],
        'input' => [
            'name' => 'active',
            'value' => isset($dealer) ? $dealer->active : true,
            'input' => 'checkbox',
            'label' => __('Active'),
        ],
        ])
        <button type="submit" class="btn btn-primary" id="submitPost">@lang('Submit')</button>
        <a href="{{route('dealers.index')}}" class="btn btn-default">@lang('Cancel')</a>

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


CKEDITOR.replace('body', {filebrowserBrowseUrl: '/ckfinder/ckfinder.html'})

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
     $('#img').attr('src', '\\' + 'storage/' +filePath)

}

$('#slug').keyup(function () {
  $(this).val(v.slugify($(this).val()))
})

$('#title').keyup(function () {
  $('#slug').val(v.slugify($(this).val()))
})


$('#excerpt').attr('maxlength','110');

</script>


<!-- <script src="{{ asset('js/event.js') }}"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('adminlte/js/back.js') }}"></script>

@endsection
