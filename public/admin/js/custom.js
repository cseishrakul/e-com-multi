$(document).ready(function () {
    // $(".nav-item").removeClass("active");
    // $(".nav-link").removeClass("active");
    // Check Admin password is correct or not
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
                if(resp['status'] == 0){
                    $("#admin-"+admin_id).html("<i class='mdi mdi-bookmark-outline' style='font-size: 25px;'status='Inactive'></i>")
                }else if(resp['status'] == 1){
                    $("#admin-"+admin_id).html("<i class='mdi mdi-bookmark-check' style='font-size: 25px;'status='Active'></i>")
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
});
