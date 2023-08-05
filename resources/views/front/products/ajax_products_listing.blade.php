@php use App\Models\Product; @endphp
<div class="row product-container grid-style">
    @foreach($productListing as $product)
        @php 
            $brandUrl =  strtolower(str_replace([' ','&','/'], '-', $product['brand']['name']));
            $isProductNew = Product::isProductNew($product['id']);
        @endphp
    <div class="product-item col-lg-4 col-md-6 col-sm-6">
        <div class="item">
            <div class="image-container">
                <a class="item-img-wrapper-link" href="{{url($product['product_url'].'/'.$product['id'])}}">
                    @if(!empty($product['product_image']) && file_exists('front/images/product_images/small/'.$product['product_image']))
                        <img class="img-fluid" src="{{asset('front/images/product_images/small/'.$product['product_image'])}}" alt="Product">
                    @else
                        <img class="img-fluid" src="{{asset('front/images/product_images/small/NO IMAGE.png')}}" alt="Product">
                    @endif
                </a>
                <div class="item-action-behaviors">
                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                </div>
            </div>
            <div class="item-content">
                <div class="what-product-is">
                    <ul class="bread-crumb">
                        <li>
                            <a href="{{url('c/'.$product['category']['url'])}}">{{ $product['category']['category_name'] }}</a>
                        </li>
                    </ul>
                    <a class="item-brand" href="{{url('/'.$brandUrl) }}">{{$product['brand']['name']}}</a><br>
                    <h6 class="item-title">
                        <a href="{{url($product['product_url'].'/'.$product['id'])}}">{{ $product['product_name'] }}</a>
                    </h6>
                    <div class="item-description">
                        @if(!(empty($product['product_description'])))
                        <p>{{$product['product_description']}}
                        </p>
                        @else
                        <p>No Description</p>
                        @endif
                    </div>
                    <div class="item-stars">
                        <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                            <span style='width:67px'></span>
                        </div>
                        <span>(23)</span>
                    </div>
                </div>
                @if($product['product_discount']>0)
                <div class="price-template">
                    <div class="item-new-price">${{ $product['final_price'] }}</div>
                    <div class="item-old-price">${{ $product['product_price'] }}</div>
                </div>
                @else
                <div class="price-template">
                    <div class="item-new-price">${{ $product['product_price'] }}</div>
                </div>
                @endif
            </div>
            @if($isProductNew=="Yes")
            <div class="tag new">
                <span>NEW</span>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>
<!-- Shop-Pagination -->
@if(isset($_GET['sort']))
<div class="pagination-area">
    {{ $productListing->appends(['sort'=>$_GET['sort']])->links('front.products.pagination') }}
</div>
@else
<div class="pagination-area">
    {{ $productListing->links('front.products.pagination') }}
</div>
@endif
<!-- Shop-Pagination /- -->