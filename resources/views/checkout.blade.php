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

    <h2>Cart</h2>
    <ul>
        @foreach ($cart as $item)
        <li>{{ $item }}</li>
        @endforeach
    </ul>

    <h3>Total: {{ number_format($total / 100, 2) }} BGN</h3>

    <form method="POST" action="/reset">
        @csrf
        <button type="submit">Reset Cart</button>
    </form>
</body>

</html>