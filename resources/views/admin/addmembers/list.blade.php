@extends('MasterAdmin.layout')

@section('content')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
#memberDetailsBody th {
    text-transform: capitalize;
    font-size: 14px; /* Adjust header font size */
}

#memberDetailsBody td {
    font-size: 13px; /* Adjust data font size */
}

#memberDetailsContainer {
    font-size: 14px; /* Adjust overall font size */
}
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

</style>
<style>
    div.dataTables_length {
        margin-top: 5px; /* Moves 'Show Entries' down */
    }

    div.dataTables_filter {
        margin-top: 5px; /* Moves 'Search' box down */
    }


    @media (max-width: 768px) {
    .custom-btn {
        font-size: 14px;
        padding: 8px 15px;
        min-width: 120px;
        height: auto;
    }

    #import_file {
        width: 100%;
    }

    .d-flex {
        flex-direction: column;
    }

    .d-flex .me-2 {
        margin-right: 0;
        margin-bottom: 5px;
    }
}
</style>


<div class="container">
    <h2 class="mb-4"></h2>

    <div class="card shadow-lg">
    <div class="card-header text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Members List</h5>
        <form action="{{ route('members.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
    @csrf
    <div class="d-flex align-items-center">
        <label for="import_file" class="form-label mb-0 me-2">Upload CSV/Excel</label>
        <input type="file" name="import_file" id="import_file" class="form-control form-control-sm me-2" required>
        <button type="submit" class="btn custom-btn">Import</button>
    </div>
</form>

    </div>


        
    @include('admin.partial.alerts') 
    <div class="row">
    <!-- Members Table (Initially full width) -->
    <div id="tableContainer" class="col-md-12">
    <div class="table-responsive">
    <table id="membersTable" class="table table-bordered">
    <thead class="table-white" style="text-transform: capitalize;">
        <tr>
            <th>S.No</th>
            <th>Member ID</th>
            <th>Name</th>
          
            <th>Parent District</th>
            <th>Account Name</th> <!-- New Column -->
            <th>Membership Full Type</th> <!-- New Column -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $key => $member)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>
                <a href="javascript:void(0);" class="text-primary view-member" data-id="{{ $member->id }}">
                    {{ $member->member_id }}
                </a>
            </td>
            <td>{{ $member->first_name }} {{ $member->last_name }}</td>
            
            <td>
                {{ $member->parentDistrict ? $member->parentDistrict->name : 'N/A' }}
            </td>
            <td>{{ $member->account ? $member->account->chapter_name : 'N/A' }}</td> <!-- Account Name -->
            <td>{{ $member->membershipType ? $member->membershipType->name : 'N/A' }}</td> <!-- Membership Full Type -->
            <td>
                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm border-0 text-warning" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm border-0 text-danger" title="Delete" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



    </div>

    <!-- Member Details (Initially hidden) -->
    <div id="memberDetailsContainer" class="col-md-4" style="display: none;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Member Details</h5>
                <div id="profilePhotoContainer"></div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody id="memberDetailsBody"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

   
    </div>
</div>


<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#membersTable').DataTable({
        "paging": true,        // Enable pagination
        "searching": true,     // Enable search
        "ordering": false,     // Disable sorting
        "info": true,          // Show info text
        "lengthMenu": [250, 500, 750, 1000,1250], // Control entries per page 
    });

    // Reduce font size of table data
    $('#membersTable tbody td').css("font-size", "13px");  // Adjust size as needed

    // Capitalize table headers
    $('#membersTable thead th').css("text-transform", "capitalize");

    // Increase width of "Show Entries" dropdown box
    setTimeout(function () {
        $('select[name="membersTable_length"]').css("width", "100px");
    }, 500);
});
</script>



<!-- Initialize Bootstrap Tooltips -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
<script>
$(document).ready(function () {
    let currentMemberId = null;

    $('.view-member').click(function () {
        var memberId = $(this).data('id');

        // If the same member is clicked again, hide the container & reset layout
        if (currentMemberId === memberId) {
            $('#memberDetailsContainer').fadeOut();
            $('#tableContainer').removeClass('col-md-8').addClass('col-md-12'); // Expand table
            currentMemberId = null;
            return;
        }

        currentMemberId = memberId;

        $.ajax({
            url: '/members/' + memberId,
            type: 'GET',
            success: function (response) {
                var member = response.member;
                console.log(member); // Debugging: Check if email & phone exist in response

                var profilePhotoPath = member.profile_photo
                    ? `/storage/app/public/${member.profile_photo}`
                    : `/storage/app/public/members/default.png`;

                var profilePhotoHtml = `<img src="${profilePhotoPath}" alt="Profile Photo" width="80" height="80" class="rounded-circle border">`;
                $('#profilePhotoContainer').html(profilePhotoHtml);

                // Fetch email and phone details correctly
                var email = member.email || member.personal_email || member.official_email || 
                            (member.contact_info ? member.contact_info.email : 'N/A');
                var phone = member.mobile || member.phone || member.contact_number || 
                            (member.contact_info ? member.contact_info.phone : 'N/A');

                var detailsHtml = `
                    <tr><th>Parent Multiple District</th><td>${member.parent_multiple_district ? member.parent_multiple_district.name : 'N/A'}</td></tr>
                    <tr><th>Parent District</th><td>${member.parent_district ? member.parent_district.name : 'N/A'}</td></tr>
                    <tr><th>Account Name</th><td>${member.account ? member.account.chapter_name : 'N/A'}</td></tr>
                    <tr><th>Member ID</th><td>${member.member_id || 'N/A'}</td></tr>
                    <tr><th>Salutation</th><td>${member.salutation || 'N/A'}</td></tr>
                    <tr><th>First Name</th><td>${member.first_name || 'N/A'}</td></tr>
                    <tr><th>Last Name</th><td>${member.last_name || 'N/A'}</td></tr>
                    <tr><th>Suffix</th><td>${member.suffix || 'N/A'}</td></tr>
                    <tr><th>Spouse Name</th><td>${member.spouse_name || 'N/A'}</td></tr>
                    <tr><th>Date of Birth</th><td>${member.dob || 'N/A'}</td></tr>
                    <tr><th>Anniversary Date</th><td>${member.anniversary_date || 'N/A'}</td></tr>
                    <tr><th>Mailing Address 1</th><td>${member.mailing_address_line_1 || 'N/A'}</td></tr>
                    <tr><th>Mailing Address 2</th><td>${member.mailing_address_line_2 || 'N/A'}</td></tr>
                    <tr><th>Mailing Address 3</th><td>${member.mailing_address_line_3 || 'N/A'}</td></tr>
                    <tr><th>City</th><td>${member.mailing_city || 'N/A'}</td></tr>
                    <tr><th>State</th><td>${member.mailing_state || 'N/A'}</td></tr>
                    <tr><th>Country</th><td>${member.mailing_country || 'N/A'}</td></tr>
                    <tr><th>Zip Code</th><td>${member.mailing_zip || 'N/A'}</td></tr>
                    <tr><th>Email</th><td>${email}</td></tr>
                    <tr><th>Phone Number</th><td>${phone}</td></tr>
                    <tr><th>Membership Type</th><td>${member.membership_type ? member.membership_type.name : 'N/A'}</td></tr>
                `;

                $('#memberDetailsBody').html(detailsHtml);

                // Shrink table and show details container
                $('#tableContainer').removeClass('col-md-12').addClass('col-md-8');
                $('#memberDetailsContainer').fadeIn();
            },
            error: function () {
                alert('Error loading member details');
            }
        });
    });
});
</script>


@endsection
