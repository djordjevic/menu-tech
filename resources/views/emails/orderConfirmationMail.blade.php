<!DOCTYPE html>
<html>
<head>
    <title>MyExchanger - order Confirmation</title>
</head>
<body>

<p>Order has been created.</p>
<p>Email: {{ $order['email'] }}</p>
<p>Foreign currency: {{ $order['swift_code'] }}</p>
<p>Exchange rate: {{ $order['exchange_rate'] }}</p>
<p>Srucharge percent: {{ $order['surcharge_percent'] }}</p>
<p>Foreign currency amount: {{ $order['foreign_currency_amount'] }}</p>
<p>Total paid amount: {{ $order['total_paid_amount'] }}</p>
<p>Email: {{ $order['email'] }}</p>
<p>Discount percent: {{ $order['discount_percent'] }}</p>
<p>Discount amount: {{ $order['discount_amount'] }}</p>
<p>Created: {{ date('d.M.Y H:i', strtotime($order['created_at'])) }}</p>

</body>
</html>
