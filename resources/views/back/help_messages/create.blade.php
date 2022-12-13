@extends('back.help_messages.template')

@section('form-open')
<form method="post" action="{{ route('help-messages.store') }}" enctype='multipart/form-data'>
    @endsection