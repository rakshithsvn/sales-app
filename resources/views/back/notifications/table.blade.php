@foreach($project as $page)
<tr>
    <td style="display:none;">{{ $page->id }}</td>
    <td>{{ $page->Event->name.' - '.$page->tab_title }}</td>
  
    <td>
        <input type="checkbox" name="status" value="{{ $page->id }}" {{ $page->active ? 'checked' : ''}}>
    </td>
    <td>{{ $page->created_at->formatLocalized('%c') }}</td>
    <td>
    	<a class="btn btn-warning btn-sm" href="{{ route('notifications.edit', [$page->id]) }}" role="button" title="@lang('Edit Notifications')"><span class="fa fa-edit"></span></a>
    	<a class="btn btn-danger btn-sm" href="{{ route('notifications.destroy', [$page->id]) }}" role="button" title="@lang('Destroy Notifications')"><span class="fa fa-trash"></span></a></td>
</tr>
@endforeach



