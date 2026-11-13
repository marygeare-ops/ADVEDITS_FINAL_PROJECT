
@extends('layouts.app')

@section('content')

<style>
    /* ==========================================
       ADV-EDITS | HIGH-END PHOTOGRAPHY GALLERY
    ========================================== */

    .gallery-page {
        --ink: #30231B;
        --brown: #493629;
        --dark: #211812;
        --gold: #A17E55;
        --champagne: #D9BE9B;
        --muted: #75675A;
        --cream: #F5F0E9;
        --card: #FFFCF7;
        --border: #E5D9CC;

        width: 100%;
        max-width: 1500px;
        margin: auto;
        padding: 30px clamp(16px, 3.5vw, 48px) 60px;
        color: var(--ink);
        box-sizing: border-box;
    }

    .gallery-page *,
    .gallery-page *::before,
    .gallery-page *::after {
        box-sizing: border-box;
    }

    /* ==========================================
       PAGE HEADER
    ========================================== */

    .portfolio-intro {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
        padding: 12px 0 25px;
        margin-bottom: 30px;
        border-bottom: 1px solid var(--border);
    }

    .portfolio-eyebrow {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--gold);
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 2.5px;
        margin-bottom: 12px;
    }

    .portfolio-eyebrow::before {
        content: "";
        width: 25px;
        height: 1px;
        background: var(--gold);
    }

    .portfolio-intro h1 {
        font-family: Georgia, serif;
        font-size: clamp(32px, 3.5vw, 43px);
        line-height: 1.15;
        letter-spacing: 0;
        font-weight: 400;
        color: var(--ink);
        margin: 0 0 10px;
    }

    .portfolio-intro p {
        max-width: 490px;
        font-size: 12px;
        line-height: 1.7;
        color: var(--muted);
        margin: 0;
    }

    .portfolio-side-note {
        flex-shrink: 0;
        text-align: right;
        padding: 12px 16px;
        border: 1px solid #D9C8B3;
    }

    .portfolio-side-note strong {
        display: block;
        font-family: Georgia, serif;
        font-size: 19px;
        font-weight: 400;
        color: var(--gold);
        margin-bottom: 5px;
    }

    .portfolio-side-note span {
        display: block;
        font-size: 8px;
        letter-spacing: 1.5px;
        color: var(--muted);
    }

    /* ==========================================
       SECTION HEADINGS
    ========================================== */

    .portfolio-section {
        margin-top: 39px;
    }

    .portfolio-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 15px;
        margin-bottom: 18px;
    }

    .portfolio-heading small {
        display: block;
        font-size: 8px;
        color: var(--gold);
        font-weight: 800;
        letter-spacing: 1.8px;
        margin-bottom: 6px;
    }

    .portfolio-heading h2 {
        font-family: Georgia, serif;
        font-size: clamp(22px, 2.5vw, 28px);
        font-weight: 400;
        color: var(--ink);
        line-height: 1.25;
        margin: 0;
    }

    .portfolio-heading .section-number {
        color: var(--gold);
        font-size: 8px;
        font-weight: 800;
        letter-spacing: 1.5px;
        white-space: nowrap;
    }

    /* ==========================================
       FEATURED PHOTOGRAPH
    ========================================== */

    .editorial-hero {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(220px, .75fr);
        min-height: 0;
        max-height: 340px;
        background: var(--dark);
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 7px 20px rgba(33, 24, 18, .09);
    }

    .editorial-photo {
        position: relative;
        height: 340px;
        min-height: 0;
        overflow: hidden;
        background: #D8C9B7;
    }

    .editorial-photo img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform .7s ease;
    }

    .editorial-hero:hover .editorial-photo img {
        transform: scale(1.035);
    }

    .editorial-photo::after {
        content: "";
        position: absolute;
        inset: 45% 0 0;
        background: linear-gradient(
            to bottom,
            transparent,
            rgba(20, 14, 10, .55)
        );
        pointer-events: none;
    }

    .editorial-photo-label {
        position: absolute;
        z-index: 2;
        left: 20px;
        bottom: 19px;
        color: #fff;
    }

    .editorial-photo-label span {
        display: block;
        color: var(--champagne);
        font-size: 8px;
        font-weight: 800;
        letter-spacing: 1.8px;
        margin-bottom: 6px;
        text-transform: uppercase;
    }

    .editorial-photo-label h3 {
        font-family: Georgia, serif;
        font-size: 24px;
        font-weight: 400;
        margin: 0;
        color: #fff;
    }

    .editorial-copy {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 25px 30px;
        color: #fff;
    }

    .editorial-copy .mini-label {
        color: var(--champagne);
        font-size: 8px;
        font-weight: 800;
        letter-spacing: 1.8px;
        margin-bottom: 15px;
    }

    .editorial-copy h2 {
        font-family: Georgia, serif;
        font-size: 25px;
        line-height: 1.3;
        font-weight: 400;
        color: #fff;
        margin: 0 0 12px;
    }

    .editorial-copy p {
        color: #E0D6CB;
        font-size: 11px;
        line-height: 1.7;
        margin: 0;
    }

    .editorial-divider {
        width: 35px;
        height: 1px;
        background: var(--gold);
        margin: 17px 0;
    }

    .editorial-copy .editorial-category {
        color: var(--champagne);
        font-size: 8px;
        letter-spacing: 1.8px;
        text-transform: uppercase;
    }

    /* ==========================================
       PHOTOGRAPHY COLLECTION CARDS
    ========================================== */

    .collection-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 17px;
    }

    .collection-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 5px;
        overflow: hidden;
        min-width: 0;
        transition:
            transform .3s ease,
            box-shadow .3s ease,
            border-color .3s ease;
    }

    .collection-card:hover {
        transform: translateY(-4px);
        border-color: #D0B89D;
        box-shadow: 0 12px 25px rgba(48, 35, 27, .10);
    }

    .collection-card-image {
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        background: #E6DACE;
    }

    .collection-card-image img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .6s ease;
    }

    .collection-card:hover .collection-card-image img {
        transform: scale(1.045);
    }

    .collection-card-content {
        padding: 15px 16px;
    }

    .collection-card-content .card-category {
        display: block;
        color: var(--gold);
        font-size: 8px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .collection-card-content h3 {
        font-family: Georgia, serif;
        color: var(--ink);
        font-size: 18px;
        font-weight: 400;
        line-height: 1.3;
        margin: 0 0 7px;
    }

    .collection-card-content p {
        color: var(--muted);
        font-size: 11px;
        line-height: 1.6;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .card-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid var(--border);
        margin-top: 13px;
        padding-top: 10px;
    }

    .card-bottom span {
        color: var(--gold);
        font-size: 8px;
        font-weight: 800;
        letter-spacing: 1.3px;
    }

    .card-bottom i {
        color: var(--gold);
        font-size: 16px;
        font-style: normal;
        transition: transform .25s ease;
    }

    .collection-card:hover .card-bottom i {
        transform: translateX(4px);
    }

    /* ==========================================
       ADDITIONAL PHOTOGRAPHS
    ========================================== */

    .additional-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        grid-auto-rows: 180px;
        gap: 12px;
    }

    .additional-photo {
        position: relative;
        overflow: hidden;
        background: #E5DACE;
        border-radius: 5px;
    }

    .additional-photo img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .6s ease;
    }

    .additional-photo:hover img {
        transform: scale(1.06);
    }

    .additional-photo:nth-child(5n + 1) {
        grid-row: span 2;
    }

    .additional-photo:nth-child(5n + 3) {
        grid-column: span 2;
    }

    /* ==========================================
       EMPTY GALLERY
    ========================================== */

    .portfolio-empty {
        padding: 65px 20px;
        text-align: center;
        border: 1px solid var(--border);
        background: var(--card);
    }

    .portfolio-empty h2 {
        font-family: Georgia, serif;
        font-size: 25px;
        font-weight: 400;
        color: var(--ink);
        margin: 0 0 9px;
    }

    .portfolio-empty p {
        color: var(--muted);
        font-size: 11px;
        line-height: 1.7;
        margin: 0;
    }

    /* ==========================================
       ANIMATIONS
    ========================================== */

    @keyframes galleryFade {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .portfolio-intro,
    .editorial-hero,
    .collection-card {
        animation: galleryFade .55s ease both;
    }

    /* ==========================================
       TABLET
    ========================================== */

    @media (max-width: 1000px) {
        .editorial-hero {
            grid-template-columns: 1.2fr .8fr;
            max-height: 320px;
        }

        .editorial-photo {
            height: 320px;
        }

        .collection-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .additional-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    /* ==========================================
       MOBILE
    ========================================== */

    @media (max-width: 650px) {
        .gallery-page {
            padding: 22px 15px 45px;
        }

        .portfolio-intro {
            flex-direction: column;
            align-items: flex-start;
            padding: 10px 0 22px;
            margin-bottom: 25px;
        }

        .portfolio-intro h1 {
            font-size: 34px;
        }

        .portfolio-intro p {
            font-size: 11px;
        }

        .portfolio-side-note {
            text-align: left;
            padding: 9px 12px;
        }

        .portfolio-section {
            margin-top: 32px;
        }

        .portfolio-heading {
            align-items: flex-start;
            flex-direction: column;
            gap: 7px;
        }

        .portfolio-heading h2 {
            font-size: 23px;
        }

        .editorial-hero {
            grid-template-columns: 1fr;
            max-height: none;
        }

        .editorial-photo {
            height: 230px;
        }

        .editorial-copy {
            padding: 20px;
        }

        .editorial-copy h2 {
            font-size: 23px;
        }

        .editorial-copy p {
            font-size: 11px;
        }

        .collection-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 11px;
        }

        .collection-card-content {
            padding: 13px;
        }

        .collection-card-content h3 {
            font-size: 16px;
        }

        .collection-card-content p {
            font-size: 10px;
        }

        .card-bottom {
            margin-top: 10px;
            padding-top: 9px;
        }

        .additional-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            grid-auto-rows: 145px;
            gap: 9px;
        }

        .additional-photo:nth-child(5n + 3) {
            grid-column: span 1;
        }
    }

    @media (max-width: 380px) {
        .collection-grid {
            grid-template-columns: 1fr;
        }

        .collection-card-image {
            aspect-ratio: 16 / 10;
        }
    }

    /* ACCESSIBILITY */

    @media (prefers-reduced-motion: reduce) {
        .gallery-page *,
        .gallery-page *::before,
        .gallery-page *::after {
            animation: none !important;
            transition: none !important;
        }
    }
