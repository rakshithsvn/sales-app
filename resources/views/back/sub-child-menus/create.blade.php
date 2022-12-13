@extends('back.sub-child-menus.template')

@section('form-open')
    <form method="post" action="{{ route('sub-child-menus.store') }}" id="submitCreate">
@endsection