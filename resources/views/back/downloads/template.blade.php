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

               {{-- @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('File Type'),
                    ],
                    'input' => [
                        'name' => 'title',
                        'value' => isset($prospects) ? $prospects->title : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                    ]) --}}

                    @component('back.components.box')
                    @slot('type')

                    @endslot
                    @slot('boxTitle')
                    File Type
                    @endslot

                    <div class="form-group">                    
                        <select id="title" name="title" class="form-control" required="true">

                         @foreach($file_type as $id => $file)
                         <option value="{{ $id }}"  {{ isset($prospects) ? ($prospects->title == $id)? 'selected' : '' : '' }}>{{ $file }}</option>
                         @endforeach

                     </select>
                 </div>
                 @endcomponent    

                 @if(@$product_list)
                 <div class="study">
                    @component('back.components.box')
                    @slot('type')
                    primary
                    @endslot
                    @slot('boxTitle')
                    Page
                    @endslot

                    <div class="form-group">
                      {{--   <label for="menus">Select Page</label> --}}
                      <select id="post_id" name="post_id" class="form-control">
                        @foreach($product_list as $id => $product)
                            <option value="{{ $id }}" {{ isset($prospects) ? ($prospects->post_id == $id)? 'selected' : '' : '' }}>{{ $product }}</option>
                        @endforeach
                        </select>
                    </div>

               {{--   <div class="form-group">
                    <label for="menus">Material Title</label>
                  
                    <input type="text" name="file_title" id="file_title" class="form-control" value="{{ @$prospects->file_title }}">
                </div> --}}
                @endcomponent  
            </div>    
            @endif  

            @component('back.components.box')
            @slot('type')
            primary
            @endslot
            @slot('boxTitle')
            Upload File
            @endslot

                {{--<div class="form-group">
                    <label for="upload"></label>
                
                <input class="field" name="prospect" type="file" required="required" accept=".jpg, .jpeg, .png, .doc, .docx, .pdf">

            </div>--}}

            @slot('footer')
            <div class="{{ $errors->has('prospect') ? 'has-error' : '' }}">
                <div class="input-group">
                    <div class="input-group-btn">
                        <a href="" class="popup_selector btn btn-primary" data-inputid="prospect_path">@lang('Select a file')</a>
                    </div>
                    <!-- /btn-group -->
                    <input class="form-control" type="text" id="prospect_path" name="prospect_path" value="{{ old('image', isset($prospects) ? $prospects->prospect_path : '') }}" required="required">
                </div>
                {!! $errors->first('prospect', '<span class="help-block">:message</span>') !!}
            </div>
            @endslot
            @endcomponent

            @include('back.partials.boxinput', [
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
                ])
                
                <button type="submit" class="btn btn-primary" id="submit">@lang('Submit')</button>
                <a href="{{route('prospects.index')}}" class="btn btn-default">@lang('Cancel')</a> 
            </div>
        </div>
        <!-- /.row -->
    </form>

    @endsection

    @section('js')
    <script src="{{ asset('adminlte/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>

    <script>

        $('.study').hide();

        @if(@$actual_file_type != null)   
        @if(@$actual_file_type == 'Brochure')      
        $('.study').show();
        @endif       
        @endif    

        $('#title').change(function(){
            if($(this).val() == 'Brochure')
            {
                $('.study').show();
            }
            else
            {
                $('.study').hide();
            }
        })

    </script>
    <script type="text/javascript">
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
        $('#' + requestingField).val('\\' + 'storage/' +filePath)
        $('#img').attr('src', '\\' + 'storage/' +filePath)

    }


</script>

@endsection