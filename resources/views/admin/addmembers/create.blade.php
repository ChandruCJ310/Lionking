@extends('MasterAdmin.layout')
@section('content')
<style>
    .custom-btn {
    background: rgb(30,144,255);
    background: linear-gradient(159deg, rgba(30,144,255,1) 0%, rgba(153,186,221,1) 100%);
    border: none;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 24px;
    transition: 0.3s;
}

.custom-btn:hover {
    background: linear-gradient(159deg, rgba(153,186,221,1) 0%, rgba(30,144,255,1) 100%);
    color: white;
}


  
    .form-label {
        font-size: 14px;
    }

    .form-control {
        font-size: 12px;
    }

    .form-control::placeholder {
        font-size: 12px;
    }

    @media (max-width: 768px) {
    .form-label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px; /* Add spacing between label and input */
    }
    .form-control {
        margin-bottom: 15px; /* Add spacing between input fields */
    }
}
</style>


<div class="container mt-4">
    <div class="card">
        <div class="card-header text-white">
      
            <h4>Add Member</h4>
           
          
        </div>&nbsp;&nbsp;
        <div class="card-body">
        @include('admin.partial.alerts')
        <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data"  >
    @csrf

 
    <div class="row mb-4">
        <div class="col-md-6">
      
   <!-- Personal Details Card -->
  
        <div class="card" >
    <div class="card-header">
        <strong>Personal Details</strong>
    </div>
    <div class="card-body">
  
<!-- First Row (Salutation, First Name, Last Name, Suffix) -->
<div class="row">
    <div class="col-md-2">
        <label class="form-label">Salutation</label>
        <input type="text" name="salutation" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>
    <div class="col-md-2">
        <label class="form-label">Suffix</label>
        <input type="text" name="suffix" class="form-control">
    </div>
</div>

        <!-- Second Row ( Spouse Name, Date of Birth,anniversary) -->
        <div class="row mt-3">
        
            <div class="col-md-4">
                <label class="form-label">Spouse Name</label>
                <input type="text" name="spouse_name" class="form-control" >
            </div>
            <div class="col-md-4">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Anniversary Date</label>
                <input type="date" name="anniversary_date" class="form-control">
            </div>
        </div>

        <!-- Third Row ( Profile Photo, Mailing Address Line 1,Mailing Address Line 2) -->
        <div class="row mt-3">
         
            <div class="col-md-4">
                <label class="form-label">Profile Photo</label>
                <input type="file" name="profile_photo" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Mailing Address Line 1</label>
                <input type="text" name="mailing_address_line_1" class="form-control" >
            </div>
            <div class="col-md-4">
                <label class="form-label">Mailing Address Line 2</label>
                <input type="text" name="mailing_address_line_2" class="form-control" >
            </div>
        </div>

        <!-- Fourth Row ( Mailing Address Line 3, Mailing City,Mailing State/Province) -->
        <div class="row mt-3">
           
            <div class="col-md-4">
                <label class="form-label">Mailing Address Line 3</label>
                <input type="text" name="mailing_address_line_3" class="form-control" >
            </div>
            <div class="col-md-4">
                <label class="form-label">Mailing City</label>
                <input type="text" name="mailing_city" class="form-control" placeholder="City">
            </div>
            <div class="col-md-4">
                <label class="form-label">Mailing State/Province</label>
                <input type="text" name="mailing_state" class="form-control" >
            </div>
        </div>

        <!-- Fifth Row (Mailing Country, Mailing Zip/Postal Code) -->
        <div class="row mt-3">
          
            <div class="col-md-4">
                <label class="form-label">Mailing Country</label>
                <input type="text" name="mailing_country" class="form-control" >
            </div>
            <div class="col-md-4">
                <label class="form-label">Mailing Zip/Postal Code</label>
                <input type="text" name="mailing_zip" class="form-control" >
            </div>
        </div>
    </div>
</div>







        </div>

        <!-- Official Details Card -->
 <!-- Official Details -->
