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
              <a href="{{route('web.index')}}">Home</a>
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
                <select>
                  <option value="default-sorting">Default Sorting</option>
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
  
                  <div class="row items-grid">
                    @foreach ($products as $product)
                      
                    <div class="col-md-4 col-xs-6 product product-grid">
                      <div class="product-item clearfix">
                        <div class="product-img hover-trigger">
                          <a href="{{$product->category_id}}">
                            <img src="{{url('img/shop/shop_item_1.jpg')}}" alt="">
                            <img src="{{url('img/shop/shop_item_back_1.jpg')}}" alt="" class="back-img">
                          </a>
                          @if ($product->discount)
                            <div class="product-label">
                              <span class="sale">sale</span>
                            </div>
                          @endif
                          
                          <div class="hover-2">                    
                            <div class="product-actions">
                              <a href="#" class="product-add-to-wishlist">
                                <i class="fa fa-heart"></i>
                              </a>
                            </div>                        
                          </div>
                          <a href="{{ route('product.detail', [
                            'slug' => $product->slug,
                            'id' => $product->id,
                        ]) }}" class="product-quickview">Quick View</a>
                        </div>
  
                        <div class="product-details">
                          <h3 class="product-title">
                            <a href="{{ route('product.detail', [
                              'slug' => $product->slug,
                              'id' => $product->id,
                          ]) }}">{{$product->title}}</a>
                          </h3>
                          <span class="category">
                            <a href="{{$product->category_id}}">{{$product->category->name}}</a>
                          </span>
                        </div>
  
                        <span class="price">
                          @if ($product->discount)
                          <del>
                            <span>{{$product->price_pretty}}</span>
                          </del>
                          @endif
                          <ins>
                            <span class="amount">{{$product->discount_price}}</span>
                          </ins>                        
                        </span>
  
                        <div class="product-description">
                          <h3 class="product-title">
                            <a href="{{ route('product.detail', [
                              'slug' => $product->slug,
                              'id' => $product->id,
                          ]) }}">{{$product->title}}</a>
                          </h3>
                          <span class="price">
                            @if ($product->discount)
                              <del>
                                <span>{{$product->price_pretty}}</span>
                              </del>
                            @endif
                            
                            <ins>
                              <span class="amount">{{$product->discount_price}}</span>
                            </ins>                        
                          </span>
                          <span class="rating">
                            <a href="#">3 Reviews</a>
                          </span>
                          <div class="clear"></div>
                          <p>{{$product->description}}</p>
                          <a href="#" class="btn btn-dark btn-md left"><span>Add to Cart</span></a>
                          <div class="product-add-to-wishlist">
                            <a href="#"><i class="fa fa-heart"></i></a>
                          </div>
                        </div>                      
  
                      </div>
                    </div> <!-- end product -->
                    @endforeach
  
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
                    <input type="text" id="amount">
                    <a href="#" class="btn btn-sm btn-stroke"><span>Filter</span></a>
                  </p>
                </div>
  
                <!-- Color -->
                <div class="widget filter-by-color">
                  <h3 class="widget-title heading uppercase relative bottom-line full-grey">Color</h3>
                  <ul class="color-select list-dividers">
                    @foreach ($products as $product)
                      @foreach ($product_colors as $color)
                        @if ($product->id == $color->product_id)
                          <li>
                            <input type="checkbox" class="input-checkbox" id="{{$color->color->color_name}}-color" name="{{$color->color->color_name}}-color">
                            <label for="{{$color->color->color_name}}-color" class="checkbox-label">{{$color->color->color_name}}</label>
                          </li>
                        @endif  
                      @endforeach
                    @endforeach
                   
                  </ul>
                </div>
  
                <!-- Size -->
                <div class="widget filter-by-size">
                  <h3 class="widget-title heading uppercase relative bottom-line full-grey">Size</h3>
                  <ul class="size-select list-dividers">
                    @foreach ($products as $product)
                      @foreach ($product_colors as $color)
                        @if ($product->id == $color->product_id)
                          @foreach ($product_sizes as $size)
                            @if ($size->product_color_id == $color->id)
                              <li>
                                <input type="checkbox" class="input-checkbox" id="{{$size->size->size}}-size" name="{{$size->size->size}}-size">
                                <label for="{{$size->size->size}}-size" class="checkbox-label">{{$size->size->size}}</label>
                              </li>
                            @endif                 
                          @endforeach
                        @endif
                      @endforeach
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
                    $explode_tags = explode(",", $category->tags);
                  @endphp
                  @foreach ($explode_tags as $tag)
                    <a href="{{route('product.tag',$tag)}}">{{$tag ?? ''}}</a>
                  @endforeach
                  
                </div>
  
              </aside> <!-- end sidebar -->
  
            </div> <!-- end row -->
          </div> <!-- end container -->
        </section> <!-- end catalog -->
  
@endsection
  