
<div class="top-nav-tabs-wrapper d-flex mb-2">
            <h3 class="mb-0">Appointment Book</h3>
            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#Calendar" role="tab">
                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                    <span class="d-none d-sm-block">Calendar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#appointment-list" role="tab">
                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                    <span class="d-none d-sm-block">Appointment List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#settings" role="tab">
                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                    <span class="d-none d-sm-block">Settings</span>
                </a>
            </li>
        </ul>
        </div>
<div class="">
    <div class="">
        <!-- Tab panes -->
        <div class="tab-content text-muted">
            <div class="tab-pane active" id="Calendar" role="tabpanel">
               @include('appointment_book.tabs.calender')
            </div>
            <div class="tab-pane" id="appointment-list" role="tabpanel">
               
            </div>
            <div class="tab-pane" id="settings" role="tabpanel">
                <p class="mb-0">
                    Etsy mixtape wayfarers, ethical wes anderson tofu before they
                    sold out mcsweeney's organic lomo retro fanny pack lo-fi
                    farm-to-table readymade. Messenger bag gentrify pitchfork
                    tattooed craft beer, iphone skateboard locavore carles etsy
                    salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                    Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                    mi whatever gluten-free carles.
                </p>
            </div>
        </div>

    </div>
</div>
