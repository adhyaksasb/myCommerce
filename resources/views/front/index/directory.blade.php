@php
use App\Models\Section;
$sections = Section::sections();
// echo "<pre>"; print_r($sections); die;
@endphp

@extends('front.layout.layout')
@section('content')

<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Directory</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/')}}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="{{ url('/c')}}">Directory</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Store-Directory-Page -->
<div class="page-directory u-s-p-t-80">
    <div class="container">
        @foreach($sections as $section)
        <!-- Directory Wrapper  -->
        <div class="directory-wrapper">
            <h2>
                <a href="shop-v1-root-category.html">{{ $section['name'] }}</a>
            </h2>
            <div class="row">
                @foreach($section['categories'] as $category)
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <ul class="dir-list-wrap">
                        <li>
                            <a class="dir-list-main" href="listing.html">Tops</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">T-Shirts</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Hoodies</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Suits</a>
                        </li>
                        <li>
                            <a href="shop-v4-filter-as-category.html">Black Bean T-Shirt</a>
                        </li>
                    </ul>
                </div>
                @endforeach
            </div>
            {{-- <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <ul class="dir-list-wrap">
                        <li>
                            <a href="listing.html" class="dir-list-main">Bottoms</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Casual Pants</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Shoes</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Jeans</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Shorts</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <ul class="dir-list-wrap">
                        <li>
                            <a href="listing.html" class="dir-list-main">Underwear</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Boxers</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Briefs</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Robes</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Socks</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <ul class="dir-list-wrap">
                        <li>
                            <a href="listing.html" class="dir-list-main">Sunglasses</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Pilot</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Wayfarer</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Square</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Round</a>
                        </li>
                    </ul>
                </div>
            </div> --}}
        </div>
        <!-- Directory Wrapper /-  -->
        @endforeach
    </div>
</div>
<!-- Store-Directory-Page /- -->
@endsection