
@extends('layouts.app')

@section('content')

<style>
    .payments-page {
        max-width: 1100px;
        margin: auto;
        padding: 35px 25px 60px;
        color: #30251E;
    }

    .payments-header {
        margin-bottom: 30px;
    }

    .payments-header span {
        color: #A1845E;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .payments-header h1 {
        font-size: 34px;
        margin: 8px 0;
    }

    .payments-header p {
        color: #806D5D;
        font-size: 14px;
        line-height: 1.6;
    }

    .payments-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 25px;
        align-items: start;
    }

    .payment-card {
        background: #fff;
        border: 1px solid #E4D9CC;
        border-radius: 14px;
        padding: 28px;
        box-shadow: 0 5px 20px rgba(48, 37, 30, 0.05);
    }

    .payment-card h2 {
        font-size: 19px;
        margin: 0 0 20px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #493528;
    }

    .form-group input {
        width: 100%;
        padding: 13px 14px;
        border: 1px solid #DCCFC1;
        border-radius: 8px;
        background: #FFFEFC;
        color: #30251E;
        font-size: 14px;
        outline: none;
        box-sizing: border-box;
    }

    .form-group input:focus {
        border-color: #A1845E;
        box-shadow: 0 0 0 3px rgba(161, 132, 94, 0.12);
    }

    .field-error {
        color: #B34236;
        font-size: 12px;
        margin-top: 6px;
    }

    .payment-method {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 15px;
        border: 1px solid #DCCFC1;
        border-radius: 10px;
        margin-bottom: 22px;
        background: #FFFEFC;
    }

    .method-icon {
        width: 45px;
        height: 45px;
        border-radius: 9px;
        background: #EDE4D9;
        color: #493528;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        font-weight: 700;
    }

    .payment-method strong {
        display: block;
        font-size: 14px;
    }

    .payment-method small {
        color: #806D5D;
        font-size: 12px;
    }

    .submit-btn {
        width: 100%;
        padding: 14px;
        background: #493528;
        color: #F5EBDD;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
    }

    .submit-btn:hover {
        background: #30231B;
    }

    .info-card {
        background: #493528;
        color: #F5EBDD;
        border-radius: 14px;
        padding: 28px;
    }

    .info-card h2 {
        font-size: 19px;
        margin: 0 0 15px;
    }

    .info-card p {
        color: #D8C8B7;
        font-size: 13px;
        line-height: 1.7;
    }

    .info-item {
        padding: 14px 0;
        border-bottom: 1px solid #705A48;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-item strong {
        display: block;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .info-item span {
        color: #D8C8B7;
        font-size: 12px;
    }

    .demo-notice {
        background: #FFF8E9;
        border: 1px solid #E8D4A8;
        border-radius: 10px;
        padding: 15px;
        color: #715B35;
        font-size: 12px;
        line-height: 1.6;
        margin-bottom: 22px;
    }

    .demo-notice strong {
        display: block;
        margin-bottom: 5px;
        color: #604820;
    }

    .alert-error {
        background: #FCEBE8;
        border: 1px solid #E9C2BC;
        color: #963D32;
        padding: 13px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    @media (max-width: 850px) {
        .payments-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 550px) {
        .payments-page {
            padding: 25px 15px 40px;
        }

        .payments-header h1 {
            font-size: 27px;
        }

        .payment-card,
        .info-card {
            padding: 20px;
        }
    }
</style>

<div class="payments-page">

    <div class="payments-header">
        <span>ADV-EDITS PAYMENT CENTER</span>
        <h1>Payments</h1>
        <p>
            Review your payment details and proceed to the checkout
            page to complete your transaction demonstration.
        </p>
    </div>

    @if (session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-error">
            Please check the information you entered.
            <ul style="margin: 8px 0 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="payments-grid">

        <div class="payment-card">

            <h2>Payment Details</h2>

            <div class="demo-notice">
                <strong>DEMO PAYMENT – SIMULATED GCASH</strong>
                This payment feature is for school-project demonstration
                purposes only. It does not process actual GCash payments
                or transfer real money.
            </div>

            <form action="{{ route('payments.checkout') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="customer_name">Customer Name</label>
                    <input
                        type="text"
                        id="customer_name"
                        name="customer_name"
                        value="{{ old('customer_name') }}"
                        placeholder="Enter your full name"
                        maxlength="255"
                        required
                    >
                    @error('customer_name')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="customer_email">Email Address</label>
                    <input
                        type="email"
                        id="customer_email"
                        name="customer_email"
                        value="{{ old('customer_email') }}"
                        placeholder="Enter your email address"
                        maxlength="255"
                        required
                    >
                    @error('customer_email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="total_amount">Payment Amount (₱)</label>
                    <input
                        type="number"
                        id="total_amount"
                        name="total_amount"
                        value="{{ old('total_amount') }}"
                        placeholder="Enter payment amount"
                        min="1"
                        max="1000000"
                        step="0.01"
                        required
                    >
                    @error('total_amount')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <label style="display:block; font-size:13px; font-weight:600; margin-bottom:9px;">
                    Payment Method
                </label>

                <div class="payment-method">
                    <div class="method-icon">G</div>
                    <div>
                        <strong>GCash</strong>
                        <small>Simulated payment option</small>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    Proceed to Checkout
                </button>

            </form>

        </div>

        <div class="info-card">

            <h2>Payment Information</h2>

            <p>
                ADV-EDITS provides a simple payment demonstration
                interface for customers to review their payment details.
            </p>

            <div class="info-item">
                <strong>10% Developer Commission</strong>
                <span>A portion of the entered amount recorded as the developer's share.</span>
            </div>

            <div class="info-item">
                <strong>90% ADV-EDITS Share</strong>
                <span>The remaining portion recorded as the service provider's share.</span>
            </div>

            <div class="info-item">
                <strong>Transaction Reference</strong>
                <span>A unique reference number is generated for each demo payment.</span>
            </div>

            <div class="info-item">
                <strong>Payment Status</strong>
                <span>The system records the transaction as pending until the demo confirmation step.</span>
            </div>

        </div>

    </div>

</div>

@endsection
