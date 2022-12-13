@extends('back.dealers.template')

@section('form-open')
<form method="post" action="{{ route('dealers.store') }}" enctype='multipart/form-data'>
    @endsection