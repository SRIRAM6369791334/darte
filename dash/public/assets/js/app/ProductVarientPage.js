const gridNew = new gridjs.Grid({
    columns: [
        "S.NO",
        "category",
        // "Subcategory",
        "Product Name",
        "Product MRP Price",
        "Product Offer Price",
        // "Product Gst",
        "Product Qty",

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
    data: productvarient.map((productvarient, index) => {
        return [
            index + 1,
            productvarient.category_name,
            // productvarient.subcatename,

            // gridjs.html(
            //     (!productvarient.value || productvarient.value === "null" || productvarient.value === "")
            //         ? `<span>${productvarient.product_name}</span><p>-</p>`
            //         : productvarient.unit_short_name
            //             ? `<span>${productvarient.product_name}</span><p>${productvarient.value} ${productvarient.unit_short_name}</p>`
            //             : (productvarient.unit_id == 1 || productvarient.varient == 1)
            //                 ? `<span>${productvarient.product_name}</span><p>${productvarient.value} l</p>`
            //                 : (productvarient.unit_id == 2 || productvarient.varient == 2)
            //                     ? `<span>${productvarient.product_name}</span><p>${productvarient.value} ml</p>`
            //                     : (productvarient.unit_id == 3 || productvarient.varient == 3)
            //                         ? `<span>${productvarient.product_name}</span><p>${productvarient.value} g</p>`
            //                         : (productvarient.unit_id == 4 || productvarient.varient == 4)
            //                             ? `<span>${productvarient.product_name}</span><p>${productvarient.value} kg</p>`
            //                             : `<span>${productvarient.product_name}</span><p>${productvarient.value} No's</p>`
            // ),
            gridjs.html((() => {
                let name = productvarient.product_name ?? '-';
                let value = productvarient.value;
                let unit = productvarient.unit_short_name;

                // If no value
                if (!value || value === "null" || value === "") {
                    return `<span>${name}</span><p>-</p>`;
                }

                // If size-based (S, M, L, XL)
                const sizes = ['S', 'M', 'L', 'XL', 'XXL'];
                if (sizes.includes(value.toUpperCase())) {
                    return `<span>${name}</span><p>(${value})</p>`;
                }

                // If unit exists from DB
                if (unit) {
                    return `<span>${name}</span><p>${value} ${unit}</p>`;
                }

                // Fallback based on unit_id
                const unitMap = {
                    1: 'l',
                    2: 'ml',
                    3: 'g',
                    4: 'kg'
                };

                let finalUnit = unitMap[productvarient.unit_id] ?? "No's";

                return `<span>${name}</span><p>${value} ${finalUnit}</p>`;
            })()),

            productvarient.mrp_price,
            productvarient.offer_price,
            //     gridjs.html(
            //         productvarient.product_gst == 5
            //             ? `<p>5%</p>
            // `
            //             : productvarient.product_gst == 12
            //             ? `<p>12%</p>`
            //             : productvarient.product_gst == 18
            //             ? `<p>18%</p>`
            //             : productvarient.product_gst == 28
            //             ? `<p>28%</p>`
            //             : `<p>No GST</p>`
            //     ),

            productvarient.product_qty,
            gridjs.html(
                `<div> <button data-bs-toggle="modal"
                data-categoryid ="${productvarient.categoryid}"
                data-subcategoryid ="${productvarient.subcategoryid}"
                data-produid="${productvarient.product_id}"
                data-productverid ="${productvarient.id}"
                data-productname="${productvarient.product_name}"
                data-productunit ="${productvarient.varient}"
                data-productvarvalue="${productvarient.value}"
                data-productvarimrpprice="${productvarient.mrp_price}"
                data-productvarioffer="${productvarient.offer_price}"
                data-productvarqut="${productvarient.product_qty}"
                data-hotpro="${productvarient.hot_deals}"
                data-varientimage="${productvarient.varient_img}"
                data-bespro="${productvarient.Popular_products}"
                data-preord="${productvarient.pre_order}"
                data-prenote="${productvarient.pre_note}"
                data-flashsale="${productvarient.flash_sale}"
                data-flashsaledate="${productvarient.flash_sale_date}"
                data-productget="${productvarient.product_gst}"
                data-produlowsto="${productvarient.low_stock}"
                data-sku="${productvarient.sku || ''}"
                data-barcode="${productvarient.barcode || ''}"
                data-weight="${productvarient.weight || ''}"
                data-unitid="${productvarient.unit_id || productvarient.varient}"
                data-bs-target="#editProductModal"  class="btn btn-secondary edit_btn ">Edit</button> <button class="btn btn-danger mt-1 delete_btn" data-productverid = ${productvarient.id}>Delete</button> </div>`
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

function gridjsReRender(productvarient) {
    // if (gridNew) gridNew.config.plugin.remove("pagination");
    // if (gridNew) gridNew.config.plugin.remove("search");
    gridNew
        .updateConfig({
            data: productvarient.map((productvarient, index) => {
                return [
                    index + 1,
                    productvarient.category_name,
                    // productvarient.subcatename,

                    gridjs.html(
                        (!productvarient.value || productvarient.value === "null" || productvarient.value === "")
                            ? `<span>${productvarient.product_name}</span><p>-</p>`
                            : productvarient.unit_short_name
                                ? `<span>${productvarient.product_name}</span><p>${productvarient.value} ${productvarient.unit_short_name}</p>`
                                : (productvarient.unit_id == 1 || productvarient.varient == 1)
                                    ? `<span>${productvarient.product_name}</span><p>${productvarient.value} l</p>`
                                    : (productvarient.unit_id == 2 || productvarient.varient == 2)
                                        ? `<span>${productvarient.product_name}</span><p>${productvarient.value} ml</p>`
                                        : (productvarient.unit_id == 3 || productvarient.varient == 3)
                                            ? `<span>${productvarient.product_name}</span><p>${productvarient.value} g</p>`
                                            : (productvarient.unit_id == 4 || productvarient.varient == 4)
                                                ? `<span>${productvarient.product_name}</span><p>${productvarient.value} kg</p>`
                                                : `<span>${productvarient.product_name}</span><p>${productvarient.value} No's</p>`
                    ),

                    productvarient.mrp_price,
                    productvarient.offer_price,
                    // gridjs.html(
                    //     productvarient.product_gst == 0
                    //         ? `<p> No GST </p>`
                    //         : `<p>${productvarient.product_gst}%</p>`
                    // ),
                    //     gridjs.html(
                    //         productvarient.product_gst == 1
                    //             ? `<p>5%</p>
                    // `
                    //             : productvarient.product_gst == 2
                    //                 ? `<p>12%</p>`
                    //                 : productvarient.product_gst == 3
                    //                     ? `<p>18%</p>`

                    //                     :productvarient.product_gst == 4
                    //                     ?`<p>28%</p>`
                    //                     :`<p>No GST</p>`
                    //     ),


                    // data-produid ="${productvarient.categoryid}"
                    // data-subcategoryid ="${productvarient.subcategoryid}"
                    // data-categoryid ="${productvarient.product_id}"
                    productvarient.product_qty,
                    gridjs.html(
                        `<div> <button data-bs-toggle="modal"
                        data-categoryid ="${productvarient.categoryid}"
                        data-subcategoryid ="${productvarient.subcategoryid}"
                        data-produid="${productvarient.product_id}"
                        data-productverid ="${productvarient.id}"
                        data-productname="${productvarient.product_name}"
                        data-productunit ="${productvarient.varient}"
                        data-productvarvalue="${productvarient.value}"
                        data-productvarimrpprice="${productvarient.mrp_price}"
                        data-productvarioffer="${productvarient.offer_price}"
                        data-productvarqut="${productvarient.product_qty}"
                        data-hotpro="${productvarient.hot_deals}"
                        data-varientimage="${productvarient.varient_img}"
                        data-bespro="${productvarient.Popular_products}"
                        data-preord="${productvarient.pre_order}"
                        data-prenote="${productvarient.pre_note}"
                        data-flashsale="${productvarient.flash_sale}"
                        data-flashsaledate="${productvarient.flash_sale_date}"
                        data-productget="${productvarient.product_gst}"
                        data-produlowsto="${productvarient.low_stock}"
                        data-sku="${productvarient.sku || ''}"
                        data-barcode="${productvarient.barcode || ''}"
                        data-weight="${productvarient.weight || ''}"
                        data-unitid="${productvarient.unit_id || productvarient.varient}"
                        data-bs-target="#editProductModal"  class="btn btn-secondary edit_btn ">Edit</button> <button class="btn btn-danger mt-1 delete_btn" data-productverid = ${productvarient.id}>Delete</button> </div>`
                    ),
                ];
            }),
        })
        .forceRender();
}

const addValidator = new JustValidate("#editProductVarientForm", {
    validateBeforeSubmitting: true,
});
const addValidator1 = new JustValidate("#addProductvarientForm", {
    validateBeforeSubmitting: true,
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

$("#add_varient_image").on("change", function () {
    const file = this.files[0];

    imageValidationMap['add_varient_image_valid'] = false;

    if (!file) return;

    // ✅ Check if the selected file is an image
    if (!file.type.match(/^image\/(jpeg|png|gif|bmp|webp)$/)) {
        this.value = ""; // clear the invalid file
        $(".product_remove_btn").trigger("click");
        addValidator1.showErrors({
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
                addValidator1.showErrors({
                    "#add_varient_image":
                        "*Variant Image resolution must be exactly 450 * 600",
                });
            } else {
                imageValidationMap['add_varient_image_valid'] = true;
            }
        });
    }
});
$("#edit_varient_image").on("change", function () {
    const file = this.files[0];

    imageValidationMap['edit_varient_image_valid'] = false;

    if (!file) return;

    // ✅ Check if the selected file is an image
    if (!file.type.match(/^image\/(jpeg|png|gif|bmp|webp)$/)) {
        this.value = ""; // clear the invalid file
        $(".edit_product_remove_btn").trigger("click");
        addValidator.showErrors({
            "#edit_varient_image": "*Only image files (JPG, PNG, etc.) are allowed",
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
                addValidator.showErrors({
                    "#edit_varient_image":
                        "*Variant Image resolution must be exactly 450 * 600",
                });
            } else {
                imageValidationMap['edit_varient_image_valid'] = true;
            }
        });
    }
});

addValidator

    .addField("#edit_category_select", [
        {
            rule: "required",
            errorMessage: "*Category Field is required",
        },
    ])


    // .addField("#edit_subcategory_select", [
    //     {
    //         rule: "required",
    //         errorMessage: "*Sub Category Field is required",
    //     },
    // ])

    .addField("#edit_product_name", [
        {
            rule: "required",
            errorMessage: "*Product Field is required",
        },
    ])
    .addField("#edit_unit_select", [
        {
            rule: "required",
            errorMessage: "*Product Unit Field is required",
        },
    ])
    .addField("#edit_product_gst", [
        {
            rule: "required",
            errorMessage: "*GST Field is required",
        },
    ])
    .addField("#edit_varient_image", [
        {
            validator: (value, fields) => {
                const file = fields["#edit_varient_image"].elem.files[0];
                if (!file) return true; // Optional field
                return !!(file && imageValidationMap['edit_varient_image_valid'] === true);
            },
            errorMessage: "*Variant Image resolution must be exactly 450 × 600",
        },
    ])
    .addField("#edit_product_value", [
        {
            rule: "required",
            errorMessage: "*Product Value Field is required",
        },
        {
            rule: "minLength",
            value: 1,
            errorMessage: "*Product value should be at least 1 character long",
        },
        {
            rule: "maxLength",
            value: 10,
            errorMessage:
                "*Product value should be at Maximum 10 character long",
        },
    ])
    .addField("#edit_product_mrp_price", [
        {
            rule: "required",
            errorMessage: "*Product MRP Field is required",
        },
        {
            rule: "number",

            errorMessage: "*Product MRP should be numbers",
        },
        {
            rule: "minLength",
            value: 1,
            errorMessage: "*Product MRP should be at least 1 character long",
        },
        {
            rule: "maxLength",
            value: 5,
            errorMessage: "*Product MRP should be at Maximum 5 character long",
        },
    ])
    .addField("#edit_product_offer_price", [
        {
            rule: "required",
            errorMessage: "*Product Offer Field is required",
        },
        {
            rule: "number",

            errorMessage: "*Product Offer Price should be numbers",
        },
        {
            rule: "minLength",
            value: 1,
            errorMessage: "*Product MRP should be at least 1 character long",
        },
        {
            rule: "maxLength",
            value: 5,
            errorMessage: "*Product MRP should be at Maximum 5 character long",
        },
        {
            validator: (value) => {
                const ava = $("#edit_product_mrp_price").val();
                if (parseInt(value) <= parseInt(ava)) {
                    return true;
                } else {
                    return false;
                }
            },
            errorMessage: "Should not be above MRP Price",
        },
    ])
    .addField("#edit_product_quantity", [
        {
            rule: "required",
            errorMessage: "*Product Quantity Field is required",
        },
        {
            rule: "number",

            errorMessage: "*Product Quantity should be numbers",
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
    .addField("#edit_Low_Stock", [
        {
            rule: "required",
            errorMessage: "*Product low Stock Field is required",
        },
        {
            rule: "number",

            errorMessage: "*Product low Stock should be numbers",
        },
        {
            rule: "minLength",
            value: 1,
            errorMessage:
                "*Product low Stock should be at least 1 character long",
        },
        {
            rule: "maxLength",
            value: 5,
            errorMessage:
                "*Product low Stock should be at Maximum 5 character long",
        },
    ])
    .onSuccess((event) => {
        $(".editver_submit_btn").attr("disabled", "true");
        $(".editver_submit_btn").html("Uploading.....");
        editProductVarientFormSubmit(event);
    });

addValidator1

    .addField("#select_category_select", [
        {
            rule: "required",
            errorMessage: "*Category Field is required",
        },
    ])
    .addField("#produgst", [
        {
            rule: "required",
            errorMessage: "*GST Field is required",
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
                return !!(file && imageValidationMap['add_varient_image_valid'] === true);
            },
            errorMessage: "*Variant Image resolution must be exactly 450 × 600",
        },
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
    // .addField("#select_subcategory_select", [
    //     {
    //         rule: "required",
    //         errorMessage: "*Sub Category Field is required",
    //     },
    // ])
    .addField("#add_product_name", [
        {
            rule: "required",
            errorMessage: "*Product Field is required",
        },
    ])
    .addField("#add_unit_select", [
        {
            rule: "required",
            errorMessage: "*Product Unit Field is required",
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
            errorMessage: "*Product value should be at least 1 character long",
        },
        {
            rule: "maxLength",
            value: 10,
            errorMessage:
                "*Product value should be at Maximum 10 character long",
        },
    ])
    .addField("#add_product_mrp_price", [
        {
            rule: "required",
            errorMessage: "*Product MRP Field is required",
        },

        {
            rule: "number",

            errorMessage: "*Product MRP should be numbers",
        },
        {
            rule: "minLength",
            value: 1,
            errorMessage: "*Product MRP should be at least 1 character long",
        },
        {
            rule: "maxLength",
            value: 4,
            errorMessage: "*Product MRP should be at Maximum 4 character long",
        },
    ])
    .addField("#add_product_offer_price", [
        {
            rule: "required",
            errorMessage: "*Product Offer Field is required",
        },
        {
            rule: "number",

            errorMessage: "*Product Offer Price should be numbers",
        },
        {
            rule: "minLength",
            value: 1,
            errorMessage: "*Product MRP should be at least 1 character long",
        },
        {
            rule: "maxLength",
            value: 4,
            errorMessage: "*Product MRP should be at Maximum 4 character long",
        },
        {
            validator: (value) => {
                const ava = $("#add_product_mrp_price").val();
                if (parseInt(value) <= parseInt(ava)) {
                    return true;
                } else {
                    return false;
                }
            },
            errorMessage: "Should not be above MRP Price",
        },
    ])
    .addField("#add_product_quantity", [
        {
            rule: "required",
            errorMessage: "*Product Quantity Field is required",
        },
        {
            rule: "number",

            errorMessage: "*Product Quantity should be numbers",
        },
        {
            rule: "minLength",
            value: 1,
            errorMessage:
                "*Product Quantity should be at least 1 character long",
        },
        {
            rule: "maxLength",
            value: 4,
            errorMessage:
                "*Product Quantity should be at Maximum 4 character long",
        },
    ])
    .addField("#add_Low_Stock", [
        {
            rule: "required",
            errorMessage: "*Product Low Stock Field is required",
        },
        {
            rule: "number",

            errorMessage: "*Product Low Stock should be numbers",
        },
        {
            rule: "minLength",
            value: 1,
            errorMessage:
                "*Product Low Stock should be at least 1 character long",
        },
        {
            rule: "maxLength",
            value: 4,
            errorMessage:
                "*Product Low Stock should be at Maximum 4 character long",
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
        $(".addvari_submit_btn").attr("disabled", "true");
        $(".addvari_submit_btn").html("Uploading.....");
        addProductvarientFormSubmit(event);
    });


function populateSubCategories(select, categoryId, selectedId = null) {
    select.empty();
    select.append('<option value="" disabled selected>Select Sub Category</option>');
    if (window.subcategories && categoryId) {
        const filtered = window.subcategories.filter(item => item.category_name == categoryId);
        filtered.forEach(item => {
            const isSelected = selectedId && item.id == selectedId ? 'selected' : '';
            select.append(`<option value="${item.id}" ${isSelected}>${item.subcategory_name}</option>`);
        });
    }
}

$(document).on("click", ".edit_btn", function () {
    addValidator.clearErrors(); // Prevent premature validation errors when modal opens
    let catId = $(this).attr("data-categoryid");
    let subCatId = $(this).attr("data-subcategoryid");
    const ProId = $(this).attr("data-produid");
    const imagePath = $(this).attr("data-varientimage");

    if (subCatId === "null" || subCatId === "undefined" || subCatId === "" || subCatId === 0) {
        subCatId = null;
    }
    if (catId === "null" || catId === "undefined" || catId === "" || catId === 0) {
        catId = null;
    }

    // Populate SubCategory and set value
    populateSubCategories($("#edit_subcategory_select"), catId, subCatId);

    // Explicitly set value to be sure
    if (subCatId) {
        $("#edit_subcategory_select").val(subCatId);
    }

    // Set Category
    $("#edit_category_select").val(catId);

    // Load Products based on SubCategory (if present) or Category
    // Logic: If we have subcat, fetch products by subcat. If not, maybe by category?
    // Based on existing logic mapping, let's use the subcategory if available.

    const fetchId = subCatId ? subCatId : catId; // Fallback to catId if subCatId is missing? 
    // Wait, Getsubcategory returns products by subcategory_id. If keys match.
    // If I use Getsubcategory(subCatId) it works.

    // If subCatId is missing (old data), we might need to fetch by Category?
    // But Getsubcategory endpoint queries `subcategory_id`.
    // Let's assume subCatId is present or required.

    if (subCatId && subCatId !== "null" && subCatId !== "undefined") {
        $.ajax({
            type: "GET",
            url: "Getsubcategory/" + subCatId,
            success: function (response) {
                $("#edit_product_name").empty();
                $("#edit_product_name").append('<option value="" disabled selected>Select Product</option>');

                response.forEach((product) => {
                    $("#edit_product_name").append(
                        `<option value="${product.id}">${product.product_name}</option>`
                    );
                });

                // Now set the selected product value
                $("#edit_product_name").val(ProId);
            },
        });
    } else if (catId) {
        $.ajax({
            type: "GET",
            url: "Getproduct/" + catId,
            success: function (response) {
                $("#edit_product_name").empty();
                $("#edit_product_name").append('<option value="" disabled selected>Select Product</option>');

                response.forEach((product) => {
                    $("#edit_product_name").append(
                        `<option value="${product.id}">${product.product_name}</option>`
                    );
                });

                // Now set the selected product value
                $("#edit_product_name").val(ProId);
            },
        });
    }

    $("#edit_productvar_id").val($(this).attr("data-productverid"));

    $("#edit_product_value").val($(this).attr("data-productvarvalue"));
    $("#edit_product_mrp_price").val($(this).attr("data-productvarimrpprice"));
    $("#edit_product_offer_price").val($(this).attr("data-productvarioffer"));
    $("#edit_product_quantity").val($(this).attr("data-productvarqut"));
    $("#edit_unit_select").val($(this).attr("data-productunit"));
    $("#edit_product_gst").val($(this).attr("data-productget"));
    $("#edit_pre_note").val($(this).attr("data-prenote"));
    $("#edit_Low_Stock").val($(this).attr("data-produlowsto"));
    $("#edit_sku").val($(this).attr("data-sku"));
    $("#edit_barcode").val($(this).attr("data-barcode"));
    $("#edit_weight").val($(this).attr("data-weight"));
    $("#edit_unit_select").val($(this).attr("data-unitid"));
    $(".edit_preview_image").attr("src", `images/${imagePath}`);
    var hotProValue = $(this).attr("data-hotpro");
    var besProValue = $(this).attr("data-bespro");
    var preordValue = $(this).attr("data-preord");
    var flashSaleValue = $(this).attr("data-flashsale");
    var flashSaleDateValue = $(this).attr("data-flashsaledate");

    // Set the checkbox value
    $("#edit_hot_product").val(hotProValue);
    $("#edit_bes_product").val(besProValue);
    $("#edit_pre_product").val(preordValue);
    $("#edit_flash_product").val(flashSaleValue);

    // Check the checkbox if the value is '1', uncheck if '0'
    $("#edit_hot_product").prop("checked", hotProValue === "1");
    $("#edit_bes_product").prop("checked", besProValue === "1");
    $("#edit_pre_product").prop("checked", preordValue === "1");
    $("#edit_flash_product").prop("checked", flashSaleValue === "1");

    // Show/hide Preorder Note on load
    if (preordValue === "1") {
        $('#editpreorderNoteDiv').show();
    } else {
        $('#editpreorderNoteDiv').hide();
        $('#edit_pre_note').val("");
    }

    // Show/hide Flash Sale Date on load
    if (flashSaleValue === "1") {
        $('#editFlashSaleDateDiv').show();
        if (flashSaleDateValue && flashSaleDateValue !== "null") {
            $('#edit_flash_sale_date').val(flashSaleDateValue);
        }
    } else {
        $('#editFlashSaleDateDiv').hide();
        $('#edit_flash_sale_date').val("");
    }
});

// add function

function addProductvarientFormSubmit(e) {
    e.preventDefault();

    const quantity = parseInt($('#add_product_quantity').val());
    const lowStock = parseInt($('#add_Low_Stock').val());

    // ✅ Re-enable the submit button BEFORE validation check
    $(".addvari_submit_btn").removeAttr("disabled").html("Submit");

    if (!isNaN(quantity) && !isNaN(lowStock) && lowStock >= quantity) {
        Swal.fire({
            icon: 'warning',
            title: 'Invalid Stock Input',
            text: 'Low Stock must be less than Stock Quantity.',
        });
        return; // stop form submission
    }

    const formdata = new FormData(e.target);
    $(".addvari_submit_btn").attr("disabled", true).html("Submitting...");

    $.ajax({
        url: "addproductvarient",
        method: "POST",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            $(".addvari_submit_btn").removeAttr("disabled").html("Submit");

            const updatedProduct = response.productvarient;
            $("#addProductvarientForm")[0].reset();
            $("#addProductvariModal").hide();
            $(".modal-backdrop").remove();
            document.body.style.overflowY = "scroll";

            gridjsReRender(updatedProduct);
            Swal.fire("Added", "Records Added Successfully.", "success");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(".editver_submit_btn, .addvari_submit_btn").removeAttr("disabled").html("Submit");
            Swal.fire(textStatus.toUpperCase(), errorThrown, "warning");
        },
    });
}


function editProductVarientFormSubmit(e) {
    const formdata = new FormData(e.target);
    $.ajax({
        url: "updateProductsvarient/" + $("#edit_productvar_id").val(),
        method: "POST",
        dataType: "json",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            const updatedProduct = response.productvarient;
            $("#editProductVarientForm")[0].reset();

            $("#editProductModal").hide();
            $(".modal-backdrop").remove();
            $(".edit_product_remove_btn ").trigger("click");
            document.body.style.overflowY = "scroll";
            gridjsReRender(updatedProduct);
            $(".editver_submit_btn").removeAttr("disabled");
            $(".editver_submit_btn").html("Update");
            Swal.fire("Updated", "Records Updated  Successfully.", "success");
            // window.location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(".editver_submit_btn").removeAttr("disabled");
            $(".addvari_submit_btn").removeAttr("disabled");
            $(".editver_submit_btn").html("Update");
            $(".addvari_submit_btn").html("Submit");
            console.log(textStatus + ": " + errorThrown);
            Swal.fire(textStatus.toUpperCase(), errorThrown, "warning");
        },
    });
}

$(document).on("click", ".delete_btn", function () {
    const id = $(this).attr("data-productverid");
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
                url: "destroyvarient/" + id,
                method: "post",
                dataType: "json",
                success: function (response) {
                    const updatedBannerImages = response.productvarient;
                    gridjsReRender(updatedBannerImages);
                    Swal.fire(
                        "Deleted!",
                        "Records Deleted Successfully.",
                        "success"
                    );

                    // renderSort();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $(".editvar_submit_btn").removeAttr("disabled");
                    $(".addvar_submit_btn").removeAttr("disabled");
                    $(".editvar_submit_btn").html("Update");
                    $(".addvar_submit_btn").html("Submit");
                    console.log(textStatus + ": " + errorThrown);

                    Swal.fire(textStatus.toUpperCase(), errorThrown, "warning");
                },
            });
        }
    });
});

$(".hot_value").on("change", function () {
    // Get the current checked status
    var isChecked = $(this).prop("checked");

    // Set the value to 1 if checked, 0 if unchecked
    if (isChecked == true) {
        $(this).prop("value", 1);
    } else {
        $(this).prop("value", 0);
    }
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
                    <label class="form-label" for="add_product_image">Product Image*(450 *
                        600)</label>
                    <input type="file" class="form-control thumbim image_el needsclick"
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

//ADD AND EDIT PRODUCT APPEND

$("#sel_category_select").on("change", function () {
    var custid = $(this).val();

    // $('.produ1').hide();
    // $('.product2').show();

    $(".proname").empty();

    $(".proname").append(
        `<option value="0" disabled selected>Processing...</option>`
    );

    $.ajax({
        type: "GET",
        url: "Getproduct/" + custid,
        dataType: "JSON",
        success: function (response) {
            $(".proname").empty();
            $(".proname").append(
                `<option value="0" disabled selected>Select Product</option>`
            );

            response.forEach((element) => {
                $(".proname").append(
                    `<option value="${element["id"]}">${element["product_name"]}</option>`
                );
            });
        },
    });
});

// $('.product2').hide();
$("#select_subcategory_select").on("change", function () {
    var custid = $(this).val();

    // $('.produ1').hide();
    // $('.product2').show();

    // $(".proname").empty();

    $(".proname").append(
        `<option value="0" disabled selected>Processing...</option>`
    );

    $.ajax({
        type: "GET",
        url: "Getsubcategory/" + custid,
        dataType: "JSON",
        success: function (response) {
            $(".proname").empty();
            $(".proname").append(
                `<option value="0" disabled selected>Select Product</option>`
            );

            response.forEach((element) => {
                $(".proname").append(
                    `<option value="${element["id"]}">${element["product_name"]}</option>`
                );
            });
        },
    });
});

$("#edit_subcategory_select").on("change", function () {
    var custid = $(this).val();

    // $('.produ1').hide();
    // $('.product2').show();

    // $(".proname").empty();

    $("#edit_product_name").append(
        `<option value="0" disabled selected>Processing...</option>`
    );

    $.ajax({
        type: "GET",
        url: "Getsubcategory/" + custid,
        dataType: "JSON",
        success: function (response) {
            $("#edit_product_name").empty();
            $("#edit_product_name").append(
                `<option value="0" disabled selected>Select Product</option>`
            );

            response.forEach((element) => {
                $("#edit_product_name").append(
                    `<option value="${element["id"]}">${element["product_name"]}</option>`
                );
            });
        },
    });
});

//ADD AND EDIT SUBCATEGORY APPEND

// $(document).on("change", "#select_category_select", function () {
//     let id = $(this).val();

//     $("#select_subcategory_select").empty();
//     $(".proname").empty();
//     $("#select_subcategory_select").append(
//         '<option value="" disabled selected>Processing...</option>'
//     );

//     $.ajax({
//         type: "GET",
//         url: "getsubcategory/" + id,
//         success: function (response) {
//             console.log(response);
//             $("#select_subcategory_select").empty();
//             $("#select_subcategory_select").append(
//                 '<option value="" disabled selected>Select Subcategory</option>'
//             );
//             $(".proname").empty();
//             $(".proname").append(
//                 `<option value="0" disabled selected>Select Product</option>`
//             );
//             response.forEach((element) => {
//                 $("#select_subcategory_select").append(
//                     `<option value='${element["id"]}'>${element["subcategory_name"]}</option>`
//                 );
//             });
//         },
//     });
// });
$(document).on("change", "#select_category_select", function () {
    let id = $(this).val();
    populateSubCategories($("#select_subcategory_select"), id);

    // Fetch products based on category
    $(".proname").empty();
    $(".proname").append('<option value="0" disabled selected>Processing...</option>');

    $.ajax({
        type: "GET",
        url: "Getproduct/" + id,
        dataType: "JSON",
        success: function (response) {
            $(".proname").empty();
            $(".proname").append(
                `<option value="" disabled selected>Select Product</option>`
            );
            response.forEach((element) => {
                $(".proname").append(
                    `<option value="${element["id"]}">${element["product_name"]}</option>`
                );
            });
        },
    });
});


// $(document).on("change", "#edit_category_select", function () {
//     let id = $(this).val();

//     $("#edit_subcategory_select").empty();
//     $("#edit_product_name").empty();
//     $("#edit_subcategory_select").append(
//         '<option value="" disabled selected>Processing...</option>'
//     );

//     $.ajax({
//         type: "GET",
//         url: "getsubcategory/" + id,
//         success: function (response) {
//             console.log(response);
//             $("#edit_subcategory_select").empty();
//             $("#edit_subcategory_select").append(
//                 '<option value="" disabled selected>Select Subcategory</option>'
//             );
//             $("#edit_product_name").empty();
//             $("#edit_product_name").append(
//                 `<option value="0" disabled selected>Select Product</option>`
//             );
//             response.forEach((element) => {
//                 $("#edit_subcategory_select").append(
//                     `<option value='${element["id"]}'>${element["subcategory_name"]}</option>`
//                 );
//             });
//         },
//     });
// });
$(document).on("change", "#edit_category_select", function () {
    let id = $(this).val();
    populateSubCategories($("#edit_subcategory_select"), id);

    // Fetch products based on category
    $("#edit_product_name").empty();
    $("#edit_product_name").append('<option value="0" disabled selected>Processing...</option>');

    $.ajax({
        type: "GET",
        url: "Getproduct/" + id,
        dataType: "JSON",
        success: function (response) {
            $("#edit_product_name").empty();
            $("#edit_product_name").append(
                `<option value="" disabled selected>Select Product</option>`
            );
            response.forEach((element) => {
                $("#edit_product_name").append(
                    `<option value="${element["id"]}">${element["product_name"]}</option>`
                );
            });
        },
    });
});



const addValidator2 = new JustValidate("#productverfilterForm", {
    validateBeforeSubmitting: true,
});
addValidator2
    .addField("#sel_category_select", [
        {
            rule: "required",
            errorMessage: "*Category is required",
        },
    ])
    .addField("#select_product", [
        {
            rule: "required",
            errorMessage: "*Product is required",
        },
    ])

    .onSuccess((event) => {
        $(".productver_filter_btn").attr("disabled", "true");
        $(".productver_filter_btn").html("Uploading.....");
        productverfilterFormSubmit(event);
    });

function productverfilterFormSubmit(event) {
    const formData = new FormData(event.target);
    $.ajax({
        url: "getproductverfilter",
        method: "POST",
        dataType: "json",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $(".productver_filter_btn").removeAttr("disabled");
            $(".productver_filter_btn").html("Submit");
            const updatedProductvar = response.productvarient;
            gridjsReRender(updatedProductvar);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(".productver_filter_btn").removeAttr("disabled");
            $(".productver_filter_btn").html("Submit");
            Swal.fire(textStatus.toUpperCase(), textStatus, "warning");
        },
    });
}






// =================== product varient ========================


// $(document).ready(function () {
//     // Add input
//     $(".add-input2").click(function () {
//         var inputField = $(".product_image_count2");
//         var currentValue = parseInt(inputField.val());
//         inputField.val(currentValue + 1);
//         var inputGroup = `
//         <div class="d-flex product_fields2">
//         <div class="row">
//             <div class="col-lg-8">
//                 <div class="mb-3">
//                     <label class="form-label" for="add_product_image">Product Image*(750 *
//                         600)</label>
//                     <input type="file" class="form-control image_el  needsclick"
//                         id="add_product_image" placeholder="Product Image" name="product_image1[]" required>
//                 </div>
//             </div>
//             <div class="col-lg-4 col-sm-12 mt-4">
//                 <div class="input-group-append">
//                     <button class="btn btn-danger delete-input2"
//                         type="button">Delete</button>
//                 </div>
//             </div>
//         </div>
//     </div>`;
//         $(".dynamic-inputs2").append(inputGroup);
//     });

//     // Delete input
//     $(document).on("click", ".delete-input2", function () {
//         $(this).closest(".product_fields2").remove();
//     });
// });





$('#add-inputedit').click(function () {
    var inputGroup = `
    <div class="d-flex product_fieldsedit">
        <div class="row">
            <div class="col-lg-5">
                <div class="mb-3">
                    <label class="form-label">New Image (450x600)</label>
                    <input type="file" class="form-control image_el new-image-input needsclick" name="product_image1[]">
                </div>
            </div>
            <div class="col-lg-2 col-sm-12 mt-4">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger delete-inputdeit">Delete</button>
                </div>
            </div>
        </div>
    </div>`;
    $('#dynamic-inputsedit').append(inputGroup);
});

$(document).on('change', '.new-image-input', function () {
    const input = this;
    if (input.files && input.files[0]) {
        const img = new Image();
        img.onload = function () {
            if (this.width !== 450 || this.height !== 600) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Image Size',
                    text: 'Please upload an image of exactly 450 x 600 pixels.',
                });
                input.value = ''; // Clear the file input
            }
        };
        img.onerror = function () {
            Swal.fire({
                icon: 'error',
                title: 'Invalid File',
                text: 'Unable to load image for validation.',
            });
            input.value = '';
        };
        img.src = URL.createObjectURL(input.files[0]);
    }
});

$(document).ready(function () {
    function validateStockFields() {
        const qty = parseInt($('#edit_product_quantity').val());
        const lowStock = parseInt($('#edit_Low_Stock').val());

        if (!isNaN(qty) && !isNaN(lowStock)) {
            if (lowStock >= qty) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Low Stock Value',
                    text: 'Low Stock should be less than Stock Quantity.',
                });
                $('#edit_Low_Stock').val('').focus();
            }
        }
    }

    $('#edit_product_quantity, #edit_Low_Stock').on('blur', validateStockFields);
});


