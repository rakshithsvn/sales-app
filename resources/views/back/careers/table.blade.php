@foreach($careers as $career)
<tr>
    <td style="display:none;">{{ $career->id }}</td>
    <td>{{ $career->title }}</td>
    <td>{{ $career->excerpt }}</td>
    <td>
        <input type="checkbox" name="status" value="{{ $career->id }}" {{ $career->active ? 'checked' : ''}}>
    </td>
    <td>{{ $career->created_at->formatLocalized('%c') }}</td>
    <td><a class="btn btn-warning btn-xs btn-block" href="{{ route('careers.edit', [$career->id]) }}" role="button" title="@lang('Edit Career')"><span class="fa fa-edit"></span></a></td>
    <td><a class="btn btn-danger btn-xs btn-block" href="{{ route('careers.destroy', [$career->id]) }}" role="button" title="@lang('Destroy Career')"><span class="fa fa-remove"></span></a></td>
</tr>
@endforeach



