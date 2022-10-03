@extends('client.layouts.client')
@section('title')
<title>Categoties</title>
@endsection
@section('content')
<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <strong>{{ $categories_data->name }}</strong>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        {{-- <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                <img src="{{$first_post->feature_image_path}}" alt="">
                        <div class="trend-top-cap">
                            <span>For you!</span>
                            <h2><a href="details.html">{{$first_post->title}}</a></h2>
                        </div>
                    </div>
                </div> --}}
                <!-- Trending Bottom -->
                <div class="trending-bottom">
                    <div class="row">
                        {{-- @foreach ($categories_data->postss as $cate_item)
                        <div class="col-lg-4">
                            <div class="single-bottom mb-35">
                                <div class="column">
                                    <div class="row">
                                        <div class="trend-bottom-cap">
                                            <h4><a href="details.html">{{$cate_item->title}}</a></h4>
                                        </div>
                                        <div>
                                            <h6><a href="details.html">{{$cate_item->description}}</a></h6>
                                        </div>
                                    </div>
                                    <div class="trend-bottom-img mb-30">
                                        <img src="{{$cate_item->feature_image_path}}" alt="">
                                    </div>
                                </div>

                            </div>
                        </div>

                        @endforeach --}}
                        @foreach ( $categories_data->postss as $cate_item )
                        <div class="section-top-border">
                            <a href="{{ route('news.detail', ['slug'=>$cate_item->slug])}}"><h3 class="mb-30">{{$cate_item->title}}</h3></a>
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ route('news.detail', ['slug'=>$cate_item->slug])}}"><img src="{{$cate_item->feature_image_path}}" alt="" class="img-fluid"></a>
                                </div>
                                <div class="col-md-9 mt-sm-20">
                                    <p>{{$cate_item->description}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <!-- Riht content -->
            {{-- <div class="col-lg-4">
                        @foreach ($posts_data as $post)
                            <div class="trand-right-single d-flex">
                                <div class="trand-right-img">
                                    <img height="100" width="100" src="{{$post->feature_image_path}}" alt="">
        </div>
        <div class="trand-right-cap">
            <span class="text-danger">News</span>
            <h6><a href="{{ route('news.detail', ['slug'=>$post->slug])}}">{{$post->title}}</a></h6>
        </div>
    </div>
    @endforeach

    </div> --}}
    </div>
    </div>
    </div>
    </div>

    <!--Start pagination -->
    <div class="pagination-area pb-45 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item"><a class="page-link" href="#"><span
                                            class="flaticon-arrow roted"></span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link" href="#"><span
                                            class="flaticon-arrow right-arrow"></span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End pagination  -->
</main>
@endsection
