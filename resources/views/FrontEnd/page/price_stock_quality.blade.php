@extends('FrontEnd.master')
@section('title')
About Us
@endsection
@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
        background: linear-gradient(135deg, #f5f5f5 0%, #fafafa 100%);
    }

    .laptop-ache-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .laptop-ache-header {
        text-align: center;
        margin-bottom: 60px;
        animation: slideDown 0.8s ease-out;
    }

    .laptop-ache-header h1 {
        padding: 10px 0;
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #FF914D 0%, #ff7a1f 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -1px;
    }

    .laptop-ache-subtitle {
        font-size: 1.2rem;
        color: #666;
        font-weight: 300;
        letter-spacing: 0.5px;
    }

    .laptop-ache-intro {
        background: white;
        padding: 10px !important;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 10px 40px rgba(255, 145, 77, 0.1);
        border-left: 6px solid #FF914D;
        animation: fadeInUp 0.8s ease-out;
    }

    .laptop-ache-intro p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        padding: 10px 15px;
    }

    .laptop-ache-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        margin-bottom: 80px;
    }

    .laptop-ache-card {
        background: white;
        padding: 45px;
        border-radius: 15px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        animation: fadeInUp 0.8s ease-out;
    }

    .laptop-ache-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .laptop-ache-card:hover {
        /* transform: translateY(-10px); */
        box-shadow: 0 25px 70px rgba(255, 145, 77, 0.2);
    }

    .laptop-ache-card h2 {
        font-size: 1.8rem;
        margin-bottom: 25px;
        color: #FF914D;
        font-weight: 700;
        position: relative;
        padding-bottom: 15px;
    }

    .laptop-ache-card h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: #FF914D;
        border-radius: 2px;
    }

    .laptop-ache-card p {
        font-size: 1rem;
        line-height: 1.8;
        color: #666;
        margin-bottom: 30px;
    }

    .laptop-ache-btn {
        display: inline-block;
        padding: 16px 35px;
        background: linear-gradient(135deg, #FF914D 0%, #ff7a1f 100%);
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(255, 145, 77, 0.3);
        letter-spacing: 0.5px;
    }

    .laptop-ache-btn:hover {
        background: linear-gradient(135deg, #ff7a1f 0%, #FF914D 100%);
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(255, 145, 77, 0.4);
        text-decoration: none;
        color: white;
    }

    .laptop-ache-btn:active {
        transform: translateY(0);
    }

    .laptop-ache-icon {
        display: inline-block;
        width: 50px;
        height: 50px;
        margin-bottom: 20px;
        background: rgba(255, 145, 77, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .laptop-ache-header h1 {
            font-size: 2.5rem;
        }

        .laptop-ache-wrapper {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .laptop-ache-card {
            padding: 30px;
        }

        .laptop-ache-intro {
            padding: 30px;
        }

        .laptop-ache-subtitle {
            font-size: 1rem;
        }
    }
</style>

<div class="laptop-ache-container">
    <header class="laptop-ache-header">
        <h1>Laptop Ache</h1>
        <p class="laptop-ache-subtitle">October-December Stock & Price Update 2025</p>
    </header>

    <section class="laptop-ache-intro">
        <p>Welcome to Laptop Ache! To ensure transparency and provide the best quality products for our customers, we post our stock and price updates every three months. On this page, you will find information about our available used laptops and their latest prices for the October to December period.</p>
    </section>

    <div class="laptop-ache-wrapper">
        <div class="laptop-ache-card">
            <div class="laptop-ache-icon">📋</div>
            <h2>October-December 2025: Latest Price & Stock List</h2>
            <p>Below is the information regarding our currently available laptops. Stock is limited, so please contact us soon to choose your preferred laptop. For the most current list of available models and prices, please contact us directly.</p>
            <a href="{{ route('stock.price.list.pdf') }}" class="laptop-ache-btn">⬇️ Download Stock & Price List</a>
        </div>

        <div class="laptop-ache-card"> 
            <div class="laptop-ache-icon">✅</div>
            <h2>Our Quality Checklist</h2>
            <p>Before any laptop from Laptop Ache is handed over to a customer, we thoroughly inspect several key aspects. This ensures that you can be confident in receiving a top-quality product. You can also follow this guide when you are buying any used laptop.</p>
            <a href="{{ route('check_list') }}" class="laptop-ache-btn">⬇️ Download 21+ Point Checklist</a>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        window.location.href = "{{ route('stock.quality.pdf') }}";
    };
</script>
@endsection