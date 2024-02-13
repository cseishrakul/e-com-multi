// const { default: Swal } = require("sweetalert2");

$(document).ready(function () {
    // $(".nav-item").removeClass("active");
    // $(".nav-link").removeClass("active");
    // Check Admin password is correct or not
    $("#section").DataTable();
    $("#categories").DataTable();
    $("#brand").DataTable();
    $("#products").DataTable();
    $("#banner").DataTable();
    $("#filter").DataTable();
    $("#coupon").DataTable();
    $("#users").DataTable();
    $("#orders").DataTable();

    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        // alert(current_password);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/check-admin-password",
            data: { current_password: current_password },
            success: function (resp) {
                // alert(resp);
                if (resp == "false") {
                    $("#check_password").html(
                        "<font color='red'>Current Password is incorrect!</font>"
                    );
                } else if (resp == "true") {
                    $("#check_password").html(
                        "<font color='green'>Current Password is correct!</font>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update admin status
    $(document).on("click", ".updateAdminStatus", function () {
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-admin-status",
            data: { status: status, admin_id: admin_id },
            success: function (resp) {
                // alert(resp);
                if (resp["status"] == 0) {
                    $("#admin-" + admin_id).html(
                        "<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#admin-" + admin_id).html(
                        "<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Section Status
    $(document).on("click", ".updateSectionStatus", function () {
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-section-status",
            data: { status: status, section_id: section_id },
            success: function (resp) {
                // alert(resp);
                if (resp["status"] == 0) {
                    $("#section-" + section_id).html(
                        "<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#section-" + section_id).html(
                        "<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Category Status
    $(document).on("click", ".updateCategoryStatus", function () {
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-category-status",
            data: { status: status, category_id: category_id },
            success: function (resp) {
                // alert(resp);
                if (resp["status"] == 0) {
                    $("#category-" + category_id).html(
                        "<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#category-" + category_id).html(
                        "<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Brand Status
    $(document).on("click", ".updateBrandStatus", function () {
        var status = $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-brand-status",
            data: { status: status, brand_id: brand_id },
            success: function (resp) {
                // alert(resp);
                if (resp["status"] == 0) {
                    $("#brand-" + brand_id).html(
                        "<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#brand-" + brand_id).html(
                        "<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    // Update Coupon Status
    $(document).on("click", ".updateCouponStatus", function () {
        var status = $(this).children("i").attr("status");
        var coupon_id = $(this).attr("coupon_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-coupon-status",
            data: { status: status, coupon_id: coupon_id },
            success: function (resp) {
                // alert(resp);
                if (resp["status"] == 0) {
                    $("#coupon-" + coupon_id).html(
                        "<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#coupon-" + coupon_id).html(
                        "<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update User Status
    $(document).on("click", ".updateUserStatus", function () {
        var status = $(this).children("i").attr("status");
        var user_id = $(this).attr("user_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-user-status",
            data: { status: status, user_id: user_id },
            success: function (resp) {
                // alert(resp);
                if (resp["status"] == 0) {
                    $("#user-" + user_id).html(
                        "<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#user-" + user_id).html(
                        "<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Product Status
    $(document).on("click", ".updateProductStatus", function () {
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-product-status",
            data: { status: status, product_id: product_id },
            success: function (resp) {
                // alert(resp);
                if (resp["status"] == 0) {
                    $("#product-" + product_id).html(
                        "<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#product-" + product_id).html(
                        "<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Attributes Status
    $(document).on("click", ".updateAttributeStatus", function () {
        var status = $(this).children("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-attribute-status",
            data: { status: status, attribute_id: attribute_id },
            success: function (resp) {
                // alert(resp);
                if (resp["status"] == 0) {
                    $("#attribute-" + attribute_id).html(
                        "<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#attribute-" + attribute_id).html(
                        "<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Images Status
    $(document).on("click", ".updateImageStatus", function () {
        var status = $(this).children("i").attr("status");
        var image_id = $(this).attr("image_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-images-status",
            data: { status: status, image_id: image_id },
            success: function (resp) {
                // alert(resp);
                if (resp["status"] == 0) {
                    $("#image-" + image_id).html(
                        "<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#image-" + image_id).html(
                        "<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Banner Status
    $(document).on("click", ".updateBannerStatus", function () {
        var status = $(this).children("i").attr("status");
        var banner_id = $(this).attr("banner_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-banner-status",
            data: { status: status, banner_id: banner_id },
            success: function (resp) {
                // alert(resp);
                if (resp["status"] == 0) {
                    $("#banner-" + banner_id).html(
                        "<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#banner-" + banner_id).html(
                        "<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    // Update Filter Status
    $(document).on("click", ".updateFilterStatus", function () {
        var status = $(this).children("i").attr("status");
        var filter_id = $(this).attr("filter_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-filter-status",
            data: { status: status, filter_id: filter_id },
            success: function (resp) {
                // alert(resp);
                if (resp["status"] == 0) {
                    $("#filter-" + filter_id).html(
                        "<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#filter-" + filter_id).html(
                        "<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    // Update Filter Value Status
    $(document).on("click", ".updateFilterValueStatus", function () {
        var status = $(this).children("i").attr("status");
        var filter_id = $(this).attr("filter_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-filter-value-status",
            data: { status: status, filter_id: filter_id },
            success: function (resp) {
                // alert(resp);
                if (resp["status"] == 0) {
                    $("#filter-" + filter_id).html(
                        "<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#filter-" + filter_id).html(
                        "<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Confirm Section Delete
    // $(".confirmDelete").click(function () {
    //     var title = $(this).attr("title");
    //     if(confirm("Are you sure to delete this"+title+"?")){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // });

    // confirm delete with sweetalert
    $(document).on("click", ".confirmDelete", function () {
        var module = $(this).attr("module");
        var moduleid = $(this).attr("moduleid");

        Swal.fire({
            title: "Are you sure?",
            text: "You wont be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            confirmButtonText: "Delete",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Deleted", "Your file has been deleted", "success");
                window.location = "/admin/delete-" + module + "/" + moduleid;
            }
        });
    });

    // Append Categories Level
    $("#section_id").change(function () {
        var section_id = $(this).val();
        // alert(section_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "get",
            url: "/admin/append-categories-level",
            data: { section_id: section_id },
            success: function (resp) {
                $("#appendCategoryLevel").html(resp);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Procut Attributes add remove input field dynamic
    var maxField = 10; //Input fields increment limitation
    var addButton = $(".add_button"); //Add button selector
    var wrapper = $(".field_wrapper"); //Input field wrapper
    var fieldHTML =
        '<div><input type="text" name="size[]" placeholder="Size"/>&nbsp;<input type="text" name="sku[]" placeholder="SKU"/>&nbsp;<input type="text" name="price[]" placeholder="Price"/>&nbsp;<input type="text" name="stock[]" placeholder="Stock"/>&nbsp;<a href="javascript:void(0);" class="remove_button"><i class="mdi mdi-minus-box" style="font-size: 25px;"></i></a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on("click", ".remove_button", function (e) {
        e.preventDefault();
        $(this).parent("div").remove(); //Remove field html
        x--; //Decrement field counter
    });

    // Show filters on selection of category
    $("#category_id").on("change", function () {
        var category_id = $(this).val();
        // alert(category_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "category-filters",
            data: { category_id: category_id },
            success: function (resp) {
                $(".loadFilters").html(resp.view);
            },
        });
    });

    // Show/Hide Coupon field for Manual/Automatic
    $("#manualCoupon").click(function () {
        $("#couponField").show();
    });

    $("#automaticCoupon").click(function () {
        $("#couponField").hide();
    });
});
