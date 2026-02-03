@php
if (Route::currentRouteName() !== 'login') {
Session::forget('checkout_value');
}
@endphp

<!-- Header - Hidden on mobile -->
<header class="header d-none d-md-block">
    <div class="header-container">
        <div class="header-left">
            <a href="tel:+8801234567890" class="header-item">
                <i class="fas fa-phone"></i>
                <b class="d-none d-lg-inline">Call Us</b>
                <span class="d-none d-xl-inline">{{ get_setting('phone')->value }}</span>
            </a>
            <a href="mailto:info@laptopache.com" class="header-item d-none d-lg-flex">
                <i class="fas fa-envelope"></i>
                <span>info@laptopache.com</span>
            </a>
            <div class="header-item d-none d-xl-flex">
                <i class="fas fa-map-marker-alt"></i>
                <span>Dhaka, Bangladesh</span>
            </div>
        </div>
        <div class="header-right">
            <div class="social-links d-none d-lg-flex">
                <a href="{{ get_setting('facebook_url')->value }}" aria-label="Facebook"><i
                        class="fab fa-facebook-f"></i></a>
                <a href="{{ get_setting('twitter_url')->value }}" aria-label="Twitter"><i
                        class="fab fa-twitter"></i></a>
                <a href="{{ get_setting('instagram_url')->value }}" aria-label="Instagram"><i
                        class="fab fa-instagram"></i></a>
                <a href="{{ get_setting('linkedin_url')->value }}" aria-label="LinkedIn"><i
                        class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</header>

<!-- Navigation - Full version for desktop -->
<nav class="navbar d-none d-md-block" id="navbar">
    <div class="nav-container">
        <div class="logo">
            <a class="nav-brand py-0" href="{{ route('home') }}">
                <img src="{{ asset(get_setting('site_logo')->value) }}" class="logo-img" alt="Logo" />
            </a>
        </div>

        <form class="search-section" action="{{ route('product.search') }}" method="post">
            @csrf
            <div class="search-bar">

                <input type="text" name="search" placeholder="Search here">
                <button type="submit" class="search-btn">
                    <span class="d-none d-lg-inline"><i class="fas fa-search search-icon"></i></span>
                    <i class="fas fa-search d-lg-none"></i>
                </button>
            </div>
        </form>

        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span class="d-none d-lg-inline">Home</span>
            </a>


            <!-- <div class="dropdown">
                <a href="{{ route('category_list.index') }}" class="nav-link {{ Request::routeIs('category_list.index') || Request::routeIs('product.category') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i>
                    <span class="d-none d-lg-inline">Brand</span>
                    <i class="fas fa-chevron-down d-none d-lg-inline"></i>
                </a>
                <div class="dropdown-content">
                    @foreach ($menu_featured_categories as $menu_featured_category)
<a href="{{ route('product.category', $menu_featured_category->slug) }}">
                            {{ $menu_featured_category->name_en }}
                        </a>
@endforeach
                </div>
            </div> -->

            <a href="{{ route('product.show') }}"
                class="nav-link {{ Request::routeIs('product.show') ? 'active' : '' }}">
                <i class="fas fa-box"></i>
                <span class="d-none d-lg-inline">Products</span>
            </a>

            <a href="{{ route('blogs') }}" class="nav-link {{ Request::routeIs('blogs') ? 'active' : '' }}">
                <i class="fas fa-blog"></i>
                <span class="d-none d-lg-inline">Blog</span>
            </a>

            <a href="{{ route('page.about') }}"
                class="nav-link d-none d-xl-flex {{ Request::routeIs('page.about') ? 'active' : '' }}">
                <i class="fas fa-fire"></i>
                <span>About Us</span>
            </a>

            <a href="{{ route('page.contact') }}"
                class="nav-link d-none d-xl-flex {{ Request::routeIs('page.contact') ? 'active' : '' }}">
                <i class="fas fa-phone"></i>
                <span>Contact Us</span>
            </a>

            <a href="{{ route('product.warrenty') }}"
                class="nav-link d-none d-xl-flex {{ Request::routeIs('product.warrenty') ? 'active' : '' }}">
                <i class="fa-solid fa-award"></i>
                <span>Warranty Check</span>
            </a>
        </div>

        <div class="nav-actions">
            <a href="{{ route('order.tracking') }}" class="action-btn" title="Order Tracking">
                <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 640 512">
                    <path fill="#4a5568"
                        d="M112 0C85.5 0 64 21.5 64 48l0 48L16 96c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 208 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 160l-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 176 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 224l-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 144 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 288l0 128c0 53 43 96 96 96s96-43 96-96l128 0c0 53 43 96 96 96s96-43 96-96l32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64 0-32 0-18.7c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7L416 96l0-48c0-26.5-21.5-48-48-48L112 0zM544 237.3l0 18.7-128 0 0-96 50.7 0L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z" />
                </svg><span style="margin-left: 10px;">Tracking Order</span>
            </a>

            <!-- @if (Auth::user() && Auth::user()->role == 3)
