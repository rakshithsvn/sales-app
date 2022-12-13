@foreach($faculties as $faculty)
<tr>
    <form method="post" action="{{ route('appointment.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="faculty_id" value="{{ $faculty->id }}">
    <td style="display:none;">{{ $faculty->id }}</td>
    <td>{{ $faculty->full_name }}</td>
    @if(isset($faculty->image))
    <td><img src="{{ $faculty->image }}" alt="" width="50px" height="50px"></td>
    @else
    <td></td>
    @endif
    {{-- <td>{{ $faculty->designation }}</td> --}}
    <td>
        <input type="hidden" name="appointment" value="0">
        <label class="switch"><input type="checkbox" name="appointment" value="{{ $faculty->id }}" {{ $faculty->appointment ? 'checked' : ''}}>
            <div class="slider round">
                <span class="on">ON</span><span class="off">OFF</span>
            </div>
        </label>        
    </td>
    <td>
        <input type="number" name="limit" value="{{ $faculty->limit }}" class="form-control">       
    </td>
    <td>
        @if($faculty->appointment == '1' || $faculty->from_date !== null)
        <div class="col-md-4">
          {{--   <label for="menus"> From Date</label> --}}

            <div class="input-group input-append date datePicker1">

              <input type="text" name="from_date" id="from_date" class="form-control" placeholder="DD/MM/YYYY" value="{{ $faculty->from_date ? $faculty->from_date->format('d/m/Y') : '' }}" autocomplete="off" required="">

              <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
          </div>

      </div> 

      <div class="col-md-4">
        {{-- <label for="menus"> To Date</label> --}}

        <div class="input-group input-append date datePicker2">

           <input type="text" name="to_date" id="to_date" class="form-control" placeholder="DD/MM/YYYY" value="{{ $faculty->to_date ? $faculty->to_date->format('d/m/Y') : '' }}" autocomplete="off" required="">

           <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
       </div>

   </div>     
  
    @if($faculty->from_date)
    <div class="col-md-1">
        <button type="submit" name="submit" class="btn btn-primary" title="UPDATE"><i class="fa fa-refresh" aria-hidden="true"></i></button>
    </div>
     <div class="col-md-2">
        <button type="submit" name="submit" class="btn btn-warning" value="unblock">@lang('UNBLOCK')</button>
    </div>
    @else
     <div class="col-md-2">
        <button type="submit" name="submit" class="btn btn-danger">@lang('&nbsp;&nbsp;&nbsp;BLOCK&nbsp;&nbsp;&nbsp;')</button>
        </div>
    @endif
    @else
    <td></td>
@endif
</td>
</form>
</tr>
@endforeach



