<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Item Name</th>
                            <th>Employee</th>
                            <th>Brand</th>
                            <th>Qty</th>
                            <th>Total Price
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($data))
                                @foreach($data as $appt_loop_variable)
                                    <tr>
                                        <td>
                                             {{ date('l, M d, Y',strtotime($appt_loop_variable->activity_date)) }}
                                        </td>
                                        <td>

                                        @foreach($appt_loop_variable->appointmentBookItems->where('serviceitemable_type','=',App\Models\Product::class) as $loop_variable)
                                            {{ $loop_variable->serviceitemable->name ?? '---' }}
                                        @endforeach
                                        </td>
                                        <td>
                                            
                                        @forelse($appt_loop_variable->appointments as $loop_var)
                                            @if(isset($loop_var->employee_type_id) && $loop_var->employee_type_id !=null)
                                        
                                               <span>{{ $loop_var->employee->getFirstAndLastName() }}</span>
                                              
                                            @endif
                                        @empty

                                        @endforelse
                                        </td>
                                        <td>
                                            @foreach($appt_loop_variable->appointmentBookItems->where('serviceitemable_type','=',App\Models\Product::class) as $loop_variable)
                                                {{ $loop_variable->serviceitemable->productBrand->name ?? '---' }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($appt_loop_variable->appointmentBookItems->where('serviceitemable_type','=',App\Models\Product::class) as $loop_variable)
                                                {{ $loop_variable->serviceitemable->productBrand->name ?? '---' }}
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $appt_loop_variable->appointmentBookItems->where('serviceitemable_type','=',App\Models\Product::class)->sum('price') ?? '---' }}
                                          
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
