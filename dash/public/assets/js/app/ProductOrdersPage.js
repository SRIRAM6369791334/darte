const gridNew = new gridjs.Grid({
    columns: [
        "S.No",
        "Order ID",
        "Ordered Date",
        ...(window.currentStatus === 'return' ? ["Returned Date"] : []),
        "Name",
        "Payment Status",
        "Delivery Status",
        {
            name: "Status",
            sort: false,
        },
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
    data: productOrders.map((productOrder, index) => {
        return [
            index + 1,
            // gridjs.html(
            //     `<a href="productOrders/${productOrder.order_id}">${productOrder.order_id} </a>`
            // ),
            productOrder.order_id_display,
            productOrder.date_ordered_on,
            ...(window.currentStatus === 'return' ? [productOrder.date_returned_on] : []),
            productOrder.order_address ? productOrder.order_address.firstname : (productOrder.billing_name || 'N/A'),
            // productOrder.order_address.address_line_one,
            productOrder.payment_status,
            // gridjs.html(
            //     productOrder.payment_status == 1
            //         ? `<div class="text-success" style="font-weight:bold">PAID</div>`
            //         : `<div class="text-warning" style="font-weight:bold">COD</div>`
            // ),
            productOrder.return_requests && productOrder.return_requests.length > 0
                ? gridjs.html(`<div class="text-danger" style="font-weight:bold">Return Requested</div>`)
                : gridjs.html(
                    productOrder.delivery_status == 0
                        ? `<div class="text-info" style="font-weight:bold">Confirmed</div>`
                        : productOrder.delivery_status == 1
                            ? `<div class="text-primary" style="font-weight:bold">Packing</div>`
                            : productOrder.delivery_status == 5
                                ? `<div class="text-secondary" style="font-weight:bold">Ready for Pickup</div>`
                            : productOrder.delivery_status == 2
                                ? `<div class="text-warning" style="font-weight:bold">Dispatched</div>`
                                : productOrder.delivery_status == 3
                                    ? `<div class="text-info" style="font-weight:bold">Out Of Delivery</div>`
                                    : productOrder.delivery_status == 6
                                        ? `<div class="text-danger" style="font-weight:bold">Returned</div>`
                                        : `<div class="text-success" style="font-weight:bold">Delivered</div>`
                ),


            window.currentStatus === 'new' ? gridjs.html(
                productOrder.delivery_status == 1
                    ? `<div> <button data-bs-toggle="modal"
                    data-milkOrderid ="${productOrder.id}",
                    data-ogmilkOrderid = "${productOrder.order_id_display}"
                    data-orderedDate="${productOrder.date_ordered_on}"

                    data-customername= "${productOrder.order_address ? productOrder.order_address.firstname : (productOrder.billing_name || 'N/A')}"
                    data-customerid= "${productOrder.customer ? productOrder.customer.user_id : 'N/A'}"
                    data-cusnum= "${productOrder.customer ? productOrder.customer.phone_number : (productOrder.billing_phone || 'N/A')}"


                data-bs-target="#assignToModal"  class="btn btn-secondary edit_btn">Changed</button>`
                    : `<div> <button data-bs-toggle="modal"
                    data-milkOrderid ="${productOrder.id}",
                    data-ogmilkOrderid = "${productOrder.order_id_display}"
                    data-orderedDate="${productOrder.date_ordered_on}"

                    data-customername= "${productOrder.order_address ? productOrder.order_address.firstname : (productOrder.billing_name || 'N/A')}"
                    data-customerid= "${productOrder.customer ? productOrder.customer.user_id : 'N/A'}"
                    data-cusnum= "${productOrder.customer ? productOrder.customer.phone_number : (productOrder.billing_phone || 'N/A')}"
                    data-deliverypersonid ="${productOrder.delivery_person_id}"
                data-bs-target="#assignToModal"  class="btn btn-warning edit_btn ">Status</button>`
            ) : gridjs.html(`<span class="text-muted small">Automated</span>`),
            gridjs.html(`
            <a href="viewProductdetail/${productOrder.order_id_display}" target="_blank">
            <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"  data-bs-target="#viewOrdersModal"><i class="bx bx-message-square-dots me-1"></i>

            View</button>
            </a>
            `),

            //     gridjs.html(
            //         productOrder.is_cancelled == 0

            //        ?`<p class="text-success">Not Cancelled</p>`
            //        : productOrder.is_cancelled == 2
            //        ?`<div> <button data-bs-toggle="modal"
            //        data-milkOrderid ="${productOrder.id}",
            //        data-ogmilkOrderid = "${productOrder.order_id}"
            //        data-orderedDate="${productOrder.date_ordered_on}"

            //        data-customername= "${productOrder.customer.name}"
            //        data-customerid= "${productOrder.customer.user_id}"
            //        data-refund = "${productOrder.cancel_reason}"

            //    data-bs-target="#RefundModal"  class="btn btn-info edit_btn1 ">Request</button>`
            //    :`<p class="text-danger">Product Cancel</p>`
            //     )
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

function gridjsReRender(productOrders) {
    if (gridNew) gridNew.config.plugin.remove("pagination");
    if (gridNew) gridNew.config.plugin.remove("search");
    gridNew
        .updateConfig({
            data: productOrders.map((productOrder, index) => {
                return [
                    index + 1,
                    // gridjs.html(
                    //     `<a href="productOrders/${productOrder.order_id}">${productOrder.order_id} </a>`
                    // ),
                    productOrder.order_id_display,
                    productOrder.date_ordered_on,
                    ...(window.currentStatus === 'return' ? [productOrder.date_returned_on] : []),
                    productOrder.order_address ? productOrder.order_address.firstname : (productOrder.billing_name || 'N/A'),
                    // productOrder.order_address.address_line_one,
                    productOrder.payment_status,
                    // gridjs.html(
                    //     productOrder.payment_status == 1
                    //         ? `<div class="text-success" style="font-weight:bold">PAID</div>`
                    //         : `<div class="text-warning" style="font-weight:bold">COD</div>`
                    // ),
                    productOrder.return_requests && productOrder.return_requests.length > 0
                        ? gridjs.html(`<div class="text-danger" style="font-weight:bold">Return Requested</div>`)
                        : gridjs.html(
                            productOrder.delivery_status == 0
                                ? `<div class="text-info" style="font-weight:bold">Confirmed</div>`
                                : productOrder.delivery_status == 1
                                    ? `<div class="text-primary" style="font-weight:bold">Packing</div>`
                                    : productOrder.delivery_status == 5
                                        ? `<div class="text-secondary" style="font-weight:bold">Ready for Pickup</div>`
                                    : productOrder.delivery_status == 2
                                        ? `<div class="text-warning" style="font-weight:bold">Dispatched</div>`
                                        : productOrder.delivery_status == 3
                                            ? `<div class="text-info" style="font-weight:bold">Out Of Delivery</div>`
                                            : productOrder.delivery_status == 6
                                                ? `<div class="text-danger" style="font-weight:bold">Returned</div>`
                                                : `<div class="text-success" style="font-weight:bold">Delivered</div>`
                        ),

                    window.currentStatus === 'new' ? gridjs.html(
                        productOrder.delivery_status == 1
                            ? `<div> <button data-bs-toggle="modal"
                            data-milkOrderid ="${productOrder.id}",
                            data-ogmilkOrderid = "${productOrder.order_id_display}"
                            data-orderedDate="${productOrder.date_ordered_on}"


                            data-customername= "${productOrder.order_address ? productOrder.order_address.firstname : (productOrder.billing_name || 'N/A')}"
                            data-customerid= "${productOrder.customer ? productOrder.customer.user_id : 'N/A'}"
                            data-cusnum= "${productOrder.customer ? productOrder.customer.phone_number : (productOrder.billing_phone || 'N/A')}"

                            data-deliverypersonid ="${productOrder.delivery_person_id}"
                        data-bs-target="#assignToModal"  class="btn btn-secondary edit_btn ">Change</button>`
                            : `<div> <button data-bs-toggle="modal"
                            data-milkOrderid ="${productOrder.id}",
                            data-ogmilkOrderid = "${productOrder.order_id_display}"
                            data-orderedDate="${productOrder.date_ordered_on}"

                            data-customername= "${productOrder.order_address ? productOrder.order_address.firstname : (productOrder.billing_name || 'N/A')}"
                            data-customerid= "${productOrder.customer ? productOrder.customer.user_id : 'N/A'}"
                            data-cusnum= "${productOrder.customer ? productOrder.customer.phone_number : (productOrder.billing_phone || 'N/A')}"
                            data-deliverypersonid ="${productOrder.delivery_person_id}"
                        data-bs-target="#assignToModal"  class="btn btn-warning edit_btn ">Assign</button>`
                    ) : gridjs.html(`<span class="text-muted small">Automated</span>`),
                    gridjs.html(`
                    <a href="viewProductdetail/${productOrder.order_id_display}" target="_blank">
                    <button type="button" class="btn btn-primary btn-sm text-truncate ms-2"  data-bs-target="#viewOrdersModal"><i class="bx bx-message-square-dots me-1"></i>

                    View</button>
                    </a>
                    `),

                    //      gridjs.html(
                    //         productOrder.is_cancelled == 0

                    //        ?`<p class="text-success">Not Cancelled</p>`
                    //        : productOrder.is_cancelled == 2
                    //        ?`<div> <button data-bs-toggle="modal"
                    //        data-milkOrderid ="${productOrder.id}",
                    //        data-ogmilkOrderid = "${productOrder.order_id}"
                    //        data-orderedDate="${productOrder.date_ordered_on}"

                    //        data-customername= "${productOrder.customer.name}"
                    //        data-customerid= "${productOrder.customer.user_id}"
                    //        data-refund = "${productOrder.cancel_reason}"

                    //    data-bs-target="#RefundModal"  class="btn btn-secondary edit_btn1 ">Request</button>`
                    //    :`<p class="text-danger">Product Cancel</p>`
                    //     )
                ];
            }),
        })
        .forceRender();
}

$(function () {
    $(document).on("click", ".edit_btn", function () {
        $("#customer_name_input").val($(this).attr("data-customername"));
        $("#order_id_input").val($(this).attr("data-ogmilkOrderid"));
        $("#cusid").val($(this).attr("data-customerid"));
        $("#cusnum").val($(this).attr("data-cusnum"));
    });

    $(document).on("click", ".edit_btn6", function () {
        $("#customer_name_input1").val($(this).attr("data-customername"));
        $("#order_id_input1").val($(this).attr("data-ogmilkOrderid"));
        $("#cusid6").val($(this).attr("data-customerid"));
        $("#cusnum").val($(this).attr("data-cusnum"));
    });
});

$(function () {
    $(document).on("click", ".edit_btn1", function () {
        $("#customer_name_input1").val($(this).attr("data-customername"));
        $("#order_id_input1").val($(this).attr("data-ogmilkOrderid"));
        $("#cusid1").val($(this).attr("data-customerid"));
        $("#customer_resons_input1").val($(this).attr("data-refund"));
    });
});

const assignDeliveryValidator = new JustValidate("#changestatus", {
    validateBeforeSubmitting: true,
});
const assignDeliveryValidator1 = new JustValidate("#changestatus1", {
    validateBeforeSubmitting: true,
});

assignDeliveryValidator
    .addField("#add_status_select", [
        {
            rule: "required",
            errorMessage: "*Status field is required",
        },
    ])
    .onSuccess((event) => {
        $(".add_submit_btn").attr("disabled", "true");
        changestatussubmit(event);
    });
assignDeliveryValidator1.onSuccess((event) => {
    $(".reson_submit_btn").attr("disabled", "true");
    changestatus1submit(event);
});

function changestatussubmit(event) {
    const formData = new FormData(event.target);
    $.ajax({
        type: "post",
        url: "updatestatus",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            const updatedProductOrders = response.productOrders;
            $("#changestatus")[0].reset();
            $("#assignToModal").modal('hide');
            $(".modal-backdrop").remove();
            $(".add_submit_btn").removeAttr("disabled");
            document.body.style.overflowY = "scroll";
            gridjsReRender(updatedProductOrders);
            Swal.fire("Success", "Status Change Successfully", "success").then(() => {
                window.location.reload();
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(".add_submit_btn").removeAttr("disabled");
            $(".add_submit_btn").html("Submit");
            Swal.fire(textStatus.toUpperCase(), errorThrown, "warning");
        },
    });
}

// product cancel

function changestatus1submit(event) {
    const formData = new FormData(event.target);
    $.ajax({
        type: "post",
        url: "updaterefund",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            const updatedProductOrders = response.productOrders;
            $("#changestatus1")[0].reset();
            $("#RefundModal").modal('hide');
            $(".modal-backdrop").remove();
            $(".reson_submit_btn").removeAttr("disabled");
            document.body.style.overflowY = "scroll";
            gridjsReRender(updatedProductOrders);
            Swal.fire("Success", "Status Change Successfully", "success").then(() => {
                window.location.reload();
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(".reson_submit_btn").removeAttr("disabled");
            $(".reson_submit_btn").html("Submit");
            Swal.fire(textStatus.toUpperCase(), errorThrown, "warning");
        },
    });
}



