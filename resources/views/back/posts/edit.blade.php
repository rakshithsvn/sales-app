@extends('back.posts.template')

@section('form-open')
    <form method="post" action="{{ route('posts.update', [$post->id]) }}" enctype='multipart/form-data'>
        {{ method_field('PUT') }}
@endsection
