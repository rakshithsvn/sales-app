@extends('back.address.template')

@section('form-open')
    <form method="post" action="{{ route('address.update', [$address_details->id]) }}">
        {{ method_field('PUT') }}
@endsection
