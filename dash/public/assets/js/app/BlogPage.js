$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': window.csrfToken
        }
    });

    function showError(el, msg) {
        $(el).addClass('is-invalid');
        $(el).next('.error-text').remove();
        $(el).after(`<small class="text-danger error-text">${msg}</small>`);
    }

    function removeError(el) {
        $(el).removeClass('is-invalid');
        $(el).next('.error-text').remove();
    }

    /* ================= IMAGE VALIDATION ================= */

    function validateImage(file) {
        return new Promise((resolve) => {

            let allowed = ['image/jpeg', 'image/png', 'image/webp'];
            let maxSize = 2 * 1024 * 1024;

            if (!allowed.includes(file.type)) {
                resolve({ status: false, msg: 'Only JPG, PNG, WEBP allowed' });
                return;
            }

            if (file.size > maxSize) {
                resolve({ status: false, msg: 'Max 2MB allowed' });
                return;
            }

            let img = new Image();
            img.onload = function () {

                if (img.width !== 300 || img.height !== 300) {
                    resolve({ status: false, msg: 'Image must be exactly 300x300' });
                    return;
                }

                resolve({ status: true });
            };

            img.src = URL.createObjectURL(file);
        });
    }

    /* ================= IMAGE PREVIEW ================= */

    $('#add_blog_image').on('change', async function () {
        let file = this.files[0];
        if (!file) return;

        let res = await validateImage(file);

        if (!res.status) {
            showError(this, res.msg);
            this.value = '';
            $('#add_blog_preview').hide();
            return;
        }

        removeError(this);

        let reader = new FileReader();
        reader.onload = e => $('#add_blog_preview').attr('src', e.target.result).show();
        reader.readAsDataURL(file);
    });

    $('#edit_blog_image').on('change', async function () {
        let file = this.files[0];
        if (!file) return;

        let res = await validateImage(file);

        if (!res.status) {
            showError(this, res.msg);
            this.value = '';
            $('#edit_blog_preview').hide();
            return;
        }

        removeError(this);

        let reader = new FileReader();
        reader.onload = e => $('#edit_blog_preview').attr('src', e.target.result).show();
        reader.readAsDataURL(file);
    });

    /* ================= ADD ================= */

    $('#addBlogForm').submit(async function (e) {
        e.preventDefault();

        let title = $('#addBlogForm input[name="title"]');
        let date = $('#addBlogForm input[name="date"]');
        let desc = $('#addBlogForm textarea[name="description"]');
        let image = $('#add_blog_image');

        let description = desc.val().trim();

        let isValid = true;
        $('.error-text').remove();

        if (!title.val().trim()) {
            showError(title, 'Title required');
            isValid = false;
        }

        if (!date.val()) {
            showError(date, 'Date required');
            isValid = false;
        }

        if (description.length === 0) {
            showError(desc, 'Description required');
            isValid = false;
        }

        let file = image[0].files[0];

        if (!file) {
            showError(image, 'Image required');
            isValid = false;
        } else {
            let res = await validateImage(file);
            if (!res.status) {
                showError(image, res.msg);
                isValid = false;
            }
        }

        if (!isValid) return;

        let formData = new FormData(this);

        $.ajax({
            url: '/blog/store',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                Swal.fire('Success', 'Blog Added', 'success')
                    .then(() => location.reload());
            },
            error: function () {
                Swal.fire('Error', 'Failed to add blog', 'error');
            }
        });
    });

    /* ================= EDIT ================= */

    $(document).on('click', '.editBtn', function () {

        let d = $(this).data();

        $('#edit_blog_id').val(d.id);
        $('#edit_blog_title').val(d.title);
        $('#edit_blog_date').val(d.date);
        $('#edit_blog_desc').val(d.desc || '');

        // Meta SEO fields
        $('#edit_blog_meta_title').val(d.metaTitle || '');
        $('#edit_blog_meta_description').val(d.metaDescription || '');
        $('#edit_blog_meta_key').val(d.metaKey || '');

        $('#edit_blog_old_img').attr('src', window.assetPath + d.image);
        $('#edit_blog_preview').hide();

        $('.error-text').remove();
        $('.is-invalid').removeClass('is-invalid');
    });

    /* ================= UPDATE ================= */

    $('#editBlogForm').submit(async function (e) {
        e.preventDefault();

        let title = $('#edit_blog_title');
        let date = $('#edit_blog_date');
        let desc = $('#edit_blog_desc');
        let image = $('#edit_blog_image');

        let description = desc.val().trim();
        let isValid = true;

        $('.error-text').remove();

        if (!title.val().trim()) {
            showError(title, 'Title required');
            isValid = false;
        }

        if (!date.val()) {
            showError(date, 'Date required');
            isValid = false;
        }

        if (description.length === 0) {
            showError(desc, 'Description required');
            isValid = false;
        }

        let file = image[0].files[0];

        if (file) {
            let res = await validateImage(file);
            if (!res.status) {
                showError(image, res.msg);
                isValid = false;
            }
        }

        if (!isValid) return;

        let formData = new FormData();
        formData.append('id', $('#edit_blog_id').val());
        formData.append('title', title.val());
        formData.append('date', date.val());
        formData.append('description', description);
        formData.append('meta_title', $('#edit_blog_meta_title').val());
        formData.append('meta_description', $('#edit_blog_meta_description').val());
        formData.append('meta_key', $('#edit_blog_meta_key').val());

        if (file) formData.append('image', file);

        $.ajax({
            url: '/blog/update',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                Swal.fire('Updated', 'Blog Updated', 'success')
                    .then(() => location.reload());
            }
        });
    });

    /* ================= DELETE ================= */

    $(document).on('click', '.deleteBtn', function () {

        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true
        }).then((res) => {

            if (res.isConfirmed) {

                $.ajax({
                    url: '/blog/delete',
                    type: 'POST',
                    data: { id: id },
                    success: function () {
                        Swal.fire('Deleted', 'Blog removed', 'success')
                            .then(() => location.reload());
                    }
                });

            }
        });
    });

});
