@extends('web.layouts.master')
@section('title', __('Catalog'))
@section('content')
    <!-- Page Title -->
    <section class="page-title text-center bg-light">
        <div class="container relative clearfix">
            <div class="title-holder">
                <div class="title-text">
                    <h1 class="uppercase">catalog sidebar</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('web.index') }}">Home</a>
                        </li>

                        <li class="active">
                        @section('title', __('Catalog'))
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- Catalogue -->
<section class="section-wrap pt-80 pb-40 catalogue">
    <div class="container relative">

        <!-- Filter -->
        <div class="shop-filter">
            <div class="view-mode hidden-xs">
                <span>View:</span>
                <a class="grid grid-active" id="grid"></a>
                <a class="list" id="list"></a>
            </div>
            <div class="filter-show hidden-xs">
                <span>Show:</span>
                <a href="#" class="active">12</a>
                <a href="#">24</a>
                <a href="#">all</a>
            </div>
            <form class="ecommerce-ordering">
                @csrf
                <select id="sort" name="sort">
                    <option value="">Default Sorting</option>
                    <option value="price-low-to-high">Price: high to low</option>
                    <option value="price-high-to-low">Price: low to high</option>
                    <option value="by-popularity">By Popularity</option>
                    <option value="date">By Newness</option>
                    <option value="rating">By Rating</option>
                </select>
            </form>
        </div>

        <div class="row">
            <div class="col-md-9 catalogue-col right mb-50">
                <div class="shop-catalogue grid-view">

                    <input type="hidden" value="{{ $id }}" name="id">
                    <div class="row items-grid" data-control="category-data-table">

                    </div> <!-- end row -->
                </div> <!-- end grid mode -->

                <!-- Pagination -->
                <div class="pagination-wrap clearfix">
                    <p class="result-count">Showing: 12 of 80 results</p>
                    <nav class="pagination right clearfix">
                        <a href="#"><i class="fa fa-angle-left"></i></a>
                        <span class="page-numbers current">1</span>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#"><i class="fa fa-angle-right"></i></a>
                    </nav>
                </div>

            </div> <!-- end col -->


            <!-- Sidebar -->
            <aside class="col-md-3 sidebar left-sidebar">

                <!-- Categories -->
                @include('web.layouts.category')

                <!-- Filter by Price -->
                <div class="widget filter-by-price clearfix">
                    <h3 class="widget-title heading uppercase relative bottom-line full-grey">Filter by Price</h3>

                    <div id="slider-range"></div>
                    <p>
                        <label for="amount">Price:</label>
                        <input type="text" id="amount" name="amount">
                        <a href="javascript:void(0)" data-insert="priceFilter" class="btn btn-sm btn-stroke"><span>Filter</span></a>
                    </p>
                </div>

                <!-- Color -->
                <div class="widget filter-by-color">
                    <h3 class="widget-title heading uppercase relative bottom-line full-grey">Color</h3>
                    <ul class="color-select list-dividers">
                        @foreach ($colors as $color)
                            <li>
                                <input type="checkbox" class="input-checkbox" id="{{ $color->color_name }}" name="color" value="{{ $color->id }}">
                                <label for="{{ $color->color_name }}" class="checkbox-label">{{ $color->color_name }}</label>
                            </li>
                        @endforeach

                    </ul>
                </div>

                <!-- Size -->
                <div class="widget filter-by-size">
                    <h3 class="widget-title heading uppercase relative bottom-line full-grey">Size</h3>
                    <ul class="size-select list-dividers">
                        @foreach ($sizes as $size)
                            <li>
                                <input type="checkbox" class="input-checkbox" id="size" name="size" value="{{ $size->id }}">
                                <label for="size" class="checkbox-label">{{ $size->size }}</label>
                            </li>
                        @endforeach

                    </ul>
                </div>

                <!-- Best Sellers -->
                <div class="widget bestsellers">
                    <div class="products-widget">
                        <h3 class="widget-title heading uppercase relative bottom-line full-grey mb-30">Best Sellers</h3>
                        <ul class="product-list-widget">
                            <li class="clearfix">
                                <a href="shop-single.html">
                                    <img src="img/shop/shop_item_9.jpg" alt="">
                                    <span class="product-title">White Shirt</span>
                                </a>
                                <span class="price">
                                    <ins>
                                        <span class="amount">$120.00</span>
                                    </ins>
                                </span>
                            </li>
                            <li class="clearfix">
                                <a href="shop-single.html">
                                    <img src="img/shop/shop_item_10.jpg" alt="">
                                    <span class="product-title">Street Hoddie</span>
                                </a>
                                <span class="price">
                                    <ins>
                                        <span class="amount">$179.00</span>
                                    </ins>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tags -->
                <div class="widget tags clearfix">
                    <h3 class="widget-title heading uppercase relative bottom-line full-grey">Tags</h3>
                    @php
                        $explode_tags = explode(',', $category->tags);
                    @endphp

                    @foreach ($explode_tags as $tag)
                        <a href="javascript:void(0)" data-value="{{ $tag }}" data-click="tag">{{ $tag ?? '' }}</a>
                        <input type="hidden" value="" name="tag">
                    @endforeach

                </div>

            </aside> <!-- end sidebar -->

        </div> <!-- end row -->
    </div> <!-- end container -->
