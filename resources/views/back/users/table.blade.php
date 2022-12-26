@foreach($users as $key=>$user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
        @if($user->role === 'admin')
        Administrator
        @elseif($user->role === 'redac')
        Redactor
        @else
        User
        @endif
    </td>
    <td>
        <input type="checkbox" name="seen" value="{{ $user->id }}" {{ is_null($user->ingoing) ?  'disabled' : 'checked'}}>
    </td>
    <td>
        <span {!! $user->valid ? ' class="fa fa-check"' : '' !!}></span>
    </td>
    <td>
        <span {!! $user->confirmed ? ' class="fa fa-check"' : '' !!}></span>
    </td>
    <td>{{ @$user->created_at && @$user->created_at->formatLocalized('%c') }}</td>
    <td>
        <a class="btn btn-warning btn-sm" href="{{ route('users.edit', [$user->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a>
        @if($key != 0)<a class="btn btn-danger btn-sm" href="{{ route('users.destroy', [$user->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-trash"></span></a>@endif
    </td>
</tr>
@endforeach