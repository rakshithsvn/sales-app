@extends('back.careers.template')

@section('form-open')
    <form method="post" action="{{ route('careers.store') }}">
@endsection