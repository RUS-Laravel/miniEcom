<table class="table table-bordered mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>Parent</th>
            <th>Name</th>
            <th>Description Name</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><span class="badge badge-soft-info">{{ $item->parent->name ?? 'Parent Category' }}</span></td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td><span class="badge badge-soft-{{ $item->status == 1 ? 'success' : 'danger' }}">{{ $item->status == 1 ? 'Active' : 'Passive' }}</td>
                <td>
                    <button type="button" class="btn btn-soft-warning waves-effect waves-light"
                            data-control="edit-button" data-id="{{ $item->id }}"
                            data-url="{{ route('admin.categories.edit', $item->id) }}">Edit
                    </button>
                    <button type="button" class="btn btn-soft-danger waves-effect waves-light"
                            data-control="delete-button" data-id="{{ $item->id }}"
                            data-url="{{ route('admin.categories.delete', $item->id) }}">Delete
                    </button>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
