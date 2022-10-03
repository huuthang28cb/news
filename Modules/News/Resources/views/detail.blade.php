@extends('client.layouts.client')
@section('title')
    <title>Detail</title>
@endsection
@section('content')
<main>
    <!-- About US Start -->
    <div class="about-area">
        <div class="container">
            <!-- Hot Aimated News Tittle-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending-tittle">
                        <strong>{{optional($detail->topics)->name}}</strong>                       
                    </div>
                    {{-- {{ date('d-m-Y', strtotime($detail->created_at)) }} --}}
                    <div>
                        Updated: {{ date('d-m-Y', strtotime($detail->created_at)) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <!-- Trending Tittle -->
                    <div class="about-right mb-90">
                        <div class="section-tittle mb-30 pt-30">
                            <h3>{{ $detail->title }}</h3>
                        </div>
                        <div class="about-img">
                            <img src="{{ $detail->feature_image_path }}" alt="">
                        </div>
                        <div class="about-prea about-img">
                            {!! $detail->content !!}
                        </div>
                        
                    </div>
                    <!-- From -->
                    <div class="row">
                        <div class="col-lg-8">
                            <form class="form-contact contact_form mb-80" action="contact_process.php" method="post"
                                id="contactForm" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea class="form-control w-100 error" name="message" id="message"
                                                cols="30" rows="9" onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = 'Enter Message'"
                                                placeholder="Enter Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control error" name="name" id="name" type="text"
                                                onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = 'Enter your name'"
                                                placeholder="Enter your name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control error" name="email" id="email" type="email"
                                                onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input class="form-control error" name="subject" id="subject" type="text"
                                                onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Section Tittle -->
                    <div class="section-tittle mb-40">
                        <h3>Same Topic</h3>
                    </div>
                    <!-- Flow Socail -->
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach ($posts_data as $post)
                                <div class="trand-right-single d-flex">
                                    <div class="trand-right-img">
                                        <a href="{{ route('news.detail', ['slug'=>$post->slug])}}"><img height="100" width="100" src="{{$post->feature_image_path}}" alt=""></a>
                                    </div><span>&emsp;</span>
                                    <div class="trand-right-cap">
                                        <span class="text-danger">News</span>
                                        <h6><a href="{{ route('news.detail', ['slug'=>$post->slug])}}">{{$post->title}}</a></h6>
                                    </div>
                                </div>
                                <div>&emsp;</div>
                            @endforeach
                            
                        </div>
                    </div>
                    <!-- New Poster -->
                    <div class="news-poster d-none d-lg-block">
                        <img src="assets/img/news/news_card.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About US End -->
</main>
@endsection
