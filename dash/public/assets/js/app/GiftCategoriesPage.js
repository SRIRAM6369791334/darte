const addValidator = new JustValidate("#addCategoriesForm", {
    validateBeforeSubmitting: true,
});
const editValidator = new JustValidate("#editCategoriesForm", {
    validateBeforeSubmitting: true,
});

// Helper for image previews and validation
function setupImagePreviewAndValidation(inputId, containerSelector, backupHtml, requiredWidth, requiredHeight, maxSize) {
    $(inputId).on("change", function () {
        const fileInput = this;
        const file = fileInput.files[0];
        
        if (!file) return;

        // 1. Check File Size (10MB)
        if (file.size > maxSize) {
            Swal.fire({
                icon: "error",
                title: "File Too Large",
                text: "The image size exceeds 10MB. Please upload a smaller file.",
            });
            $(fileInput).val("");
            $(containerSelector).html(backupHtml);
            return;
        }

        if (file.type.startsWith("image/")) {
            const img = new Image();
            img.onload = () => {
                // 2. Check Dimensions (960x550)
                if (img.width !== requiredWidth || img.height !== requiredHeight) {
                    Swal.fire({
                        icon: "error",
                        title: "Invalid Image Size",
                        text: `Image must be exactly ${requiredWidth} x ${requiredHeight} pixels.`,
                    });
                    $(fileInput).val("");
                    $(containerSelector).html(backupHtml);
                } else {
                    // 3. Show Preview if valid
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const previewImg = $("<img>").attr("src", e.target.result).css({"max-width": "100px", "max-height": "100px", "object-fit": "cover"});
                        const removeBtn = $("<button>").addClass("btn btn-sm btn-danger mt-1 d-block mx-auto").text("Remove");
                        $(containerSelector).empty().append(previewImg).append(removeBtn);
                        removeBtn.on("click", function (e) {
                            e.preventDefault();
                            $(containerSelector).html(backupHtml);
                            $(inputId).val("");
                        });
                    };
                    reader.readAsDataURL(file);
                }
                window.URL.revokeObjectURL(img.src);
            };
            img.onerror = () => {
                Swal.fire({
                    icon: "error",
                    title: "Invalid Image",
                    text: "Could not load the image. Please upload a valid image file.",
                });
                $(fileInput).val("");
                $(containerSelector).html(backupHtml);
            };
            img.src = window.URL.createObjectURL(file);
        }
    });
}

addValidator
    .addField("#add_bannerTitle", [
        { rule: "required", errorMessage: "*Banner Title Field is required" },
        { rule: 'minLength', value: 3, errorMessage: '*Banner Title should be at least 3 character long' },
        { rule: 'maxLength', value: 50, errorMessage: '*Banner Title should be at Maximum 50 character long' },
    ])
    .addField("#add_bannerDescription", [
        { rule: "required", errorMessage: "*Banner Description Field is required" },
        { rule: 'minLength', value: 10, errorMessage: '*Banner Description should be at least 10 character long' },
    ])
    .addField("#add_categoryImage", [
        { rule: "minFilesCount", value: 1, errorMessage: "*Upload Category Image" },
    ])
    .onSuccess((event) => {
        $(".add_submit_btn").attr("disabled", true).html("Uploading...");
        addCategoriesFormSubmit(event);
    });

editValidator
    .addField("#edit_bannerTitle", [
        { rule: "required", errorMessage: "*Banner Title Field is required" },
        { rule: 'minLength', value: 3, errorMessage: '*Banner Title should be at least 3 character long' },
        { rule: 'maxLength', value: 50, errorMessage: '*Banner Title should be at Maximum 50 character long' },
    ])
    .addField("#edit_bannerDescription", [
        { rule: "required", errorMessage: "*Banner Description Field is required" },
        { rule: 'minLength', value: 10, errorMessage: '*Banner Description should be at least 10 character long' },
    ])
    .onSuccess((event) => {
        $(".edit_submit_btn").attr("disabled", true).html("Uploading...");
        editCategoriesFormSubmit(event);
    });

