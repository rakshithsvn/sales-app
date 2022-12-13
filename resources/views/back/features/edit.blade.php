@extends('back.features.template')

@section('form-open')
    <form method="post" action="{{ route('features.update', [$features->id]) }}">
        {{ method_field('PUT') }}
@endsection
