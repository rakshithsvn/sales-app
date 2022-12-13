@extends('back.child-menus.template')

@section('form-open')
    <form method="post" action="{{ route('child-menus.store') }}" id="submitCreate">
@endsection