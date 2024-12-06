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
    <div class="header container-fluid p-0">
        @include('layouts.include.nav');
    </div>
    <script src="{{ asset('storage/js/header.js') }}"></script>
</header>
