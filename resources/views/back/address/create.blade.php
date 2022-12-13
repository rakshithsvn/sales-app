@extends('back.address.template')

@section('form-open')
    <form method="post" action="{{ route('address.store') }}">
@endsection