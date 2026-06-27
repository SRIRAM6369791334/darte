@extends('layouts.master')
@section('title')
    Darte Ecom - Gift Categories
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
    Gift Banner
    @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <p style="position: relative;
                                    top: 33px;
                                    left: 25px;
                                    font-weight: bold;">
                    Search:</p>
                <div class="card-body">
                    <div class="position-relative">
                        <div class="modal-button mt-2">
                            <div class="row align-items-start">
                                <!-- <div class="col-sm">
                                                        <div>
                                                            <button type="button" class="btn btn-success  add_btn_top_el mb-4"
                                                                data-bs-toggle="modal" data-bs-target="#addCategoriesModal"><i
                                                                    class="mdi mdi-plus me-1"></i> Add
                                                                Gift Category</button>
                                                        </div>
                                                    </div> -->
                            </div>
                        </div>
                    </div>
                    <div id="table-gridjs"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addCategoriesModal" tabindex="-1" aria-labelledby="addCategoriesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoriesModalLabel">Add Gift Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form class="needs-validation" id="addCategoriesForm" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="add_bannerTitle">Banner Title</label><span
                                        class="dark-asterisk">*</span>
                                    <input type="text" class="form-control" id="add_bannerTitle" name="banner_title"
                                        placeholder="Banner Title" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="add_bannerDescription">Banner Description</label>
                                    <textarea class="form-control" id="add_bannerDescription" name="banner_description"
                                        placeholder="Banner Description" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="add_categoryImage">Category Image</label>
                                    <span class="dark-asterisk">*(Only png,jpg,jpeg,webp, Size: 960x550, Max 10MB)</span>
                                    <input type="file" class="form-control" id="add_categoryImage"
                                        accept=".png, .jpg, .jpeg, .webp" name="category_image" required>
                                    <label for="add_categoryImage" class="preview-container mt-2">
                                        <div class="text-center p-3 border dashed">
                                            <i class="display-4 text-muted mdi mdi-cloud-upload"></i>
                                            <p class="mb-0">Upload Image</p>
                                        </div>
                                    </label>
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


    <div class="modal fade" id="editCategoriesModal" tabindex="-1" aria-labelledby="editCategoriesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoriesModalLabel">Edit Banner Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form class="needs-validation" id="editCategoriesForm" novalidate>
                        @csrf
                        <input type="hidden" id="edit_categories_id" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_bannerTitle">Banner Title*</label>
                                    <input type="text" class="form-control" id="edit_bannerTitle" name="banner_title"
                                        placeholder="Banner Title" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_bannerDescription">Banner Description</label>
                                    <textarea class="form-control" id="edit_bannerDescription" name="banner_description"
                                        placeholder="Banner Description" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_categoryImage">Category Image (960x550)*</label>
                                    <input type="file" class="form-control" id="edit_categoryImage" name="category_image"
                                        accept=".png, .jpg, .jpeg, .webp">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <small>Previous Image</small>
                                        <div class="edit_show_preview-container border p-1">
                                            <img src="" alt="prev_image" class="edit_preview_image img-fluid"
                                                style="height: 100px; width: 100%; object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <small>New Image</small>
                                        <label for="edit_categoryImage"
                                            class="edit_preview-container border p-1 d-block text-center"
                                            style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                            <i class="mdi mdi-cloud-upload fs-1 text-muted"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary mt-3 edit_submit_btn" type="submit">Update</button>
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
        window.categories = @json($categories);
        window.giftUrls = {
            store: "{{ route('gift_categories.store') }}",
            update: "{{ url('updateGiftCategories') }}",
            destroy: "{{ url('destroyGiftCategories') }}"
        };
    </script>
    <script src="{{ URL::asset('assets/js/app/GiftCategoriesPage.js') }}"></script>
@endsection