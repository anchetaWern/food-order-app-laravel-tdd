<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Food Order - Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>

</head>
<body>
    <div class="container-fluid mt-5">

        <div class="mx-auto" style="width: 450px;">


            <h6>Order Summary</h6>


            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($checkout_items as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>${{ $item['cost'] }}</td>
                        <td>{{ $item['qty'] }}x</td>
                        <td>${{ $item['subtotal'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                Total: ${{ $total }}
            </div>

            <form method="POST" action="/checkout">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg float-end">Submit Order</button>
            </form>
        </div>

    </div>
</body>
</html>
