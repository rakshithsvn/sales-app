@foreach($registered_forms as $registered_form)
<tr>
	<td><input type="checkbox" class="id" name="id[]" value="{{ $registered_form->id }}"></td>
	<td style="display:none;">{{ $registered_form->id }}</td>
	<td>{{ $registered_form->full_name }}</td>
	<td>{{ $registered_form->patient_id ? $registered_form->patient_id : '' }}</td>
	<td>{{ $registered_form->phone }}</td>
	<td>{{ $registered_form->email }}</td>
	<td>{{ $registered_form->date->format('d/m/Y') }}</td>
	<td>{{ $registered_form->time }}</td>
	<td>{{ @$registered_form->post->title }}</td>
	<td>{{ @$registered_form->faculty->full_name }}</td>
	<td width="10%"><a class="btn btn-danger btn-sm " href="{{ route('prospects.application-destroy', [$registered_form->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-remove"></span></a>&nbsp;
		<a class="btn btn-info btn-sm " href="{{ route('prospects.application-view', [$registered_form->id]) }}" role="button" title="@lang('View')"><span class="fa fa-eye"></span></a>&nbsp;
		{{-- @if($registered_form->status == 'Accepted')
		<a class="btn btn-success btn-sm " href="{{ route('prospects.confirm', [$registered_form->id]) }}" role="button" title="@lang('Send Confirm SMS')"><span class="fa fa-check"></span></a>
		@endif --}}
		{{-- @if($registered_form->status == 'Confirmed')
		<a class="btn btn-warning btn-sm " href="{{ route('prospects.review', [$registered_form->id]) }}" role="button" title="@lang('Send Review SMS')"><span class="fa fa-thumbs-up"></span></a>
		@endif</td> --}}   
</tr>
@endforeach



