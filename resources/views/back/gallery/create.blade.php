@extends('back.gallery.template')

@section('form-open')
    <form method="post" action="{{ route('gallery.store') }}">
@endsection