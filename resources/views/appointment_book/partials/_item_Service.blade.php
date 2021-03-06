<div class="deleteRow">
	<div class="card">
		<h5 class="card-title card-heading mb-0">
        	<a href="#" onclick="deleteRow()">  {{ $getData->name ?? '' }} <i class="fas fa-times float-end close-btn"></i>
        	</a>
	     </h5>
	    <div class="card-body"> 
	        <input type="hidden" name="services[]" value="{{ $getData->id }}">
	         <div class="row mb-3">
	            <div class="col-lg-4">
	                <label
	                        class="form-label">Time Start </label>
	                <div class="input-group" id="timepicker-input-group1">
	                    <input id="timepicker" type="text" name="time_start[{{ $getData->id }}]" class="form-control schedule_details_modal_submit"
	                           value="{{ $start ?? '' }}"
	                           data-provide="timepicker">

	                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
	                </div>
	            </div>
	            <div class="col-lg-4">
	                <label
	                        class="form-label">Time Duration </label>
	                <div class="input-group" id="timepicker-input-group1">
	                    <input type="text" name="minutes[{{ $getData->id }}]" class="form-control schedule_details_modal_submit" value="{{ $duration ?? '' }}">

	                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
	                </div>
	            </div>
	            <div class="col-lg-4">
	                <label for="when" class="form-label required">Employee Type</label>
	                <select id="select_client_drop_down" name="employee_type_id[{{ $getData->id }}]" class="form-control select2 schedule_details_modal_submit">
	                    <option value="">Select</option>
	                    @foreach(\App\Models\Employee::all() as $loopVariable)
	                        <option value="{{ $loopVariable->id ?? '' }}">{{ $loopVariable->first_name ?? '' }} {{ $loopVariable->last_name ?? '' }}</option>
	                    @endforeach
	                </select>
	            </div>
	        </div>                
	        <div class="row">
	            <div class="col-lg-6">
	                <label for="when" class="form-label required">Quantity</label>
	                <input class="form-control schedule_details_modal_submit" name="quantity[{{ $getData->id }}]" value="1" type="text" placeholder="Quantity">
	            </div>
	            <div class="col-lg-6">
	                <label for="when" class="form-label required">Price</label>
	                <input class="form-control schedule_details_modal_submit" name="price[{{ $getData->id }}]" value="{{ $getData->price }}" type="text" placeholder="Price">
	            </div>
	        </div>
	    </div>
	    <!-- end card body -->
	</div>
</div>
