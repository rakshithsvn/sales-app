@extends('back.child-menus.template')

@section('form-open')
    <form method="post" action="{{ route('child-menus.update', [$childmenus->id]) }}" id="submitUpdate">
        {{ method_field('PUT') }}
@endsection
