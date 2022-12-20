@extends('back.layout')

@section('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
    <style>
        input, th span {
            cursor: pointer;
        }
    </style>
@endsection

@section('main')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                
                 <div class="box-body">           

        <table class="table table-striped table-hover">
       
        <tr>
            <th>User Name</th>
            <td>{{$graduation_details->user->name}}</td>
        </tr>
      
        <tr>
            <th>Product Name</th>
            <td>{{$graduation_details->product->name}}</td>
            
        </tr>

        <tr>
            <th>Quantity</th>
            <td>{{$graduation_details->quantity}}</td>
        </tr>

        <tr>
            <th>Dealer Name</th>
            <td>{{$graduation_details->dealer->name}}</td>
        </tr>

       <tr>
            <th>Invoice File</th>
            <td><a href="{{asset('storage/resume')}}/{{$graduation_details->invoice_url}}" target="_blank"><i class="fa fa-download" title="Click to download" aria-hidden="true"></i></a></td>  
        </tr> 

        </table>

        </div><!-- /.box-body -->

               
        </div>
        <!-- /.box -->
        <a href="{{route('prospects.graduation-index')}}" class="btn btn-default pull-right">@lang('Back')</a>   

    </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection

@section('js')
<script src="{{ asset('adminlte/js/back.js') }}"></script>

@endsection
