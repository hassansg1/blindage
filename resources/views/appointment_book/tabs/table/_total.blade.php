<td>
    {{ ($loop_variable->appointments->sum('price')) +  $loop_variable->appointmentBookItems->where('serviceitemable_type','=',App\Models\Package::class)->sum('price') }}
</td>