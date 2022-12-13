@extends('back.layout')

@section('css')
<style>
    textarea { resize: vertical; }
</style>
<link href="{{ asset('adminlte/plugins/colorbox/colorbox.css') }}" rel="stylesheet">
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
@endsection

@section('main')

    @yield('form-open')
        {{ csrf_field() }}

        <div class="row">

            <div class="col-md-12">

                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Post Name'),
                    ],
                    'input' => [
                        'name' => 'title',
                        'value' => isset($careers) ? $careers->title : '',
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
                        'value' => isset($careers) ? $careers->excerpt : '',
                        'input' => 'textarea',
                        'rows' => 3,
                        'required' => false,
                    ],
                ])


                @component('back.components.box')
                    @slot('type')
                        primary
                    @endslot
                    @slot('boxTitle')
                        @lang('Banner Image')
                    @endslot
                    <img id="imgBanner" src="@isset($careers) {{ $careers->banner_image }} @endisset" alt="" class="img-responsive img-fluid">
                    @slot('footer')
                        <div class="{{ $errors->has('banner_image') ? 'has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <a href="" class="popup_selector_banner btn btn-primary" data-inputid_banner="banner_image">@lang('Select an image')</a>
                                </div>
                                <!-- /btn-group -->
                                <input class="form-control" type="text" id="banner_image" name="banner_image" value="{{ old('banner_image', isset($careers) ? $careers->banner_image : '') }}">
                            </div>
                            {!! $errors->first('banner_image', '<span class="help-block">:message</span>') !!}
                        </div>
                    @endslot
                @endcomponent



                 @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Long Description'),
                    ],
                    'input' => [
                        'name' => 'body',
                        'value' => isset($careers) ? $careers->body : '',
                        'input' => 'textarea',
                        'rows' => 10,
                        'required' => false,
                    ],
                ])



                @include('back.partials.input', [
                    'input' => [
                        'name' => 'active',
                        'value' => isset($careers) ? $careers->active : true,
                        'input' => 'checkbox',
                        'title' => __('Status'),
                        'label' => __('Active'),
                    ],
                ])
                <button type="submit" class="btn btn-primary">@lang('Submit')</button>

                <a href="{{route('careers.index')}}" class="btn btn-default">@lang('Cancel')</a>

            </div>

    </form>

@endsection

@section('js')

<script src="{{ asset('adminlte/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>
<!-- <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> -->
<script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script>

    CKEDITOR.replace('body', {customConfig: '/adminlte/js/ckeditor.js'})

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

        function processSelectedFile(filePath, requestingField) {
            $('#' + requestingField).val('\\' + 'storage/' +filePath)
            if(requestingField == 'banner_image')
            {
                 $('#imgBanner').attr('src', '\\' + 'storage/' +filePath)
            }
            else
            {
                 $('#img').attr('src', '\\' + 'storage/' +filePath)
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
    <script src="{{ asset('js/faculty.js') }}" type="text/javascript"></script>

@endsection
