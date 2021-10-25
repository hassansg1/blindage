<td>
    @forelse($loop_variable->appointments as $loop_var)
        <div>{{ isset($loop_var->service)?$loop_var->service->name:'' }} (Regular Service) </div>
        <div>Duration : {{ isset($loop_var->service)?$loop_var->service->minutes:'' }} Min.</div>
    @empty   
    @endforelse
    @forelse($loop_variable->appointmentBookItems->where('serviceitemable_type','=',App\Models\Package::class) as $app_book_items)
        @foreach($app_book_items->serviceitemable->service_items() as $loop_var)
            <div>{{ $loop_var->packageitemable->name }} (Package Service) </div>
            <div>{{ $loop_var->packageitemable->minutes }} Min.</div>
        @endforeach
    @empty   
    @endforelse
</td>