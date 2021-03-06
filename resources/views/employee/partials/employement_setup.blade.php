@include('components.form_errors')
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">
<div class="card">
    <div class="card-body">
        <h4 class="card-heading">
            Cloud Account Information
        </h4>
        <p class="card-title-desc">Set up an account for this employee to allow them to log in online and from a mobile
            device.</p>
        <div class="col-xs-12">
            <div class="row">
                <textarea placeholder="Insert a new note " name="setup" id="{{ isset($item) ? $item->id: '' }}setup" cols="30" rows="5">{{ isset($item) ? $item->setup:old('setup') ?? '' }}</textarea>
            </div>
        </div>
    </div>
</div>
<div style="text-align: right">
    <button type="submit" class="btn btn-primary w-md submit_form">Save</button>
</div>
