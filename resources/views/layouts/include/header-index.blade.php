<header>
    <script>
        let timeoutCategoryType = null;
        let timeoutCategory = null;

        const loadDataHeaderCategory = async (category_type_id) => {
            var url = `{{ route('ajax.header-category') }}?category_type_id=${category_type_id}`;
            try {
                const response = await fetch(url);
                if (response.ok) {
                    const result = await response.text();
                    document.getElementById("resultHeaderCategory").innerHTML = result;
                } else {
                    console.error("Failed to fetch data:", response.status);
                }
            } catch (error) {
                console.error("Error:", error);
            }
        };
        const loadBgCategoryType = (category_type_id) => {
            document.querySelectorAll(".categoryTypeHeader").forEach(element => {
                element.classList.remove('fw-bold');
                element.classList.remove('bg-grey');
            });
            let element = document.getElementById(`categoryTypeHeader${category_type_id}`);
            element.classList.add('fw-bold');
            element.classList.add('bg-grey');
        }

        const loadTimeOutDHC = (category_type_id) => {
            if (timeoutCategoryType) {
                clearTimeout(timeoutCategoryType);
            }
            timeoutCategoryType = setTimeout(() => {
                loadDataHeaderCategory(category_type_id);
                loadBgCategoryType(category_type_id);
                loadDataHeaderProduct("", category_type_id);
            }, 200);
        }

        const loadDataHeaderProduct = async (category_id, category_type_id = 0) => {
            var url = '';
            if (category_type_id == 0) {
                url = `{{ route('ajax.header-product') }}?category_id=${category_id}`;
            } else {
                url = `{{ route('ajax.header-product') }}?category_type_id=${category_type_id}`;
            }

            try {
                const response = await fetch(url);
                if (response.ok) {
                    const result = await response.text();
                    document.getElementById("resultHeaderProduct").innerHTML = result;
                } else {
                    console.error("Failed to fetch data:", response.status);
                }
            } catch (error) {
                console.error("Error:", error);
            }
        };
        const loadBgCategory = (category_id) => {
            document.querySelectorAll(".categoryHeader").forEach(element => {
                element.classList.remove('fw-bold');
                element.classList.remove('bg-grey');
            });
            let element = document.getElementById(`categoryHeader${category_id}`);
            element.classList.add('fw-bold');
            element.classList.add('bg-grey');
        }

        const loadTimeOutDHP = (category_id) => {
            if (timeoutCategory) {
                clearTimeout(timeoutCategory);
            }
            timeoutCategory = setTimeout(() => {
                loadDataHeaderProduct(category_id);
                loadBgCategory(category_id);
            }, 200);
        };

        const loadDataHeaderCart = async () => {
            var url = `{{ route('ajax.header-cart') }}`;
            try {
                const response = await fetch(url);
                if (response.ok) {
                    const result = await response.text();
                    document.getElementById("resultHeaderCart").innerHTML = result;
                } else {
                    console.error("Failed to fetch data:", response.status);
                }
            } catch (error) {
                console.error("Error:", error);
            }
        };
        loadDataHeaderCart();
    </script>
    <style>
        #search-bar {
            display: none;
        }
    </style>
    <div class="header container-fluid p-0 ">
        @include('layouts.include.nav');
        <div class="container-fluid d-flex flex-column gap-5 p-5 justify-content-center align-items-center h-100">
            <div class=" fs-2 d-flex gap-5">
                <a href="{{ route('search.index') }}"
                    class="text-white link-warning link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Products</a>
                <a href="{{ route('search.all-suppliers') }}"
                    class="text-white link-warning link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Suppliers</a>
            </div>

            <form action="{{ route('search.index') }}" class="input-group"
                style="min-width: 500px; width: 100%; max-width: 1000px; border-radius: 50px; border: 1px solid #ccc; overflow: hidden; z-index: 0;">
                <!-- Text Input -->
                <input type="text" name="name" class="form-control border-0" placeholder="new phone 2024"
                    aria-label="Search" style="border-radius: 0;">

                <!-- Camera Icon -->
                <span class="input-group-text bg-white border-0" style="cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-camera-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                        <path
                            d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0" />
                    </svg>
                </span>

                <!-- Search Button -->
                <span class="input-group-text bg-white border-0" style="cursor: pointer;">
                    <button class="btn text-white rounded-pill" type="submit" style="background-color: #ff6600;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                        Search
                    </button>
                </span>
            </form>
        </div>
    </div>
    <script src="{{ asset('storage/js/header-index.js') }}"></script>
</header>
