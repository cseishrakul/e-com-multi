<?php
use App\Models\ProductsFilter;
$productFilters = ProductsFilter::productFilters();

?>

<script>
    $(document).ready(function() {
        // Sort filter
        $("#sort").on("change", function() {
            // this.form.submit();
            var size = get_filter('size');
            var color = get_filter('color');
            var sort = $("#sort").val();
            var url = $("#url").val();
            @foreach ($productFilters as $filters)
                var {{ $filters['filter_column'] }} = get_filter('{{ $filters['filter_column'] }}');
            @endforeach
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: url,
                method: "Post",
                data: {
                    @foreach ($productFilters as $filters)
                        {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                    @endforeach
                    url: url,
                    sort: sort,
                    size: size,
                    color: color,
                },
                success: function(data) {
                    $(".filter_products").html(data);
                },
                error: function() {
                    alert("Error");
                },
            });
        });

        // Size filter
        $(".size").on("change", function() {
            // this.form.submit();
            var size = get_filter('size');
            var color = get_filter('color');
            var sort = $("#sort").val();
            var url = $("#url").val();
            @foreach ($productFilters as $filters)
                var {{ $filters['filter_column'] }} = get_filter('{{ $filters['filter_column'] }}');
            @endforeach
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: url,
                method: "Post",
                data: {
                    @foreach ($productFilters as $filters)
                        {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                    @endforeach
                    url: url,
                    sort: sort,
                    size: size,
                    color: color,
                },
                success: function(data) {
                    $(".filter_products").html(data);
                },
                error: function() {
                    alert("Error");
                },
            });
        });

        // Color filter
        $(".color").on("change", function() {
            // this.form.submit();
            var color = get_filter('color');
            var size = get_filter('size');
            var sort = $("#sort").val();
            var url = $("#url").val();
            @foreach ($productFilters as $filters)
                var {{ $filters['filter_column'] }} = get_filter('{{ $filters['filter_column'] }}');
            @endforeach
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: url,
                method: "Post",
                data: {
                    @foreach ($productFilters as $filters)
                        {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                    @endforeach
                    url: url,
                    sort: sort,
                    size: size,
                    color: color,
                },
                success: function(data) {
                    $(".filter_products").html(data);
                },
                error: function() {
                    alert("Error");
                },
            });
        });

        // Dynamic filter
        @foreach ($productFilters as $filter)
            $(".{{ $filter['filter_column'] }}").on("click", function() {
                var color = get_filter('color');
                var size = get_filter('size');
                var url = $("#url").val();
                var sort = $("#sort option:selected").val();
                @foreach ($productFilters as $filters)
                    var {{ $filters['filter_column'] }} = get_filter(
                        "{{ $filters['filter_column'] }}");
                @endforeach
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    url: url,
                    method: "Post",
                    data: {
                        @foreach ($productFilters as $filters)
                            {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                        @endforeach
                        url: url,
                        sort: sort,
                        size: size,
                        color: color,
                    },
                    success: function(data) {
                        $(".filter_products").html(data);
                    },
                    error: function() {
                        alert("Error");
                    },
                });
            });
        @endforeach
    });
</script>
