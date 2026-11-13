
@extends('layouts.app')

@section('content')

<style>
    .services-page {
        max-width: 1500px;
        width: 100%;
        margin: auto;
        padding: 32px clamp(16px, 3vw, 38px) 50px;
        color: #30251E;
        box-sizing: border-box;
    }

    .services-page * {
        box-sizing: border-box;
    }

    /* HEADER */
    .services-header {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .services-eyebrow {
        display: block;
        color: #98774F;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2.5px;
        margin-bottom: 8px;
    }

    .services-header h1 {
        color: #30231B;
        font-family: Georgia, serif;
        font-size: clamp(30px, 4vw, 42px);
        font-weight: 500;
        margin: 0;
    }

    .services-header p {
        color: #817264;
        font-size: 12px;
        margin: 8px 0 0;
    }

    .services-header-link {
        color: #76583C;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        border-bottom: 1px solid #C5A477;
        padding-bottom: 5px;
        white-space: nowrap;
    }

    /* FEATURED BANNER */
    .services-banner {
        position: relative;
        height: 290px;
        overflow: hidden;
        border-radius: 9px;
        margin-bottom: 38px;
        background: #30231B;
    }

    .services-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .services-banner::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            90deg,
            rgba(33, 24, 18, .78),
            rgba(33, 24, 18, .12)
        );
    }

    .banner-content {
        position: absolute;
        z-index: 2;
        left: 35px;
        bottom: 32px;
        max-width: 440px;
        color: white;
    }

    .banner-content span {
        display: block;
        color: #E6C69B;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 10px;
    }

    .banner-content h2 {
        font-family: Georgia, serif;
        font-size: clamp(27px, 4vw, 38px);
        font-weight: 500;
        line-height: 1.2;
        margin: 0;
        color: white;
    }

    /* SECTION HEADING */
    .section-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 18px;
    }

    .section-heading h2 {
        color: #30231B;
        font-family: Georgia, serif;
        font-size: 24px;
        font-weight: 500;
        margin: 0;
    }

    .section-heading span {
        color: #98774F;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.5px;
    }

    /* EVENT CATEGORY CARDS */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .service-card {
        position: relative;
        height: 285px;
        overflow: hidden;
        border-radius: 8px;
        background: #E5DACE;
        isolation: isolate;
    }

    .service-card img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        transition: transform .45s ease;
    }

    .service-card:hover img {
        transform: scale(1.05);
    }

    .service-card::after {
        content: "";
        position: absolute;
        inset: 30% 0 0;
        background: linear-gradient(
            to bottom,
            transparent,
            rgba(25, 18, 13, .78)
        );
        z-index: 1;
    }

    .service-card-content {
        position: absolute;
        z-index: 2;
        left: 19px;
        right: 19px;
        bottom: 18px;
    }

    .service-card-content span {
        display: block;
        color: #E7C99E;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 1.6px;
        margin-bottom: 7px;
        text-transform: uppercase;
    }

    .service-card-content h3 {
        color: #FFFFFF;
        font-family: Georgia, serif;
        font-size: 23px;
        font-weight: 500;
        margin: 0;
    }

    /* PACKAGES */
    .packages-section {
        margin-top: 43px;
    }

    .packages-count {
        color: #98774F;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.3px;
    }

    .packages-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .package-card {
        display: flex;
        flex-direction: column;
        background: #FFFCF7;
        border: 1px solid #E5D9C9;
        border-radius: 9px;
        overflow: hidden;
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .package-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 9px 22px rgba(48, 35, 27, .09);
    }

    .package-card-top {
        background: #F0E5D6;
        padding: 20px 21px;
        border-bottom: 1px solid #E5D9C9;
    }

    .package-category {
        display: inline-block;
        padding: 5px 10px;
        background: #FFFCF7;
        color: #76583C;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
        margin-bottom: 11px;
    }

    .package-card-top h3 {
        color: #30231B;
        font-family: Georgia, serif;
        font-size: 21px;
        font-weight: 500;
        line-height: 1.35;
        margin: 0;
    }

    .package-type {
        color: #76583C;
        font-size: 11px;
        margin-top: 6px;
    }

    .package-card-body {
        display: flex;
        flex-direction: column;
        flex: 1;
        padding: 20px 21px;
    }

    .package-price-label {
        color: #98774F;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .package-price {
        color: #30231B;
        font-family: Georgia, serif;
        font-size: 29px;
        font-weight: 600;
        margin: 5px 0 12px;
    }

    .package-description {
        color: #817264;
        font-size: 12px;
        line-height: 1.65;
        margin: 0 0 14px;
    }

    .package-details {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-bottom: 17px;
    }

    .package-detail {
        background: #F3EBE1;
        color: #76583C;
        padding: 6px 9px;
        border-radius: 4px;
        font-size: 10px;
    }

    .package-inclusions-title {
        color: #30231B;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .package-inclusions {
        list-style: none;
        padding: 0;
        margin: 0 0 18px;
    }

    .package-inclusions li {
        position: relative;
        color: #746456;
        font-size: 11px;
        line-height: 1.6;
        padding-left: 17px;
        margin-bottom: 6px;
    }

    .package-inclusions li::before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #98774F;
        font-weight: 700;
    }

    .package-book-button {
        display: block;
        width: 100%;
        margin-top: auto;
        padding: 12px 15px;
        text-align: center;
        text-decoration: none;
        background: #30231B;
        color: #F5EBDD;
        border: 1px solid #30231B;
        border-radius: 5px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .5px;
        transition: .2s ease;
    }

    .package-book-button:hover {
        background: #76583C;
        border-color: #76583C;
        color: white;
    }

    /* EMPTY STATE */
    .packages-empty {
        padding: 35px 20px;
        text-align: center;
        background: #FFFCF7;
        border: 1px dashed #D8C7B2;
        border-radius: 9px;
    }

    .packages-empty h3 {
        color: #30231B;
        font-family: Georgia, serif;
        font-size: 21px;
        font-weight: 500;
        margin: 0 0 8px;
    }

    .packages-empty p {
        color: #817264;
        font-size: 12px;
        margin: 0;
    }

    /* RESPONSIVE */
    @media (max-width: 1000px) {
        .packages-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .service-card {
            height: 245px;
        }
    }

    @media (max-width: 650px) {
        .services-page {
            padding: 25px 14px 35px;
        }

        .services-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .services-header-link {
            margin-top: 2px;
        }

        .services-banner {
            height: 220px;
            margin-bottom: 30px;
        }

        .banner-content {
            left: 19px;
            bottom: 20px;
        }

        .services-grid {
            grid-template-columns: 1fr;
            gap: 13px;
        }

        .service-card {
            height: 230px;
        }

        .section-heading h2 {
            font-size: 21px;
        }

        .packages-section {
            margin-top: 32px;
        }

        .packages-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }
    }
