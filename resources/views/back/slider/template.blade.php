@extends('back.layout')

@section('css')
<style>
    textarea { resize: vertical; }
</style>
<link href="{{ asset('adminlte/plugins/colorbox/colorbox.css') }}" rel="stylesheet">
@endsection

@section('main')

    @yield('form-open')
        {{ csrf_field() }}

        <div class="row">

            <div class="col-md-12">

                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Title'),
                    ],
                    'input' => [
                        'name' => 'title',
                        'value' => isset($sliders) ? $sliders->title : '',
                        'input' => 'text',
                        'required' => false,
                    ],
                ])

                <div class="row">
                <div class="col-md-6">
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Hierarchy'),
                    ],
                    'input' => [
                        'name' => 'hierarchy',
                        'value' => isset($sliders) ? $sliders->hierarchy : $hierarchy,
                        'input' => 'text',
                        'required' => false,
                    ],
                ])
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Slug'),
                    ],
                    'input' => [
                        'name' => 'slug',
                        'value' => isset($sliders) ? $sliders->slug : '',
                        'input' => 'text',
                        'required' => false,
                    ],
                ])
            </div>
            <div class="col-md-6">

                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Page Link'),
                    ],
                    'input' => [
                        'name' => 'page_link',
                        'value' => isset($sliders) ? $sliders->page_link : '',
                        'input' => 'text',
                        'required' => false,
                    ],
                ])

            </div>
           </div>
            @component('back.components.box')
                @slot('type')
                    primary
                @endslot
                @slot('boxTitle')
                    @lang('Image')
                @endslot
                <img id="img" src="@isset($sliders) {{ $sliders->image }} @endisset" alt="" width="150px" height="150px" class="img-responsive img-fluid">
                @slot('footer')
                    <div class="{{ $errors->has('image') ? 'has-error' : '' }}">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <a href="" class="popup_selector btn btn-primary" data-inputid="image">@lang('Select an image')</a>
                            </div>
                            <!-- /btn-group -->
                            <input class="form-control" type="text" id="image" name="image" value="{{ old('image', isset($sliders) ? $sliders->image : '') }}">
                        </div>
                        {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
                    </div><br/>
                @endslot
            @endcomponent


                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Short Description'),
                    ],
                    'input' => [
                        'name' => 'excerpt',
                        'value' => isset($sliders) ? $sliders->excerpt : '',
                        'input' => 'textarea',
                        'rows' => 3,
                        'required' => true,
                    ],
                ])

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'active',
                        'value' => isset($sliders) ? $sliders->active : true,
                        'input' => 'checkbox',
                        'title' => __('Status'),
                        'label' => __('Active'),
                    ],
                ])
                <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                 <a href="{{route('sliders.index')}}" class="btn btn-default">@lang('Cancel')</a>
            </div>

        </div>
        <!-- /.row -->
    </form>

@endsection

@section('js')

<script src="{{ asset('adminlte/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>
<!-- <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> -->
<script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script>

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

            function processSelectedFile(filePath, requestingField) {
                $('#' + requestingField).val('\\' + 'storage/' + filePath)
                $('#img').attr('src', '\\' + 'storage/' + filePath)
            }

        $('#slug').keyup(function () {
            $(this).val(v.slugify($(this).val()))
        })

        $('#slug').parent().parent().parent().hide();
        $('#hierarchy').prop('readonly', true);

        $('#title').keyup(function () {
            $('#slug').val(v.slugify($(this).val()))
        })

    </script>

@endsection
