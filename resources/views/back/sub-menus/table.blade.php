@foreach($submenus as $submenu)
<tr>
    <td style="display:none;">{{ $submenu->id }}</td>
    <td>{{ $submenu->mainMenu->name }}</td>
    <td>{{ $submenu->name }}</td>
    <td>{{ $submenu->hierarchy }}</td>
    <td>
        <input type="checkbox" name="status" value="{{ $submenu->id }}" {{ $submenu->active ? 'checked' : ''}}>
    </td>
    <td>{{ $submenu->created_at->formatLocalized('%c') }}</td>
    <td>
        <a class="btn btn-warning btn-sm" href="{{ route('sub-menus.edit', [$submenu->id]) }}" role="button" title="@lang('Edit Sub Menu')"><span class="fa fa-edit"></span></a>
        <a class="btn btn-danger btn-sm" href="{{ route('sub-menus.destroy', [$submenu->id]) }}" role="button" title="@lang('Destroy Sub Menu')"><span class="fa fa-trash"></span></a>
    </td>
</tr>
@endforeach



