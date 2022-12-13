@extends('back.help_messages.template')

@section('form-open')
<form method="post" action="{{ route('help-messages.update', [$help_message->id]) }}" enctype='multipart/form-data'>
    {{ method_field('PUT') }}
    @endsection