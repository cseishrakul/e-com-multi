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
                $(".totalCartItems").html(resp.totalCartItems);
                if (resp.status == false) {
                    alert(resp.message);
                }
                $("#appendCartItems").html(resp.view);
                $("#appendHeaderCartItem").html(resp.headerview);
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
                    $(".totalCartItems").html(resp.totalCartItems);
                    $("#appendCartItems").html(resp.view);
                    $("#appendHeaderCartItem").html(resp.headerview);
                },
                error: function () {
                    alert("Error");
                },
            });
        }
    });

    // User register form validation
    $("#registerForm").submit(function () {
        $(".loader").show();
        var formdata = $(this).serialize();
        $.ajax({
            url: "/user/register",
            type: "POST",
            data: formdata,
            success: function (resp) {
                if (resp.type == "error") {
                    $(".loader").hide();
                    $.each(resp.errors, function (i, error) {
                        $("#register-" + i).attr("style", "color:red");
                        $("#register-" + i).html(error);
                        setTimeout(function () {
                            $("#register-" + i).css({ display: "none" });
                        }, 3000);
                    });
                } else if (resp.type == "success") {
                    $(".loader").hide();
                    $("#register-success").attr("style", "color:green");
                    $("#register-success").html(resp.message);
                    // window.location.href = resp.url;
                }
                // Corrected form reset
                $("#registerForm")[0].reset();
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // User Login form validation
    $("#loginForm").submit(function () {
        $(".loader").show();
        var formdata = $(this).serialize();
        $.ajax({
            url: "/user/login",
            type: "POST",
            data: formdata,
            success: function (resp) {
                if (resp.type == "error") {
                    $.each(resp.errors, function (i, error) {
                        $("#login-" + i).attr("style", "color:red");
                        $("#login-" + i).html(error);
                        setTimeout(function () {
                            $("#login-" + i).css({ display: "none" });
                        }, 3000);
                    });
                } else if (resp.type == "incorrect") {
                    $("#login-error").attr("style", "color:red");
                    $("#login-error").html(resp.message);
                } else if (resp.type == "inactive") {
                    $("#login-error").attr("style", "color:red");
                    $("#login-error").html(resp.message);
                } else if (resp.type == "success") {
                    window.location.href = resp.url;
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // User Forgot Password
    $("#forgotForm").submit(function () {
        $(".loader").show();
        var formdata = $(this).serialize();
        $.ajax({
            url: "/user/forgot-password",
            type: "POST",
            data: formdata,
            success: function (resp) {
                if (resp.type == "error") {
                    $(".loader").hide();
                    $.each(resp.errors, function (i, error) {
                        $("#forgot-" + i).attr("style", "color:red");
                        $("#forgot-" + i).html(error);
                        setTimeout(function () {
                            $("#forgot-" + i).css({ display: "none" });
                        }, 3000);
                    });
                } else if (resp.type == "success") {
                    $(".loader").hide();
                    $("#forgot-success").attr("style", "color:green");
                    $("#forgot-success").html(resp.message);
                    // window.location.href = resp.url;
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // User Account form validation
    $("#accountForm").submit(function () {
        $(".loader").show();
        var formdata = $(this).serialize();
        $.ajax({
            url: "/user/account",
            type: "POST",
            data: formdata,
            success: function (resp) {
                if (resp.type == "error") {
                    $(".loader").hide();
                    $.each(resp.errors, function (i, error) {
                        $("#account-" + i).attr("style", "color:red");
                        $("#account-" + i).html(error);
                        setTimeout(function () {
                            $("#account-" + i).css({ display: "none" });
                        }, 3000);
                    });
                } else if (resp.type == "success") {
                    $(".loader").hide();
                    $("#account-success").attr("style", "color:green");
                    $("#account-success").html(resp.message);
                    setTimeout(function () {
                        $("#account-success").css({ display: "none" });
                    }, 3000);
                    // window.location.href = resp.url;
                }
                // Corrected form reset
                // $("#accountForm")[0].reset();
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // User Account Password form validation
    $("#passwordForm").submit(function () {
        $(".loader").show();
        var formdata = $(this).serialize();
        $.ajax({
            url: "/user/update-password",
            type: "POST",
            data: formdata,
            success: function (resp) {
                if (resp.type == "error") {
                    $(".loader").hide();
                    $.each(resp.errors, function (i, error) {
                        $("#password-" + i).attr("style", "color:red");
                        $("#password-" + i).html(error);
                        setTimeout(function () {
                            $("#password-" + i).css({ display: "none" });
                        }, 3000);
                    });
                } else if (resp.type == "incorrect") {
                    $(".loader").hide();
                    $("#password-error").attr("style", "color:red");
                    $("#password-error").html(resp.message);
                    setTimeout(function () {
                        $("#password-error").css({ display: "none" });
                    }, 3000);
                    // window.location.href = resp.url;
                } else if (resp.type == "success") {
                    $(".loader").hide();
                    $("#password-success").attr("style", "color:green");
                    $("#password-success").html(resp.message);
                    setTimeout(function () {
                        $("#password-success").css({ display: "none" });
                    }, 3000);
                    // window.location.href = resp.url;
                }
                // Corrected form reset
                // $("#accountForm")[0].reset();
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Apply Coupom
    $("#ApplyCoupon").submit(function () {
        var user = $(this).attr("user");
        // alert(user);
        if (user == 1) {
            // alert("Lets add coupon!");
        } else {
            alert("Please Login To Apply Coupon!");
            return false;
        }
        var code = $("#code").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            data: { code: code },
            url: "/apply-coupon",
            success: function (resp) {
                if (resp.message != "") {
                    alert(resp.message);
                }

                $(".totalCartItems").html(resp.totalCartItems);
                $("#appendCartItems").html(resp.view);
                $("#appendHeaderCartItems").html(resp.headerview);
                if (resp.couponAmount > 0) {
                    $(".couponAmount").text(resp.couponAmount + "Tk");
                } else {
                    $(".couponAmount").text("0 Tk");
                }
                if (resp.grand_total > 0) {
                    $(".grand_total").text(resp.grand_total + "Tk");
                } else {
                    $(".grand_total").text("0 Tk");
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Edit Delivery Address
    $(document).on("click", ".editAddress", function () {
        var addressid = $(this).data("addressid");
        // alert(addressid);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { addressid: addressid },
            url: "/get-delivery-address",
            type: "post",
            success: function (resp) {
                $("#showdifferent").removeClass("collapse");
                $(".newAddress").hide();
                $(".deliveryText").text("Edit Delivery Address");
                $("[name = delivery_id]").val(resp.address["id"]);
                $("[name = delivery_name]").val(resp.address["name"]);
                $("[name = delivery_address]").val(resp.address["address"]);
                $("[name = delivery_city]").val(resp.address["city"]);
                $("[name = delivery_state]").val(resp.address["state"]);
                $("[name = delivery_country]").val(resp.address["country"]);
                $("[name = delivery_pincode]").val(resp.address["pincode"]);
                $("[name = delivery_mobile]").val(resp.address["mobile"]);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Save Delivery Address
    $(document).on("submit", "#addressAddEditForm", function () {
        var formdata = $("#addressAddEditForm").serialize();
        $.ajax({
            url: "/save-delivery-address",
            type: "post",
            data: formdata,
            success: function (resp) {
                // alert(data);
                if ((resp.type = "error")) {
                    $(".loader").hide();
                    $.each(resp.errors, function (i, error) {
                        $("#delivery-" + i).attr("style", "color:red");
                        $("#delivery-" + i).html(error);
                        setTimeout(function () {
                            $("#delivery-" + i).css({
                                display: "none",
                            });
                        }, 3000);
                    });
                }
                $("#deliveryAddresses").html(resp.view);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Remove Delivery Address
    $(document).on("click", ".removeAddress", function () {
        if (confirm("Are you sure to remove this?")) {
            var addressid = $(this).data("addressid");
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "/remove-delivery-address",
                type: "post",
                data: { addressid: addressid },
                success: function (resp) {
                    $("#deliveryAddresses").html(resp.view);
                },
                error: function () {
                    alert("Error");
                },
            });
        }
    });
});
