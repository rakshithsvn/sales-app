@extends('back.event-users.template')

@section('form-open')
    <form method="post" action="{{ route('event-users.update', [$event_user->id]) }}" enctype='multipart/form-data'>
    {{ method_field('PUT') }}
@endsection