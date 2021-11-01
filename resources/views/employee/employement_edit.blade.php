<div class="row">
    <div class="col-lg-12">
        <form method="post" enctype="multipart/form-data" action="{{ route($route.'.update_emp',$item->id) }}">
            @method('put')
            @include('employee.partials.employement_setup')
        </form>
        <br>
    </div>
</div>

