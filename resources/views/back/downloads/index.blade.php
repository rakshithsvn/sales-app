@extends('back.layout')

@section('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
    <style>
        input, th span {
            cursor: pointer;
        }
    </style>
@endsection

@section('button')
    <a class="btn btn-primary" href="{{ route('prospects.create') }}"><span class="fa fa-plus" aria-hidden="true"></span> @lang('Upload New File')</a>
@endsection

@section('main')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header with-border">
                      <input type="text" class="pull-right" id="searchContent">
               {{--  <strong>@lang('Status') :</strong> &nbsp;
                    <input type="checkbox" name="new" @if(request()->new) checked @endif> @lang('New')&nbsp;
                    <input type="checkbox" name="active" @if(request()->active) checked @endif> @lang('Active')&nbsp;--}}

                    <div id="spinner" class="text-center"></div>
                </div>
                <div class="box-body table-responsive">
                    <table id="users" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="display:none;">#</th>
                            <th>@lang('Title')</th>
                            <th>@lang('Product')</th>
                            <th>@lang('Active')</th>
                            <th>@lang('Creation')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        
                        <tbody id="pannel">

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
                            @include('back.downloads.table', compact('prospects'))
                        </tbody>
                    </table>
                    <div class="pull-right">
                    {!! $prospects->render() !!}
                    </div>
                </div>

                

            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection

@section('js')
<script src="{{ asset('adminlte/js/back.js') }}"></script>
<script>

    var post = (function () {
        var url = '{{ route('prospects.index') }}'
        var swalTitle = '@lang('Really destroy the file ?')'
        var confirmButtonText = '@lang('Yes')'
        var cancelButtonText = '@lang('No')'
        var errorAjax = '@lang('Looks like there is a server issue...')'

        var onReady = function () {
            $('#pagination').on('click', 'ul.pagination a', function (event) {
                back.pagination(event, $(this), errorAjax)
            })
            $('#pannel').on('change', ':checkbox[name="status"]', function () {
                    back.status(url, $(this), errorAjax)
                })
                .on('click', 'td a.btn-danger', function (event) {
                    event.preventDefault()
                    var target = $(this).attr('href');
                    var closest_tr = $(this).closest('tr');
                    swal({
                        title: swalTitle,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: confirmButtonText,
                        cancelButtonText: cancelButtonText
                    }).then(function () {
                        back.spin()
                        $.ajax({
                            url: target,
                            type: 'DELETE'
                        })
                            .done(function () {
                                back.unSpin()
                                closest_tr.remove();
                            })
                            .fail(function () {
                                back.fail('@lang('Looks like there is a server issue...')')
                            }
                        )
                    })
                })
            $('th span').click(function () {
                back.ordering(url, $(this), errorAjax)
            })
            $('.box-header :radio, .box-header :checkbox').click(function () {
                back.filters(url, errorAjax)
            })
             $(document).on('keyup', '#searchContent', function (event) {
                    back.search(url, $(this), errorAjax)
                })
        }

        return {
            onReady: onReady
        }

    })()

    $(document).ready(post.onReady)

</script>
@endsection
