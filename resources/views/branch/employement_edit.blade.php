<div class="row">
    <div class="col-lg-12">
        <form class="needs-validation" novalidate method="post" enctype="multipart/form-data" action="{{ route($route.'.emp_update',$item->id) }}">
            @method('put')
            @include('branch.partials.employement_setup')
        </form>
        <br>
    </div>
</div>

