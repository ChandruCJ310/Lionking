@extends('layouts.navbar')

@section('content')
<style>
    .member-heading {
        font-size: 19px !important;
        font-weight: bold !important;
        text-align: center !important;
        width: 100% !important;
        color: #333 !important;
        padding: 15px 0 !important;
        border-radius: 5px !important;
        margin-bottom: 15px !important;
    }

    /* Tabs should be in a single row and centered */
    .nav-pills {
        display: flex !important;
        flex-wrap: nowrap !important;
        justify-content: center !important;
        overflow-x: auto !important;
        white-space: nowrap !important;
        padding: 10px !important;
        border-radius: 5px !important;
    }

    /* Default tab styling - transparent background */
    .nav-pills .nav-link {
        color: #000 !important;
        background-color: transparent !important;
        border: none !important;
        font-weight: 600;
        padding: 10px 15px;
    }

    /* Active tab styling */
    .nav-pills .nav-link.active {
        background-color: #003366 !important;
        color: #ffffff !important;
        font-weight: bold;
        border-bottom: 2px solid #003366 !important;
    }

    /* Tab Content Styling */
    .tab-content {
        background: linear-gradient(87.4deg, rgb(255, 241, 165) 1.9%, rgb(200, 125, 76) 49.7%, rgb(83, 54, 54) 100.5%);
        padding: 20px !important;
        border-radius: 5px !important;
        min-height: 200px !important;
        border: 1px solid #ddd !important;
    }

    /* Member Card Styling */
    .member-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        width: 200px;
    }

    .member-card:hover {
        transform: translateY(-5px);
    }

    .profile-img {
        width: 100%;
        height: 200px;
        object-fit: cover; /* Fixed missing value */
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        transition: transform 0.3s ease-in-out;
    }

    .profile-img:hover {
        transform: scale(1.1);
    }

    .card {
        width: 100%;
        max-width: 333px;
        margin: auto;
    }

    .card-img-top {
        height: 120px;
        object-fit: cover;
    }

    .card-body {
        padding: 10px;
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
    }

    .card-text {
        font-size: 14px;
    }

        .tab-content {
            animation: fadeIn 0.5s ease-in-out;
        }

        .tab-pane p {
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp 0.5s ease-out forwards;
            animation-delay: 0.2s;
        }



   

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

</style>
<style>  
#eventDetailsCard {
    width: 100%; /* Make the card take full width */
    max-width: 800px; /* Set a max width for a balanced look */
    min-height: 120px; /* Reduce height */
    transition: all 0.3s ease-in-out;
    opacity: 0;
    transform: translateY(-10px);
    padding: 10px; /* Reduce padding to make it more compact */
    border-radius: 8px; /* Slightly rounded corners for a modern look */
}

#eventDetailsCard.show {
    width:500px;
    opacity: 1;
    transform: translateY(0);
}

#eventImagesContainer img {
    width: 80px; /* Reduce image size */
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
    transition: transform 0.3s ease-in-out; /* Smooth zoom effect */
}

.eventImagesContainer img:hover {
    transform: scale(1.5); /* Zoom image to 1.5x size */
    border-color: #007bff; /* Change border color on hover */
}

</style>
<div class="container mt-4" style="max-width: 1400px !important;">
    <!-- Full-Width Heading -->
    <div class="row">
      
    </div>

    <!-- Tabs Navigation -->
    <div class="row mt-2">
        <div class="col-12">
            <ul class="nav nav-pills justify-content-center flex-row" id="customTabs">
                <li class="nav-item">
                    <a class="nav-link {{ $activeTab === 'tab2' ? 'active' : '' }}" id="tab2-tab" data-bs-toggle="pill" href="#tab2">Upcoming Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activeTab === 'tab1' ? 'active' : '' }}" id="tab1-tab" data-bs-toggle="pill" href="#tab1">Completed Events</a>
                </li>

            </ul>
        </div>
    </div>


