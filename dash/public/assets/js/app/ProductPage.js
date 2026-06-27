const addValidator = new JustValidate("#addProductForm", {
    validateBeforeSubmitting: true,
});
const editValidator = new JustValidate("#editProductForm", {
    validateBeforeSubmitting: true,
});

// $("#add_product_image").on("change", function () {
//     const file = this.files[0];
//     if (file && file.type.startsWith("image/")) {
//         let img = new Image();
//         img.src = window.URL.createObjectURL(file);

//         img.decode().then(() => {
//             if (!(img.width === 600 && img.height === 600)) {
//                 console.log("hi");
//                 $(".product_remove_btn").trigger("click");
//                 addValidator.showErrors({
//                     "#add_product_image":
//                         "*Product Image resolution should be below 600 * 600",
//                 });
//             }
//         });
//     }
// });
$("#add_product_image").on("change", function () {
    const file = this.files[0];

    if (!file) return;

    // ✅ Check if the selected file is an image
    if (!file.type.match(/^image\/(jpeg|png|gif|bmp|webp)$/)) {
        this.value = ""; // clear the invalid file
        $(".product_remove_btn").trigger("click");
        addValidator.showErrors({
            "#add_product_image": "*Only image files (JPG, PNG, etc.) are allowed",
        });
        return;
    }

    // ✅ Check image dimensions
    if (file && file.type.startsWith("image/")) {
        let img = new Image();
        img.src = window.URL.createObjectURL(file);

        img.decode().then(() => {
            if (!(img.width === 450 && img.height === 600)) {
                console.log("hi");
                $(".product_remove_btn").trigger("click");
                addValidator.showErrors({
                    "#add_product_image":
                        "*Product Image resolution should be below 450 * 600",
                });
            }
        });
    }
});
$("#edit_product_image").on("change", function () {
    const file = this.files[0];

    imageValidationMap['edit_product_image_valid'] = false;

    if (!file) return;

    // ✅ Check if the selected file is an image
    if (!file.type.match(/^image\/(jpeg|png|gif|bmp|webp)$/)) {
        this.value = ""; // clear the invalid file
        $(".edit_product_remove_btn").trigger("click");
        editValidator.showErrors({
            "#edit_product_image": "*Only image files (JPG, PNG, etc.) are allowed",
        });
        return;
    }

    // ✅ Check image dimensions
    if (file && file.type.startsWith("image/")) {
        let img = new Image();
        img.src = window.URL.createObjectURL(file);

        img.decode().then(() => {
            if (!(img.width === 450 && img.height === 600)) {
                console.log("hi");
                $(".edit_product_remove_btn").trigger("click");
                editValidator.showErrors({
                    "#edit_product_image":
                        "*Product Image resolution must be exactly 450 * 600",
                });
            } else {
                imageValidationMap['edit_product_image_valid'] = true;
            }
        });
    }
});



$("#add_varient_image").on("change", function () {
    const file = this.files[0];

    imageValidationMap['variant_image_id'] = false;

    if (!file) return;

    // ✅ Check if the selected file is an image
    if (!file.type.match(/^image\/(jpeg|png|gif|bmp|webp)$/)) {
        this.value = ""; // clear the invalid file
        $(".product_remove_btn").trigger("click");
        addValidator.showErrors({
            "#add_varient_image": "*Only image files (JPG, PNG, etc.) are allowed",
        });
        return;
    }

    // ✅ Check image dimensions
    if (file && file.type.startsWith("image/")) {
        let img = new Image();
        img.src = window.URL.createObjectURL(file);

        img.decode().then(() => {
            if (!(img.width === 450 && img.height === 600)) {
                console.log("hi");
                $(".product_remove_btn").trigger("click");
                addValidator.showErrors({
                    "#add_varient_image":
                        "*Variant Image resolution must be exactly 450 * 600",
                });
            } else {
                imageValidationMap['variant_image_id'] = true;
            }
        });
    }
});

const imageValidationMap = {};

$(document).on("change", ".thumbim", function () {
    const fileInput = this;
    const file = fileInput.files[0];
    const fieldId = fileInput.name + "_" + Math.random().toString(36).substring(2, 9);

    // Assign unique data-id attribute for tracking
    $(fileInput).attr("data-image-id", fieldId);

    if (!file) {
        imageValidationMap[fieldId] = true; // optional, no file selected
        return;
    }

    // ✅ Only accept image files
    if (!file.type.match(/^image\/(jpeg|png|gif|bmp|webp)$/)) {
        imageValidationMap[fieldId] = false;
        fileInput.value = ""; // clear invalid file
        Swal.fire({
            icon: 'error',
            title: 'Invalid File Type',
            text: 'Only image files (JPG, PNG, GIF, BMP, WEBP) are allowed!',
        });
        return;
    }

    // ✅ Check image dimensions
    const img = new Image();
    img.src = URL.createObjectURL(file);

    img.onload = function () {
        if (img.width === 450 && img.height === 600) {
            imageValidationMap[fieldId] = true;
        } else {
            imageValidationMap[fieldId] = false;
            fileInput.value = ""; // clear invalid image
            Swal.fire({
                icon: 'error',
                title: 'Invalid Image Size',
                text: 'Only 450x600 px image is allowed!',
            });
        }
    };
});





