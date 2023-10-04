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
                    $(".getAttributePrice").html("<div class='price'><h4>" +
                    resp['final_price'] +"Tk.</h4></div><div class='original-price'><span>Original Price:</span><span>"+
                    resp['product_price'] +"Tk.</span></div>");
                } else {
                    // alert(resp['discount']);
                    $(".getAttributePrice").html(
                        "<div class='price'><h4>" +
                            resp['final_price'] +
                            "Tk.</h4></div>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
});
