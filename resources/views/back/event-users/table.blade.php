@foreach($event_users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->mobile_number }}</td>
    <td>{{ $user->address }}</td>
    <td>{{ $user->lab_name }}</td>
    <td> <input type="checkbox" name="status" value="{{ $user->id }}" {{ $user->is_verified ? 'checked' : ''}}></td>
    <td>{{ $user->created_at->formatLocalized('%c') }}</td>
    <td>
         <a class="btn btn-success btn-sm" href="{{ route('event-users.edit', [$user->id]) }}" role="button" title="@lang('Verify')"><span class="fa fa-check"></span></a>
        <a class="btn btn-warning btn-sm" href="{{ route('event-users.edit', [$user->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a>
        <a class="btn btn-primary btn-sm" href="{{ route('event-users.changepassword', [$user->id]) }}" role="button" title="@lang('Reset Password')"><span class="fa fa-lock"></span></a>
        @if($user->id != 1)<a class="btn btn-danger btn-sm" href="{{ route('event-users.destroy', [$user->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-trash"></span></a>@endif</td>
    </tr>
    @endforeach

