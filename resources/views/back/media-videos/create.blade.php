@extends('back.layout')

@section('css')
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
<style>
    textarea { resize: vertical; }
    .hide { display:none; }
</style>
<link rel="stylesheet" href="/adminlte/image-drop-zone/dropzone.css" />
@endsection

@section('main')
<form method="post" action="" id="create-video">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12">
                <h4><b> {{ $album->title }} </b></h4>
               <input type="hidden" name="album_id" value="{{$album->id}}">
                <div class="box">
                    <div class="box-header with-border">
                        <div id="spinner" class="text-center"></div>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="videos" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th style="display:none;">#</th>
                                <th>@lang('Video Link')</th>
                                {{--  <th>@lang('Creation')</th>  --}}
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="pannel">
                                @if(isset($media_videos) && (count($media_videos)>0))
                                    @foreach($media_videos as $video)
                                    <tr>
                                            <td style="display:none;"><input type="hidden" name="content_id[]" value="{{$video->id}}" class="link_id"> </td>
                                            <td><textarea id="description" class="form-control" name="description[]">{{$video->filename}}</textarea></td>
                                            <td><a class="btn btn-danger btn-sm remove-link" href="javascript:void(0)" role="button" title="@lang('Destroy Video Link')"><span class="fa fa-remove"></span></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                        <td style="display:none;"><input type="hidden" name="content_id[]" value="0" class="link_id"></td>
                                        <td><textarea id="description" class="form-control" name="description[]"></textarea></td>
                                        <td id="remove" class="hide"><a class="btn btn-danger btn-sm remove-link" href="javascript:void(0)" role="button" title="@lang('Destroy Video Link')"><span class="fa fa-remove"></span></a></td>
                                    </tr>
                                @endif
                                
                            </tbody>
                        </table>
                        <a href="javascript:void(0);" id='tbl_add' class="btn btn-success btn-sm" role="button" title="@lang('Add New Link')"><span class="fa fa-plus"></span></a>
                    </div>
                </div>
                <div align="right">
                <a href="javascript:void(0)" id="submit" class="btn btn-primary">@lang('Submit')</a></div>
            </div>

        </div>
        <!-- /.row -->
    </form>
@endsection

@section('js')

<script src="/adminlte/image-drop-zone/dropzone.js"></script>
<script src="{{ asset('adminlte/js/back.js') }}"></script>
    <script>

        $(document).on('click','#tbl_add',function(){
             var clonedRow = $("#videos tr").last().clone();
             $('#videos').last().append(clonedRow);
             $('#videos tr').last().find('#description').val('');
             $('#videos tr').last().find('.link_id').val('0');
             $('#videos tr').last().find('#remove').removeClass('hide');
        });

        $(document).on('click','.remove-link', function(){
            var rowCount=0;
            if($('#videos tr').length>2){
                var rowCount = 1;
            }
            var Id = $(this).parent().parent().find('.link_id').val();
            var closest_tr = $(this).closest('tr');
            var filename = $(this).parent().parent().find('.description');
            if(Id==0){
                closest_tr.remove();
                return false;
              }
              swal({
                title: '@lang('Really destroy link ?')',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: '@lang('Yes')',
                cancelButtonText: '@lang('No')'
              }).then(function () {
                back.spin()
                $.ajax({
                    url: '{{ route('media-videos.remove') }}',
                    data:{id:Id, row_count:rowCount},
                    type: 'POST'
                })
                    .done(function (message) {
                        back.unSpin()
                        if(message.rowCount==0){
                            location.reload();
                        }else{
                            closest_tr.remove();
                        }
                    })
                    .fail(function () {
                        back.fail('@lang('Looks like there is a server issue...')')
                    }
                )
            })
        });

        $(document).on('click', '#submit', function() {
            var data = $('#create-video').serialize();
            $.ajax({
                url: '{{ route('videos.store') }}',
                data:data,
                type: 'POST'
            })
                .done(function (message) {
                    back.unSpin()
                    location.reload();
                })
                .fail(function () {
                    back.fail('@lang('Looks like there is a server issue...')')
                }
            )
        });
    </script>
@endsection