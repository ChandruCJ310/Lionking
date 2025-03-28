@extends('MasterAdmin.layout')

@section('content')


<style>
    /* Common styles for both tab sections */
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

.custom-btn {
    background: rgb(30,144,255);
    background: linear-gradient(159deg, rgba(30,144,255,1) 0%, rgba(153,186,221,1) 100%);
    border: none;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 50%;
    transition: 0.3s;
}

.custom-btn:hover {
    background: linear-gradient(159deg, rgba(153,186,221,1) 0%, rgba(30,144,255,1) 100%);
    color: white;
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
<div class="container mt-4">
    <h5 class="text-center">Upload Banners</h5>
    @include('admin.partial.alerts')

    <!-- Tab Buttons -->
    <ul class="nav nav-tabs" id="bannerTabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#uploadBanners">Upload Banners</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab2">Upload Advertisement</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab3">Upload Image</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab4">Upload Bottom Banners</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab5">Member Details</a>
        </li>
    </ul>

    <!-- Tab Content -->

<div class="tab-content mt-3">
    <!-- Upload Banners Tab -->
    <div class="tab-pane fade show active" id="uploadBanners">
    <div class="row">
    @foreach ([10000, 5000, 1000] as $banner)
        <div class="col-12 col-md-4 mb-4"> <!-- Full width on mobile, 3 columns on larger screens -->
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Upload {{ number_format($banner) }} Banner</h5>
                    <form action="{{ route('upload.banner') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="banner_type" value="{{ $banner }}">

                        <div class="mb-3">
                            <input type="file" name="image" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Banner URL (Optional)</label>
                            <input type="url" name="url" class="form-control" placeholder="Enter link (optional)">
                        </div>

                        <button type="submit" class="btn custom-btn w-40 upload">Upload</button> <!-- Full width button -->
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

        @include('admin.banners.bannertables')
    </div>

    @include('admin.partial.Edit')

    <!-- Tab 2 Content -->
    <div class="tab-pane fade" id="tab2">
        <div class="row">
            @include('admin.leftbanner')
        </div>
    </div>

    <!-- Tab 3 Content -->
    <div class="tab-pane fade" id="tab3" role="tabpanel">
        <div class="row">
            @include('admin.rightbanner')
        </div>
    </div>

    <!-- Tab 4 Content -->
    <div class="tab-pane fade" id="tab4">
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="margin-top:-25px;">
                    <div class="card-body">
                        <h5 class="card-title">Upload Bottom Banner</h5>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('upload.bottom.banner') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <small class="text-muted">Banner size should be 1353x180px</small>
                            <input type="file" name="image" required class="form-control">
                            <small class="text-muted">Banner URL optional</small>
                            <input type="text" name="website_link" placeholder="Enter link (optional)" class="form-control mt-2">
                            <button type="submit" class="btn custom-btn mt-2 upload">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display Uploaded Banners in Table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h5>Uploaded Bottom Banners</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered dt-responsive nowrap" id="complaintTable">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Image</th>
                                <th>Website Link</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banners as $banner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="banner-img-container">
                                            <img class="banner-img" src="{{ asset('storage/app/public/' . $banner->image) }}" width="150">
                                        </div>
                                    </td>
                                    <td>{{ $banner->website_link }}</td>
                                    <td>{{ $banner->created_at->format('d-m-Y h:i:s') }}</td>
                                    <td>
                                        <form action="{{ route('delete.bottom.banner', $banner->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 5 Content (Moved Inside tab-content) -->
    <div class="tab-pane fade" id="tab5">
        <div class="row">
            @include('admin.member')
        </div>
    </div>
</div>
 <!-- Closing .tab-content properly -->
</div>


<!-- Include Bootstrap JS for Tabs Functionality -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let tabGroups = ["#uploadTabs", "#pricingTabs"];

        tabGroups.forEach(groupId => {
            let tabLinks = document.querySelectorAll(`${groupId} .nav-link`);
            tabLinks.forEach(link => {
                link.addEventListener("click", function () {
                    tabLinks.forEach(tab => tab.classList.remove("active"));
                    this.classList.add("active");
                });
            });
        });
    });
</script>
@endsection
