@extends('back.posts.template')

@section('form-open')
    <form method="post" action="{{ route('posts.storeAddress') }}">
@endsection