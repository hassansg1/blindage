<div class="modal-content">
   <div class="modal-header">
      <h5 class="modal-title">Client Information </h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   {{-- {{ dd($data->first()->appointmentBook->appointmentBookItems[0]->serviceitemable->service_items()) }} --}}
   {{-- {{ dd($data->first()->appointmentBook->appointmentBookItems->where('serviceitemable_type','=',App\Models\Package::class)) }} --}}
   
{{-- {{ dd($data) }} --}}
   <div class="modal-body">
      <div class="client-summary-wrapper client-summary-modal">
         <div class="client-summary-info">
            <div class="client-pic-wrapper">
               <div class="client-pic">
                  AY
               </div>
            </div>
            {{-- {{ dd($data) }} --}}
            <div class="client-info-detail">
               <div class="client-name">
                  <h4>{{ isset($data->client->first_name)?$data->client->first_name:''}} {{ isset($data->client->last_name)?$data->client->last_name:'' }}</h4>
               </div>
               <div class="mb-2 icon-wrapper">
                  <i class="fas fa-phone-alt icon"></i>
                  <div>
                     {{  isset($data->client->mobile_no)?$data->client->mobile_no:'' }} {{ isset($data->client->alt_mobile_no)? ' (&) '.$data->client->alt_mobile_no:''  }}
                  </div>
               </div>
               <div class="icon-wrapper mb-2">
                  <i class="fas fa-envelope icon"></i>
                  <div>{{  isset($data->client->email)?$data->client->email:'' }}</div>
               </div>
               <div class="mb-3 box-wrapper">
                  <i class="fas fa-clock"></i>
                  <div class="">
                     <div>
                        <span>
                           {{-- {{ $data->first()->start_time}} --}}
                           </span>  
                              -  
                           <span>
                              
                           {{-- {{ $data->first()->getEndTimeAttribute()}} --}}
                        </span>
                     </div>
                     <div>
                         {{  date('l, M d, Y',strtotime($data->activity_date)) }}
                        
                     </div>
                  </div>
               </div>
               <div class="mb-3 box-wrapper">
                  <i class="fas fa-file-signature"></i>
                  <div class="">
                     <div>
                        
                        @forelse($data->appointmentBookItems->where('serviceitemable_type','=',App\Models\Package::class) as $app_book_items)
                           @foreach($app_book_items->serviceitemable->service_items() as $loop_variable)
                              <div>{{ $loop_variable->packageitemable->name }} (Service) </div>
                              <div>{{ $loop_variable->packageitemable->minutes }} Min.</div>
                           @endforeach
                        @empty   
                        @endforelse
                     </div>
                     
                  </div>
               </div>

               @if(isset($data->employee_type_id) && $data->employee_type_id !=null)
               <div class="mb-3 box-wrapper">
                  <i class="fas fa-address-card"></i>
                  <div class="">
                     <div><span>Employee: </span> <span>{{ $data->first()->employee->getFirstAndLastName() }}</span></div>
                     <div> {{ $data->first()->duration}} Min. ({{ $data->first()->start_time}} - {{ $data->first()->getEndTimeAttribute()}})</div>
                  </div>
               </div>
               @endif
             {{--   <div class="box-wrapper">
                  <i class="fas fa-bell"></i>
                  <div class="">
                     <div><span>Employee:</span> <span>Ateeq Yousaf</span></div>
                     <div> 30 Min. (6:45 p.m. - 7:15 p.m.)</div>
                  </div>
               </div> --}}
            </div>
         </div>
      </div>
   </div>
   <div class="modal-footer">
      <div class="btn btn-primary primary-alt">Appt. Details</div>
      <div class="btn btn-primary" data-bs-dismiss="modal">Schedule</div>
   </div>
</div>