
@extends('layouts.app')

@section('content')

<style>
    .booking-page {
        width: 100%;
        max-width: 1600px;
        margin: 0 auto;
        padding: 30px clamp(16px, 3vw, 38px) 40px;
        color: #30231B;
        box-sizing: border-box;
        min-width: 0;
    }

    .booking-page *,
    .booking-page *::before,
    .booking-page *::after {
        box-sizing: border-box;
    }

    .booking-header {
        margin-bottom: 26px;
    }

    .booking-header h1 {
        font-size: clamp(25px, 2.5vw, 30px);
        font-weight: 700;
        margin: 0 0 8px;
        color: #30231B;
    }

    .booking-header p {
        font-size: 15px;
        color: #78685A;
        margin: 0;
        line-height: 1.7;
    }

    .booking-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
        gap: 24px;
        align-items: start;
        width: 100%;
        min-width: 0;
    }

    .booking-card {
        background: #FFFFFF;
        border: 1px solid #E5DACE;
        border-radius: 14px;
        padding: clamp(16px, 2vw, 26px);
        box-shadow: 0 4px 14px rgba(48, 35, 27, 0.04);
        min-width: 0;
        width: 100%;
    }

    .booking-card h2 {
        font-size: 19px;
        font-weight: 700;
        margin: 0 0 7px;
        color: #30231B;
    }

    .booking-card .card-description {
        font-size: 13px;
        color: #88796B;
        margin: 0 0 22px;
        line-height: 1.6;
    }

    /* CALENDAR CONTAINER */
    .calendar-container {
        width: 100%;
        min-width: 0;
        overflow: hidden;
    }

    #booking-calendar {
        width: 100%;
        min-width: 0;
        font-size: 13px;
    }

    #booking-calendar .fc {
        width: 100%;
        max-width: 100%;
        min-width: 0;
    }

    #booking-calendar .fc-view-harness,
    #booking-calendar .fc-view-harness-active,
    #booking-calendar .fc-scrollgrid,
    #booking-calendar .fc-daygrid-body,
    #booking-calendar .fc-col-header {
        width: 100%;
        min-width: 0;
    }

    #booking-calendar .fc-toolbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 18px;
    }

    #booking-calendar .fc-toolbar-chunk {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
        min-width: 0;
    }

    #booking-calendar .fc-toolbar-title {
        font-size: clamp(15px, 1.5vw, 19px);
        font-weight: 700;
        color: #30231B;
        white-space: normal;
    }

    #booking-calendar .fc-button {
        background: #493528;
        border-color: #493528;
        box-shadow: none;
        text-transform: none;
        font-size: 12px;
        padding: 7px 10px;
        border-radius: 6px;
    }

    #booking-calendar .fc-button:hover,
    #booking-calendar .fc-button:focus {
        background: #30231B;
        border-color: #30231B;
        box-shadow: none;
    }

    #booking-calendar .fc-button:disabled {
        background: #D8CBBE;
        border-color: #D8CBBE;
        color: #6B5B4D;
    }

    #booking-calendar .fc-daygrid-day-frame {
        min-height: 65px;
    }

    #booking-calendar .fc-daygrid-day-number {
        color: #493528;
        text-decoration: none;
        padding: 7px;
    }

    #booking-calendar .fc-day-today {
        background: #F7F0E6 !important;
    }

    #booking-calendar .fc-col-header-cell-cushion {
        color: #78685A;
        text-decoration: none;
        font-weight: 600;
        padding: 9px 2px;
    }

    #booking-calendar .fc-event {
        background: #A65D50;
        border-color: #A65D50;
        border-radius: 4px;
        padding: 2px 3px;
        font-size: 11px;
        white-space: normal;
        overflow-wrap: anywhere;
    }

    #booking-calendar .fc-daygrid-day {
        cursor: pointer;
    }

    #booking-calendar .fc-daygrid-day:hover {
        background: #FBF7F1;
    }

    #booking-calendar .fc-daygrid-day-events {
        min-height: 1.5em;
    }

    .calendar-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 12px 18px;
        margin-top: 18px;
        font-size: 12px;
        color: #78685A;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .legend-dot {
        height: 9px;
        width: 9px;
        flex: 0 0 9px;
        border-radius: 50%;
        display: inline-block;
    }

    .legend-available {
        background: #C5A477;
    }

    .legend-booked {
        background: #A65D50;
    }

    .calendar-status {
        margin-top: 14px;
        padding: 12px 14px;
        background: #F8F4EE;
        border: 1px solid #EDE3D7;
        border-radius: 8px;
        color: #78685A;
        font-size: 12px;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    /* BOOKING FORM */
    .booking-form {
        display: flex;
        flex-direction: column;
        gap: 17px;
        min-width: 0;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
        min-width: 0;
    }

    .form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #493528;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        display: block;
        width: 100%;
        max-width: 100%;
        min-width: 0;
        padding: 12px 13px;
        border: 1px solid #DCCFC1;
        border-radius: 8px;
        background: #FFFEFC;
        color: #30231B;
        font-size: 14px;
        font-family: inherit;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #A98760;
        box-shadow: 0 0 0 3px rgba(197, 164, 119, 0.16);
    }

    .form-group input[readonly] {
        background: #F5EFE7;
        color: #78685A;
        cursor: not-allowed;
    }

    .form-group textarea {
        min-height: 90px;
        resize: vertical;
    }

    .form-row {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 14px;
        min-width: 0;
    }

    .selected-date {
        padding: 12px 14px;
        background: #F5EFE7;
        border: 1px solid #E5DACE;
        border-radius: 8px;
        color: #493528;
        font-size: 13px;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .booking-submit {
        width: 100%;
        border: none;
        border-radius: 8px;
        background: #493528;
        color: #FFFFFF;
        padding: 14px 18px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }

    .booking-submit:hover {
        background: #30231B;
    }

    .booking-note {
        font-size: 12px;
        line-height: 1.7;
        color: #88796B;
        margin: 0;
    }

    /* STACK THE PANELS WHEN THE AVAILABLE WIDTH IS LIMITED */
    @media (max-width: 1150px) {
        .booking-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 22px;
        }

        .booking-page {
            padding-left: 24px;
            padding-right: 24px;
        }

        #booking-calendar .fc-daygrid-day-frame {
            min-height: 75px;
        }
    }

    /* TABLETS AND SMALL WINDOWS */
    @media (max-width: 768px) {
        .booking-page {
            padding: 24px 18px 32px;
        }

        .booking-grid {
            gap: 18px;
        }

        .booking-card {
            padding: 18px;
        }

        #booking-calendar .fc-toolbar {
            justify-content: center;
        }

        #booking-calendar .fc-toolbar-chunk {
            justify-content: center;
        }

        #booking-calendar .fc-daygrid-day-frame {
            min-height: 55px;
        }
    }

    /* MOBILE */
    @media (max-width: 480px) {
        .booking-page {
            padding: 20px 12px 28px;
        }

        .booking-header {
            margin-bottom: 20px;
        }

        .booking-header h1 {
            font-size: 25px;
        }

        .booking-header p {
            font-size: 13px;
        }

        .booking-card {
            padding: 14px 10px;
            border-radius: 11px;
        }

        .booking-card h2 {
            font-size: 17px;
        }

        .booking-card .card-description {
            font-size: 12px;
            margin-bottom: 16px;
        }

        .form-row {
            grid-template-columns: minmax(0, 1fr);
            gap: 17px;
        }

        #booking-calendar {
            font-size: 11px;
        }

        #booking-calendar .fc-toolbar {
            gap: 10px;
        }

        #booking-calendar .fc-toolbar-title {
            font-size: 15px;
            text-align: center;
        }

        #booking-calendar .fc-button {
            font-size: 11px;
            padding: 6px 7px;
        }

        #booking-calendar .fc-daygrid-day-frame {
            min-height: 43px;
        }

        #booking-calendar .fc-daygrid-day-number {
            padding: 4px;
        }

        #booking-calendar .fc-col-header-cell-cushion {
            font-size: 10px;
            padding: 7px 0;
        }

        #booking-calendar .fc-event {
            font-size: 10px;
            padding: 1px;
        }

        .calendar-legend {
            gap: 10px;
            font-size: 11px;
        }
    }
