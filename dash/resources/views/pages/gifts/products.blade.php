@extends('layouts.master')
@section('title')
    Darte Ecom - Gift Products
@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Home
        @endslot
        @slot('title')
            Gift Products
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <p style="position: relative; top: 33px; left: 25px; font-weight: bold;">Search:</p>
                <div class="card-body">
                    <div class="position-relative">
                        <div class="modal-button mt-2">
                            <div class="row align-items-start">
                                <div class="col-sm">
                                    <div>
                                        <button type="button" class="btn btn-success add_btn_top_el mb-4"
                                            data-bs-toggle="modal" data-bs-target="#addProductModal"><i
                                                class="mdi mdi-plus me-1"></i> Add Gift Product</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="table-gridjs"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD MODAL --}}
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Gift Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form class="needs-validation" id="addProductForm" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="add_category_select">Choose Gift Category*</label>
                                    <select class="form-select" name="category_id" id="add_category_select">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="add_subcategory_select">Choose Gift SubCategory</label>
                                    <select class="form-select" name="subcategory_id" id="add_subcategory_select">
                                        <option value="" disabled selected>Select SubCategory</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_name">Product Name*</label>
                                    <input type="text" class="form-control" id="add_product_name" name="product_name"
                                        placeholder="Gift Product name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_description">Product Description</label>
                                    <textarea class="form-control" id="add_product_description" name="product_description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_image">Product Image*</label>
                                    <input type="file" class="form-control" id="add_product_image" name="product_image" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="add_mrp_price">Price (MRP)*</label>
                                    <input type="number" class="form-control" id="add_mrp_price" name="mrp_price" placeholder="0.00" step="0.01" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="add_offer_price">Selling Price*</label>
                                    <input type="number" class="form-control" id="add_offer_price" name="offer_price" placeholder="0.00" step="0.01" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="add_stock_quantity">Stock Quantity*</label>
                                    <input type="number" class="form-control" id="add_stock_quantity" name="stock_quantity" placeholder="0" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="add_low_stock">Low Stock Alert*</label>
                                    <input type="number" class="form-control" id="add_low_stock" name="low_stock" placeholder="5" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary add_submit_btn mt-3" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Gift Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form class="needs-validation" id="editProductForm" novalidate>
                        @csrf
                        <input type="hidden" id="edit_product_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_category_select">Choose Gift Category*</label>
                                    <select class="form-select" name="category_id" id="edit_category_select">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_subcategory_select">Choose Gift SubCategory</label>
                                    <select class="form-select" name="subcategory_id" id="edit_subcategory_select">
                                        <option value="" disabled selected>Select SubCategory</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_product_name">Product Name*</label>
                                    <input type="text" class="form-control" id="edit_product_name" name="product_name"
                                        placeholder="Gift Product name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_product_description">Product Description</label>
                                    <textarea class="form-control" id="edit_product_description" name="product_description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_product_image">Product Image*</label>
                                    <input type="file" class="form-control" id="edit_product_image" name="product_image">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_mrp_price">Price (MRP)*</label>
                                    <input type="number" class="form-control" id="edit_mrp_price" name="mrp_price" placeholder="0.00" step="0.01" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_offer_price">Selling Price*</label>
                                    <input type="number" class="form-control" id="edit_offer_price" name="offer_price" placeholder="0.00" step="0.01" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_stock_quantity">Stock Quantity*</label>
                                    <input type="number" class="form-control" id="edit_stock_quantity" name="stock_quantity" placeholder="0" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_low_stock">Low Stock Alert*</label>
                                    <input type="number" class="form-control" id="edit_low_stock" name="low_stock" placeholder="5" required>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex flex-column">
                                <div class="mb-2">Previous Image</div>
                                <img src="" alt="prev_img" class="edit_preview_image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary edit_submit_btn mt-3" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        window.products = @json($products);
        window.subcategories = @json($subcategories);
        window.giftUrls = {
            store: "{{ route('gift_products.store') }}",
            update: "{{ url('updateGiftProducts') }}",
            destroy: "{{ url('destroyGiftProducts') }}"
        };
    </script>
    <script src="{{ URL::asset('assets/js/app/GiftProductPage.js') }}"></script>
@endsection
