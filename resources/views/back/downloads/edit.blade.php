@extends('back.downloads.template')

@section('form-open')
    <form method="post" action="{{ route('prospects.update', [$prospects->id]) }}">
        {{ method_field('PUT') }}
@endsection
