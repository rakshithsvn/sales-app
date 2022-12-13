@extends('back.media.template')

@section('form-open')
    <form method="post" action="{{ route('albums.update', [$media_album->id]) }}">
        {{ method_field('PUT') }}
@endsection
