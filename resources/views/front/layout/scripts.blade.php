@php 
use App\Models\ProductsFilter;
$productFilters = ProductsFilter::productFilters();
@endphp

<script>
$(document).ready(function () {
    // Sort by Filter
    $("#sort").on("change", function () {
        const priceMin = document.getElementById("price-min");
        const priceMax = document.getElementById("price-max");
        let min = priceMin.getAttribute("value");
        let max = priceMax.getAttribute("value");

        if(min==null) {
            min = 0;
        }

        if(max==null) {
            const rangeMax = document.getElementById("priceRange");
            let dataMax = rangeMax.getAttribute("data-max");
            max = dataMax;
        }

        var brand = get_filter('brand');
        var color = get_filter('color');
        var size = get_filter('size');
        var sort = $("#sort").val();
        var url = $("#url").val();
        @foreach($productFilters as $filters)
            var {{ $filters['filter_column'] }} = get_filter("{{ $filters['filter_column'] }}");
        @endforeach
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "",
            method: "POST",
            data: {
                    @foreach($productFilters as $filters)
                    {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                    @endforeach
                    sort: sort,
                    url: url,
                    size: size,
                    color: color,
                    brand: brand,
                    min: min,
                    max: max,
                },
            success: function (data) {
                $(".filter_products").html(data);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Sort by Size Filter
    $(".size").on("change", function () {
        const priceMin = document.getElementById("price-min");
        const priceMax = document.getElementById("price-max");
        let min = priceMin.getAttribute("value");
        let max = priceMax.getAttribute("value");

        if(min==null) {
            min = 0;
        }

        if(max==null) {
            const rangeMax = document.getElementById("priceRange");
            let dataMax = rangeMax.getAttribute("data-max");
            max = dataMax;
        }

        var brand = get_filter('brand');
        var color = get_filter('color');
        var size = get_filter('size');
        var sort = $("#sort").val();
        var url = $("#url").val();
        @foreach($productFilters as $filters)
            var {{ $filters['filter_column'] }} = get_filter("{{ $filters['filter_column'] }}");
        @endforeach
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "",
            method: "POST",
            data: {
                    @foreach($productFilters as $filters)
                    {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                    @endforeach
                    sort: sort,
                    url: url,
                    size: size,
                    color: color,
                    brand: brand,
                    min: min,
                    max: max,
                },
            success: function (data) {
                $(".filter_products").html(data);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Sort by Color Filter
    $(".color").on("change", function () {
        const priceMin = document.getElementById("price-min");
        const priceMax = document.getElementById("price-max");
        let min = priceMin.getAttribute("value");
        let max = priceMax.getAttribute("value");

        if(min==null) {
            min = 0;
        }

        if(max==null) {
            const rangeMax = document.getElementById("priceRange");
            let dataMax = rangeMax.getAttribute("data-max");
            max = dataMax;
        }

        var brand = get_filter('brand');
        var color = get_filter('color');
        var size = get_filter('size');
        var sort = $("#sort").val();
        var url = $("#url").val();
        @foreach($productFilters as $filters)
            var {{ $filters['filter_column'] }} = get_filter("{{ $filters['filter_column'] }}");
        @endforeach
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "",
            method: "POST",
            data: {
                    @foreach($productFilters as $filters)
                    {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                    @endforeach
                    sort: sort,
                    url: url,
                    size: size,
                    color: color,
                    brand: brand,
                    min: min,
                    max: max,
                },
            success: function (data) {
                $(".filter_products").html(data);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Sort by Brand Filter
    $(".brand").on("change", function () {
        const priceMin = document.getElementById("price-min");
        const priceMax = document.getElementById("price-max");
        let min = priceMin.getAttribute("value");
        let max = priceMax.getAttribute("value");

        if(min==null) {
            min = 0;
        }

        if(max==null) {
            const rangeMax = document.getElementById("priceRange");
            let dataMax = rangeMax.getAttribute("data-max");
            max = dataMax;
        }

        var brand = get_filter('brand');
        var color = get_filter('color');
        var size = get_filter('size');
        var sort = $("#sort").val();
        var url = $("#url").val();
        @foreach($productFilters as $filters)
            var {{ $filters['filter_column'] }} = get_filter("{{ $filters['filter_column'] }}");
        @endforeach
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "",
            method: "POST",
            data: {
                    @foreach($productFilters as $filters)
                    {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                    @endforeach
                    sort: sort,
                    url: url,
                    size: size,
                    color: color,
                    brand: brand,
                    min: min,
                    max: max,
                },
            success: function (data) {
                $(".filter_products").html(data);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Filter by Price Range
    $("#priceFilter").on("click", function() {
        const priceMin = document.getElementById("price-min");
        const priceMax = document.getElementById("price-max");
        let min = priceMin.getAttribute("value");
        let max = priceMax.getAttribute("value");

        if(min==null) {
            min = 0;
        }

        if(max==null) {
            const rangeMax = document.getElementById("priceRange");
            let dataMax = rangeMax.getAttribute("data-max");
            max = dataMax;
        }

        var brand = get_filter('brand');
        var color = get_filter('color');
        var size = get_filter('size');
        var sort = $("#sort").val();
        var url = $("#url").val();
        @foreach($productFilters as $filters)
            var {{ $filters['filter_column'] }} = get_filter("{{ $filters['filter_column'] }}");
        @endforeach
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "",
            method: "POST",
            data: {
                    @foreach($productFilters as $filters)
                    {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                    @endforeach
                    sort: sort,
                    url: url,
                    size: size,
                    color: color,
                    brand: brand,
                    min: min,
                    max: max,
                },
            success: function (data) {
                $(".filter_products").html(data);
            },
            error: function () {
                alert("Error");
            },
        });
    })

    // Dynamic Filters
    @foreach($productFilters as $filter)
        $(".{{ $filter['filter_column'] }}").on("click", function () {
            const priceMin = document.getElementById("price-min");
            const priceMax = document.getElementById("price-max");
            let min = priceMin.getAttribute("value");
            let max = priceMax.getAttribute("value");

            if(min==null) {
                min = 0;
            }

            if(max==null) {
                const rangeMax = document.getElementById("priceRange");
                let dataMax = rangeMax.getAttribute("data-max");
                max = dataMax;
            }
            
            var brand = get_filter('brand');
            var color = get_filter('color');
            var size = get_filter('size');
            var url = $("#url").val();
            var sort = $("#sort option:selected").val();
            @foreach($productFilters as $filters)
                var {{ $filters['filter_column'] }} = get_filter("{{ $filters['filter_column'] }}");
            @endforeach
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: "",
                method: "POST",
                data: {
                    @foreach($productFilters as $filters)
                    {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                    @endforeach
                    sort: sort,
                    url: url,
                    color: color,
                    size: size,
                    brand: brand,
                    min: min,
                    max: max,
                },
                success: function (data) {
                    $(".filter_products").html(data);
                },
                error: function () {
                    alert("Error");
                },
            });
        });
    @endforeach
});
</script>