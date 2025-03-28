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
    <!-- Full-Width Heading -->


    <!-- Tabs Navigation -->
    <div class="row">
        @include('member.tab')
    </div>

    <div>
        <h3>Club Members</h3>

        <!-- Dynamic Chapter Tabs -->
        <div id="chapterTabsWrapper" class="d-flex align-items-center justify-content-center position-relative">
    <!-- Left Scroll Button (Outside) -->
    <button class="btn btn-light position-absolute start-0 shadow-sm" 
            onclick="scrollTabs('left')" 
            style="z-index: 10; border-radius: 50%; width: 40px; height: 40px; margin-left: 80px;">
        &lt;
    </button>

    <div id="chapterTabs" class="position-relative" style="max-width: 80%; overflow: hidden;">
        <div class="d-flex overflow-auto" id="chapterTabContainer" 
             style="white-space: nowrap; scrollbar-width: none; -ms-overflow-style: none;">
            <ul class="nav nav-tabs flex-nowrap d-inline-flex" id="chapterTabList">
                @foreach($chapters as $index => $chapter)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" 
                           id="chapter-{{ Str::slug($chapter->chapter_name) }}-tab" 
                           data-bs-toggle="tab" 
                           href="#chapter-{{ Str::slug($chapter->chapter_name) }}">
                            {{ $chapter->chapter_name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Right Scroll Button (Outside) -->
    <button class="btn btn-light position-absolute end-0 shadow-sm" 
            onclick="scrollTabs('right')" 
            style="z-index: 10; border-radius: 50%; width: 40px; height: 40px; margin-right: 80px;">
        &gt;
    </button>
</div>


<!-- JavaScript for scrolling -->
<script>
    function scrollTabs(direction) {
        let container = document.getElementById("chapterTabContainer");
        let scrollAmount = 200; // Adjust scroll amount as needed

        if (direction === 'left') {
            container.scrollLeft -= scrollAmount;
        } else {
            container.scrollLeft += scrollAmount;
        }
    }
</script>


        <!-- Members Cards for Each Chapter -->
        <div class="tab-content mt-3 mb-3">
            @foreach($chapters as $index => $chapter)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="chapter-{{ Str::slug($chapter->chapter_name) }}">
                    
                    <!-- Top Section: President, Secretary, Treasurer -->
                    <h5 class="mt-4">Leadership</h5>
                    <div class="row">
                        @foreach($members->where('account_name', $chapter->id)->whereIn('position', ['President', 'Secretary', 'Treasurer']) as $leader)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="d-flex align-items-center bg-primary text-white p-3 rounded shadow-sm card-hover" style="border-radius: 10px;background: linear-gradient(90deg, hsla(207, 90%, 77%, 1) 0%, hsla(351, 67%, 67%, 1) 100%);">
                                    
                                    <!-- Profile Image with Overlay -->
                                    <div class="position-relative" style="width: 100px; height: 100px;">
                                        <div >
                                        </div>
                                        <img src="{{ $leader->profile_photo ? asset('storage/app/public/' . $leader->profile_photo) : asset('assets/images/default.png') }}"
     alt="{{ $leader->first_name }} {{ $leader->last_name }}"
     class="w-100 h-100 object-cover rounded-start position-relative"
     style="border-radius: 10px;">

                                    </div>

                                    <!-- Info Section -->
                                    <div class="ms-3 p-2 w-auto" style="max-width: 220px; font-size: 12px; word-wrap: break-word;">
                                        <h6 class="mb-1 font-weight-bold text-white">{{ $leader->first_name }} {{ $leader->last_name }}</h6>
                                
                                       
    <p class="mb-1 text-white">
        <strong>Position:</strong> 
        <span class="badge bg-warning text-dark px-2 py-1" 
              style="border-radius: 5px; font-weight: bold;">
            {{ $leader->position }}
        </span>
    </p>
                                        <p class="mb-1 text-white"><strong>Member No:</strong> {{ $leader->member_id }}</p>
                                  
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Member Section -->
                    <h5 class="mt-4">Members</h5>
                    <div class="row">
                        @foreach($members->where('account_name', $chapter->id)->whereNotIn('position', ['President', 'Secretary', 'Treasurer']) as $member)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="d-flex align-items-center bg-primary text-white p-3 rounded shadow-sm card-hover" style="border-radius: 10px;background: linear-gradient(90deg, hsla(208, 92%, 36%, 1) 0%, hsla(302, 59%, 65%, 1) 100%);">
                                    
                                    <!-- Profile Image with Overlay -->
                                    <div class="position-relative" style="width: 100px; height: 100px;">
                                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                                                    background: rgba(0, 123, 255, 0.6);
                                                    clip-path: polygon(0 0, 80% 0, 100% 50%, 80% 100%, 0 100%);
                                                    border-radius: 10px;">
                                        </div>
                                        <img src="{{ $member->profile_photo ? asset('storage/app/public/' . $member->profile_photo) : asset('assets/images/default.png') }}"
     alt="{{ $member->first_name }} {{ $member->last_name }}"
     class="w-100 h-100 object-cover rounded-start position-relative"
     style="border-radius: 10px;">

                                    </div>

                                    <!-- Info Section -->
                                    <div class="ms-3 p-2 w-auto" style="max-width: 220px; font-size: 12px; word-wrap: break-word;">
                                        <h6 class="mb-1 font-weight-bold text-white">{{ $member->first_name }} {{ $member->last_name }}</h6>
                                        <p class="mb-1 text-white"><strong>Member No:</strong> {{ $member->member_id }}</p>
                                   
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
