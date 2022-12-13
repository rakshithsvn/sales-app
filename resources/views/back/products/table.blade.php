    {{@$products}}
    @foreach($products as $post)
    <tr>
        <td>{{ @$post->name }}</td>
        @if(isset($post->image ))
        <td><img src="{{ $post->image }}" alt="" style="width:50px;height:50px;"></td>
        @else
        <td></td>
        @endif
        <td>{{ @$post->price }}</td>
        <td>{{ @$post->min_purchase_qty }}</td>
        <td>{{ @$post->reward_points }}</td>

        <td>
            <input type="checkbox" name="status" value="{{ $post->id }}" {{ $post->active ? 'checked' : ''}}>
        </td>
        <td>{{ $post->created_at->formatLocalized('%c') }}</td>
        <td>
            <input type="checkbox" name="seen" value="{{ $post->id }}" {{ is_null($post->ingoing) ?  'disabled' : 'checked'}}>
        </td>
        {{-- <td>{{ $post->seo_title }}</td> --}}
        {{-- <td><a class="btn btn-success" href="{{ route('products.show', [$post->id]) }}" role="button" title="@lang('Show')"><span class="fa fa-eye"></span></a></td>--}}
        <td>
            <a class="btn btn-warning btn-sm" href="{{ route('products.edit', [$post->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a>
            <a class="btn btn-danger btn-sm" href="{{ route('products.destroy', [$post->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-trash"></span></a>
        </td>
    </tr>
    @endforeach