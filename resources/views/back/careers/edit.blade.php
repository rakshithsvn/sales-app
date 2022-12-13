@extends('back.careers.template')

@section('form-open')
    <form method="post" action="{{ route('careers.update', [$careers->id]) }}">
        {{ method_field('PUT') }}
@endsection
