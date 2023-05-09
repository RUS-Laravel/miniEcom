<table class="table table-bordered mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>Product and Color</th>
            <th>Size</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            @foreach ($products_color as $product_color)
                @if ($item->product_color_id == $product_color->id)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            {{ $product_color->product->title ?? '' }}--{{$product_color->color->color_name}}
                        </td>
                        <td>{{ $item->size->size }}--{{ $item->size->size_name }}</td>                   
                        <td>
                            <button type="button" class="btn btn-soft-warning waves-effect waves-light">        
                                <a href="{{ route('admin.products.sizes.edit', $item->id) }}">Edit</a>
                            </button>
                            <button type="button" class="btn btn-soft-danger waves-effect waves-light"
                                    data-control="delete-button" data-id="{{ $item->id }}"
                                    data-url="{{ route('admin.products.sizes.delete', $item->id) }}">Delete
                            </button>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach

    </tbody>
</table>
