

<style>
    .table {
        background-color: white;
    }
    .table-responsive{
        background-color: white;

    }
    .banner-img-container {
    position: relative;
    display: inline-block;
}

.banner-img {
    width: 100px; /* Initial size */
    height: auto;
    transition: transform 0.3s ease-in-out;
}

.banner-img-container:hover .banner-img {
    transform: scale(1.5); /* Zoom out */

}


</style>

<ul class="nav nav-tabs" id="pricingTabs">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#banner10000">Banner 10,000</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#banner5000">Banner 5,000</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#banner1000">Banner 1,000</a>
    </li>
</ul>


<div class="tab-content mt-3">
    <div class="tab-pane fade show active" id="banner10000">
        {{-- banner10000 --}}
        <div class="table-responsive mt-2">
            <table id="complaintTable" class="table">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Banner Image</th>
                        <th>Website Link</th>
                        <th>Date & Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                        @foreach($banner10000 as $index => $banner)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="banner-img-container">
                                        <img class="banner-img" src="{{ url('/') }}/storage/app/public/{{ $banner->image_path }}" alt="Banner">
                                    </div>
                                </td>

                                <td>
                                    <a href="{{ $banner->url }}" target="_blank">{{ $banner->url }}</a>
                                </td>
                                <td>
                                    {{ $banner->created_at ? \Carbon\Carbon::parse($banner->created_at)->format('d-m-Y h:i:s ') : 'N/A' }}
                                </td>

                                <td>

                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $banner->id }}" data-title="10000">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="banner5000">
        {{-- banner5000 --}}
        <div class="table-responsive mt-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Banner Image</th>
                        <th>Website Link</th>
                        <th>Date and Time</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                        @foreach($banner5000 as $index => $banner)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="banner-img-container">
                               <img class="banner-img" src="{{ url('/') }}/storage/app/public/{{ $banner->image_path }}" alt="Banner" width="100">
                                    </div>
                            </td>
                                <td>
                                    <a href="{{ $banner->url }}" target="_blank">{{ $banner->url }}</a>
                                </td>
                                <td>{{ $banner->created_at->format('d-m-Y h:i:s') }}</td>
                                <td>

                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $banner->id }}" data-title="5000">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="banner1000">
        {{-- banner1000 --}}
        <div class="table-responsive mt-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Banner Image</th>
                        <th>Website Link</th>
                        <th>Date and Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                        @foreach($banner1000 as $index => $banner)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="banner-img-container">
                                    <img class="banner-img" src="{{ url('/') }}/storage/app/public/{{ $banner->image_path }}" alt="Banner" width="100">
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ $banner->url }}" target="_blank">{{ $banner->url }}</a>
                                </td>
                                <td>{{ $banner->created_at->format('d-m-Y h:i:s') }}</td>
                                <td>

                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $banner->id }}" data-title="1000">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>







<script>
    new DataTable('#complaintTable');
    $(document).ready(function () {
    $('#complaintTable').DataTable({
        responsive: {
            details: {
                type: 'column',
                target: -1 // Last column for the "+" icon
            }
        },
        columnDefs: [
            {
                className: 'control',
                orderable: false,
                targets: -1 // Targets the last column for mobile "+" icon
            }
        ],
        paging: true,
        pageLength: 10,
        language: {
            lengthMenu: "Show MENU entries"
        }
    });
});
</script>
