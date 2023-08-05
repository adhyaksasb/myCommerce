$(document).ready(function () {
    $(".selectCountries").select2({
        width: "100%",
    });

    $(".selectCountry").select2({
        width: "100%",
        dropdownParent: $("#modal"),
    });

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
                // alert(resp);
                if (resp["discount"] > 0) {
                    $(".getAttributePrice").html(
                        "<div class='price'><h4>$" +
                            resp["final_price"] +
                            "</h4></div><div class='original-price'><span>Original Price:</span><span> $" +
                            resp["product_price"] +
                            "</span></div><div class='discount-price'><span>Discount:</span><span> " +
                            resp["discount"] +
                            "%</span></div><div class='total-save'><span>Save:</span><span> $" +
                            resp["save"] +
                            "</span></div>"
                    );
                    $(".totalStock").html(
                        "<div class='left'><span>Only: </span><span>" +
                            resp["stock"] +
                            " left</span></div>"
                    );
                    $("#quantity").attr("max", resp["stock"]);
                    $("#quantity").val(1);
                } else {
                    $(".getAttributePrice").html(
                        "<div class='price'><h4>$" +
                            resp["final_price"] +
                            "</h4></div>"
                    );
                    $(".totalStock").html(
                        "<div class='left'><span>Only: </span><span>" +
                            resp["stock"] +
                            " left</span></div>"
                    );
                    $("#quantity").attr("max", resp["stock"]);
                    $("#quantity").val(1);
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    $(document).on("click", "#removeCoupon", function () {
        var code = $("#code").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { code: code },
            url: "/remove-coupon",
            type: "post",
            success: function (resp) {
                Swal.fire(resp.message);
                $(".totalCartItems").html(resp.totalCartItems);
                $(".totalCartPrice").html(resp.totalCartPrice);
                $("#appendCartItems").html(resp.view);
                $("#appendHeaderCartItems").html(resp.headerView);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Apply Coupon
    $(document).on("submit", "#applyCoupon", function () {
        var user = $(this).attr("user");
        var code = $("#code").val();

        if (user != 1) {
            Swal.fire("Please login to apply coupon!");
            return false;
        }
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { code: code },
            url: "/apply-coupon",
            type: "post",
            success: function (resp) {
                Swal.fire(resp.message);
                $(".totalCartItems").html(resp.totalCartItems);
                $(".totalCartPrice").html(resp.totalCartPrice);
                $("#appendCartItems").html(resp.view);
                $("#appendHeaderCartItems").html(resp.headerView);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Resend Email Confirmation
    $(document).on("click", "#resend-code", function () {
        $(".loader").show();
        var email = $(this).attr("data");
        var name = $(this).attr("data2");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { email: email, name: name },
            url: "/resend-email-confirmation",
            type: "post",
            success: function (resp) {
                if (resp.type == "success") {
                    $(".loader").hide();
                    $("#resend-email-success").html(resp.message);
                    $("#resend-email-success").css({ display: "block" });
                    setTimeout(function () {
                        $("#resend-email-success").css({ display: "none" });
                    }, 2000);
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Cart Items Quantity on plus & minus button
    $(document).on("click", ".updateCartItem", function () {
        if ($(this).hasClass("plus-a")) {
            var quantity = $(this).attr("qty");
            new_qty = parseInt(quantity) + 1;
        }
        if ($(this).hasClass("minus-a")) {
            // Get Qty
            var quantity = $(this).attr("qty");
            // Check Qty is atleast 1
            if (quantity < 1) {
                Swal.fire("Item quantity must be 1 or greater!");
                return false;
            }
            // increase the qty by 1
            new_qty = parseInt(quantity) - 1;
        }

        var cartid = $(this).attr("cart-id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { cartid: cartid, qty: new_qty },
            url: "/cart/update",
            type: "post",
            success: function (resp) {
                if (resp.status == false) {
                    Swal.fire(resp.message);
                }
                $(".totalCartItems").html(resp.totalCartItems);
                $(".totalCartPrice").html(resp.totalCartPrice);
                $("#appendCartItems").html(resp.view);
                $("#appendHeaderCartItems").html(resp.headerView);
                applyCoupon;
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Cart Items by Typing Directly at Input
    $(document).on("input", ".quantityItem", function () {
        var quantity = $(this).val();
        var cartid = $(this).attr("cart-id");
        if (quantity < 1) {
            Swal.fire("Item quantity must be 1 or greater!");
            return false;
        }
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { cartid: cartid, qty: quantity },
            url: "/cart/update",
            type: "post",
            success: function (resp) {
                if (resp.status == false) {
                    Swal.fire(resp.message);
                }
                $(".totalCartItems").html(resp.totalCartItems);
                $(".totalCartPrice").html(resp.totalCartPrice);
                $("#appendCartItems").html(resp.view);
                $("#appendHeaderCartItems").html(resp.headerView);
                applyCoupon;
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Delete Cart Item
    $(document).on("click", ".deleteCartItem", function () {
        var cartId = $(this).attr("cart-id");
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
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: { cartId: cartId },
                    url: "/cart/delete",
                    type: "post",
                    success: function (resp) {
                        Swal.fire(
                            "Deleted!",
                            "Product has been removed.",
                            "success"
                        );
                        $(".totalCartItems").html(resp.totalCartItems);
                        $(".totalCartPrice").html(resp.totalCartPrice);
                        $("#appendCartItems").html(resp.view);
                        $("#appendHeaderCartItems").html(resp.headerView);
                        applyCoupon;
                    },
                    error: function () {
                        alert("Error");
                    },
                });
            }
        });
    });

    // Register
    $("#registerForm").submit(function () {
        $(".loader").show();
        var formData = $(this).serialize();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            url: "/user/register",
            type: "post",
            success: function (resp) {
                if (resp.type == "error") {
                    $(".loader").hide();
                    $.each(resp.errors, function (i, error) {
                        $("#register-" + i).html(error);
                        $("#register-" + i).css({ display: "block" });
                        setTimeout(function () {
                            $("#register-" + i).css({ display: "none" });
                        }, 2000);
                    });
                } else if (resp.type == "success") {
                    $(".loader").hide();
                    window.location.href = resp.url;
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Login
    $("#loginForm").submit(function () {
        $(".loader").show();
        var formData = $(this).serialize();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            url: "/user/login",
            type: "post",
            success: function (resp) {
                if (resp.type == "error") {
                    $(".loader").hide();
                    $.each(resp.errors, function (i, error) {
                        $("#login-" + i).html(error);
                        $("#login-" + i).css({ display: "block" });
                        setTimeout(function () {
                            $("#login-" + i).css({ display: "none" });
                        }, 2000);
                    });
                } else if (resp.type == "incorrect") {
                    $(".loader").hide();
                    $("#login-error").html(resp.message);
                    $("#login-error").css({ display: "block" });
                    setTimeout(function () {
                        $("#login-error").css({ display: "none" });
                    }, 2000);
                } else if (resp.type == "inactive") {
                    $(".loader").hide();
                    $("#login-error").html(resp.message);
                    $("#login-error").css({ display: "block" });
                    setTimeout(function () {
                        $("#login-error").css({ display: "none" });
                    }, 2000);
                } else if (resp.type == "noAuthenticator") {
                    $(".loader").hide();
                    window.location.href = resp.url;
                } else if (resp.type == "success") {
                    $(".loader").hide();
                    $("#appendOTP").html(resp.view);
                    const codes = document.querySelectorAll(".code");
                    codes[0].focus();
                    codes.forEach((code, idx) => {
                        code.addEventListener("keydown", (e) => {
                            if (e.key >= 0 && e.key <= 9) {
                                codes[idx].value = "";
                                setTimeout(() => codes[idx + 1].focus(), 10);
                            }
                            if (e.key === "Backspace" || e.key === "Delete") {
                                codes[idx].value = "";
                                setTimeout(() => codes[idx - 1].focus(), 10);
                            }
                        });
                    });
                    $("#verifyOTP").submit(function () {
                        var email = $("#email").val();
                        var password = $("#password").val();
                        var otp = $(".code")
                            .map(function () {
                                return this.value;
                            })
                            .get()
                            .join("");
                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            data: {
                                email: email,
                                password: password,
                                otp: otp,
                            },
                            url: "/user/login/otp",
                            type: "post",
                            success: function (resp) {
                                if (resp.type == "success") {
                                    window.location.href = resp.url;
                                } else if (resp.type == "inactive") {
                                    $("#otp-error").html(resp.message);
                                    $("#otp-error").css({ display: "block" });
                                    setTimeout(function () {
                                        $("#otp-error").css({
                                            display: "none",
                                        });
                                    }, 2000);
                                } else if (resp.type == "error") {
                                    $("#otp-error").html(resp.message);
                                    $("#otp-error").css({ display: "block" });
                                    setTimeout(function () {
                                        $("#otp-error").css({
                                            display: "none",
                                        });
                                    }, 2000);
                                }
                            },
                            error: function () {
                                alert("Error");
                            },
                        });
                    });
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Forgot Password
    $("#forgotForm").submit(function () {
        $(".loader").show();
        var formData = $(this).serialize();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            url: "/user/forgot-password",
            type: "post",
            success: function (resp) {
                if (resp.type == "error") {
                    $(".loader").hide();
                    $.each(resp.errors, function (i, error) {
                        $("#forgot-" + i).html(error);
                        $("#forgot-" + i).css({ display: "block" });
                        setTimeout(function () {
                            $("#forgot-" + i).css({ display: "none" });
                        }, 2000);
                    });
                } else if (resp.type == "success") {
                    $(".loader").hide();
                    $("#forgot-success").html(resp.message);
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Account Details
    $("#accountForm").submit(function () {
        $(".loader").show();
        var formData = $(this).serialize();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            url: "/user/settings",
            type: "post",
            success: function (resp) {
                if (resp.type == "error") {
                    $(".loader").hide();
                    $.each(resp.errors, function (i, error) {
                        $("#account-" + i).html(error);
                        $("#account-" + i).css({ display: "block" });
                        setTimeout(function () {
                            $("#account-" + i).css({ display: "none" });
                        }, 2000);
                    });
                    $("html").scrollTop(0);
                } else if (resp.type == "success") {
                    $(".loader").hide();
                    $("#account-success").html(resp.message);
                    $("html").scrollTop(0);
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Update Account Password
    $("#passwordForm").submit(function () {
        // $(".loader").show();
        var formData = $(this).serialize();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            url: "/user/update-password",
            type: "post",
            success: function (resp) {
                if (resp.type == "error") {
                    $(".loader").hide();
                    $.each(resp.errors, function (i, error) {
                        $("#password-" + i).html(error);
                        $("#password-" + i).css({ display: "block" });
                        setTimeout(function () {
                            $("#password-" + i).css({ display: "none" });
                        }, 2000);
                    });
                } else if (resp.type == "incorrect") {
                    $(".loader").hide();
                    $("#password-current_password").html(resp.message);
                    $("#password-current_password").css({ display: "block" });
                    setTimeout(function () {
                        $("#password-current_password").css({
                            display: "none",
                        });
                    }, 2000);
                } else if (resp.type == "success") {
                    $(".loader").hide();
                    $("#password-success").html(resp.message);
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Trigger Add New Address
    $(document).on("click", "#newAddress", function () {
        var title = $(this).text();
        $("#address-id").val("0");
        $("#address-name").val("");
        $("#address-mobile").val("");
        $("#address-address").val("");
        $("#address-city").val("");
        $("#address-state").val("");
        $("#address-country").val("");
        $("#address-pincode").val("");
        $(".selectCountry").select2({
            width: "100%",
            dropdownParent: $("#modal"),
        });
        $("#modal").addClass("active");
        $("#overlay").addClass("active");
        $(".modal-header .title").html(title);
    });

    // Trigger Edit Address
    $(document).on("click", "#editAddress", function () {
        var title = $(this).text();
        var addressId = $('input[name="delivery-addresses"]:checked').val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { addressId: addressId },
            url: "/address/get",
            type: "post",
            success: function (resp) {
                $("#modal").addClass("active");
                $("#overlay").addClass("active");
                $(".modal-header .title").html(title);
                $.each(resp, function (i, address) {
                    $("#address-" + i).val(address);
                    $(".selectCountry").select2({
                        width: "100%",
                        dropdownParent: $("#modal"),
                    });
                });
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Close Modal by clicking close button
    $(document).on("click", ".close-button", function () {
        $("#modal").removeClass("active");
        $("#overlay").removeClass("active");
    });

    // Close Modal by clicking on overlay
    $(document).on("click", "#overlay", function () {
        $("#modal").removeClass("active");
        $("#overlay").removeClass("active");
    });

    // Add / Edit Address
    $("#addressForm").submit(function () {
        var formData = $(this).serialize();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            url: "/address/add",
            type: "post",
            success: function (resp) {
                if (resp.type == "error") {
                    $.each(resp.errors, function (i, error) {
                        $("#errAddress-" + i).html(error);
                        $("#errAddress-" + i).css({ display: "block" });
                        setTimeout(function () {
                            $("#errAddress-" + i).css({ display: "none" });
                        }, 2000);
                    });
                } else if (resp.type == "success") {
                    $("#modal").removeClass("active");
                    $("#overlay").removeClass("active");
                    $("#appendAddressList").html(resp.view);
                    $("#address-success").html(resp.message);
                    setTimeout(function () {
                        $("#address-success").html("");
                    }, 2000);
                } else if (resp.type == "maxError") {
                    $("#modal").removeClass("active");
                    $("#overlay").removeClass("active");
                    $("#appendAddressList").html(resp.view);
                    $("#address-error").html(resp.message);
                    setTimeout(function () {
                        $("#address-error").html("");
                    }, 2000);
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Delete Address
    $(document).on("click", "#deleteAddress", function () {
        var addressId = $('input[name="delivery-addresses"]:checked').val();
        Swal.fire({
            title: "You'll delete the selected address, are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: { addressId: addressId },
                    url: "/address/delete",
                    type: "post",
                    success: function (resp) {
                        Swal.fire(
                            "Deleted!",
                            "Address has been removed.",
                            "success"
                        );
                        $("#appendAddressList").html(resp.view);
                        $("#address-success").html(resp.message);
                    },
                    error: function () {
                        alert("Error");
                    },
                });
            }
        });
    });
});

function get_filter(class_name) {
    var filter = [];
    $("." + class_name + ":checked").each(function () {
        filter.push($(this).val());
    });
    return filter;
}

document.getElementsByClassName("quantity-text-field")[0].oninput =
    function () {
        var max = parseInt(this.max);

        if (parseInt(this.value) > max) {
            this.value = max;
        }
    };

const openModalButtons = document.querySelectorAll("[data-modal-target]");
const closeModalButtons = document.querySelectorAll("[data-close-button]");
const overlay = document.getElementById("overlay");

openModalButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const modal = document.querySelector(button.dataset.modalTarget);
        openModal(modal);
    });
});

overlay.addEventListener("click", () => {
    const modals = document.querySelectorAll(".modal.active");
    modals.forEach((modal) => {
        closeModal(modal);
    });
});

closeModalButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const modal = button.closest(".modal");
        closeModal(modal);
    });
});

function openModal(modal) {
    if (modal == null) return;
    modal.classList.add("active");
    overlay.classList.add("active");
}

function closeModal(modal) {
    if (modal == null) return;
    modal.classList.remove("active");
    overlay.classList.remove("active");
}
