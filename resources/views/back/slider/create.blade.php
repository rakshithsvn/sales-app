@extends('back.slider.template')

@section('form-open')
    <form method="post" action="{{ route('sliders.store') }}">
@endsection