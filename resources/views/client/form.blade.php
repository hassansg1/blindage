@include('components.form_errors')
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Basic Information</h4>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}first_name" class="form-label required">First
                                Name</label>
                            <input type="text" value="{{ isset($item) ? $item->first_name:old('first_name') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}first_name"
                                   name="first_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required >
                                   <div class="invalid-feedback">
                                        Please Enter your First Name.
                                    </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}last_name" class="form-label required">Last
                                Name</label>
                            <input type="text" value="{{ isset($item) ? $item->last_name:old('last_name') ?? ''  }}"
                                   class="form-control" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" id="{{ isset($item) ? $item->id:'' }}last_name" name="last_name"
                                   required>
                                   <div class="invalid-feedback">
                                        Please Enter your Last Name.
                                    </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}category" class="form-label">Category</label>
                            <select class="form-select form-select-input" name="category" id="{{ isset($item) ? $item->id:'' }}category">
                                @foreach(getClientCategories() as $category)
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
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}mobile_no" class="form-label required">Phone
                                Number</label>
                            <input type="text" value="{{ isset($item) ? $item->mobile_no:old('mobile_no') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}mobile_no"
                                   name="mobile_no" onkeypress=" return isNumberOnly(this)" required>
                            <div class="invalid-feedback">
                                        Please Enter your Phone Number.
                                    </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}alt_mobile_no" class="form-label">
                                Alternate Phone
                            </label>
                            <input type="text"
                                   value="{{ isset($item) ? $item->alt_mobile_no:old('alt_mobile_no') ?? ''  }}"
                                   class="form-control" onkeypress=" return isNumberOnly(this)" id="{{ isset($item) ? $item->id:'' }}alt_mobile_no"
                                   name="alt_mobile_no">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}dob" class="form-label">Birth Date</label>
                            <input class="form-control" type="date" name="dob" max="{{date('Y-m-d')}}"
                                   value="{{ isset($item) ? $item->dob:old('dob') ?? ''  }}"
                                   id="{{ isset($item) ? $item->id:'' }}dob">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}email" class="form-label required">
                                Email
                            </label>
                            <input type="email" value="{{ isset($item) ? $item->email:old('email') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}email"
                                   name="email" required>
                            <div class="invalid-feedback">
                                Please Enter your Email.
                            </div>
                        </div>
                    </div>
                   {{--  <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}image" class="form-label required">
                                Profile picture
                            </label>
                            <input type="file"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}image"
                                   name="image" required>
                                <div class="invalid-feedback">
                                        Please Select Image.
                                    </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <br>
                            <p class="mb-2">Send appointment notifications to this client by:</p>
                            <div class="form-check">
                                <div class="mb-2">
                                    <input class="form-check-input" type="checkbox"
                                           name="appointment_email"  value="1"
                                           {{ (isset($item) ? $item->appointment_email:old('appointment_email') ?? '') == 1 ? 'checked' : '' }}
                                   id="byEmail">
                                    <label class="form-check-label" for="byEmail">
                                        Email
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" id="byText" name="appointment_message"  value="1"
                                        {{ (isset($item) ? $item->appointment_message:old('appointment_message') ?? '') == 1 ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="byText">
                                        Text Message
                                    </label>
                                </div>
                            </div>
                            <p class="mt-2">Messaging has not been enabled. Click here to enable messaging.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <br>
                            <p class="mb-2">Send marketing campaigns to this client by:</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="byMessage" name="marketing_mail" value="1"
                                    {{ (isset($item) ? $item->marketing_mail:old('marketing_mail') ?? '') == 1 ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="byMessage">
                                    Email
                                </label>
                            </div>
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
                                    This Client is no longer active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Address</h4>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}address_line_1" class="form-label">
                                Address Line 1
                            </label>
                            <input type="text"
                                   value="{{ isset($item) ? $item->address_line_1:old('address_line_1') ?? ''  }}"
                                   class="form-control" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" id="{{ isset($item) ? $item->id:'' }}address_line_1"
                                   name="address_line_1">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}address_line_2" class="form-label">
                                Address Line 2 (Apartment, Suite, etc.)
                            </label>
                            <input type="text"
                                   value="{{ isset($item) ? $item->address_line_2:old('address_line_2') ?? ''  }}"
                                   class="form-control" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" id="{{ isset($item) ? $item->id:'' }}address_line_2"
                                   name="address_line_2">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}city" class="form-label">
                                City / Town
                            </label>
                            <input type="text" value="{{ isset($item) ? $item->city:old('city') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}city"
                                   name="city">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}state" class="form-label">
                                State / Province
                            </label>
                            <input type="text" value="{{ isset($item) ? $item->state:old('state') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}state"
                                   name="state">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}postal_code" class="form-label">
                                Postal Code
                            </label>
                            <input type="text" value="{{ isset($item) ? $item->postal_code:old('postal_code') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}postal_code"
                                   name="postal_code">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Marketing Referral</h4>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}referral" class="form-label">Referral</label>
                            <select class="form-select form-select-input-no-add" name="referral" id="{{ isset($item) ? $item->id:'' }}referral">
                                @foreach(getReferrals() as $option)
                                    <option value=""></option>
                                    <option
                                        {{ $option->id == (isset($item) ? $item->referral:old('referral') ?? '') ? 'selected' : ''  }}
                                        value="{{ $option->id }}">{{ $option->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}comments" class="form-label">
                                General Client Comments
                            </label>
                            <textarea rows="3" class="form-control" id="{{ isset($item) ? $item->id:'' }}comments" name="comments">{{ isset($item) ? $item->comments:old('comments') ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
