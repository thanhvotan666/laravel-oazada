<section class="container-fluid d-flex flex-column align-items-center my-5" style="z-index: 0;">
    <div class="container">
        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators (optional) -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
            </div>

            <!-- Carousel items -->
            <div class="carousel-inner w-100 h-100">
                <div class="carousel-item w-100 h-100 active">
                    <img src="{{ asset('storage/image/banner/banner1.jpg') }}" class="d-block"
                        alt="Minimalist Furniture Banner" style="width: 100%; height: 100%;">
                </div>
                <div class="carousel-item w-100 h-100">
                    <img src="{{ asset('storage/image/banner/banner2.jpg') }}" class="d-block"
                        alt="Minimalist Furniture Banner" style="width: 100%; height: 100%;">
                </div>
            </div>

            <!-- Controls (optional) -->
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
