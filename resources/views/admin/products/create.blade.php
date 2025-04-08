<div style="margin: 30px 0;">
    <a href="/admin/products" style="
        display: inline-block;
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    ">
        ← Back to Products
    </a>
</div>

<h1>Create Product</h1>

<form method="POST" action="{{ route('admin.products.store') }}">
    @csrf
    <label>SKU:</label><input type="text" name="sku"><br>
    <label>Name:</label><input type="text" name="name"><br>
    <label>Price (cents):</label><input type="number" name="unit_price"><br>
    <button type="submit">Save</button>
</form>
<a href="{{ route('admin.products.index') }}">← Back</a>