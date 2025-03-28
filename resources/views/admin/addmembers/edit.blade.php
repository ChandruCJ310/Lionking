@extends('MasterAdmin.layout')

@section('content')

<style>
  /* This will apply the font-size to all elements inside .small-font */
  .small-font,
  .small-font input,
  .small-font select,
  .small-font textarea,
  .small-font label,
  .small-font button {
      font-size: 0.85rem;
  }
  .custom-btn {
    display: inline-flex; /* Ensures both button and link behave the same */
    align-items: center; /* Centers text vertically */
    justify-content: center; /* Centers text horizontally */
    text-align: center;
    text-decoration: none;
    background: rgb(30,144,255);
    background: linear-gradient(159deg, rgba(30,144,255,1) 0%, rgba(153,186,221,1) 100%);
    border: none;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 24px;
    transition: 0.3s;
    min-width: 140px; /* Ensures both buttons have the same minimum width */
    height: 40px; /* Set a fixed height */
}

.custom-btn:hover {
    background: linear-gradient(159deg, rgba(153,186,221,1) 0%, rgba(30,144,255,1) 100%);
    color: white;
}

a.custom-btn {
    display: inline-flex; /* Ensures `<a>` behaves like `<button>` */
    padding: 10px 20px;
}


</style>
<div class="container">
    <h2 class="mb-4"></h2>

    <!-- Show Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-lg">
        <div class="card-header text-white">
            <h5 class="mb-0">Edit Member</h5>
        </div>&nbsp;&nbsp;
        <div class="card-body">
        <form  class="small-font" action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="row">
        <!-- Personal Details Card -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    Personal Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Salutation -->
                        <div class="col-md-3">
                            <label>Salutation</label>
                            <input type="text" name="salutation" class="form-control" value="{{ $member->salutation }}">
                        </div>
                        <!-- First Name -->
                        <div class="col-md-3">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" value="{{ $member->first_name }}" required>
                        </div>
                        <!-- Last Name -->
                        <div class="col-md-3">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="{{ $member->last_name }}" required>
                        </div>
                        <!-- Suffix -->
                        <div class="col-md-3">
                            <label>Suffix</label>
                            <input type="text" name="suffix" class="form-control" value="{{ $member->suffix }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- Spouse Name -->
                        <div class="col-md-4">
                            <label>Spouse Name</label>
                            <input type="text" name="spouse_name" class="form-control" value="{{ $member->spouse_name }}">
                        </div>
                        <!-- Date of Birth -->
                        <div class="col-md-4">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" class="form-control" value="{{ $member->dob }}" >
                        </div>
                        <!-- Anniversary Date -->
                        <div class="col-md-4">
                            <label>Anniversary Date</label>
                            <input type="date" name="anniversary_date" class="form-control" value="{{ $member->anniversary_date }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- Profile Photo -->
                        <div class="col-md-4">
                            <label>Profile Photo</label>
                            <input type="file" name="profile_photo" class="form-control">
                            @if($member->profile_photo)
                                <img src="{{ asset('storage/app/public/' . $member->profile_photo) }}" class="mt-2" width="50">
                            @endif
                        </div>
                        <!-- Mailing Address Line 1 -->
                        <div class="col-md-4">
                            <label>Mailing Address Line 1</label>
                            <input type="text" name="mailing_address_line_1" class="form-control" value="{{ $member->mailing_address_line_1 }}">
                        </div>
                        <!-- Mailing Address Line 2 -->
                        <div class="col-md-4">
                            <label>Mailing Address Line 2</label>
                            <input type="text" name="mailing_address_line_2" class="form-control" value="{{ $member->mailing_address_line_2 }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- Mailing Address Line 3 -->
                        <div class="col-md-4">
                            <label>Mailing Address Line 3</label>
                            <input type="text" name="mailing_address_line_3" class="form-control" value="{{ $member->mailing_address_line_3 }}">
                        </div>
                        <!-- Mailing City -->
                        <div class="col-md-4">
                            <label>Mailing City</label>
                            <input type="text" name="mailing_city" class="form-control" value="{{ $member->mailing_city }}">
                        </div>
                        <!-- Mailing State/Province -->
                        <div class="col-md-4">
                            <label>Mailing State/Province</label>
                            <input type="text" name="mailing_state" class="form-control" value="{{ $member->mailing_state }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- Mailing Country -->
                        <div class="col-md-6">
                            <label>Mailing Country</label>
                            <input type="text" name="mailing_country" class="form-control" value="{{ $member->mailing_country }}">
                        </div>
                        <!-- Mailing Zip/Postal Code -->
                        <div class="col-md-6">
                            <label>Mailing Zip/Postal Code</label>
                            <input type="text" name="mailing_zip" class="form-control" value="{{ $member->mailing_zip }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Official Details Card -->
        <div class="col-md-6">
          <div class="card h-100">
                <div class="card-header">
                    Official Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Parent Multiple District -->
                        <div class="col-md-4">
                            <label>Parent Multiple District</label>
                            <select name="parent_multiple_district" id="parent_multiple_district" class="form-control" required>
                                <option value="">Select Multiple District</option>
                                @foreach($parentMultipleDistricts as $multipleDistrict)
                                    <option value="{{ $multipleDistrict->id }}" {{ $multipleDistrict->id == $member->parent_multiple_district ? 'selected' : '' }}>
                                        {{ $multipleDistrict->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Parent District -->
                        <div class="col-md-4">
                            <label>Parent District</label>
                            <select name="parent_district" id="parent_district" class="form-control" required>
        <option value="">Select District</option>
        @foreach($districts as $district)
            <option value="{{ $district->id }}" {{ $district->id == $member->parent_district ? 'selected' : '' }}>
                {{ $district->name }}
            </option>
        @endforeach
    </select>
                        </div>
                        <!-- Account Name -->
                        <div class="col-md-4">
                            <label>Account Name</label>
                            <select name="account_name" class="form-control" required>
                                <option value="">Select Account</option>
                                @foreach($chapters as $chapter)
                                    <option value="{{ $chapter->id }}" {{ $chapter->id == $member->account_name ? 'selected' : '' }}>
                                        {{ $chapter->chapter_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

               
                    <div class="row mt-3">
    <!-- Preferred Email -->
    <div class="col-md-3">
        <label>Preferred Email</label>
        <select name="preferred_email" class="form-control">
            <option value="official" {{ $member->preferred_email == 'official' ? 'selected' : '' }}>Official</option>
            <option value="personal" {{ $member->preferred_email == 'personal' ? 'selected' : '' }}>Personal</option>
        </select>
    </div>
    <!-- Personal Email -->
    <div class="col-md-3">
        <label>Personal Email</label>
        <input type="email" name="email_address" class="form-control" value="{{ $member->email_address }}">
    </div>
    <!-- Work Email -->
    <div class="col-md-3">
        <label>Work Email</label>
        <input type="email" name="work_email" class="form-control" value="{{ $member->work_email }}">
    </div>
    <!-- Alternate Email -->
    <div class="col-md-3">
        <label>Alternate Email</label>
        <input type="email" name="alternate_email" class="form-control" value="{{ $member->alternate_email }}">
    </div>
</div>

<div class="row mt-3"> 
    <!-- Preferred Phone -->
    <div class="col-md-3">
        <label>Preferred Phone</label>
        <select name="preferred_phone" class="form-control">
            <option value="mobile" {{ $member->preferred_phone == 'mobile' ? 'selected' : '' }}>Mobile</option>
            <option value="home" {{ $member->preferred_phone == 'home' ? 'selected' : '' }}>Home</option>
            <option value="work" {{ $member->preferred_phone == 'work' ? 'selected' : '' }}>Work</option>
        </select>
    </div>
    <!-- Mobile Number -->
    <div class="col-md-3">
        <label>Mobile Number</label>
        <input type="text" name="phone_number" class="form-control" value="{{ $member->phone_number }}">
    </div>
    <!-- Home Number -->
    <div class="col-md-3">
        <label>Home Number</label>
        <input type="text" name="home_number" class="form-control" value="{{ $member->home_number }}">
    </div>
    <!-- Work Number (always enabled) -->
    <div class="col-md-3">
        <label>Work Number</label>
        <input type="text" name="work_number" class="form-control" value="{{ $member->work_number }}">
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Email fields logic
    const preferredEmailSelect = document.querySelector('select[name="preferred_email"]');
    const personalEmailInput = document.querySelector('input[name="email_address"]');
    const workEmailInput = document.querySelector('input[name="work_email"]');
    const alternateEmailInput = document.querySelector('input[name="alternate_email"]');

    function updateEmailFields() {
        if (preferredEmailSelect.value === 'official') {
            // When "official" is selected, disable Personal Email
            personalEmailInput.disabled = true;
            workEmailInput.disabled = false;
            alternateEmailInput.disabled = false;
        } else if (preferredEmailSelect.value === 'personal') {
            // When "personal" is selected, disable Work Email
            personalEmailInput.disabled = false;
            workEmailInput.disabled = true;
            alternateEmailInput.disabled = false;
        }
    }

    preferredEmailSelect.addEventListener('change', updateEmailFields);
    updateEmailFields();

    // Phone fields logic
    const preferredPhoneSelect = document.querySelector('select[name="preferred_phone"]');
    const mobileNumberInput = document.querySelector('input[name="phone_number"]');
    const homeNumberInput = document.querySelector('input[name="home_number"]');
    const workNumberInput = document.querySelector('input[name="work_number"]');

    function updatePhoneFields() {
        if (preferredPhoneSelect.value === 'work') {
            // When "work" is selected:
            // - Mobile Number remains enabled
            // - Home Number is disabled
            mobileNumberInput.disabled = false;
            homeNumberInput.disabled = true;
        } else if (preferredPhoneSelect.value === 'home') {
            // When "home" is selected:
            // - Mobile Number is disabled
            // - Home Number is enabled
            mobileNumberInput.disabled = true;
            homeNumberInput.disabled = false;
        } else if (preferredPhoneSelect.value === 'mobile') {
            // When "mobile" is selected, enable both Mobile and Home Numbers
            mobileNumberInput.disabled = false;
            homeNumberInput.disabled = false;
        }
        // Work Number is always enabled
        workNumberInput.disabled = false;
    }

    preferredPhoneSelect.addEventListener('change', updatePhoneFields);
    updatePhoneFields();
});
</script>


<div class="row mt-3">
    <!-- Member ID -->
    <div class="col-md-4">
        <label>Member ID</label>
        <input type="text" name="member_id" class="form-control" value="{{ $member->member_id }}" required>
    </div>

    <!-- Membership Full Type -->
    <div class="col-md-4">
        <label>Membership Full Type</label>
        <select name="membership_full_type" class="form-control">
            @foreach($membershipTypes as $type)
                <option value="{{ $type->id }}" {{ $type->id == $member->membership_full_type ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Fax -->
    <div class="col-md-4">
        <label>Fax</label>
        <input type="text" name="fax" class="form-control" value="{{ $member->fax }}">
    </div>
</div>

<div class="row mt-3">
    <!-- Membership Type -->
    <div class="col-md-4">
        <label>Membership Type</label>
        <select name="membership_type" class="form-control">
            <option value="Leo Club" {{ $member->membership_type == 'Leo Club' ? 'selected' : '' }}>Leo Club</option>
            <option value="Lions Club" {{ $member->membership_type == 'Lions Club' ? 'selected' : '' }}>Lions Club</option>
        </select>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-2">
    <button type="submit" class="btn custom-btn">Update Member</button>
    <a href="{{ route('members.list') }}" class="btn custom-btn">Cancel</a>
</div>

</form>





        </div>
    </div>
</div>
@endsection
