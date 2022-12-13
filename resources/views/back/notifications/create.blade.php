@extends('back.notifications.template')

@section('form-open')
    <form method="post" action="{{ route('notifications.store') }}">
@endsection