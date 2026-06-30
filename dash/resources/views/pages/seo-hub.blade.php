@extends('layouts.master')
@section('title')
    SEO Hub - Darte Ecom
@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
    <style>
        .nav-tabs-custom .nav-item .nav-link.active {
            color: #495057;
            background-color: #fff;
            border-color: #e9ecef #e9ecef #fff;
        }
    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Home
        @endslot
        @slot('title')
            SEO Hub
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#seotags" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">URL Specific SEO Tags</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#metatags" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">General Site Meta Tags</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <!-- SEOTAGS TAB -->
                        <div class="tab-pane active" id="seotags" role="tabpanel">
                            <div class="text-end mb-3">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSeoTagModal">
                                    <i class="mdi mdi-plus me-1"></i> Add SEO Tag
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead>
                                        <tr>
                                            <th>URL</th>
                                            <th>Meta Title</th>
                                            <th>Meta Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($seotags as $tag)
                                        <tr>
                                            <td>{{ $tag->url }}</td>
                                            <td>{{ $tag->meta_title }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($tag->meta_description, 50) }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info editSeoTag" data-id="{{ $tag->id }}" data-data="{{ json_encode($tag) }}">Edit</button>
                                                <button class="btn btn-sm btn-danger deleteSeoTag d-none" data-id="{{ $tag->id }}">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- METATAGS TAB -->
                        <div class="tab-pane" id="metatags" role="tabpanel">
                            <div class="text-end mb-3">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMetaTagModal">
                                    <i class="mdi mdi-plus me-1"></i> Add General Meta
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Alt Tag</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($metatags as $meta)
                                        <tr>
                                            <td>
                                                @if($meta->image)
                                                <img src="{{ asset('uploads/seo/'.$meta->image) }}" width="50" height="50" style="object-fit: cover;">
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                            <td>{{ $meta->title }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($meta->description, 50) }}</td>
                                            <td>{{ $meta->alttag }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info editMetaTag" data-id="{{ $meta->id }}" data-data="{{ json_encode($meta) }}">Edit</button>
                                                <button class="btn btn-sm btn-danger deleteMetaTag d-none" data-id="{{ $meta->id }}">Delete</button>
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
        </div>
    </div>

    <!-- MODALS -->
    <!-- Add Seo Tag Modal -->
    <div class="modal fade" id="addSeoTagModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add URL Specific SEO Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addSeoTagForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">URL (e.g., /shop, /contact)</label>
                            <input type="text" name="url" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Meta Keyword</label>
                                <input type="text" name="meta_keyword" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3"></textarea>
                        </div>
                        <hr>
                        <h6 style="display: none;">Open Graph (Social)</h6>
                        <div class="row" style="display: none;">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">OG Title</label>
                                <input type="text" name="og_title" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">OG Image URL</label>
                                <input type="text" name="og_image" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3" style="display: none;">
                            <label class="form-label">OG Description</label>
                            <textarea name="og_description" class="form-control" rows="2"></textarea>
                        </div>
                        <hr>
                        <div class="mb-3" style="display: none;">
                            <label class="form-label">Schema Markup (JSON-LD)</label>
                            <textarea name="schema_code" class="form-control" rows="5" placeholder='<script type="application/ld+json">...</script>'></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save SEO Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Seo Tag Modal -->
    <div class="modal fade" id="editSeoTagModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit URL Specific SEO Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editSeoTagForm">
                    <input type="hidden" id="edit_seotag_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">URL (e.g., /shop, /contact)</label>
                            <input type="text" name="url" id="edit_url" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Meta Title</label>
                                <input type="text" name="meta_title" id="edit_meta_title" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Meta Keyword</label>
                                <input type="text" name="meta_keyword" id="edit_meta_keyword" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" id="edit_meta_description" class="form-control" rows="3"></textarea>
                        </div>
                        <hr>
                        <h6 style="display: none;">Open Graph (Social)</h6>
                        <div class="row" style="display: none;">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">OG Title</label>
                                <input type="text" name="og_title" id="edit_og_title" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">OG Image URL</label>
                                <input type="text" name="og_image" id="edit_og_image" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3" style="display: none;">
                            <label class="form-label">OG Description</label>
                            <textarea name="og_description" id="edit_og_description" class="form-control" rows="2"></textarea>
                        </div>
                        <hr>
                        <div class="mb-3" style="display: none;">
                            <label class="form-label">Schema Markup (JSON-LD)</label>
                            <textarea name="schema_code" id="edit_schema_code" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update SEO Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Meta Tag Modal -->
    <div class="modal fade" id="addMetaTagModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add General Meta Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addMetaTagForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keyword</label>
                            <input type="text" name="keyword" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alt Tag (for image)</label>
                            <input type="text" name="alttag" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Meta Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Meta Tag Modal -->
    <div class="modal fade" id="editMetaTagModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit General Meta Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editMetaTagForm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_metatag_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" id="edit_m_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keyword</label>
                            <input type="text" name="keyword" id="edit_m_keyword" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="edit_m_description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alt Tag (for image)</label>
                            <input type="text" name="alttag" id="edit_m_alttag" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Change Meta Image</label>
                            <input type="file" name="image" class="form-control">
                            <div id="m_image_preview" class="mt-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update Meta Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // --- SEO TAGS ---
            $('#addSeoTagForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('seo-hub.seotags.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(res) {
                        Swal.fire('Success', res.message, 'success').then(() => location.reload());
                    }
                });
            });

            $('.editSeoTag').click(function() {
                let data = $(this).data('data');
                $('#edit_seotag_id').val(data.id);
                $('#edit_url').val(data.url);
                $('#edit_meta_title').val(data.meta_title);
                $('#edit_meta_keyword').val(data.meta_keyword);
                $('#edit_meta_description').val(data.meta_description);
                $('#edit_og_title').val(data.og_title);
                $('#edit_og_image').val(data.og_image);
                $('#edit_og_description').val(data.og_description);
                $('#edit_schema_code').val(data.schema_code);
                $('#editSeoTagModal').modal('show');
            });

            $('#editSeoTagForm').submit(function(e) {
                e.preventDefault();
                let id = $('#edit_seotag_id').val();
                $.ajax({
                    url: "/seo-hub/seotags/" + id,
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(res) {
                        Swal.fire('Updated', res.message, 'success').then(() => location.reload());
                    }
                });
            });

            $('.deleteSeoTag').click(function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/seo-hub/seotags/delete/" + id,
                            method: 'POST',
                            success: function(res) {
                                Swal.fire('Deleted!', res.message, 'success').then(() => location.reload());
                            }
                        });
                    }
                });
            });

            // --- META TAGS ---
            $('#addMetaTagForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('seo-hub.metatags.store') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        Swal.fire('Success', res.message, 'success').then(() => location.reload());
                    }
                });
            });

            $('.editMetaTag').click(function() {
                let data = $(this).data('data');
                $('#edit_metatag_id').val(data.id);
                $('#edit_m_title').val(data.title);
                $('#edit_m_keyword').val(data.keyword);
                $('#edit_m_description').val(data.description);
                $('#edit_m_alttag').val(data.alttag);
                if(data.image) {
                    $('#m_image_preview').html(`<img src="/uploads/seo/${data.image}" width="100">`);
                }
                $('#editMetaTagModal').modal('show');
            });

            $('#editMetaTagForm').submit(function(e) {
                e.preventDefault();
                let id = $('#edit_metatag_id').val();
                let formData = new FormData(this);
                $.ajax({
                    url: "/seo-hub/metatags/" + id,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        Swal.fire('Updated', res.message, 'success').then(() => location.reload());
                    }
                });
            });

            $('.deleteMetaTag').click(function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/seo-hub/metatags/delete/" + id,
                            method: 'POST',
                            success: function(res) {
                                Swal.fire('Deleted!', res.message, 'success').then(() => location.reload());
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
