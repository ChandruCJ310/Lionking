    @extends('MasterAdmin.layout')
    @section('content')

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <style>
        .birthday-table {
            width: 70%; /* Adjust as per your requirement */
            margin: auto; /* Center the table */
            overflow: hidden; /* Ensures corners are properly rounded */
            border-collapse: separate;
            border-spacing: 0;
            background-color: #f8f9fa;

        }

        .birthday-table th, .birthday-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .birthday-table thead th {
            background-color: #f8f9fa;

        }
        .birthday-table th:first-child,
        .birthday-table td:first-child {
            width: 120px; /* Adjust as needed */
        }

        .birthday-table th:last-child,
        .birthday-table td:last-child {
            width: 60px; /* Adjust as needed */
        }


    .nav-tabs .nav-item {
        margin-right: 1px; /* Adds space between tabs */
    }

    .nav-tabs .nav-link {
        background: linear-gradient(159deg, rgba(30,144,255,1) 0%, rgba(153,186,221,1) 100%);
        color: white;
        border: none;
        padding: 10px 15px; /* Increases padding for better spacing */
        border-radius: 5px; /* Rounds corners slightly */
    }

    .nav-tabs .nav-link.active {
        background: linear-gradient(159deg, rgba(30,144,255,1) 0%, rgba(153,186,221,1) 100%);
        color: #fff;
        font-weight: bold;
        border-bottom: 3px solid yellow;
    }


    /* Table Styles */
    table#complaintTable thead th {
        background-image: none !important;
        cursor: default !important;
    }

    table#complaintTable thead .sorting:after,
    table#complaintTable thead .sorting:before {
        display: none !important;
    }
    table#Table thead .sorting:after,
    table#Table thead .sorting:before {
        display: none !important;
    }
    /* Styles for DataTable container */
.table-responsive {
    background-color: #f8f9fa; /* Light background */
    color:black;
    padding: 20px; /* Adds space inside the container */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
    overflow: hidden; /* Ensures rounded corners work */
    width:90%;
    border-radius: 10px;

}

/* Styles for the DataTable */
#complaintTable {
    overflow: hidden; /* Ensures proper edge handling */
}

/* Ensuring the table header has a proper background */
#complaintTable thead th,#Table thead th
    {
    background-color: #ffffff; /* Dark background for better contrast */
    color: rgb(0, 0, 0); /* White text */
}

/* Table row hover effect */
#complaintTable tbody tr:hover {
    background-color: #e9ecef; /* Light grey hover effect */
}

/* Ensure pagination controls have rounded edges */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    background: #ffffff;
    border-radius: 5px;
    margin: 2px;
    padding: 5px 10px;
    border: none;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #ffffff;
}

/* Make the search input field rounded */
.dataTables_wrapper .dataTables_filter input {
    border-radius: 5px;
    border: 1px solid #ced4da;
    padding: 5px;
}


div.dataTables_wrapper div.dataTables_length select {
    width: 50px;
    font-size: 12px;
    padding: 2px 10px;
    appearance: none; /* Removes default arrow */
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="gray"><path d="M5 7l5 5 5-5H5z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 5px center;
    background-size: 20px;
}

 /* Ensure Mobile Responsiveness */
 @media screen and (max-width: 768px) {
        .table-responsive {
            overflow-x: scroll; /* Horizontal scroll on small screens */
            width: 100%;
        }

        .birthday-table th, .birthday-table td {
            font-size: 14px; /* Smaller font for better fit */
            padding: 8px;
        }

        /* Make tabs scrollable */
        .nav-tabs {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            white-space: nowrap;
        }
        .nav-tabs .nav-item {
            flex: 1;
            text-align: center;
        }
    }

    .table th{
        text-transform: capitalize;
    }
    </style>
        <div class="container mt-4">
        <h3 class="mb-3" style="color: #222; text-align: center; margin-left: 100px;">Birthdays and Anniversaries</h3>



         <!-- Nav Tabs -->
<ul class="nav nav-tabs" id="myTabs">
    <li class="nav-item">
        <a class="nav-link active" id="birthdays-tab" data-bs-toggle="tab" href="#birthdays">Birthdays</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="anniversaries-tab" data-bs-toggle="tab" href="#anniversaries">Anniversaries</a>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content mt-3">
    <!-- Birthdays Tab -->
    <div class="tab-pane fade show active" id="birthdays">
        <div class="table-responsive">
            <h4 style="text-align:center;">Birthdays</h4>
            <table id="birthdaysTable" class="table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Member Name</th>
                        <th>Birthday Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($birthdays as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($member->dob)->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td>—</td>
                            <td>No birthdays</td>
                            <td>—</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Anniversaries Tab -->
    <div class="tab-pane fade" id="anniversaries">
        <div class="table-responsive">
            <h4 style="text-align:center;">Anniversaries</h4>
            <table id="anniversariesTable" class="table table-striped table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Member Name</th>
                        <th>Anniversary Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anniversaries as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($member->anniversary_date)->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                            <td>No anniversaries</td>
                            <td></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#birthdaysTable').DataTable({
            "pageLength": 5,
            "ordering": false, // Enable sorting
            "searching": true, // Enable search
            "lengthChange": false, // Hide "Show X entries"
            "info": false // Hide "Showing X of X entries"
        });

        $('#anniversariesTable').DataTable({
            "pageLength": 5,
            "ordering": false,
            "searching": true,
            "lengthChange": false,
            "info": false
        });
    });
</script>


    @endsection

