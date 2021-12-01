<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>Description</th>
                            <th>Employee</th>
                            <th>Qty</th>
                            <th>Total Price
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($data))
                                @foreach($data as $loop_variable)
                                <tr>
                                    <td>
                                        {{ date('l, M d, Y',strtotime($loop_variable->activity_date)) }}
                                    </td>
                                    <td>
                                        @forelse($loop_variable->appointments as $loop_var)
                                            <div>{{ isset($loop_var->start_time)? date('h:i A',strtotime($loop_var->start_time)) :'' }}</div>
                                        @empty   
                                        @endforelse
                                    </td>
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
                                    <td>
                                        @forelse($loop_variable->appointments as $loop_var)
                                            @if(isset($loop_var->employee_type_id) && $loop_var->employee_type_id !=null)
                                        
                                               <div><span>Employee: </span> <span>{{ $loop_var->employee->getFirstAndLastName() }}</span></div>
                                               <div> {{ $loop_var->duration}} Min. ({{ $loop_var->start_time}} - {{ $loop_var->getEndTimeAttribute()}})</div>
                                            @endif
                                        @empty

                                        @endforelse
                                    </td>
                                    <td>
                                        @forelse($loop_variable->appointments as $loop_var)
                                            <div>{{ isset($loop_var->quantity)?$loop_var->quantity:'' }}</div>
                                        @empty   
                                        @endforelse
                                    </td>
                                    <td>
                                        {{ ($loop_variable->appointments->sum('price')) +  $loop_variable->appointmentBookItems->where('serviceitemable_type','=',App\Models\Package::class)->sum('price') }}
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="6">
                                    No Record Found
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
