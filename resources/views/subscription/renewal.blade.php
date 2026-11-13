
@extends('layouts.subscription')

@section('title', 'Subscription Renewal | ADV-EDITS')

@section('content')

<style>
    .subscription-heading {
        text-align: center;
        margin-bottom: 30px;
    }

    .subscription-heading .eyebrow {
        color: #E4C18E;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
    }

    .subscription-heading h1 {
        font-family: Georgia, serif;
        font-size: clamp(30px, 5vw, 43px);
        margin: 12px 0;
        color: #FFFFFF;
        text-shadow: 0 3px 15px rgba(0, 0, 0, .5);
    }

    .subscription-heading p {
        color: rgba(255, 255, 255, .88);
        font-size: 14px;
    }

    .subscription-card {
        max-width: 750px;
        margin: auto;
        padding: 35px;
        background: rgba(255, 249, 240, .17);
        border: 1px solid rgba(255, 255, 255, .35);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .3);
        backdrop-filter: blur(22px);
        -webkit-backdrop-filter: blur(22px);
        color: #FFFFFF;
    }

    .plan-label {
        color: #E8C99E;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .plan-price {
        font-family: Georgia, serif;
        font-size: 46px;
        font-weight: 700;
        margin: 12px 0 5px;
        color: #FFFFFF;
    }

    .plan-price span {
        font-family: 'Segoe UI', sans-serif;
        font-size: 14px;
        font-weight: 400;
        color: rgba(255, 255, 255, .8);
    }

    .plan-description {
        color: rgba(255, 255, 255, .85);
        font-size: 13px;
        margin-bottom: 25px;
    }

    .plan-features {
        padding: 20px;
        margin-bottom: 28px;
        background: rgba(255, 255, 255, .13);
        border: 1px solid rgba(255, 255, 255, .18);
        border-radius: 12px;
    }

    .plan-features p {
        margin: 10px 0;
        font-size: 13px;
        color: #FFFFFF;
    }

    .payment-title {
        font-family: Georgia, serif;
        font-size: 23px;
        margin-bottom: 8px;
        color: #FFFFFF;
    }

    .payment-description {
        font-size: 13px;
        color: rgba(255, 255, 255, .85);
        margin-bottom: 22px;
        line-height: 1.7;
    }

    .qr-container {
        padding: 22px;
        text-align: center;
        background: rgba(255, 255, 255, .9);
        border: 1px solid rgba(255, 255, 255, .5);
        border-radius: 14px;
        margin-bottom: 25px;
    }

    .qr-container img {
        width: 240px;
        max-width: 100%;
        border-radius: 8px;
        background: white;
        padding: 8px;
    }

    .qr-placeholder {
        padding: 35px 15px;
        color: #594738;
        font-size: 13px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 9px;
        color: #FFFFFF;
        font-size: 13px;
        font-weight: 600;
    }

    .form-control {
        width: 100%;
        padding: 13px 14px;
        border: 1px solid rgba(255, 255, 255, .4);
        border-radius: 9px;
        background: rgba(255, 255, 255, .92);
        color: #30251E;
        font-family: inherit;
        font-size: 13px;
    }

    .form-control:focus {
        outline: none;
        border-color: #E4C18E;
        box-shadow: 0 0 0 3px rgba(197, 164, 119, .25);
    }

    .help-text {
        margin-top: 7px;
        font-size: 11px;
        color: rgba(255, 255, 255, .8);
    }

    .submit-btn {
        width: 100%;
        padding: 15px;
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 9px;
        background: linear-gradient(135deg, #D9B987, #B78A58);
        color: #211812;
        font-weight: 700;
        font-size: 13px;
        letter-spacing: .5px;
        cursor: pointer;
        transition: .25s;
    }

    .submit-btn:hover {
        background: linear-gradient(135deg, #E8CDA7, #C5A477);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .2);
    }

    .cancel-subscription-btn {
        margin-top: 15px;
        padding: 12px 20px;
        border: 1px solid rgba(255, 170, 160, .7);
        border-radius: 8px;
        background: rgba(179, 67, 55, .9);
        color: #FFFFFF;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
    }

    .cancel-subscription-btn:hover {
        background: #922F27;
        transform: translateY(-2px);
    }

    .status-box {
        padding: 17px;
        margin-bottom: 25px;
        border-radius: 11px;
        background: rgba(255, 255, 255, .14);
        border: 1px solid rgba(255, 255, 255, .25);
    }

    .status-box strong {
        display: block;
        margin-bottom: 6px;
        color: #FFFFFF;
    }

    .status-box p {
        margin: 5px 0;
        font-size: 13px;
        color: rgba(255, 255, 255, .9);
        overflow-wrap: anywhere;
    }

    .status-pending {
        color: #FFD28A;
    }

    .status-approved {
        color: #A7E6B4;
    }

    .status-rejected {
        color: #FFAAA0;
    }

    .alert {
        padding: 13px 15px;
        margin-bottom: 20px;
        border-radius: 9px;
        font-size: 13px;
    }

    .alert-success {
        background: rgba(46, 125, 70, .9);
        color: #FFFFFF;
    }

    .alert-error {
        background: rgba(166, 55, 45, .9);
        color: #FFFFFF;
    }

    .alert ul {
        padding-left: 20px;
        margin: 8px 0 0;
    }

    .field-error {
        color: #FFD0C9;
        font-size: 12px;
        margin-top: 6px;
    }

    @media(max-width: 600px) {
        .subscription-heading {
            margin-bottom: 22px;
        }

        .subscription-card {
            padding: 24px 18px;
            border-radius: 16px;
        }

        .plan-price {
            font-size: 38px;
        }

        .payment-title {
            font-size: 21px;
        }

        .plan-features {
            padding: 15px;
        }
    }
</style>

<div class="subscription-heading">
    <span class="eyebrow">ADV-EDITS MEMBERSHIP</span>
    <h1>Subscription Renewal</h1>
    <p>Keep your business management dashboard active.</p>
</div>

<div class="subscription-card">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            Please check the following:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <span class="plan-label">MONTHLY SUBSCRIPTION PLAN</span>

        <div class="plan-price">
            ₱1,000 <span>/ month</span>
        </div>

        <p class="plan-description">
            Subscription access for the ADV-EDITS business administration panel.
        </p>

        <div class="plan-features">
            <p>✓ Access to the admin dashboard while subscribed</p>
            <p>✓ Booking and appointment management</p>
            <p>✓ Customer and gallery management</p>
            <p>✓ Business reports and records</p>
        </div>
    </div>

    @if($activeSubscription)
        <div class="status-box">
            <strong class="status-approved">✓ Active Subscription</strong>

            <p>
                Expires on:
                {{ $activeSubscription->expires_at->format('F d, Y') }}
            </p>

            <form
                action="{{ route('subscription.cancel') }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to cancel your subscription? Your admin panel access will be disabled immediately.');"
            >
                @csrf

                <button type="submit" class="cancel-subscription-btn">
                    Cancel Subscription
                </button>
            </form>
        </div>
    @endif

    @if($latestPayment)
        <div class="status-box">
            <strong>
                Latest Payment:

                @if($latestPayment->status === 'approved')
                    <span class="status-approved">Approved</span>
                @elseif($latestPayment->status === 'rejected')
                    <span class="status-rejected">Rejected</span>
                @elseif($latestPayment->status === 'cancelled')
                    <span class="status-rejected">Cancelled</span>
                @else
                    <span class="status-pending">Pending Verification</span>
                @endif
            </strong>

            <p>
                Amount: ₱{{ number_format((float) $latestPayment->amount, 2) }}
            </p>

            <p>
                GCash Reference: {{ $latestPayment->gcash_reference }}
            </p>

            @if(in_array($latestPayment->status, ['rejected', 'cancelled']) && $latestPayment->rejection_reason)
                <p>
                    Reason: {{ $latestPayment->rejection_reason }}
                </p>
            @endif

            @if($latestPayment->submitted_at)
                <p>
                    Submitted:
                    {{ $latestPayment->submitted_at->format('F d, Y h:i A') }}
                </p>
            @endif
        </div>
    @endif

    @if(!$latestPayment || in_array($latestPayment->status, ['approved', 'rejected', 'cancelled']))

        <h2 class="payment-title">Pay Through GCash</h2>

        <p class="payment-description">
            Scan the Developer's GCash QR code and pay exactly ₱1,000.
            Upload your payment receipt below for verification.
        </p>

        <div class="qr-container">
            @if($gcashQrUrl)
                <img src="{{ $gcashQrUrl }}" alt="Developer GCash QR Code">
            @else
                <div class="qr-placeholder">
                    Developer GCash QR code has not been configured yet.
                </div>
            @endif
        </div>

        <form
            action="{{ route('subscription.submit') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="form-group">
                <label for="gcash_reference">GCash Reference Number</label>

                <input
                    type="text"
                    id="gcash_reference"
                    name="gcash_reference"
                    class="form-control"
                    value="{{ old('gcash_reference') }}"
                    placeholder="Enter your GCash reference number"
                    maxlength="100"
                    required
                >

                @error('gcash_reference')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="payment_proof">Upload Payment Receipt</label>

                <input
                    type="file"
                    id="payment_proof"
                    name="payment_proof"
                    class="form-control"
                    accept="image/jpeg,image/png,image/webp"
                    required
                >

                <p class="help-text">
                    Accepted formats: JPG, PNG, WEBP. Maximum size: 5MB.
                </p>

                @error('payment_proof')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="submit-btn">
                Submit Subscription Payment
            </button>
        </form>

    @else

        <div class="status-box">
            <strong class="status-pending">Payment Under Verification</strong>

            <p>
                Your payment has already been submitted.
                Please wait for the Developer to verify your transaction.
            </p>
        </div>

    @endif

</div>

@endsection
