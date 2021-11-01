<div class="tab-content p-3 text-muted">
    <div class="tab-pane active" id="personal_info" role="tabpanel">
        @include($route.'.partials.personal_info')
    </div>
    <div class="tab-pane" id="employement-setup" role="tabpanel">
        @include($route.'.employement_edit')
    </div>
</div>
