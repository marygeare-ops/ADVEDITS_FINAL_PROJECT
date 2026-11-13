
@extends('layouts.app')

@section('content')

<style>
    .success-page {
        max-width: 600px;
        margin: auto;
        padding: 100px 25px 50px;
    }

    .success-card {
        background: #FFFFFF;
        border: 1px solid #E5D9CB;
        border-radius: 12px;
        padding: 35px 28px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(48, 37, 30, .05);
    }

    .success-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #E5F2E6;
        color: #397247;
        font-size: 30px;
    }

    .success-card h1 {
        color: #30251E;
        font-family: Georgia, serif;
        font-size: 29px;
        margin: 0 0 10px;
    }

    .success-card p {
        color: #8E7662;
        font-size: 13px;
        line-height: 1.7;
    }

    .success-amount {
        background: #30231B;
        border-radius: 9px;
        padding: 20px;
        margin: 22px 0;
    }

    .success-amount small {
        display: block;
        color: #CDB99F;
        font-size: 10px;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .success-amount strong {
        color: #D7B88F;
        font-family: Georgia, serif;
        font-size: 29px;
    }

    .success-reference {
        color: #786555;
        font-size: 12px;
        margin-bottom: 22px;
    }

    .success-link {
        display: inline-block;
        background: #C5A477;
        color: #211812;
        text-decoration: none;
        border-radius: 7px;
        padding: 13px 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .success-link:hover {
        background: #D7B88F;
    }
</style>

<div class="success-page">

    <div class="success-card">

        <div class="success-icon">✓</div>

        <h1>Payment Successful!</h1>

        <p>
            Your payment has been recorded successfully.
            Thank you for choosing ADV-EDITS.
        </p>

        <div class="success-amount">

            <small>AMOUNT PAID</small>

            <strong>
                ₱{{ number_format((float) $payment->total_amount, 2) }}
            </strong>

        </div>

        <div class="success-reference">
            Payment Reference:
            <strong>{{ $payment->transaction_reference }}</strong>
        </div>

        <a href="{{ route('notifications.index') }}" class="success-link">
            Back to Notifications
        </a>

    </div>

</div>

@endsection
