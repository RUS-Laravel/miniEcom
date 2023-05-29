
@foreach ($products as $product)
                      
                    <div class="col-md-4 col-xs-6 product product-grid">
                      <div class="product-item clearfix">
                        <div class="product-img hover-trigger">
                          <a href="{{ route('product.detail', [
                            'slug' => $product->slug,
                            'id' => $product->id,
                        ]) }}">
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
                              <a href="javascript:void(0)" class="product-add-to-wishlist" data-url="{{ route('product.add_wishlist', $product->id) }}" data-insert="wishList">
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
                            <a href="javascript:void(0)"></a>
                            
                          </span>
                          <div class="clear"></div>
                          <p>{{$product->description}}</p>
                          <form action="{{ route('cart.addToCart') }}" method="POST">
                          <input type="hidden" name="id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-dark btn-lg add-to-cart"><span>Add to Cart</span></button>
                        </form>
                          <div class="product-add-to-wishlist">
                            <a href="javascript:void(0)" data-url="{{ route('product.add_wishlist', $product->id) }}" data-insert="wishList"><i class="fa fa-heart"></i></a>
                          </div>
                        </div>                      
  
                      </div>
                    </div> <!-- end product -->
                    @endforeach

  