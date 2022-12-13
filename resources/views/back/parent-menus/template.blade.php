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
                'title' => __('Menu Name'),
            ],
            'input' => [
                'name' => 'name',
                'value' => isset($parentmenus) ? $parentmenus->name : '',
                'input' => 'text',
                'required' => true,
            ],
            ])

            <div class="row">
                <div class="col-md-6">
                    @component('back.components.box')
                    @slot('type')
                    primary
                    @endslot
                    @slot('boxTitle')
                    More
                    @endslot

                    <div class="form-group">

                       <select id="more" name="more" value="" class="form-control" required="true">
                        @foreach($menu_option as $id => $option)
                        <option value="{{ $id }}" {{(@$parentmenus->more == $id)? 'selected' : ''}}>{{ $option }}</option>
                        @endforeach
                    </select>

                </div>
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('back.components.box')
                @slot('type')
                primary
                @endslot
                @slot('boxTitle')
                Post Entry
                @endslot

                <div class="form-group">

                   <select id="post_entry" name="post_entry" value="" class="form-control" required="true">
                    @foreach($menu_option as $id => $option)
                    <option value="{{ $id }}" {{(@$parentmenus->post_entry == $id)? 'selected' : ''}}>{{ $option }}</option>
                    @endforeach
                </select>

            </div>
            @endcomponent
        </div>
    </div>

    @component('back.components.box')
    @slot('type')
    primary
    @endslot
    @slot('boxTitle')
    Layout Name
    @endslot

    <div class="form-group">

       <select id="layout_name" name="layout_name" value="" class="form-control" required="true">
        @foreach($layouts as $option)
        <option value="{{ $option }}" {{(@$parentmenus->layout_name == $option)? 'selected' : ''}}>{{ $option }}</option>
        @endforeach
    </select>

</div>
@endcomponent

{{-- <input type="hidden" name="sub_menu" value="N"> --}}

@component('back.components.box')
@slot('type')
primary
@endslot
@slot('boxTitle')
Status
@endslot


@include('back.partials.input', [
    'input' => [
        'name' => 'status',
        'value' => isset($parentmenus) ? $parentmenus->status : true,
        'input' => 'checkbox',
        'label' => __('Active'),
    ],
    ])
    @endcomponent

</div>

<div class="col-md-4">

    @component('back.components.box')
    @slot('type')
    primary
    @endslot
    @slot('boxTitle')
    Display Parent Menu
    @endslot

    <div class="form-group">

     <select id="display_menu" name="display_menu" value="" class="form-control" required="true">
         @foreach($menu_option as $id => $option)
         <option value="{{ $id }}" {{(@$parentmenus->display_menu == $id)? 'selected' : ''}}>{{ $option }}</option>
         @endforeach
     </select>


 </div>
 @endcomponent

 @component('back.components.box')
 @slot('type')
 primary
 @endslot
 @slot('boxTitle')
 Sub Menu
 @endslot

 <div class="form-group">

     <select id="sub_menu" name="sub_menu" value="" class="form-control" required="true">
         @foreach($menu_option as $id => $option)
         <option value="{{ $id }}" {{(@$parentmenus->sub_menu == $id)? 'selected' : ''}}>{{ $option }}</option>
         @endforeach
     </select>

 </div>
 @endcomponent

 @include('back.partials.boxinput', [
    'box' => [
        'type' => 'box-primary',
        'title' => __('Hierarchy'),
    ],
    'input' => [
        'name' => 'hierarchy',
        'value' => isset($parentmenus) ? $parentmenus->hierarchy : '',
        'input' => 'text',
        'required' => true,
    ],
    ])


    @component('back.components.box')
    @slot('type')
    primary
    @endslot
    @slot('boxTitle')
    External Link
    @endslot


    @include('back.partials.input', [
        'input' => [
            'name' => 'link_active',
            'id' => 'link_active',
            'value' => isset($parentmenus) ? $parentmenus->link_active : false,
            'input' => 'checkbox',
            'label' => __('Active'),
        ],
        ])
        @endcomponent                

    </div>

    <div class="col-md-8">

       <div id="external">

        @include('back.partials.boxinput', [
            'box' => [
                'type' => 'box-primary',
                'title' => __('External Link'),
            ],
            'input' => [
                'name' => 'link',
                'id' => 'link',
                'value' => isset($parentmenus) ? $parentmenus->link : '',
                'input' => 'text',
                'required' => true,
            ],
            ])
        </div>

        <button type="submit" class="btn btn-primary" id="submitPost">@lang('Submit')</button>
        <a href="{{route('parent-menus.index')}}" class="btn btn-default">@lang('Cancel')</a> 

    </div>

    <!-- /.row -->
</form>

@endsection

@section('js')

<script src="{{ asset('adminlte/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>

<script>

   if($('#link_active').is(':checked')) {
    $('#external').show();
}
else {
    $('#external').hide();
}

$('#link_active').change(function() {

    if(this.checked) {
        $('#external').show();
        $("#child_menu option[value='N']").prop('selected', true);
        $('#link').attr('required',true);
    }
    else {
        $('#external').hide();
        $('#link').val('');
        $('#link').attr('required',false);
    }
});

</script>

<script>     

    $('#slug').keyup(function () {
        $(this).val(v.slugify($(this).val()))
    })

    $('#slug').parent().parent().parent().hide();


    $('#title').keyup(function () {
        $('#slug').val(v.slugify($(this).val()))
    })


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



<script src="{{ asset('js/sub-menu.js') }}" type="text/javascript"></script>

@endsection