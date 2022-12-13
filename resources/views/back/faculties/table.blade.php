@foreach($faculties as $faculty)
<tr>
    <td style="display:none;">{{ $faculty->id }}</td>
    <td>{{ $faculty->full_name }}</td>
    @if(isset($faculty->image))
    <td><img src="{{ $faculty->image }}" alt="" width="50px" height="50px"></td>
    @else
    <td></td>
    @endif
    <td>{{ $faculty->designation }}</td>
    {{-- <td>@if($faculty->type == 'doctor')
        <label class="switch"><input type="checkbox" name="appointment" value="{{ $faculty->id }}" {{ $faculty->appointment ? 'checked' : ''}}>
        <div class="slider round">
            <span class="on">ON</span><span class="off">OFF</span>
        </div>
        </label>
        @endif
    </td> --}}
    <td>
        <input type="checkbox" name="status" value="{{ $faculty->id }}" {{ $faculty->active ? 'checked' : ''}}>
    </td>
    <td>{{ $faculty->created_at->formatLocalized('%c') }}</td>
    @if(auth()->user())
    <td>
        <a class="btn btn-warning btn-sm" href="{{ route('faculties.edit', [$faculty->id]) }}" role="button" title="@lang('Edit Member')"><span class="fa fa-edit"></span></a>
        <a class="btn btn-danger btn-sm" href="{{ route('faculties.destroy', [$faculty->id]) }}" role="button" title="@lang('Destroy Member')"><span class="fa fa-trash"></span></a></td>
    @else
    <td></td><td></td>
    @endif
</tr>
@endforeach



