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
    <a class="btn btn-primary" href="{{ route('post-link-pages.create') }}"><span class="fa fa-plus" aria-hidden="true"></span> @lang('New Page')</a>
     <a class="btn btn-success" href="{{ route('post-link-pages.index') }}"><span class="fa fa-file" aria-hidden="true"></span> @lang('All Pages')</a>
     {{--<a class="btn btn-warning" href="{{ route('post-link-faculties.index') }}"><span class="fa fa-link" aria-hidden="true"></span> @lang('Link Faculty')</a>--}}

@endsection

@section('main')

     <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                 <!--   <input type="text" class="pull-right" id="searchContent"> -->
                    <div id="spinner" class="text-center"></div>
                </div>
                <div class="box-body table-responsive">
                    <table id="users" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="display:none;">#</th>
                            <th>@lang('Page Title')</th>
                            <th>@lang('Copy Link')</th>
                        </tr>
                        </thead>
                        <tbody id="pannel">
                            @foreach($links as $link)
                                <tr>
                                    <td><input type="text" value="{{ $link->title }}" id="myInputTitle" style="border: none"></td>
                                    <td><input type="text" value="{{ $link->slug }}" id="myInput" style="border: none"> <button class="copyContent" >Copy</button>
                                    </td>
                                </tr>
                            @endforeach

                            
                        </tbody>
                    </table>
                    <div class="pull-right">
                                {!! $links->render() !!}
                            </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@section('js')
<script src="{{ asset('adminlte/js/back.js') }}"></script>
<script>
/*function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("Copy");
  alert("Copied the text: " + copyText.value);
}*/

 $(document).on('keyup', '#searchContent', function (event) {
                    back.search(url, $(this), errorAjax)
                })
                
$(document).on('click','.copyContent',function(){

    var content = $(this).parent().parent().find('#myInput').val();
    var title = $(this).parent().parent().find('#myInputTitle').val();

window.Laravel = <?php echo json_encode([
'csrfToken' => csrf_token(),
'app_url'=>env('LINK_URL'),
]); ?>

//alert(window.Laravel.app_url);
var path = window.Laravel.app_url +content;
//alert(path);
 copyTextToClipboard( path );

})


function copyTextToClipboard(text) {


   var textArea = document.createElement( "textarea" );
   textArea.value = text;
   document.body.appendChild( textArea );

   textArea.select();

   try {
      var successful = document.execCommand( 'copy' );
      var msg = successful ? 'successful' : 'unsuccessful';

      if(msg == 'successful')
      {
         swal("",  "Link copied successfully");
      }

     // console.log('Copying text command was ' + msg);
   } catch (err) {
      //console.log('Oops, unable to copy');
   }

   document.body.removeChild( textArea );

}

</script>
@endsection