<div class="col-md-6">
    <div class="card h-100">
        <div class="card-header">
            <strong>Official Details</strong>
        </div>
        <div class="card-body">
            <!-- First Row (Parent Multiple District, Parent District, Account Name) -->
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Parent Multiple District</label>
                    <select name="parent_multiple_district" id="parent_multiple_district" class="form-control" required>
                        <option value="">Select Multiple District</option>
                        @foreach($parentMultipleDistricts as $multipleDistrict)
                            <option value="{{ $multipleDistrict->id }}">{{ $multipleDistrict->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Parent District</label>

                    <select name="parent_district" id="parent_district" class="form-control" required>
                        
                        <option value="">Select District</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Account Name</label>

                    <select name="account_name" class="form-control" required>

                        <option value="">Select Account</option>
                        @foreach($chapters as $chapter)
                            <option value="{{ $chapter->id }}">{{ $chapter->chapter_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

          

            <!-- secondRow (All Email Fields in the Same Row) -->
            <div class="row mt-3">
                <div class="col-md-3">
                    <label class="form-label">Preferred Email</label>
                    <select name="preferred_email" class="form-control" id="preferredEmail">
                        <option value="">Select Email</option>
                        <option value="official">Official</option>
                        <option value="personal">Personal</option>
                    </select>
                </div>
                <div class="col-md-3" id="emailInputDiv">
                    <label class="form-label">Personal Email</label>
                    <input type="email" name="email_address" class="form-control" id="emailInput">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Work Email</label>
                    <input type="email" name="work_email" class="form-control" id="workEmail">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Alternate Email</label>
                    <input type="email" name="alternate_email" class="form-control" id="alternateEmail">
                </div>
            </div>

            <!-- thirdRow (Preferred Phone, Mobile, Home, Work Number) -->
            <div class="row mt-3">
                <div class="col-md-3">
                    <label class="form-label">Preferred Phone</label>
                    <select name="preferred_phone" class="form-control" id="preferredPhone">
                        <option value="">Select Phone</option>
                        <option value="mobile">Mobile</option>
                        <option value="home">Home</option>
                        <option value="work">Work</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Mobile Number</label>
                    <input type="text" name="phone_number" class="form-control" id="mobileNumber">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Home Number</label>
                    <input type="text" name="home_number" class="form-control" id="homeNumber">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Work Number</label>
                    <input type="text" name="work_number" class="form-control" id="workNumber">
                </div>
            </div>

         <!-- last row (Member ID, Membership Full Type, Type, Fax) -->
<div class="row mt-3">
    <div class="col-md-3">
        <label class="form-label">Member ID</label>
        <input type="text" name="member_id" class="form-control" id="memberId" required>
        <small id="memberIdError" class="text-danger" style="display: none;">This ID already exists</small>
    </div>

    <div class="col-md-3">
        <label class="form-label">Membership Full Type</label>
        <select name="membership_full_type" class="form-control">
            <option value="">Select Type</option>
            @foreach($membershipTypes as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
    <label class="form-label" style="display: block; text-align: center;">Type</label>

        <select name="membership_type" class="form-control">
            <option value="">Select Club Type</option>
            <option value="Leo Club">Leo Club</option>
            <option value="Lions Club">Lions Club</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Fax</label>
        <input type="text" name="fax" class="form-control">
    </div>
</div>

        </div>
    </div>
</div>




    </div>

    <!-- Submit Button -->
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn custom-btn">Save Member</button>
        </div>
    </div>
</form>



        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function(){
        $('#preferredPhone').change(function(){
            let selectedValue = $(this).val();
            if(selectedValue) {
                $('#phoneInputDiv').show();
            } else {
                $('#phoneInputDiv').hide();
                $('#phoneNumber').val('');
            }
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let preferredEmail = document.getElementById("preferredEmail");
        let emailInputDiv = document.getElementById("emailInputDiv");

        preferredEmail.addEventListener("change", function () {
            if (this.value === "official" || this.value === "personal") {
                emailInputDiv.style.display = "block";
            } else {
                emailInputDiv.style.display = "none";
            }
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('#parent_multiple_district').change(function () {
            var multipleDistrictId = $(this).val();

            if (multipleDistrictId) {
                $.ajax({
                    url: '{{ route("get.districts") }}', // Route to fetch districts
                    type: 'GET',
                    data: { parent_multiple_district_id: multipleDistrictId },
                    success: function (data) {
                        $('#parent_district').empty();
                        $('#parent_district').append('<option value="">Select District</option>');
                        $.each(data, function (key, district) {
                            $('#parent_district').append('<option value="' + district.id + '">' + district.name + '</option>');
                        });
                    }
                });
            } else {
                $('#parent_district').empty();
                $('#parent_district').append('<option value="">Select District</option>');
            }
        });
    });
</script>


<script>
    // Handle Preferred Email Logic
    document.getElementById('preferredEmail').addEventListener('change', function () {
        let workEmail = document.getElementById('workEmail');
        if (this.value === 'official') {
            workEmail.removeAttribute('disabled');
        } else {
            workEmail.setAttribute('disabled', 'disabled');
        }
    });

    // Handle Preferred Phone Logic
    document.getElementById('preferredPhone').addEventListener('change', function () {
        let phoneInputs = document.querySelectorAll('.phone-input');
        phoneInputs.forEach(input => input.setAttribute('disabled', 'disabled'));
        document.getElementById(this.value + 'Phone').removeAttribute('disabled');
    });
</script>


<script>
    document.getElementById("memberId").addEventListener("keyup", function() {
        let memberId = this.value;
        let errorMsg = document.getElementById("memberIdError");

        if (memberId.length > 0) {
            fetch("{{ route('members.checkMemberId') }}?member_id=" + memberId)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        errorMsg.style.display = "inline";
                    } else {
                        errorMsg.style.display = "none";
                    }
                });
        } else {
            errorMsg.style.display = "none";
        }
    });
</script>


<script>
    document.getElementById("preferredEmail").addEventListener("change", function() {
        let preferredType = this.value;
        let personalEmail = document.getElementById("emailInput");
        let workEmail = document.getElementById("workEmail");

        // Reset all fields to be enabled first
        personalEmail.disabled = false;
        workEmail.disabled = false;

        if (preferredType === "official") {
            personalEmail.disabled = true; // Disable personal email
        } else if (preferredType === "personal") {
            workEmail.disabled = true; // Disable work email
        }
    });
</script>
<script>
    document.getElementById("preferredPhone").addEventListener("change", function() {
        let preferredType = this.value;
        let mobileNumber = document.getElementById("mobileNumber");
        let homeNumber = document.getElementById("homeNumber");
        let workNumber = document.getElementById("workNumber");

        // Enable all fields initially
        mobileNumber.disabled = false;
        homeNumber.disabled = false;
        workNumber.disabled = false;

        // Handle selection logic
        if (preferredType === "mobile") {
            homeNumber.disabled = true; // Disable home, enable mobile + work
        } else if (preferredType === "home") {
            mobileNumber.disabled = true; // Disable mobile, enable home + work
        } else if (preferredType === "work") {
            homeNumber.disabled = true; // Disable home, enable work + mobile
        }
    });
</script>
@endsection