// Delete input
$(document).on('click', '.delete-inputdeit', function () {
    const id = $(this).data("varient-id"); // This will be undefined for new inputs
    const element = $(this).closest('.product_fieldsedit');

    if (id) {
        // Existing image deletion (backend)
        Swal.fire({
            title: "Are you sure?",
            text: "This image will be deleted permanently.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "destroyVarientThumpImages/" + id,
                    method: "post",
                    dataType: "json",
                    success: function (response) {
                        $("#thumb_existing_" + id).remove();
                        Swal.fire("Deleted!", "Image deleted successfully.", "success");
                    },
                    error: function () {
                        Swal.fire("Error", "Something went wrong.", "error");
                    }
                });
            }
        });
    } else {
        // Just remove the newly added input field
        element.remove();
    }
});






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
    const backupHtml = $(".edit_preview-container").html();

    // Listen for changes to the input field
    $("#edit_varient_image").on("change", function () {
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
                    $("#edit_varient_image").val("");
                });
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(file);
        }
    });
});





// thump image append
$(document).on('click', '.edit_btn', function () {
    var pro_ver_id = $(this).data('productverid');
    console.log({ pro_ver_id });
    $.ajax({
        url: "/getthump/" + pro_ver_id,
        method: "get",
        dataType: "json",
        success: function (response) {
            var htmlContent = "";

            // Loop for existing thumbnails (without file input)
            $.each(response, function (index, item) {
                htmlContent += `
        <div class="d-flex product_fieldsedit" id="thumb_existing_${item.id}">
            <div class="row">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label class="form-label">Existing Image</label>
                        <img src="/images/${item.product_child_image}" alt="thumb image" class="img-fluid" style="max-height: 100px;">
                    </div>
                </div>
                <div class="col-lg-2 col-sm-12 mt-4">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger delete-inputdeit" data-varient-id="${item.id}" id="delete-inputdeit${item.id}">Delete</button>
                    </div>
                </div>
            </div>
        </div>`;
            });

            $("#dynamic-inputsedit").html(htmlContent);
        },
    });

})