addValidator
    .addField("#add_category_select", [
        {
            rule: "required",
            errorMessage: "*Category Field is required",
        },
    ])
    .addField("#prodgst", [
        {
            rule: "required",
            errorMessage: "*GST Field is required",
        },
    ])

    .addField("#add_product_name", [
        {
            rule: "required",
            errorMessage: "*Product Name Field is required",
        },
        {
            rule: "minLength",
            value: 3,
            errorMessage: "*Product Name should be at least 3 character long",
        },
        {
            rule: "maxLength",
            value: 50,
            errorMessage:
                "*Product Name should be at Maximum 50 character long",
        },
    ])
    .addField('.thumbim', [
        {
            validator: (value, fields) => {
                // Validate all present image fields
                for (let i = 0; i < fields.length; i++) {
                    const input = fields[i].elem;
                    const id = $(input).attr('data-image-id');
                    // If there's a file, it must be valid
                    if (input.files.length > 0 && imageValidationMap[id] !== true) {
                        return false;
                    }
                }
                return true;
            },
            errorMessage: '*Only 450x600 px image is allowed',
        }
    ])
    .addField('#add_varient_name', [
        {
            rule: 'minLength',
            value: 3,
            errorMessage: 'Variant name must be at least 3 characters',
        },
        {
            rule: 'maxLength',
            value: 20,
            errorMessage: 'Variant name must be less than 20 characters',
        }
    ])
    // .addField("#add_brand_name", [
    //     {
    //         rule: "required",
    //         errorMessage: "*Brand Name Field is required",
    //     },
    //     {
    //         rule: "minLength",
    //         value: 3,
    //         errorMessage: "*Brand Name should be at least 3 character long",
    //     },
    //     {
    //         rule: "maxLength",
    //         value: 50,
    //         errorMessage: "*Brand Name should be at Maximum 50 character long",
    //     },
    // ])
    // .addField("#add_material_name", [
    //     {
    //         rule: "required",
    //         errorMessage: "*Material Name Field is required",
    //     },
    //     {
    //         rule: "minLength",
    //         value: 3,
    //         errorMessage: "*Material Name should be at least 3 character long",
    //     },
    //     {
    //         rule: "maxLength",
    //         value: 70,
    //         errorMessage:
    //             "*material Name should be at Maximum 50 character long",
    //     },
    // ])
    // .addField("#add_product_type", [
    //     {
    //         rule: "required",
    //         errorMessage: "*Product Type Field is required",
    //     },
    //     {
    //         rule: "minLength",
    //         value: 3,
    //         errorMessage: "*Product Type should be at least 3 character long",
    //     },
    //     {
    //         rule: "maxLength",
    //         value: 70,
    //         errorMessage:
    //             "*Product Type should be at Maximum 50 character long",
    //     },
    // ])
    .addField("#add_product_quantity", [
        {
            rule: "required",
            errorMessage: "*Product Quantity Field is required",
        },
        {
            rule: "number",
            errorMessage: "*Product Quantity Field should be in number",
        },
        {
            rule: "minLength",
            value: 1,
            errorMessage:
                "*Product Quantity should be at least 1 character long",
        },
        {
            rule: "maxLength",
            value: 5,
            errorMessage:
                "*Product Quantity should be at Maximum 5 character long",
        },
    ])
    .addField("#product_mrp_price", [
        {
            rule: "required",
            errorMessage: "*Product MRP Field is required",
        },
        {
            rule: "number",
            errorMessage: "*Product Mrp Field should be in number",
        },
        {
            rule: "minLength",
            value: 1,
            errorMessage: "*Product Mrp should be at least 1 character long",
        },
        {
            rule: "maxLength",
            value: 5,
            errorMessage: "*Product Mrp should be at Maximum 5 character long",
        },
    ])
    .addField("#product_offer_price", [
        {
            rule: "required",
            errorMessage: "*Product Offer Price Field is required",
        },
        {
            rule: "number",
            errorMessage: "*Product Offer Price should be in number",
        },

        {
            rule: "minLength",
            value: 1,
            errorMessage:
                "*Product Offer Price should be at least 1 character long",
        },
        {
            rule: "maxLength",
            value: 5,
            errorMessage:
                "*Product Offer Price should be at Maximum 5 character long",
        },

        {
            validator: (value) => {
                const ava = $("#product_mrp_price").val();
                if (parseInt(value) <= parseInt(ava)) {
                    return true;
                } else {
                    return false;
                }
            },
            errorMessage: "Should not be above MRP Price",
        },
    ])
    // .addField("#add_product_description", [
    //     {
    //         rule: "minLength",
    //         value: 3,
    //         errorMessage:
    //             "*Product Ingredients should be at least 3 character long",
    //     },
    //     {
    //         rule: "maxLength",
    //         value: 500,
    //         errorMessage:
    //             "*Product Ingredients should be at Maximum 500 character long",
    //     },
    // ])
    .addField("#add_product_image", [
        {
            rule: "minFilesCount",
            value: 1,
            errorMessage: "*Product Image Upload Field is required",
        },
        {
            validator: (value, fields) => {
                const file = fields["#add_product_image"].elem.files[0];
                return !!(file && file.type.startsWith("image/"));
            },
            errorMessage: "*Product Image must be an image",
        },
    ])
    .addField("#add_varient_image", [
        {
            rule: "minFilesCount",
            value: 1,
            errorMessage: "*Variant Image Upload Field is required",
        },
        {
            validator: (value, fields) => {
                const file = fields["#add_varient_image"].elem.files[0];
                return !!(file && imageValidationMap['variant_image_id'] === true);
            },
            errorMessage: "*Variant Image resolution must be exactly 450 × 600",
        },
    ])
    .addField("#add_product_specification", [
        {
            rule: "minLength",
            value: 3,
            errorMessage:
                "*Product Description should be at least 3 character long",
        },
        {
            rule: "maxLength",
            value: 500,
            errorMessage:
                "*Product Description should be at Maximum 500 character long",
        },
    ])
    .addField("#add_product_value", [
        {
            rule: "required",
            errorMessage: "*Product Value Field is required",
        },
        {
            rule: "minLength",
            value: 1,
            errorMessage: "*Product value should be at least 3 character long",
        },
        {
            rule: "maxLength",
            value: 5,
            errorMessage:
                "*Product value should be at Maximum 3 character long",
        },
    ])
    .addField("#add_unit_select", [
        {
            rule: "required",
            errorMessage: "*Product Unit Field is required",
        },
    ])
    .addField("#add_pre_note", [
        {
            validator: () => {
                return $('#preorderCheckbox').is(':checked') ? $('#add_pre_note').val().trim().length > 0 : true;
            },
            errorMessage: "*Pre Order Note is required",
        },
    ])
    .onSuccess((event) => {
        $(".add_submit_btn").attr("disabled", "true");
        $(".add_submit_btn").html("Uploading.....");
        addProductFormSubmit(event);
    });

