<a href="/" style="
    display: inline-block;
    margin-top: 30px;
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
">← Back to Checkout</a>

<h1>Admin Panel</h1>

<ul>
    <li><a href="{{ route('admin.products.index') }}">Manage Products</a></li>
    <li><a href="{{ route('admin.orders.index') }}">Manage Orders</a></li>
</ul>