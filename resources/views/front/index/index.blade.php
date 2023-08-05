@php use App\Models\Product; @endphp
@extends('front.layout.layout')
@section('content')
<!-- Main-Slider -->
<div class="default-height ph-item">
    <div class="slider-main owl-carousel">
        @foreach($sliderBanners as $banner)
        <div class="bg-image">
            <div class="slide-content">
                <h1><a @if(!empty($banner['url'])) href="{{ url('discovery/'.$banner['url']) }}" @else href="javascript:;" @endif><img src="{{ asset('front/images/banner_images/'.$banner['image']) }}" /></a></h1>
                <h2>{{ $banner['title'] }}</h2>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Main-Slider /- -->
@if(isset($fixedBanners[0]['image']))
<!-- Banner-Layer -->
<div class="banner-layer-top">
    <div class="container">
        <div class="image-banner">
            <a
                target="_blank"
                rel="nofollow"
                href="{{url($fixedBanners[0]['url'])}}"
                class="mx-auto banner-hover effect-dark-opacity"
                >
            <img
                class="img-fluid"
                src="{{ asset('front/images/banner_images/'.$fixedBanners[0]['image'])}}"
                alt="{{url($fixedBanners[0]['alt'])}}"
                />
            </a>
        </div>
    </div>
</div>
<!-- Banner-Layer /- -->
@endif
<!-- Top Collection -->
<section class="section-maker">
    <div class="container">
        <div class="sec-maker-header text-center">
            <h3 class="sec-maker-h3">TOP COLLECTION</h3>
            <ul class="nav tab-nav-style-1-a justify-content-center">
                <li class="nav-item">
                    <a
                        class="nav-link active"
                        data-toggle="tab"
                        href="#men-latest-products"
                        >New Arrivals</a
                        >
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#men-best-selling-products"
                        >Best Sellers</a
                        >
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#discounted-products"
                        >Discounted Products</a
                        >
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#men-featured-products"
                        >Featured Products</a
                        >
                </li>
            </ul>
        </div>
        <div class="wrapper-content">
            <div class="outer-area-tab">
                <div class="tab-content">
                    <div class="tab-pane active show fade" id="men-latest-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach($newProducts as $product)
                                @php 
                                $brandName =  str_replace([' ','&'], '-', $product['brand']['name']);
                                @endphp
                                <div class="item">
                                    <div class="image-container">
                                        <a
                                            class="item-img-wrapper-link"
                                            href="{{ url($product['product_url'].'/'.strtolower($product['id']))}}"
                                            >
                                            @if(!empty($product['product_image']) && file_exists('front/images/product_images/small/'.$product['product_image']))
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('front/images/product_images/small/'.$product['product_image']) }}"
                                            alt="Product"
                                            />
                                            @else
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('front/images/product_images/small/NO IMAGE.png') }}"
                                            alt="Product"
                                            />
                                            @endif
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a
                                                class="item-quick-look"
                                                data-toggle="modal"
                                                href="#quick-view"
                                                >Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)"
                                                >Mail</a
                                                >
                                            <a
                                                class="item-addwishlist"
                                                href="javascript:void(0)"
                                                >Add to Wishlist</a
                                                >
                                            <a class="item-addCart" href="javascript:void(0)"
                                                >Add to Cart</a
                                                >
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="brands/{{ strtolower($brandName) }}"
                                                        >{{ $product['brand']['name']}}</a
                                                        >
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url($product['product_url'].'/'.strtolower($product['id']))}}">{{ $product['product_name'] }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div
                                                    class="star"
                                                    title="0 out of 5 - based on 0 Reviews"
                                                    >
                                                    <span style="width: 0"></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>

                                        @if($product['product_discount']>0)
                                        <div class="price-template">
                                            <div class="item-new-price">${{ $product['final_price']}}</div>
                                            <div class="item-old-price">${{ $product['product_price'] }}</div>
                                        </div>
                                        @else
                                        <div class="price-template">
                                            <div class="item-new-price">${{ $product['product_price'] }}</div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag new">
                                        <span>NEW</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane show fade" id="men-best-selling-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach($bestSellers as $product)
                                @php 
                                $brandName =  str_replace([' ','&'], '-', $product['brand']['name']);
                                @endphp
                                <div class="item">
                                    <div class="image-container">
                                        <a
                                            class="item-img-wrapper-link"
                                            href="{{ url($product['product_url'].'/'.strtolower($product['id']))}}"
                                            >
                                            @if(!empty($product['product_image']) && file_exists('front/images/product_images/small/'.$product['product_image']))
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('front/images/product_images/small/'.$product['product_image']) }}"
                                            alt="Product"
                                            />
                                            @else
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('front/images/product_images/small/NO IMAGE.png') }}"
                                            alt="Product"
                                            />
                                            @endif
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a
                                                class="item-quick-look"
                                                data-toggle="modal"
                                                href="#quick-view"
                                                >Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)"
                                                >Mail</a
                                                >
                                            <a
                                                class="item-addwishlist"
                                                href="javascript:void(0)"
                                                >Add to Wishlist</a
                                                >
                                            <a class="item-addCart" href="javascript:void(0)"
                                                >Add to Cart</a
                                                >
                                        </div>
                                    </div>

                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="brands/{{ strtolower($brandName) }}"
                                                        >{{ $product['brand']['name']}}</a
                                                        >
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url($product['product_url'].'/'.strtolower($product['id']))}}">{{ $product['product_name'] }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div
                                                    class="star"
                                                    title="0 out of 5 - based on 0 Reviews"
                                                    >
                                                    <span style="width: 0"></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>

                                        @if($product['product_discount']>0)
                                        <div class="price-template">
                                            <div class="item-new-price">${{ $product['final_price']}}</div>
                                            <div class="item-old-price">${{ $product['product_price'] }}</div>
                                        </div>
                                        @else
                                        <div class="price-template">
                                            <div class="item-new-price">${{ $product['product_price'] }}</div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag sale">
                                        <span>Sale</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="discounted-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach($discountedProducts as $product)
                                @php 
                                $brandName =  str_replace([' ','&'], '-', $product['brand']['name']);
                                @endphp
                                <div class="item">
                                    <div class="image-container">
                                        <a
                                            class="item-img-wrapper-link"
                                            href="{{ url($product['product_url'].'/'.strtolower($product['id']))}}"
                                            >
                                            @if(!empty($product['product_image']) && file_exists('front/images/product_images/small/'.$product['product_image']))
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('front/images/product_images/small/'.$product['product_image']) }}"
                                            alt="Product"
                                            />
                                            @else
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('front/images/product_images/small/NO IMAGE.png') }}"
                                            alt="Product"
                                            />
                                            @endif
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a
                                                class="item-quick-look"
                                                data-toggle="modal"
                                                href="#quick-view"
                                                >Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)"
                                                >Mail</a
                                                >
                                            <a
                                                class="item-addwishlist"
                                                href="javascript:void(0)"
                                                >Add to Wishlist</a
                                                >
                                            <a class="item-addCart" href="javascript:void(0)"
                                                >Add to Cart</a
                                                >
                                        </div>
                                    </div>

                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="brands/{{ strtolower($brandName) }}"
                                                        >{{ $product['brand']['name']}}</a
                                                        >
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url($product['product_url'].'/'.strtolower($product['id']))}}">{{ $product['product_name'] }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div
                                                    class="star"
                                                    title="4.5 out of 5 - based on 23 Reviews"
                                                    >
                                                    <span style="width: 67px"></span>
                                                </div>
                                                <span>(23)</span>
                                            </div>
                                        </div>

                                        @if($product['product_discount']>0)
                                        <div class="price-template">
                                            <div class="item-new-price">${{ $product['final_price']}}</div>
                                            <div class="item-old-price">${{ $product['product_price'] }}</div>
                                        </div>
                                        @else
                                        <div class="price-template">
                                            <div class="item-new-price">${{ $product['product_price'] }}</div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag discount">
                                        <span>-{{ $product['product_discount'] }}%</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="men-featured-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach($featuredProducts as $product)
                                @php 
                                $brandName =  str_replace([' ','&'], '-', $product['brand']['name']);
                                @endphp
                                <div class="item">
                                    <div class="image-container">
                                        <a
                                            class="item-img-wrapper-link"
                                            href="{{ url($product['product_url'].'/'.strtolower($product['id']))}}"
                                            >
                                            @if(!empty($product['product_image']) && file_exists('front/images/product_images/small/'.$product['product_image']))
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('front/images/product_images/small/'.$product['product_image']) }}"
                                            alt="Product"
                                            />
                                            @else
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('front/images/product_images/small/NO IMAGE.png') }}"
                                            alt="Product"
                                            />
                                            @endif
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a
                                                class="item-quick-look"
                                                data-toggle="modal"
                                                href="#quick-view"
                                                >Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)"
                                                >Mail</a
                                                >
                                            <a
                                                class="item-addwishlist"
                                                href="javascript:void(0)"
                                                >Add to Wishlist</a
                                                >
                                            <a class="item-addCart" href="javascript:void(0)"
                                                >Add to Cart</a
                                                >
                                        </div>
                                    </div>

                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="brands/{{ strtolower($brandName) }}"
                                                        >{{ $product['brand']['name']}}</a
                                                        >
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url($product['product_url'].'/'.strtolower($product['id']))}}">{{ $product['product_name'] }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div
                                                    class="star"
                                                    title="4.5 out of 5 - based on 23 Reviews"
                                                    >
                                                    <span style="width: 25px"></span>
                                                </div>
                                                <span>(23)</span>
                                            </div>
                                        </div>

                                        @if($product['product_discount']>0)
                                        <div class="price-template">
                                            <div class="item-new-price">${{ $product['final_price']}}</div>
                                            <div class="item-old-price">${{ $product['product_price'] }}</div>
                                        </div>
                                        @else
                                        <div class="price-template">
                                            <div class="item-new-price">${{ $product['product_price'] }}</div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag hot">
                                        <span>HOT</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Top Collection /- -->
