@foreach($pages as $page)
<tr>
   <td style="display:none;">{{ $page->id }}</td>
   <td>{{ substr($page->title,0,50) }}</td>
   <td>
    <input type="checkbox" name="status" value="{{ $page->id }}" {{ $page->active ? 'checked' : ''}}>
</td>
<td>{{ $page->created_at->formatLocalized('%c') }}</td>

{{--  <td><a class="btn btn-success btn-sm" href="{{ route('posts.show', [$post->id]) }}" role="button" title="@lang('Show')"><span class="fa fa-eye"></span></a></td>--}}
<td>
    <a class="btn btn-warning btn-sm" href="{{ route('post-link-pages.edit', [$page->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a>
    <a class="btn btn-danger btn-sm" href="{{ route('post-link-pages.destroy', [$page->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-remove"></span></a></td>
</tr>
@endforeach



