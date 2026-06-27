const addValidator = new JustValidate("#addProductForm", {
    validateBeforeSubmitting: true,
});

const editValidator = new JustValidate("#editProductForm", {
    validateBeforeSubmitting: true,
});

addValidator
    .addField("#add_category_select", [{ rule: "required", errorMessage: "*Category selection is required" }])
    .addField("#add_product_name", [{ rule: "required", errorMessage: "*Product Name is required" }])
    .addField("#add_product_image", [{ rule: "minFilesCount", value: 1, errorMessage: "*Upload Image" }])
    .addField("#add_mrp_price", [{ rule: "required", errorMessage: "*Price is required" }, { rule: "number", errorMessage: "*Price must be a number" }])
    .addField("#add_offer_price", [{ rule: "required", errorMessage: "*Selling Price is required" }, { rule: "number", errorMessage: "*Selling Price must be a number" }])
    .addField("#add_stock_quantity", [{ rule: "required", errorMessage: "*Stock Quantity is required" }, { rule: "number", errorMessage: "*Stock Quantity must be a number" }])
    .addField("#add_low_stock", [{ rule: "required", errorMessage: "*Low Stock is required" }, { rule: "number", errorMessage: "*Low Stock must be a number" }])
    .onSuccess((event) => {
        $(".add_submit_btn").attr("disabled", true).html("Uploading...");
        addProductFormSubmit(event);
    });

editValidator
    .addField("#edit_category_select", [{ rule: "required", errorMessage: "*Category selection is required" }])
    .addField("#edit_product_name", [{ rule: "required", errorMessage: "*Product Name is required" }])
    .addField("#edit_mrp_price", [{ rule: "required", errorMessage: "*Price is required" }, { rule: "number", errorMessage: "*Price must be a number" }])
    .addField("#edit_offer_price", [{ rule: "required", errorMessage: "*Selling Price is required" }, { rule: "number", errorMessage: "*Selling Price must be a number" }])
    .addField("#edit_stock_quantity", [{ rule: "required", errorMessage: "*Stock Quantity is required" }, { rule: "number", errorMessage: "*Stock Quantity must be a number" }])
    .addField("#edit_low_stock", [{ rule: "required", errorMessage: "*Low Stock is required" }, { rule: "number", errorMessage: "*Low Stock must be a number" }])
    .onSuccess((event) => {
        $(".edit_submit_btn").attr("disabled", true).html("Updating...");
        editProductFormSubmit(event);
    });

const gridNew = new gridjs.Grid({
    columns: ["S.NO", "Category", "Sub Category", "Product Name", "Price", "Selling Price", "Stock", "Image", { name: "Action", sort: false }],
    pagination: { limit: 10 },
    sort: true,
    search: true,
    data: products.map((prod, index) => {
        return [
            index + 1,
            prod.cate_name,
            prod.subcate_name || 'N/A',
            prod.product_name,
            prod.product_mrp_price,
            prod.product_regular_price,
            prod.product_quantity || 0,
            gridjs.html(`<img src="/images/${prod.product_image}" style="width:50px; height:50px; object-fit:cover; border-radius:5px;"/>`),
            gridjs.html(`
                <div class="d-flex gap-2 justify-content-center">
                    <button data-bs-toggle="modal" 
                        data-productid="${prod.id}" 
                        data-categoryid="${prod.category_id}" 
                        data-subcategoryid="${prod.subcategory_id}" 
                        data-productname="${prod.product_name}" 
                        data-productdescription="${prod.product_description || ''}" 
                        data-mrpprice="${prod.product_mrp_price}"
                        data-offerprice="${prod.product_regular_price}"
                        data-stockquantity="${prod.product_quantity || 0}"
                        data-lowstock="${prod.low_stock || 5}"
                        data-productimage="${prod.product_image}" 
                        data-bs-target="#editProductModal" 
                        class="btn btn-secondary btn-sm edit_btn">Edit</button>
                    <button class="btn btn-danger btn-sm delete_btn" data-productid="${prod.id}">Delete</button>
                </div>
            `),
        ];
    }),
});

