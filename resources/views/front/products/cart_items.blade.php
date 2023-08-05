@php
    use App\Models\Product;
    use App\Models\ProductsAttribute;
    $total = 0;
@endphp
    <!-- Products-List-Wrapper -->
    <div class="table-wrapper u-s-m-b-60">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                @php
                    $price = Product::getDiscountAttributePrice($item['product_id'],$item['size']);
                    $itemStock = ProductsAttribute::getProductStock($item['product_id'],$item['size']);
                    $subtotal = $price['final_price'] * $item['quantity'];
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>
                        <div class="cart-anchor-image">
                            <a href="{{url($item['product']['product_url'].'/'.$item['product']['id'])}}">
                                <img src="{{asset('front/images/product_images/small/'.$item['product']['product_image'])}}" alt="Product">
                                <h6>{{ $item['product']['product_name']}} - {{ $item['size'] }}</h6>
                                @if($price['productAvailable'] == 0)
                                <h6 style="color:red;">Product Not Available</h6>
                                @endif
                                @if($item['quantity']>$itemStock)
                                <h6 style="color:red;">Only {{$itemStock}} Left</h6>
                                @endif
                                @if($price['discount']>0)
                                <h6 class="discount-tag">{{$price['discount']}}% OFF</h6>
                                @endif
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="cart-price">
                            @if($price['discount']>0)
                            <div class="price-template">
                                <div class="item-new-price">${{ $price['final_price'] }}</div>
                                <div class="item-old-price">${{ $price['product_price'] }}</div>
                            </div>
                            @else
                            <div class="price-template">
                                <div class="item-new-price">${{ $price['product_price'] }}</div>
                            </div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="cart-quantity">
                            <div class="quantity">
                                <input type="text" class="quantity-text-field quantityItem" cart-id={{ $item['id'] }} value="{{$item['quantity']}}">
                                <a class="plus-a updateCartItem" cart-id={{ $item['id'] }} qty="{{$item['quantity']}}" data-max="1000">&#43;</a>
                                <a class="minus-a updateCartItem" cart-id={{ $item['id'] }} qty="{{$item['quantity']}}" data-min="1">&#45;</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="cart-price">
                            ${{$subtotal}}
                        </div>
                    </td>
                    <td>
                        <div class="action-wrapper">
                            <button type="button" class="button button-outline-secondary fas fa-trash deleteCartItem" cart-id="{{$item['id']}}"></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Products-List-Wrapper /- -->
    <!-- Coupon -->
    <div class="coupon-continue-checkout u-s-m-b-60">
        <div class="coupon-area">
            <h6>Enter your coupon code if you have one.</h6>
            <div class="coupon-field">
                <form action="javascript:void(0);" id="applyCoupon" method="post" @if(Auth::check()) user= 1 @endif>@csrf
                    <label class="sr-only" for="code">Apply Coupon</label>
                    <input id="code" type="text" name="code" class="text-field" placeholder="Coupon Code" @if(Session::has('couponCode')) value="{{Session::get('couponCode')}}" disabled @endif>
                    @if(Session::has('couponCode'))
                    <button type="button" class="button dangerButton" id="removeCoupon">Remove Coupon</button>
                    @else
                    <button type="submit" class="button button-primary">Apply Coupon</button>
                    @endif
                </form>
            </div>
        </div>
        <div class="button-area">
            <a href="{{url('/')}}" class="continue">Continue Shopping</a>
            <a href="{{url('/checkout')}}" class="checkout">Proceed to Checkout</a>
        </div>
    </div>
    <!-- Coupon /- -->
<!-- Billing -->
<div class="calculation u-s-m-b-60">
    <div class="table-wrapper-2">
        <table>
            <thead>
                <tr>
                    <th colspan="2">Cart Totals</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                    </td>
                    <td>
                        <span class="calc-text">${{$total}}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Coupon Discount</h3>
                    </td>
                    <td>
                        <span class="calc-text couponDiscount">@if(Session::has('couponDiscount')) -${{Session::get('couponDiscount')}} @else -$0.00 @endif</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Grand Total</h3>
                    </td>
                    <td>
                        <span class="calc-text grandTotal">@if(Session::has('grandTotal')) ${{Session::get('grandTotal')}} @else ${{$total}} @endif</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Billing /- -->