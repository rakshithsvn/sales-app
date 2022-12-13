@extends('back.layout')

@section('main')

<div class="row">
	@if(auth()->user()->role == 'admin')
		@each('back/partials/pannel', $pannels, 'pannel')
	@endif
</div>

@endsection
