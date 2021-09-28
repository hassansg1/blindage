@include('components.form_errors')
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">General Info</h4>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}name" class="form-label required">Name</label>
                            <input type="text" value="{{ isset($item) ? $item->name:old('name') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}name"
                                   name="name" required>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mt-3">
                            <br>
                            <div class="form-check">
                                <input class="form-check-input" name="backbar_item" type="checkbox" id="backbar_item">
                                <label class="form-check-label" for="backbar_item">
                                    Backbar item
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}brand" class="form-label">Brand</label>
                            <select class="form-select form-select-input" name="brand"
                                    id="{{ isset($item) ? $item->id:'' }}brand">
                                @foreach(\App\Models\ProductBrand::all() as $brand)
                                    <option value=""></option>
                                    <option
                                        {{ $brand->id == (isset($item) ? $item->brand:old('last_name') ?? '') ? 'selected' : ''  }}
                                        value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}category" class="form-label">Category</label>
                            <select class="form-select form-select-input" name="category"
                                    id="{{ isset($item) ? $item->id:'' }}category">
                                @foreach(getProductCategories() as $category)
                                    <option value=""></option>
                                    <option
                                        {{ $category->id == (isset($item) ? $item->category:old('last_name') ?? '') ? 'selected' : ''  }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}size" class="form-label">Size</label>
                            <input type="text" value="{{ isset($item) ? $item->size:old('size') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}size"
                                   name="size">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}sku" class="form-label">SKU</label>
                            <input type="text" value="{{ isset($item) ? $item->sku:old('sku') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}sku"
                                   name="sku">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Pricing</h4>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}wholesale_price"
                                   class="form-label">Wholesale </label>
                            <input name="wholesale_price" data-toggle="touchspin"
                                   id="{{ isset($item) ? $item->id:'' }}wholesale_price"
                                   type="text"
                                   data-bts-prefix="$"
                                   value="{{ isset($item) ? $item->wholesale_price:old('wholesale_price') ?? ''  }}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}retail_price"
                                   class="form-label">Retail </label>
                            <input name="retail_price" data-toggle="touchspin"
                                   id="{{ isset($item) ? $item->id:'' }}retail_price"
                                   type="text"
                                   data-bts-prefix="$"
                                   value="{{ isset($item) ? $item->retail_price:old('retail_price') ?? ''  }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Inventory</h4>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}count" class="form-label">Stock
                                Count</label>
                            <input name="count" data-toggle="touchspin" id="{{ isset($item) ? $item->id:'' }}count"
                                   type="text"
                                   value="{{ isset($item) ? $item->count:old('count') ?? ''  }}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}supplier" class="form-label">Supplier</label>
                            <select class="form-select" name="supplier" id="{{ isset($item) ? $item->id:'' }}supplier">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <h4 class="card-title mb-4">Branches Inventory</h4>
                <div class="row">
                @foreach(getBranches() as $branch)
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="{{ isset($item) ? $item->id:'' }}count" class="form-label">{{ $branch->name }}</label>
                                <input name="inventory[{{ $branch->id }}]" data-toggle="touchspin" id="{{ isset($item) ? $branch->id:'' }}count"
                                       type="text"
                                       value="{{ isset($item) ? $branch->getInventory($item->id):old('count') ?? '' }}">
                            </div>
                        </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
