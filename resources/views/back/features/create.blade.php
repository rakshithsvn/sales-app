@extends('back.features.template')

@section('form-open')
    <form method="post" action="{{ route('features.store') }}">
@endsection