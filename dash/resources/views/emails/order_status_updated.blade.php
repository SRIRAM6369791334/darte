<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Order Status Update</title>
</head>

<body>
    <p>Hi {{ optional($order->orderAddress)->firstname ?? optional($order->customer)->first_name ?? 'Customer' }},</p>


    @if($status == '1' || $status == 'processing')
        <p><strong>Your order {{ $order->order_id_display }} is now being packed.</strong></p>
        <p>We’ll notify you once it is dispatched.</p>
    @elseif($status == '2' || $status == 'shipped')
        <p><strong>Your order {{ $order->order_id_display }} has been dispatched.</strong></p>
        <p>It is on the way!</p>
    @elseif($status == '3' || $status == 'out_for_delivery')
        <p><strong>Your order {{ $order->order_id_display }} is out for delivery.</strong></p>
        @if($order->delivery_person_name)
            <p><strong>Delivery Person:</strong> {{ $order->delivery_person_name }}</p>
            <p><strong>Contact:</strong> {{ $order->delivery_person_phone }}</p>
        @endif
        <p>Please keep your phone available for the delivery agent.</p>
    @elseif($status == '4' || $status == 'delivered')
        <p><strong>Your order {{ $order->order_id_display }} has been delivered.</strong></p>
        <p>Thank you for shopping with us!</p>
    @elseif($status == '5' || $status == 'ready_for_pickup')
        <p><strong>Your order {{ $order->order_id_display }} is ready for pickup by our courier partner.</strong></p>
        <p>It will be dispatched soon!</p>
    @else
        @php
            $fallbackTitle = [
                0 => 'Order Placed',
                6 => 'Returned',
                'return' => 'Returned',
            ][$status] ?? ucfirst($status);
        @endphp
        <p>Your order status has been updated to: <strong>{{ $fallbackTitle }}</strong>.</p>
    @endif

    <p>Regards,<br>Team Darte</p>
</body>

</html>