</style>


<div class="gallery-page">

    {{-- PAGE INTRODUCTION --}}

    <header class="portfolio-intro">

        <div>
            <span class="portfolio-eyebrow">
                ADV-EDITS / PORTFOLIO
            </span>

            <h1>Gallery</h1>

            <p>
                A collection of photography and videography projects
                featuring portraits, celebrations, events, and
                studio photography.
            </p>
        </div>

        <div class="portfolio-side-note">
            <strong>ADV-EDITS</strong>
            <span>PHOTOGRAPHY &amp; VIDEOGRAPHY</span>
        </div>

    </header>


    {{-- FEATURED PHOTOGRAPH --}}

    @if($featuredImages->isNotEmpty())

        @php
            $featured = $featuredImages->first();
        @endphp

        <section class="portfolio-section">

            <div class="portfolio-heading">
                <div>
                    <small>SELECTED WORK</small>
                    <h2>Featured Collection</h2>
                </div>

                <span class="section-number">01 / FEATURED</span>
            </div>

            <article class="editorial-hero">

                <div class="editorial-photo">

                    <img
                        src="{{ asset('storage/' . $featured->image) }}"
                        alt="{{ $featured->title }}"
                        fetchpriority="high"
                    >

                    <div class="editorial-photo-label">
                        <span>
                            {{ $featured->category ?: 'Photography' }}
                        </span>

                        <h3>{{ $featured->title }}</h3>
                    </div>

                </div>

                <div class="editorial-copy">

                    <span class="mini-label">
                        ADV-EDITS / FEATURED
                    </span>

                    <h2>{{ $featured->title }}</h2>

                    <p>
                        {{ $featured->description ?: 'Photography collection by ADV-EDITS.' }}
                    </p>

                    <div class="editorial-divider"></div>

                    <span class="editorial-category">
                        {{ $featured->category ?: 'Photography' }}
                    </span>

                </div>

            </article>

        </section>

    @endif


    {{-- PHOTOGRAPHY COLLECTION CARDS --}}

    @if($collectionImages->isNotEmpty())

        <section class="portfolio-section">

            <div class="portfolio-heading">
                <div>
                    <small>PHOTO COLLECTIONS</small>
                    <h2>Photography Collections</h2>
                </div>

                <span class="section-number">02 / COLLECTIONS</span>
            </div>

            <div class="collection-grid">

                @foreach($collectionImages as $image)

                    <article class="collection-card">

                        <div class="collection-card-image">

                            <img
                                src="{{ asset('storage/' . $image->image) }}"
                                alt="{{ $image->title }}"
                                loading="lazy"
                            >

                        </div>

                        <div class="collection-card-content">

                            <span class="card-category">
                                {{ $image->category ?: 'Photography' }}
                            </span>

                            <h3>{{ $image->title }}</h3>

                            <p>
                                {{ $image->description ?: 'Photography collection by ADV-EDITS.' }}
                            </p>

                            <div class="card-bottom">
                                <span>ADV-EDITS</span>
                                <i aria-hidden="true">↗</i>
                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        </section>

    @endif


    {{-- ADDITIONAL PHOTOGRAPHS --}}

    @if($additionalImages->isNotEmpty())

        <section class="portfolio-section">

            <div class="portfolio-heading">
                <div>
                    <small>PHOTO SELECTION</small>
                    <h2>Additional Photographs</h2>
                </div>

                <span class="section-number">03 / MORE WORKS</span>
            </div>

            <div class="additional-grid">

                @foreach($additionalImages as $image)

                    <div class="additional-photo">

                        <img
                            src="{{ asset('storage/' . $image->image) }}"
                            alt="{{ $image->title }}"
                            loading="lazy"
                        >

                    </div>

                @endforeach

            </div>

        </section>

    @endif


    {{-- EMPTY GALLERY --}}

    @if($totalImages === 0)

        <div class="portfolio-empty">

            <h2>Gallery</h2>

            <p>
                Photography and videography projects will be displayed here.
            </p>

        </div>

    @endif

</div>

@endsection
