<style>
    .member{
        border-radius: 24px !important;
    }
</style>

<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">Member Details</h2>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif

                <!-- Member Form -->
                <form action="{{ route('admin.addMember') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Role:</label>
                        <input type="text" name="role" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Image:</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn custom-btn w-50 member">Add Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
