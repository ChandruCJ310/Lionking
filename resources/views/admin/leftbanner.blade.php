<style>
    .upload{
        border-radius: 24px;
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
<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="col-12 col-md-6 mb-4"> <!-- Full width on mobile, 2 columns on larger screens -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Upload Advertisement Image 1</h5>
            <form action="{{ route('upload.ad') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ad_type" value="ad1">
                
                <div class="mb-3">
                    <input type="file" name="image" required class="form-control">
                </div>

                <div class="mb-3">
                    <input type="url" name="website_link" placeholder="Enter Website URL" required class="form-control">
                </div>

                <button type="submit" class="btn custom-btn w-40 upload">Upload</button> <!-- Full width button -->
            </form>
        </div>
    </div>
</div>

<div class="col-12 col-md-6 mb-4"> <!-- Same for the second card -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Upload Advertisement Image 2</h5>
            <form action="{{ route('upload.ad') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ad_type" value="ad2">

                <div class="mb-3">
                    <input type="file" name="image" required class="form-control">
                </div>

                <div class="mb-3">
                    <input type="url" name="website_link" placeholder="Enter Website URL" required class="form-control">
                </div>

                <button type="submit" class="btn custom-btn w-40 upload">Upload</button>
            </form>
        </div>
    </div>
</div>



<ul class="nav nav-tabs mt-4" id="adTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="ad1-tab" data-bs-toggle="tab" data-bs-target="#ad1" type="button" role="tab">Advertisement Image 1</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="ad2-tab" data-bs-toggle="tab" data-bs-target="#ad2" type="button" role="tab">Advertisement Image 2</button>
    </li>
</ul>

<div class="tab-content mt-3" id="adTabsContent">
    <div class="tab-pane fade show active" id="ad1" role="tabpanel">
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Image</th>
                    <th>Website Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($adimage) && count($adimage) > 0)
                @foreach($adimage as $index => $image)
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Loop counter -->
                    <td>
                        <div class="banner-img-container">
                        <img class="banner-img" src="{{ asset('storage/app/public/' . $image->image_path) }}" alt="Ad Image" width="100">
                        </div>
                    </td>
                    <td>
                        @if(!empty($image->website_link))
                            <a href="{{ $image->website_link }}" target="_blank">{{ $image->website_link }}</a>
                        @else
                            No Link
                        @endif
                    </td>


                    <td>
                        <form action="{{ route('delete.ad.image', ['id' => $image->id, 'ad_type' => 'ad1']) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4" class="text-center">No images found.</td>
                </tr>
                @endif
            </tbody>
        </table>


    </div>

    <div class="tab-pane fade" id="ad2" role="tabpanel">
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Image</th>
                    <th>Website Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($adimage2) && count($adimage2) > 0)
                @foreach($adimage2 as $index => $image)
                <tr id="row-{{ $image->id }}"> <!-- ✅ Unique ID for JavaScript -->
                    <td>{{ $index + 1 }}</td>

                    <td>
                        <div class="banner-img-container">
                        <img class="banner-img" src="{{ asset('storage/app/public/' . $image->image_path) }}" alt="Ad Image" width="100">
                        </div>
                    </td>
                    <td>
                        @if(!empty($image->website_link))
                            <a href="{{ $image->website_link }}" target="_blank">{{ $image->website_link }}</a>
                        @else
                            No Link
                        @endif
                    </td>
                    <td>
                        <!-- For Ad Image 1 -->
                        <form action="{{ route('delete.ad.image', ['id' => $image->id, 'ad_type' => 'ad2']) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3" class="text-center">No images found.</td>
                </tr>
                @endif
            </tbody>

        </table>
    </div>
</div>



