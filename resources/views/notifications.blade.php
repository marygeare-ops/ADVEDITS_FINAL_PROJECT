
@extends('layouts.app')

@section('content')

<style>
    .notifications-page {
        max-width: 1100px;
        margin: auto;
        padding: 85px 40px 50px;
    }

    .notification-heading {
        margin-bottom: 30px;
    }

    .notification-heading .eyebrow {
        color: #A48660;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
        margin-bottom: 10px;
    }

    .notification-heading h1 {
        font-family: Georgia, serif;
        color: #30251E;
        font-size: 34px;
        margin: 0 0 10px;
    }

    .notification-heading p {
        color: #8E7662;
        font-size: 14px;
        margin: 0;
    }

    .notification-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .notification-card {
        background: #fff;
        border: 1px solid #E5D9CB;
        border-radius: 11px;
        padding: 22px;
        box-shadow: 0 4px 14px rgba(48, 37, 30, .04);
    }

    .notification-summary {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
        cursor: pointer;
        list-style: none;
    }

    .notification-summary::-webkit-details-marker {
        display: none;
    }

    .notification-summary:focus-visible {
        outline: 2px solid #C5A477;
        outline-offset: 5px;
    }

    .notification-title {
        color: #30251E;
        font-family: Georgia, serif;
        font-size: 20px;
        margin: 0 0 7px;
    }

    .notification-message {
        color: #786555;
        font-size: 13px;
        line-height: 1.7;
        margin: 0;
    }

    .notification-status {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .status-pending {
        color: #986A22;
        background: #FFF2D9;
    }

    .status-accepted {
        color: #397247;
        background: #E5F2E6;
    }

    .status-rejected {
        color: #A4483D;
        background: #F8E5E2;
    }

    .view-label {
        display: inline-block;
        color: #98774F;
        font-size: 12px;
        font-weight: 700;
        margin-top: 13px;
    }

    .notification-card[open] .view-label {
        color: #493528;
    }

    .notification-details {
        border-top: 1px solid #E9DED1;
        margin-top: 20px;
        padding-top: 20px;
    }

    .details-heading {
        color: #493528;
        font-family: Georgia, serif;
        font-size: 17px;
        margin: 0 0 15px;
    }

    .booking-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        background: #F8F4EF;
        border: 1px solid #E9DED1;
        border-radius: 9px;
        padding: 18px;
    }

    .booking-detail small {
        display: block;
        color: #9A8877;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .booking-detail strong {
        display: block;
        color: #493528;
        font-size: 13px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .customer-message {
        color: #65503E;
        background: #F9F0E9;
        border-left: 3px solid #C5A477;
        padding: 13px 15px;
        margin-top: 15px;
        font-size: 13px;
        line-height: 1.6;
    }

    .downpayment-box {
        background: #30231B;
        color: #F5EBDD;
        border-radius: 9px;
        padding: 20px;
        margin-top: 18px;
    }

    .downpayment-box small {
        display: block;
        color: #CDB99F;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .downpayment-amount {
        display: block;
        color: #D7B88F;
        font-family: Georgia, serif;
        font-size: 29px;
        margin-bottom: 7px;
    }

    .downpayment-box p {
        color: #D5C7B7;
        font-size: 12px;
        line-height: 1.6;
        margin: 0;
    }

    .notification-actions {
        margin-top: 17px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn-pay {
        display: inline-block;
        border: 0;
        border-radius: 7px;
        background: #C5A477;
        color: #211812;
        padding: 12px 19px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-pay:hover {
        background: #D7B88F;
    }

    .payment-complete {
        color: #397247;
        background: #E5F2E6;
        padding: 12px 15px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
        margin-top: 16px;
    }

    .payment-waiting {
        color: #986A22;
        background: #FFF2D9;
        padding: 12px 15px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
        margin-top: 16px;
    }

    .notification-date {
        color: #A08D7B;
        font-size: 11px;
        margin-top: 17px;
    }

    .empty-notifications {
        text-align: center;
        background: #fff;
        border: 1px solid #E5D9CB;
        border-radius: 11px;
        padding: 60px 20px;
    }

    .empty-notifications h2 {
        font-family: Georgia, serif;
        color: #493528;
        font-size: 23px;
        margin: 0 0 10px;
    }

    .empty-notifications p {
        color: #8E7662;
        font-size: 13px;
    }

    .notice-message {
        padding: 13px 16px;
        border-radius: 8px;
        background: #F8F4EF;
        color: #65503E;
        font-size: 13px;
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .notifications-page {
            padding: 85px 20px 35px;
        }

        .notification-heading h1 {
            font-size: 28px;
        }

        .notification-card {
            padding: 18px;
        }
    }

    @media (max-width: 480px) {
        .booking-grid {
            grid-template-columns: 1fr;
        }

        .notification-summary {
            flex-direction: column;
        }
    }
</style>

<div class="notifications-page">

    <div class="notification-heading">
        <div class="eyebrow">ADV-EDITS / CUSTOMER UPDATES</div>
        <h1>Notifications</h1>
        <p>Stay updated with your booking requests and reservation status.</p>
    </div>

    @if (session('success'))
        <div class="notice-message">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="notice-message">{{ session('error') }}</div>
    @endif

    @if ($notifications->isNotEmpty())

        <div class="notification-list">

            @foreach ($notifications as $notification)

                @php
                    $data = $notification->data ?? [];
                    $status = $data['status'] ?? 'pending';
                    $bookingId = $data['booking_id'] ?? null;
                    $booking = $bookingId ? $bookings->get($bookingId) : null;
                    $payment = $bookingId ? $payments->get($bookingId) : null;

                    $statusClass = match ($status) {
                        'accepted', 'payment_verified' => 'status-accepted',
                        'rejected' => 'status-rejected',
                        default => 'status-pending',
                    };

                    $title = $data['title'] ?? 'Booking Update';
                    $message = $data['message'] ?? 'Your booking has been updated.';
                @endphp

                <details class="notification-card">

                    <summary class="notification-summary">

                        <div>
                            <h2 class="notification-title">
                                {{ $title }}
                            </h2>

                            <p class="notification-message">
                                {{ $message }}
                            </p>

                            <span class="view-label">
                                View Booking Details +
                            </span>
                        </div>

                        <span class="notification-status {{ $statusClass }}">
                            {{ str_replace('_', ' ', ucfirst($status)) }}
                        </span>

                    </summary>

                    <div class="notification-details">

                        @if ($booking)

                            <h3 class="details-heading">
                                Booking Information #{{ $booking->id }}
                            </h3>

                            <div class="booking-grid">

                                <div class="booking-detail">
                                    <small>Customer Name</small>
                                    <strong>{{ $booking->customer_name }}</strong>
                                </div>

                                <div class="booking-detail">
                                    <small>Service Package</small>
                                    <strong>
                                        {{ $booking->service_name_snapshot ?? $booking->service }}
                                    </strong>
                                </div>

                                <div class="booking-detail">
                                    <small>Event Type</small>
                                    <strong>{{ $booking->event_type }}</strong>
                                </div>

                                <div class="booking-detail">
                                    <small>Event Date</small>
                                    <strong>
                                        {{ $booking->event_date?->format('F d, Y') ?? 'Not specified' }}
                                    </strong>
                                </div>

                                <div class="booking-detail">
                                    <small>Event Time</small>
                                    <strong>
                                        {{ $booking->event_time }} - {{ $booking->event_end_time }}
                                    </strong>
                                </div>

                                <div class="booking-detail">
                                    <small>Event Location</small>
                                    <strong>{{ $booking->event_location }}</strong>
                                </div>

                                <div class="booking-detail">
                                    <small>Total Service Price</small>
                                    <strong>
                                        ₱{{ number_format((float) $booking->total_amount, 2) }}
                                    </strong>
                                </div>

                                <div class="booking-detail">
                                    <small>Payment Status</small>
                                    <strong>
                                        {{ ucfirst(str_replace('_', ' ', $booking->payment_status)) }}
                                    </strong>
                                </div>

                            </div>

                            @if ($booking->message)
                                <div class="customer-message">
                                    <strong>Your booking message:</strong><br>
                                    {{ $booking->message }}
                                </div>
                            @endif

                            @if (!empty($data['admin_message']))
                                <div class="customer-message">
                                    <strong>Message from Admin:</strong><br>
                                    {{ $data['admin_message'] }}
                                </div>
                            @endif

                            @if (in_array($status, ['accepted', 'payment_verified']))

                                @php
                                    $downpayment = round((float) $booking->total_amount * 0.50, 2);
                                @endphp

                                <div class="downpayment-box">

                                    <small>50% REQUIRED DOWNPAYMENT</small>

                                    <strong class="downpayment-amount">
                                        ₱{{ number_format($downpayment, 2) }}
                                    </strong>

                                    @if ($payment?->status === 'successful' || in_array($booking->payment_status, ['partially_paid', 'paid']))

                                        <p>
                                            Your GCash downpayment has been verified by ADV-EDITS.
                                        </p>

                                    @elseif ($payment?->status === 'submitted')

                                        <p>
                                            Your GCash receipt has been submitted. Please wait while the admin verifies your payment.
                                        </p>

                                    @else

                                        <p>
                                            Your booking has been accepted. Please pay the 50% downpayment to proceed with your reservation.
                                        </p>

                                    @endif

                                </div>

                                <div class="notification-actions">

                                    @if ($payment?->status === 'successful' || in_array($booking->payment_status, ['partially_paid', 'paid']))

                                        <div class="payment-complete">
                                            {{ $booking->payment_status === 'paid'
                                                ? 'Payment completed.'
                                                : 'Your downpayment has been verified.' }}
                                        </div>

                                    @elseif ($payment?->status === 'submitted')

                                        <div class="payment-waiting">
                                            Payment proof submitted. Awaiting admin verification.
                                        </div>

                                    @else

                                        <form action="{{ route('payments.checkout') }}" method="POST">
                                            @csrf

                                            <input
                                                type="hidden"
                                                name="booking_id"
                                                value="{{ $booking->id }}"
                                            >

                                            <button type="submit" class="btn-pay">
                                                Pay Downpayment
                                            </button>
                                        </form>

                                    @endif

                                </div>

                            @endif

                        @else

                            <p class="notification-message">
                                Booking information is no longer available.
                            </p>

                        @endif

                        <div class="notification-date">
                            Received:
                            {{ $notification->created_at->format('F d, Y - h:i A') }}
                        </div>

                    </div>

                </details>

            @endforeach

        </div>

    @else

        <div class="empty-notifications">
            <h2>No Notifications Yet</h2>
            <p>Your booking updates will appear here.</p>
        </div>

    @endif

</div>

@endsection
