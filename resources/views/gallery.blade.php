
@extends('layouts.app')

@section('content')
<style>
    .gallery-page {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .gallery-intro {
        text-align: center;
        margin-bottom: 35px;
    }

    .gallery-intro h1 {
        font-size: 36px;
        margin-bottom: 12px;
    }

    .gallery-intro p {
        color: #555;
        line-height: 1.7;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
    }

    .gallery-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
    }

    .gallery-placeholder {
        height: 200px;
        background: #dedede;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #555;
        font-size: 16px;
    }

    .gallery-card h3 {
        margin: 18px 18px 8px;
    }

    .gallery-card p {
        margin: 0 18px 20px;
        color: #555;
        line-height: 1.5;
    }

    @media (max-width: 600px) {
        .gallery-intro h1 {
            font-size: 28px;
        }
    }
</style>

<div class="gallery-page">
    <section class="gallery-intro">
        <h1>Our Gallery</h1>
        <p>
            Explore our photography and videography work
            and see how we capture life's special moments.
        </p>
    </section>

    <section class="gallery-grid">
        <article class="gallery-card">
            <div class="gallery-placeholder">Wedding Photography</div>
            <h3>Wedding Moments</h3>
            <p>Beautiful memories from weddings and special celebrations.</p>
        </article>

        <article class="gallery-card">
            <div class="gallery-placeholder">Birthday Photography</div>
            <h3>Birthday Celebrations</h3>
            <p>Capturing smiles, laughter, and unforgettable birthday moments.</p>
        </article>

        <article class="gallery-card">
            <div class="gallery-placeholder">Event Photography</div>
            <h3>Special Events</h3>
            <p>Memorable highlights from different events and occasions.</p>
        </article>
    </section>
</div>
@endsection
