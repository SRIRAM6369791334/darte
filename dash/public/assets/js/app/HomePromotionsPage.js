// =============================
// VALIDATION INIT
// =============================
const addValidator = new JustValidate("#addPromotionForm", {
    validateBeforeSubmitting: true,
});

const editValidator = new JustValidate("#editPromotionForm", {
    validateBeforeSubmitting: true,
});

// =============================
// IMAGE SIZE CHECK
// =============================
function validateImage(file) {
    return new Promise((resolve) => {
        if (!file) return resolve(false);

        const img = new Image();
        img.onload = () => resolve(img.width === 480 && img.height === 600);
        img.onerror = () => resolve(false);
        img.src = URL.createObjectURL(file);
    });
}

// =============================
// ADD VALIDATION
// =============================
addValidator
.addField("#add_link_url", [
    { rule: "required", errorMessage: "*Link URL is required" }
])
.addField("#add_bg_image", [
    {
        rule: "minFilesCount",
        value: 1,
        errorMessage: "*Upload Image",
    },
    {
        validator: (value, fields) => () => {
            const file = fields["#add_bg_image"].elem.files[0];
            return validateImage(file);
        },
        errorMessage: "*Image must be 480x600"
    }
])
.onSuccess((event) => submitForm(event, "store"));


// =============================
// EDIT VALIDATION
// =============================
editValidator
.addField("#edit_link_url", [
    { rule: "required", errorMessage: "*Link URL is required" }
])
.addField("#edit_bg_image", [
    {
        validator: (value, fields) => () => {
            const file = fields["#edit_bg_image"].elem.files[0];
            if (!file) return Promise.resolve(true);
            return validateImage(file);
        },
        errorMessage: "*Image must be 480x600"
    }
])
.onSuccess((event) => submitForm(event, "update"));


// =============================
// GRIDJS
// =============================
const gridNew = new gridjs.Grid({
    columns: ["S.NO", "Image", "URL", "Action"],
    search: true,
    pagination: { limit: 10 },
    data: promotions.map((promo, index) => renderRow(promo, index))
});

gridNew.render(document.getElementById("table-gridjs"));

function renderRow(promo, index) {
    return [
        index + 1,
        gridjs.html(`
            <img src="/images/${promo.bg_image}" style="width:100px;border-radius:6px;">
        `),
        promo.link_url ?? "-",
        gridjs.html(`
            <button class="btn btn-secondary edit_btn"
                data-bs-toggle="modal"
                data-bs-target="#editPromotionModal"
                data-id="${promo.id}"
                data-link="${promo.link_url}"
                data-image="${promo.bg_image}">
                Edit
            </button>

            <button class="btn btn-danger delete_btn" data-id="${promo.id}">
                Delete
            </button>
        `)
    ];
}

function gridjsReRender(data) {
    gridNew.updateConfig({
        data: data.map((promo, index) => renderRow(promo, index))
    }).forceRender();
}


// =============================
// SUBMIT FORM
// =============================
function submitForm(e, type) {
    e.preventDefault();

    const formdata = new FormData(e.target);
    formdata.append('_token', window.csrfToken);

    const url = type === "store"
        ? "home-promotions"
        : "update-home-promotions/" + $("#edit_promotion_id").val();

    $.ajax({
        url: url,
        method: "POST",
        data: formdata,
        processData: false,
        contentType: false,

        success: function (res) {

            e.target.reset();

            bootstrap.Modal.getInstance(
                document.getElementById(
                    type === "store" ? "addPromotionModal" : "editPromotionModal"
                )
            )?.hide();

            gridjsReRender(res.promotions);

            Swal.fire({
                icon: "success",
                title: "Success",
                text: res.message,
                timer: 1500,
                showConfirmButton: false
            });
        },

        error: function (xhr) {
            Swal.fire("Error", xhr.responseJSON?.message || "Error", "error");
        }
    });
}


// =============================
// EDIT CLICK
// =============================
$(document).on("click", ".edit_btn", function () {

    $("#edit_promotion_id").val($(this).data("id"));
    $("#edit_link_url").val($(this).data("link"));

    $("#edit_preview_image")
        .attr("src", "/images/" + $(this).data("image"))
        .show();
});


// =============================
// DELETE
// =============================
$(document).on("click", ".delete_btn", function () {

    const id = $(this).data("id");

    Swal.fire({
        title: "Delete?",
        icon: "warning",
        showCancelButton: true
    }).then((res) => {

        if (res.isConfirmed) {
            $.post("destroy-home-promotions/" + id, {
                _token: window.csrfToken
            }, function (res) {

                gridjsReRender(res.promotions);

                Swal.fire("Deleted", "", "success");
            });
        }
    });
});


// =============================
// IMAGE PREVIEW (ADD)
// =============================
$("#add_bg_image").on("change", function () {

    const file = this.files[0];
    if (!file) return;

    validateImage(file).then(valid => {

        if (!valid) {
            this.value = "";

            // Swal.fire("Error", "Image must be 480x480", "error");

            addValidator.showErrors({
                "#add_bg_image": "*Image must be 480x600"
            });

            return;
        }

        const reader = new FileReader();
        reader.onload = e => {
            $(".preview-container").html(`
                <img src="${e.target.result}" style="max-width:100%">
            `);
        };
        reader.readAsDataURL(file);
    });
});


// =============================
// IMAGE PREVIEW (EDIT)
// =============================
$("#edit_bg_image").on("change", function () {

    const file = this.files[0];
    if (!file) return;

    validateImage(file).then(valid => {

        if (!valid) {
            this.value = "";

            // Swal.fire("Error", "Image must be 480x480", "error");

            editValidator.showErrors({
                "#edit_bg_image": "*Image must be 480x600"
            });

            return;
        }

        const reader = new FileReader();
        reader.onload = e => {
            $(".edit_preview-container").html(`
                <img src="${e.target.result}" style="max-width:100%">
            `);
        };
        reader.readAsDataURL(file);
    });
});