</style>


<main class="services-page">

    {{-- HEADER --}}
    <header class="services-header">
        <div>
            <span class="services-eyebrow">ADV-EDITS / SERVICES</span>
            <h1>Our Services</h1>
            <p>Photography and videography services for different occasions.</p>
        </div>

        <a href="{{ route('gallery') }}" class="services-header-link">
            View Gallery →
        </a>
    </header>


    {{-- FEATURED IMAGE --}}
    <section class="services-banner">
        <img
            src="https://images.unsplash.com/photo-1537633552985-df8429e8048b?auto=format&fit=crop&w=1600&q=85"
            alt="Wedding photography"
        >

        <div class="banner-content">
            <span>ADV-EDITS PORTFOLIO</span>
            <h2>Photography &amp; Videography</h2>
        </div>
    </section>


    {{-- SERVICE CATEGORIES --}}
    <section>

        <div class="section-heading">
            <h2>Service Categories</h2>
            <span>01 / SERVICES</span>
        </div>

        <div class="services-grid">

            <article class="service-card">
                <img
                    src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=900&q=85"
                    alt="Wedding photography"
                    loading="lazy"
                >

                <div class="service-card-content">
                    <span>01 / EVENTS</span>
                    <h3>Wedding Photography</h3>
                </div>
            </article>


            <article class="service-card">
                <img
                    src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?auto=format&fit=crop&w=900&q=85"
                    alt="Birthday event"
                    loading="lazy"
                >

                <div class="service-card-content">
                    <span>02 / CELEBRATIONS</span>
                    <h3>Birthdays &amp; Debuts</h3>
                </div>
            </article>


            <article class="service-card">
                <img
                    src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=900&q=85"
                    alt="Special event"
                    loading="lazy"
                >

                <div class="service-card-content">
                    <span>03 / OCCASIONS</span>
                    <h3>Other Special Events</h3>
                </div>
            </article>

        </div>

    </section>


    {{-- AVAILABLE PACKAGES --}}
    <section class="packages-section" id="available-packages">

        <div class="section-heading">
            <h2>Available Packages</h2>

            <span class="packages-count">
                {{ $services->count() }}
                {{ $services->count() === 1 ? 'PACKAGE' : 'PACKAGES' }}
            </span>
        </div>


        @if($services->isNotEmpty())

            <div class="packages-grid">

                @foreach($services as $service)

                    <article class="package-card">

                        <div class="package-card-top">

                            <span class="package-category">
                                {{ $service->event_type }}
                            </span>

                            <h3>{{ $service->name }}</h3>

                            <div class="package-type">
                                {{ $service->service_type }}
                            </div>

                        </div>


                        <div class="package-card-body">

                            <div class="package-price-label">
                                Package Price
                            </div>

                            <div class="package-price">
                                ₱{{ number_format((float) $service->price, 2) }}
                            </div>


                            @if($service->description)
                                <p class="package-description">
                                    {{ $service->description }}
                                </p>
                            @endif


                            <div class="package-details">

                                @if($service->coverage_hours)
                                    <span class="package-detail">
                                        {{ $service->coverage_hours }} Hours
                                    </span>
                                @endif

                                @if($service->photographer_count)
                                    <span class="package-detail">
                                        {{ $service->photographer_count }}
                                        {{ $service->photographer_count === 1 ? 'Photographer' : 'Photographers' }}
                                    </span>
                                @endif

                                @if($service->videographer_count)
                                    <span class="package-detail">
                                        {{ $service->videographer_count }}
                                        {{ $service->videographer_count === 1 ? 'Videographer' : 'Videographers' }}
                                    </span>
                                @endif

                                @if($service->edited_photo_count)
                                    <span class="package-detail">
                                        {{ $service->edited_photo_count }} Edited Photos
                                    </span>
                                @endif

                                @if($service->video_duration)
                                    <span class="package-detail">
                                        {{ $service->video_duration }}
                                    </span>
                                @endif

                            </div>


                            @if(!empty($service->inclusions))

                                <div class="package-inclusions-title">
                                    Package Inclusions
                                </div>

                                <ul class="package-inclusions">
                                    @foreach($service->inclusions as $inclusion)
                                        <li>{{ $inclusion }}</li>
                                    @endforeach
                                </ul>

                            @endif


                            <a
                                href="{{ route('booking.index', ['service_id' => $service->id]) }}"
                                class="package-book-button"
                            >
                                Book This Package
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="packages-empty">
                <h3>No Available Packages</h3>
                <p>There are currently no service packages available.</p>
            </div>

        @endif

    </section>

</main>

@endsection
