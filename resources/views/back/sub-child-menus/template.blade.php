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
                 @component('back.components.box')
                    @slot('type')
                        primary
                    @endslot
                    @slot('boxTitle')
                       Child Menu
                    @endslot

            <div class="form-group">
                         <select id="child_menu_id" name="child_menu_id" value="" class="form-control" required="true">
                                @foreach($child_menus as $id => $child_menu_id)
                                <option value="{{ $id }}" {{($actual_child_menu == $id)? 'selected' : ''}}>{{ $child_menu_id }}</option>
                            @endforeach
                        </select>


                </div>
                @endcomponent


                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Menu Name'),
                    ],
                    'input' => [
                        'name' => 'name',
                        'value' => isset($subchildmenus) ? $subchildmenus->name : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ])

                 @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Hierarchy'),
                    ],
                    'input' => [
                        'name' => 'hierarchy',
                        'value' => isset($subchildmenus) ? $subchildmenus->hierarchy : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ])

                <button type="submit" class="btn btn-primary" id="submitPost">@lang('Submit')</button>

                <a href="{{route('sub-child-menus.index')}}" class="btn btn-default">@lang('Cancel')</a> 

                </div>
                 <div class="col-md-4">

                @component('back.components.box')
                    @slot('type')
                        primary
                    @endslot
                    @slot('boxTitle')
                       Display Menu
                    @endslot

                <div class="form-group">
                     <select id="display_child_menu" name="display_child_menu" value="" class="form-control" required="true">
                            @foreach($display_child_menu as $id => $display_child_menu_id)
                            <option value="{{ $id }}" {{($actual_display_menu == $id)? 'selected' : ''}}>{{ $display_child_menu_id }}</option>
                        @endforeach
                    </select>
                </div>
                @endcomponent

                                  
                @component('back.components.box')
                    @slot('type')
                        primary
                    @endslot
                    @slot('boxTitle')
                       Status
                    @endslot
                 

                @include('back.partials.input', [
                    'input' => [
                        'name' => 'active',
                        'value' => isset($subchildmenus) ? $subchildmenus->active : true,
                        'input' => 'checkbox',
                        'label' => __('Active'),
                    ],
                ])
                 @endcomponent

                

            </div>

            
        <!-- /.row -->
    </form>

    @endsection

    @section('js')

    <script src="{{ asset('adminlte/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>

    <script>
     

        $('#slug').keyup(function () {
            $(this).val(v.slugify($(this).val()))
        })

        $('#slug').parent().parent().parent().hide();
       

        $('#title').keyup(function () {
            $('#slug').val(v.slugify($(this).val()))
        })

        $(document).on('click','#submitPost',function(){
 
            var parent_menu_value = $("#child_menu_id").val();
            if(parent_menu_value == 0)
            {
                swal('Please select the Child menu');
                 return false;
            }

  });

         var route = '{{$route}}';


     if(route == 'edit')
        {
            var menu_id = '{{$menu_id}}';
        }


        $('#hierarchy').keypress(function (e){

        var value = $("#hierarchy").val();

             if (e.which != 8 && e.which != 0 && e.which!=127 && (e.which < 48 || e.which > 57)) {

                       return false;
            }
            if (e.which == 8 || e.which == 46 || e.which == 37 || e.which == 39) {
                return true;
            }
            if(value.length>=2)
            {
                       return false;
            }

});


    </script>

        <script src="{{ asset('js/sub-child-menu.js') }}" type="text/javascript"></script>
    

@endsection