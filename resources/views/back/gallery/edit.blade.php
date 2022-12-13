@extends('back.gallery.template')

@section('form-open')
    <form method="post" action="{{ route('gallery.update', [$project->id]) }}">
        {{ method_field('PUT') }}
@endsection
