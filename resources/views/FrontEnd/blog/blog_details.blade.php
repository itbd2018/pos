@extends('FrontEnd.master')

@section('title')
{{ $blog->title_en }} - LaptopAche Blog
@endsection
@section('content')
<!-- Hero Section -->

<div class="container blog-container">
    <div class="row">
        <!-- Main Blog Content Column -->
        <div class="col-lg-8">
            <!-- Progress Bar -->
            <div class="reading-progress-bar"></div>

            <!-- Featured Image -->
            <div class="blog-featured-image">
                <img src="{{ asset($blog->blog_img) }}" alt="How to Choose the Right Laptop">
            </div>

            <!-- Blog Content -->
            <div class="blog-content">
                {!! $blog->description_en  !!}
            </div>
        </div>

        <!-- Sidebar Column -->
        <div class="col-lg-4">
            <!-- Latest Posts Widget -->
            <div class="sidebar-widget latest-posts">
                <h3 class="widget-title">Latest Posts</h3>
                
                
                    @foreach ($allblogs as $allblog )
                        <a href="#" class="latest-post-card">
                        <div class="post-image">
                            <img src="{{ asset($allblog->blog_img) }}" alt="laptop">
                        </div>
                        <div class="post-info">
                            <h4>{{ $allblog->title_en }}</h4>
                            <span class="post-date">
                                <i class="far fa-calendar"></i>
                               {{ $allblog->created_at->format('Y-m-d') }}

                            </span>
                        </div>
                    </a>
                    @endforeach

                
            </div>

            
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    :root {
        --primary-color: #FF914D;
        --secondary-color: #FF7A2B;
        --text-color: #2d2d2d;
        --gray-color: #666666;
        --light-gray: #f5f5f5;
        --border-color: #e0e0e0;
        --hero-height: 70vh;
        --hero-padding: 120px;
    }

    /* Hero Section */
    .blog-hero {
        position: relative;
        height: var(--hero-height);
        background-image: url('{{ $blog->image ?? "https://images.unsplash.com/photo-1531297484001-80022131f5a1" }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        margin-top: -2rem;
        margin-bottom: 3rem;
    }

    .blog-hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));
    }

    .blog-hero-content {
        position: relative;
        color: white;
        padding-top: var(--hero-padding);
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .blog-category {
        display: inline-block;
        background-color: var(--primary-color);
        color: white;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 1rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(255, 145, 77, 0.3);
        transition: transform 0.3s ease;
    }

    .blog-category:hover {
        transform: translateY(-2px);
    }

    /* Reading Progress Bar */
    .reading-progress-bar {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        z-index: 9999;
        transition: width 0.1s ease;
    }

    .blog-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .blog-meta {
        display: flex;
        justify-content: center;
        gap: 2rem;
        color: rgba(255,255,255,0.9);
        font-size: 1rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: transform 0.3s ease;
    }

    .meta-item:hover {
        transform: translateY(-2px);
    }

    .blog-container {
        position: relative;
        margin-top: -100px;
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    /* Featured Image */
    .blog-featured-image {
        margin-bottom: 2rem;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .blog-featured-image img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    /* Blog Content */
    .blog-content {
        font-size: 1.2rem;
        line-height: 1.9;
        color: var(--text-color);
        margin-bottom: 2rem;
    }

    .blog-content p {
        margin-bottom: 1.8rem;
        color: #444;
    }

    .blog-content h2 {
        font-size: 1.5rem;
        margin: 3rem 0 1.5rem;
        color: var(--primary-color);
        font-weight: 700;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .blog-content h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--primary-color);
        border-radius: 2px;
    }

    .blog-content h3 {
        font-size: 1.8rem;
        margin: 2.5rem 0 1.2rem;
        color: #333;
    }

    .blog-content img {
        max-width: 100%;
        border-radius: 12px;
        margin: 2rem 0;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .blog-content strong {
        color: var(--primary-color);
        font-weight: 600;
    }

    .blog-content ul, .blog-content ol {
        margin: 1.5rem 0;
        padding-left: 2rem;
    }

    .blog-content li {
        margin-bottom: 0.8rem;
        color: #444;
    }

    .blog-content blockquote {
        margin: 2rem 0;
        padding: 2rem;
        background: var(--light-gray);
        border-left: 4px solid var(--primary-color);
        border-radius: 8px;
        font-style: italic;
    }

    .blog-content code {
        background: #f8f9fa;
        padding: 2px 6px;
        border-radius: 4px;
        color: var(--primary-color);
        font-family: monospace;
    }

    /* Tags */
    .blog-tags {
        margin: 2rem 0;
    }

    .tag-badge {
        display: inline-block;
        background: var(--light-gray);
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.85rem;
        color: var(--gray-color);
        margin: 0.3rem;
    }

    /* Share Section */
    .share-section {
        margin: 2rem 0;
        padding: 2rem 0;
        border-top: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
    }

    .share-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .share-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: transform 0.3s;
    }

    .share-btn:hover {
        transform: translateY(-3px);
        color: white;
    }

    .share-btn.facebook { background: #3b5998; }
    .share-btn.twitter { background: #1da1f2; }
    .share-btn.linkedin { background: #0077b5; }
    .share-btn.whatsapp { background: #25d366; }

    /* Author Box */
    .author-box {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        background: var(--light-gray);
        padding: 2rem;
        border-radius: 10px;
        margin: 2rem 0;
    }

    .author-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        font-weight: 600;
    }

    .author-info h4 {
        margin-bottom: 0.5rem;
        font-size: 1.2rem;
        color: var(--text-color);
    }

    .author-info p {
        color: var(--gray-color);
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }

    /* Sidebar Widgets */
    .sidebar-widget {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        position: sticky;
        top: 80px;
    }

    .widget-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 1.5rem;
        padding-bottom: 0.8rem;
        border-bottom: 2px solid var(--primary-color);
    }

    /* Latest Posts Widget */
    .latest-post-card {
        display: flex;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-color);
        text-decoration: none;
        color: var(--text-color);
    }

    .latest-post-card:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .latest-post-card:hover h4 {
        color: var(--primary-color);
    }

    .post-image {
        flex: 0 0 100px;
        height: 70px;
        border-radius: 8px;
        overflow: hidden;
    }

    .post-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .post-info {
        flex: 1;
    }

    .post-info h4 {
        font-size: 0.95rem;
        font-weight: 500;
        margin: 0 0 0.5rem;
        transition: color 0.3s;
        color: #FF914D;
    }

    .post-date {
        font-size: 0.8rem;
        color: var(--gray-color);
    }

    /* Categories Widget */
    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .category-list li {
        border-bottom: 1px solid var(--border-color);
    }

    .category-list li:last-child {
        border-bottom: none;
    }

    .category-list a {
        display: flex;
        justify-content: space-between;
        padding: 0.8rem 0;
        color: var(--text-color);
        text-decoration: none;
        transition: color 0.3s;
    }

    .category-list a:hover {
        color: var(--primary-color);
    }

    .count {
        background: var(--light-gray);
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
    }

    /* Tags Widget */
    .tag-cloud {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .tag {
        background: var(--light-gray);
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.85rem;
        color: var(--gray-color);
        text-decoration: none;
        transition: all 0.3s;
    }

    .tag:hover {
        background: var(--primary-color);
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .blog-title {
            font-size: 2rem;
        }
        .blog-featured-image img {
            height: 300px;
        }
        .sidebar-widget {
            margin-top: 2rem;
        }
    }

    @media (max-width: 767px) {
        .blog-meta {
            flex-wrap: wrap;
            gap: 1rem;
        }
        .blog-featured-image img {
            height: 250px;
        }
        .author-box {
            flex-direction: column;
            text-align: center;
        }
        .share-buttons {
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .blog-title {
            font-size: 1.8rem;
        }
        .blog-content {
            font-size: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Reading Progress Bar
    const progressBar = document.querySelector('.reading-progress-bar');
    const content = document.querySelector('.blog-content');
    
    window.addEventListener('scroll', () => {
        if (content) {
            const windowHeight = window.innerHeight;
            const fullHeight = content.offsetHeight;
            const scrolled = window.scrollY - content.offsetTop;
            const progressWidth = (scrolled / (fullHeight - windowHeight)) * 100;
            progressBar.style.width = Math.min(100, Math.max(0, progressWidth)) + '%';
        }
    });

    // Smooth Scroll for Headings
    document.querySelectorAll('.blog-content h2, .blog-content h3').forEach(heading => {
        heading.style.cursor = 'pointer';
        heading.addEventListener('click', () => {
            window.history.pushState(null, '', '#' + heading.id);
            heading.scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Add hover effect to images
    document.querySelectorAll('.blog-content img').forEach(img => {
        img.addEventListener('mouseenter', () => {
            img.style.transform = 'scale(1.02)';
            img.style.transition = 'transform 0.3s ease';
        });
        img.addEventListener('mouseleave', () => {
            img.style.transform = 'scale(1)';
        });
    });
});
</script>
@endpush