</style>

<div class="booking-page">

    <div class="booking-header">
        <h1>Booking</h1>
        <p>Choose your preferred date and time, then provide the details of your event.</p>
    </div>

    <div class="booking-grid">

        {{-- CALENDAR --}}
        <section class="booking-card">

            <h2>Booking Schedule</h2>

            <p class="card-description">
                Select a date to check the schedule and fill in your booking details.
            </p>

            <div class="calendar-container">
                <div id="booking-calendar"></div>
            </div>

            <div class="calendar-legend">
                <span class="legend-item">
                    <span class="legend-dot legend-available"></span>
                    Selectable date
                </span>

                <span class="legend-item">
                    <span class="legend-dot legend-booked"></span>
                    Booked schedule
                </span>
            </div>

            <div class="calendar-status" id="calendar-status">
                Select a date on the calendar to set your preferred event date.
            </div>

        </section>

        {{-- BOOKING FORM --}}
        <section class="booking-card">

            <h2>Booking Details</h2>

            <p class="card-description">
                Enter your contact information and event schedule.
            </p>

            {{-- SUCCESS AND VALIDATION MESSAGES --}}
            @if (session('success'))
                <div style="padding: 12px; margin-bottom: 15px; background: #E8F3E9; color: #285C32; border-radius: 8px;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="padding: 12px; margin-bottom: 15px; background: #FBEAEA; color: #8B3030; border-radius: 8px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                class="booking-form"
                id="booking-form"
                action="{{ route('booking.store') }}"
                method="POST"
            >
                @csrf

                {{-- CUSTOMER INFORMATION FROM LOGGED-IN ACCOUNT --}}
                <div class="form-group">
                    <label for="customer_name">Full Name</label>
                    <input
                        type="text"
                        id="customer_name"
                        value="{{ auth()->user()->name }}"
                        readonly
                    >
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="customer_email">Email Address</label>
                        <input
                            type="email"
                            id="customer_email"
                            value="{{ auth()->user()->email }}"
                            readonly
                        >
                    </div>

                    <div class="form-group">
                        <label for="customer_phone">Contact Number</label>
                        <input
                            type="tel"
                            id="customer_phone"
                            name="customer_phone"
                            value="{{ old('customer_phone') }}"
                            placeholder="09XXXXXXXXX"
                            required
                        >
                    </div>

                </div>

                {{-- EVENT TYPE IS AUTOMATICALLY BASED ON THE SELECTED PACKAGE --}}
                <div class="form-group">

                    <label for="event_type_display">Event Type</label>

                    <input
                        type="text"
                        id="event_type_display"
                        value="{{ old('service_id') ? optional($services->firstWhere('id', (int) old('service_id')))->event_type : ($selectedService->event_type ?? '') }}"
                        placeholder="Automatically selected from your package"
                        readonly
                    >

                    <small style="color: #88796B;">
                        Your event type will be based on the package you choose.
                    </small>

                </div>

                <div class="form-group">

                    <label for="event_date">Event Date</label>

                    <input
                        type="date"
                        id="event_date"
                        name="event_date"
                        value="{{ old('event_date') }}"
                        min="{{ date('Y-m-d') }}"
                        required
                    >

                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label for="event_time">Preferred Time</label>

                        <input
                            type="time"
                            id="event_time"
                            name="event_time"
                            value="{{ old('event_time') }}"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label for="event_end_time">End Time</label>

                        <input
                            type="time"
                            id="event_end_time"
                            name="event_end_time"
                            value="{{ old('event_end_time') }}"
                            required
                        >

                    </div>

                </div>

                {{-- DYNAMIC SERVICE PACKAGES FROM ADMIN SERVICES --}}
                <div class="form-group">

                    <label for="service_id">Service Package</label>

                    <select id="service_id" name="service_id" required>

                        <option value="">Select a package</option>

                        @foreach ($services as $service)

                            <option
                                value="{{ $service->id }}"
                                data-event-type="{{ $service->event_type }}"
                                data-service-type="{{ $service->service_type }}"
                                data-price="{{ number_format((float) $service->price, 2, '.', '') }}"
                                {{ (string) old('service_id', $selectedService->id ?? '') === (string) $service->id ? 'selected' : '' }}
                            >
                                {{ $service->name }} — {{ $service->service_type }} — ₱{{ number_format((float) $service->price, 2) }}
                            </option>

                        @endforeach

                    </select>

                    @if ($services->isEmpty())

                        <small style="color: #A65D50;">
                            No active packages are currently available. Please check again later.
                        </small>

                    @else

                        <small style="color: #88796B;">
                            Choose an active package. The event type will update automatically.
                        </small>

                    @endif

                </div>

                <div class="form-group">

                    <label for="event_location">Event Location</label>

                    <input
                        type="text"
                        id="event_location"
                        name="event_location"
                        value="{{ old('event_location') }}"
                        placeholder="Enter the event venue"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="message">Additional Details (Optional)</label>

                    <textarea
                        id="message"
                        name="message"
                        placeholder="Add any details about your event"
                    >{{ old('message') }}</textarea>

                </div>

                <div class="selected-date" id="selected-date">
                    No event date selected yet.
                </div>

                <button type="submit" class="booking-submit">
                    Submit Booking Request
                </button>

                <p class="booking-note">
                    Your requested schedule must be checked against existing bookings before it can be confirmed.
                </p>

            </form>

        </section>

    </div>