gridNew.render(document.getElementById("table-gridjs"));

function populateSubcategories(categoryId, targetSelectId, selectedSubcategoryId = null) {
    const targetSelect = $(`#${targetSelectId}`);
    targetSelect.empty().append('<option value="" disabled selected>Select SubCategory</option>');

    const filteredSubs = subcategories.filter(sub => sub.category_name == categoryId);

    filteredSubs.forEach(sub => {
        const selected = (selectedSubcategoryId && sub.id == selectedSubcategoryId) ? 'selected' : '';
        targetSelect.append(`<option value="${sub.id}" ${selected}>${sub.subcategory_name}</option>`);
    });
}

function addProductFormSubmit(e) {
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
            $("#addProductForm")[0].reset();
            $("#addProductModal").modal('hide');
            $(".modal-backdrop").remove();
            Swal.fire("Added", "Gift Product Added Successfully.", "success").then(() => {
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

function editProductFormSubmit(e) {
    const formdata = new FormData(e.target);
    $.ajax({
        url: giftUrls.update + "/" + $("#edit_product_id").val(),
        method: "POST",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            $(".edit_submit_btn").removeAttr("disabled").html("Update");
            $("#editProductForm")[0].reset();
            $("#editProductModal").modal('hide');
            $(".modal-backdrop").remove();
            Swal.fire("Updated", "Gift Product Updated Successfully.", "success").then(() => {
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
    // Add form category change
    $("#add_category_select").on("change", function () {
        populateSubcategories($(this).val(), "add_subcategory_select");
    });

    // Edit form category change
    $("#edit_category_select").on("change", function () {
        populateSubcategories($(this).val(), "edit_subcategory_select");
    });

    $(document).on("click", ".edit_btn", function () {
        const imagePath = $(this).attr("data-productimage");
        const productId = $(this).attr("data-productid");
        const categoryId = $(this).attr("data-categoryid");
        const subcategoryId = $(this).attr("data-subcategoryid");
        const productName = $(this).attr("data-productname");
        const productDesc = $(this).attr("data-productdescription");

        $("#edit_product_id").val(productId);
        $("#edit_category_select").val(categoryId);
        $("#edit_product_name").val(productName);
        $("#edit_product_description").val(productDesc);
        $("#edit_mrp_price").val($(this).attr("data-mrpprice"));
        $("#edit_offer_price").val($(this).attr("data-offerprice"));
        $("#edit_stock_quantity").val($(this).attr("data-stockquantity"));
        $("#edit_low_stock").val($(this).attr("data-lowstock"));
        $(".edit_preview_image").attr("src", `/images/${imagePath}`);

        // Populate subcategories and select the current one
        populateSubcategories(categoryId, "edit_subcategory_select", subcategoryId);
    });

    $(document).on("click", ".delete_btn", function () {
        const id = $(this).attr("data-productid");
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
    if ($("#add_product_image").length > 0 && $(".preview-container").length === 0) {
        $("#add_product_image").after('<div class="preview-container mt-2"></div>');
    }

    const backupHtml = $(".preview-container").html();
    $("#add_product_image").on("change", function () {
        var file = $(this)[0].files[0];
        if (file && file.type.match("image.*")) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $("<img>").attr("src", e.target.result).css({ "width": "100px", "height": "100px", "object-fit": "cover", "border-radius": "5px" });
                var removeBtn = $("<button>").addClass("btn btn-danger product_remove_btn mt-2 d-block").text("Remove");
                $(".preview-container").empty().append(img).append(removeBtn);
                removeBtn.on("click", function (e) {
                    e.preventDefault();
                    $(".preview-container").html(backupHtml);
                    $("#add_product_image").val("");
                });
            };
            reader.readAsDataURL(file);
        }
    });
});
