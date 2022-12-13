@extends('back.link-faculties.template')

@section('form-open')
    <form method="post" action="{{ route('link-faculties.store') }}">
@endsection