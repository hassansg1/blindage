<div class="deleteRow">
	<h3>Package</h3>
	<div class="card">
	    <div class="card-body">

	        <h5 class="card-title mb-4">
	        	<a href="#" onclick="deleteRow()">{{ $getData->name ?? '' }} <i class="fas fa-window-close"></i>
		        	</a>
	        </h5>
	        
	        <input type="hidden" name="packages[]" value="{{ $getData->id }}">
	         
	        <div class="row">
	            <div class="mb-3">
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
	            <div class="mb-3">
	                <label for="when" class="form-label required">Quantity</label>
	                <input class="form-control schedule_details_modal_submit" name="quantity[{{ $getData->id }}]" value="1" type="text" placeholder="Quantity">
	            </div>
	        </div>
	         <div class="row">
	            <div class="mb-3">
	                <label for="when" class="form-label required">Price</label>
	                <input class="form-control schedule_details_modal_submit" name="price[{{ $getData->id }}]" value="{{ $getData->retail_price }}" type="text" placeholder="Price">
	            </div>
	        </div>

	    </div>
	    <!-- end card body -->
	</div>
</div>