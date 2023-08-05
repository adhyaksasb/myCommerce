@php
    use App\Models\Product;
    use App\Models\ProductsAttribute;
    $cartItems = getCartItems();
    $total = 0
@endphp
<div class="mini-cart-wrapper">
    <div class="mini-cart">
    <div class="mini-cart-header">
        YOUR CART
        <button
        type="button"
        class="button ion ion-md-close"
        id="mini-cart-close"
        ></button>
    </div>
    <ul class="mini-cart-list">
        @foreach($cartItems as $item)
        @php
            $price = Product::getDiscountAttributePrice($item['product_id'],$item['size']);
            $itemStock = ProductsAttribute::getProductStock($item['product_id'],$item['size']);
            $subtotal = $price['final_price'] * $item['quantity'];
            $total += $subtotal;
        @endphp
        <li class="clearfix">
        <a href="{{url($item['product']['product_url'].'/'.$item['product']['id'])}}">
            <img src="{{asset('front/images/product_images/small/'.$item['product']['product_image'])}}" alt="Product" />
            <span class="mini-item-name">{{ $item['product']['product_name']}} - {{ $item['size'] }}</span>
            <span class="mini-item-price">${{ $price['final_price'] }}</span>
            <span class="mini-item-quantity"> x {{$item['quantity']}} </span>
        </a>
        </li>
        @endforeach
    </ul>
    <div class="mini-shop-total clearfix">
        <span class="mini-total-heading float-left">Total:</span>
        <span class="mini-total-price float-right">${{$total}}</span>
    </div>
    <div class="mini-action-anchors">
        <a href="{{ url('cart') }}" class="cart-anchor">View Cart</a>
        <a href="{{ url('checkout') }}" class="checkout-anchor">Checkout</a>
    </div>
    </div>
</div>