@php 
use App\Models\ProductsFilter;
$productFilters = ProductsFilter::productFilters();
@endphp

<div class="col-lg-3 col-md-3 col-sm-12">
    <!-- Fetch-Categories-from-Root-Category  -->
    <div class="fetch-categories">
        <h3 class="title-name">Browse Categories</h3>
        <!-- Level 1 -->
        <h3 class="fetch-mark-category">
            <a href="listing.html">T-Shirts
                <span class="total-fetch-items">(5)</span>
            </a>
        </h3>
        <ul>
            <li>
                <a href="shop-v3-sub-sub-category.html">Casual T-Shirts
                    <span class="total-fetch-items">(3)</span>
                </a>
            </li>
            <li>
                <a href="listing.html">Formal T-Shirts
                    <span class="total-fetch-items">(2)</span>
                </a>
            </li>
        </ul>
        <!-- //end Level 1 -->
        <!-- Level 2 -->
        <h3 class="fetch-mark-category">
            <a href="listing.html">Shirts
                <span class="total-fetch-items">(5)</span>
            </a>
        </h3>
        <ul>
            <li>
                <a href="shop-v3-sub-sub-category.html">Casual Shirts
                    <span class="total-fetch-items">(3)</span>
                </a>
            </li>
            <li>
                <a href="listing.html">Formal Shirts
                    <span class="total-fetch-items">(2)</span>
                </a>
            </li>
        </ul>
        <!-- //end Level 2 -->
    </div>
    <!-- Fetch-Categories-from-Root-Category  /- -->
    <!-- Filters -->
    <!-- Filter-Size -->
    @php
        $getSizes = ProductsFilter::getSizes($url);
        sort($getSizes);
    @endphp
    <div class="facet-filter-associates">
        <h3 class="title-name">Size</h3>
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                @foreach($getSizes as $key => $size)
                <input type="checkbox" class="check-box size" name="size[]" id="size-{{ $key }}" value="{{ $size }}">
                <label class="label-text" for="size-{{ $key }}">{{ $size }}
                    {{-- <span class="total-fetch-items">(2)</span> --}}
                </label>
                @endforeach
            </div>
        </form>
    </div>
    <!-- Filter-Size -->
    <!-- Filter-Color -->
    @php
        $getColors = ProductsFilter::getColors($url);
        sort($getColors);
    @endphp
    <div class="facet-filter-associates">
        <h3 class="title-name">Color</h3>
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                @foreach($getColors as $key => $color)
                <input type="checkbox" class="check-box color" name="color[]" id="color-{{ $key }}" value="{{ $color }}">
                <label class="label-text" for="color-{{ $key }}">{{ $color }}
                    {{-- <span class="total-fetch-items">(1)</span> --}}
                </label>
                @endforeach
            </div>
        </form>
    </div>
    <!-- Filter-Color /- -->
    <!-- Filter-Brand -->
    @php
        $getBrands = ProductsFilter::getBrands($url);
        sort($getBrands);
    @endphp
    <div class="facet-filter-associates">
        <h3 class="title-name">Brand</h3>
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                @foreach ($getBrands as $key => $brand)
                <input type="checkbox" class="check-box brand" name="brand[]" id="brand-{{ $key }}" value="{{ $brand['id'] }}">
                <label class="label-text" for="brand-{{ $key }}">{{ $brand['name'] }}
                    {{-- <span class="total-fetch-items">(0)</span> --}}
                </label>
                @endforeach
            </div>
        </form>
    </div>
    <!-- Filter-Brand /- -->
    <!-- Dynamic-Custom-Filter -->
    @foreach($productFilters as $productFilter)
    @php 
    $filterAvailable = ProductsFilter::filterAvailable($productFilter['id'],$productDetails['categoryDetails']['id']) ;
    @endphp
    @if($filterAvailable=="Yes")
    @if(count($productFilter['filter_values']))
    <div class="facet-filter-associates">
        <h3 class="title-name">{{$productFilter['filter_name']}}</h3>
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                @foreach($productFilter['filter_values'] as $value)
                <input type="checkbox" name="{{ $productFilter['filter_column'] }}[]" class="check-box {{$productFilter['filter_column']}}" id="{{$value['filter_value']}}" value="{{$value['filter_value']}}">
                <label class="label-text" for="{{$value['filter_value']}}">{{$value['filter_value']}}
                    {{-- <span class="total-fetch-items">(0)</span> --}}
                </label>
                @endforeach
            </div>
        </form>
    </div>
    @endif
    @endif
    @endforeach
    <!-- Dynamic-Custom-Filter /- -->
    <!-- Filter-Price -->
    <div class="facet-filter-by-price">
        <h3 class="title-name">Price</h3>
        <form class="facet-form" action="#" method="post">
            <!-- Final-Result -->
            <div class="amount-result clearfix">
                <div class="price-from" id="price-min">$0</div>
                <div class="price-to" id="price-max">$10000</div>
            </div>
            <!-- Final-Result /- -->
            <!-- Range-Slider  -->
            <div class="price-filter"></div>
            <!-- Range-Slider /- -->
            <!-- Range-Manipulator -->
            <div class="price-slider-range" id="priceRange" data-min="0" data-max="10000" data-default-low="0" data-default-high="10000" data-currency="$">
            </div>
            <!-- Range-Manipulator /- -->
            <button type="button" class="button button-primary" id="priceFilter">Filter</button>
        </form>
    </div>
    <!-- Filter-Price /- -->
    <!-- Filter-Free-Shipping -->
    <div class="facet-filter-by-shipping">
        <h3 class="title-name">Shipping</h3>
        <form class="facet-form" action="#" method="post">
            <input type="checkbox" class="check-box" id="cb-free-ship">
            <label class="label-text" for="cb-free-ship">Free Shipping</label>
        </form>
    </div>
    <!-- Filter-Free-Shipping /- -->
    <!-- Filter-Rating -->
    <div class="facet-filter-by-rating">
        <h3 class="title-name">Rating</h3>
        <div class="facet-form">
            <!-- 5 Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:76px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">(0)</span>
            </div>
            <!-- 5 Stars /- -->
            <!-- 4 & Up Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:60px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">& Up (5)</span>
            </div>
            <!-- 4 & Up Stars /- -->
            <!-- 3 & Up Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:45px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">& Up (0)</span>
            </div>
            <!-- 3 & Up Stars /- -->
            <!-- 2 & Up Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:30px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">& Up (0)</span>
            </div>
            <!-- 2 & Up Stars /- -->
            <!-- 1 & Up Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:15px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">& Up (0)</span>
            </div>
            <!-- 1 & Up Stars /- -->
        </div>
    </div>
    <!-- Filter-Rating -->
    <!-- Filters /- -->
</div>