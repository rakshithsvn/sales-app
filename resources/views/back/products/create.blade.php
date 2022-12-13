@extends('back.products.template')

@section('form-open')
<form method="post" action="{{ route('products.store') }}" enctype='multipart/form-data'>
    @endsection