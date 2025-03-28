<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
        body {
            background-color: #7171b6; /* Light gray background */
        }
        .login-card {
    width: 400px;
    padding: 30px;
    border-radius: 10px;
    border: 6px solid #ffcc00; /* Yellow border */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    background: #003366; /* Dark blue background */
    color: #ffffff; /* White text for better contrast */
}

        .login-title {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: bold;
        }
        .login-logo {
            width: 40px; /* Adjust the logo size */
            height: 40px;
        }

        .password-container {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 0px;
        top: 73%;
        transform: translateY(-50%);
        background: #ffcc00; /* Yellow background */
        border: none;
        padding: 6px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .toggle-password i {
        color: #003366; /* Dark blue eye icon */
    }

    .toggle-password:hover {
        background: #ffcc00; /* White background on hover */
    }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card login-card">
        <h3 class="text-center mb-4 login-title">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="login-logo">
            Admin Login
        </h3>
        
        @if (session('success'))
    <div class="alert alert-success" id="successMessage">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<script>
    setTimeout(function() {
        let successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.transition = "opacity 0.5s ease";
            successMessage.style.opacity = "0";
            setTimeout(() => successMessage.remove(), 500); // Remove from DOM after fade-out
        }
    }, 4000);
</script>


        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3 password-container">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" id="password" class="form-control" required>
    <button class="toggle-password" type="button" id="togglePassword">
        <i class="bi bi-eye"></i> <!-- Bootstrap Eye Icon -->
    </button>
</div>
            <button type="submit" class="btn btn-dark w-50" style="margin-left:80px;">Login</button>
        </form>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<script>
    document.getElementById("togglePassword").addEventListener("click", function () {
        let passwordField = document.getElementById("password");
        let icon = this.querySelector("i");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash"); // Change to eye-slash icon
        } else {
            passwordField.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye"); // Change back to eye icon
        }
    });
</script>

</body>
</html>
