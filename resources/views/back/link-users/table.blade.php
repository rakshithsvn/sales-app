@foreach($link_users as $user)
<tr>
    <td style="display:none;">{{ $user->id }}</td>
    <td>{{ @$user->userDetails->username }}</td>
    <td>{{ @$user->eventContents->name }}</td>
    {{-- <td>{{ @$user->tabContents->tab_title}}</td> --}}
    <td>
        <input type="checkbox" name="status" value="{{ $user->id }}" {{ $user->active ? 'checked' : ''}}>
    </td>
    <td>{{ $user->created_at->formatLocalized('%c') }}</td>
    <td>
        <a class="btn btn-warning btn-sm" href="{{ route('link-users.edit', [$user->id]) }}" role="button" title="@lang('Edit user')"><span class="fa fa-edit"></span></a>
        <a class="btn btn-danger btn-sm" href="{{ route('link-users.destroy', [$user->id]) }}" role="button" title="@lang('Destroy user')"><span class="fa fa-remove"></span></a></td>
</tr>
@endforeach