editValidator
    .addField("#edit_category_select", [
        {
            rule: "required",
            errorMessage: "*Category Field is required",
        },
    ])

    .addField("#edit_product_name", [
        {
            rule: "required",
            errorMessage: "*Product Name Field is required",
        },
        {
            rule: "minLength",
            value: 3,
            errorMessage:
                "*Product Name should be at least 3 character long",
        },
        {
            rule: "maxLength",
            value: 50,
            errorMessage:
                "*Product Name should be at Maximum 50 character long",
        },
    ])
    .addField("#edit_product_image", [
        {
            validator: (value, fields) => {
                const file = fields["#edit_product_image"].elem.files[0];
                if (!file) return true; // Optional field
                return !!(file && imageValidationMap['edit_product_image_valid'] === true);
            },
            errorMessage: "*Product Image resolution must be exactly 450 × 600",
        },
    ])
    // .addField("#edit_product_quantity", [
    //     {
    //         rule: "required",
    //         errorMessage: "*Product Quantity Field is required",
    //     },
    //     {
    //         rule: "number",
    //         errorMessage: "*Product Quantity Field should be in number",
    //     },
    // ])
    // .addField("#edit_product_mrp_price", [
    //     {
    //         rule: "required",
    //         errorMessage: "*Product MRP Field is required",
    //     },
    //     {
    //         rule: "number",
    //         errorMessage: "*Product Mrp Field should be in number",
    //     },
    // ])
    // .addField("#edit_product_regular_price", [
    //     {
    //         rule: "required",
    //         errorMessage: "*Product Regular Price Field is required",
    //     },
    //     {
    //         rule: "number",
    //         errorMessage: "*Product Regular Price should be in number",
    //     },
    // ])
    // .addField("#edit_product_description", [
    //     {
    //         rule: "minLength",
    //         value: 3,
    //         errorMessage:
    //             "*Product Ingredients should be at least 3 character long",
    //     },
    //     {
    //         rule: "maxLength",
    //         value: 500,
    //         errorMessage:
    //             "*Product Ingredients should be at Maximum 500 character long",
    //     },
    // ])

    .addField("#edit_product_specification", [
        {
            rule: "minLength",
            value: 3,
            errorMessage:
                "*Product Description should be at least 3 character long",
        },
        {
            rule: "maxLength",
            value: 500,
            errorMessage:
                "*Product Description should be at Maximum 500 character long",
        },
    ])
    // .addField("#edit_product_value", [
    //     {
    //         rule: "required",
    //         errorMessage: "*Product Value Field is required",
    //     },
    // ])
    // .addField("#edit_unit_select", [
    //     {
    //         rule: "required",
    //         errorMessage: "*Product Value Field is required",
    //     },
    // ])
    .onSuccess((event) => {
        $(".edit_submit_btn").attr("disabled", "true");
        $(".edit_submit_btn").html("Uploading.....");
        editProductFormSubmit(event);
    });

const gridNew = new gridjs.Grid({
    columns: [
        "S.NO",
        "Category",
        "Sub Category",
        // "Brand",
        "Product Name",
        "Product Image",
        // "Ingredients",
        "Description",
        {
            name: "Action",
            sort: false,
        },
    ],
    pagination: {
        limit: 10,
    },
    sort: !0,
    search: !0,
    data: products.map((product, index) => {
        return [
            index + 1,
            // product.category.category_name,
            product.cate_name,
            product.subcate_name,
            // product.brand ? product.brand.brand_name : '-',
            product.product_name,

            gridjs.html(
                `

                <img class="bannerImage_image_el gridImage" src="images/${product.product_image}"  alt ="categgory_image${index}"/>


            `
            ),
            // product.product_description || 'No Ingredients',
            product.product_specification || 'No Description',
            gridjs.html(
                `<div> <button data-bs-toggle="modal"
                data-productid ="${product.id}"
                data-categoryid = "${product.category_id}"
                data-brandid = "${product.brand_id}"
                data-slug = "${product.slug}"
                data-subcategoryid = "${product.subcategory_id}"
                data-productname="${product.product_name}"
                data-productquantity ="${product.product_quantity}"
                data-productregularprice="${product.product_regular_price}"
                data-productmrpprice="${product.product_mrp_price}"
                data-productdescription="${product.product_description}"
                data-productimage="${product.product_image}"
                data-productspecification="${product.product_specification}"
                data-productunit="${product.unit_value}"
                data-productvalue="${product.product_value}"
                data-bs-target="#editProductModal"  class="btn btn-secondary edit_btn ">Edit</button>
                <button class="btn btn-danger delete_btn" data-productid = ${product.id} >Delete</button> </div>`
            ),
        ];
    }),
    style: {
        table: {
            border: "1px solid #ccc",
        },
        th: {
            "background-color": "rgba(0, 0, 0, 0.1)",
            color: "#000",
            "border-bottom": "3px solid #ccc",
            "text-align": "center",
            "border-right": "0.5px solid #ccc",
        },
        td: {
            "text-align": "center",
            "border-right": "0.5px solid #ccc",
            "border-bottom": "0.5px solid #ccc",
        },
    },
});

gridNew.render(document.getElementById("table-gridjs"));

