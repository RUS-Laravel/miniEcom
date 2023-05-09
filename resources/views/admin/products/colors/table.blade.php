<table class="table table-bordered mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>Product</th>
            <th>Color </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->product->title ?? '' }}</span></td>
            <td>{{ $item->color->color_name ?? '' }}</span></td>
            <td>

                <button type="button" class="btn btn-soft-warning waves-effect waves-light">        
                    <a href="{{ route('admin.products.colors.edit', $item->id) }}">Edit</a>
                </button>
                <button type="button" class="btn btn-soft-danger waves-effect waves-light"
                        data-control="delete-button" data-id="{{ $item->id }}"
                        data-url="{{ route('admin.products.colors.delete', $item->id) }}">Delete
                </button>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
