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
    <a class="btn btn-primary" href="{{ route('testimonials.create') }}"><span class="fa fa-plus" aria-hidden="true"></span> @lang('New Testimonial')</a>
@endsection

@section('main')

    <div class="row">
        <div class="col-md-12">
            @if (session('category-ok'))
                    @component('back.components.alert')
                        @slot('type')
                            success
                        @endslot
                        {!! session('category-ok') !!}
                    @endcomponent
                @endif

                 @if (session('category-danger'))
                    @component('back.components.alert')
                        @slot('type')
                            danger
                        @endslot
                        {!! session('category-danger') !!}
                    @endcomponent
                @endif
            <div class="box">
                <div class="box-header with-border">
                <input type="text" class="pull-right" id="searchContent">
                    <div id="spinner" class="text-center"></div>
                </div>
                <div class="box-body table-responsive">
                    <table id="users" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="display:none;">#</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Image')</th>
                            <th>@lang('Active')</th>
                            <th>@lang('Creation')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody id="pannel">
                            @include('back.testimonials.table', compact('testimonials'))
                        </tbody>
                    </table>
                    <div class="pull-right">
                    {!! $testimonials->render() !!}
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
        var url = '{{ route('testimonials.index') }}'
        var swalTitle = '@lang('Really destroy Testimonial ?')'
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
