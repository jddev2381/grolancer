@extends('layouts.dashboard')


@section('content')

<div class="container-fluid p-4">

    <div class="row d-flex align-items-center justify-content-between mb-4">
        <div class="col">
            <h3>Add Contact</h3>
        </div>
        <div class="col-auto">
            <a href="/contacts" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Contacts
            </a>
        </div>
    </div>

    

    <form action="/contacts" method="POST">
        @csrf

        <div class="row">
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                    <label for="first_name">First Name</label>
                    @error('first_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
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
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{ old('mobile') }}">
                    <label for="mobile">Mobile #</label>
                    @error('mobile')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone #" value="{{ old('phone') }}">
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
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    <label for="email">Email Address</label>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="website" name="website" placeholder="www.example.com" value="{{ old('website') }}">
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
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
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
                        <option value="contact">Contact</option>
                        <option value="prospect">Prospect</option>
                        <option value="lead">Lead</option>
                        <option value="client">Client</option>
                        <option value="inactive client">Inactive Client</option>
                        <option value="dead lead">Dead Lead</option>
                        <option value="dnc">Do Not Contact</option>
                    </select>
                    <label for="type">Type</label>
                    @error('type')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Acme Corp." value="{{ old('company_name') }}">
            <label for="company_name">Company Name</label>
            @error('company_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="street" name="street" placeholder="Street Address" value="{{ old('street') }}">
            <label for="street">Street Address</label>
            @error('street')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ old('city') }}">
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
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>

                    </select>
                    <label for="state">State</label>
                    @error('state')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" value="{{ old('zip') }}">
                    <label for="zip">Zip</label>
                    @error('zip')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>


        


        <div class="d-flex justify-content-end mb-3">
            <button type="submit" class="btn btn-logo">
                <i class="fa-solid fa-plus me-1"></i> Add Contact
            </button>
        </div>

    </form>

</div>


@endsection