</div>

{{-- FullCalendar --}}
<link
    href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.css"
    rel="stylesheet"
>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const calendarElement = document.getElementById('booking-calendar');
    const dateInput = document.getElementById('event_date');
    const timeInput = document.getElementById('event_time');
    const endTimeInput = document.getElementById('event_end_time');
    const selectedDateText = document.getElementById('selected-date');
    const calendarStatus = document.getElementById('calendar-status');
    const bookingForm = document.getElementById('booking-form');

    // Service package and event type elements
    const serviceSelect = document.getElementById('service_id');
    const eventTypeDisplay = document.getElementById('event_type_display');

    // Automatically update Event Type when a package is selected
    function updateEventTypeFromPackage() {

        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];

        eventTypeDisplay.value = selectedOption && selectedOption.dataset.eventType
            ? selectedOption.dataset.eventType
            : '';

    }

    serviceSelect.addEventListener('change', updateEventTypeFromPackage);
    updateEventTypeFromPackage();

    const today = new Date();
    today.setHours(0, 0, 0, 0);

    dateInput.min = formatDate(today);

    function formatDate(date) {

        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');

        return `${year}-${month}-${day}`;

    }

    function updateSelectedDate(value) {

        if (!value) {
            selectedDateText.textContent = 'No event date selected yet.';
            return;
        }

        const date = new Date(value + 'T00:00:00');

        selectedDateText.textContent =
            'Selected event date: ' +
            date.toLocaleDateString('en-PH', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

    }

    // Display previously selected date after validation redirect.
    if (dateInput.value) {
        updateSelectedDate(dateInput.value);
    }

    const calendar = new FullCalendar.Calendar(calendarElement, {

        initialView: 'dayGridMonth',
        height: 'auto',
        contentHeight: 'auto',
        expandRows: true,
        handleWindowResize: true,
        fixedWeekCount: false,
        navLinks: false,

        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'currentDate'
        },

        customButtons: {
            currentDate: {
                text: 'Current Date',
                click: function () {
                    calendar.today();
                }
            }
        },

        dateClick: function (info) {

            const clickedDate = new Date(info.date);
            clickedDate.setHours(0, 0, 0, 0);

            if (clickedDate < today) {

                calendarStatus.textContent =
                    'Past dates cannot be selected. Please choose today or a future date.';

                return;
            }

            dateInput.value = info.dateStr;
            updateSelectedDate(info.dateStr);

            calendarStatus.textContent =
                'Selected ' + info.dateStr +
                '. Please check the booked schedules before submitting your request.';

        },

        events: @json(route('booking.availability')),

        eventClick: function (info) {

            info.jsEvent.preventDefault();

            calendarStatus.textContent =
                'This schedule is already booked: ' + info.event.title +
                '. Please check its availability before choosing your time.';

        },

        eventDidMount: function (info) {
            info.el.title = info.event.title;
        },

        windowResize: function () {
            calendar.updateSize();
        }

    });

    calendar.render();

    // Recalculate the calendar width when its container changes size.
    if ('ResizeObserver' in window) {

        const resizeObserver = new ResizeObserver(function () {

            requestAnimationFrame(function () {
                calendar.updateSize();
            });

        });

        resizeObserver.observe(calendarElement.parentElement);
        resizeObserver.observe(document.querySelector('.booking-page'));

    }

    // Keep the calendar and date input synchronized.
    dateInput.addEventListener('change', function () {

        updateSelectedDate(this.value);

        if (this.value) {
            calendar.gotoDate(this.value);
        }

    });

    // Validate the form before allowing Laravel submission.
    bookingForm.addEventListener('submit', function (event) {

        if (!serviceSelect.value) {

            event.preventDefault();
            alert('Please select a service package.');
            serviceSelect.focus();

            return;
        }

        if (!dateInput.value) {

            event.preventDefault();
            alert('Please select an event date.');
            dateInput.focus();

            return;
        }

        if (!timeInput.value || !endTimeInput.value) {

            event.preventDefault();
            alert('Please select both the start time and end time.');

            return;
        }

        if (endTimeInput.value <= timeInput.value) {

            event.preventDefault();
            alert('The end time must be later than the start time.');
            endTimeInput.focus();

            return;
        }

        // Valid form: allow normal POST submission to Laravel.

    });

});
</script>

@endsection

