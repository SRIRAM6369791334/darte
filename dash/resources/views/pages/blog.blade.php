{{-- @extends('layouts.master')

@section('title')
    Darte Ecom
@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
    <style>
        .error-text {
            font-size: 13px;
            display: block;
            margin-top: 4px;
        }
    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1')
    Home
    @endslot
    @slot('title')
    Blog
    @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- ADD BUTTON -->
                    <div class="text-end mb-3">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                            + Add Blog
                        </button>
                    </div>

                    <!-- TABLE -->
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Meta Title</th>
                                    <th>Meta Description</th>
                                    <th>Meta Keywords</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $key => $blog)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>
                                            <img src="{{ asset('uploads/blogs/' . $blog->image) }}" width="80">
                                        </td>

                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->date }}</td>
                                        <td>{{ $blog->meta_title ?? '—' }}</td>
                                        <td style="max-width:200px; white-space:normal;">{{ $blog->meta_description ?? '—' }}
                                        </td>
                                        <td>{{ $blog->meta_key ?? '—' }}</td>

                                        <td>
                                            <button class="btn btn-secondary btn-sm editBtn" data-id="{{ $blog->id }}"
                                                data-title="{{ $blog->title }}" data-date="{{ $blog->date }}"
                                                data-desc="{{ $blog->description }}" data-image="{{ $blog->image }}"
                                                data-meta-title="{{ $blog->meta_title }}"
                                                data-meta-description="{{ $blog->meta_description }}"
                                                data-meta-key="{{ $blog->meta_key }}" data-bs-toggle="modal"
                                                data-bs-target="#editBlogModal">
                                                Edit
                                            </button>

                                            <button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $blog->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- ================= ADD MODAL ================= -->

    <div class="modal fade" id="addBlogModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Add Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="addBlogForm" enctype="multipart/form-data">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label>Title *</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Date *</label>
                                <input type="date" name="date" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Blog Image *</label>
                                <input type="file" id="add_blog_image" name="image" class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp">
                                <!-- Preview -->
                                <div class="text-center mt-2">
                                    <img id="add_blog_preview" style="max-width:100%; display:none;">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Description *</label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>

                            <!-- SEO META FIELDS -->
                            <div class="col-md-12">
                                <hr>
                                <h6 class="text-muted">SEO Meta Fields</h6>
                            </div>

                            <div class="col-md-6">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" placeholder="Meta title for SEO">
                            </div>



                            <div class="col-md-6">
                                <label>Meta Keywords</label>
                                <input type="text" name="meta_key" class="form-control"
                                    placeholder="keyword1, keyword2, keyword3">
                            </div>
                            <div class="col-md-12">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3"
                                    placeholder="Meta description for SEO"></textarea>
                            </div>

                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= EDIT MODAL ================= -->

    <div class="modal fade" id="editBlogModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Edit Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="editBlogForm" enctype="multipart/form-data">

                        <input type="hidden" id="edit_blog_id">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label>Title *</label>
                                <input type="text" id="edit_blog_title" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Date *</label>
                                <input type="date" id="edit_blog_date" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Change Image</label>
                                <input type="file" id="edit_blog_image" class="form-control">
                                <!-- OLD IMAGE -->
                                <div class="mb-1 mt-2">Previous Image</div>
                                <img id="edit_blog_old_img" style="width:120px; margin-bottom:8px;">
                                <!-- NEW PREVIEW -->
                                <div class="mb-1">New Preview</div>
                                <img id="edit_blog_preview" style="width:120px; display:none;">
                            </div>

                            <div class="col-md-12">
                                <label>Description *</label>
                                <textarea id="edit_blog_desc" class="form-control" rows="5"></textarea>
                            </div>

                            <!-- SEO META FIELDS -->
                            <div class="col-md-12">
                                <hr>
                                <h6 class="text-muted">SEO Meta Fields</h6>
                            </div>

                            <div class="col-md-6">
                                <label>Meta Title</label>
                                <input type="text" id="edit_blog_meta_title" class="form-control"
                                    placeholder="Meta title for SEO">
                            </div>
                            <div class="col-md-6">
                                <label>Meta Keywords</label>
                                <input type="text" id="edit_blog_meta_key" class="form-control"
                                    placeholder="keyword1, keyword2, keyword3">
                            </div>

                            <div class="col-md-12">
                                <label>Meta Description</label>
                                <textarea id="edit_blog_meta_description" class="form-control" rows="3"
                                    placeholder="Meta description for SEO"></textarea>
                            </div>



                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <style>
        .error-text {
            font-size: 12px !important;
            color: #dc3545;
            margin-top: 4px;
            display: block;
            font-weight: 400;
        }

        .is-invalid {
            border: 1px solid #dc3545 !important;
        }

        .form-control.is-invalid {
            padding-right: 10px;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
    </style>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.csrfToken = "{{ csrf_token() }}";
        window.assetPath = "{{ asset('uploads/blogs/') }}/";
    </script>

    <script src="{{ asset('assets/js/app/BlogPage.js') }}"></script>
@endsection --}}
