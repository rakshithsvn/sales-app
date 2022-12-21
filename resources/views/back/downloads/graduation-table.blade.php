@foreach($registered_forms as $registered_form)
<tr>
    <td style="display:none;">{{ $registered_form->id }}</td>
    <td>{{ @$registered_form->user->name }}</td>
    <td>{{ @$registered_form->product->name }}</td>
    <td>{{ @$registered_form->quantity }}</td>    
    <td>{{ @$registered_form->dealer->name }}</td>
    <td>{{ @$registered_form->active }}</td>    
    <td>{{ @$registered_form->created_at->format('d/m/Y') }}</td>    
    <td align="center"><a href="{{@$registered_form->invoice_url}}" target="_blank"><i class="fa fa-download" title="Click to download" aria-hidden="true" style="font-size:15px"></i></a></td> 
    <td><a class="btn btn-danger btn-xs btn-block" href="{{ route('graduation.destroy', [$registered_form->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-remove"></span></a></td>  
    <td><a  class="btn btn-info btn-xs btn-block" href="{{ route('prospects.graduation-view', [$registered_form->id]) }}" role="button" title="@lang('View')"><span class="fa fa-eye"></span></a></td>   
</tr>
@endforeach