<!-- Tab Content -->
<div class="tab-content mt-3">
<!-- Completed Events Tab -->
<div class="tab-pane fade {{ $activeTab === 'tab1' ? 'show active' : '' }}" id="tab1">
    <h3 class="fw-bold d-flex align-items-center">
        Completed Events
        @if($completedEvents->isNotEmpty()) 
            <span class="fw-bold text-primary ms-3">{{ now()->year }}</span>
        @endif
    </h3>

    <!-- Month Navigation -->
    <div class="mb-3">
        @php
            $currentMonth = now()->format('F'); // Current month
            $months = [
                'January', 'February', 'March', 'April', 'May', 'June', 
                'July', 'August', 'September', 'October', 'November', 'December'
            ];
        @endphp

        @foreach($months as $month)
            <a href="#" class="month-link btn btn-outline-primary btn-sm 
                {{ $month === $currentMonth ? 'active' : '' }}" 
                data-month="{{ $month }}">
                {{ $month }}
            </a>
        @endforeach
    </div>

  <!-- Events List -->
<div id="eventsContainer" class="d-flex flex-wrap gap-3">
    @forelse($completedEvents as $event)
        @php
            $eventMonth = \Carbon\Carbon::parse($event->event_date)->format('F');
        @endphp

        <div class="event-row" data-month="{{ $eventMonth }}" 
            style="{{ $eventMonth !== $currentMonth ? 'display: none;' : '' }}">
            
            <!-- Event Card -->
            <div class="event-wrapper d-flex flex-column align-items-start">
                <div class="event-card bg-white p-2 rounded shadow-sm mb-2" 
                    data-event-id="{{ $event->id }}" 
                    data-event-name="{{ $event->event_name }}" 
                    data-event-date="{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}" 
                    data-event-venue="{{ $event->venue }}" 
                    data-event-details="{{ $event->details }}" 
                    data-event-images="{{ json_encode($event->images) }}" 
                    style="min-width: 200px; width: 250px; cursor: pointer;">
                    <div class="text-center me-2">
                        <span class="fw-bold text-primary d-block" style="font-size: 14px;">
                            {{ \Carbon\Carbon::parse($event->event_date)->format('M d') }}
                        </span>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="mb-1" style="font-size: 14px;">{{ $event->event_name }}</p>
                        <small class="text-muted" style="font-size: 12px;">
                            {{ \Carbon\Carbon::parse($event->event_date)->format('l') }}
                        </small>
                    </div>
                </div>

                <!-- Event Details Card (Initially Hidden) -->
                <div class="event-details-card card shadow-sm p-3 mt-1 d-none" style="width:300px; margin-left:0px;">
                    <h6 class="fw-bold text-center mb-2">Event Details</h6>
                    <p class="mb-1"><strong>Name:</strong> <span class="detailEventName"></span></p>
                    <p class="mb-1"><strong>Date:</strong> <span class="detailEventDate"></span></p>
                    <p class="mb-1"><strong>Venue:</strong> <span class="detailEventVenue"></span></p>
                    <p class="mb-1"><strong>Details:</strong> <span class="detailEventDetails"></span></p>

                    <!-- Event Images -->
                    <div class="eventImagesContainer d-flex flex-wrap gap-2 mt-2"></div>
                </div>
            </div>

        </div>
    @empty
        <p class="text-muted">No completed events available.</p>
    @endforelse
</div>

</div>