function gridjsReRender(products) {
    // if (gridNew) gridNew.config.plugin.remove("pagination");
    // if (gridNew) gridNew.config.plugin.remove("search");
    gridNew
        .updateConfig({
            data: products.map((product, index) => {
                return [
                    index + 1,
                    // product.category.category_name,
                    product.cate_name,
                    product.subcate_name,
                    // product.brand ? product.brand.brand_name : '-',
                    product.product_name,
                    gridjs.html(
                        `

                        <img class="bannerImage_image_el gridImage" src="images/${product.product_image}"  alt ="categgory_image${index}"/>


                    `
                    ),
                    // product.product_description || 'No Ingredients',
                    product.product_specification || 'No Description',
                    gridjs.html(
                        `<div> <button data-bs-toggle="modal"
                        data-productid ="${product.id}"
                        data-categoryid = "${product.category_id}"
                        data-brandid = "${product.brand_id}"
                        data-slug = "${product.slug}"
                        data-subcategoryid = "${product.subcategory_id}"
                        data-productname="${product.product_name}"
                        data-productquantity ="${product.product_quantity}"
                        data-productregularprice="${product.product_regular_price}"
                        data-productmrpprice="${product.product_mrp_price}"
                        data-productdescription="${product.product_description}"
                        data-productimage="${product.product_image}"
                        data-productspecification="${product.product_specification}"
                        data-productunit="${product.unit_value}"
                        data-productvalue="${product.product_value}"
                        data-bs-target="#editProductModal"  class="btn btn-secondary edit_btn ">Edit</button>
                        <button class="btn btn-danger delete_btn" data-productid =${product.id}>Delete</button> </div>`
                    ),
                ];
            }),
        })
        .forceRender();
}

function addProductFormSubmit(e) {
    const formdata = new FormData(e.target);
    $.ajax({
        url: "products",
        method: "POST",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            $(".add_submit_btn").removeAttr("disabled");
            $(".add_submit_btn").html("Submit");

            const updatedProducts = response.products;
            $("#addProductForm")[0].reset();
            $("#addProductModal").hide();
            $(".modal-backdrop").remove();
            document.body.style.overflowY = "scroll";

            console.log(updatedProducts);

            gridjsReRender(updatedProducts);
            Swal.fire("Added", "Records Added Successfully.", "success");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(".edit_submit_btn").removeAttr("disabled");
            $(".add_submit_btn").removeAttr("disabled");
            $(".edit_submit_btn").html("Update");
            $(".add_submit_btn").html("Submit");
            console.log(textStatus + ": " + errorThrown);

            Swal.fire(textStatus.toUpperCase(), errorThrown, "warning");
        },
    });
}

function editProductFormSubmit(e) {
    const formdata = new FormData(e.target);
    $.ajax({
        url: "updateProducts/" + $("#edit_product_id").val(),
        method: "POST",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            const updatedProduct = response.products;
            $("#editProductForm")[0].reset();
            $("#editProductModal").hide();
            $(".modal-backdrop").remove();
            $(".edit_product_remove_btn ").trigger("click");
            document.body.style.overflowY = "scroll";
            gridjsReRender(updatedProduct);
            $(".edit_submit_btn").removeAttr("disabled");
            $(".edit_submit_btn").html("Update");
            Swal.fire("Updated", "Records Updated  Successfully.", "success");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(".edit_submit_btn").removeAttr("disabled");
            $(".add_submit_btn").removeAttr("disabled");
            $(".edit_submit_btn").html("Update");
            $(".add_submit_btn").html("Submit");
            console.log(textStatus + ": " + errorThrown);

            Swal.fire(textStatus.toUpperCase(), errorThrown, "warning");
        },
    });
}

$(function () {
    $(".bx-show").hide();
    $(".icon").on("click", function () {
        const parentEl = $(this).closest(".input-group");
        var input = $(this).closest(".input-group").find("input");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
            $(parentEl).find(".bx-hide").hide();
            $(parentEl).find(".bx-show").show();
        } else {
            input.attr("type", "password");
            $(parentEl).find(".bx-show").hide();
            $(parentEl).find(".bx-hide").show();
        }
    });

    $(document).on("click", ".edit_btn", function () {
        const catId = $(this).attr("data-categoryid");
        const subCatId = $(this).attr("data-subcategoryid");
        const imagePath = $(this).attr("data-productimage");
        $(".edit_preview_image").attr("src", `images/${imagePath}`);
        $("#edit_product_id").val($(this).attr("data-productid"));
        $("#edit_category_select")
            .find(`option[value="${catId}"]`)
            .prop("selected", true);
        populateSubCategories($("#edit_subcategory_select"), catId, subCatId);
        $("#edit_product_name").val($(this).attr("data-productname"));
        $("#edit_product_slug").val($(this).attr("data-slug"));
        $("#edit_brand_select").val($(this).attr("data-brandid"));
        $("#edit_product_quantity").val($(this).attr("data-productquantity"));
        $("#edit_product_mrp_price").val($(this).attr("data-productmrpprice"));
        $("#edit_product_regular_price").val(
            $(this).attr("data-productregularprice")
        );
        $("#edit_product_description").val(
            $(this).attr("data-productdescription")
        );
        $("#edit_product_value").val($(this).attr("data-productvalue"));

        $("#edit_product_specification").val(
            $(this).attr("data-productspecification")
        );
        // Replace 3 with the value you want to select
        $("#edit_unit_select").val($(this).attr("data-productunit"));
    });
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
                url: "destroyProducts/" + id,
                method: "post",
                dataType: "json",
                success: function (response) {
                    const updatedProduct = response.products;
                    gridjsReRender(updatedProduct);
                    Swal.fire(
                        "Deleted!",
                        "Records Deleted Successfully.",
                        "success"
                    );
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $(".edit_submit_btn").removeAttr("disabled");
                    $(".add_submit_btn").removeAttr("disabled");
                    $(".edit_submit_btn").html("Update");
                    $(".add_submit_btn").html("Submit");
                    console.log(textStatus + ": " + errorThrown);

                    Swal.fire(textStatus.toUpperCase(), errorThrown, "warning");
                },
            });
        }
    });
});

