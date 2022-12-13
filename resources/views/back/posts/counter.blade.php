@extends('back.posts.templateCounter')

@section('form-open')
    <form method="post" action="{{ route('posts.storeCounter') }}">
@endsection