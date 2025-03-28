@extends ('layouts.navbar')


@section('content')
{{-- style css section --}}
    <style>
        /* General Styles */
.ad-banner-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

/* Main Content Layout */
.container {
    display: flex;
    max-width: 1200px;
    gap: 20px;
}

.left, .right {
    position: relative;
    max-width: 300px;
}

.left {
    top: 30px;
}

.right {
    top: 20px;
}

/* Center Content */
.center {
    flex: 2;
    max-width: 900px;
    width: 100%;
    background-color: #ffffff;
    padding: 15px;
    border-radius: 10px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
}

/* Scrollable Container */
.scroll-container {
    max-height: 150px;
    overflow: hidden;
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
    background-image: linear-gradient(93deg, #115797 57%, #FFE32C 100%);
    color: white;
    position: relative;
    display: flex;
    flex-direction: column;
}

/* Scrolling Animation */
@keyframes verticalScroll {
    from { transform: translateY(0); }
    to { transform: translateY(-100%); }
}

.scroll-content {
    animation: verticalScroll 8s linear infinite;
    animation-delay: 2s;
}

/* Additional Containers */
.additional-containers {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
}

.additional-container {
    height: 300px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #ffffff;
}

/* Right Column Ads */
.banner-image {
    width: 48%;
    height: 100px;
    object-fit: cover;
    border-radius: 5px;
}

/* Ad Carousel */
.ad-carousel {
    position: relative;
    width: 300px;
    height: 300px;
    overflow: hidden;
    border: 1px solid #ddd;
}

.ad-images {
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: transform 0.5s ease-in-out;
}

.ad-images img {
    width: 107%;
    height: 300px;
    display: none;
}

.ad-images img.active {
    display: block;
}

.next-btn, .prev-btn {
    position: absolute;
    width: 22px;
    padding: 0;
}

.next-btn { right: -5px; }
.prev-btn { left: -5px; }

.content1,.content2,.content3,.content4 p {
    font-size: small;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
            .center {
                max-width: 100%;
                padding: 10px;
                margin: 0 auto;
            }
        }


        @media (max-width: 768px) {


            .nav-menu {
                font-size: 0.5rem;

                flex-wrap: nowrap;

            }

            .nav-menu li {
                margin: 5px;

            }

            .container {
                flex-direction: column;
                padding: 10px;
            }


            .right {
                display: flex;
                flex-wrap: nowrap;
                /* Prevent wrapping */
                justify-content: space-between;
                gap: 10px;
                /* Add spacing between the ads */
                margin: 15px 0;
                overflow-x: auto;
                /* Enable horizontal scrolling if needed */
                scrollbar-width: thin;

                width: 116%;
            }

            .right-ad {
                flex: 0 0 auto;
                /* Prevent shrinking and set fixed size */
                width: 120px;
                /* Adjust width for small screens */
                height: 150px;
                /* Adjust height */
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 5px;
                background-color: #ffffff;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .right-ad img {
                width: 116%;
                height: 100%;
                object-fit: cover;
                border-radius: 5px;
            }

            .left,
            .center {
                max-width: 100%;
            }

            .banner-image {
                width: 48%;
                height: auto;
                border-radius: 5px;
            }
        }


        @media (max-width: 768px) {
            .right {
                display: flex;
                flex-direction: column;
                align-items: center;
                transform: translateY(-265px);
            }



            .additional-container {
                width: 50% !important;
                height: auto;
                margin-left: 0 !important;
            }


            .ad-images img {
                width: 100% !important;
                /* Ensure images fit properly */
                height: auto;
            }

            .additional-containers {
                width: 345px;
                height: 300px;
                margin-left: 15px;
                transform: translateY(430px);
            }

            .container {
                margin-left: 0px !important;
            }

            .content1 {
                transform: translateY(-300px);
            }

            .content2 {
                transform: translateY(45px);
            }

            .content3 {
                transform: translateY(622px);
            }

            .content4 {
                transform: translateY(40px);
            }

            .center p {
                width: auto !important;
                text-align: justify !important;
            }

            .bottom-ad-container {
                height: 100px !important;
            }

        }

    </style>
{{-- Code Section --}}
    <div class="container" >
        <!-- Left Column: Birthday, Events Calendar, and Ad Containers -->
        <div class="left">
            <div class="scroll-container">
                <div class="scroll-content">
                    <h3>Birthdays</h3>
                    <div id="birthdays"></div> <!-- Placeholder for birthdays -->


                    <h3>Anniversaries</h3>
                    <div id="anniversaries"></div>
                </div>
            </div>


            {{-- Event Calendar  start --}}
            @include('website.partial.event')
            {{-- Event Calendar end --}}



            <div class="additional-containers">
                <div class="additional-container ad-carousel">
                    <button class="prev-btn">&#10094;</button> <!-- Previous Button -->
                    <div class="ad-images">
                        @foreach ($images1 as $image)
                            <a href="{{ $image->website_link }}" target="_blank">
                                <img src="{{ asset('storage/app/public/' . $image->image_path) }}" alt="Ad Image"
                                    loading="lazy" />
                            </a>
                        @endforeach
                    </div>
                    <button class="next-btn">&#10095;</button> <!-- Next Button -->
                </div>
                <div class="additional-container ad-carousel">
                    <button class="prev-btn">&#10094;</button> <!-- Previous Button -->
                    <div class="ad-images">
                        @foreach ($images2 as $image)
                            <a href="{{ $image->website_link }}" target="_blank">
                                <img src="{{ asset('storage/app/public/' . $image->image_path) }}" alt="Ad Image"
                                    loading="lazy" />
                            </a>
                        @endforeach
                    </div>
                    <button class="next-btn">&#10095;</button> <!-- Next Button -->
                </div>
            </div>

        </div>

        <!-- Center Column -->
        <div class="center">
            <div class="content1">
                <h2>Welcome to Lions Club</h2>
                <h5> Lions Club: A Beacon of Service and Community Empowerment</h5>
                <p>The Lions Club is one of the largest and most respected international service organizations in the world.
                    Founded in 1917 by Melvin Jones in Chicago, Illinois, the Lions Club was established with a mission to
                    empower volunteers to serve their communities, meet humanitarian needs, encourage peace, and promote
                    international understanding. Today, the organization has a presence in over 200 countries, with more
                    than 1.4 million members committed to creating meaningful change in their communities and beyond.</p>
            </div>

            <div class="content2">
                <h3>Vision and Mission</h3>
                <p>The Lions Club’s vision is encapsulated in its motto, "We Serve." This guiding principle drives the
                    organization’s activities, which focus on helping those in need, whether through direct action,
                    advocacy, or resource mobilization. The Lions Club aims to tackle some of the world’s most pressing
                    challenges, such as hunger, poverty, environmental sustainability, and health crises. Through
                    collaborative efforts, the Lions Club fosters a sense of solidarity and shared responsibility, uniting
                    people from diverse backgrounds to work toward common goals.</p>
            </div>

            <div class="content4">
                <h3>Key Areas of Focus</h3>
                <p>The Lions Club’s initiatives are wide-ranging, reflecting its commitment to comprehensive community
                    betterment. Some of its major areas of focus include:

                    Vision and Eye Health: The Lions Club has long been associated with initiatives to combat blindness and
                    support eye health. The SightFirst program, for example, funds cataract surgeries, provides glasses, and
                    raises awareness about eye care globally.

                    Youth Empowerment: Through programs like the Leo Club, the Lions Club nurtures young leaders by
                    involving them in community service and leadership development. These efforts inspire the next
                    generation to carry forward the spirit of service.

                    Disaster Relief: The Lions Club is often at the forefront of providing emergency relief in the wake of
                    natural disasters, offering food, shelter, and medical aid to affected communities.

                    Environmental Sustainability: Recognizing the importance of protecting the planet, the Lions Club
                    engages in tree-planting campaigns, recycling initiatives, and other efforts aimed at preserving natural
                    resources.

                    Health and Hunger: From combating diabetes and cancer to addressing food insecurity, the Lions Club is
                    dedicated to improving public health and ensuring that no one goes hungry.</p>
            </div>


            <div class="content3">
                <h3>Organizational Structure</h3>
                <p>The Lions Club operates through local clubs, which are the backbone of the organization. Each club is
                    autonomous, allowing members to address the unique needs of their communities while adhering to the
                    broader mission of the Lions Club International. These local efforts are supported by regional,
                    national, and international structures, creating a network that facilitates the sharing of resources,
                    expertise, and ideas.</p>
            </div>



        </div>

        <!-- Right Column: Ad Containers -->
        <div class="right mx-1  ">
            <div class="additional-container ad-carousel">
                <button class="prev-btn">&#10094;</button> <!-- Previous Button -->
                <div class="ad-images">
                    @foreach ($image1s as $image)
                        <a href="{{ $image->website_link }}" target="_blank">
                            <img src="{{ asset('storage/app/public/' . $image->image_path) }}" alt="Ad Image"
                                loading="lazy" />
                        </a>
                    @endforeach
                </div>
                <button class="next-btn">&#10095;</button> <!-- Next Button -->
            </div>
            <br>

            <div class="additional-container ad-carousel">
                <button class="prev-btn">&#10094;</button> <!-- Previous Button -->
                <div class="ad-images">
                    @foreach ($image2s as $image)
                        <a href="{{ $image->website_link }}" target="_blank">
                            <img src="{{ asset('storage/app/public/' . $image->image_path) }}" alt="Ad Image"
                                loading="lazy" />
                        </a>
                    @endforeach
                </div>
                <button class="next-btn">&#10095;</button> <!-- Next Button -->
            </div>
            <br>

            <div class="additional-container ad-carousel">
                <button class="prev-btn">&#10094;</button> <!-- Previous Button -->
                <div class="ad-images">
                    @foreach ($image3s as $image)
                        <a href="{{ $image->website_link }}" target="_blank">
                            <img src="{{ asset('storage/app/public/' . $image->image_path) }}" alt="Ad Image"
                                loading="lazy" />
                        </a>
                    @endforeach
                </div>
                <button class="next-btn">&#10095;</button> <!-- Next Button -->
            </div>

        </div>

    </div>
{{-- Code Section End--}}
    <!-- Bottom Ad Banner -->

    <div class="bottom-ad-container" style=" position: relative; overflow: hidden;">
        <div class="bottom-ad-banner">
            <button class="prev-btn" onclick="prevBottomAd()">&#10094;</button> <!-- Left Arrow -->

            @if (isset($bottomBanners) && $bottomBanners->isNotEmpty())
                @foreach ($bottomBanners as $banner)
                    <a href="{{ $banner->website_link }}" target="_blank">
                        <img src="{{ asset('storage/app/public/' . $banner->image) }}" alt="Bottom Ad"
                            class="ad-banner-image bottom-ad" loading="lazy"
                            style="opacity: 0; position: absolute; width: 100%; height: 100%; object-fit: fill;">
                    </a>
                @endforeach
            @else
                <!-- Default image if no banners are available -->
                <img src="{{ asset('assets/images/7.png') }}" alt="Bottom Ad" class="ad-banner-image" loading="lazy"
                    style="width: 100%; height:auto; object-fit: contain;">
            @endif

            <button class="next-btn" onclick="nextBottomAd()">&#10095;</button> <!-- Right Arrow -->
        </div>
    </div>

{{-- Script Section  Start--}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let bottomAds = document.querySelectorAll(".bottom-ad");
            let currentIndex = 0;

            function showAd(index) {
                bottomAds.forEach((img, i) => {
                    img.style.opacity = i === index ? "1" : "0";
                    img.style.transition = "opacity 0.5s ease-in-out";
                    img.style.position = i === index ? "relative" : "absolute";
                });
            }

            function prevBottomAd() {
                currentIndex = (currentIndex - 1 + bottomAds.length) % bottomAds.length;
                showAd(currentIndex);
            }

            function nextBottomAd() {
                currentIndex = (currentIndex + 1) % bottomAds.length;
                showAd(currentIndex);
            }

            // Auto-slide every 5 seconds
            let autoSlide = setInterval(() => {
                nextBottomAd();
            }, 5000);

            // Stop auto-slide on button click and restart after 5 seconds
            document.querySelector(".prev-btn").addEventListener("click", () => {
                prevBottomAd();
                restartAutoSlide();
            });

            document.querySelector(".next-btn").addEventListener("click", () => {
                nextBottomAd();
                restartAutoSlide();
            });

            function restartAutoSlide() {
                clearInterval(autoSlide);
                autoSlide = setInterval(() => {
                    nextBottomAd();
                }, 5000);
            }

            // Show first image initially
            if (bottomAds.length > 0) {
                showAd(currentIndex);
            }
        });
    </script>




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetchCelebrations();
        });

        function fetchCelebrations() {
            fetch('/get-celebrations') // Ensure this URL matches your Laravel route
                .then(response => response.json())
                .then(data => {
                    let birthdaysHTML = "";
                    let anniversariesHTML = "";
                    let today = new Date().toLocaleDateString("en-US", {
                        month: "long",
                        day: "numeric"
                    });

                    if (data.birthdays.length > 0) {
                        data.birthdays.forEach(birthday => {
                            birthdaysHTML +=
                                `<p>🎂 Happy Birthday, ${birthday.first_name} ${birthday.last_name}! 🎉 (${today})</p>`;
                        });
                    } else {
                        birthdaysHTML = `<p>No birthdays today.</p>`;
                    }

                    if (data.anniversaries.length > 0) {
                        data.anniversaries.forEach(anniversary => {
                            anniversariesHTML +=
                                `<p>💍 Happy Anniversary, ${anniversary.first_name} ${anniversary.last_name}! ❤️ (${today})</p>`;
                        });
                    } else {
                        anniversariesHTML = `<p>No anniversaries today.</p>`;
                    }

                    document.getElementById("birthdays").innerHTML = birthdaysHTML;
                    document.getElementById("anniversaries").innerHTML = anniversariesHTML;
                })
                .catch(error => console.error("Error fetching celebrations:", error));
        }
    </script>




    <script>
        const topAdImages = [
            "{{ asset('images/1.png') }}",
            "{{ asset('images/2.png') }}",
            "{{ asset('images/3.png') }}"
        ];

        const bottomAdImages = [
            "{{ asset('assets/images/4.png') }}",
            "{{ asset('assets/images/5.png') }}",
            "{{ asset('assets/images/7.png') }}"
            //    "{{ asset('images/6.png') }}"
        ];

        let topAdIndex = 0;
        let bottomAdIndex = 0;

        function updateTopAd() {
            document.getElementById("topAd").src = topAdImages[topAdIndex];
        }

        function updateBottomAd() {
            document.getElementById("bottomAd").src = bottomAdImages[bottomAdIndex];
        }

        function nextTopAd() {
            topAdIndex = (topAdIndex + 1) % topAdImages.length;
            updateTopAd();
        }

        function prevTopAd() {
            topAdIndex = (topAdIndex - 1 + topAdImages.length) % topAdImages.length;
            updateTopAd();
        }

        function nextBottomAd() {
            bottomAdIndex = (bottomAdIndex + 1) % bottomAdImages.length;
            updateBottomAd();
        }

        function prevBottomAd() {
            bottomAdIndex = (bottomAdIndex - 1 + bottomAdImages.length) % bottomAdImages.length;
            updateBottomAd();
        }

        // Auto-slide every 3 seconds
        setInterval(nextTopAd, 3000);
        setInterval(nextBottomAd, 3000);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".ad-carousel").forEach(carousel => {
                let images = Array.from(carousel.querySelectorAll(".ad-images img"));
                let currentIndex = 0;

                // Hide all images except the first one
                images.forEach((img, index) => {
                    img.style.display = index === 0 ? "block" : "none";
                });

                // Get the existing Previous and Next Buttons
                let prevBtn = carousel.querySelector(".prev-btn");
                let nextBtn = carousel.querySelector(".next-btn");

                function showImage(index) {
                    images[currentIndex].style.display = "none";
                    currentIndex = (index + images.length) % images.length;
                    images[currentIndex].style.display = "block";
                }

                // Event Listeners for Previous and Next Buttons
                prevBtn.addEventListener("click", () => showImage(currentIndex - 1)); // Previous
                nextBtn.addEventListener("click", () => showImage(currentIndex + 1)); // Next

                // Auto-slide every 3 seconds
                setInterval(() => showImage(currentIndex + 1), 3000);
            });
        });
    </script>
@endsection
