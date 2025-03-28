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

    <div class="row">
        <!-- Tabs Navigation -->
        @include('member.tab')
    </div>
    <h3>Region Governors</h3>
    <!-- Region Tabs -->
    <ul class="nav nav-tabs" id="regionTabList">
   
        @foreach($regions as $regionName => $members)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#{{ Str::slug($regionName) }}">{{ $regionName }}</a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content mt-3 mb-3">
   
        @foreach($regions as $regionName => $members)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ Str::slug($regionName) }}">
                <div class="row">
                    @forelse($members as $member)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="d-flex align-items-center bg-primary text-white p-2 rounded card-hover" style="border-radius: 10px;background: linear-gradient(90deg, hsla(208, 92%, 36%, 1) 0%, hsla(302, 59%, 65%, 1) 100%);">
                                <!-- Image with Overlay -->
                                <div class="position-relative" style="width: 100px; height: 100px;">
                                    <div >
                                    </div>
                                    <img src="{{ $member->profile_photo ? asset('storage/app/public/' . $member->profile_photo) : asset('assets/images/default.png') }}"
     alt="{{ $member->first_name }}"
     class="w-100 h-100 object-cover rounded-start position-relative"
     style="border-radius: 10px;">

                                </div>

                                <!-- Info Section -->
                                <div class="ms-3 p-2 w-auto" style="max-width: 220px; font-size: 10px; word-wrap: break-word;">
                                    <h6 class="mb-1 font-weight-bold text-white">{{ $member->first_name }} {{ $member->last_name }}</h6>
                                    <p class="mb-1 text-white">{{ $member->position }}</p>
                                    <p class="mb-1 text-white"><strong>M. No:</strong> {{ $member->member_id }}</p>
                                
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No members found for this region.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
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
