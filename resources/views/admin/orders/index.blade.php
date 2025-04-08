<div style="margin: 30px 0;">
    <a href="/admin" style="
        display: inline-block;
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    ">
        ← Back
    </a>
</div>

<h1>Orders</h1>

@if (session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Status</th>
            <th>Total</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($orders as $order)
        <tr>
            <td>#{{ $order->id }}</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>{{ number_format($order->total_price / 100, 2) }} BGN</td>
            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
            <td>
                <a href="{{ route('admin.orders.show', $order) }}">View</a> |
                <a href="{{ route('admin.orders.edit', $order) }}">Edit</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No orders found.</td>
        </tr>
        @endforelse
    </tbody>
</table>