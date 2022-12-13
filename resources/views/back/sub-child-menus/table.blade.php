@foreach($subchildmenus as $subchildmenu)
<tr>
    <td style="display:none;">{{ $subchildmenu->id }}</td>
    <td>{{ $subchildmenu->childMenu->name }}</td>
    <td>{{ $subchildmenu->name }}</td>
    <td>{{ $subchildmenu->hierarchy }}</td>
    <td>
        <input type="checkbox" name="status" value="{{ $subchildmenu->id }}" {{ $subchildmenu->active ? 'checked' : ''}}>
    </td>
    <td>{{ $subchildmenu->created_at->formatLocalized('%c') }}</td>
    <td><a class="btn btn-warning btn-xs btn-block" href="{{ route('sub-child-menus.edit', [$subchildmenu->id]) }}" role="button" title="@lang('Edit Faculty')"><span class="fa fa-edit"></span></a></td>
    <td><a class="btn btn-danger btn-xs btn-block" href="{{ route('sub-child-menus.destroy', [$subchildmenu->id]) }}" role="button" title="@lang('Destroy Faculty')"><span class="fa fa-remove"></span></a></td>
</tr>
@endforeach



