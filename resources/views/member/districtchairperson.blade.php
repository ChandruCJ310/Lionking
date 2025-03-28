@extends('layouts.navbar')

@section('content')

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
    <!-- Heading -->
 
    <!-- Tabs Navigation -->
    <div class="row mt-2">
        <div class="col-12">
            @include('member.tab')
        </div>
    </div> 

    <div class="row">
        <h3>District Chairpersons</h3>
        <div class="row mb-4">
            @foreach($districtChairpersons as $chairperson)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> <!-- 4 Cards Per Row -->
                <div class="d-flex align-items-center bg-primary text-white p-2 rounded card-hover" style="border-radius: 10px;background: linear-gradient(90deg, hsla(208, 92%, 36%, 1) 0%, hsla(302, 59%, 65%, 1) 100%);">
                    <!-- Image with Overlay -->
                    <div class="position-relative" style="width: 100px; height: 100px;">
                        <div >
                        </div>
                        <img src="{{ $chairperson->profile_photo ? asset('storage/app/public/' . $chairperson->profile_photo) : asset('assets/images/default.png') }}"
     alt="{{ $chairperson->first_name }} {{ $chairperson->last_name }}"
     class="w-100 h-100 object-cover rounded-start position-relative"
     style="border-radius: 10px;">

                    </div>

                    <!-- Info Section -->
                    <div class="ms-3 p-2 w-auto" style="max-width: 220px; font-size: 10px; word-wrap: break-word;">
                        <h6 class="mb-1 font-weight-bold text-white">{{ $chairperson->first_name }} {{ $chairperson->last_name }}</h6>
                        <p class="mb-1 text-white"><strong>Position:</strong> {{ $chairperson->position }}</p>
                        <p class="mb-1 text-white"><strong>Member No:</strong> {{ $chairperson->member_id }}</p>
                     
                    </div>
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
