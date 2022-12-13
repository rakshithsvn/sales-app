@foreach($testimonials as $testimonial)
<tr>
    <td style="display:none;">{{ $testimonial->id }}</td>
    <td>{{ $testimonial->title }}</td>

    @if(isset($testimonial->image ))
    <td><img src="{{ $testimonial->image }}" alt="" style="width:50px;height:50px;"></td>
    @else
    <td></td>
    @endif

    <td>
        <input type="checkbox" name="status" value="{{ $testimonial->id }}" {{ $testimonial->active ? 'checked' : ''}}>
    </td>
    <td>{{ $testimonial->created_at->formatLocalized('%c') }}</td>
    <td>
        <a class="btn btn-warning btn-sm" href="{{ route('testimonials.edit', [$testimonial->id]) }}" role="button" title="@lang('Edit Testimonial')"><span class="fa fa-edit"></span></a>
        <a class="btn btn-danger btn-sm" href="{{ route('testimonials.destroy', [$testimonial->id]) }}" role="button" title="@lang('Destroy Testimonial')"><span class="fa fa-trash"></span></a></td>
    </tr>
    @endforeach



