@foreach($albums as $album)
<tr>
    <td style="display:none;">{{ $album->id }}</td>
    <td>{{ $album->title }}</td>
    <td><img src="{{ $album->image }}" alt="" width="50px" height="50px"></td>
    <td style="display:none;">{{ $album->category }}</td>
    <td>
        <input type="checkbox" name="status" value="{{ $album->id }}" {{ $album->active ? 'checked' : ''}}>
    </td>
    <td>{{ $album->created_at->formatLocalized('%c') }}</td>   
    <td><a class="btn btn-warning btn-sm" href="{{ route('albums.upload-photos', [$album->id]) }}" role="button" title="@lang('Upload Photos')"><span class="fa fa-upload"></span></a></td>
    <td>
        <a class="btn btn-warning btn-sm" href="{{ route('albums.edit', [$album->id]) }}" role="button" title="@lang('Edit Album')"><span class="fa fa-edit"></span></a>
        <a class="btn btn-danger btn-sm" href="{{ route('albums.destroy', [$album->id]) }}" role="button" title="@lang('Destroy Album')"><span class="fa fa-trash"></span></a></td>
    </tr>
    @endforeach

