@extends('back.slider.template')

@section('form-open')
    <form method="post" action="{{ route('sliders.update', [$sliders->id]) }}">
        {{ method_field('PUT') }}
@endsection
