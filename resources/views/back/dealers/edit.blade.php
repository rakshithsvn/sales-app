@extends('back.dealers.template')

@section('form-open')
<form method="post" action="{{ route('dealers.update', [$dealer->id]) }}" enctype='multipart/form-data'>
    {{ method_field('PUT') }}
    @endsection