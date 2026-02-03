@extends('FrontEnd.master')

@section('content')

    {{-- Header Section with Banner --}}
    <section class="blog-header position-relative">
        <img src="{{ asset('FrontEnd/assect/img/blog_banner.png') }}" 
             alt="Blogs Banner" 
             class="w-100" 
             style="max-height: 350px; object-fit: cover; filter: brightness(70%);">
        {{-- <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
            <h1 class="fw-bold display-5">Our Blogs</h1>
            <p class="fs-5">Latest news, updates & tips about laptops</p>
        </div> --}}
    </section>

    {{-- Blog Cards Section --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                @forelse($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm border-0 rounded-3 overflow-hidden blog-card">
                            
                            {{-- Blog Image {{ route('blog.details', $blog->slug) }}--}}
                            <a href="#">
                                <img src="{{ asset($blog->blog_img ?? 'FrontEnd/assect/img/default_blog.jpg') }}" 
                                     class="card-img-top blog-img" 
                                     alt="{{ $blog->title_en }}">
                            </a>

                            {{-- Blog Content {{ route('blog.details', $blog->slug) }} --}}
                            <div class="card-body">
                                <span class="badge bg-warning text-dark mb-2">Blog</span>
                                <h5 class="card-title fw-bold">
                                    <a href="#" 
                                       class="text-dark text-decoration-none hover-primary">
                                        {{ $blog->title_en }}
                                    </a>
                                </h5>
                                <p class="text-muted small mb-3">
                                    Category: {{ $blog->category_name ?? 'Uncategorized' }}
                                </p>
                                <p class="card-text text-truncate" style="max-height: 60px; overflow: hidden;">
                                    {{ Str::limit(strip_tags($blog->description_bn ?? ''), 120, '...') }}
                                </p>
                            </div>

                            {{-- Blog Footer {{ route('blog.details', $blog->slug) }} --}}
                            <div class="card-footer bg-white border-0 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('upload/admin_images/202208201411avatar5.png') }}" 
                                         class="rounded-circle me-2" 
                                         alt="Author" 
                                         width="32" height="32">
                                    <small class="text-muted me-5">{{ Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}</small>
                                </div>
                                <a href="#" 
                                   class="btn btn-sm btn-outline-primary">
                                   Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted fs-5">No blogs available right now.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection

@push('css')
<style>
    .blog-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0,0,0,0.15);
    }
    .blog-img {
        height: 220px;
        object-fit: cover;
    }
    .hover-primary:hover {
        color: #0d6efd !important;
    }
</style>
@endpush
