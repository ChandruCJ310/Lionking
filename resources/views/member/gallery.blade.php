@extends('layouts.navbar')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold text-center">Gallery</h3>

    <!-- Month Navigation -->
    <div class="mb-3 text-center">
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

    <div class="gallery-container">
        @forelse($completedEvents as $event)
            @php
                $eventMonth = \Carbon\Carbon::parse($event->event_date)->format('F');
            @endphp

            @if(!empty($event->images) && is_array($event->images))
                @foreach($event->images as $image)
                    <img src="{{ asset('storage/app/public/' . $image) }}" class="img-thumbnail event-row m-1" 
                         data-month="{{ $eventMonth }}"
                         style="width: 150px; height: 150px; object-fit: cover;
                                {{ $eventMonth !== $currentMonth ? 'display: none;' : '' }}">
                @endforeach
            @endif
        @empty
            <p class="text-muted text-center">No completed event images available.</p>
        @endforelse
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.month-link').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                let selectedMonth = this.getAttribute('data-month');

                document.querySelectorAll('.event-row').forEach(img => {
                    img.style.display = img.getAttribute('data-month') === selectedMonth ? 'inline-block' : 'none';
                });

                document.querySelectorAll('.month-link').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
@endsection
