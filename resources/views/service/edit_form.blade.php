<div class="row">
    <div class="col-lg-12">
        <form class="needs-validation" novalidate method="post" enctype="multipart/form-data" action="{{ route($route.'.update',$item->id) }}">
            @method('put')
            @include($route.'.form')
            @include('components.edit_form_submit_btns')
        </form>
        <br>
    </div>
</div>

