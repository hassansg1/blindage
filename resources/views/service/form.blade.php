@include('components.form_errors')
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">General Info</h4>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}name" class="form-label required">Name</label>
                            <input type="text" value="{{ isset($item) ? $item->name:old('name') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}name"
                                   name="name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mt-3">
                            <br>
                            <div class="form-check">
                                <input class="form-check-input" name="active" type="checkbox" id="active">
                                <label class="form-check-label" for="active">
                                    This service is no longer offered
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}category" class="form-label">Category</label>
                            <select class="form-select" name="category" id="{{ isset($item) ? $item->id:'' }}category">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}service_id" class="form-label">
                                ID
                            </label>
                            <input type="text" value="{{ isset($item) ? $item->service_id:old('service_id') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}service_id"
                                   name="service_id">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="colorpicker-togglepaletteonly" class="form-label">Appt. Color</label>
                            <input type="text" class="form-control spectrum with-add-on" name="color"
                                   id="colorpicker-togglepaletteonly"
                                   value="{{ isset($item) ? $item->color:old('color') ?? ''  }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}minutes" class="form-label">Duration</label>
                            <input name="minutes" data-toggle="touchspin" id="{{ isset($item) ? $item->id:'' }}minutes"
                                   type="text"
                                   value="{{ isset($item) ? $item->minutes:old('minutes') ?? ''  }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}price" class="form-label">Price </label>
                            <input name="price" data-toggle="touchspin" id="{{ isset($item) ? $item->id:'' }}price"
                                   type="text"
                                   data-bts-prefix="$"
                                   value="{{ isset($item) ? $item->price:old('price') ?? ''  }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
