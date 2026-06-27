@extends('layouts.master')
@section('title')
    Darte Ecom - Gift Sub Categories
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
            Gift Sub Category
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
                                            data-bs-toggle="modal" data-bs-target="#addSubCategoriesModal"><i
                                                class="mdi mdi-plus me-1"></i> Add Gift Sub Category</button>
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
    <div class="modal fade" id="addSubCategoriesModal" tabindex="-1" aria-labelledby="addCategoriesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoriesModalLabel">Add Gift Sub Categories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form class="needs-validation" id="addSubCategoriesForm" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="add_categoryname">Gift Category Name</label><span
                                        class="dark-asterisk">*</span>
                                    <select name="category_name" id="add_categoryname" class="form-control">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories as $ct)
                                            <option value="{{ $ct->id }}">{{ $ct->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="add_subcategoriesname">Sub Category Name</label><span
                                        class="dark-asterisk">*</span>
                                    <input type="text" class="form-control" id="add_subcategoriesname"
                                        name="subcategory_name" placeholder="Sub Category name" maxlength="50" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="add_subcategoryImage">Sub Category Image</label>
                                    <span class="dark-asterisk">*(600* 600)(Only png,jpg,jpeg)</span>
                                    <input type="file" class="form-control" id="add_subcategoryImage"
                                        placeholder="Sub Category Image" accept=".png, .jpg, .webp" name="subcategory_image"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="add_subcategoryImage" class="preview-container">
                                    <div class="flex justify-content-center">
                                        <div class="text-center">
                                            <i class="display-4 col-12 text-muted mdi mdi-cloud-upload"></i>
                                        </div>
                                        <div>
                                            <span class="col-12">Upload Image</span>
                                        </div>
                                    </div>
                                </label>
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
    <div class="modal fade" id="editSubCategoriesModal" tabindex="-1" aria-labelledby="editSubCategoriesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubCategoriesModalLabel">Edit Gift Sub Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form class="needs-validation" id="editSubCategoriesForm" novalidate>
                        @csrf
                        <input type="hidden" id="edit_subcategories_id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_categoryname">Gift Category Name</label><span
                                        class="dark-asterisk">*</span>
                                    <select name="category_name" id="edit_categoryname" class="form-control">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories as $ct)
                                            <option value="{{ $ct->id }}">{{ $ct->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="edit_subcategoriesname">Sub Category Name</label><span
                                        class="dark-asterisk">*</span>
                                    <input type="text" class="form-control" id="edit_subcategoriesname"
                                        name="subcategory_name" placeholder="Sub Category name" maxlength="50" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_subcategoryImage">Sub Category Image</label>
                                    <span class="dark-asterisk">*(600* 600)(Only png,jpg,jpeg)</span>
                                    <input type="file" class="form-control" id="edit_subcategoryImage"
                                        placeholder="Sub Category Image" accept=".png, .jpg, .webp" name="subcategory_image">
                                </div>
                            </div>
                            <div class="col-md-12 d-flex">
                                <div class="col-6">
                                    <div class="mb-2">Previous Image</div>
                                    <label class="edit_show_preview-container">
                                        <img src="" alt="edit_subcategory_image" class="edit_preview_image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;"></label>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">New Image</div>
                                    <label for="edit_subcategoryImage" class="edit_preview-container">
                                        <div class="flex justify-content-center">
                                            <div class="text-center">
                                                <i class="display-4 col-12 text-muted mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div>
                                                <span class="col-12">Upload Image</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
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
        window.subcategories = @json($subcategories);
        window.giftUrls = {
            store: "{{ route('gift_subcategories.store') }}",
            update: "{{ url('updateGiftSubcategories') }}",
            destroy: "{{ url('destroyGiftSubcategories') }}"
        };
    </script>
    <script src="{{ URL::asset('assets/js/app/GiftSubCategoryPage.js') }}"></script>
@endsection