</section> <!-- end catalog -->

@endsection
@push('js')
<script>
    $(function() {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 1500,
            values: [0, 1500],
            slide: function(event, ui) {
                console.log({
                    low: ui.values[0],
                    hight: ui.values[1],
                });
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                setTimeout(() => {
                    table({
                        id: $('[name="id"]').val(),
                        _token: '{{ csrf_token() }}',
                        range: {
                            low: ui.values[0],
                            hight: ui.values[1],
                        },
                    });
                }, 500);
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) +
            " - $" + $("#slider-range").slider("values", 1));
    });
    $(document).ready(function() {
        table();
    });

    function table(data = {}) {
        $.ajax({
            url: '{{ route('category.show') }}',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.table !== undefined) {
                    console.log(response);
                    $('[data-control="category-data-table"]').html(response.table)
                }
            }
        });
    }

    //CATEGORY
    $(document).ready(function() {
        table({
            id: $('[name="id"]').val(),
            _token: '{{ csrf_token() }}'
        });
    });

    //PRICE FILTER

    /* $(document).on('click', '[data-insert="priceFilter]', function() {
       console.log($('[name="amount"]').val());
         table({
             id: $('[name="id"]').val(),
             _token: '{{ csrf_token() }}',
             amount: $('[name="amount"]').val(),
             color: $('[name="color"]').find(':checked').val(),
             size: $('[name="size"]').find(':checked').val()
         });
     });*/

    //TAG

    $(document).on('click', '[data-click="tag"]', function() {
        $('[name="tag"]').val($(this).data('value'))
        table({
            id: $('[name="id"]').val(),
            _token: '{{ csrf_token() }}',
            tag: $('[name="tag"]').val(),

        });
    });

    //COLOR 
    $(document).on('click', '[name="color"]', function() {

        let colorCheckboxes = document.querySelectorAll('input[name="color"]:checked');
        let colorValues = [];
        colorCheckboxes.forEach((colorCheckbox) => {
            colorValues.push(colorCheckbox.value);
        });

        let sizeCheckboxes = document.querySelectorAll('input[name="size"]:checked');
        let sizeValues = [];
        sizeCheckboxes.forEach((sizeCheckbox) => {
            sizeValues.push(sizeCheckbox.value);
        });
        //console.log(colorValues)
        table({
            id: $('[name="id"]').val(),
            _token: '{{ csrf_token() }}',
            color: colorValues,
            size: sizeValues,
            sort: $('[name="sort"]').find(':selected').val()
        });
    });

    //SIZE
    $(document).on('click', '[name="size"]', function() {
        let colorCheckboxes = document.querySelectorAll('input[name="color"]:checked');
        let colorValues = [];
        colorCheckboxes.forEach((colorCheckbox) => {
            colorValues.push(colorCheckbox.value);
        });

        let sizeCheckboxes = document.querySelectorAll('input[name="size"]:checked');
        let sizeValues = [];
        sizeCheckboxes.forEach((sizeCheckbox) => {
            sizeValues.push(sizeCheckbox.value);
        });

        table({
            id: $('[name="id"]').val(),
            _token: '{{ csrf_token() }}',
            color: colorValues,
            size: sizeValues,
            sort: $('#sort').find(':selected').val()
        });
    });

    //SORT 

    $(document).on('change', '[name="sort"]', function() {
        //console.log( $(this).val())
        let colorCheckboxes = document.querySelectorAll('input[name="color"]:checked');
        let colorValues = [];
        colorCheckboxes.forEach((colorCheckbox) => {
            colorValues.push(colorCheckbox.value);
        });

        let sizeCheckboxes = document.querySelectorAll('input[name="size"]:checked');
        let sizeValues = [];
        sizeCheckboxes.forEach((sizeCheckbox) => {
            sizeValues.push(sizeCheckbox.value);
        });

        table({
            id: $('[name="id"]').val(),
            _token: '{{ csrf_token() }}',
            color: colorValues,
            size: sizeValues,
            sort: $(this).val()
        });
    });

    $(document.body).on('click', '[data-insert="wishList"]', function() {
        $.ajax({
            url: $(this).data('url'),
            success: function(response) {
                console.log(response);
                window.location.reload();
            }
        })
    })
</script>
@endpush
