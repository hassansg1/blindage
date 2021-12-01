<div class="row">
      <div class="col-md-12">
         <div class="scheduleTopBarWrapper mb-2">
            <div class="">
               <div class="icon-wrapper d-flex verticaly-align-items">
{{--                  <i class="fa fa-calendar icon" aria-hidden="true"></i>--}}
                   <i class="fas fa-angle-left font-size-16 pr-10 cursor-pointer" onclick="getDateRange('pre')"></i>
                   <input class="form-control" type="hidden" id="lastDate" value="{{date("Y-m-d", strtotime("+1 week"))}}" />
                   <span id="dateRangeValue">{{date("Y-m-d") .' - '. date("Y-m-d", strtotime("+1 week"))}}</span>
                   <i class="fas fa-angle-right font-size-16 pl-10 cursor-pointer" onclick="getDateRange('next')"></i>
               </div>
            </div>
            <div class="searchEmployee">
               <div class="icon-wrapper">
                  <i class="fa fa-search icon"></i>
                  <input class="form-control" type="text" name="" placeholder="Search by Employee">
               </div>
            </div>
            <div class="rolesSelect">
               <select class="form-select" id="inlineFormSelectPref">
                  <option selected="">All Roles</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
               </select>
            </div>
            <div class="scheAvail_unavail d-flex align-items-center">
               <div class="d-flex align-items-center gap-2">
                  <div class="sched-available"></div>
                  <span>Available</span>
               </div>
               <div class="d-flex align-items-center gap-2">
                  <div class="sched-unavailable"></div>
                  <span>Unavailable</span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="scheTableWrapper font-size-14">
            <table class="table table-bordered">
               <tbody id="calenderTable">


                 {!! getCurrentWeek() !!}

               </tbody>
            </table>
         </div>
      </div>
   </div>


   <!-- Available Modal -->
   <div class="modal fade" id="time_schedule_modal" tabindex="-1" aria-labelledby="available_modal" aria-hidden="true">
    <div class="modal-dialog">

        <form action="" id="branchDataForm">
            <input type="hidden" id="keyValue" name="keyValue">
{{--            {{ csrf_field() }}--}}
     <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" id="modalData">



</div>
<div class="modal-footer">
 <button type="button"  onclick="setBranchTime()" class="btn btn-primary">Save changes</button>
</div>
</div>
        </form>
    </div>
</div>
