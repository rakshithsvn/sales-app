@extends('back.post-link-pages.template')

@section('form-open')
    <form method="post" action="{{ route('post-link-pages.update', [$post->id]) }}">
        {{ method_field('PUT') }}
@endsection