@if(isset($fixedBanners[0]['image']))
<!-- Banner-Layer -->
<div class="banner-layer-top">
    <div class="container">
        <div class="image-banner">
            <a
                target="_blank"
                rel="nofollow"
                href="{{url($fixedBanners[0]['url'])}}"
                class="mx-auto banner-hover effect-dark-opacity"
                >
            <img
                class="img-fluid"
                src="{{ asset('front/images/banner_images/'.$fixedBanners[0]['image'])}}"
                alt="{{url($fixedBanners[0]['alt'])}}"
                />
            </a>
        </div>
    </div>
</div>
<!-- Banner-Layer /- -->
@endif
<!-- Site-Priorities -->
<section class="app-priority">
    <div class="container">
        <div class="priority-wrapper u-s-p-b-80">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-md-star"></i>
                        </div>
                        <h2>Great Value</h2>
                        <p>
                            We offer competitive prices on our 100 million plus product
                            range
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-md-cash"></i>
                        </div>
                        <h2>Shop with Confidence</h2>
                        <p>
                            Our Protection covers your purchase from click to delivery
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-ios-card"></i>
                        </div>
                        <h2>Safe Payment</h2>
                        <p>
                            Pay with the world’s most popular and secure payment methods
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-md-contacts"></i>
                        </div>
                        <h2>24/7 Help Center</h2>
                        <p>
                            Round-the-clock assistance for a smooth shopping experience
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Site-Priorities /- -->
@endsection