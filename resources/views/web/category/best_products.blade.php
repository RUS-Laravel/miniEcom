<div class="products-widget">
                        <h3 class="widget-title heading uppercase relative bottom-line full-grey mb-30">Best Sellers</h3>
                        <ul class="product-list-widget">
                            @foreach ($bests as $best)
                                                           
                            <li class="clearfix">
                                <a href="shop-single.html">
                                    <img src="{{url('img/shop/shop_item_9.jpg')}}" alt="">
                                    <span class="product-title">{{$best->title}}</span>
                                </a>
                                <span class="price">
                                    <ins>
                                        <span class="amount"> {{$best->discount_price}} </span>
                                    </ins>
                                </span>
                            </li>
                            @endforeach
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