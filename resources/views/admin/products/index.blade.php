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

<h1>Products</h1>

<a href="{{ route('admin.products.create') }}">Create New Product</a>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>SKU</th>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ number_format($product->unit_price / 100, 2) }} BGN</td>
            <td>
                <a href="{{ route('admin.products.edit', $product) }}">Edit</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this product?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>