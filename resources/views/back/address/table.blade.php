@foreach($address_details as $address)
<tr>
	<td style="display:none;">{{ $address->id }}</td>
	<td>{{ $address->name }}</td>
	<td>{{ $address->email }}</td>
	<td>{{ $address->phone }}</td>
	<td>{!! removeExtraChar($address->address) !!}</td>
	<td>
		<a class="btn btn-warning btn-sm" href="{{ route('address.edit', [$address->id]) }}" role="button" title="@lang('Edit Address')"><span class="fa fa-edit"></span></a>
		<a class="btn btn-danger btn-sm" href="{{ route('address.destroy', [$address->id]) }}" role="button" title="@lang('Destroy Address')"><span class="fa fa-trash"></span></a></td>
	</tr>
	@endforeach

