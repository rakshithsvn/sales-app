    {{@$dealers}}
    @foreach($dealers as $post)
    <tr>
        <td>{{ @$post->name }}</td>

        <td>{{ @$post->mobile_number }}</td>
        <td>{{ @$post->address }}</td>
        <td>{{ @$post->eventUser->name ? @$post->eventUser->name : 'Admin'}} </td>
        <td> <input type="checkbox" name="status" value="{{ $post->id }}" {{ $post->is_verified ? 'checked' : ''}}></td>
        <td>
            <input type="checkbox" name="status" value="{{ $post->id }}" {{ $post->active ? 'checked' : ''}}>
        </td>
        <td>{{ $post->created_at->formatLocalized('%c') }}</td>
        <td>
            <input type="checkbox" name="seen" value="{{ $post->id }}" {{ is_null($post->ingoing) ?  'disabled' : 'checked'}}>
        </td>
        {{-- <td>{{ $post->seo_title }}</td> --}}
        {{-- <td><a class="btn btn-success" href="{{ route('dealers.show', [$post->id]) }}" role="button" title="@lang('Show')"><span class="fa fa-eye"></span></a></td>--}}
        <td>
            <a class="btn btn-warning btn-sm" href="{{ route('dealers.edit', [$post->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a>
            <a class="btn btn-danger btn-sm" href="{{ route('dealers.destroy', [$post->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-trash"></span></a>
        </td>
    </tr>
    @endforeach