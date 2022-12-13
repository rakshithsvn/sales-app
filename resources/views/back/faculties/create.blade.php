@extends('back.faculties.template')

@section('form-open')
    <form method="post" action="{{ route('faculties.store') }}">
@endsection