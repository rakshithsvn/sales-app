@foreach($childmenus as $childmenu)
<tr>
    <td style="display:none;">{{ $childmenu->id }}</td>
    <td>{{ $childmenu->subMenu->name }}</td>
    <td>{{ $childmenu->name }}</td>
    <td>{{ $childmenu->hierarchy }}</td>
    <td>
        <input type="checkbox" name="status" value="{{ $childmenu->id }}" {{ $childmenu->active ? 'checked' : ''}}>
    </td>
    <td>{{ $childmenu->created_at->formatLocalized('%c') }}</td>
    <td><a class="btn btn-warning btn-sm" href="{{ route('child-menus.edit', [$childmenu->id]) }}" role="button" title="@lang('Edit Faculty')"><span class="fa fa-edit"></span></a>
        <a class="btn btn-danger btn-sm" href="{{ route('child-menus.destroy', [$childmenu->id]) }}" role="button" title="@lang('Destroy Faculty')"><span class="fa fa-trash"></span></a></td>
</tr>
@endforeach



