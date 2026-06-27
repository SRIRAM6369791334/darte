{{-- @extends('layouts.app')
@section('content')
    <div class="page-content bg-light">
        <!-- Banner Start -->
        <div class="dz-bnr-inr bg-secondary overlay-black-light"
            style="background-image:url({{ asset('assets/images/background/ab.webp') }});">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1 class="color1">Blog</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Home</a></li>
                            <li class="breadcrumb-item">Blog</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Banner End -->

        <section class="content-inner-1 z-index-unset">
            <div class="container">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-6 col-md-12 col-sm-12 m-lg-b30 m-b50">
                            <div class="dz-card blog-half style-5">
                                <div class="dz-media">
                                    <img src="{{ env('MAIN_URL') . 'images/' . $blog->image }}" alt="{{ $blog->title }}">
                                </div>
                                <div class="dz-info">
                                    <div class="dz-meta">
                                        <ul>
                                            <li class="post-date text-primary">
                                                {{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="dz-title">
                                        <a href="{{ route('blog.details', $blog->url_name) }}">
                                            {{ $blog->title }}
                                        </a>
                                    </h3>
                                    <div class="dz-post-text">
                                        <p>
                                            {{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 120) }}
                                        </p>
                                    </div>
                                    <a href="{{ route('blog.details', $blog->url_name) }}" class="btn btn-secondary btn-md">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection --}}
