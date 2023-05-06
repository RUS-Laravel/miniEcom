<table class="table table-bordered mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>Order ID</th>
            <th>Date</th>
            <th>Payment Status</th>
            <th>Total</th>
            <th>Payment Type</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><span class="">#{{ $item->no ?? '--' }}</span></td>
                <td>{{ $item->created_at->format('M d, Y H:i:s') ?? "" }}</td>
                <td><span class="badge badge-soft-info">{{ $item->payment_status ?? '--' }}</span></td>
                <td>{{ $item->total }}</td>
                <td><span class="badge badge-soft-info">{{ $item->payment_type ?? '--' }}</span></td>
                <td><span class="badge badge-soft-{{ $item->status == 1 ? 'success' : 'danger' }}">{{ $item->status ?? "" }}</td>
                <td>

                    <button type="button" class="btn btn-soft-warning waves-effect waves-light">
                        <a href="#">Detail</a>
                    </button>
                    <button type="button" class="btn btn-soft-danger waves-effect waves-light"
                            data-control="delete-button" data-id="{{ $item->id }}"
                            data-url="#">Delete
                    </button>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
