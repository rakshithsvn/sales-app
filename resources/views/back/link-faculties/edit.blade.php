@extends('back.link-faculties.template')

@section('form-open')
    <form method="post" action="{{ route('link-faculties.update', [$link_faculties->id]) }}">
        {{ method_field('PUT') }}
@endsection
