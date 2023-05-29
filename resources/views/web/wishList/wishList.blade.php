@extends('web.layouts.master')
@section('title', __('WishList'))
@section('content')
<!-- Page Title -->
<form action="{{ route('cart.addToCart') }}" method="POST">
<section class="page-title text-center bg-light">
  <div class="container relative clearfix">
      <div class="title-holder">
        <div class="title-text">
          <h1 class="uppercase">Wish List</h1>
          <ol class="breadcrumb">
            <li>
              <a href="{{route('web.index')}}">Home</a>
            </li>
           
            <li class="active">
              @section('title', __('WishList'))
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
             
            </div>
  
            <div class="row">
              <div class="col-md-12 catalogue-col right mb-50">
                <div class="shop-catalogue grid-view">
                  
                  <div class="row items-grid" data-control="category-data-table">
                    @foreach ($products as $product)
                        
                    <div class="col-md-4 col-xs-6 product product-grid">
                        <div class="product-item clearfix">
                          <div class="product-img hover-trigger">
                            <a href="{{ route('product.detail', [
                                'slug' => $product->product->slug,
                                'id' => $product->product->id,
                            ]) }}">
                              <img src="{{url('img/shop/shop_item_1.jpg')}}" alt="">
                              <img src="{{url('img/shop/shop_item_back_1.jpg')}}" alt="" class="back-img">
                            </a>
                            @if ($product->product->discount)
                                <div class="product-label">
                                <span class="sale">sale</span>
                                </div>
                            @endif
                            <div class="hover-2">                    
                              <div class="product-actions">
                                <a href="javascript:void(0)" class="product-add-to-wishlist" data-url="{{ route('product.add_wishlist', $product->product->id) }}" data-insert="wishList">
                                  <i class="fa fa-heart"></i>
                                </a>
                              </div>                        
                            </div>
                            <a href="{{ route('product.detail', [
                                'slug' => $product->product->slug,
                                'id' => $product->product->id,
                            ]) }}" class="product-quickview">Quick View</a>
                          </div>
    
                          <div class="product-details">
                            <h3 class="product-title">
                                <a href="{{ route('product.detail', [
                                    'slug' => $product->product->slug,
                                    'id' => $product->product->id,
                                ]) }}">{{$product->product->title}}</a>
                            </h3>
                            <span class="category">
                                <a href="{{$product->product->category_id}}">{{$product->product->category->name}}</a>
                            </span>
                          </div>
    
                          <span class="price">
                            @if ($product->product->discount)
                            <del>
                              <span>{{$product->product->price_pretty}}</span>
                            </del>
                            @endif
                            <ins>
                              <span class="amount">{{$product->product->discount_price}}</span>
                            </ins>                        
                          </span>
    
                          <div class="product-description">
                            <h3 class="product-title">
                                <a href="{{ route('product.detail', [
                                    'slug' => $product->product->slug,
                                    'id' => $product->product->id,
                                ]) }}">{{$product->product->title}}</a>
                            </h3>
                            <span class="price">
                                @if ($product->product->discount)
                                <del>
                                  <span>{{$product->product->price_pretty}}</span>
                                </del>
                              @endif
                              
                              <ins>
                                <span class="amount">{{$product->product->discount_price}}</span>
                              </ins>                         
                            </span>
                            <span class="rating">
                                @for ($i = 1; $i <= $product->product->review_rating->star_rating; $i++)
                                <a href="javascript:void(0)"></a>
                                @endfor
                            </span>
                            <div class="clear"></div>
                            <p>{{$product->product->description}}</p>
                            <input type="hidden" name="id" value="{{ $product->product->id }}">
                            <button type="submit" class="btn btn-dark btn-lg add-to-cart"><span>Add to Cart</span></button>

                            <div class="product-add-to-wishlist">
                                <a href="javascript:void(0)" data-url="{{ route('product.add_wishlist', $product->product->id) }}" data-insert="wishList"><i class="fa fa-heart"></i></a>
                            </div>
                          </div>                      
    
                        </div>
                      </div>
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
  
  
            </div> <!-- end row -->
          </div> <!-- end container -->
        </section> <!-- end catalog -->
    </form>
@endsection
@push('js')
  <script>


         //Add WishList
        
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
  