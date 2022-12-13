@extends('back.products.template')

@section('form-open')
<form method="post" action="{{ route('products.update', [$product->id]) }}" enctype='multipart/form-data'>
    {{ method_field('PUT') }}
    @endsection