<!-- Upcoming Events Tab -->
<div class="tab-pane fade {{ $activeTab === 'tab2' ? 'show active' : '' }}" id="tab2">
    <h3 class="fw-bold d-flex align-items-center">
        Upcoming Events
        @if($upcomingEvents->isNotEmpty()) 
            <span class="fw-bold text-primary ms-3">{{ now()->year }}</span>
        @endif
    </h3>

    <!-- Month Navigation -->
    <div class="mb-3">
        @php
            $currentMonth = now()->format('F');
            $months = ['January', 'February', 'March', 'April', 'May', 'June', 
                       'July', 'August', 'September', 'October', 'November', 'December'];
        @endphp

        @foreach($months as $month)
            <a href="#" class="month-link btn btn-outline-primary btn-sm 
                {{ $month === $currentMonth ? 'active' : '' }}" 
                data-month="{{ $month }}">
                {{ $month }}
            </a>
        @endforeach
    </div>

    <!-- Events List -->
    <div id="upcomingEventsContainer" class="d-flex flex-wrap gap-3">
        @forelse($upcomingEvents as $event)
            @php
                $eventDate = \Carbon\Carbon::parse($event->event_date);
                $eventMonth = $eventDate->format('F');
            @endphp

            <div class="event-row" data-month="{{ $eventMonth }}" 
                style="{{ $eventMonth !== $currentMonth ? 'display: none;' : '' }}">

                <!-- Event Card -->
                <div class="event-wrapper d-flex flex-column align-items-start">
                    <div class="event-card bg-white p-3 rounded shadow-sm mb-2" 
                        style="min-width: 200px; width: 250px; cursor: pointer;">
                        <div class="text-center">
                            <span class="fw-bold text-primary d-block" style="font-size: 14px;">
                                {{ $eventDate->format('M d') }}
                            </span>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <p class="mb-1 fw-bold" style="font-size: 14px;">{{ $event->event_name }}</p>
                            <small class="text-muted" style="font-size: 12px;">
                                {{ $eventDate->format('l') }}
                            </small>
                        </div>
                    </div>
                </div>

            </div>
        @empty
            <p class="text-muted">No upcoming events available.</p>
        @endforelse
    </div>
</div>


</div>













</div>



<script> 
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".event-card").forEach(card => {
        card.addEventListener("click", function () {
            console.log("Event card clicked!");

            let parentWrapper = this.closest(".event-wrapper");
            let detailsCard = parentWrapper.querySelector(".event-details-card");

            // If details card is already visible, hide it
            if (!detailsCard.classList.contains("d-none")) {
                detailsCard.classList.add("d-none");
                return;
            }

            // Hide any other open details cards before showing this one
            document.querySelectorAll(".event-details-card").forEach(card => card.classList.add("d-none"));

            // Populate details card
            detailsCard.querySelector(".detailEventName").innerText = this.getAttribute("data-event-name");
            detailsCard.querySelector(".detailEventDate").innerText = this.getAttribute("data-event-date");
            detailsCard.querySelector(".detailEventVenue").innerText = this.getAttribute("data-event-venue") || "N/A";
            detailsCard.querySelector(".detailEventDetails").innerText = this.getAttribute("data-event-details") || "N/A";
// Populate images
// Populate images
let imageContainer = detailsCard.querySelector(".eventImagesContainer");
imageContainer.innerHTML = ""; // Clear previous images
let eventImages = JSON.parse(this.getAttribute("data-event-images") || "[]");
let eventId = this.getAttribute("data-event-id"); // Get Event ID

if (eventImages.length > 0) {
    eventImages.forEach(imgSrc => {
        let imgElement = document.createElement("img");
        imgElement.src = `/storage/${imgSrc}`;
        imgElement.style.width = "80px";
        imgElement.style.height = "80px";
        imgElement.style.objectFit = "cover";
        imgElement.style.border = "2px solid #ddd"; // Add border
        imgElement.style.borderRadius = "8px"; // Slightly rounded corners
        imgElement.style.padding = "4px"; // Add some padding
        imgElement.classList.add("rounded");
        
        // Make image clickable (redirect to Gallery Page)
        imgElement.style.cursor = "pointer";
        imgElement.addEventListener("click", function () {
            window.location.href = `/member-gallery/${eventId}`;
        });

        imageContainer.appendChild(imgElement);
    });
}

// Show the details card right below the clicked card
detailsCard.classList.remove("d-none");

        });
    });
});

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Select all month links
        const monthLinks = document.querySelectorAll(".month-link");
        const eventRows = document.querySelectorAll(".event-row");

        monthLinks.forEach(link => {
            link.addEventListener("click", function (event) {
                event.preventDefault(); // Prevent page refresh
                
                // Get selected month
                let selectedMonth = this.getAttribute("data-month");

                // Remove 'active' class from all month links
                monthLinks.forEach(l => l.classList.remove("active"));
                // Add 'active' class to clicked link
                this.classList.add("active");

                // Show/Hide events based on the selected month
                eventRows.forEach(row => {
                    if (row.getAttribute("data-month") === selectedMonth) {
                        row.style.display = "block"; // Show matching events
                    } else {
                        row.style.display = "none"; // Hide others
                    }
                });
            });
        });
    });
</script>


@endsection
