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

       {{--  @component('back.components.boxinputs')
        @slot('type')
        primary
        @endslot
        @slot('boxTitle')
        Branch
        @endslot

        <select id="branch" name="branch" class="form-control" required="">
            @foreach($branch_list as $id => $branch)
            <option value="{{ $id }}" {{(@$address_details->branch == $id)? 'selected' : ''}}>{{ $branch }}</option>
            @endforeach
        </select><br/>

        <select id="post_id" name="post_id" class="form-control" required="">
            <option value="">--- Select Department ---</option>
            @foreach($post_list as $id => $post_id)
            <option value="{{ $post_id->id }}" {{(@$address_details->post_id == $post_id->id)? 'selected' : ''}}>{{ $post_id->title }}</option>
            @endforeach
        </select><br/>

        @endcomponent   --}}


        @component('back.components.box')
        @slot('type')
        primary
        @endslot
        @slot('boxTitle')
        Name
        @endslot

            @include('back.partials.input', [
                'input' => [
                    'name' => 'name',
                    'value' => isset($address_details) ? $address_details->name : '',
                    'input' => 'text',
                    'required' => false,
                ]
                ])

            @endcomponent


        @component('back.components.box')
        @slot('type')
        primary
        @endslot
        @slot('boxTitle')
        Email
        @endslot
        <div class="col-md-12">
            @include('back.partials.input', [
                'input' => [
                    'name' => 'email',
                    'value' => isset($address_details) ? $address_details->email : '',
                    'input' => 'text',
                    'required' => false,
                ]
                ])
            </div>
          {{--   <div class="col-md-6">
             @include('back.partials.input', [
                'input' => [
                    'name' => 'email1',
                    'value' => isset($address_details) ? $address_details->email1 : '',
                    'input' => 'text',
                    'required' => false,
                ]
                ])

            </div> --}}
            @endcomponent

            @component('back.components.box')
            @slot('type')
            primary
            @endslot
            @slot('boxTitle')
            Phone
            @endslot
            <div class="col-md-12">
                @include('back.partials.input', [
                    'input' => [
                        'name' => 'phone',
                        'value' => isset($address_details) ? $address_details->phone : '',
                        'input' => 'text',
                        'required' => false,
                    ]
                    ])
                </div>
              {{--   <div class="col-md-6">
                 @include('back.partials.input', [
                    'input' => [
                        'name' => 'phone1',
                        'value' => isset($address_details) ? $address_details->phone1 : '',
                        'input' => 'text',
                        'required' => false,
                    ]
                    ])

                </div> --}}
                @endcomponent



              {{--   @component('back.components.box')
                    @slot('type')
                        primary
                    @endslot
                    @slot('boxTitle')
                        @lang('Country Flag')
                    @endslot
                    <img id="img" src="@isset($address_details) {{ $address_details->image }} @endisset" alt="" width="150px" height="150px" class="img-responsive img-fluid">
                    @slot('footer')
                        <div class="{{ $errors->has('image') ? 'has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <a href="" class="popup_selector btn btn-primary" data-inputid="image">@lang('Select an image')</a>
                                </div>
                                <!-- /btn-group -->
                                <input class="form-control" type="text" id="image" name="image" value="{{ old('image', isset($address_details) ? $address_details->image : '') }}">
                            </div>
                            {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
                        </div>
                    @endslot
                    @endcomponent   --}}

                    @include('back.partials.boxinput', [
                        'box' => [
                            'type' => 'box-primary',
                            'title' => __('Address'),
                        ],
                        'input' => [
                            'name' => 'address',
                            'value' => isset($address_details) ? $address_details->address : '',
                            'input' => 'textarea',
                            'rows' => 10,
                            'required' => true,
                        ],
                        ])

                        <button type="submit" class="btn btn-primary" id="submitPost">@lang('Submit')</button>
                        <a href="{{route('address.index')}}" class="btn btn-default">@lang('Cancel')</a>


                    </div>


                    @endsection


                    @section('js')

                    <script src="{{ asset('adminlte/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
                    <script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>
                    <!-- <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> -->
                    <script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
                    <script>

                        // var branch = '{{ isset($address_details->branch) ? $address_details->branch : ''  }}';

                        // $(document).ready(function() {
                        // $('#post_id').hide();
                        // if(branch)
                        // {
                        //     if(branch == 'DEPARTMENT')
                        //     {
                        //         $('#post_id').show();
                        //     }
                        //     else
                        //     {
                        //         $('#post_id').hide();
                        //     }
                        // }
                        // });

                        CKEDITOR.replace('address', {customConfig: '/adminlte/js/ckeditor.js'})

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

                        $('#title').keyup(function () {
                            $('#slug').val(v.slugify($(this).val()))
                        })

                        $('#branch').change(function(e) {
                            var id = $(this).val();

                            if(id == 'DEPARTMENT')
                            {
                                $('#post_id').show();
                            }
                            else
                            {
                                $('#post_id').hide();
                            }
                        });


                    </script>
                    <script src="{{ asset('js/faculty.js') }}" type="text/javascript"></script>

                    @endsection
