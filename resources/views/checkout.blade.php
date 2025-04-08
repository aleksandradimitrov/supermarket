<!DOCTYPE html>
<html>

<head>
    <title>Supermarket Checkout</title>
</head>

<body>
    <h1>Scan Product</h1>

    <form method="POST" action="/scan">
        @csrf
        <input type="text" name="sku" placeholder="Enter SKU (A, B...)" maxlength="1" required>
        <button type="submit">Scan</button>
    </form>

    @if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <h2>Available Products</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>SKU</th>
                <th>Name</th>
                <th>Unit Price (BGN)</th>
                <th>Special Prices</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->unit_price / 100, 2) }}</td>
                <td>
                    @if ($product->specialPrices->isNotEmpty())
                    <ul>
                        @foreach ($product->specialPrices as $special)
                        <li>{{ $special->quantity }} for {{ number_format($special->special_price / 100, 2) }} BGN</li>
                        @endforeach
                    </ul>
                    @else
                    <em>None</em>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Cart</h2>
    <ul>
        @foreach ($cart as $item)
        <li>{{ $item }}</li>
        @endforeach
    </ul>

    <h3>Total: {{ number_format($total / 100, 2) }} BGN</h3>

    <div style="margin-top: 20px;">
        @if (!empty($cart))
        <form method="POST" action="/checkout" style="display: inline-block; margin-right: 10px;">
            @csrf
            <button type="submit">Place Order</button>
        </form>
        @endif

        <form method="POST" action="/reset" style="display: inline-block;">
            @csrf
            <button type="submit">Reset Cart</button>
        </form>
    </div>

    <div style="margin: 30px 0;">
        <a href="/admin" style="
        display: inline-block;
        background-color: #007BFF;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    ">
            Go to Admin Panel
        </a>
    </div>
</body>

</html>