@foreach($features as $feature)
<tr>
    <td style="display:none;">{{ $feature->id }}</td>
    <td>{{ $feature->name }}</td>
    {{--<td><img src="{{ $feature->image }}" alt="" width="50px" height="50px"></td>--}}

    <td>
        <input type="checkbox" name="status" value="{{ $feature->id }}" {{ $feature->active ? 'checked' : ''}}>
    </td>
    <td>{{ $feature->created_at->formatLocalized('%c') }}</td>
    <td>
        <a class="btn btn-warning btn-sm" href="{{ route('features.edit', [$feature->id]) }}" role="button" title="@lang('Edit Slider')"><span class="fa fa-edit"></span></a>
        {{--  <a class="btn btn-warning btn-sm" href="{{ route('sliders.upload-photos', [$album->id]) }}" role="button" title="@lang('Upload Photos')"><span class="fa fa-upload"></span></a>  --}}
        <a class="btn btn-danger btn-sm" href="{{ route('features.destroy', [$feature->id]) }}" role="button" title="@lang('Destroy Slider')"><span class="fa fa-trash"></span></a></td>
    </tr>
    @endforeach