// Wait for the document to be ready
$(function () {
    const backupHtml = $("#preview-container1").html();

    // Listen for changes to the input field
    $("#add_varient_image").on("change", function () {
        // Get the selected file
        var file = $(this)[0].files[0];

        // Check if the file is an image
        if (file.type.match("image.*")) {
            // Create a new FileReader object
            var reader = new FileReader();

            // Set up the FileReader to load the image
            reader.onload = function (e) {
                // Create a new image element
                var img = $("<img>").attr("src", e.target.result);

                // Create a remove button
                var removeBtn = $("<button>")
                    .addClass("btn btn-danger product_remove_btn mt-2")
                    .text("Remove");

                // Add the image and remove button to the preview container
                $("#preview-container1").empty().append(img).append(removeBtn);

                // Listen for clicks on the remove button
                removeBtn.on("click", function (e) {
                    e.preventDefault();

                    // Remove the image from the preview container
                    $("#preview-container1").html(backupHtml);
                    // Clear the input field
                    $("#add_varient_image").val("");
                });
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(file);
        }
    });
});

$(function () {
    const backupHtml = $("#preview-container").html();

    // Listen for changes to the input field
    $("#add_product_image").on("change", function () {
        // Get the selected file
        var file = $(this)[0].files[0];

        // Check if the file is an image
        if (file.type.match("image.*")) {
            // Create a new FileReader object
            var reader = new FileReader();

            // Set up the FileReader to load the image
            reader.onload = function (e) {
                // Create a new image element
                var img = $("<img>").attr("src", e.target.result);

                // Create a remove button
                var removeBtn = $("<button>")
                    .addClass("btn btn-danger product_remove_btn mt-2")
                    .text("Remove");

                // Add the image and remove button to the preview container
                $("#preview-container").empty().append(img).append(removeBtn);

                // Listen for clicks on the remove button
                removeBtn.on("click", function (e) {
                    e.preventDefault();

                    // Remove the image from the preview container
                    $("#preview-container").html(backupHtml);
                    // Clear the input field
                    $("#add_product_image").val("");
                });
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(file);
        }
    });
});

$(function () {
    const backupHtml = $(".edit_preview-container").html();

    // Listen for changes to the input field
    $("#edit_product_image").on("change", function () {
        // Get the selected file
        var file = $(this)[0].files[0];

        // Check if the file is an image
        if (file.type.match("image.*")) {
            // Create a new FileReader object
            var reader = new FileReader();

            // Set up the FileReader to load the image
            reader.onload = function (e) {
                // Create a new image element
                var img = $("<img>").attr("src", e.target.result);

                // Create a remove button
                var removeBtn = $("<button>")
                    .addClass("btn btn-danger edit_product_remove_btn mt-2")
                    .text("Remove");

                // Add the image and remove button to the preview container
                $(".edit_preview-container")
                    .empty()
                    .append(img)
                    .append(removeBtn);

                // Listen for clicks on the remove button
                removeBtn.on("click", function (e) {
                    e.preventDefault();
                    // Remove the image from the preview container
                    $(".edit_preview-container").html(backupHtml);
                    // Clear the input field
                    $("#edit_product_image").val("");
                });
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(file);
        }
    });
});

$(document).ready(function () {
    // Add input
    $("#add-input").click(function () {
        var inputGroup = `
        <hr>
        <br>
        <h5>Product Variant</h5>
        <div class="d-flex product_fields mt-3">
        <div class="row">
                                            <label for="add_varient_image-${$(".dynamic-inputs1").length + 1
            }" class="preview-container" id="preview-container-${$(".dynamic-inputs1").length + 1
            }" >
                                                        <div class="flex justify-content-center">
                                                            <div class="text-center">
                                                                <i
                                                                    class="display-4 col-12 text-muted mdi mdi-cloud-upload"></i>
                                                            </div>
                                                            <div>
                                                                <span class="col-12">Upload Image</span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="add_varient_image-${$(
                ".dynamic-inputs1"
            ).length + 1
            }">Variant
                                                                Image*(450 *
                                                                600)</label>
                                                            <input type="file"
                                                                class="form-control image_el dropzone needsclick"
                                                                id="add_varient_image-${$(
                ".dynamic-inputs1"
            ).length + 1
            }" placeholder="Variant Image"
                                                                accept="image/*" name="Varient_image[]" required data-var_button = "add_varient_image-${$(
                ".dynamic-inputs1"
            ).length + 1
            }" data-container ="preview-container-${$(".dynamic-inputs1").length + 1
            }">
                                                        </div>
                                                    </div>
                                                     <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label">Variant Name(Optional)</label>
                                                            <input type="text" class="form-control" name="varient_name[]" placeholder="Variant Name" required>
                                                        </div>
                                                    </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="add_product_sku">SKU (Auto-gen if empty)</label>
                    <input type="text" class="form-control" name="sku[]" placeholder="SKU-CODE">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="add_product_barcode">Barcode</label>
                    <input type="text" class="form-control" name="barcode[]" placeholder="Barcode / EAN">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="add_product_weight">Weight (kg)</label>
                    <input type="text" class="form-control" name="weight[]" placeholder="Weight in kg">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="add_unit_select">Product Unit*</label>
                    <select class="form-select" name="unit_id[]">
                        <option value="" selected>Select Units</option>
                        ${window.units ? window.units.map(u => `<option value="${u.id}">${u.unit_name} (${u.short_name})</option>`).join('') : `
                        <option value="1">Litre (l)</option>
                        <option value="2">Millilitre (ml)</option>
                        <option value="3">Gram (g)</option>
                        <option value="4">Kilogram (kg)</option>
                        <option value="5">Number (No's)</option>`}
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="add_product_quantity">Stock Quantity*</label>
                    <input type="text" class="form-control" id="add_product_quantity"
                        name="product_quantity[]" placeholder="Product Quantity" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="add_product_quantity">Variant Value*</label>
                    <input type="text" class="form-control" id="add_product_value"
                        name="product_value[]" placeholder="Product Value" required>
                </div>
            </div>


            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label" for="product_mrp_price">Product MRP Price(ORIGINAL
                        PRICE)*</label>
                    <input type="text" class="form-control" id="product_mrp_price"
                        name="product_mrp_price[]" placeholder="Product MRP price" required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label" for="product_offer_price">Product Selling Price(OFFER
                        PRICE)*</label>
                    <input type="text" class="form-control" id="product_offer_price"
                        name="product_offer_price[]" placeholder="Product Selling price" required>
                </div>
            </div>
            <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="product_low_stock">Low Stock *</label>
                                                            <input type="text" class="form-control"
                                                                id="product_low_stock" name="low_stock[]"
                                                                placeholder="Product low stock" required>
                                                        </div>
                                                    </div>
            <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label" for="">Product
                    GST</label>
                <select class="form-select" name="product_gst[]">
                    <option value="" selected>Select GST</option>
                    <option value="0">0 (GST Included)</option>
                    <option value="5">5</option>
                    <option value="12">12</option>
                    <option value="18">18</option>
                    <option value="28">28</option>
                </select>
            </div>
        </div>
        <div
                                                        class="col-md-3  d-flex justify-content-start align-items-center">
                                                        <div class="mb-3">

                                                            <input type="checkbox" name="hot_deals[]" class="hot_value"
                                                                value="0"> <label class="form-label">New Arrivals</label>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-3  d-flex justify-content-start align-items-center">
                                                        <div class="mb-3 mt-4">

                                                            <input type="checkbox" name="popular_prod[]" class="pop_prod"
                                                                value="0"> <label class="form-label">Best Seller</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3  d-flex justify-content-start align-items-center">
                                                        <div class="mb-3 mt-4">
                                                            <input type="checkbox" name="preorder[]" class="preorder"
                                                                value="1"> <label class="form-label">Pre Order</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3 mt-4">
                                                            <textarea class="form-control" name="pre_note[]" placeholder="Pre Order Note" maxlength="300"></textarea>
                                                        </div>
                                                    </div>
                                                    // <div class="col-md-3 d-flex justify-content-start align-items-center">
                                                    //     <div class="mb-3 mt-4">
                                                    //         <input type="checkbox" name="flash_sale[]" class="flash_sale_checkbox" value="1">
                                                    //         <label class="form-label">Flash Sale</label>
                                                    //     </div>
                                                    // </div>
                                                    // <div class="col-md-3 flash_sale_date_container" style="display: none;">
                                                    //     <div class="mb-3 mt-4">
                                                    //         <label class="form-label">Flash Sale End Date</label>
                                                    //         <input type="datetime-local" class="form-control flash_sale_date_input" name="flash_sale_date[]">
                                                    //     </div>
                                                    // </div>
         <div class="" style="">
                                                        <h5>Product Thump Images</h5>
                                                        <input type="hidden" name="product_image_count[]" id="product_image_count-${$(
                ".product_image_count"
            ).length + 1
            }" value="1" class="product_image_count">
                                                        <div class="col-lg-12">
                                                            <div id="dynamic-inputs1-${$(
                ".dynamic-inputs1"
            ).length + 1
            }" class="dynamic-inputs1">


                                                                <div class="d-flex product_fields1">
                                                                    <div class="row">
                                                                        <div class="col-lg-8">
                                                                            <div class="mb-3">
                                                                                <label class="form-label"
                                                                                    for="add_product_image">Product
                                                                                    Image*(450 *
                                                                                    600)</label>
                                                                                <input type="file"
                                                                                    class="form-control image_el dropzone needsclick"
                                                                                    id="add_product_image"
                                                                                    placeholder="Product Image"
                                                                                    name="product_image1[]" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-sm-12 mt-4">
                                                                            <div class="input-group-append">
                                                                                <button
                                                                                    class="btn btn-danger delete-input1"
                                                                                    type="button">Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 mt-3 mb-3">
                                                            <button id="add-input1" class="btn btn-success add-input2"
                                                                type="button" data-target="dynamic-inputs1-${$(
                ".dynamic-inputs1"
            ).length + 1
            }" data-input= "product_image_count-${$(".product_image_count").length + 1
            }">Add
                                                                Another Images</button>
                                                        </div>
                                                        <br>
                                                        <hr>
                                                    </div>

            <div class="col-lg-3 col-sm-12 mt-4">
                <div class="input-group-append">
                    <button class="btn btn-danger delete-input"
                        type="button">Delete Variant</button>
                </div>
            </div>
        </div>
    </div>`;
        $("#dynamic-inputs").append(inputGroup);
    });

    // Delete input
    $(document).on("click", ".delete-input", function () {
        $(this).closest(".product_fields").remove();
    });

    $(document).ready(function () {
        $(document).on("change", ".hot_value", function () {
            var isChecked = $(this).prop("checked");
            if (isChecked == true) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        });

        // ... Your existing code ...
    });

    $(document).ready(function () {
        $(document).on("change", ".pop_prod", function () {
            var isChecked = $(this).prop("checked");
            if (isChecked == true) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        });

        // ... Your existing code ...
    });
});

$(document).ready(function () {
    // Add input
    $(".add-input1").click(function () {
        var inputField = $(".product_image_count");
        var currentValue = parseInt(inputField.val());
        inputField.val(currentValue + 1);
        var inputGroup = `
        <div class="d-flex product_fields1">
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-3">
                    <label class="form-label" for="add_product_image">Product Image*450 *
                        600)</label>
                    <input type="file" class="form-control thumbim image_el dropzone needsclick"
                        id="add_thumbproduct_image" placeholder="Product Image" name="product_image1[]" required>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 mt-4">
                <div class="input-group-append">
                    <button class="btn btn-danger delete-input1"
                        type="button">Delete</button>
                </div>
            </div>
        </div>
    </div>`;
        $(".dynamic-inputs1").append(inputGroup);
    });

    // Delete input
    $(document).on("click", ".delete-input1", function () {
        $(this).closest(".product_fields1").remove();
    });
});

// =================== product varient ========================

$(document).ready(function () {
    // Add input
    $(".add-input2").click(function () {
        var inputField = $(".product_image_count2");
        var currentValue = parseInt(inputField.val());
        inputField.val(currentValue + 1);
        var inputGroup = `
        <div class="d-flex product_fields2">
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-3">
                    <label class="form-label" for="add_product_image">Product Image*450 *
                        600)</label>
                    <input type="file" class="form-control image_el dropzone needsclick"
                        id="add_product_image" placeholder="Product Image" name="product_image1[]" required>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 mt-4">
                <div class="input-group-append">
                    <button class="btn btn-danger delete-input2"
                        type="button">Delete</button>
                </div>
            </div>
        </div>
    </div>`;
        $(".dynamic-inputs2").append(inputGroup);
    });

    // Delete input
    $(document).on("click", ".delete-input2", function () {
        $(this).closest(".product_fields2").remove();
    });
});

// $(document).ready(function () {
//     let imageIndex = 0; // Initial index for image fields

//     $(".add-input1").click(function () {
//         var inputField = $(".product_image_count");
//         var currentValue = parseInt(inputField.val());
//         inputField.val(currentValue + 1);

//         var inputGroup = `
//             <div class="d-flex product_fields1">
//                 <div class="row">
//                     <div class="col-lg-8">
//                         <div class="mb-3">
//                             <label class="form-label" for="add_product_image">Product Image*(750 * 600)</label>
//                             <input type="file" class="form-control image_el dropzone needsclick"
//                                 id="add_product_image_${imageIndex}"
//                                 placeholder="Product Image"
//                                 name="product_image1[${imageIndex}]" required>
//                         </div>
//                     </div>
//                     <div class="col-lg-4 col-sm-12 mt-4">
//                         <div class="input-group-append">
//                             <button class="btn btn-danger delete-input1" type="button">Delete</button>
//                         </div>
//                     </div>
//                 </div>
//             </div>`;

