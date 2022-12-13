@extends('back.sub-child-menus.template')

@section('form-open')
    <form method="post" action="{{ route('sub-child-menus.update', [$subchildmenus->id]) }}" id="submitUpdate">
        {{ method_field('PUT') }}
@endsection
