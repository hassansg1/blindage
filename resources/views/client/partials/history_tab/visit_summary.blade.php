<div class="tab-pane fade show active" id="v-pills-visit-summary" role="tabpanel"
     aria-labelledby="v-pills-visit-summary-tab">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title-small">
                Visit Summary
            </h5>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-sm-6 text-center">
                        <p>Total Amount of Money Spent</p>
                        @php 
                        $total = $item->appointments->sum('price') + $item->appointmentBookItems->sum('price') ;
                        @endphp
                        <h4>$ {{ number_format($total,2) }} </h4>
                    </div>
                    <div class="col-sm-6 text-center left-line">
                        <p>Total # of Visits</p>
                        <h4>{{ count($item->appointments) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-sm-3 text-center">
                        <p>First Visit</p>
                        <h4>{{ count($item->appointments)>0 ? date('l, M d, Y',strtotime($item->appointmentBook->first()->activity_date)) :'N/A' }}</h4>
                    </div>
                    <div class="col-sm-3 text-center left-line">
                        <p>Last Visit</p>
                        <h4>{{ count($item->appointments)>0 ? date('l, M d, Y',strtotime($item->appointmentBook->last()->activity_date)) :'N/A' }}</h4>
                    </div>
                    <div class="col-sm-3 text-center left-line">
                        <p>No Shows</p>
                        <h4>{{ count($item->appointmentBook->where('status_flag',App\Models\AppointmentBook::NOSHOW))>0 ? count($item->appointmentBook->where('status_flag',App\Models\AppointmentBook::NOSHOW)):'0' }}</h4>
                    </div>
                    <div class="col-sm-3 text-center left-line">
                        <p>Cancelled</p>
                        <h4>{{ count($item->appointmentBook->where('status_flag',App\Models\AppointmentBook::CANCELED))>0 ? count($item->appointmentBook->where('status_flag',App\Models\AppointmentBook::CANCELED)):'0' }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>
