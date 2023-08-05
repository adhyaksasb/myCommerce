$(document).ready(function () {
    $("#sections").DataTable();
    $("#admins").DataTable();
    $("#categories").DataTable();
    $("#products").DataTable();
    $("#attributes").DataTable();
    $("#images").DataTable();
    $("#banners").DataTable();
    $("#filters").DataTable();
    $("#filtersValues").DataTable();
    $("#coupons").DataTable();
    $("#users").DataTable();
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");

    // Check current password is correct or not
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/check-admin-password",
            data: { current_password: current_password },
            success: function (resp) {
                if (resp == "false") {
                    $("#check_password").html(
                        "<font color='red'> Current Password is Incorrent!</font>"
                    );
                } else {
                    $("#check_password").html(
                        "<font color='green'> Current Password is Corrent!</font>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Admin Status
    $(document).on("click", ".updateAdminStatus", function () {
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-admin-status",
            data: { status: status, admin_id: admin_id },
            beforeSend: function () {
                $(".loaderAjax").show();
            },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#admin-" + admin_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-close-circle-outline' status='inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#admin-" + admin_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-check-circle' status='Active'></i>"
                    );
                }
            },
            complete: function (data) {
                $(".loaderAjax").hide();
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
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-section-status",
            data: { status: status, section_id: section_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#section-" + section_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-close-circle-outline' status='inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#section-" + section_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-check-circle' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Confirm Deletion (Vanilla Javascript)
    // $(".confirmDelete").click(function () {
    //     var title = $(this).attr("title");
    //     if (confirm("Are you sure to delete " + title + "?")) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // });

    // Confirm Deletion (SweetAlert 2)
    $(document).on("click", ".confirmDelete", function () {
        var module = $(this).attr("module");
        var moduleid = $(this).attr("moduleid");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
                window.location = "/admin/delete-" + module + "/" + moduleid;
            }
        });
    });

    // Update Category Status
    $(document).on("click", ".updatecategoryStatus", function () {
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-category-status",
            data: { status: status, category_id: category_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#category-" + category_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-close-circle-outline' status='inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#category-" + category_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-check-circle' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Append Categories Level
    $("#section_id").change(function () {
        var section_id = $(this).val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "get",
            url: "/admin/append-categories-level",
            data: { section_id: section_id },
            success: function (resp) {
                $("#appendCategoriesLevel").html(resp);
                $(".select2level").select2({
                    width: "100%",
                });
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
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-brand-status",
            data: { status: status, brand_id: brand_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#brand-" + brand_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-close-circle-outline' status='inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#brand-" + brand_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-check-circle' status='Active'></i>"
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
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-product-status",
            data: { status: status, product_id: product_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#product-" + product_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-close-circle-outline' status='inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#product-" + product_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-check-circle' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    /////////////////////////////////////////////////////////////////////////////////////////////
    // Add & Remove Input Fields for Attributes Pages
    var maxField = 10; //Input fields increment limitation
    var addButton = $(".add_button"); //Add button selector
    var wrapper = $(".field_wrapper"); //Input field wrapper
    var fieldHTML =
        '<div><div style="height:10px;"></div><input class="border border-dark" style="width:150px;" type="text" name="size[]" id="size" placeholder="Size"/>&nbsp;<input class="border border-dark" style="width:150px;" type="text" name="price[]" id="price" placeholder="Price"/>&nbsp;<input class="border border-dark" style="width:150px;" type="text" name="stock[]" id="stock" placeholder="Stock"/>&nbsp;<input class="border border-dark" style="width:150px;" type="text" name="sku[]" id="sku" placeholder="SKU"/><a href="javascript:void(0);" class="remove_button"> Remove</a></div></div>'; //New input field html
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
    /////////////////////////////////////////////////////////////////////////////////////////////

    // Update Attribute Status
    $(document).on("click", ".updateAttributeStatus", function () {
        var status = $(this).children("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-attribute-status",
            data: { status: status, attribute_id: attribute_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#attribute-" + attribute_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-close-circle-outline' status='inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#attribute-" + attribute_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-check-circle' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Image Status
    $(document).on("click", ".updateImageStatus", function () {
        var status = $(this).children("i").attr("status");
        var image_id = $(this).attr("image_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-image-status",
            data: { status: status, image_id: image_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#image-" + image_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-close-circle-outline' status='inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#image-" + image_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-check-circle' status='Active'></i>"
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
                if (resp["status"] == 0) {
                    $("#banner-" + banner_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-close-circle-outline' status='inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#banner-" + banner_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-check-circle' status='Active'></i>"
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
                if (resp["status"] == 0) {
                    $("#filter-" + filter_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-close-circle-outline' status='inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#filter-" + filter_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-check-circle' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Filter Value Status
    $(document).on("click", ".updateFiltersValueStatus", function () {
        var status = $(this).children("i").attr("status");
        var filtersValue_id = $(this).attr("filtersValue_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-filter-values-status",
            data: { status: status, filtersValue_id: filtersValue_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#filtersValue-" + filtersValue_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-close-circle-outline' status='inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#filtersValue-" + filtersValue_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-check-circle' status='Active'></i>"
                    );
                }
            },
            error: function (resp) {
                alert(resp);
            },
        });
    });

    // Update Coupon Status
    $(document).on("click", ".updateCouponStatus", function () {
        var status = $(this).children("i").attr("status");
        var coupon_id = $(this).attr("coupon_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-coupon-status",
            data: { status: status, coupon_id: coupon_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#coupon-" + coupon_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-close-circle-outline' status='inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#coupon-" + coupon_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-check-circle' status='Active'></i>"
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
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-user-status",
            data: { status: status, user_id: user_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#user-" + user_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-close-circle-outline' status='inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#user-" + user_id).html(
                        "<i style='color: #5c25cb; font-size:25px;' class='mdi mdi-check-circle' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Show Filters on selection of Category (Add/Edit Products)
    $("#category_id").on("change", function () {
        var category_id = $(this).val();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/category-filters",
            data: { category_id: category_id },
            success: function (resp) {
                $(".loadFilters").html(resp.view);
                $(".select2single").select2({
                    width: "100%",
                });
            },
            error: function (resp) {
                alert(resp);
            },
        });
    });

    //  Show/Hide Click Event for Manual Coupon
    $("#manualCoupon").click(function () {
        $("#manualCouponField").show();
    });
    $("#automaticCoupon").click(function () {
        $("#manualCouponField").hide();
    });
});
