
@extends('layouts.app')

@section('content')

<style>
    .checkout-page {
        max-width: 650px;
        margin: auto;
        padding: 90px 25px 50px;
    }

    .checkout-card {
        background: #FFFFFF;
        border: 1px solid #E5D9CB;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(48, 37, 30, .05);
    }

    .checkout-card h1 {
        color: #30251E;
        font-family: Georgia, serif;
        font-size: 29px;
        margin: 0 0 8px;
    }

    .checkout-subtitle {
        color: #8E7662;
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .checkout-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 13px 0;
        border-bottom: 1px solid #EEE5DB;
        color: #786555;
        font-size: 13px;
    }

    .checkout-row strong {
        color: #493528;
        text-align: right;
    }

    .checkout-total {
        background: #30231B;
        border-radius: 9px;
        padding: 20px;
        margin: 22px 0;
    }

    .checkout-total small {
        color: #CDB99F;
        display: block;
        font-size: 10px;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .checkout-total strong {
        color: #D7B88F;
        font-family: Georgia, serif;
        font-size: 30px;
    }

    .checkout-section {
        background: #F8F4EF;
        border: 1px solid #E9DED1;
        border-radius: 9px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .checkout-section h3 {
        color: #493528;
        font-size: 15px;
        margin: 0 0 12px;
    }

    .checkout-section p {
        color: #8E7662;
        font-size: 12px;
        line-height: 1.7;
        margin: 5px 0;
    }

    .qr-container {
        display: flex;
        justify-content: center;
        padding: 15px;
        background: white;
        border-radius: 9px;
        margin: 15px auto;
    }

    .qr-container img {
        width: 100%;
        max-width: 260px;
        object-fit: contain;
    }

    .qr-missing {
        background: #F1E8DD;
        padding: 25px;
        text-align: center;
        border-radius: 8px;
        color: #8E7662;
        font-size: 13px;
    }

    .payment-field {
        margin-bottom: 18px;
    }

    .payment-field label {
        display: block;
        color: #493528;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .payment-field input {
        width: 100%;
        padding: 12px;
        border: 1px solid #DCCDBD;
        border-radius: 7px;
        background: #FFFFFF;
        color: #493528;
        font-size: 13px;
    }

    .payment-field input:focus {
        outline: none;
        border-color: #C5A477;
    }

    .field-error {
        color: #B42318;
        font-size: 12px;
        margin-top: 6px;
    }

    .checkout-button,
    .cancel-button {
        border: 0;
        border-radius: 7px;
        padding: 13px 18px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
    }

    .checkout-button {
        background: #C5A477;
        color: #211812;
    }

    .checkout-button:hover {
        background: #D7B88F;
    }

    .cancel-button {
        background: #F1E8DD;
        color: #493528;
    }

    .checkout-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    @media (max-width: 480px) {
        .checkout-card {
            padding: 22px;
        }

        .checkout-card h1 {
            font-size: 25px;
        }
    }
</style>

<div class="checkout-page">
    <div class="checkout-card">

        <h1>Complete Your Downpayment</h1>

        <p class="checkout-subtitle">
            Scan the official GCash QR code below and upload your payment receipt after completing your transaction.
        </p>

        <div class="checkout-row">
            <span>Booking Reference</span>
            <strong>#{{ $booking->id }}</strong>
        </div>

        <div class="checkout-row">
            <span>Customer</span>
            <strong>{{ $booking->customer_name }}</strong>
        </div>

        <div class="checkout-row">
            <span>Service</span>
            <strong>{{ $booking->service_name_snapshot ?? $booking->service }}</strong>
        </div>

        <div class="checkout-row">
            <span>Event Date</span>
            <strong>{{ $booking->event_date?->format('F d, Y') }}</strong>
        </div>

        <div class="checkout-row">
            <span>Total Service Price</span>
            <strong>₱{{ number_format((float) $booking->total_amount, 2) }}</strong>
        </div>

        <div class="checkout-total">
            <small>50% DOWNPAYMENT TO PAY</small>
            <strong>₱{{ number_format((float) $payment->total_amount, 2) }}</strong>
        </div>

        <div class="checkout-section">
            <h3>Pay Through GCash</h3>

            <p>1. Open your GCash application.</p>
            <p>2. Select Scan QR and scan the QR code below.</p>
            <p>3. Enter the exact downpayment amount shown above.</p>
            <p>4. Complete your payment and save your receipt.</p>

            @if(isset($paymentSetting) && $paymentSetting->gcash_qr_code)
                <div class="qr-container">
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($paymentSetting->gcash_qr_code) }}"
                        alt="ADV Edits GCash QR Code"
                    >
                </div>
            @else
                <div class="qr-missing">
                    The GCash QR code is not yet available. Please contact ADV Edits before making your payment.
                </div>
            @endif

            <p>
                Payment Reference: <strong>{{ $payment->transaction_reference }}</strong>
            </p>
        </div>

        @if($payment->payment_proof)
            <div class="checkout-section">
                <h3>Payment Proof Submitted</h3>
                <p>Your payment receipt has already been submitted and is awaiting admin verification.</p>
            </div>
        @else
            <div class="checkout-section">
                <h3>Submit Your Payment Proof</h3>

                <form
                    action="{{ route('payments.submit-proof', $payment) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <div class="payment-field">
                        <label for="gcash_reference">GCash Transaction Reference Number</label>
                        <input
                            type="text"
                            id="gcash_reference"
                            name="gcash_reference"
                            value="{{ old('gcash_reference') }}"
                            placeholder="Enter your GCash transaction reference"
                            required
                        >

                        @error('gcash_reference')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="payment-field">
                        <label for="payment_proof">Upload Payment Receipt</label>
                        <input
                            type="file"
                            id="payment_proof"
                            name="payment_proof"
                            accept="image/jpeg,image/png,image/jpg"
                            required
                        >

                        <p>Accepted formats: JPG and PNG. Maximum file size: 2MB.</p>

                        @error('payment_proof')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="checkout-button"
                        @if(!isset($paymentSetting) || !$paymentSetting->gcash_qr_code) disabled @endif
                    >
                        Submit Payment Proof
                    </button>
                </form>
            </div>
        @endif

        <div class="checkout-actions">
            <form action="{{ route('payments.cancel', $payment) }}" method="POST">
                @csrf
                <button type="submit" class="cancel-button">
                    Cancel
                </button>
            </form>
        </div>

    </div>
</div>

@endsection
