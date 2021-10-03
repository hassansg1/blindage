@include('components.form_errors')
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Cash Drawe</h4>
                <div class="row">

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}branchId" class="form-label">Branch</label>
                            <select class="form-select form-select-input" name="branch_id"
                                    id="{{ isset($item) ? $item->id:'' }}branchId">
{{--                                @foreach(getClientCategories() as $category)--}}
                                    <option value="1">Salon</option>
{{--                                    <option--}}
{{--                                        {{ $category->id == (isset($item) ? $item->category:old('price') ?? '') ? 'selected' : ''  }}--}}
{{--                                        value="{{ $category->id }}">{{ $category->name }}</option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}cashDate"
                                   class="form-label required">Date</label>
                            <input type="date" value="{{ isset($item) ? $item->cash_date:old('cash_date') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}cashDate" name="cash_date"
                                   required>
                            <div class="row" style="margin-top: 5px">

                                <div class="form-check col-lg-6">
                                    <input class="form-check-input" name="active" type="checkbox"
                                           {{ (isset($item) ? $item->is_time_selected:old('is_time_selected') ?? '') == '' ? 'checked' : '0' }}
                                           id="allDays" value="0">
                                    <label class="form-check-label" for="{{ isset($item) ? $item->id:'' }}allDays">
                                        All Days
                                    </label>
                                </div>
                                <div class="form-check col-lg-6">
                                    <input class="form-check-input" name="is_time_selected" type="checkbox"
                                           {{ (isset($item) ? $item->is_time_selected:old('is_time_selected') ?? '') == '1' ? 'checked' : '' }}
                                           id="customTime" value="1" onclick="setTimeFields()">
                                    <label class="form-check-label" for="{{ isset($item) ? $item->id:'' }}customTime">
                                        Custom Time
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4" id="timeRange"
                         style={{ (isset($item) ? $item->is_time_selected:old('is_time_selected') ?? '') == '' ? "display: none" : '' }} >
                        <div class="mb-3">

                            <label for="{{ isset($item) ? $item->id:'' }}timeRange"
                                   class="form-label ">Time Range</label>
                            <div class="row" id="{{ isset($item) ? $item->id:'' }}timeRange">
                            <div class="col-lg-6">
                            <input type="time" value="{{ isset($item) ? $item->time_from:old('time_from') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}timeFrom" name="time_from"
                                   >
                            </div>

                            <div class="col-lg-6">
                                    <input type="time" value="{{ isset($item) ? $item->time_to:old('time_to') ?? ''  }}"
                                           class="form-control" id="{{ isset($item) ? $item->id:'' }}timeTo" name="time_to"
                                    >
                            </div>
                            </div>
                        </div>
                    </div>
            </div>
                <div class="row">

                    <div class="col-lg-12">
                        <div class="mb-12">
                            <label for="{{ isset($item) ? $item->id:'' }}comment" class="form-label">Comment</label>
                            <input type="text" value="{{ isset($item) ? $item->comment:old('comment') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}comment" name="comment"
                                   required>
                        </div>
                    </div>
                </div>
        </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Counted Cash</h4>
                <label for="countedCash" class="form-label">Enter the bills and coins in the cash drawer.</label>
                <div class="row" id="countedCash">
                </div>
                @include('cash_drawer.partials.cash_items_table')
            </div>
        </div>
    </div>
</div>
@section('script')
    @include('cash_drawer.scripts.cash_script')
@endsection
