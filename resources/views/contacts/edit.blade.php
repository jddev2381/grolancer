@extends('layouts.dashboard')


@section('content')

<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h3><i class="fa-solid fa-pen-to-square me-2"></i>Edit Contact</h3>
        </div>
        <div class="col-auto">
            <a href="/contacts/{{ $contact->id }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    

    <form action="/contacts/{{$contact->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ $contact->first_name }}">
                    <label for="first_name">First Name</label>
                    @error('first_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ $contact->last_name }}">
                    <label for="last_name">Last Name</label>
                    @error('last_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{ $contact->mobile }}">
                    <label for="mobile">Mobile #</label>
                    @error('mobile')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone #" value="{{ $contact->phone }}">
                    <label for="phone">Phone #</label>
                    @error('phone')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $contact->email }}">
                    <label for="email">Email Address</label>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="website" name="website" placeholder="www.example.com" value="{{ $contact->website }}">
                    <label for="website">Website</label>
                    @error('website')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $contact->title }}">
                    <label for="title">Title</label>
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <select class="form-select" id="type" name="type">
                        <option value="">Select A Type</option>
                        <option value="contact" {{ $contact->type == 'contact' ? 'selected' : '' }}>Contact</option>
                        <option value="prospect" {{ $contact->type == 'prospect' ? 'selected' : '' }}>Prospect</option>
                        <option value="lead" {{ $contact->type == 'lead' ? 'selected' : '' }}>Lead</option>
                        <option value="client" {{ $contact->type == 'client' ? 'selected' : '' }}>Client</option>
                        <option value="inactive client" {{ $contact->type == 'inactive client' ? 'selected' : '' }}>Inactive Client</option>
                        <option value="dead lead" {{ $contact->type == 'dead lead' ? 'selected' : '' }}>Dead Lead</option>
                        <option value="dnc" {{ $contact->type == 'dnc' ? 'selected' : '' }}>Do Not Contact</option>
                    </select>
                    <label for="type">Type</label>
                    @error('type')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Acme Corp." value="{{ $contact->company_name }}">
            <label for="company_name">Company Name</label>
            @error('company_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="street" name="street" placeholder="Street Address" value="{{ $contact->street }}">
            <label for="street">Street Address</label>
            @error('street')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ $contact->city }}">
                    <label for="city">City</label>
                    @error('city')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-floating mb-3">
                    <select class="form-select" id="state" name="state">
                        <option value="">Select State</option>
                        <option value="AL" {{ $contact->state == 'AL' ? 'selected' : '' }}>Alabama</option>
                        <option value="AK" {{ $contact->state == 'AK' ? 'selected' : '' }}>Alaska</option>
                        <option value="AZ" {{ $contact->state == 'AZ' ? 'selected' : '' }}>Arizona</option>
                        <option value="AR" {{ $contact->state == 'AR' ? 'selected' : '' }}>Arkansas</option>
                        <option value="CA" {{ $contact->state == 'CA' ? 'selected' : '' }}>California</option>
                        <option value="CO" {{ $contact->state == 'CO' ? 'selected' : '' }}>Colorado</option>
                        <option value="CT" {{ $contact->state == 'CT' ? 'selected' : '' }}>Connecticut</option>
                        <option value="DE" {{ $contact->state == 'DE' ? 'selected' : '' }}>Delaware</option>
                        <option value="FL" {{ $contact->state == 'FL' ? 'selected' : '' }}>Florida</option>
                        <option value="GA" {{ $contact->state == 'GA' ? 'selected' : '' }}>Georgia</option>
                        <option value="HI" {{ $contact->state == 'HI' ? 'selected' : '' }}>Hawaii</option>
                        <option value="ID" {{ $contact->state == 'ID' ? 'selected' : '' }}>Idaho</option>
                        <option value="IL" {{ $contact->state == 'IL' ? 'selected' : '' }}>Illinois</option>
                        <option value="IN" {{ $contact->state == 'IN' ? 'selected' : '' }}>Indiana</option>
                        <option value="IA" {{ $contact->state == 'IA' ? 'selected' : '' }}>Iowa</option>
                        <option value="KS" {{ $contact->state == 'KS' ? 'selected' : '' }}>Kansas</option>
                        <option value="KY" {{ $contact->state == 'KY' ? 'selected' : '' }}>Kentucky</option>
                        <option value="LA" {{ $contact->state == 'LA' ? 'selected' : '' }}>Louisiana</option>
                        <option value="ME" {{ $contact->state == 'ME' ? 'selected' : '' }}>Maine</option>
                        <option value="MD" {{ $contact->state == 'MD' ? 'selected' : '' }}>Maryland</option>
                        <option value="MA" {{ $contact->state == 'MA' ? 'selected' : '' }}>Massachusetts</option>
                        <option value="MI" {{ $contact->state == 'MI' ? 'selected' : '' }}>Michigan</option>
                        <option value="MN" {{ $contact->state == 'MN' ? 'selected' : '' }}>Minnesota</option>
                        <option value="MS" {{ $contact->state == 'MS' ? 'selected' : '' }}>Mississippi</option>
                        <option value="MO" {{ $contact->state == 'MO' ? 'selected' : '' }}>Missouri</option>
                        <option value="MT" {{ $contact->state == 'MT' ? 'selected' : '' }}>Montana</option>
                        <option value="NE" {{ $contact->state == 'NE' ? 'selected' : '' }}>Nebraska</option>
                        <option value="NV" {{ $contact->state == 'NV' ? 'selected' : '' }}>Nevada</option>
                        <option value="NH" {{ $contact->state == 'NH' ? 'selected' : '' }}>New Hampshire</option>
                        <option value="NJ" {{ $contact->state == 'NJ' ? 'selected' : '' }}>New Jersey</option>
                        <option value="NM" {{ $contact->state == 'NM' ? 'selected' : '' }}>New Mexico</option>
                        <option value="NY" {{ $contact->state == 'NY' ? 'selected' : '' }}>New York</option>
                        <option value="NC" {{ $contact->state == 'NC' ? 'selected' : '' }}>North Carolina</option>
                        <option value="ND" {{ $contact->state == 'ND' ? 'selected' : '' }}>North Dakota</option>
                        <option value="OH" {{ $contact->state == 'OH' ? 'selected' : '' }}>Ohio</option>
                        <option value="OK" {{ $contact->state == 'OK' ? 'selected' : '' }}>Oklahoma</option>
                        <option value="OR" {{ $contact->state == 'OR' ? 'selected' : '' }}>Oregon</option>
                        <option value="PA" {{ $contact->state == 'PA' ? 'selected' : '' }}>Pennsylvania</option>
                        <option value="RI" {{ $contact->state == 'RI' ? 'selected' : '' }}>Rhode Island</option>
                        <option value="SC" {{ $contact->state == 'SC' ? 'selected' : '' }}>South Carolina</option>
                        <option value="SD" {{ $contact->state == 'SD' ? 'selected' : '' }}>South Dakota</option>
                        <option value="TN" {{ $contact->state == 'TN' ? 'selected' : '' }}>Tennessee</option>
                        <option value="TX" {{ $contact->state == 'TX' ? 'selected' : '' }}>Texas</option>
                        <option value="UT" {{ $contact->state == 'UT' ? 'selected' : '' }}>Utah</option>
                        <option value="VT" {{ $contact->state == 'VT' ? 'selected' : '' }}>Vermont</option>
                        <option value="VA" {{ $contact->state == 'VA' ? 'selected' : '' }}>Virginia</option>
                        <option value="WA" {{ $contact->state == 'WA' ? 'selected' : '' }}>Washington</option>
                        <option value="WV" {{ $contact->state == 'WV' ? 'selected' : '' }}>West Virginia</option>
                        <option value="WI" {{ $contact->state == 'WI' ? 'selected' : '' }}>Wisconsin</option>
                        <option value="WY" {{ $contact->state == 'WY' ? 'selected' : '' }}>Wyoming</option>

                    </select>
                    <label for="state">State</label>
                    @error('state')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" value="{{ $contact->zip }}">
                    <label for="zip">Zip</label>
                    @error('zip')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>


        <div class="d-flex justify-content-end mb-3">
            <button type="submit" class="btn btn-logo">
                <i class="fa-solid fa-floppy-disk me-1"></i>  Update
            </button>
        </div>

    </form>

</div>


@endsection