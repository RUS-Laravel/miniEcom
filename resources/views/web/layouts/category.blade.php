<div class="widget categories">
    <h3 class="widget-title heading uppercase relative bottom-line full-grey">Categories</h3>
    <ul class="list-dividers">
     @foreach (app('cat_counts') as $category)
      <li class="active-cat">
        <a href="{{$category->id}}">{{$category->name}}</a><span>({{$category->products_count}})</span>
      </li>
     @endforeach
     
    </ul>
  </div>