//         $(".dynamic-inputs1").append(inputGroup);
//         imageIndex++; // Increment index for the next image field
//     });

//     // Delete input
//     $(document).on("click", ".delete-input1", function () {
//         $(this).closest(".product_fields1").remove();
//         imageIndex--; // Decrement index when deleting an image field
//     });
// });

// $(document).ready(function () {
//     let imageIndex = 0;
//     // Add input
//     $(document).on("click", ".add-input2", function () {
//         var inputId = $(this).data("input");
//         var inputField = $("#" + inputId);
//         var currentValue = parseInt(inputField.val());
//         inputField.val(currentValue + 1);
//         var targetId = $(this).data("target");
//         var inputGroup = `
//         <div class="d-flex product_fields1">
//         <div class="row">
//             <div class="col-lg-8">
//                 <div class="mb-3">
//                     <label class="form-label" for="add_product_image">Product Image*(750 *
//                         600)</label>
//                      <input type="file" class="form-control image_el dropzone needsclick"
//                                 id="add_product_image_${imageIndex}"
//                                 placeholder="Product Image"
//                                 name="product_image1[${imageIndex}]" required>
//                 </div>
//             </div>
//             <div class="col-lg-4 col-sm-12 mt-4">
//                 <div class="input-group-append">
//                     <button class="btn btn-danger delete-input1"
//                         type="button">Delete</button>
//                 </div>
//             </div>
//         </div>
//     </div>`;
//         $("#" + targetId).append(inputGroup);
//         imageIndex++;
//     });

