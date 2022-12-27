@extends('back.layout')

@section('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
    <style>
        input, th span {
            cursor: pointer;
        }
	.loadingForm { display: contents }
    </style>
@endsection

@section('button')
    <a class="btn btn-primary" href="{{ route('event-users.create') }}"><span class="fa fa-plus" aria-hidden="true"></span> @lang('New User')</a>&nbsp;
    {!! Form::open(array('route' => 'prospects.graduation-download','class'=>'form-horizontal loadingForm','method'=>'post','id'=>'exportData','name'=>'exportData')) !!}               
	 <button class="btn btn-success" type="submit" id="exportData" ><i class="fa fa-file-excel-o"></i> Download</button> 
</form>
@endsection

@section('main')

    <div class="row">    
        <div class="col-md-12">
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
            
            <div class="box">
                <div class="box-header with-border">
                    <!-- <strong>@lang('Roles') :</strong> &nbsp;
                    <input type="radio" name="role" value="all" checked> @lang('All')&nbsp;
                    <input type="radio" name="role" value="admin"> @lang('Administrator')&nbsp;
                    <input type="radio" name="role" value="redac"> @lang('Redactor')&nbsp;
                   {{-- <input type="radio" name="role" value="user"> @lang('User')&nbsp;--}}<br>
                    <strong>@lang('Status') :</strong> &nbsp;
                    <input type="checkbox" name="new" @if(request()->new) checked @endif> @lang('New')&nbsp;
                    <input type="checkbox" name="valid"> @lang('Valid')&nbsp;
		            <input type="checkbox" name="confirmed"> @lang('Confirmed') -->
                    <input type="text" class="pull-right" id="searchContent" placeholder="Search by Name">
		    <div id="spinner" class="text-center"></div>
                </div>
                <div class="box-body table-responsive">
                    <table id="users" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Mobile Number')</th>
                            <th>@lang('Address')</th>
                            <th>@lang('Lab Name')</th>
                            <th>@lang('Verified')</th>
                            <th>@lang('Creation')</th>
                            <th width="15%">@lang('Action')</th>
                        </tr>
                        </thead>
                      {{--  <tfoot>
                        <tr>
                            <th>#</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Username')</th>
                            <th>@lang('Profile Img')</th>
                            <th>@lang('Last Active')</th>
                            <th>@lang('Valid')</th>
                            <th>@lang('Confirmed')</th>
                            <th>@lang('Creation')</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>--}}
                        <tbody id="pannel">
                            @include('back.event-users.table', compact('event_users'))
                        </tbody>
                    </table>
                    <div class="pull-right">
                	{!! $event_users->render() !!}
            	    </div>
                    {{-- <div id="pagination" class="box-footer">
                       {{ @$links }}
                    </div> --}}
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

        var user = (function () {

            var url = '{{ route('event-users.index') }}'
            var swalTitle = '@lang('Really destroy user ?')'
            var confirmButtonText = '@lang('Yes')'
            var cancelButtonText = '@lang('No')'
            var errorAjax = '@lang('Looks like there is a server issue...')'

            var onReady = function () {
                $('#pagination').on('click', 'ul.pagination a', function (event) {
                    back.pagination(event, $(this), errorAjax)
                })
                $('#pannel').on('change', ':checkbox[name="seen"]', function () {
                        back.seen(url, $(this), errorAjax)
                    })
                    .on('click', 'td a.btn-danger', function (event) {
                        back.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
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

        $(document).ready(user.onReady)

    </script>
@endsection
