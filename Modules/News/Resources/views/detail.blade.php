@extends('client.layouts.client')
@section('title')
<title>Detail</title>
@endsection
@section('content')
<main>
    <style>
        .checked {
            color: orange;
        }
        </style>
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
                    <div class="comments-area">
                        <h3>Write Comment</h3>
                        <form method="POST" action="{{ route('news.comment') }}">
                            @csrf
                            <input type="text" name="comment" class="container" size="80" placeholder="✍️ Write comment for you..."></input>
                            <button type="submit" class="btn-danger mt-3">Send</button>
                        </form>
                        <h4 class="mt-5">Comments orthers</h4>
                        @if ($comments_data->comment == [])
                            <p>This post has no comments yet...</p>
                        @else
                            @foreach ($comments_data->comment as $comment)
                                <div class="comment-list">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img src="https://phunugioi.com/wp-content/uploads/2020/01/anh-avatar-supreme-dep-lam-dai-dien-facebook.jpg" alt="">
                                            </div>
                                            <div class="desc">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="text-primary">
                                                            {{ $comments_data->post_user->name }}
                                                        </h5>
                                                        <div class="ml-2">
                                                            @if ($comment->ranking == 5)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                            @elseif($comment->ranking == 4)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                            @elseif($comment->ranking == 3)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                            @elseif($comment->ranking == 2)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                            @elseif($comment->ranking == 1)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                            @else
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                            @endif
                                                            <span class="fa fa-star"></span>
                                                        </div>
                                                        <p class="date">{{ date('d-m-Y', strtotime($comment->created_at)) }} </p>
                                                    </div>
                                                    {{-- <div class="reply-btn">
                                                        <a href="#" class="btn-reply text-uppercase">reply</a>
                                                    </div> --}}
                                                </div>
                                                <p class="comment text-dark">
                                                    {{ $comment->comment }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        
                    </div>
                    <!-- From -->
                    {{-- <div class="row">
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
                    </div> --}}
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
                                    <a href="{{ route('news.detail', ['slug'=>$post->slug])}}"><img height="100"
                                            width="100" src="{{$post->feature_image_path}}" alt=""></a>
                                </div><span>&emsp;</span>
                                <div class="trand-right-cap">
                                    <span class="text-danger">News</span>
                                    <h6><a href="{{ route('news.detail', ['slug'=>$post->slug])}}">{{$post->title}}</a>
                                    </h6>
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
