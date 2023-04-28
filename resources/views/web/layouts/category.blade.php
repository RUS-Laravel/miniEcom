<div class="widget categories">
    <h3 class="widget-title heading uppercase relative bottom-line full-grey">Categories</h3>
    <ul class="list-dividers">
     @foreach ($categories as $category)
      <li class="active-cat">
        <a href="{{$category->category_id}}">{{$category->category->name}}</a><span>({{$category->category->count()}})</span>
      </li>
     @endforeach
      
    </ul>
  </div>