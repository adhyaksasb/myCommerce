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
