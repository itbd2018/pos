@extends('FrontEnd.master')

@section('title')
Tech Blog - Latest Laptop News & Reviews
@endsection

@push('css')
<style>
    /* Modern Variables with #FF914D Theme */
    :root {
        --primary-orange: #FF914D;
        --secondary-orange: #FF7A2B;
        --dark-orange: #E67A3A;
        --light-orange: #FFA366;
        --ultra-light-orange: rgba(255, 145, 77, 0.1);
        --dark-bg: #1a1a1a;
        --darker-bg: #0f0f0f;
        --light-bg: #ffffff;
        --text-dark: #2d2d2d;
        --text-light: #f5f5f5;
        --text-gray: #666666;
        --gradient-primary: linear-gradient(135deg, #FF914D 0%, #FF7A2B 100%);
        --gradient-dark: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
        --shadow-light: 0 10px 30px rgba(255, 145, 77, 0.2);
        --shadow-dark: 0 15px 40px rgba(0, 0, 0, 0.3);
    }



    /* Hero Section */
    .hero-section {
        background: var(--gradient-dark);
        padding: 80px 0 120px;
        /* position: relative; */
        overflow: hidden;

    }



    .hero-container {
        max-width: 1200px;
        min-height: 60vh;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hero-content {
        text-align: center;
        color: var(--text-light);
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--ultra-light-orange);
        border: 1px solid rgba(255, 145, 77, 0.3);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        color: var(--primary-orange);
        margin-bottom: 24px;
        margin-top: 10px;
        backdrop-filter: blur(10px);
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        margin-bottom: 24px;
        background: linear-gradient(135deg, #ffffff 0%, #cccccc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.1;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: #b8b8b8;
        max-width: 600px;
        margin: 0 auto 40px;
        font-weight: 400;
    }

    .hero-search {
        position: relative;
        max-width: 500px;
        margin: 0 auto;
    }




    /* Blog Grid */
    .blog-section {
        max-width: 1200px;
        margin: 0 auto;
        /* padding: 0 20px 80px; */
    }

    .section-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 16px;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: var(--text-gray);
        max-width: 500px;
        margin: 0 auto;
    }

    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 32px;
        padding: 10px;
        margin-top: 20px;
    }

    .blog-card {
        background: var(--light-bg);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        height: fit-content;
    }

    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-light);
    }

    .blog-image {
        height: 220px;
        position: relative;
        overflow: hidden;
    }

    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .blog-card:hover .blog-image img {
        transform: scale(1.05);
    }

    .blog-content {
        padding: 32px;
    }

    .blog-category {
        display: inline-block;
        background: var(--ultra-light-orange);
        color: var(--primary-orange);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 16px;
    }

    .blog-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 12px;
        line-height: 1.3;
    }

    .blog-excerpt {
        color: var(--text-gray);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 24px;
    }

    .blog-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 20px;
        border-top: 1px solid #f0f0f0;
        font-size: 0.85rem;
        color: var(--text-gray);
    }

    .blog-author {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .blog-author-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--gradient-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.8rem;
    }

    /* Responsive Design */
    /* Large Desktop Screens (1440px and above) */
    @media (min-width: 1440px) {

        .hero-container,
        .featured-section,
        .blog-section {
            max-width: 1400px;
        }

        .hero-title {
            font-size: 4.5rem;
        }

        .blog-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Desktop Screens (1024px to 1439px) */
    @media (max-width: 1439px) {

        .hero-container,
        .featured-section,
        .blog-section {
            max-width: 1200px;
        }

        .blog-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
    }

    /* Tablets and Small Laptops (768px to 1023px) */
    @media (max-width: 1023px) {
        .hero-title {
            font-size: 3rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .blog-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .featured-content {
            padding: 40px;
        }

        .featured-title {
            font-size: 2rem;
        }

        .section-title {
            font-size: 2.2rem;
        }
    }

    /* Tablets (601px to 767px) */
    @media (max-width: 767px) {
        .hero-container {
            padding: 0 16px;
            min-height: 50vh;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .featured-card {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .featured-content {
            padding: 40px 30px;
        }

        .featured-title {
            font-size: 1.8rem;
        }

        .featured-meta {
            justify-content: center;
            flex-wrap: wrap;
        }

        .blog-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .section-title {
            font-size: 2rem;
        }

    }

    /* Mobile Phones (481px to 600px) */
    @media (max-width: 600px) {
        .hero-title {
            font-size: 2rem;
            margin-bottom: 16px;
        }

        .hero-subtitle {
            font-size: 0.95rem;
            margin-bottom: 30px;
        }

        .hero-badge {
            font-size: 0.8rem;
            padding: 6px 12px;
        }

        .blog-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .featured-content {
            padding: 30px 20px;
        }

        .featured-excerpt {
            font-size: 1rem;
        }

        .section-header {
            margin-bottom: 40px;
        }

        .blog-content {
            padding: 24px;
        }
    }

    /* Small Mobile Phones (320px to 480px) */
    @media (max-width: 480px) {
        .hero-section {
            padding: 60px 0 80px;
        }

        .hero-title {
            font-size: 1.8rem;
        }

        .hero-subtitle {
            font-size: 0.9rem;
        }

        .featured-title {
            font-size: 1.5rem;
        }

        .featured-excerpt {
            font-size: 0.95rem;
        }

        .featured-meta {
            gap: 16px;
        }

        .read-more-btn {
            width: 100%;
            justify-content: center;
        }

        .blog-title {
            font-size: 1.2rem;
        }

        .blog-excerpt {
            font-size: 0.9rem;
        }
    }

    /* Animation Classes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-up {
        animation: fadeInUp 0.8s ease-out;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-orange);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--secondary-orange);
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-container">
        <div class="hero-content animate-fade-up">
            <div class="hero-badge">
                Blogs
            </div>
            <h1 class="hero-title">Discover the Future of Technology</h1>
            <p class="hero-subtitle">Stay ahead with cutting-edge laptop reviews, tech news, and expert insights that matter to modern professionals and enthusiasts.</p>
        </div>
    </div>
</section>

<!-- Blog Posts Section -->
<section class="blog-section">

    <div class="blog-grid">
        <!-- Blog Post 1 -->
        @foreach ($blogs as $blog)

        <a href="{{ route('blogs.details',$blog->slug) }}">
            <article class="blog-card animate-fade-up">
                <div class="blog-image">
                    <img src="{{ asset($blog->blog_img) }}" alt="Gaming laptop with RGB keyboard and high-performance display">
                </div>
                <div class="blog-content">
                    <h3 class="blog-title">{{ $blog->title_en }}</h3>
                    <p class="blog-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description_en), 100) }}</p>
                    {{-- <div class="blog-meta">
                        <div class="blog-author">
                            <div class="blog-author-avatar">A</div>
                            <span>Admin</span>
                        </div>
                        <span><i class="far fa-clock"></i> 5 min read</span>
                    </div> --}}
                </div>
            </article>
        </a>
           
       @endforeach


    </div>
</section>


@endsection