// const { default: Swal } = require("sweetalert2");

$(document).ready(function () {
    // $(".nav-item").removeClass("active");
    // $(".nav-link").removeClass("active");
    // Check Admin password is correct or not
    $("#section").DataTable();
    $("#categories").DataTable();
    $("#brand").DataTable();
    $("#products").DataTable();


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
    $(".confirmDelete").click(function () {
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
});
