@extends('back.sub-menus.template')

@section('form-open')
    <form method="post" action="{{ route('sub-menus.store') }}" id="submitCreate">
@endsection