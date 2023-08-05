@php
use App\Models\Section;
$sections = Section::sections();
$i = 0;
$arrayLength = count($sections);
$totalCartItems = totalCartItems();
$totalCartPrice = totalCartPrice();
// echo "<pre>"; print_r($sections); die;
@endphp

<header>
    <!-- Top-Header -->
    <div class="full-layer-outer-header">
      <div class="container clearfix">
        <nav>
          <ul class="primary-nav g-nav">
            <li>
              <a href="tel:+111222333">
                <i class="fas fa-phone u-c-brand u-s-m-r-9"></i>
                Telephone:+62 111-222-333</a
              >
            </li>
            <li>
              <a href="mailto:adhyaksasb@gmail.com">
                <i class="fas fa-envelope u-c-brand u-s-m-r-9"></i>
                E-mail: adhyaksasb@gmail.com
              </a>
            </li>
          </ul>
        </nav>
        <nav>
          <ul class="secondary-nav g-nav">
            <li>
              <a
                >@if(Auth::check()){{Auth::user()->name}} @else Login/Register @endif
                <i class="fas fa-chevron-down u-s-m-l-9"></i>
              </a>
              <ul class="g-dropdown" style="width: 200px">
                @if(Auth::check())
                <li>
                  <a href="{{ url('/user/settings') }}">
                    <i class="fas fa-user-alt u-s-m-r-9"></i>
                    Account Settings</a
                  >
                </li>
                <li>
                  <a href="wishlist.html">
                    <i class="far fa-heart u-s-m-r-9"></i>
                    My Wishlist</a
                  >
                </li>
                <li>
                  <a href="{{url('/checkout')}}">
                    <i class="far fa-check-circle u-s-m-r-9"></i>
                    Checkout</a
                  >
                </li>
                <li>
                  <a href="{{ url('/user/logout') }}">
                    <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                    Logout</a
                  >
                </li>
                @else
                <li>
                  <a href="cart.html">
                    <i class="fas fa-cog u-s-m-r-9"></i>
                    My Cart</a
                  >
                </li>
                <li>
                  <a href="{{ url('/user/login-register') }}">
                    <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                    Customer Login</a
                  >
                </li>
                <li>
                  <a href="{{ url('/vendor/login-register') }}">
                    <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                    Vendor Login</a
                  >
                </li>
                @endif
              </ul>
            </li>
            <li>
              <a
                >USD
                <i class="fas fa-chevron-down u-s-m-l-9"></i>
              </a>
              <ul class="g-dropdown" style="width: 90px">
                <li>
                  <a href="#" class="u-c-brand">($) USD</a>
                </li>
                <li>
                  <a href="#">(Rp) IDR</a>
                </li>
              </ul>
            </li>
            <li>
              <a
                >ENG
                <i class="fas fa-chevron-down u-s-m-l-9"></i>
              </a>
              <ul class="g-dropdown" style="width: 70px">
                <li>
                  <a href="#" class="u-c-brand">ENG</a>
                </li>
                <li>
                  <a href="#">ID</a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- Top-Header /- -->
    <!-- Mid-Header -->
    <div class="full-layer-mid-header">
      <div class="container">
        @if(Auth::check())
          @if(Auth::user()->email_verified == "No")
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Your email is not confirmed yet, please check your email.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        @endif
        @if(Session::has('success_message'))
        <br><br>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row clearfix align-items-center">
          <div class="col-lg-3 col-md-9 col-sm-6">
            <a href="{{ url('/') }}">
              {{-- <picture>
                <source media="(min-width: 1000px)" srcset="{{ asset('front/images/main-logo/logo.svg') }}">
                <source media="(min-width: 750px)" srcset="{{ asset('front/images/main-logo/logo.svg') }}">
                <img
                  src="{{ asset('front/images/main-logo/logo-mini.svg') }}"
                  alt="myCommerce"
                  class="brand-logo"
                />
              </picture> --}}
              <img
                src="{{ asset('front/images/main-logo/logo.svg') }}"
                alt="myCommerce"
                class="app-brand-logo"
              />
            </a>
          </div>
          <div class="col-lg-6 u-d-none-lg">
            <form class="form-searchbox">
              <label class="sr-only" for="search-landscape">Search</label>
              <input
                id="search-landscape"
                type="text"
                class="text-field"
                placeholder="Search in myCommerce"
              />
              <div class="select-box-position">
                <div class="select-box-wrapper select-hide">
                  <label class="sr-only" for="select-category"
                    >Choose category for search</label
                  >
                  <select class="select-box" id="select-category">
                    <option selected="selected" value="">All</option>
                    @foreach($sections as $section)
                    <option value="">{{ $section['name'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <button
                id="btn-search"
                type="submit"
                class="button button-primary fas fa-search"
              ></button>
            </form>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6">
            <nav>
              <ul class="mid-nav g-nav">
                <li class="u-d-none-lg">
                  <a href="index.html">
                    <i class="ion ion-md-home u-c-brand"></i>
                  </a>
                </li>
                <li class="u-d-none-lg">
                  <a href="wishlist.html">
                    <i class="far fa-heart"></i>
                  </a>
                </li>
                <li>
                  <a id="mini-cart-trigger">
                    <i class="ion ion-md-basket"></i>
                    <span class="item-counter totalCartItems">{{ $totalCartItems }}</span>
                    <span class="item-price totalCartPrice">${{ $totalCartPrice }}</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- Mid-Header /- -->
    <!-- Responsive-Buttons -->
    <div class="fixed-responsive-container">
      <div class="fixed-responsive-wrapper">
        <button
          type="button"
          class="button fas fa-search"
          id="responsive-search"
        ></button>
      </div>
      <div class="fixed-responsive-wrapper">
        <a href="wishlist.html">
          <i class="far fa-heart"></i>
          <span class="fixed-item-counter">4</span>
        </a>
      </div>
    </div>
    <!-- Responsive-Buttons /- -->
    <!-- Mini Cart -->
    <div id="appendHeaderCartItems">
      @include('front.layout.header_mini_cart')
    </div>
    <!-- Mini Cart /- -->
    <!-- Bottom-Header -->
    <div class="full-layer-bottom-header">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-3">
            <div class="v-menu v-close">
              <span class="v-title">
                <i class="ion ion-md-menu"></i>
                All Categories
                <i class="fas fa-angle-down"></i>
              </span>
              <nav>
                <div class="v-wrapper">
                  <ul class="v-list animated fadeIn">
                    @for($i=0; $i<4; $i++)
                    <li class="js-backdrop">
                      <a href="{{ url('c/'.$sections[$i]['url']) }}">
                        <i class="ion-ios-add-circle"></i>
                        {{ $sections[$i]['name'] }}
                        <i class="ion ion-ios-arrow-forward"></i>
                      </a>
                      <button class="v-button ion ion-md-add"></button>
                      <div class="v-drop-right" style="width: 700px">
                        <div class="row">
                          @foreach($sections[$i]['categories'] as $category)
                          <div class="col-lg-4">
                            <ul class="v-level-2">
                              <li>
                                <a href="{{url('c/'.$category['url']) }}">{{ $category['category_name'] }}</a>
                                <ul>
                                  @foreach($category['subcategories'] as $subcategory)
                                  <li>
                                    <a href="{{url('c/'.$subcategory['url']) }}"
                                      >{{ $subcategory['category_name'] }}</a
                                    >
                                  </li>
                                  @endforeach
                                </ul>
                              </li>
                            </ul>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </li>
                    @endfor
                    @for($i=4; $i<$arrayLength; $i++)
                    <li class="js-backdrop v-none" style="display: none">
                      <a href="{{ url('c/'.$sections[$i]['url']) }}">
                        <i class="ion ion-md-rocket"></i>
                        {{ $sections[$i]['name'] }}
                        <i class="ion ion-ios-arrow-forward"></i>
                      </a>
                      <button class="v-button ion ion-md-add"></button>
                      <div class="v-drop-right" style="width: 700px">
                        <div class="row">
                          @foreach($sections[$i]['categories'] as $category)
                          <div class="col-lg-4">
                            <ul class="v-level-2">
                              <li>
                                <a href="{{url('c/'.$category['url']) }}">{{ $category['category_name'] }}</a>
                                <ul>
                                  @foreach($category['subcategories'] as $subcategory)
                                  <li>
                                    <a href="{{url('c/'.$subcategory['url']) }}"
                                      >{{ $subcategory['category_name'] }}</a
                                    >
                                  </li>
                                  @endforeach
                                </ul>
                              </li>
                            </ul>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </li>
                    @endfor
                    <li>
                      <a class="v-more">
                        <i class="ion ion-md-add"></i>
                        <span>View More</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </nav>
            </div>
          </div>
          <div class="col-lg-9">
            <ul class="bottom-nav g-nav u-d-none-lg">
              <li>
                <a href="listing-without-filters.html"
                  >New Arrivals
                  <span class="superscript-label-new">NEW</span>
                </a>
              </li>
              <li>
                <a href="listing-without-filters.html"
                  >Best Seller
                  <span class="superscript-label-hot">HOT</span>
                </a>
              </li>
              <li>
                <a href="listing-without-filters.html">Featured </a>
              </li>
              <li>
                <a href="listing-without-filters.html"
                  >Discounted
                  <span class="superscript-label-discount">-30%</span>
                </a>
              </li>
              <li class="mega-position">
                <a
                  >More
                  <i class="fas fa-chevron-down u-s-m-l-9"></i>
                </a>
                <div class="mega-menu mega-3-colm">
                  <ul>
                    <li class="menu-title">COMPANY</li>
                    <li>
                      <a href="about.html" class="u-c-brand">About Us</a>
                    </li>
                    <li>
                      <a href="contact.html">Contact Us</a>
                    </li>
                    <li>
                      <a href="faq.html">FAQ</a>
                    </li>
                  </ul>
                  <ul>
                    <li class="menu-title">COLLECTION</li>
                    <li>
                      <a href="cart.html">Men Clothing</a>
                    </li>
                    <li>
                      <a href="checkout.html">Women Clothing</a>
                    </li>
                    <li>
                      <a href="account.html">Kids Clothing</a>
                    </li>
                  </ul>
                  <ul>
                    <li class="menu-title">ACCOUNT</li>
                    <li>
                      <a href="shop-v1-root-category.html">My Account</a>
                    </li>
                    <li>
                      <a href="shop-v1-root-category.html">My Profile</a>
                    </li>
                    <li>
                      <a href="listing.html">My Orders</a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Bottom-Header /- -->
</header>