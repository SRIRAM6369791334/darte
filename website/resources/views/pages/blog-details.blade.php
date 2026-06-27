{{-- @extends('layouts.app')

@section('content')
    <div class="page-content bg-light">
        <!-- Banner Start -->
        <div class="dz-bnr-inr bg-secondary overlay-black-light"
            style="background-image:url({{ asset('assets/images/background/ab.webp') }});">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1 class="color1">{{ $blog->title }}</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></li>
                            <li class="breadcrumb-item">Blog Details</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Banner End -->

        <!-- Blog Detail -->
        <section class="content-inner-1 bg-img-fix">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-xl-8 col-lg-8">
                        <!-- blog start -->
                        <div class="dz-blog blog-single style-1 sidebar">
                            <h1 class="dz-title">{{ $blog->title }}</h1>
                            <div class="dz-meta">
                                <ul>
                                    <li class="post-date">
                                        <i class="fa-regular fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}
                                    </li>
                                    <li class="dz-user">
                                        <i class="fa-solid fa-user"></i>
                                        By <a href="javascript:void(0);">DARTE Editor</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dz-media rounded mb-4">
                                <img src="{{ env('MAIN_URL') . 'images/' . $blog->image }}" alt="{{ $blog->title }}"
                                    class="img-fluid w-100 rounded">
                            </div>
                            <div class="dz-info">
                                <div class="dz-post-text">
                                    {!! $blog->description !!}
                                </div>
                                <div class="dz-share-post meta-bottom">
                                    <div class="post-tags">
                                        <strong>Tags:</strong>
                                        <a href="javascript:void(0);">Leather</a>
                                        <a href="javascript:void(0);">Lifestyle</a>
                                        <a href="javascript:void(0);">Fashion</a>
                                    </div>
                                    <div class="dz-social-icon primary-light">
                                        <ul>
                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- blog END -->
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <aside class="side-bar sticky-top mt-lg-0 mt-md-5 mt-4">
                            <div class="widget recent-posts-entry">
                                <h5 class="widget-title">Latest Posts</h5>
                                <div class="widget-post-bx">
                                    @foreach($latestBlogs as $item)
                                        <div class="widget-post clearfix">
                                            <div class="dz-media">
                                                <a href="{{ route('blog.details', $item->url_name) }}">
                                                    <img src="{{ env('MAIN_URL') . 'images/' . $item->image }}"
                                                        alt="{{ $item->title }}">
                                                </a>
                                            </div>
                                            <div class="dz-info">
                                                <div class="dz-meta">
                                                    <ul>
                                                        <li class="post-date text-primary">
                                                            {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</li>
                                                    </ul>
                                                </div>
                                                <h6 class="title">
                                                    <a href="{{ route('blog.details', $item->url_name) }}">
                                                        {{ Str::limit($item->title, 55) }}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection --}}
