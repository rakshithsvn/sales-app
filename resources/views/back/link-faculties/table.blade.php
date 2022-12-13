@foreach($link_faculties as $faculty)
<tr>
    <td style="display:none;">{{ $faculty->id }}</td>
    <td>{{ @$faculty->facultyDetails->full_name }}</td>
    <td>{{ @$faculty->eventContents->name }}</td>
    {{-- <td>{{ @$faculty->tabContents->tab_title}}</td> --}}
    <td>
        <input type="checkbox" name="status" value="{{ $faculty->id }}" {{ $faculty->active ? 'checked' : ''}}>
    </td>
    <td>{{ $faculty->created_at->formatLocalized('%c') }}</td>
    <td>
        <a class="btn btn-warning btn-sm" href="{{ route('link-faculties.edit', [$faculty->id]) }}" role="button" title="@lang('Edit Faculty')"><span class="fa fa-edit"></span></a>
        <a class="btn btn-danger btn-sm" href="{{ route('link-faculties.destroy', [$faculty->id]) }}" role="button" title="@lang('Destroy Faculty')"><span class="fa fa-remove"></span></a></td>
</tr>
@endforeach



