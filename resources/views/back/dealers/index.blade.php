@extends('back.layout')

@section('css')
<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
<style>
    input,
    th span {
        cursor: pointer;
    }
</style>
@endsection

@section('button')
<a href="{{ route('dealers.create') }}" class="btn btn-primary"><span class="fa fa-plus" aria-hidden="true"></span> @lang('New Dealer')</a>
@endsection

@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <strong>@lang('Status') :</strong> &nbsp;
                <input type="checkbox" name="new" @if(request()->new) checked @endif> @lang('New')&nbsp;
                <input type="checkbox" name="active" @if(request()->active) checked @endif> @lang('Active')&nbsp;
                <input type="text" class="pull-right" id="searchContent">
                <div id="spinner" class="text-center"></div>
            </div>
            <div class="box-body table-responsive">
                <table id="users" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>@lang('Name')<span id="title" class="fa fa-sort pull-right" aria-hidden="true"></span></th>
                            <th>@lang('Mobile Number')</th>
                            <th>@lang('Address')</th>
                            <th>@lang('Created By')</th>
                            <th>@lang('Verified')</th>
                            <th>@lang('Active')<span id="active" class="fa fa-sort pull-right" aria-hidden="true"></span></th>
                            <th>@lang('Creation')<span id="created_at" class="fa fa-sort-desc pull-right" aria-hidden="true"></span></th>
                            <th>@lang('New')</th>
                            {{-- <th>@lang('SEO Title')<span id="seo_title" class="fa fa-sort pull-right" aria-hidden="true"></span></th> --}}
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Image')</th>
                            <th>@lang('Active')</th>
                            <th>@lang('Creation')</th>
                            <th>@lang('New')</th>
                            <th>@lang('SEO Title')</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>--}}
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

                        @include('back.dealers.table', compact('dealers'))
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="pull-right">
                {!! $dealers->render() !!}
            </div>
            {{-- <div id="pagination" class="box-footer">
                {{ $links }}
        </div> --}}
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
    var post = (function() {

        var url = '{{ route('dealers.index') }}'
        var swalTitle = '@lang('
        Are you sure want to delete ? ')'
        var confirmButtonText = '@lang('Yes ')'
        var cancelButtonText = '@lang('No ')'
        var errorAjax = '@lang('
        Looks like there is a server issue...')'

        var onReady = function() {
            $('#pagination').on('click', 'ul.pagination a', function(product) {
                back.pagination(product, $(this), errorAjax)
            })
            $('#pannel').on('change', ':checkbox[name="seen"]', function() {
                    back.seen(url, $(this), errorAjax)
                })
                .on('change', ':checkbox[name="status"]', function() {
                    back.status(url, $(this), errorAjax)
                })
                .on('click', 'td a.btn-danger', function(product) {
                    back.destroy(product, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
                })

            $('th span').click(function() {
                back.ordering(url, $(this), errorAjax)
            })
            $('.box-header :radio, .box-header :checkbox').click(function() {
                back.filters(url, errorAjax)
            })
            $(document).on('keyup', '#searchContent', function(product) {
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