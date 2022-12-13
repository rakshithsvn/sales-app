@extends('back.testimonials.template')

@section('form-open')
    <form method="post" action="{{ route('testimonials.store') }}">
@endsection