//     // Delete input
//     $(document).on("click", ".delete-input1", function () {
//         $(this).closest(".product_fields1").remove();
//         imageIndex--;
//     });
// });
$(document).ready(function () {
    // Add input
    $(document).on("click", ".add-input2", function () {
        var inputId = $(this).data("input");
        var inputField = $("#" + inputId);
        var currentValue = parseInt(inputField.val());
        inputField.val(currentValue + 1);
        var targetId = $(this).data("target");
        var inputGroup = `
        <div class="d-flex product_fields1">
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-3">
                    <label class="form-label" for="add_product_image">Product Image*(450 *
                        600)</label>
                    <input type="file" class="form-control image_el dropzone needsclick"
                        id="add_product_image" placeholder="Product Image" name="product_image1[]" required>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 mt-4">
                <div class="input-group-append">
                    <button class="btn btn-danger delete-input1"
                        type="button">Delete</button>
                </div>
            </div>
        </div>
    </div>`;
        $("#" + targetId).append(inputGroup);
    });

    // Delete input
    $(document).on("click", ".delete-input1", function () {
        $(this).closest(".product_fields1").remove();
    });
});

//

$(document).ready(function () {
    $("body").on("change", "input[id^='add_varient_image-']", function () {
        var inputId = $(this).attr("id");
        var targetId = $(this).data("container");
        console.log("Input ID:", inputId);
        console.log("Target ID:", targetId);

        var file = $(this)[0].files[0];

        // Check if the file is an image
        if (file.type.match("image.*")) {
            // Create a new FileReader object
            var reader = new FileReader();

            // Set up the FileReader to load the image
            reader.onload = function (e) {
                // Create a new image element
                var img = $("<img>").attr("src", e.target.result);

                // Create a remove button
                var removeBtn = $("<button>")
                    .addClass("btn btn-danger product_remove_btn mt-2")
                    .text("Remove");

                // Add the image and remove button to the preview container
                // $("#" + targetId)
                //     .empty()
                //     .append(img)
                //     .append(removeBtn);
                $("#" + targetId)
                    .empty()
                    .append(img)
                    .append(removeBtn);

                // Listen for clicks on the remove button
                removeBtn.on("click", function (e) {
                    e.preventDefault();

                    // Remove the image from the preview container
                    $("#" + targetId).html("");
                    // Clear the input field
                    $("#" + inputId).val("");
                });
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(file);
        }
    });
});

const addValidator2 = new JustValidate("#productfilterForm", {
    validateBeforeSubmitting: true,
});

addValidator2
    .addField("#select_category_select", [
        {
            rule: "required",
            errorMessage: "*Category is required",
        },
    ])

    .onSuccess((event) => {
        $(".product_filter_btn").attr("disabled", "true");
        $(".product_filter_btn").html("Uploading.....");
        productfilterFormSubmit(event);
    });

function productfilterFormSubmit(event) {
    const formData = new FormData(event.target);
    $.ajax({
        url: "getproductfilter",
        method: "POST",
        dataType: "json",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $(".product_filter_btn").removeAttr("disabled");
            $(".product_filter_btn").html("Get Report");
            const updatedProduct = response.products;
            gridjsReRender(updatedProduct);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(".product_filter_btn").removeAttr("disabled");
            $(".product_filter_btn").html("Get Report");
            Swal.fire(textStatus.toUpperCase(), textStatus, "warning");
        },
    });
}

