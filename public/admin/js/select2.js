(function ($) {
    "use strict";

    if ($(".select2single").length) {
        $(".select2single").select2({
            width: "100%",
        });
    }
    // Exclusive for Category Management Pages
    if ($(".select2level").length) {
        $(".select2level").select2({
            width: "100%",
        });
    }

    if ($(".select2multiple").length) {
        $(".select2multiple").select2({
            placeholder: "     Select Catagories",
            width: "100%",
        });
    }
    if ($(".selectCategories").length) {
        $(".selectCategories").select2({
            placeholder: "     Leave it empty for All Categories",
            width: "100%",
        });
    }
    if ($(".selectBrands").length) {
        $(".selectBrands").select2({
            placeholder: "     Leave it empty for All Brands",
            width: "100%",
        });
    }
    if ($(".selectUsers").length) {
        $(".selectUsers").select2({
            placeholder: "     Leave it empty for All Users",
            width: "100%",
        });
    }
})(jQuery);
