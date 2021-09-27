<div class="card">
    <div class="card-body">
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

        <!-- Tab panes -->
        <div class="tab-content p-3 text-muted">
            <div class="tab-pane active" id="Calendar" role="tabpanel">
                <br>
               @include('appointment_book.tabs.calender')
            </div>
            <div class="tab-pane" id="appointment-list" role="tabpanel">
                <p class="mb-0">
                    Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                    single-origin coffee squid. Exercitation +1 labore velit, blog
                    sartorial PBR leggings next level wes anderson artisan four loko
                    farm-to-table craft beer twee. Qui photo booth letterpress,
                    commodo enim craft beer mlkshk aliquip jean shorts ullamco ad
                    vinyl cillum PBR. Homo nostrud organic, assumenda labore
                    aesthetic magna delectus.
                </p>
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