/*
$(document).on("change", "#add_category_select", function () {
    let id = $(this).val();

    $("#add_subcategory_select").empty();
    $("#add_subcategory_select").append(
        '<option value="" disabled selected>Processing...</option>'
    );

    $.ajax({
        type: "GET",
        url: "getsubcategory/" + id,
        success: function (response) {
            console.log(response);
            $("#add_subcategory_select").empty();
            $("#add_subcategory_select").append(
                '<option value="" disabled selected>Select Subcategory</option>'
            );
            response.forEach((element) => {
                $("#add_subcategory_select").append(
                    `<option value='${element["id"]}'>${element["subcategory_name"]}</option>`
                );
            });
        },
    });
});
*/

/*
$(document).on("change", "#edit_category_select", function () {
    let id = $(this).val();

    $("#edit_subcategory_select").empty();
    $("#edit_subcategory_select").append(
        '<option value="" disabled selected>Processing...</option>'
    );

    $.ajax({
        type: "GET",
        url: "getsubcategory/" + id,
        success: function (response) {
            console.log(response);
            $("#edit_subcategory_select").empty();
            $("#edit_subcategory_select").append(
                '<option value="" disabled selected>Select Subcategory</option>'
            );
            response.forEach((element) => {
                $("#edit_subcategory_select").append(
                    `<option value='${element["id"]}'>${element["subcategory_name"]}</option>`
                );
            });
        },
    });
});
*/

$(document).on("change", "#add_subcategory_select", function () {
    let id = $(this).val();
    var inputGroup1 = `
    <div value="" class="subcate_append_wrapper">
        <div>
            <input type="hidden" name="size_check" class="size_check" value=1>
        </div>
    </div>
    `;

    var inputGroup2 = `
    <div value="" class="subcate_append_wrapper">
        <div>
            <input type="hidden" name="size_check" class="foot_size_check" value=2>
        </div>
    </div>
    `;

    var inputGroup3 = `
    <div value="" class="subcate_append_wrapper">
        <div>
            <input type="checkbox" name="size_check" class="watch_size_check" value=3>
        </div>
    </div>
    `;

    // var inputGroup4 = `
    // <div value="" class="subcate_append_wrapper">
    //     <div>
    //         <input type="checkbox" name="size_check" class="bag_size_check" value=4>
    //     </div>
    // </div>
    // `;

    if (id === "16") {
        $(".subcate_size_append").empty();
        $(".subcate_size_append").append(inputGroup1);
    } else if (id === "17") {
        $(".subcate_size_append").empty();
        $(".subcate_size_append").append(inputGroup2);
    } else if (id === "18") {
        $(".subcate_size_append").empty();
        $(".subcate_size_append").append(inputGroup3);
    } else if (id === "19") {
        $(".subcate_size_append").empty();
        $(".subcate_size_append").append(inputGroup4);
    } else {
        $(".subcate_size_append").empty();
    }
});

// $(document).on("input", "#product_low_stock", function () {
//     var totStock = $("#add_product_quantity").val();
//     var lowStock = $("#product_low_stock").val();

//     if(lowStock>totStock){
//         alert("low stock must be below the total stock")
//         $("#product_low_stock").val("");
//     }

// });
$(document).on("input", "#product_low_stock", function () {
    var totStock = parseInt($("#add_product_quantity").val()) || 0;
    var lowStock = parseInt($(this).val()) || 0;

    if (lowStock >= totStock) {
        alert("Low stock must be less than the total stock.");
        $(this).val(""); // clear invalid input
    }
});



function populateSubCategories(select, categoryId, selectedId = null) {
    select.empty();
    select.append('<option value="" disabled selected>Loading...</option>');
    
    if (!categoryId) {
        select.append('<option value="" disabled selected>Select Sub Category</option>');
        return;
    }

    $.ajax({
        type: "GET",
        url: "getsubcategory/" + categoryId,
        success: function (response) {
            select.empty();
            select.append('<option value="" disabled selected>Select Sub Category</option>');
            response.forEach((element) => {
                const isSelected = selectedId && element.id == selectedId ? 'selected' : '';
                select.append(
                    `<option value='${element["id"]}' ${isSelected}>${element["subcategory_name"]}</option>`
                );
            });
        },
        error: function() {
            select.empty();
            select.append('<option value="" disabled selected>Error loading subcategories</option>');
        }
    });
}

$(document).ready(function () {
    $("#add_category_select").change(function () {
        populateSubCategories($("#add_subcategory_select"), $(this).val());
    });

    $("#edit_category_select").change(function () {
        populateSubCategories($("#edit_subcategory_select"), $(this).val());
    });

    $("#bulk_category_select").change(function () {
        populateSubCategories($("#bulk_subcategory_select"), $(this).val());
    });

    $("#bulkUploadForm").on("submit", function (e) {
        e.preventDefault();

        const form = this;
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        const formData = new FormData(form);
        const submitBtn = $(".bulk_upload_submit_btn");

        submitBtn.attr("disabled", true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Processing...');

        $.ajax({
            url: "bulkUploadProducts",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                submitBtn.attr("disabled", false).text("Start Bulk Upload");
                $("#bulkUploadModal").modal("hide");
                form.reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message || 'Products uploaded successfully!'
                });
                if (response.products) {
                    // Update global products variable if needed
                    window.products = response.products;
                    gridjsReRender(response.products);
                }
            },
            error: function (xhr) {
                submitBtn.attr("disabled", false).text("Start Bulk Upload");
                let errorMsg = 'An error occurred while uploading. Please check the Excel file and try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Upload Failed',
                    text: errorMsg
                });
            }
        });
    });
});
