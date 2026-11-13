
<x-filament-panels::page>

@php
    $month = \Carbon\Carbon::createFromFormat('Y-m', $this->selectedMonth)->startOfMonth();
    $start = $month->copy()->startOfMonth();
    $end = $month->copy()->endOfMonth();

    $totalBookings = \App\Models\Booking::whereBetween('created_at', [$start, $end])->count();

    $pendingBookings = \App\Models\Booking::where('booking_status', 'pending')
        ->whereBetween('created_at', [$start, $end])
        ->count();

    $approvedBookings = \App\Models\Booking::where('booking_status', 'accepted')
        ->whereBetween('created_at', [$start, $end])
        ->count();

    $totalPayments = \App\Models\Payment::where('status', 'paid')
        ->whereBetween('paid_at', [$start, $end])
        ->sum('total_amount');

    $recentBookings = \App\Models\Booking::whereBetween('created_at', [$start, $end])
        ->latest()
        ->take(6)
        ->get();
@endphp

<style>
    .adv-dashboard,
    .adv-dashboard * {
        box-sizing: border-box;
    }

    .adv-dashboard {
        color: #222222;
        width: 100%;
        max-width: none !important;
        margin: 0;
    }

    /* Allow dashboard to use the available page width */
    .fi-page,
    .fi-page-content {
        width: 100% !important;
        max-width: none !important;
    }

    .adv-dashboard-top {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        width: 100%;
        margin-bottom: 22px;
    }

    .adv-month {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        background: #ffffff;
        border: 1px solid #e7e7e7;
        border-radius: 9px;
    }

    .adv-month label {
        font-size: 12px;
        font-weight: 600;
        color: #777777;
    }

    .adv-month input {
        border: 0;
        outline: none;
        background: transparent;
        color: #222222;
        font-size: 13px;
        font-weight: 600;
        min-width: 130px;
    }

    .adv-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
        width: 100%;
        margin-bottom: 24px;
    }

    .adv-card {
        background: #ffffff;
        border: 1px solid #e7e7e7;
        border-radius: 12px;
        padding: 21px;
        min-width: 0;
        width: 100%;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .adv-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, .045);
    }

    .adv-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 22px;
    }

    .adv-card-label {
        color: #777777;
        font-size: 12px;
        font-weight: 600;
    }

    .adv-card-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        border-radius: 9px;
        display: grid;
        place-items: center;
        background: #f1f1f1;
        color: #222222;
        font-size: 16px;
    }

    .adv-card-value {
        font-size: clamp(23px, 2.3vw, 30px);
        font-weight: 750;
        letter-spacing: -1px;
        line-height: 1.2;
        overflow-wrap: anywhere;
        color: #222222;
    }

    .adv-card-note {
        color: #999999;
        font-size: 11px;
        margin-top: 9px;
    }

    .adv-panel {
        background: #ffffff;
        border: 1px solid #e7e7e7;
        border-radius: 12px;
        overflow: hidden;
        width: 100%;
        min-width: 0;
    }

    .adv-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 21px 23px;
        border-bottom: 1px solid #eeeeee;
    }

    .adv-panel-title {
        font-size: 15px;
        font-weight: 700;
        color: #222222;
    }

    .adv-panel-subtitle {
        font-size: 11px;
        color: #929292;
        margin-top: 4px;
    }

    .adv-table-wrap {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .adv-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 620px;
    }

    .adv-table th {
        text-align: left;
        padding: 13px 22px;
        background: #f7f7f7;
        color: #777777;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .8px;
        font-weight: 700;
        white-space: nowrap;
    }

    .adv-table td {
        padding: 16px 22px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 12px;
        color: #555555;
    }

    .adv-table tr:last-child td {
        border-bottom: 0;
    }

    .adv-customer {
        color: #222222;
        font-weight: 650;
        font-size: 12px;
    }

    .adv-muted {
        color: #999999;
        font-size: 11px;
        margin-top: 4px;
    }

    .adv-status {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        text-transform: capitalize;
        background: #eeeeee;
        color: #666666;
        white-space: nowrap;
    }

    .adv-status.pending {
        background: #fff4df;
        color: #a47732;
    }

    .adv-status.accepted {
        background: #e8f3ec;
        color: #477c59;
    }

    .adv-status.rescheduled {
        background: #eaf0fa;
        color: #54719b;
    }

    .adv-status.rejected {
        background: #f9eaea;
        color: #a85d5d;
    }

    .adv-empty {
        text-align: center;
        padding: 45px 20px;
        color: #999999;
        font-size: 12px;
    }

    /* Large desktop screens */
    @media (min-width: 1400px) {
        .adv-stats {
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 24px;
        }

        .adv-card {
            padding: 25px;
        }

        .adv-panel-header {
            padding: 24px 26px;
        }
    }

    /* Laptop and tablet */
    @media (max-width: 1100px) {
        .adv-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }
    }

    /* Mobile */
    @media (max-width: 640px) {
        .adv-dashboard-top {
            justify-content: flex-start;
            margin-bottom: 16px;
        }

        .adv-month {
            width: 100%;
            justify-content: space-between;
        }

        .adv-month input {
            min-width: 0;
            width: 145px;
        }

        .adv-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-bottom: 18px;
        }

        .adv-card {
            padding: 15px;
        }

        .adv-card-top {
            margin-bottom: 16px;
        }

        .adv-card-label {
            font-size: 11px;
        }

        .adv-card-value {
            font-size: 22px;
        }

        .adv-card-note {
            font-size: 10px;
        }

        .adv-panel-header {
            padding: 17px;
        }

        .adv-table {
            min-width: 620px;
        }
    }

    @media (max-width: 380px) {
        .adv-stats {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="adv-dashboard">

    <div class="adv-dashboard-top">
        <div class="adv-month">
            <label for="dashboard-month">Month</label>
            <input
                id="dashboard-month"
                type="month"
                wire:model.live="selectedMonth"
                max="{{ now()->format('Y-m') }}"
            >
        </div>
    </div>

    <div class="adv-stats">

        <div class="adv-card">
            <div class="adv-card-top">
                <div class="adv-card-label">Total Bookings</div>
                <div class="adv-card-icon">▤</div>
            </div>
            <div class="adv-card-value">{{ number_format($totalBookings) }}</div>
            <div class="adv-card-note">Bookings created this month</div>
        </div>

        <div class="adv-card">
            <div class="adv-card-top">
                <div class="adv-card-label">Pending Requests</div>
                <div class="adv-card-icon">◷</div>
            </div>
            <div class="adv-card-value">{{ number_format($pendingBookings) }}</div>
            <div class="adv-card-note">Awaiting admin review</div>
        </div>

        <div class="adv-card">
            <div class="adv-card-top">
                <div class="adv-card-label">Approved Bookings</div>
                <div class="adv-card-icon">✓</div>
            </div>
            <div class="adv-card-value">{{ number_format($approvedBookings) }}</div>
            <div class="adv-card-note">Accepted booking requests</div>
        </div>

        <div class="adv-card">
            <div class="adv-card-top">
                <div class="adv-card-label">Total Payments</div>
                <div class="adv-card-icon">₱</div>
            </div>
            <div class="adv-card-value">
                ₱{{ number_format((float) $totalPayments, 2) }}
            </div>
            <div class="adv-card-note">
                Paid transactions for {{ $month->format('F Y') }}
            </div>
        </div>

    </div>

    <div class="adv-panel">

        <div class="adv-panel-header">
            <div>
                <div class="adv-panel-title">Recent Bookings</div>
                <div class="adv-panel-subtitle">
                    Latest booking requests for {{ $month->format('F Y') }}
                </div>
            </div>
        </div>

        <div class="adv-table-wrap">
            <table class="adv-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Event</th>
                        <th>Event Date</th>
                        <th>Service</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($recentBookings as $booking)
                        <tr>
                            <td>
                                <div class="adv-customer">
                                    {{ $booking->customer_name }}
                                </div>
                                <div class="adv-muted">
                                    {{ $booking->customer_email }}
                                </div>
                            </td>

                            <td>{{ $booking->event_type }}</td>

                            <td>
                                {{ $booking->event_date
                                    ? \Carbon\Carbon::parse($booking->event_date)->format('M d, Y')
                                    : '—' }}
                            </td>

                            <td>{{ $booking->service }}</td>

                            <td>
                                <span class="adv-status {{ strtolower($booking->booking_status ?? 'pending') }}">
                                    {{ $booking->booking_status ?? 'Pending' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="adv-empty">
                                    No bookings found for {{ $month->format('F Y') }}.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

</x-filament-panels::page>
