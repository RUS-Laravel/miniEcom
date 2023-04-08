<table class="table table-bordered mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>İs User</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->surname }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->is_user }}</td>
                <td>
                    <button type="button" class="btn btn-soft-warning waves-effect waves-light"
                            data-control="user-edit-button" data-id="{{ $item->id }}"
                            data-url="{{ route('admin.users.edit', $item->id) }}">Edit
                    </button>
                    @if (auth()->id() != $item->id)
                        <form class="d-inline" action="{{ route('admin.users.delete', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-soft-danger waves-effect waves-light">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
