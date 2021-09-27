@include('components.form_errors')
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Package Information</h4>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}name" class="form-label required">Name</label>
                            <input type="text" value="{{ isset($item) ? $item->name:old('name') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}name"
                                   name="name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}price"
                                   class="form-label required">Price</label>
                            <input type="text" value="{{ isset($item) ? $item->price:old('price') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}price" name="price"
                                   required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}category" class="form-label">Category</label>
                            <select class="form-select form-select-input" name="category"
                                    id="{{ isset($item) ? $item->id:'' }}category">
                                @foreach(getClientCategories() as $category)
                                    <option value=""></option>
                                    <option
                                        {{ $category->id == (isset($item) ? $item->category:old('price') ?? '') ? 'selected' : ''  }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <br>
                            <div class="form-check">
                                <input type="hidden" name="active" value="1">
                                <input class="form-check-input" name="active" type="checkbox"
                                       {{ (isset($item) ? $item->active:old('active') ?? '') == 0 ? 'checked' : '' }}
                                       id="{{ isset($item) ? $item->id:'' }}active" value="0">
                                <label class="form-check-label" for="{{ isset($item) ? $item->id:'' }}active">
                                    This package is no longer active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Services & Products</h4>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <select id="product_package_search" onchange="selectProductForPackage()" class="form-control select2">
                                <option>Search by name</option>
                                <optgroup label="Products">
                                    @foreach(getProducts() as $product)
                                        <option data-modal="Product" value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Services">
                                    @foreach(getServices() as $service)
                                        <option data-modal="Service" value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            <div id="Service1"></div>
                        </div>
                        <br>
                    </div>
                </div>
                @include('package.partials.package_items_table')
            </div>
        </div>
    </div>
</div>
@section('script')
    @include('package.scripts.package_script')
@endsection
