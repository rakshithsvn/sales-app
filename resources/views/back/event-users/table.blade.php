@foreach($event_users as $key=>$user)
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
         <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#staticBackdrop-{{$key}}" role="button" title="@lang('Verify')"><span class="fa fa-check"></span></a>
         <a class="btn btn-warning btn-sm" href="{{ route('event-users.edit', [$user->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a>
         {{-- <a class="btn btn-primary btn-sm" href="{{ route('event-users.changepassword', [$user->id]) }}" role="button" title="@lang('Reset Password')"><span class="fa fa-lock"></span></a> --}}
         @if($user->id != 1)<a class="btn btn-danger btn-sm" href="{{ route('event-users.destroy', [$user->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-trash"></span></a>@endif</td>
    </tr>
  
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop-{{$key}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Verify User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{route('event_users.verify')}}">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="id" value="{{$user->id}}" >
            <label name="Verified" class="mr-3">User Name</label><input type="text" value="{{$user->name}}" class="form-control mb-3"  readonly>
            <label name="Verified" class="mr-3">Email ID</label><input type="text" value="{{$user->email}}" class="form-control mb-3"  readonly>
            <label name="Verified" class="mr-3">Target Reward</label><input type="number" name="target_reward" value="0" class="form-control mb-3" placeholder="Reward Points" required/>    
            <label name="Verified" class="mr-3">Verified</label><input type="checkbox" name="is_verified" value="{{ $user->is_verified }}" class="mb-3" {{ $user->is_verified ? 'checked' : ''}}>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
    </form>
        </div>
      </div>
    </div>

@endforeach
