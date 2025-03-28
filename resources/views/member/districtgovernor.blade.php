@extends('layouts.navbar')

@section('content')
<style>
    /* Default Tab Style */
    .nav-tabs .nav-link {
        color: #000;
        background: #f8f9fa;
        border-radius: 5px;
        transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
    }

    /* Active Tab Style */
    .nav-tabs .nav-link.active {
        background: #003366;
        color: #fff !important;
        font-weight: bold;
        border: none;
    }

    /* Hover Effect */
    .nav-tabs .nav-link:hover {
        background: #003366;
        color: #fff;
    }

    /* Prevent tab content flickering */
    .tab-content > .tab-pane {
        display: none;
    }

    .tab-content > .active {
        display: block;
    }


</style>

<style>
.card-hover {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    cursor: pointer;
    position: relative;
    z-index: 1;
}

.popup-card {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(1.8);
    z-index: 1000;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
    background: transparent;
    padding: 20px;
    transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
}

.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
 
    z-index: 999;
    display: none;
}
</style>

<div class="container mt-4" style="max-width: 1400px !important;">
    <!-- Tabs Navigation -->
    <div class="row mt-2">
        @include('member.tab')
    </div>

    <div>
        <h3>District Governors</h3>

        <!-- District Tabs -->
        <div id="districtTabsWrapper" class="d-flex align-items-center justify-content-center position-relative">
    <!-- Left Scroll Button (Outside) -->
    <button class="btn btn-light position-absolute start-0 shadow-sm" 
            onclick="scrollDistrictTabs('left')" 
            style="z-index: 10; border-radius: 50%; width: 40px; height: 40px; margin-left: 80px;">
        &lt;
    </button>

    <div id="districtTabs" class="position-relative" style="max-width: 80%; overflow: hidden;">
        <div class="d-flex overflow-auto" id="districtTabContainer" 
             style="white-space: nowrap; scrollbar-width: none; -ms-overflow-style: none;">
            <ul class="nav nav-tabs flex-nowrap d-inline-flex" id="districtTabList" role="tablist">
                @foreach($districts as $key => $district)
                    <li class="nav-item">
                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" 
                           id="district-{{ $district->id }}-tab" 
                           data-bs-toggle="tab" 
                           href="#district-{{ $district->id }}" 
                           role="tab">
                            {{ $district->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Right Scroll Button (Outside) -->
    <button class="btn btn-light position-absolute end-0 shadow-sm" 
            onclick="scrollDistrictTabs('right')" 
            style="z-index: 10; border-radius: 50%; width: 40px; height: 40px; margin-right: 80px;">
        &gt;
    </button>
</div>
<script>
    function scrollDistrictTabs(direction) {
    let container = document.getElementById("districtTabContainer");
    let scrollAmount = 100; // Adjust scroll speed

    if (direction === "left") {
        container.scrollLeft -= scrollAmount;
    } else {
        container.scrollLeft += scrollAmount;
    }
}

</script>

        <!-- Members Section -->
        <div class="tab-content mt-3 mb-3">
            @foreach($districts as $key => $district)
                <div class="tab-pane {{ $key == 0 ? 'show active' : '' }}" id="district-{{ $district->id }}" role="tabpanel">
                    <div class="row">
                        @if(isset($groupedGovernors[$district->id]) && $groupedGovernors[$district->id]->isNotEmpty())
                            @foreach($groupedGovernors[$district->id] as $governor)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> <!-- 4 Cards Per Row -->
                                    <div class="d-flex align-items-center bg-primary text-white p-3 rounded shadow-sm card-hover" 
                                         style="border-radius: 10px; background: linear-gradient(90deg, hsla(207, 90%, 77%, 1) 0%, hsla(351, 67%, 67%, 1) 100%);">
                                        
                                        <!-- Profile Image -->
                                        <div class="position-relative" style="width: 100px; height: 100px;">
                                        <img src="{{ $governor->profile_photo ? asset('storage/app/public/' . $governor->profile_photo) : asset('assets/images/default.png') }}"
     alt="{{ $governor->first_name }} {{ $governor->last_name }}"
     class="w-100 h-100 object-cover rounded-start position-relative"
     style="border-radius: 10px;">

                                        </div>

                                        <!-- Info Section -->
                                        <div class="ms-3 p-2 w-auto" style="max-width: 220px; font-size: 12px; word-wrap: break-word;">
                                            <h6 class="mb-1 font-weight-bold text-white">{{ $governor->first_name }} {{ $governor->last_name }}</h6>
                                            <p class="mb-1 text-white"><strong>Position:</strong> {{ $governor->position }}</p>
                                            <p class="mb-1 text-white"><strong>Member No:</strong> {{ $governor->member_id }}</p>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center text-muted">No members found for this district.</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const cards = document.querySelectorAll(".card-hover");

    cards.forEach(card => {
        card.addEventListener("mouseenter", function() {
            const overlay = document.createElement("div");
            overlay.classList.add("popup-overlay");
            document.body.appendChild(overlay);

            card.classList.add("popup-card");
            overlay.style.display = "block";

            overlay.addEventListener("click", function() {
                card.classList.remove("popup-card");
                overlay.style.display = "none";
                document.body.removeChild(overlay);
            });
        });

        card.addEventListener("mouseleave", function() {
            setTimeout(() => {
                if (!card.matches(":hover")) {
                    document.querySelector(".popup-overlay")?.remove();
                    card.classList.remove("popup-card");
                }
            }, 200);
        });
    });
});
</script>

@endsection
