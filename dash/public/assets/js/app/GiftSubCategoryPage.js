const addValidator = new JustValidate("#addSubCategoriesForm", {
    validateBeforeSubmitting: true,
});

const editValidator = new JustValidate("#editSubCategoriesForm", {
    validateBeforeSubmitting: true,
});

addValidator
    .addField("#add_categoryname", [{ rule: "required", errorMessage: "*Category selection is required" }])
    .addField("#add_subcategoriesname", [
        { rule: "required", errorMessage: "*Sub Category Name Field is required" },
        { rule: 'minLength', value: 3, errorMessage: '*Sub Category Name should be at least 3 character long' },
    ])
    .addField("#add_subcategoryImage", [
        { rule: "minFilesCount", value: 1, errorMessage: "*Upload Sub Category Image" }
    ])
    .onSuccess((event) => {
        $(".add_submit_btn").attr("disabled", true).html("Uploading...");
        addSubCategoriesFormSubmit(event);
    });

editValidator
    .addField("#edit_categoryname", [{ rule: "required", errorMessage: "*Category selection is required" }])
    .addField("#edit_subcategoriesname", [
        { rule: "required", errorMessage: "*Sub Category Name Field is required" },
        { rule: 'minLength', value: 3, errorMessage: '*Sub Category Name should be at least 3 character long' },
    ])
    .onSuccess((event) => {
        $(".edit_submit_btn").attr("disabled", true).html("Updating...");
        editSubCategoriesFormSubmit(event);
    });

const gridNew = new gridjs.Grid({
    columns: ["S.NO", "Category", "Sub Category", "Image", { name: "Action", sort: false }],
    pagination: { limit: 10 },
    sort: true,
    search: true,
    data: subcategories.map((sub, index) => {
        return [
            index + 1,
            sub.category_display,
            sub.subcategory_name,
            gridjs.html(`<img src="/images/${sub.subcategory_image}" style="width:50px; height:50px; object-fit:cover; border-radius:5px;"/>`),
            gridjs.html(`
                <div class="d-flex gap-2 justify-content-center">
                    <button data-bs-toggle="modal" 
                        data-subcategoriesid="${sub.id}" 
                        data-categoriesname="${sub.category_name}" 
                        data-subcategoriesname="${sub.subcategory_name}" 
                        data-subcategoriesimage="${sub.subcategory_image}" 
                        data-bs-target="#editSubCategoriesModal" 
                        class="btn btn-secondary btn-sm edit_btn">Edit</button>
                    <button class="btn btn-danger btn-sm delete_btn" data-subcategoriesid="${sub.id}">Delete</button>
                </div>
            `),
        ];
    }),
});

gridNew.render(document.getElementById("table-gridjs"));

function addSubCategoriesFormSubmit(e) {
    const formdata = new FormData(e.target);
    $.ajax({
        url: giftUrls.store,
        method: "POST",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            $(".add_submit_btn").removeAttr("disabled").html("Submit");
            $("#addSubCategoriesForm")[0].reset();
            $("#addSubCategoriesModal").modal('hide');
            $(".modal-backdrop").remove();
            Swal.fire("Added", "Gift Sub Category Added Successfully.", "success").then(() => {
                location.reload();
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(".add_submit_btn").removeAttr("disabled").html("Submit");
            let message = errorThrown;
            if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                message = Object.values(jqXHR.responseJSON.errors).flat().join("<br>");
            }
            Swal.fire({
                icon: "error",
                title: textStatus.toUpperCase(),
                html: message,
            });
        },
    });
}

function editSubCategoriesFormSubmit(e) {
    const formdata = new FormData(e.target);
    $.ajax({
        url: giftUrls.update + "/" + $("#edit_subcategories_id").val(),
        method: "POST",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            $(".edit_submit_btn").removeAttr("disabled").html("Update");
            $("#editSubCategoriesForm")[0].reset();
            $("#editSubCategoriesModal").modal('hide');
            $(".modal-backdrop").remove();
            Swal.fire("Updated", "Gift Sub Category Updated Successfully.", "success").then(() => {
                location.reload();
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(".edit_submit_btn").removeAttr("disabled").html("Update");
            let message = errorThrown;
            if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                message = Object.values(jqXHR.responseJSON.errors).flat().join("<br>");
            }
            Swal.fire({
                icon: "error",
                title: textStatus.toUpperCase(),
                html: message,
            });
        },
    });
}

$(function () {
    $(document).on("click", ".edit_btn", function () {
        const imagePath = $(this).attr("data-subcategoriesimage");
        $("#edit_subcategories_id").val($(this).attr("data-subcategoriesid"));
        $("#edit_categoryname").val($(this).attr("data-categoriesname"));
        $("#edit_subcategoriesname").val($(this).attr("data-subcategoriesname"));
        $(".edit_preview_image").attr("src", `/images/${imagePath}`);
    });

    $(document).on("click", ".delete_btn", function () {
        const id = $(this).attr("data-subcategoriesid");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: giftUrls.destroy + "/" + id,
                    method: "post",
                    dataType: "json",
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        Swal.fire("Deleted!", "Record Deleted Successfully.", "success").then(() => {
                            location.reload();
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire(textStatus.toUpperCase(), errorThrown, "warning");
                    },
                });
            }
        });
    });

    // Image Preview Logic
    const backupHtml = $(".preview-container").html();
    $("#add_subcategoryImage").on("change", function () {
        var file = $(this)[0].files[0];
        if (file && file.type.match("image.*")) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $("<img>").attr("src", e.target.result).css({ "width": "100px", "height": "100px", "object-fit": "cover", "border-radius": "5px" });
                var removeBtn = $("<button>").addClass("btn btn-danger product_remove_btn mt-2 d-block mx-auto").text("Remove");
                $(".preview-container").empty().append(img).append(removeBtn);
                removeBtn.on("click", function (e) {
                    e.preventDefault();
                    $(".preview-container").html(backupHtml);
                    $("#add_subcategoryImage").val("");
                });
            };
            reader.readAsDataURL(file);
        }
    });

    const editBackupHtml = $(".edit_preview-container").html();
    $("#edit_subcategoryImage").on("change", function () {
        var file = $(this)[0].files[0];
        if (file && file.type.match("image.*")) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $("<img>").attr("src", e.target.result).css({ "width": "100px", "height": "100px", "object-fit": "cover", "border-radius": "5px" });
                var removeBtn = $("<button>").addClass("btn btn-danger edit_product_remove_btn mt-2 d-block mx-auto").text("Remove");
                $(".edit_preview-container").empty().append(img).append(removeBtn);
                removeBtn.on("click", function (e) {
                    e.preventDefault();
                    $(".edit_preview-container").html(editBackupHtml);
                    $("#edit_subcategoryImage").val("");
                });
            };
            reader.readAsDataURL(file);
        }
    });
});
