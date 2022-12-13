@foreach($sliders as $slider)
<tr>
    <td style="display:none;">{{ $slider->id }}</td>
    <td>{{ $slider->title }}</td>
    <td>{{ $slider->hierarchy }}</th>
    <td><img src="{{ $slider->image }}" alt="" width="50px" height="50px"></td>
    <td>{{ $slider->excerpt }}</td>
    <td>
        <input type="checkbox" name="status" value="{{ $slider->id }}" {{ $slider->active ? 'checked' : ''}}>
    </td>
    <td>{{ $slider->created_at->formatLocalized('%c') }}</td>
    <td><a class="btn btn-warning btn-sm" href="{{ route('sliders.edit', [$slider->id]) }}" role="button" title="@lang('Edit Slider')"><span class="fa fa-edit"></span></a>
    {{--  <a class="btn btn-warning btn-sm" href="{{ route('sliders.upload-photos', [$album->id]) }}" role="button" title="@lang('Upload Photos')"><span class="fa fa-upload"></span></a>  --}}
    <a class="btn btn-danger btn-sm" href="{{ route('sliders.destroy', [$slider->id]) }}" role="button" title="@lang('Destroy Slider')"><span class="fa fa-trash"></span></a></td>
</tr>
@endforeach



