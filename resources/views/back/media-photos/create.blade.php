@extends('back.layout')

@section('css')
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
<style>
    textarea { resize: vertical; }
    .img-height{height: 150px; width: 150px; margin: 5px 0 5px 0; overflow: hidden;}
</style>
<link rel="stylesheet" href="/adminlte/image-drop-zone/dropzone.css" />
@endsection

@section('button')
{{-- <a class="btn btn-primary" href="{{route('placement.create')}}">@lang('Placement Statistics')</a> --}}
@endsection

@section('main')
{{ csrf_field() }}

<div class="row">
    <div class="col-md-12">
        <h4><b> Gallery </b></h4>

        <div align="right" style="padding: 0px 20px 20px 0px">
            <a href="" id="refresh" type="reset" class="btn btn-sm btn-warning close_popup">
                <span class="glyphicon glyphicon-save"></span>  Save
            </a>
        </div>

        <div class="">
            <form action="{{ route('media-photos.storeAlbum', [$album]) }}" method="post" class="dropzone" >
                {{ csrf_field() }}

{{--                         <select id="post_id" name="post_id" class="form-control" required="true">
                          @foreach($project_page as $id => $post_id)
                          <option value="{{ $id }}" {{($actual_project_page == $id)? 'selected' : ''}}>{{ $post_id }}</option>
                          @endforeach
                      </select> --}}

                  </form>
                  <textarea id="description" name="description" hidden></textarea>
              </div>

              @if(isset($media_photos))
              <?php $image_lists = explode(',',$media_photos->filename) ?>
              @foreach($image_lists as $image_list)
              @if($image_list!='')
              <div class="col-lg-2 thumb">
                  <div class="img-height">
                    <span class="thumbnail">
                        <span class="glyphicon glyphicon-remove removephoto" filename="{{ $image_list }}"  id="{{ $media_photos->id }}">Remove</span>
                        {{--<div class="thumbnail_title">Test</div>--}}
                        <img class="img-responsive img-fluid" src="{{ $image_list }}" alt="{{ $image_list }}">
                    </span>
                </div>
            </div>
            @endif
            @endforeach
            @endif

        </div>

    </div>
    <!-- /.row -->
    @endsection

    @section('js')

    <script src="/adminlte/image-drop-zone/dropzone.js"></script>
    <script src="{{ asset('adminlte/js/back.js') }}"></script>
    <script>

        $('#post_id').change(function(e){
            var Id = $(this).val();

        })

        $(document).on('click','#refresh', function(){
            location.reload();
        });

        $(document).on('click','.removephoto',function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var imgRand = $(this).attr('id');
            var fileName = $(this).attr("filename");
            var img = $(this);

            swal({
                title: '@lang('Really destroy image ?')',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: '@lang('Yes')',
                cancelButtonText: '@lang('No')'
            }).then(function () {
                back.spin()
                $.ajax({
                    url: '{{ route('media-photos.remove') }}',
                    data:{id:imgRand,_token: CSRF_TOKEN,filename:fileName},
                    type: 'POST'
                })
                .done(function () {
                    back.unSpin()
                    location.reload();
                })
                .fail(function () {
                    back.fail('@lang('Looks like there is a server issue...')')
                }
                )
            })


        });
    </script>
    @endsection
