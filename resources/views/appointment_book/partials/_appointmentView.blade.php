<div class="modal-content">
   <div class="modal-header">
      <h5 class="modal-title">Client Information </h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body">
      <div class="client-summary-wrapper client-summary-modal">
         <div class="client-summary-info-main-wrapper">
         <div class="client-summary-info">
            <div class="client-pic-wrapper">
               <div class="client-pic">
                  AY
               </div>
            </div>
            <div class="client-info-detail">
               <div class="client-name">
                  <h4>{{ isset($data->client->first_name)?$data->client->first_name:''}} {{ isset($data->client->last_name)?$data->client->last_name:'' }}</h4>
               </div>
               @if(isset($data->client->mobile_no) && $data->client->mobile_no!=null)
               <div class="mb-2 icon-wrapper">
                  <i class="fas fa-phone-alt icon"></i>
                  <div>
                     {{  isset($data->client->mobile_no)?$data->client->mobile_no:'' }} {{ isset($data->client->alt_mobile_no)? ' (&) '.$data->client->alt_mobile_no:''  }}
                  </div>
               </div>
               @endif
               @if(isset($data->client->email) && $data->client->email!=null)
               <div class="icon-wrapper mb-2">
                  <i class="fas fa-envelope icon"></i>
                  <div>{{  isset($data->client->email)?$data->client->email:'' }}</div>
               </div>
               @endif
               <div class="mb-3 box-wrapper">
                  <i class="fas fa-clock"></i>
                  <div class="">
                     <div>
                        @forelse($data->appointments as $loop_variable)
                        Session
                        <span>
                        {{ $loop_variable->start_time}}
                        </span>  
                        -  
                        <span>
                        {{$loop_variable->getEndTimeAttribute()}}
                        </span>
                        <br>
                        @empty
                        @endforelse
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
                        @forelse($data->appointments as $loop_variable)
                        <div>{{ isset($loop_variable->service)?$loop_variable->service->name:'' }} (Regular Service) </div>
                        <div>{{ isset($loop_variable->service)?$loop_variable->service->minutes:'' }} Min.</div>
                        @empty   
                        @endforelse
                        @forelse($data->appointmentBookItems->where('serviceitemable_type','=',App\Models\Package::class) as $app_book_items)
                        @foreach($app_book_items->serviceitemable->service_items() as $loop_variable)
                        <div>{{ $loop_variable->packageitemable->name }} (Package Service) </div>
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
            </div>

            
         </div>
          <div class="mt-3 text-center">
               <div class="btn btn-primary primary-alt" id="cancelApptBtn">Cancel Appt.</div>
               <div class="btn btn-primary" data-bs-dismiss="modal">Schedule</div>
            </div>
            </div>
         <div class="client-cancel-info">
             <h3 class="text-center">Cancel Appointment?</h3>
             <div class="text-center"><i class="fa fa-times-circle-o" aria-hidden="true"></i></div>
             <p>This appointment will be canceled and removed from the appointment book.</p>
             <div class="form-chec mb-3">
                 <input class="form-check-input" type="checkbox" id="byMessage" name="marketing_mail" value="1" /> <label class="form-check-label" for="byMessage"> Mark as No Show (QWicQEzvCJ did not appear for this appointment) </label>
             </div>
             <textarea class="form-control" placeholder="Reason for Cancellation?"></textarea>
             <div class="mt-3 text-center">
               <div class="btn btn-primary primary-alt" id="backToCardBtn">Back to Card</div>
               <div class="btn btn-primary" data-bs-dismiss="modal">Cancel Appointment</div>
            </div>
         </div>

      </div>
   </div>
   
</div>
@include('appointment_book.form_script')