function get_filter(class_name) {
    var filter = [];
    $("." + class_name + ":checked").each(function () {
        filter.push($(this).val());
    });

    return filter;
}

$(document).ready(function () {
    $("#getPrice").change(function () {
        var size = $(this).val();
        var product_id = $(this).attr("product-id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/get-product-price",
            data: { size: size, product_id: product_id },
            type: "post",
            success: function (resp) {
                // alert(resp['discount']);
                if (resp["discount"] > 0) {
                    $(".getAttributePrice").html(
                        "<div class='price'><h4>" +
                            resp["final_price"] +
                            "Tk.</h4></div><div class='original-price'><span>Original Price:</span><span>" +
                            resp["product_price"] +
                            "Tk.</span></div>"
                    );
                } else {
                    // alert(resp['discount']);
                    $(".getAttributePrice").html(
                        "<div class='price'><h4>" +
                            resp["final_price"] +
                            "Tk.</h4></div>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update cart items qty
    $(document).on("click", ".updateCartItem", function () {
        if ($(this).hasClass("plus-a")) {
            // Get Qty
            var quantity = $(this).data("qty");

            // Increase the qty by 1
            new_qty = parseInt(quantity) + 1;
            // alert(new_qty);
        }

        if ($(this).hasClass("minus-a")) {
            // Get Qty
            var quantity = $(this).data("qty");

            // Check qty is atleast 1
            if (quantity <= 1) {
                alert("Item  quantity must be 1 or greater");
                return false;
            }

            // Increase the qty by 1
            new_qty = parseInt(quantity) - 1;
            // alert(new_qty);
        }
        var cartid = $(this).data("cartid");
        // alert(cartId);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                cartid: cartid,
                qty: new_qty,
            },
            url: "/cart/update",
            type: "post",
            success: function (resp) {
                if (resp.status == false) {
                    alert(resp.message);
                }
                $("#appendCartItems").html(resp.view);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Delete Cart Items
    $(document).on("click", ".deleteCartItem", function () {
        var cartid = $(this).data("cartid");
        var result = confirm("Are you sure to delete this cart item?");
        if (result) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    cartid: cartid,
                },
                url: "cart/delete/",
                type: "post",
                success: function (resp) {
                    $("#appendCartItems").html(resp.view);
                },
                error: function () {
                    alert("Error");
                },
            });
        }
    });
});
