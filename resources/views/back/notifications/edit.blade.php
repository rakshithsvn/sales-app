@extends('back.notifications.template')

@section('form-open')
    <form method="post" action="{{ route('notifications.update', [@$project->id]) }}">
        {{ method_field('PUT') }}
@endsection
