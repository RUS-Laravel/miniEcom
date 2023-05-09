<table class="table table-bordered mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>Size</th>
            <th>Size name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
           
            <td>{{ $item->size }}</td>
            <td>{{ $item->size_name }}</td>
            
            <td>

                <button type="button" class="btn btn-soft-warning waves-effect waves-light">        
                    <a href="{{ route('admin.sizes.edit', $item->id) }}">Edit</a>
                </button>
                <button type="button" class="btn btn-soft-danger waves-effect waves-light"
                        data-control="delete-button" data-id="{{ $item->id }}"
                        data-url="{{ route('admin.sizes.delete', $item->id) }}">Delete
                </button>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
