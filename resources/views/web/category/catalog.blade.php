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

                    </p>
                </div>

                <!-- Color -->
                <div class="widget filter-by-color">
                    <h3 class="widget-title heading uppercase relative bottom-line full-grey">Color</h3>
                    <ul class="color-select list-dividers">
                        @foreach ($colors as $color)
                            <li>
                                <input type="checkbox" class="input-checkbox" id="color_{{ $color->color_name }}" name="color" value="{{ $color->id }}">
                                <label for="color_{{ $color->color_name }}" class="checkbox-label">{{ $color->color_name }}</label>
                            </li>
                        @endforeach

                    </ul>
                </div>

                <!-- Size -->
                <div class="widget filter-by-size">
                    <h3 class="widget-title heading uppercase relative bottom-line full-grey">Size</h3>
                    <ul class="size-select list-dividers">
                        @foreach ($sizes as $index => $size)
                            <li>
                                <input type="checkbox" class="input-checkbox" id="size{{ $index }}" name="size" value="{{ $size->id }}">
                                <label for="size{{ $index }}" class="checkbox-label">{{ $size->size }}</label>
                            </li>
                        @endforeach

                    </ul>
                </div>

                <!-- Tags -->
                <div class="widget tags clearfix">
                    <h3 class="widget-title heading uppercase relative bottom-line full-grey">Tags</h3>
                    @foreach ($category->etags ?? [] as $tag)
                        @if ($tag)
                            <a href="javascript:void(0)" data-value="{{ $tag }}" data-click="tag">{{ $tag ?? '' }}</a>
                            <input type="hidden" value="" name="tag">
                        @endif
                    @endforeach

                </div>

                <a href="javascript:void(0)" data-insert="filter" class="btn btn-sm btn-stroke mb-10 w-100"><span>Filter</span></a>

                <!-- Best Sellers -->
                <div class="widget bestsellers" data-control="best-product-table">
                    @include('web.category.best_products')
                </div>
            </aside> <!-- end sidebar -->
        </div> <!-- end row -->
    </div> <!-- end container -->
</section> <!-- end catalog -->

@endsection
@push('js')
<script>
    // set by default for filetering data
    var data = {
        id: $('[name="id"]').val(),
        _token: '{{ csrf_token() }}',
    };

    // Filter Button event
    $(document.body).on('click', '[data-insert="filter"]', function() {
         console.log(data);
        table(data);
    });

    function table(data = {}) {
        $.ajax({
            url: '{{ route('category.show') }}',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.table !== undefined) {
                    $('[data-control="category-data-table"]').html(response.table)
                }
            }
        });
    }

    $("#slider-range").slider({
        range: true,
        min: 0,
        max: {{ $max_price }},
        values: [0, {{ $max_price }}],
        slide: function(event, ui) {
            // console.log({
            //     low: ui.values[0],
            //     hight: ui.values[1],
            // });
            $("#amount").val("руб " + ui.values[0] + " - руб " + ui.values[1]);
            setTimeout(() => {
                data.range = {
                    low: ui.values[0],
                    hight: ui.values[1]
                }
            }, 500);
        }
    });

    $("#amount").val("руб " + $("#slider-range").slider("values", 0) + " - руб " + $("#slider-range").slider("values", 1));

    //CATEGORY
    $(document).ready(function() {
        table(data);
    });

    //TAG
    $(document).on('click', '[data-click="tag"]', function() {
        $('[name="tag"]').val($(this).data('value'))
        data.tag = $(this).data('value')
    });

    //COLOR 
    $(document).on('click', '[name="color"]', function() {
        let colorCheckboxes = document.querySelectorAll('input[name="color"]:checked');
        let colorValues = [];
        colorCheckboxes.forEach((colorCheckbox) => {
            colorValues.push(colorCheckbox.value);
        });
        data.color = colorValues;
    });

    //SIZE
    $(document).on('click', '[name="size"]', function() {
        let sizeCheckboxes = document.querySelectorAll('input[name="size"]:checked');
        let sizeValues = [];
        sizeCheckboxes.forEach((sizeCheckbox) => {
            sizeValues.push(sizeCheckbox.value);
        });
        data.size = sizeValues;
    });

    //SORT 
    $(document).on('change', '[name="sort"]', function() {
        data.sort = $(this).val()
    });

    $(document.body).on('click', '[data-insert="wishList"]', function() {
        $.ajax({
            url: $(this).data('url'),
            success: function(response) {
                window.location.reload();
            }
        })
    })
</script>
@endpush
