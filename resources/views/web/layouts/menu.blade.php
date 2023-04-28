<div class="collapse navbar-collapse text-center" id="navbar-collapse">
                  
    <ul class="nav navbar-nav">

      <li class="dropdown">
        <a href="{{route('web.index')}}">Home</a>
        <i class="fa fa-angle-down dropdown-trigger"></i>
      </li>

      @foreach ($cats as $category)
      <li class="dropdown">
        <a href="#">{{$category->name}}</a>
        <i class="fa fa-angle-down dropdown-trigger"></i>
        @isset($category->categories)
        <ul class="dropdown-menu megamenu-wide">
          @foreach ($category->categories as $cat)
          
            <div class="megamenu-wrap container">
              <div class="row">
                  <div class="col-md-3 megamenu-item">
                    <ul class="menu-list">
                      <li>
                        <span>{{$cat->name}}</span>
                             @foreach ($cat->categories as $c )
                              <li><a href="{{route('catalog.show', $c->id)}}">{{$c->name}}</a></li>
                             @endforeach                       

                      </li>    
                    </ul>
                  </div>

              </div> 
            </div>
          
          @endforeach
        </ul>
        @endisset
        
      </li>
      @endforeach
     
      <li class="mobile-links hidden-lg hidden-md">
        <a href="#">My Account</a>
      </li>

      <!-- Mobile search -->
      <li id="mobile-search" class="hidden-lg hidden-md">
        <form method="get" class="mobile-search">
          <input type="search" class="form-control" placeholder="Search...">
          <button type="submit" class="search-button">
            <i class="fa fa-search"></i>
          </button>
        </form>
      </li>

    </ul> <!-- end menu -->
  </div> <!-- end collapse -->