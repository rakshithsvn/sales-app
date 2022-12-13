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

            <div class="col-md-8">

                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Name'),
                    ],
                    'input' => [
                        'name' => 'title',
                        'value' => isset($testimonials) ? $testimonials->title : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ])

                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Description'),
                    ],
                    'input' => [
                        'name' => 'designation',
                        'value' => isset($testimonials) ? $testimonials->designation : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ])



                @component('back.components.box')
                    @slot('type')
                        primary
                    @endslot
                    @slot('boxTitle')
                        @lang('Thumb Image')
                    @endslot
                    <img id="img" src="@isset($testimonials) {{ $testimonials->image }} @endisset" alt="" class="img-responsive img-fluid">
                    @slot('footer')
                        <div class="{{ $errors->has('image') ? 'has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <a href="" class="popup_selector btn btn-primary" data-inputid="image">@lang('Select an image')</a>
                                </div>
                                <!-- /btn-group -->
                                <input class="form-control" type="text" id="image" name="image" value="{{ old('image', isset($testimonials) ? $testimonials->image : '') }}">
                            </div>
                            {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
                        </div>
                    @endslot
                @endcomponent


                {{--@component('back.components.box')
                    @slot('type')
                        primary
                    @endslot
                    @slot('boxTitle')
                        @lang('Banner Image')
                    @endslot
                    <img id="imgBanner" src="@isset($testimonials) {{ $testimonials->banner_image }} @endisset" alt="" class="img-responsive img-fluid">
                    @slot('footer')
                        <div class="{{ $errors->has('banner_image') ? 'has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <a href="" class="popup_selector_banner btn btn-primary" data-inputid_banner="banner_image">@lang('Select an image')</a>
                                </div>
                                <!-- /btn-group -->
                                <input class="form-control" type="text" id="banner_image" name="banner_image" value="{{ old('banner_image', isset($testimonials) ? $testimonials->banner_image : '') }}">
                            </div>
                            {!! $errors->first('banner_image', '<span class="help-block">:message</span>') !!}
                        </div>
                    @endslot
                @endcomponent --}}

                 @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Message'),
                    ],
                    'input' => [
                        'name' => 'body',
                        'value' => isset($testimonials) ? $testimonials->body : '',
                        'input' => 'textarea',
                        'rows' => 5,
                        'required' => true,
                    ],
                ])



                @include('back.partials.input', [
                    'input' => [
                        'name' => 'active',
                        'value' => isset($testimonials) ? $testimonials->active : true,
                        'input' => 'checkbox',
                        'title' => __('Status'),
                        'label' => __('Active'),
                    ],
                ])
                <button type="submit" class="btn btn-primary">@lang('Submit')</button>

                <a href="{{route('testimonials.index')}}" class="btn btn-default">@lang('Cancel')</a>

            </div>
            {{-- <div class="col-md-4">
             @component('back.components.boxinputs')
                    @slot('type')
                        primary
                    @endslot
                    @slot('boxTitle')
                        @lang('Testimonial Type')
                    @endslot
                <select id="type" name="type" class="form-control" required="">
                     <option value="">--Select--</option>
                     @foreach(@$type_list as $id => $type)
                     <option value="{{$id}}" {{(@$testimonials->type == $id) ? 'selected' : ''}}>{{$type}}</option>
                     @endforeach
                </select><br/>
                @endcomponent
            </div> --}}
            </div>

    </form>

@endsection

@section('js')

<script src="{{ asset('adminlte/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>
<!-- <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> -->
<script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script>

    // CKEDITOR.replace('body', {customConfig: '/adminlte/js/ckeditor.js'})

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





$('#excerpt').attr('maxlength','300');
    </script>
    <script src="{{ asset('js/faculty.js') }}" type="text/javascript"></script>

@endsection
