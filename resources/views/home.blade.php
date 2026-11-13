
@extends(auth()->check() ? 'layouts.app' : 'layouts.guest')

@section('content')

@php
    $bookingUrl = auth()->check()
        ? route('booking.index')
        : route('customer.login');
@endphp

<style>
    .adv-home {
        --brown: #211812;
        --brown-light: #30231B;
        --brown-hover: #3B2B21;
        --gold: #C5A477;
        --gold-light: #D7B88F;
        --cream: #F4EFE8;
        --light: #F5EBDD;
        --text: #30251E;
        --muted: #8E7662;
        --card: #FFFCF7;
        background: var(--cream);
        color: var(--text);
        font-family: 'Segoe UI', Arial, sans-serif;
        overflow: hidden;
    }

    .adv-home *,
    .adv-home *::before,
    .adv-home *::after {
        box-sizing: border-box;
    }

    .adv-container {
        width: min(1160px, 90%);
        margin: 0 auto;
    }

    .adv-hero {
        position: relative;
        min-height: 440px;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: var(--brown);
    }

    .adv-hero-image {
        position: absolute;
        inset: 0;
    }

    .adv-hero-image img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        object-position: center 48%;
    }

    .adv-hero-image::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            90deg,
            rgba(33, 24, 18, .94) 0%,
            rgba(33, 24, 18, .79) 43%,
            rgba(33, 24, 18, .22) 100%
        );
    }

    .adv-hero-content {
        position: relative;
        z-index: 2;
        width: min(1160px, 90%);
        margin: 0 auto;
        padding: 65px 0;
    }

    .adv-hero-label {
        color: var(--gold-light);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2.5px;
        margin-bottom: 17px;
    }

    .adv-hero h1 {
        max-width: 570px;
        color: var(--light);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(36px, 4.5vw, 56px);
        font-weight: 400;
        line-height: 1.15;
        margin: 0 0 17px;
    }

    .adv-hero p {
        max-width: 440px;
        color: #E1D4C6;
        font-size: 13px;
        line-height: 1.8;
        margin: 0;
    }

    .adv-highlights {
        background: var(--brown);
        border-top: 1px solid rgba(197, 164, 119, .25);
    }

    .adv-highlights-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        padding: 20px 0;
    }

    .adv-highlight {
        padding: 5px 25px;
        border-right: 1px solid rgba(197, 164, 119, .3);
    }

    .adv-highlight:first-child {
        padding-left: 0;
    }

    .adv-highlight:last-child {
        border-right: 0;
    }

    .adv-highlight strong {
        display: block;
        color: var(--gold-light);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 17px;
        font-weight: 400;
        margin-bottom: 5px;
    }

    .adv-highlight span {
        color: #C7B8A9;
        font-size: 10px;
    }

    .adv-section {
        padding: 72px 0;
    }

    .adv-section-heading {
        display: flex;
        justify-content: space-between;
        align-items: end;
        margin-bottom: 28px;
        gap: 20px;
    }

    .adv-section-heading small {
        display: block;
        color: var(--muted);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 9px;
    }

    .adv-section-heading h2 {
        color: var(--brown);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(29px, 3.5vw, 39px);
        font-weight: 400;
        line-height: 1.2;
        margin: 0;
    }

    .adv-section-heading p {
        max-width: 390px;
        color: var(--muted);
        font-size: 11px;
        line-height: 1.8;
        margin: 0;
    }

    .adv-services {
        background: var(--cream);
    }

    .adv-service-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .adv-service-card {
        background: var(--card);
        border: 1px solid #E8DED2;
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .adv-service-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(33, 24, 18, .08);
    }

    .adv-service-image {
        height: 175px;
        overflow: hidden;
        background: var(--brown-light);
    }

    .adv-service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .5s ease;
    }

    .adv-service-card:hover .adv-service-image img {
        transform: scale(1.05);
    }

    .adv-service-content {
        padding: 18px 16px 20px;
    }

    .adv-service-content small {
        display: block;
        color: var(--gold);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 1.5px;
        margin-bottom: 9px;
    }

    .adv-service-content h3 {
        color: var(--brown);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 18px;
        font-weight: 400;
        margin: 0 0 8px;
    }

    .adv-service-content p {
        color: var(--muted);
        font-size: 11px;
        line-height: 1.7;
        margin: 0;
    }

    .adv-details {
        background: #EAE1D6;
    }

    .adv-details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 55px;
    }

    .adv-details-content small {
        color: var(--muted);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .adv-details-content h2 {
        color: var(--brown);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(30px, 3.5vw, 42px);
        font-weight: 400;
        line-height: 1.2;
        margin: 14px 0;
    }

    .adv-details-content > p {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.9;
        margin-bottom: 22px;
    }

    .adv-detail-cards {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .adv-detail-card {
        padding: 16px;
        background: rgba(255, 252, 247, .75);
        border: 1px solid rgba(197, 164, 119, .3);
    }

    .adv-detail-card strong {
        display: block;
        color: var(--brown);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 15px;
        font-weight: 400;
        margin-bottom: 6px;
    }

    .adv-detail-card span {
        color: var(--muted);
        font-size: 10px;
        line-height: 1.6;
    }

    .adv-details-image {
        height: 370px;
        overflow: hidden;
    }

    .adv-details-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .adv-about {
        background: var(--brown);
        color: var(--light);
    }

    .adv-about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 55px;
    }

    .adv-about-image {
        height: 365px;
        overflow: hidden;
    }

    .adv-about-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .adv-about-content small {
        color: var(--gold);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .adv-about-content h2 {
        color: var(--light);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(30px, 3.5vw, 42px);
        font-weight: 400;
        line-height: 1.2;
        margin: 14px 0;
    }

    .adv-about-content p {
        color: #C7B8A9;
        font-size: 12px;
        line-height: 1.9;
        margin: 0;
    }

    /* GALLERY */

    .adv-gallery {
        background: var(--cream);
    }

    .adv-gallery-grid {
        display: grid;
        grid-template-columns: 1.15fr 1fr 1fr;
        grid-template-rows: 210px 210px;
        gap: 12px;
    }

    .adv-gallery-item {
        position: relative;
        overflow: hidden;
        background: var(--brown);
    }

    .adv-gallery-item:first-child {
        grid-row: span 2;
    }

    .adv-gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .5s ease;
    }

    .adv-gallery-item:hover img {
        transform: scale(1.05);
    }

    .adv-gallery-item::after {
        content: "";
        position: absolute;
        inset: 35% 0 0;
        background: linear-gradient(transparent, rgba(33, 24, 18, .78));
    }

    .adv-gallery-caption {
        position: absolute;
        bottom: 15px;
        left: 16px;
        z-index: 2;
        color: var(--light);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 16px;
    }

    .adv-gallery-empty {
        grid-column: 1 / -1;
        padding: 45px 20px;
        text-align: center;
        background: var(--card);
        border: 1px solid #E8DED2;
    }

    .adv-gallery-empty h3 {
        color: var(--brown);
        font-family: Georgia, 'Times New Roman', serif;
        font-weight: 400;
    }

    .adv-gallery-empty p {
        color: var(--muted);
        font-size: 12px;
    }

    .adv-booking {
        padding: 55px 0;
        background: #EAE1D6;
    }

    .adv-booking-inner {
        background: var(--brown);
        padding: 43px 25px;
        text-align: center;
    }

    .adv-booking-inner small {
        color: var(--gold);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .adv-booking-inner h2 {
        color: var(--light);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(29px, 4vw, 40px);
        font-weight: 400;
        margin: 13px 0;
    }

    .adv-booking-inner p {
        max-width: 450px;
        margin: 0 auto 22px;
        color: #C7B8A9;
        font-size: 11px;
        line-height: 1.8;
    }

    .adv-booking-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 13px 25px;
        background: var(--gold);
        border: 1px solid var(--gold);
        color: var(--brown);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        text-decoration: none;
        transition: .2s ease;
    }

    .adv-booking-button:hover {
        background: var(--gold-light);
        border-color: var(--gold-light);
        color: var(--brown);
    }

    @media (max-width: 900px) {
        .adv-service-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .adv-details-grid,
        .adv-about-grid {
            gap: 30px;
        }
    }

    @media (max-width: 600px) {
        .adv-hero {
            min-height: 390px;
        }

        .adv-hero-image::after {
            background: rgba(33, 24, 18, .72);
        }

        .adv-hero-content {
            padding: 55px 0;
        }

        .adv-hero h1 {
            font-size: 39px;
        }

        .adv-hero p {
            font-size: 11px;
        }

        .adv-highlights-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .adv-highlight,
        .adv-highlight:first-child {
            padding: 5px 0 12px;
            border-right: 0;
            border-bottom: 1px solid rgba(197, 164, 119, .25);
        }

        .adv-highlight:last-child {
            border-bottom: 0;
            padding-bottom: 5px;
        }

        .adv-section {
            padding: 55px 0;
        }

        .adv-section-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .adv-section-heading p {
            max-width: 100%;
        }

        .adv-service-grid {
            gap: 10px;
        }

        .adv-service-image {
            height: 135px;
        }

        .adv-service-content {
            padding: 13px 11px 15px;
        }

        .adv-service-content h3 {
            font-size: 16px;
        }

        .adv-service-content p {
            font-size: 10px;
        }

        .adv-details-grid,
        .adv-about-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .adv-details-image {
            height: 290px;
        }

        .adv-about-image {
            height: 290px;
        }

        .adv-gallery-grid {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 220px 150px 150px;
            gap: 9px;
        }

        .adv-gallery-item:first-child {
            grid-column: span 2;
            grid-row: auto;
        }

        .adv-gallery-caption {
            left: 11px;
            bottom: 11px;
            font-size: 13px;
        }

        .adv-booking {
            padding: 35px 0;
        }

        .adv-booking-inner {
            padding: 35px 17px;
        }
    }

    @media (max-width: 380px) {
        .adv-service-grid {
            grid-template-columns: 1fr;
        }

        .adv-service-image {
            height: 180px;
        }
    }
</style>

<div class="adv-home">

    <!-- HERO -->
    <section class="adv-hero">

        <div class="adv-hero-image">
            <img
                src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=1600&q=85"
                alt="Professional photography camera"
            >
        </div>

        <div class="adv-hero-content">

            <div class="adv-hero-label">
                ADV-EDITS | PHOTOGRAPHY STUDIO
            </div>

            <h1>
                Photography and<br>
                Videography Services
            </h1>

            <p>
                Professional coverage, image enhancement,
                and video production for personal and
                business requirements.
            </p>

        </div>

    </section>

    <!-- SERVICE HIGHLIGHTS -->
    <section class="adv-highlights">
        <div class="adv-container adv-highlights-grid">

            <div class="adv-highlight">
                <strong>Photography</strong>
                <span>Portrait and event coverage</span>
            </div>

            <div class="adv-highlight">
                <strong>Videography</strong>
                <span>Event and occasion filming</span>
            </div>

            <div class="adv-highlight">
                <strong>Editing Services</strong>
                <span>Photo and video post-production</span>
            </div>

        </div>
    </section>

    <!-- SERVICES OVERVIEW -->
    <section class="adv-section adv-services">
        <div class="adv-container">

            <div class="adv-section-heading">
                <div>
                    <small>OUR SERVICES</small>
                    <h2>Services Overview</h2>
                </div>

                <p>
                    The following services are available
                    through the ADV-EDITS booking platform.
                </p>
            </div>

            <div class="adv-service-grid">

                <article class="adv-service-card">
                    <div class="adv-service-image">
                        <img
                            src="https://images.unsplash.com/photo-1537633552985-df8429e8048b?auto=format&fit=crop&w=700&q=85"
                            alt="Photography"
                            loading="lazy"
                        >
                    </div>
                    <div class="adv-service-content">
                        <small>SERVICE 01</small>
                        <h3>Photography</h3>
                        <p>
                            Portrait photography, event coverage,
                            and documentation of special occasions.
                        </p>
                    </div>
                </article>

                <article class="adv-service-card">
                    <div class="adv-service-image">
                        <img
                            src="https://images.unsplash.com/photo-1492619375914-88005aa9e8fb?auto=format&fit=crop&w=700&q=85"
                            alt="Videography"
                            loading="lazy"
                        >
                    </div>
                    <div class="adv-service-content">
                        <small>SERVICE 02</small>
                        <h3>Videography</h3>
                        <p>
                            Video recording for events,
                            celebrations, and other occasions.
                        </p>
                    </div>
                </article>

                <article class="adv-service-card">
                    <div class="adv-service-image">
                        <img
                            src="https://images.unsplash.com/photo-1536240478700-b869070f9279?auto=format&fit=crop&w=700&q=85"
                            alt="Video editing"
                            loading="lazy"
                        >
                    </div>
                    <div class="adv-service-content">
                        <small>SERVICE 03</small>
                        <h3>Video Editing</h3>
                        <p>
                            Video trimming, sequencing,
                            transitions, and post-production.
                        </p>
                    </div>
                </article>

                <article class="adv-service-card">
                    <div class="adv-service-image">
                        <img
                            src="https://images.unsplash.com/photo-1542038784456-1ea8e935640e?auto=format&fit=crop&w=700&q=85"
                            alt="Photo editing"
                            loading="lazy"
                        >
                    </div>
                    <div class="adv-service-content">
                        <small>SERVICE 04</small>
                        <h3>Photo Editing</h3>
                        <p>
                            Image correction, color adjustment,
                            and digital retouching.
                        </p>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <!-- SERVICE DETAILS -->
    <section class="adv-section adv-details">
        <div class="adv-container adv-details-grid">

            <div class="adv-details-content">

                <small>SERVICE INFORMATION</small>

                <h2>Available Service Categories</h2>

                <p>
                    Customers may select from the available
                    photography, videography, and editing
                    services. Each service has its own booking
                    details and requirements.
                </p>

                <div class="adv-detail-cards">

                    <div class="adv-detail-card">
                        <strong>Photo Coverage</strong>
                        <span>Portraits and event photography.</span>
                    </div>

                    <div class="adv-detail-card">
                        <strong>Video Coverage</strong>
                        <span>Recording of scheduled occasions.</span>
                    </div>

                    <div class="adv-detail-card">
                        <strong>Video Editing</strong>
                        <span>Editing of supplied video materials.</span>
                    </div>

                    <div class="adv-detail-card">
                        <strong>Photo Enhancement</strong>
                        <span>Correction and retouching of images.</span>
                    </div>

                </div>

            </div>

            <div class="adv-details-image">
                <img
                    src="https://images.unsplash.com/photo-1452587925148-ce544e77e70d?auto=format&fit=crop&w=1000&q=85"
                    alt="Photography workspace"
                    loading="lazy"
                >
            </div>

        </div>
    </section>

    <!-- ABOUT -->
    <section class="adv-section adv-about">
        <div class="adv-container adv-about-grid">

            <div class="adv-about-image">
                <img
                    src="https://images.unsplash.com/photo-1502982720700-bfff97f2ecac?auto=format&fit=crop&w=1000&q=85"
                    alt="Camera equipment"
                    loading="lazy"
                >
            </div>

            <div class="adv-about-content">

                <small>ABOUT ADV-EDITS</small>

                <h2>Photography and Digital Production</h2>

                <p>
                    ADV-EDITS provides photography,
                    videography, and digital editing services.
                    The website allows customers to review
                    available services, submit appointment
                    requests, and access their booking
                    information through a customer account.
                </p>

            </div>

        </div>
    </section>

    <!-- GALLERY -->
    <section class="adv-section adv-gallery">
        <div class="adv-container">

            <div class="adv-section-heading">
                <div>
                    <small>PORTFOLIO</small>
                    <h2>Gallery Overview</h2>
                </div>

                <p>
                    A selection of our latest photography
                    and creative work.
                </p>
            </div>

            <div class="adv-gallery-grid">

                @forelse ($homeGallery as $gallery)
                    <div class="adv-gallery-item">
                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($gallery->image) }}"
                            alt="{{ $gallery->title }}"
                            loading="lazy"
                        >

                        <span class="adv-gallery-caption">
                            {{ $gallery->title }}
                        </span>
                    </div>
                @empty
                    <div class="adv-gallery-empty">
                        <h3>No Gallery Images Yet</h3>
                        <p>
                            Published gallery images will appear here.
                        </p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

    <!-- BOOKING -->
    <section class="adv-booking">
        <div class="adv-container">

            <div class="adv-booking-inner">

                <small>APPOINTMENT BOOKING</small>

                <h2>Schedule a Service</h2>

                <p>
                    Sign in to your customer account to
                    review available services and submit
                    an appointment request.
                </p>

                <a href="{{ $bookingUrl }}" class="adv-booking-button">
                    START BOOKING
                </a>

            </div>

        </div>
    </section>

</div>

@endsection
