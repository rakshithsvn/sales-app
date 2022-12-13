@extends('back.media.template')

@section('form-open')
    <form method="post" action="{{ route('albums.store') }}">
@endsection