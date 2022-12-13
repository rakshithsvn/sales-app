@extends('back.faculties.template')

@section('form-open')
    <form method="post" action="{{ route('faculties.update', [$faculties->id]) }}">
        {{ method_field('PUT') }}
@endsection
