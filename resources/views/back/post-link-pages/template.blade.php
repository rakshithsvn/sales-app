@extends('back.layout')

@section('css')
<style>
    textarea { resize: vertical; }
</style>
<link href="{{ asset('adminlte/plugins/colorbox/colorbox.css') }}" rel="stylesheet">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

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
                'required' => true,
            ],
            ])

            <div class="body">
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Long Description'),
                    ],
                    'input' => [
                        'name' => 'body',
                        'value' => isset($post) ? $post->body : '',
                        'input' => 'textarea',
                        'rows' => 10,
                        'required' => true,
                    ],
                    ])
                </div>

            </div>

            <div class="col-md-4">

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
                    'rows' => 3,
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
                    'rows' => 3,
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

            </div>

            <div class="col-md-8">

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

                <div class="tabContent">
                    @component('back.components.box')
                    @slot('type')
                    primary
                    @endslot
                    @slot('boxTitle')
                    Tab Section Content
                    @endslot

                    <table class="table table-bordered table-hover custom_table" id="custom_table">
                        <thead>

                            <tbody id="tbl1">
                               @if(empty($post_tabs))
                               <tr>
                                <td>


                                   @include('back.partials.boxinput', [
                                       'box' => [
                                        'type' => 'box-primary',
                                        'title' => __('Tab Title'),
                                    ],
                                    'input' => [
                                        'name' => 'tab_title[0]',
                                        'value' => isset($post_tabs) ? $post_tabs[0]->tab_title: '',
                                        'input' => 'text',
                                        'required' => true,
                                    ],
                                    ])

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
                                    @include('back.partials.boxinput', [
                                       'box' => [
                                        'type' => 'box-primary',
                                        'title' => __('Tab Title'),
                                    ],
                                    'input' => [
                                        'name' => 'tab_title['.$tabs->id.']['.$key.']',
                                        'value' => isset($post_tabs) ? $tabs->tab_title: '',
                                        'input' => 'text',
                                        'required' => true,
                                    ],
                                    ])

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
                        <a href="{{route('post-link-pages.index')}}" class="btn btn-default">@lang('Cancel')</a>

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

                var post_tabs = '{{$post_tabs}}';
                CKEDITOR.replace('body', {customConfig: '/adminlte/js/ckeditor.js'})

                @if(isset($tab_id))
                var tabKeyVal = {{$tab_id}};
                $.each(tabKeyVal, function( index, value ) {
                   CKEDITOR.replace('tab_body['+value+']['+index+']', {customConfig: '/adminlte/js/ckeditor.js'})
               });
                @endif
                CKEDITOR.replace('tab_body[0]', {customConfig: '/adminlte/js/ckeditor.js'})


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

           <script src="{{ asset('js/link-page.js') }}" type="text/javascript"></script>
           <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

           @endsection
