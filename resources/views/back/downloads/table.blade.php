@foreach($prospects as $prospect)
<tr>
	<td style="display:none;">{{ $prospect->id }}</td>
	<td>{{ $prospect->title }}</td>
	<td>{{ $prospect->postId['title']}}</td>

	<td>
		<input type="checkbox" name="status" value="{{ $prospect->id }}" {{ $prospect->active ? 'checked' : ''}}>
	</td>
	<td>{{ $prospect->created_at->formatLocalized('%c') }}</td>
	<td>
		<a class="btn btn-warning btn-sm" href="{{ route('prospects.edit', [$prospect->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a>
		<a class="btn btn-danger btn-sm" href="{{ route('prospects.destroy', [$prospect->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-trash"></span></a></td>

	</tr>
	@endforeach