const gridNew = new gridjs.Grid({
    columns: [
        "S.NO",
        "Banner Title",
        "Category Image",
        { name: "Action", sort: false },
    ],
    pagination: { limit: 10 },
    sort: true,
    search: true,
    data: categories.map((cat, index) => {
        return [
            index + 1,
            cat.banner_title,
            gridjs.html(`<div class="text-center"><img class="category_image_el" src="/images/${cat.category_image}" alt="category_image${index}" style="width:50px"/></div>`),
            gridjs.html(`
                <div>
                    <button data-bs-toggle="modal" 
                        data-categoriesid="${cat.id}" 
                        data-categoriesname="${cat.category_name}" 
                        data-categoriesimage="${cat.category_image}" 
                        data-bannertitle="${cat.banner_title || ''}" 
                        data-bannerdescription="${cat.banner_description || ''}" 
                        data-bs-target="#editCategoriesModal" class="btn btn-secondary edit_btn ">Edit</button>
                    <button class="btn btn-danger delete_btn" data-categoriesid="${cat.id}">Delete</button>
                </div>
            `),
        ];
    }),
    style: {
        table: { border: "1px solid #ccc" },
        th: { "background-color": "rgba(0, 0, 0, 0.1)", color: "#000", "border-bottom": "3px solid #ccc", "text-align": "center", "border-right": "0.5px solid #ccc" },
        td: { "text-align": "center", "border-right": "0.5px solid #ccc", "border-bottom": "0.5px solid #ccc" },
    },
});

gridNew.render(document.getElementById("table-gridjs"));

function gridjsReRender(categories) {
    if (gridNew) gridNew.config.plugin.remove("pagination");
    if (gridNew) gridNew.config.plugin.remove("search");
    gridNew
        .updateConfig({
            data: categories.map((cat, index) => {
                return [
                    index + 1,
                    cat.banner_title,
                    gridjs.html(`<div class="text-center"><img class="category_image_el" src="/images/${cat.category_image}" alt="category_image${index}" style="width:50px"/></div>`),
                    gridjs.html(`
                        <div>
                            <button data-bs-toggle="modal" 
                                data-categoriesid="${cat.id}" 
                                data-categoriesname="${cat.category_name}" 
                                data-categoriesimage="${cat.category_image}" 
                                data-bannertitle="${cat.banner_title || ''}" 
                                data-bannerdescription="${cat.banner_description || ''}" 
                                data-bs-target="#editCategoriesModal" class="btn btn-secondary edit_btn ">Edit</button>
                            <button class="btn btn-danger delete_btn" data-categoriesid="${cat.id}">Delete</button>
                        </div>
                    `),
                ];
            }),
        })
        .forceRender();
}

function addCategoriesFormSubmit(e) {
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
            const updatedCategories = response.categories;
            $("#addCategoriesForm")[0].reset();
            $("#addCategoriesModal").modal('hide');
            $(".product_remove_btn").trigger("click");
            $(".modal-backdrop").remove();
            gridjsReRender(updatedCategories);
            Swal.fire("Added", "Records Added Successfully.", "success");
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

function editCategoriesFormSubmit(e) {
    const formdata = new FormData(e.target);
    $.ajax({
        url: giftUrls.update + "/" + $("#edit_categories_id").val(),
        method: "POST",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            const updatedCategories = response.categories;
            $("#editCategoriesForm")[0].reset();
            $("#editCategoriesModal").modal('hide');
            $(".modal-backdrop").remove();
            gridjsReRender(updatedCategories);
            $(".edit_submit_btn").removeAttr("disabled").html("Update");
            $(".edit_product_remove_btn").trigger("click");
            Swal.fire("Updated", "Records Updated Successfully.", "success");
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
        $("#edit_categories_id").val($(this).attr("data-categoriesid"));
        $("#edit_bannerTitle").val($(this).attr("data-bannertitle"));
        $("#edit_bannerDescription").val($(this).attr("data-bannerdescription"));
        
        $(".edit_preview_image").attr("src", `/images/${$(this).attr("data-categoriesimage")}`);
    });

    $(document).on("click", ".delete_btn", function () {
        const id = $(this).attr("data-categoriesid");
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
                        gridjsReRender(response.categories);
                        Swal.fire("Deleted!", "Records Deleted Successfully.", "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire(textStatus.toUpperCase(), errorThrown, "warning");
                    },
                });
            }
        });
    });

    // Add Modal Previews and Validation
    const backupHtml = $(".preview-container").html();
    setupImagePreviewAndValidation("#add_categoryImage", ".preview-container", backupHtml, 960, 550, 10485760);

    // Edit Modal Previews and Validation
    const editBackupHtml = $(".edit_preview-container").html();
    setupImagePreviewAndValidation("#edit_categoryImage", ".edit_preview-container", editBackupHtml, 960, 550, 10485760);
});
