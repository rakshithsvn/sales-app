@extends('back.posts.templateROI')

@section('form-open')
    <form method="post" action="{{ route('posts.storeROI') }}">
@endsection
