@extends('back.link-users.template')

@section('form-open')
    <form method="post" action="{{ route('link-users.update', [$link_users->id]) }}">
        {{ method_field('PUT') }}
@endsection