<a href="{{ route('dashboard') }}" class="action-btn" title="Account">
                        <i class="fas fa-user"></i>
                    </a>
@else
<a href="{{ route('login') }}" class="action-btn" title="Login">
                        <i class="fas fa-user"></i>
                    </a>
@endif -->

            <a href="{{ route('cart.show') }}" class="action-btn cart-btn" title="Shopping Cart">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count cartQty">0</span>
            </a>
        </div>
    </div>
</nav>

<!-- Mobile Navigation (for small devices) -->
<div class="mobile-nav d-block d-md-none">
    <!-- Mobile Top Bar -->
    <div class="mobile-top-bar">
        <div class="mobile-container">
            <div class="logo">
                <a class="nav-brand py-0" href="{{ route('home') }}">
                    <img src="{{ asset(get_setting('site_logo')->value) }}" class="logo-img" alt="Logo" />
                </a>
            </div>
            <div class="mobile-search-toggle">
                <button type="button" class="search-toggle-btn" onclick="toggleMobileSearch()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Search Bar -->
        <div class="mobile-search-bar" id="mobileSearchBar">
            <form action="{{ route('product.search') }}" method="post">
                @csrf
                <div class="search-input-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="search" placeholder="Search for laptops, brands, models...">
                    <button type="button" class="close-search" onclick="toggleMobileSearch()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mobile Bottom Navigation -->
    <div class="mobile-bottom-nav">
        <div class="bottom-nav-container">
            <a href="{{ route('home') }}" class="bottom-nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>

            <a href="{{ route('product.show') }}"
                class="bottom-nav-item {{ Request::routeIs('product.show') ? 'active' : '' }}">
                <i class="fas fa-box"></i>
                <span>Products</span>
            </a>

            <a href="{{ route('blogs') }}"
                class="bottom-nav-item {{ Request::routeIs('blog.index') ? 'active' : '' }}">
                <i class="fas fa-blog"></i>
                <span>Blog</span>
            </a>

            <a href="{{ route('cart.show') }}"
                class="bottom-nav-item {{ Request::routeIs('cart.show') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                <span>Cart</span>
                <span class="cart-badge cartQty">0</span>
            </a>

            <!-- <a href="{{ route('category_list.index') }}"
                class="bottom-nav-item {{ Request::routeIs('category_list.index') || Request::routeIs('product.category') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Brands</span>
            </a> -->
            <a href="{{ route('product.warrenty') }}"
                class="bottom-nav-item {{ Request::routeIs('product.warrenty') || Request::routeIs('product.category') ? 'active' : '' }}">
                <i class="fa-solid fa-award"></i>
                <span>Warranty</span>
            </a>

            <a href="{{ route('order.tracking') }}" class="bottom-nav-item" title="Order Tracking">
                <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 640 512">
                    <path fill="#4a5568"
                        d="M112 0C85.5 0 64 21.5 64 48l0 48L16 96c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 208 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 160l-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 176 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 224l-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 144 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 288l0 128c0 53 43 96 96 96s96-43 96-96l128 0c0 53 43 96 96 96s96-43 96-96l32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64 0-32 0-18.7c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7L416 96l0-48c0-26.5-21.5-48-48-48L112 0zM544 237.3l0 18.7-128 0 0-96 50.7 0L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z" />
                </svg>
            </a>



            <!-- @if (Auth::user() && Auth::user()->role == 3)
