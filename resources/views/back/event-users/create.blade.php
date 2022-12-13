@extends('back.event-users.template')

@section('form-open')
    <form method="post" autocomplete="off" action="{{ route('event-users.store') }}" enctype='multipart/form-data'>
@endsection