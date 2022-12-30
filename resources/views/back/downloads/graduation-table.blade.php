@foreach($registered_forms as $registered_form)
<tr>
    <td style="display:none;">{{ $registered_form->id }}</td>
    <td>{{ @$registered_form->user->name }}</td>
    <td>{{ @$registered_form->product->name }}</td>
    <td>{{ @$registered_form->quantity }}</td>
    <td>{{ @$registered_form->dealer->name }}</td>
    <td>
        @if(@$registered_form->status)
        <?php $btn_class = @$registered_form->status == 'APPROVED' ? 'btn-success' : (@$registered_form->status == 'REJECTED' ? 'btn-danger' : 'btn-primary'); ?>
        <button class="btn btn-xs btn-block btn-status {{@$btn_class}}" readonly disabled>{{ @$registered_form->status }}</button>
	@endif
    </td>
    <td>{{ @$registered_form->created_at->format('d/m/Y') }}</td>
    <td align="center"><a href="{{@$registered_form->invoice_url}}" target="_blank"><i class="fa fa-download" title="Click to download" aria-hidden="true" style="font-size:15px"></i></a></td>
    <td>
@if(!@$registered_form->status || @$registered_form->status == 'PENDING')
<form method="post" action="{{route('purchase-status')}}">
@csrf
<input type="hidden" value="{{ $registered_form->id }}" name="id" />
<input type="hidden" value="1" name="status" />
<button type="submit" class="btn btn-success btn-xs btn-block" title="@lang('Approve')"><span class="fa fa-check"></span></button>
</form>
<form method="post" action="{{route('purchase-status')}}">
@csrf
<input type="hidden" value="{{ $registered_form->id }}" name="id" />
<input type="hidden" value="0" name="status" />
<button type="submit" class="btn btn-danger btn-xs btn-block" title="@lang('Reject')"><span class="fa fa-remove"></span></button>
</form>
@endif
{{-- <a class="btn btn-danger btn-xs btn-block" href="{{ route('graduation.destroy', [$registered_form->id]) }}" role="button" title="@lang('Reject')"><span class="fa fa-remove"></span></a> --}}
<form>
<a class="btn btn-info btn-xs btn-block" href="{{ route('prospects.graduation-view', [$registered_form->id]) }}" role="button" title="@lang('View')"><span class="fa fa-eye"></span></a></td>
</form>
</tr>
@endforeach
