@extends('back.testimonials.template')

@section('form-open')
    <form method="post" action="{{ route('testimonials.update', [$testimonials->id]) }}">
        {{ method_field('PUT') }}
@endsection
