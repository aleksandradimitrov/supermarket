<div style="margin: 30px 0;">
    <a href="/admin/orders" style="
        display: inline-block;
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    ">
        ← Back to Orders
    </a>
</div>

<h1>Edit Order #{{ $order->id }}</h1>

<form method="POST" action="{{ route('admin.orders.update', $order) }}">
    @csrf
    @method('PUT')

    <label>Status:</label>
    <select name="status">
        <option value="created" @selected($order->status === 'created')>Created</option>
        <option value="completed" @selected($order->status === 'completed')>Completed</option>
        <option value="canceled" @selected($order->status === 'canceled')>Canceled</option>
    </select>

    <br>

    <button type="submit">Save Changes</button>
</form>