<div class="deleteRow">
	 <div class="card">
	 	<h5 class="card-title mb-0 card-heading">
        	<a href="#" onclick="deleteRow()">{{ $getData->name ?? '' }} @if(isset($getData->category) && $getData->category!=null) <b>( $getData->categoryData->name ) </b> @endif <i class="fas fa-times float-end close-btn"></i>
	        </a>
	    </h5>
	    <div class="card-body">
	        <input type="hidden" name="packages[]" value="{{ $getData->id }}">
	        <div class="row">
	            <div class="col-lg-6">
	                <label for="when" class="form-label required">Employee Type</label>
	                <select id="select_client_drop_down" name="employee_type_id[{{ $getData->id }}]" class="form-control select2 schedule_details_modal_submit">
	                    <option value="">Select</option>
	                    @foreach(\App\Models\Employee::all() as $loopVariable)
	                        <option value="{{ $loopVariable->id ?? '' }}">{{ $loopVariable->first_name ?? '' }} {{ $loopVariable->last_name ?? '' }}</option>
	                    @endforeach
	                </select>
	            </div>
	            <div class="col-lg-3">
	                <label for="when" class="form-label required">Quantity</label>
	                <input class="form-control schedule_details_modal_submit" name="quantity[{{ $getData->id }}]" value="1" type="text" placeholder="Quantity">
	            </div>
	            <div class="col-lg-3">
	                <label for="when" class="form-label required">Price</label>
	                <input class="form-control schedule_details_modal_submit" name="price[{{ $getData->id }}]" value="{{ $getData->price }}" type="text" placeholder="Price">
	            </div>
	        </div>
        	 <div class="row mt-3">
	            <div class="col-lg-6">
	            	<h3 class="heading-style">
                    Services:
                    </h3>
	            	<table class="table mb-0 table-hover table-striped">
					  <tbody>
					    <tr>
					      <th width="15%">2 x </th>
					      <td>Service 1</td>
					    </tr>
					    <tr>
					      <th width="15%">4 x </th>
					      <td>Package 2</td>
					    </tr>
	
			
					  </tbody>
					</table>
	            </div>
	            <div class="col-lg-6">
	            	<h3 class="heading-style">
                    Products:
                    </h3>
	            	<table class="table  mb-0 table-hover table-striped">
					  <tbody>
					    <tr>
					      <th width="15%">3 x </th>
					      <td>Product 1</td>
					    </tr>
					    <tr>
					      <th width="15%">2 x </th>
					      <td>Package 2</td>
					    </tr>
					   
					  </tbody>
					</table>
	            </div>
            </div>                       
	    </div>
	    <!-- end card body -->
	</div> 
</div>