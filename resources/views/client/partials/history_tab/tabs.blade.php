<div class="col-md-2">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
         aria-orientation="vertical">
        <a class="nav-link mb-2 active" id="v-pills-visit-summary-tab" data-bs-toggle="pill"
           href="#v-pills-visit-summary"
           role="tab" aria-controls="v-pills-visit-summary" aria-selected="true">Visit Summary</a>

        <a class="nav-link mb-2" id="v-pills-upcoming-appts-tab" data-bs-toggle="pill"
           href="#v-pills-upcoming-appts"
           role="tab" aria-controls="v-pills-upcoming-appts" aria-selected="false" onclick="getAppointmentData('{{ $item->id }}','{{ App\Models\AppointmentBook::UPCOMMING_APPT }}')">Upcoming Appts</a>

        <a class="nav-link mb-2" id="v-pills-previous-services-tab" data-bs-toggle="pill"
           href="#v-pills-upcoming-appts"
           role="tab" aria-controls="v-pills-previous-services" aria-selected="false" onclick="getAppointmentData('{{ $item->id }}','{{ App\Models\AppointmentBook::PREVIOUS_SERVICES }}')">Previous Services</a>

        <a class="nav-link mb-2" id="v-pills-purchased-products-tab" data-bs-toggle="pill"
           href="#v-pills-upcoming-appts"
           role="tab" aria-controls="v-pills-purchased-products" aria-selected="false" onclick="getAppointmentData('{{ $item->id }}','{{ App\Models\AppointmentBook::PURCHASED_PRODUCT }}')">Purchased Products</a>

        <a class="nav-link mb-2" id="v-pills-cancelled-appts-tab" data-bs-toggle="pill"
           href="#v-pills-upcoming-appts"
           role="tab" aria-controls="v-pills-cancelled-appts" aria-selected="false" onclick="getAppointmentData('{{ $item->id }}','{{ App\Models\AppointmentBook::CANCELED }}')">Cancelled Appts</a>

        {{-- <a class="nav-link mb-2" id="v-pills-other-purchases-tab" data-bs-toggle="pill"
           href="#v-pills-upcoming-appts"
           role="tab" aria-controls="v-pills-other-purchases" aria-selected="false" onclick="getAppointmentData('{{ $item->id }}','{{ App\Models\AppointmentBook::OTHER_PURCHASES }}')">Other Purchases</a> --}}
    </div>
</div>
