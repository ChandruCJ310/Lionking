<!-- resources/views/layouts/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('assets/images/logo.png')}}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lions Club Member Directory</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<style>

    .top-ad-banner {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    position: relative;
}

.top-ad-banner-image {
    width: 100%;
    max-width: 600px;
    height: auto;
    border-radius: 10px;
}

.prev-btn, .next-btn {
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    font-size: 18px;
    border-radius: 5px;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}

.prev-btn {
    left: 5px;
}

.next-btn {
    right: 5px;
}

.prev-btn:hover, .next-btn:hover {
    background-color: rgba(0, 0, 0, 0.7);
}

/* Sticky Header */
.header {
    position: sticky;
    top: 0;
    background-color: #00509e;
    z-index: 1000; /* Ensures it's above other content */
    padding: 10px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    height:67px;
}

/* Sticky Top Ad Banner */
.top-ad-container {
    position: sticky;
    top: 60px; /* Adjust based on header height */
    background-color: #ffcc00;
    z-index: 999;
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Sticky Navigation Menu */
.nav-container {
    position: sticky;
    top: 260px; /* Adjust to place below the ad */
    background-color: #003366;
    z-index: 998;
    padding: 0px;
}

.nav-menu {
    display: flex;
    list-style: none;
    justify-content: center;
    padding: 0;
    margin: 0;
}

.nav-menu li {
    margin: 0 15px;
}

.nav-menu li a {
    text-decoration: none;
    color: white;
    font-weight: bold;
    padding: 10px 15px;
    display: inline-block;
}

.nav-menu li a:hover {
    background-color: #00509e;
    border-radius: 5px;
}

@media (max-width: 768px) {
    .nav-menu-wrapper {
        width: 100%;
        overflow-x: auto; /* Enables horizontal scrolling if needed */
        white-space: nowrap;
        height: 40px;
        /* Prevents wrapping to the next line */
    }

    .nav-menu {
        display: flex;
        justify-content: center;
        gap: 15px; /* Adds spacing between menu items */
        padding: 10px;
        width: fit-content;
        overflow-x: auto; /* Ensures the menu remains horizontal */
    }

    .nav-menu li {
        display: inline-block;
    }

    .nav-menu a {
        transform: translateY(-20px);
        display: inline-block;
        padding: 8px 12px;
        font-size: 14px;
        text-decoration: none;
        white-space: nowrap; /* Prevents text from breaking */
    }
}


.nav-menu li a.active {
    color:black;
    background-color:#ffcc00; /* Blue background */
    border-radius: 5px;
}

</style>
<body>
<!-- Header Section -->
    <div class="header">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" loading="lazy"/>
        <h1>Lions Club Chennai Aavarampoo</h1>
    </div>


<!-- Top Ad Banner -->

<div class="top-ad-container">
    @include('includes.banner')
</div>


<!-- Navigation Menu -->
<div class="nav-container">
    <div class="nav-menu-wrapper">
        <ul class="nav-menu">
            <li><a href="{{ route('index') }}" class="{{ request()->routeIs('index') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('international_officers') }}" class="{{ request()->routeIs('member.directory') ? 'active' : '' }}">Member Directory</a></li>
            <li><a href="{{ route('award.index') }}" class="{{ request()->routeIs('award.index') ? 'active' : '' }}">Awards</a></li>
            <li><a href="" class="{{ request()->is('resources') ? 'active' : '' }}">Resources</a></li>
            <li><a href="{{ route('webevents') }}" class="{{ request()->routeIs('webevents') ? 'active' : '' }}">Events</a></li>
            <li><a href="{{ route('member.gallery') }}" class="{{ request()->routeIs('member.gallery') ? 'active' : '' }}">Gallery</a></li>

            <li><a href="" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
        </ul>
    </div>
</div>


    <!-- Main Content Area -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} Lions Club. All rights reserved.</p>
    </footer>
</body>
</html>
