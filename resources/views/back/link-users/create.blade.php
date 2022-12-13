@extends('back.link-users.template')

@section('form-open')
    <form method="post" action="{{ route('link-users.store') }}">
@endsection