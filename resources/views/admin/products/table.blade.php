<table class="table table-bordered mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Product Image</th>
            <th>Title</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Total</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td><span class="badge badge-soft-info">{{ $item->category->name ?? 'Parent Category' }}</span></td>
            <td>
                @if ($item->images->count())
                    @foreach ($item->images as $image)
                        <img src="{{ url($image->path . $image->name) }}" alt="{{$image->name}}" width="30px" height="30px">
                    @endforeach
                @endif
            </td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->stock }}</td>
            <td>{{ $item->total_formatted }}</td>
            <td><span class="badge badge-soft-{{ $item->status == 1 ? 'success' : 'danger' }}">{{ $item->status == 1 ? 'Active' : 'Passive' }}</td>
            <td>

                <button type="button" class="btn btn-soft-success waves-effect waves-light">        
                    <a href="{{ route('admin.products.detail', $item->id) }}">Detail</a>
                </button>
                <button type="button" class="btn btn-soft-warning waves-effect waves-light">        
                    <a href="{{ route('admin.products.edit', $item->id) }}">Edit</a>
                </button>
                <button type="button" class="btn btn-soft-danger waves-effect waves-light"
                        data-control="delete-button" data-id="{{ $item->id }}"
                        data-url="{{ route('admin.products.delete', $item->id) }}">Delete
                </button>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
