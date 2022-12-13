@foreach($parentmenus as $parentmenu)
<tr>
    <td style="display:none;">{{ $parentmenu->id }}</td>
    <td>{{ $parentmenu->name }}</td>
    <td>{{ $parentmenu->hierarchy }}</td>
    <td>{{($parentmenu->post_entry == 'Y')? 'YES' : 'NO'}}</td>
    <td>{{ $parentmenu->layout_name }}</td>
    <td>{{($parentmenu->display_menu == 'Y')? 'YES' : 'NO'}}</td>

    <td>
        <input type="checkbox" name="status" value="{{ $parentmenu->id }}" {{ $parentmenu->status ? 'checked' : ''}}>
    </td>
    <td>{{ $parentmenu->created_at->formatLocalized('%c') }}</td>
    <td>
        <a class="btn btn-warning btn-sm" href="{{ route('parent-menus.edit', [$parentmenu->id]) }}" role="button" title="@lang('Edit Parent Menu')"><span class="fa fa-edit"></span></a>
        <a class="btn btn-danger btn-sm" href="{{ route('parent-menus.destroy', [$parentmenu->id]) }}" role="button" title="@lang('Destroy Parent Menu')"><span class="fa fa-trash"></span></a>
    </td>
</tr>
@endforeach



