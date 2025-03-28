

<style>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var activeTab = "{{ session('activeTab') }}";
        if (activeTab) {
            var tabElement = new bootstrap.Tab(document.querySelector('[href="#' + activeTab + '"]'));
            tabElement.show();
        }
    });
</script>


<div class="row">


  <!-- Image Upload 1 -->
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Upload Image 1</h5>
            <form action="{{ route('upload.image1') }}"
             method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image" required class="form-control">
                <input type="url" name="website_link" required class="form-control mt-2" placeholder="Enter Website Link">
                <button type="submit" class="btn custom-btn mt-2 upload">Upload</button>
            </form>
        </div>
    </div>
</div>

<!-- Image Upload 2 -->
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Upload Image 2</h5>
            <form action="{{ route('upload.image2') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image" required class="form-control">
                <input type="url" name="website_link" required class="form-control mt-2" placeholder="Enter Website Link">
                <button type="submit" class="btn custom-btn mt-2 upload">Upload</button>
            </form>
        </div>
    </div>
</div>

<!-- Image Upload 3 -->
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Upload Image 3</h5>
            <form action="{{ route('upload.image3') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image" required class="form-control">
                <input type="url" name="website_link" required class="form-control mt-2" placeholder="Enter Website Link">
                <button type="submit" class="btn custom-btn mt-2 upload">Upload</button>
            </form>
        </div>
    </div>
</div>

</div>


<ul class="nav nav-tabs mt-4" id="imageTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="image1-tab" data-bs-toggle="tab" data-bs-target="#image1" type="button" role="tab">Image 1</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="image2-tab" data-bs-toggle="tab" data-bs-target="#image2" type="button" role="tab">Image 2</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="image3-tab" data-bs-toggle="tab" data-bs-target="#image3" type="button" role="tab">Image 3</button>
    </li>
</ul>

<div class="tab-content mt-3" id="imageTabsContent">
    <!-- Image 1 Tab -->
    <div class="tab-pane fade show active" id="image1" role="tabpanel">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Image 1 List</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Image</th>
                            <th>Website Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($image1 as $index => $img)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="banner-img-container">
                                <img class="banner-img" src="{{ asset('storage/app/public/' . $img->image_path) }}" alt="Image" width="100"></td>
                                </div>
                                <td>
                                @if(!empty($img->website_link))  <!-- Use $img instead of $image -->
                                    <a href="{{ $img->website_link }}" target="_blank">{{ $img->website_link }}</a>
                                @else
                                    No Link
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('delete.image1', $img->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
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

    <!-- Image 2 Tab -->
    <div class="tab-pane fade" id="image2" role="tabpanel">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Image 2 List</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Image</th>
                            <th>Website Link</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($image2 as $index => $img)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="banner-img-container">
                                <img class="banner-img" src="{{ asset('storage/app/public/' . $img->image_path) }}" alt="Image" width="100"></td>
                                </div>
                            <td>
                                @if(!empty($img->website_link))  <!-- Use $img instead of $image -->
                                    <a href="{{ $img->website_link }}" target="_blank">{{ $img->website_link }}</a>
                                @else
                                    No Link
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('delete.image2', $img->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
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

    <!-- Image 3 Tab -->
    <div class="tab-pane fade" id="image3" role="tabpanel">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Image 3 List</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Image</th>
                            <th>Website Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($image3 as $index => $img)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="banner-img-container">
                                <img class="banner-img" src="{{ asset('storage/app/public/' . $img->image_path) }}" alt="Image" width="100"></td>
                                </div>
                                <td>
                                @if(!empty($img->website_link))  <!-- Use $img instead of $image -->
                                    <a href="{{ $img->website_link }}" target="_blank">{{ $img->website_link }}</a>
                                @else
                                    No Link
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('delete.image3', $img->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
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


