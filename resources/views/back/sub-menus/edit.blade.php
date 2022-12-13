@extends('back.sub-menus.template')

@section('form-open')
    <form method="post" action="{{ route('sub-menus.update', [$submenus->id]) }}" id="submitUpdate">
        {{ method_field('PUT') }}
@endsection
