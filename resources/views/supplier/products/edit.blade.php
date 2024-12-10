@extends('layouts.supplier')
@section('title',  request()->getHost() . ' - Products Edit')
@section('content')
    <script>
        let timeoutCategoryType = null;
        const loadDataAjaxCategory = async (category_type_id) => {
            var url = `{{ route('ajax.supplier-category') }}?category_type_id=${category_type_id}`;
            try {
                const response = await fetch(url);
                if (response.ok) {
                    const result = await response.text();
                    document.getElementById("ajaxCategory").innerHTML = result;
                } else {
                    console.error("Failed to fetch data:", response.status);
                }
            } catch (error) {
                console.error("Error:", error);
            }
        };
        const loadTimeOutAC = (category_type_id) => {
            if (timeoutCategoryType) {
                clearTimeout(timeoutCategoryType);
            }
            timeoutCategoryType = setTimeout(() => {
                loadDataAjaxCategory(category_type_id);
            }, 200);
        }
    </script>
    <form method="POST" action="{{ route('supplier.products.update', ['product' => $product->id]) }}"
        class="container-fluid d-flex flex-column gap-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @php
            $inputType = $product->variants[0]->options->pluck('name')->join(';');
            //dd($inputType);

            $inputVariantsData = $product->variants
                ->map(function ($variant) {
                    return $variant->options->pluck('value')->join(', ') .
                        ':' .
                        $variant->price .
                        ', ' .
                        $variant->stock .
                        ', ' .
                        $variant->weight;
                })
                ->join(';');
            $keyAttributes = $product->keyAttributes
                ->map(function ($keyAttribute) {
                    return $keyAttribute->name . '[:]' . $keyAttribute->value;
                })
                ->join('[;]');
            //dd($keyAttributes);
        @endphp
        <input type="hidden" id="hidden-type" name="type" value="{{ old('type', $inputType) }}">
        <input type="hidden" id="hidden-value" name="value" value="{{ old('value', $inputVariantsData) }}">
        <div class="">
            <div class="h2 fw-bold">Edit product: #{{ $product->id }}</div>
            @include('include.showAlert')
            <div class="d-flex flex-wrap justify-content-between">
                <div class="text-secondary">Orders placed across your store</div>
                <div class="d-flex gap-2">
                    <button class="border btn btn-light" type="button">Discard</button>
                    <input type="button" value="Publish Product" class="border btn btn-orange fw-bold"
                        onclick="submitFormAdd(this.form);">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 ">
                <div class="p-5 w-100 d-flex flex-column gap-4">
                    <div class="">
                        <label class="h5" for="">Product Name <sup class="text-danger">*</sup></label>
                        <input class="form-control" type="text" name="name" id="name"
                            placeholder="Write name here..." value="{{ old('name', $product->name) }}">
                    </div>
                    <div class="">
                        <label class="h5" for="description">Product Description</label>
                        <div id="description-editor" style="height: auto;">{!! old('description', $product->description) !!}
                        </div>
                        <input type="hidden" name="description" id="description">

                    </div>
                    <!-- dropzone -->
                    <div class="container mt-5">
                        <label for="fileUpload" class="h5">Display images</label>
                        <div class="image-upload">
                            <input type="file" id="fileUpload" accept="image/*" class="d-none" name="image">
                            <p class="mt-2">
                                Drag your photo here or
                                <a href="#" class="text-primary"
                                    onclick="document.getElementById('fileUpload').click(); return false;">
                                    Browse from device
                                </a>
                            </p>
                            {{-- {{ asset('storage/image/icon/image.svg') }} --}}
                            <img id="previewImage" src="{{ asset($product->image) }}" alt="Preview" class="rounded"
                                width="150" height="150"
                                onclick="document.getElementById('fileUpload').click(); return false;">
                        </div>
                    </div>
                    <div class="">
                        <div class="h5">Inventory</div>
                        <div class="d-flex h-100">
                            <div class="inventory d-flex flex-column justify-content-between w-25">
                                <div class="px-0 btn btn-outline-dark border border-start-0 py-3 text-secondary active">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-tag" viewBox="0 0 16 16">
                                        <path
                                            d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0" />
                                        <path
                                            d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1m0 5.586 7 7L13.586 9l-7-7H2z" />
                                    </svg> Pricing
                                </div>
                                <div class="px-0 btn btn-outline-dark border border-start-0 py-3 text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                                        <path
                                            d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
                                    </svg> Restock
                                </div>
                                <div class="px-0 btn btn-outline-dark border border-start-0 py-3 text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                        <path
                                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                                    </svg> Shipping
                                </div>
                                <div class="px-0 btn btn-outline-dark border border-start-0 py-3 text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-sliders2-vertical" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M0 10.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1H3V1.5a.5.5 0 0 0-1 0V10H.5a.5.5 0 0 0-.5.5M2.5 12a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5m3-6.5A.5.5 0 0 0 6 6h1.5v8.5a.5.5 0 0 0 1 0V6H10a.5.5 0 0 0 0-1H6a.5.5 0 0 0-.5.5M8 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2A.5.5 0 0 0 8 1m3 9.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1H14V1.5a.5.5 0 0 0-1 0V10h-1.5a.5.5 0 0 0-.5.5m2.5 1.5a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5" />
                                    </svg> Attributes
                                </div>
                                <div class="px-0 btn btn-outline-dark border border-start-0 py-3 text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                        <path
                                            d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
                                    </svg> Advanced
                                </div>
                            </div>
                            <!-- product price -->
                            <div class="d-flex border border-end-0 w-100">
                                <div class="w-100 h-100">
                                    <div class="d-flex flex-column justify-content-center fw-bold py-2 px-5"
                                        id="regular-price">
                                        <label for="">Regular price <sup class="text-danger">*</sup></label>

                                        <input class="form-control" type="text" name="price" min="0"
                                            placeholder="$" value="{{ old('price', $product->variants[0]->price) }}">

                                    </div>
                                    <div class="d-none flex-column border-top w-100" id="price-options">
                                        <div class="px-3 fw-bold">Variants <sup class="text-danger">*</sup></div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="p-4" id="select-options">

                                                </div>
                                            </div>
                                            <div class="col-md-7 border-start">
                                                {{-- <div class="p-3 d-flex flex-column h-100 gap-4">
                                                    <div class="d-flex gap-3">
                                                        <strong>Variant:</strong>
                                                        <div>red, xl</div>
                                                    </div>
                                                    <div>
                                                        <label class="fw-bold" for="">Variant price</label>
                                                        <div class="d-flex gap-3">
                                                            <input type="text" name="" id="variant-price"
                                                                class="form-control" placeholder="$$$">
                                                            <input type="button" class="btn btn-success" value="Save">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="p-3 d-flex flex-column h-100 gap-4">
                                                    <div class="d-flex gap-3">
                                                        <strong>Variant:</strong>
                                                        <div id="selected-variant"></div>
                                                    </div>
                                                    <div>
                                                        <label class="fw-bold" for="">Variant price <sup
                                                                class="text-danger">*</sup></label>
                                                        <div class="d-flex gap-3">
                                                            <input type="text" id="variant-price" class="form-control"
                                                                placeholder="$$$" oninput="onOptionChange()">
                                                            <input type="button" id="save-variant"
                                                                class="btn btn-success" value="Save"
                                                                onclick="saveVariant()">
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <h5>Saved Variants</h5>
                                                        <ul id="saved-variants-list"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Restock -->
                            {{-- <div>
                                        <div><strong>Product in stock now:</strong> 0</div>
                                        <div><strong>Last time restocked:</strong> 30th June, 2021</div>
                                        <div><strong>Total stock over lifetime:</strong> 0</div>
                                    </div> --}}
                            <div class="d-none border border-end-0 w-100">
                                <div class="w-100 d-flex flex-column justify-content-between p-4">
                                    <div>

                                        <label class="h4">Add to Stock <sup class="text-danger">*</sup></label>
                                        <input class="d-none form-control" type="number" name="" id="stock"
                                            min='0' value="" placeholder="Quantity" oninput="">
                                        <input class=" form-control" type="number" name="stock" min='0'
                                            id="stock-none" value="{{ old('stock', $product->variants[0]->stock) }}"
                                            placeholder="Quantity">

                                    </div>

                                </div>
                            </div>
                            <!-- shiping -->
                            <div class="d-none border border-end-0 w-100">
                                <div class="w-100 d-flex flex-column justify-content-between p-4">
                                    <div class="">
                                        <label class="h4">Weight (kg) <sup class="text-danger">*</sup></label>
                                        <input class="form-control" type="text" name="weight" id="weight-none"
                                            placeholder="Weight: 0.15"
                                            value="{{ old('weight', $product->variants[0]->weight) }}">
                                        <input class="d-none form-control" type="text" name="" id="weight"
                                            placeholder="Weight: 0.15" value="0.1" oninput="">
                                    </div>
                                </div>
                            </div>
                            <!-- Attributes -->
                            <div class="d-none border border-end-0 w-100">
                                <div class="w-100 d-flex flex-column justify-content-between p-4">
                                    <div class="h4">Attributes <sup class="text-danger">*</sup></div>
                                    <div>
                                        <input type="checkbox" name="fragile" id="" value="1"
                                            @checked($product->attribute->fragile)> Fragile
                                        Product
                                    </div>
                                    <div>
                                        <input type="checkbox" name="biodegradable" id="" value="1"
                                            @checked($product->attribute->biodegradable)>
                                        Biodegradable
                                    </div>
                                    <div>
                                        <input type="checkbox" name="frozen" id="" value="1"
                                            onchange="document.getElementById('max_temp').disabled = !this.checked"
                                            @checked($product->attribute->frozen)>
                                        Frozen Product <br>
                                        <input class="form-control" type="text" name="max_temp" id="max_temp"
                                            value="{{ $product->attribute->max_temp }}"
                                            placeholder="Max. allowed Temperature" @disabled(!$product->attribute->frozen)>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="expiry" id="" value="1"
                                            onchange="document.getElementById('expiry_date').disabled = !this.checked"
                                            @checked($product->attribute->expiry)>
                                        Expiry Date of Product <br>
                                        <input class="form-control" type="text" name="expiry_date" id="expiry_date"
                                            value="{{ $product->attribute->expiry_date }}" placeholder="yyyy-mm-dd"
                                            @disabled(!$product->attribute->expiry)>
                                    </div>
                                </div>
                            </div>

                            <!-- edit Advanced -->
                            <div class="d-none border border-end-0 w-100">
                                <div class="w-100 d-flex flex-column justify-content-around p-4 gap-4">
                                    <div>
                                        <label class="h4" for="">Product key attributes</label>
                                        <div class="d-flex gap-3">
                                            <input class="form-control" type="text" id="add_key_attribute"
                                                placeholder="key">
                                            <input type="button" id="add " value="Add" class="btn btn-orange"
                                                onclick="onClickAddKeyAtt()">
                                        </div>
                                    </div>

                                    <div>
                                        <select id="key_attribute_select" class="select-control form-control w-50"
                                            onclick="onChangeKeyAtt(this);">
                                            @foreach ($product->keyAttributes as $keyAttribute)
                                                <option value="{{ $keyAttribute->value }}">
                                                    {{ $keyAttribute->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <br>

                                        <input type="text" id="key_attribute_value" placeholder="value"
                                            class="form-control" value="" disabled oninput="onInputKeyAttValue()">
                                        <div class="alert alert-lighter" id="key_attribute_success"></div>
                                        <input type="hidden" name="key_attributes" id='key_attributes_hidden'
                                            value="{{ old('key_attributes', $keyAttributes) }}">
                                    </div>
                                    <script>
                                        const inputValueKeyAtt = document.getElementById('key_attribute_value');
                                        const selectKeyAtt = document.getElementById('key_attribute_select');
                                        const hiddenKeyAtt = document.getElementById('key_attributes_hidden');
                                        const alertKeyAtt = document.getElementById('key_attribute_success');

                                        const addKeyAttribute = document.getElementById('add_key_attribute');



                                        let timeoutKeyAtt = null;

                                        function onClickAddKeyAtt() {
                                            if (addKeyAttribute.value == '') {
                                                alert("request a key");
                                                return;
                                            }
                                            const newOption = document.createElement("option");
                                            newOption.textContent = addKeyAttribute.value;
                                            selectKeyAtt.appendChild(newOption);

                                            addKeyAttribute.value = "";
                                        }

                                        function onChangeKeyAtt(opt) {
                                            inputValueKeyAtt.disabled = false;
                                            inputValueKeyAtt.value = opt.value;
                                        }



                                        function onInputKeyAttValue() {
                                            alertKeyAtt.textContent = "";
                                            if (timeoutKeyAtt) {
                                                clearTimeout(timeoutKeyAtt);
                                            }
                                            timeoutKeyAtt = setTimeout(() => {
                                                let optionSelectedKeyAtt = selectKeyAtt.options[selectKeyAtt.selectedIndex];
                                                optionSelectedKeyAtt.value = inputValueKeyAtt.value;
                                                const optionsKeyAtt = selectKeyAtt.getElementsByTagName("option");
                                                const arrayKeyAtt = [...optionsKeyAtt];
                                                hiddenKeyAtt.value = arrayKeyAtt
                                                    .map(opt => opt.textContent.replace('\n', "").trim() + "[:]" + opt.value)
                                                    .join('[;]');
                                                alertKeyAtt.textContent =
                                                    `Saved: Key: ${optionSelectedKeyAtt.textContent}, Value: ${optionSelectedKeyAtt.value}`;
                                                console.log('hiddenKeyAtt', hiddenKeyAtt.value);
                                            }, 200);
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 d-flex flex-column gap-4">
                <div class="p-1 w-100">
                    <div class="d-flex flex-column gap-4 bg-white p-3 rounded-4 border">
                        <div class="h5">Product code <sup class="text-danger">*</sup></div>
                        <div>
                            <input type="text" name="code" id="code" class="form-control"
                                placeholder="Product code ... " value="{{ old('code', $product->code) }}">
                        </div>
                    </div>
                </div>
                <div class="p-1 w-100">
                    <div class="d-flex flex-column gap-4 bg-white p-3 rounded-4 border">
                        <div class="h5">Organize</div>
                        <div>
                            <div class="h6">Category type <sup class="text-danger">*</sup></div>
                            <div>
                                <select id="category_type" name="category_type_id"
                                    class="form-select text-secondary small" aria-label="Default select example"
                                    onchange="loadTimeOutAC(this.value)">
                                    @foreach ($category_types as $category_type)
                                        <option value="{{ $category_type->id }}" @selected(old('category_type_id', $product->category->categoryType->id) === $category_type->id)>
                                            {{ $category_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <div class="h6">Category <sup class="text-danger">*</sup></div>
                            <div>
                                <select name="category_id" id="ajaxCategory" class="form-select text-secondary small"
                                    aria-label="Default select example">
                                    @php
                                        $i = $category_types->count();
                                        do {
                                            $i--;
                                            if (
                                                old('category_type_id') ??
                                                $product->category->categoryType->id === $category_types[$i]->id
                                            ) {
                                                break;
                                            }
                                        } while ($i >= 1);
                                    @endphp
                                    @foreach ($category_types[$i]->categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category->id) === $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-1 w-100">
                    <div class="d-flex flex-column gap-4 bg-white p-3 rounded-4 border">
                        <div class="h5">Variants <sup class="text-danger">*</sup></div>
                        <div id="options"></div>
                        <div>
                            <input type="button" class="btn btn-orange form-control fw-bold" id="addOption"
                                value="Add another option">
                        </div>
                    </div>
                    <div id="price-options" class="d-none mt-4 border-top">
                        <div class="fw-bold">Variants</div>
                        <div id="select-options"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- submit -->
    <script>
        var contentEditor = new Quill('#description-editor', {
            theme: 'snow'
        });

        function submitFormAdd(form) {
            document.getElementById('description').value = contentEditor.root.innerHTML;
            document.getElementById('description-editor').innerHTML = document.getElementById('description').value;
            form.submit();
        };
    </script>
    <!-- active tag -->
    <script>
        // Lấy tất cả các tab và các phần nội dung liên quan
        const tabs = document.querySelectorAll('.inventory > .border');
        const sections = document.querySelectorAll('.d-flex > .border.border-end-0');

        // Gắn sự kiện click vào từng tab
        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                // Xóa trạng thái 'active' của tất cả các tab
                tabs.forEach(t => t.classList.remove('active'));
                // Đặt trạng thái 'active' cho tab được nhấp
                tab.classList.add('active');

                // Ẩn tất cả các phần nội dung
                sections.forEach(section => {
                    section.classList.remove('d-flex'); // Gỡ hiển thị
                    section.classList.add('d-none'); // Thêm ẩn
                });

                // Hiển thị phần nội dung tương ứng với tab
                sections[index].classList.remove('d-none'); // Gỡ ẩn
                sections[index].classList.add('d-flex'); // Thêm hiển thị
            });
        });

        document.getElementById('fileUpload').addEventListener('change', function(event) {
            const file = event.target.files[0]; // Lấy file đã chọn
            if (file) {
                const reader = new FileReader(); // Tạo FileReader để đọc file
                reader.onload = function(e) {
                    // Hiển thị hình ảnh được chọn
                    const previewImage = document.getElementById('previewImage');
                    previewImage.src = e.target.result; // Gán URL của hình ảnh
                };
                reader.readAsDataURL(file); // Đọc file dưới dạng Data URL
            }
        });
    </script>

    <script>
        function parseVariantsData(inputString) {
            const pairs = inputString.split(';');
            //input type
            const inputType = "{{ old('type', $inputType) }}";

            const types = inputType.split(";").map((item) => {
                return {
                    type: item,
                    values: [],
                };
            });
            pairs.forEach(pair => { //red, xl: 20000,1,2
                const [key, value] = pair.split(':'); //key: red, xl  || blue, xl
                const typeValues = key.split(', '); //[red,xl] || [blue,xxl]

                for (let i = 0; i < types.length; i++) {
                    if (!types[i].values.includes(typeValues[i])) {
                        types[i].values.push(typeValues[i]);
                    }
                }
            });

            return types;
        }

        function parseVariantsDatas(inputString) {
            const values = inputString.split(";").map((item) => {
                const [key, value] = item.split(":").map((val) => val.trim());
                return {
                    key,
                    value
                };
            });
            const result = values.reduce((acc, item) => {
                acc[item.key] = item.value;
                return acc;
            }, {});
            return result;
        }
    </script>
    <script>
        const inputVariantsData = "{{ old('value', $inputVariantsData) }}";
        console.log("inputVariantsData", inputVariantsData);
        // Biến lưu dữ liệu các option
        const variantsData = inputVariantsData == "" ? [] : parseVariantsData(inputVariantsData);
        console.log('variantsData', variantsData);

        // Biến lưu dữ liệu các tổ hợp
        let variantsDatas = inputVariantsData == "" ? {} : parseVariantsDatas(inputVariantsData);
        console.log('variantsDatas', variantsDatas);
    </script>
    {{-- //options --}}
    <script>
        const optionsContainer = document.getElementById('options');
        const selectOptionsContainer = document.getElementById('select-options');
        const addOptionButton = document.getElementById('addOption');

        // Biến đếm để tạo tên Option
        let optionCount = 0;

        // Biến lưu danh sách các option và giá trị


        // Hàm thêm Option mới
        function addOption() {
            optionCount++;
            const optionDiv = document.createElement('div');

            optionDiv.className = 'option mb-3';
            optionDiv.innerHTML = `
                <div class="h6 d-flex gap-4">
                    Option ${optionCount} 
                    <div class="text-primary remove-option" style="cursor: pointer;">remove option</div>
                </div>
                <div class="d-flex gap-3">
                    <input type="text" class="form-control type-input" id="type-option-${optionCount}" placeholder="Type: color or size or ...">
                    <input type="button" class="button-option-save btn btn-success" id="button-option-save-${optionCount}" value="Save">
                </div>
                <div class="value-option mt-3" id="value-container-${optionCount}"></div>
                <div class="d-flex gap-3 mt-2">
                    <input type="text" id="value-input-${optionCount}" class="form-control value-input" placeholder="Value: red or blue or ...">
                    <input type="button" id="value-button-${optionCount}" class="button-option-add btn btn-primary" value="Add">
                </div>
            `;
            optionsContainer.appendChild(optionDiv);

            attachRemoveEvent(optionDiv.querySelector('.remove-option'));
            attachSaveEvent(optionDiv.querySelector('.button-option-save'));
            attachAddValueEvent(optionDiv.querySelector('.button-option-add'));
        }

        // Hàm gắn sự kiện lưu option
        function attachSaveEvent(saveButton) {
            saveButton.addEventListener('click', function() {
                const optionDiv = this.closest('.option');
                const typeInput = optionDiv.querySelector('.type-input').value.trim();
                const valueContainer = optionDiv.querySelector('.value-option');

                if (!typeInput) {
                    alert('Type cannot be empty!');
                    return;
                }

                const values = [...valueContainer.querySelectorAll('span')].map(span => span.textContent.trim());
                if (values.length === 0) {
                    alert('Please add at least one value.');
                    return;
                }

                // Lưu vào danh sách variant
                const variantIndex = [...optionsContainer.children].indexOf(optionDiv);
                variantsData[variantIndex] = {
                    type: typeInput,
                    values
                };
                console.log('variantsData', variantsData);

                // Thêm vào select-options
                const selectOptionDiv = document.createElement('div');
                selectOptionDiv.className = 'select-option';
                selectOptionDiv.innerHTML = `
                <div>Option ${variantIndex + 1} : ${typeInput}</div>
                <select name="" class="form-control  option-select"  onchange="onOptionChange();">
                    ${values.map(value => `<option value="${value}">${value}</option>`).join('')}
                </select>
            `;
                selectOptionsContainer.appendChild(selectOptionDiv);

                //alert(`Option "${typeInput}" saved successfully!`);
                this.disabled = true;
                checkOptionsFlex();
            });
        }

        // Hàm gắn sự kiện thêm giá trị
        function attachAddValueEvent(addButton) {
            addButton.addEventListener('click', function() {
                const optionDiv = this.closest('.option');
                const valueInput = optionDiv.querySelector('.value-input').value.trim();
                const valueContainer = optionDiv.querySelector('.value-option');

                if (!valueInput) {
                    alert('Value cannot be empty!');
                    return;
                }

                const valueSpan = document.createElement('span');
                valueSpan.className = 'badge bg-secondary me-2';
                valueSpan.textContent = valueInput;
                valueContainer.appendChild(valueSpan);

                optionDiv.querySelector('.value-input').value = ''; // Reset input
            });
        }

        // Hàm gắn sự kiện xóa Option
        function attachRemoveEvent(removeButton) {
            removeButton.addEventListener('click', function() {
                const optionDiv = this.closest('.option');
                const optionIndex = [...optionsContainer.children].indexOf(optionDiv);

                // Xóa khỏi variantsData
                variantsData.splice(optionIndex, 1);
                checkOptionsFlex();
                // Xóa option và select-option tương ứng
                optionDiv.remove();
                const selectOptionDiv = selectOptionsContainer.querySelector(
                    `.select-option:nth-child(${optionIndex + 1})`);
                if (selectOptionDiv) selectOptionDiv.remove();
                checkOptionsFlex();
                updateOptionNumbers();
            });
        }

        // Hàm cập nhật lại số thứ tự Option
        function updateOptionNumbers() {
            document.querySelectorAll('.option').forEach((option, index) => {
                option.querySelector('.h6').firstChild.textContent = `Option ${index + 1}`;
            });
            document.querySelectorAll('.select-option').forEach((selectOption, index) => {
                selectOption.querySelector('div').textContent =
                    `Option ${index + 1} : ${variantsData[index]?.type || ''}`;
            });
            optionCount = document.querySelectorAll('.option').length;
            checkOptionsFlex();
        }



        // Gắn sự kiện cho nút thêm Option
        addOptionButton.addEventListener('click', addOption);
    </script>
    {{-- //selectoptions --}}
    <script>
        // Lưu giá trị của các loại (type) option
        const hiddenType = document.getElementById('hidden-type');
        const hiddenValue = document.getElementById('hidden-value');
        const savedVariantsList = document.getElementById('saved-variants-list');
        const selectedVariantDiv = document.getElementById('selected-variant');
        const variantPriceInput = document.getElementById('variant-price');
        const stockInput = document.getElementById('stock');
        const weightInput = document.getElementById('weight');

        // Hàm lưu tổ hợp variant
        function saveVariant() {
            const selectedVariant = selectedVariantDiv.textContent.trim(); // Lấy tổ hợp đang chọn (e.g., "red, xl")
            const price = parseFloat(variantPriceInput.value.trim()); // Giá trị price
            const stock = parseInt(stockInput.value);
            const weight = parseFloat(weightInput.value.trim());

            if (!selectedVariant || isNaN(price) || isNaN(weight) || selectedVariant == '') {
                alert("Please select a variant - enter a valid price - weight.");
                return;
            }
            if (!confirm(`Do you want to save with data?
            SelectedVariant: ${selectedVariant}
            Price: ${price}
            Stock: ${stock}
            Weight: ${weight}`)) {
                return;
            }
            // Lưu vào biến variantsData
            variantsDatas[selectedVariant] = `${price}, ${stock}, ${weight}`;

            // Cập nhật hidden-value, hidden-type
            updateHiddenValue();
            updateHiddenType();

            // Hiển thị danh sách đã lưu
            renderSavedVariants();
        }

        // Hàm cập nhật hidden-value
        function updateHiddenValue() {
            const entries = Object.entries(variantsDatas).map(([key, value]) => `${key}:${value}`);
            hiddenValue.value = entries.join(";"); // Dạng "red,xl:200.03;blue,xl:100.3"
        }

        function updateHiddenType() {
            // Lấy danh sách các type từ variantsData
            const types = Object.values(variantsData).map(variant => variant.type).filter(Boolean);
            hiddenType.value = types.join(";"); // Ghép các loại lại thành chuỗi
        }
        // Hàm hiển thị danh sách variants đã lưu
        function renderSavedVariants() {
            savedVariantsList.innerHTML = "";

            Object.entries(variantsDatas).forEach(([key, value]) => {
                const li = document.createElement('li');
                li.textContent = `${key} - $${value} kg`;
                savedVariantsList.appendChild(li);
            });
        }

        // Ví dụ cập nhật tổ hợp (thay đổi theo logic chọn của bạn)
        function updateSelectedVariant(newVariant) {
            selectedVariantDiv.textContent = newVariant;
            stockInput.value = 0;
            weightInput.value = 0.1;
        }

        function onOptionChange() {
            const selectedOptions = []; // Thu thập các giá trị được chọn
            document.querySelectorAll('.option-select').forEach(select => {
                selectedOptions.push(select.value.trim());
            });

            // Tổ hợp mới
            const newVariant = selectedOptions.join(", ");
            updateSelectedVariant(newVariant);
        }
    </script>
    <script>
        function checkOptionsFlex() {
            const priceOptions = document.getElementById('price-options');
            const regularPrice = document.getElementById('regular-price');
            const stockNone = document.getElementById('stock-none');
            const weightNone = document.getElementById('weight-none');
            if (variantsData.length === 0) {
                priceOptions.classList.remove('d-flex');
                priceOptions.classList.add('d-none');
                regularPrice.classList.add('d-flex');
                regularPrice.classList.remove('d-none');
                stockNone.classList.remove('d-none');
                stockInput.classList.add('d-none');
                weightNone.classList.remove('d-none');
                weightInput.classList.add('d-none');
            } else {
                priceOptions.classList.add('d-flex');
                priceOptions.classList.remove('d-none');
                regularPrice.classList.remove('d-flex');
                regularPrice.classList.add('d-none');
                stockNone.classList.add('d-none');
                stockInput.classList.remove('d-none');
                weightNone.classList.add('d-none');
                weightInput.classList.remove('d-none');
            }
        }

        function doAtStart() {

            const types = parseVariantsData(inputVariantsData);
            for (let i = 0; i < types.length; i++) {
                addOptionButton.click();
                types[i].values.forEach((e) => {
                    document.getElementById(`value-input-${i+1}`).value = e;
                    document.getElementById(`value-button-${i+1}`).click();
                })
                //edit
                document.getElementById(`value-button-${i+1}`).disabled = true;

                document.getElementById(`type-option-${i+1}`).value = types[i].type;
                document.getElementById(`button-option-save-${i+1}`).click();
            }
            //edit
            addOptionButton.disabled = true;
            document.querySelectorAll(".remove-option").forEach(ro => {
                ro.classList.add('d-none');
            });


            if (types.length > 0) {
                checkOptionsFlex();
                updateHiddenValue();
                updateHiddenType();

                renderSavedVariants();
                onOptionChange();
            }
        }

        doAtStart();
    </script>
    <script>
        //choose file 
        async function fetchImage(url) {
            const response = await fetch(url);
            const blob = await response.blob();
            const file = new File([blob], '{{ basename($product->image) }}', {
                type: blob.type
            });
            return file;
        }
        async function setImageInput(url) {
            const file = await fetchImage(url);
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            const inputElement = document.getElementById('fileUpload');
            inputElement.files = dataTransfer.files;
        }
        setImageInput('{{ asset($product->image) }}');
    </script>
@endsection
