
@extends('layouts.app')

@section('content')
<style>
    .services-page {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .intro {
        text-align: center;
        margin-bottom: 30px;
    }

    .services {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 20px;
    }

    .service-card {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
    }

    .service-card h3 {
        margin-top: 0;
    }
</style>

<main class="services-page">
    <section class="intro">
        <h2>Our Services</h2>
        <p>We capture your special moments and turn them into lasting memories.</p>
    </section>

    <section class="services">
        <article class="service-card">
            <h3>Wedding Coverage</h3>
            <p>Photography and videography for weddings and special celebrations.</p>
        </article>

        <article class="service-card">
            <h3>Birthday Coverage</h3>
            <p>Keep the best memories of your birthday and family celebrations.</p>
        </article>

        <article class="service-card">
            <h3>Special Events</h3>
            <p>Photo and video coverage for other important occasions and events.</p>
        </article>
    </section>
</main>
@endsection
