@extends('back.parent-menus.template')

@section('form-open')
    <form method="post" action="{{ route('parent-menus.store') }}" id="submitCreate">
@endsection