
@extends('layouts.app')

@section('content')
<style>
    .hero {
        text-align: center;
        padding: 100px 20px;
        background: #e5e5e5;
    }

    .hero h1 {
        font-size: 42px;
        margin-bottom: 15px;
    }

    .hero p {
        max-width: 600px;
        margin: 0 auto 25px;
        line-height: 1.7;
    }

    .button {
        display: inline-block;
        background: #171717;
        color: white;
        padding: 13px 24px;
        text-decoration: none;
        border-radius: 5px;
        margin: 5px;
    }

    .content {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        text-align: center;
    }

    .features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-top: 25px;
    }

    .card {
        background: white;
        padding: 25px;
        border-radius: 8px;
    }

    @media (max-width: 600px) {
        .hero h1 {
            font-size: 32px;
        }
    }
</style>

<section class="hero">
    <h1>Capture Your Best Moments</h1>
    <p>
        ADV-EDITS provides photography and videography services
        for weddings, birthdays, and other special events.
        Let us help you preserve your unforgettable memories.
    </p>

    <a class="button" href="{{ route('services.index') }}">Explore Services</a>
</section>

<section class="content">
    <h2>Our Services</h2>
    <p>Professional coverage for your important occasions.</p>

    <div class="features">
        <div class="card">
            <h3>Wedding Coverage</h3>
            <p>Preserve the special moments of your wedding day.</p>
        </div>

        <div class="card">
            <h3>Birthday Coverage</h3>
            <p>Capture celebrations, smiles, and memorable moments.</p>
        </div>

        <div class="card">
            <h3>Special Events</h3>
            <p>Photography and videography for different occasions.</p>
        </div>
    </div>
</section>
@endsection
