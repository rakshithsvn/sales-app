@extends('back.parent-menus.template')

@section('form-open')
    <form method="post" action="{{ route('parent-menus.update', [$parentmenus->id]) }}" id="submitUpdate">
        {{ method_field('PUT') }}
@endsection
