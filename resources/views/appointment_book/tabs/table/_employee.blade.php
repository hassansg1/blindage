 <td>
    @forelse($loop_variable->appointments as $loop_var)
        @if(isset($loop_var->employee_type_id) && $loop_var->employee_type_id !=null)
    
           <div><span>Employee: </span> <span>{{ $loop_var->employee->getFirstAndLastName() }}</span></div>
           <div> {{ $loop_var->duration}} Min. ({{ $loop_var->start_time}} - {{ $loop_var->getEndTimeAttribute()}})</div>
        @endif
    @empty   
    @endforelse
</td>