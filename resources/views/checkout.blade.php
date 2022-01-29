<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order - Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
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
                    <tr>
                        <td>Taco</td>
                        <td>$2.50</td>
                        <td>1x</td>
                        <td>$2.50</td>
                    </tr>
                    <tr>
                        <td>Pizza</td>
                        <td>$3.50</td>
                        <td>2x</td>
                        <td>$7.00</td>
                    </tr>
                    <tr>
                        <td>Soup</td>
                        <td>$2.00</td>
                        <td>3x</td>
                        <td>$6.00</td>
                    </tr>
                </tbody>
            </table>

            <div>
                Total: $15.50
            </div>


            <button type="submit" class="btn btn-primary btn-lg float-end">Submit Order</button>

        </div>

    </div>
</body>
</html>
