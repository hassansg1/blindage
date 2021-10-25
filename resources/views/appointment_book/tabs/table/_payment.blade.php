 <td>
    @forelse($loop_variable->appointments as $loop_var)
        @if(isset($loop_var->price) && $loop_var->price !=null)
            <div> {{ $loop_var->price}} (Service)</div>
        @endif
    @empty   
    @endforelse

    @forelse($loop_variable->appointmentBookItems->where('serviceitemable_type','=',App\Models\Package::class) as $loop_var)
        @if(isset($loop_var->price) && $loop_var->price !=null)
            <div> {{ $loop_var->price}} (Package Service)</div>
        @endif
    @empty   
    @endforelse

   
    
</td>