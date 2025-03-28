@extends('MasterAdmin.layout')

@section('content')
<style>
    .nav-tabs .nav-item {
        margin-right: 1px;
    }
    .nav-tabs .nav-link {
        background: linear-gradient(90deg, rgb(22, 35, 72) 0%, rgb(139, 102, 241) 100%);
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
    }
    .nav-tabs .nav-link.active {
        color: #FFD700;
        font-weight: bold;
        border-bottom: 3px solid yellow;
    }
    .custom-btn {
        background: linear-gradient(159deg, rgba(30,144,255,1) 0%, rgba(153,186,221,1) 100%);
        border: none;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border-radius:24px;
        align-items: center;
        transition: 0.3s;
        margin-left: 145px;
    }
    .custom-btn:hover {
        background: linear-gradient(159deg, rgba(153,186,221,1) 0%, rgba(30,144,255,1) 100%);
    }

    .image-preview {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    .image-preview img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
    }


    @media (max-width: 768px) {
        .container {
            padding: 10px;
        }
        .custom-btn {
            font-size: 14px;
            padding: 8px 16px;
            width: 100%;
            border-radius: 10px;
            margin-left:0px;
        }
        .card {
            width: 100% !important;
            padding: 20px;
        }
    }
</style>

<div class="container mt-4">
    <h5 class="text-center">Events</h5>
    @include('admin.partial.alerts')

    <ul class="nav nav-tabs d-flex flex-wrap justify-content-center" id="bannerTabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#tab1">Add Events</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab2">Completed Event</a>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="tab1">
            <div class="d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6">
                            <div class="card shadow-lg p-4">
                                <form action="{{ route('events_store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="eventName" class="form-label">Event Name</label>
                                        <input type="text" class="form-control" name="event_name" id="eventName" placeholder="Enter event name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="eventDate" class="form-label">Event Date</label>
                                        <input type="date" class="form-control" name="event_date" id="eventDate">
                                    </div>
                                    <button type="submit" class="btn custom-btn text-center">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab2">
            <div class="container mt-1">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="card shadow-lg p-4">
                            <h4 class="mb-4 text-center">Event Details Form</h4>
                            <form action="{{ route('store_completed_event') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="eventSelect" class="form-label">Select Event</label>
                                    <select class="form-control" name="event_id" id="eventSelect">
                                        @foreach(\App\Models\Event::all() as $event)
                                            <option value="{{ $event->id }}">{{ $event->event_name }} - {{ $event->event_date }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="venue" class="form-label">Event Venue</label>
                                    <input type="text" class="form-control" name="venue" id="venue" placeholder="Enter Event Venue" required>
                                </div>
                                <div class="mb-3">
                                    <label for="details" class="form-label">Event Details</label>
                                    <textarea class="form-control" name="details" id="details" rows="4" placeholder="Enter Event Details" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Add Photos (Max 3)</label>
                                    <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">Submit Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("imageUpload").addEventListener("change", function(event) {
            const previewContainer = document.getElementById("imagePreview");
            const files = event.target.files;
            previewContainer.innerHTML = "";

            if (files.length > 3) {
                document.getElementById("imageLimitMsg").classList.remove("d-none");
                event.target.value = "";
                return;
            } else {
                document.getElementById("imageLimitMsg").classList.add("d-none");
            }

            Array.from(files).forEach(file => {
                const imgElement = document.createElement("img");
                imgElement.src = URL.createObjectURL(file);
                previewContainer.appendChild(imgElement);
            });
        });

        const dateInput = document.getElementById("eventDate");
        const today = new Date().toISOString().split("T")[0];
        dateInput.setAttribute("min", today);
    });
</script>
@endsection
