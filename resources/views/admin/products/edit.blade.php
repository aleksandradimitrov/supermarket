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

<h1>Edit Product</h1>

<form method="POST" action="{{ route('admin.products.update', $product) }}">
    @csrf @method('PUT')
    <label>SKU:</label><input type="text" name="sku" value="{{ $product->sku }}"><br>
    <label>Name:</label><input type="text" name="name" value="{{ $product->name }}"><br>
    <label>Price (cents):</label><input type="number" name="unit_price" value="{{ $product->unit_price }}"><br>
    <h3>Special Prices</h3>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Quantity</th>
                <th>Special Price (in cents)</th>
                <th>Delete?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product->specialPrices as $index => $special)
            <tr>
                <td>
                    <input type="hidden" name="specials[{{ $index }}][id]" value="{{ $special->id }}">
                    <input type="number" name="specials[{{ $index }}][quantity]" value="{{ $special->quantity }}" required>
                </td>
                <td>
                    <input type="number" name="specials[{{ $index }}][special_price]" value="{{ $special->special_price }}" required>
                </td>
                <td>
                    <input type="checkbox" name="specials[{{ $index }}][delete]">
                </td>
            </tr>
            @endforeach

            {{-- Add 2 empty rows for new specials --}}
            @for ($i = 0; $i < 2; $i++)
                <tr>
                <td><input type="number" name="specials_new[{{ $i }}][quantity]"></td>
                <td><input type="number" name="specials_new[{{ $i }}][special_price]"></td>
                <td></td>
                </tr>
                @endfor
        </tbody>
    </table>
    <button type="submit">Update</button>
</form>
<a href="{{ route('admin.products.index') }}">← Back</a>