<a href="{{ route('dashboard') }}" class="bottom-nav-item">
                    <i class="fas fa-user"></i>
                    <span>{{ ucfirst(Auth::user()->name) }}</span>
                </a>
@else
<a href="{{ route('login') }}" class="bottom-nav-item">
                    <i class="fas fa-user"></i>
                    <span>Login</span>
                </a>
@endif -->
        </div>
    </div>
</div>

<style>
    /* Base Variables */
    :root {
        --primary-color: #FF914D;
        --primary-hover: #e07d3a;
        --text-color: #4a5568;
        --text-light: #6b7280;
        --border-color: #e2e8f0;
        --bg-white: #ffffff;
        --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.15);
        --border-radius: 12px;
        --transition: all 0.3s ease;
    }

    /* Header Styles */
    .header {
        background: var(--primary-color);
        color: white;
        font-size: 0.875rem;
        padding: 0.5rem 0;
    }

    .header-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    @media (min-width: 768px) {
        .header-container {
            padding: 0 1.5rem;
        }
    }

    @media (min-width: 1200px) {
        .header-container {
            padding: 0 2rem;
        }
    }

    .header-left {
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }

    @media (min-width: 992px) {
        .header-left {
            gap: 1.5rem;
        }
    }

    .header-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: var(--transition);
        font-size: 0.8rem;
    }

    @media (min-width: 992px) {
        .header-item {
            font-size: 0.875rem;
        }
    }

    .header-item:hover {
        color: white;
    }

    .header-right {
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .social-links {
        display: flex;
        gap: 0.75rem;
    }

    @media (min-width: 992px) {
        .social-links {
            gap: 1rem;
        }
    }

    .social-links a {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1rem;
        transition: var(--transition);
    }

    @media (min-width: 992px) {
        .social-links a {
            font-size: 1.1rem;
        }
    }

    .social-links a:hover {
        color: white;
    }

    /* Desktop Navbar Styles */
    .navbar {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: var(--shadow-md);
        position: sticky;
        top: 0;
        z-index: 1000;
        transition: var(--transition);
    }

    .navbar.scrolled {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 2px 30px rgba(0, 0, 0, 0.15);
    }

    .nav-container {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        gap: 5px;
    }

    @media (min-width: 992px) {
        .nav-container {
            /* gap: 2rem; */
            /* padding: 1rem 1.5rem; */
        }
    }

    @media (min-width: 1200px) {
        .nav-container {
            padding: 1rem 2rem;
        }
    }

    /* Logo Styles */
    .logo a {
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .logo-img {
        height: 45px;
        width: auto;
    }

    @media (min-width: 992px) {
        .logo-img {
            height: 40px;
        }
    }

    @media (min-width: 1200px) {
        .logo-img {
            height: 45px;
        }
    }

    /* Search Section */
    .search-section {
        flex: 1;
        max-width: 400px;
        position: relative;
    }

    @media (min-width: 992px) {
        .search-section {
            max-width: 500px;
        }
    }

    @media (min-width: 1200px) {
        .search-section {
            max-width: 600px;
        }
    }

    .search-bar {
        position: relative;
        width: 100%;
    }

    .search-bar input {
        width: 100%;
        padding: 8px 10px;
        border: 2px solid var(--border-color);
        border-radius: 50px;
        outline: none;
        font-size: 0.875rem;
        transition: var(--transition);
        background: white;
        box-shadow: var(--shadow-sm);
    }

    @media (min-width: 992px) {
        .search-bar input {
            /* padding: 0.875rem 1rem 0.875rem 3rem; */
            font-size: 0.95rem;
        }
    }

    .search-bar input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(255, 145, 77, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: white;
        font-size: 1rem;
    }

    @media (min-width: 992px) {
        .search-icon {
            left: 1rem;
            font-size: 1.1rem;
        }
    }

    .search-btn {
        position: absolute;
        right: 4px;
        top: 50%;
        transform: translateY(-50%);
        height: calc(100% - 8px);
        padding: 0 1rem;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: var(--transition);
        font-size: 0.85rem;
        font-weight: 500;
    }

    @media (min-width: 992px) {
        .search-btn {
            padding: 0 1.5rem;
            font-size: 0.9rem;
        }
    }

    .search-btn:hover {
        transform: translateY(-50%) scale(1.05);
    }

    /* Navigation Links */
    .nav-links {
        display: flex;
        gap: 2px;
        align-items: center;
    }

    @media (min-width: 992px) {
        .nav-links {
            gap: 2px;
        }
    }

    .nav-link {
        color: var(--text-color);
        text-decoration: none;
        font-weight: 500;
        /* padding: 12px 8px; */
        position: relative;
        transition: var(--transition);
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.875rem;
        margin-right: 0;
    }

    @media (min-width: 992px) {
        .nav-link {
            padding: 15px 10px;
            font-size: 0.95rem;
        }
    }

    .nav-link:hover {
        color: var(--primary-color);
        background: rgba(255, 145, 77, 0.1);
    }

    .nav-link.active {
        color: var(--primary-color);
        background: rgba(255, 145, 77, 0.1);
    }

    /* Dropdown Styles */
    .dropdown {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        min-width: 200px;
        box-shadow: var(--shadow-lg);
        border-radius: var(--border-radius);
        padding: 0.5rem 0;
        opacity: 0;
        transform: translateY(-10px);
        transition: var(--transition);
        border: 1px solid var(--border-color);
    }

    @media (min-width: 992px) {
        .dropdown-content {
            min-width: 250px;
        }
    }

    .dropdown:hover .dropdown-content {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .dropdown-content a {
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--text-color);
        text-decoration: none;
        transition: var(--transition);
        font-weight: 500;
        font-size: 0.875rem;
    }

    @media (min-width: 992px) {
        .dropdown-content a {
            padding: 0.75rem 1.5rem;
        }
    }

    .dropdown-content a:hover {
        background: rgba(255, 145, 77, 0.1);
        color: var(--primary-color);
    }

    /* Action Buttons */
    .nav-actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    @media (min-width: 992px) {
        .nav-actions {
            gap: 1rem;
        }
    }

    .action-btn {
        color: var(--text-color);
        text-decoration: none;
        position: relative;
        padding: 0.6rem;
        transition: var(--transition);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(248, 250, 252, 0.8);
        border: 1px solid var(--border-color);
        min-width: 40px;
        height: 40px;
    }

    @media (min-width: 992px) {
        .action-btn {
            padding: 0.75rem;
            border-radius: var(--border-radius);
            min-width: 44px;
            height: 44px;
        }
    }

    .action-btn:hover {
        color: var(--primary-color);
        background: rgba(255, 145, 77, 0.1);
        border-color: var(--primary-color);
        transform: translateY(-1px);
    }

    .action-btn i {
        font-size: 1.1rem;
    }

    @media (min-width: 992px) {
        .action-btn i {
            font-size: 1.2rem;
        }
    }

    .cart-count {
        position: absolute;
        top: -5px;
        right: -5px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        padding: 0.15rem 0.4rem;
        font-size: 0.7rem;
        font-weight: bold;
        min-width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (min-width: 992px) {
        .cart-count {
            padding: 0.2rem 0.5rem;
            font-size: 0.75rem;
            min-width: 20px;
            height: 20px;
        }
    }

    /* Mobile Navigation Styles */
    .mobile-top-bar {
        background: white;
        box-shadow: var(--shadow-md);
        position: sticky;
        top: 0;
        z-index: 1000;
        padding: 1rem 0;
    }

    .mobile-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search-toggle-btn {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 0.75rem;
        border-radius: 50%;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
    }

    .search-toggle-btn:hover {
        background: var(--primary-hover);
        transform: scale(1.05);
    }

    .search-toggle-btn i {
        font-size: 1.2rem;
    }

    /* Mobile Search Bar */
    .mobile-search-bar {
        display: none;
        padding: 1rem;
        background: white;
        border-top: 1px solid var(--border-color);
        animation: slideDown 0.3s ease;
    }

    .mobile-search-bar.active {
        display: block;
    }

    .search-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-input-wrapper input {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 3rem;
        border: 2px solid var(--border-color);
        border-radius: 50px;
        outline: none;
        font-size: 0.95rem;
        transition: var(--transition);
        background: white;
        box-shadow: var(--shadow-sm);
    }

    .search-input-wrapper input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(255, 145, 77, 0.1);
    }

    .search-input-wrapper .search-icon {
        position: absolute;
        left: 1rem;
        color: #94a3b8;
        font-size: 1.1rem;
    }

    .close-search {
        position: absolute;
        right: 1rem;
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        font-size: 1.2rem;
        transition: var(--transition);
    }

    .close-search:hover {
        color: var(--primary-color);
    }

    /* Mobile Bottom Navigation */
    .mobile-bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: white;
        box-shadow: 0 -2px 20px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        border-top: 1px solid var(--border-color);
    }

    .bottom-nav-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 0.5rem 0;
        max-width: 100%;
        margin: 0 auto;
    }

    .bottom-nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: var(--text-light);
        padding: 0.5rem;
        border-radius: 8px;
        transition: var(--transition);
        position: relative;
        min-width: 60px;
    }

    .bottom-nav-item i {
        font-size: 1.5rem;
        margin-bottom: 0.25rem;
    }

    .bottom-nav-item span {
        font-size: 0.75rem;
        font-weight: 500;
    }

    .bottom-nav-item:hover,
    .bottom-nav-item.active {
        color: var(--primary-color);
        background: rgba(255, 145, 77, 0.1);
    }

    .cart-badge {
        position: absolute;
        top: 0.25rem;
        right: 0.75rem;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        padding: 0.1rem 0.4rem;
        font-size: 0.6rem;
        font-weight: bold;
        min-width: 16px;
        height: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Animations */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Body padding for mobile bottom nav */
    @media (max-width: 767px) {
        body {
            padding-bottom: 80px;
        }
    }

    /* Responsive adjustments for small mobile devices */
    @media (max-width: 576px) {
        .bottom-nav-item {
            min-width: 50px;
        }

        .bottom-nav-item i {
            font-size: 1.3rem;
        }

        .bottom-nav-item span {
            font-size: 0.7rem;
        }
    }

    /* Hide elements responsively */
    @media (min-width: 768px) and (max-width: 991px) {
        .header-item b {
            display: none;
        }

        .nav-link span {
            display: none;
        }

        .nav-link i {
            font-size: 1.2rem;
        }
    }
</style>

<script>
    // Mobile search toggle
    function toggleMobileSearch() {
        const searchBar = document.getElementById('mobileSearchBar');
        searchBar.classList.toggle('active');

        if (searchBar.classList.contains('active')) {
            searchBar.querySelector('input').focus();
        }
    }

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        // Navbar scroll effect (for desktop)
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });

        // No need for JavaScript active state handling anymore as it's handled by Laravel

        // Close mobile search when clicking outside
        document.addEventListener('click', function(e) {
            const searchBar = document.getElementById('mobileSearchBar');
            const searchToggle = document.querySelector('.search-toggle-btn');

            if (searchBar && !searchBar.contains(e.target) && !searchToggle.contains(e.target)) {
                searchBar.classList.remove('active');
            }
        });

        // Update cart count function
        function updateCartCount() {
            // Your cart count update logic here
            // This is just a placeholder - replace with actual implementation
            const cartElements = document.querySelectorAll('.cartQty');
            cartElements.forEach(element => {
                element.textContent = '0'; // Replace with actual cart count
            });
        }

        // Initialize cart count
        updateCartCount();
    });
</script>