
<x-filament-panels::page>

    @assets
        <link
            href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.css"
            rel="stylesheet"
        />
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js"></script>
    @endassets

    <style>
        /* FULL WIDTH PAGE */
        .fi-page,
        .fi-page-content,
        .adv-booking-page {
            width: 100% !important;
            max-width: none !important;
            min-width: 0 !important;
        }

        .adv-booking-page {
            display: block;
            color: #30231B;
        }

        .adv-booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 18px;
            width: 100%;
            margin-bottom: 24px;
        }

        .adv-booking-heading h2 {
            font-size: 25px;
            font-weight: 750;
            letter-spacing: -0.5px;
            color: #30231B;
            margin: 0 0 5px;
        }

        .adv-booking-heading p {
            color: #88796B;
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }

        .adv-booking-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 43px;
            padding: 10px 18px;
            border: 1px solid #493528;
            border-radius: 8px;
            background: #493528;
            color: white;
            font-size: 13px;
            font-weight: 650;
            cursor: pointer;
            transition: all .2s ease;
        }

        .adv-booking-toggle:hover {
            background: #30231B;
            border-color: #30231B;
            transform: translateY(-1px);
        }

        /* BOOKING CARD */
        .adv-booking-card {
            display: block;
            width: 100%;
            max-width: none;
            min-width: 0;
            box-sizing: border-box;
            padding: 24px;
            background: white;
            border: 1px solid #E8DED3;
            border-radius: 13px;
            box-shadow: 0 3px 12px rgba(48, 35, 27, .035);
        }

        .adv-booking-card-header {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 22px;
        }

        .adv-booking-card-header h3 {
            color: #30231B;
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 4px;
        }

        .adv-booking-card-header p {
            color: #948477;
            font-size: 12px;
            margin: 0;
        }

        /* CALENDAR WIDTH */
        .adv-calendar-wrapper {
            display: block;
            width: 100%;
            max-width: none;
            min-width: 0;
            overflow-x: auto;
        }

        #booking-calendar {
            display: block;
            width: 100%;
            max-width: none;
            min-width: 0;
            font-size: 13px;
        }

        #booking-calendar .fc {
            width: 100% !important;
            max-width: none !important;
            min-width: 0;
        }

        #booking-calendar .fc-view-harness {
            width: 100%;
        }

        #booking-calendar .fc-toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 22px;
        }

        #booking-calendar .fc-toolbar-chunk {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        #booking-calendar .fc-toolbar-title {
            color: #30231B;
            font-size: 19px;
            font-weight: 750;
        }

        #booking-calendar .fc-button {
            background: #493528;
            border: 1px solid #493528;
            border-radius: 7px;
            box-shadow: none;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: none;
            transition: background .2s ease;
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
            color: #78685A;
        }

        #booking-calendar .fc-col-header-cell {
            background: #F8F4EE;
        }

        #booking-calendar .fc-col-header-cell-cushion {
            color: #78685A;
            text-decoration: none;
            font-weight: 650;
            padding: 11px 4px;
        }

        #booking-calendar .fc-daygrid-day-number {
            color: #493528;
            text-decoration: none;
            padding: 8px;
        }

        #booking-calendar .fc-day-today {
            background: #F8F1E8 !important;
        }

        #booking-calendar .fc-daygrid-day-frame {
            min-height: 95px;
        }

        #booking-calendar .fc-daygrid-day {
            transition: background .15s ease;
        }

        #booking-calendar .fc-daygrid-day:hover {
            background: #FBF7F1;
        }

        #booking-calendar .fc-event {
            border: none;
            border-radius: 5px;
            padding: 3px 5px;
            margin: 2px 4px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            white-space: normal;
            overflow-wrap: anywhere;
        }

        #booking-calendar .fc-daygrid-more-link {
            color: #493528;
            font-weight: 650;
            font-size: 11px;
        }

        #booking-calendar .fc-scrollgrid {
            border-color: #E8DED3;
            border-radius: 7px;
            overflow: hidden;
        }

        #booking-calendar td,
        #booking-calendar th {
            border-color: #E8DED3;
        }

        /* TABLE WIDTH */
        .adv-booking-card .fi-ta,
        .adv-booking-card .fi-ta-ctn {
            width: 100%;
            max-width: none;
        }

        /* TABLET */
        @media (max-width: 768px) {
            .adv-booking-header {
                align-items: flex-start;
            }

            .adv-booking-heading h2 {
                font-size: 22px;
            }

            .adv-booking-toggle {
                width: 100%;
            }

            .adv-booking-card {
                padding: 16px 12px;
            }

            .adv-booking-card-header {
                align-items: flex-start;
            }

            #booking-calendar .fc-toolbar {
                justify-content: center;
                gap: 10px;
            }

            #booking-calendar .fc-toolbar-chunk {
                justify-content: center;
            }

            #booking-calendar .fc-toolbar-title {
                font-size: 16px;
            }

            #booking-calendar .fc-daygrid-day-frame {
                min-height: 65px;
            }

            #booking-calendar .fc-button {
                padding: 7px 9px;
                font-size: 11px;
            }

            #booking-calendar .fc-event {
                font-size: 10px;
                padding: 2px;
                margin: 2px;
            }

            #booking-calendar .fc-daygrid-day-number {
                padding: 5px;
                font-size: 11px;
            }
        }

        /* MOBILE */
        @media (max-width: 420px) {
            .adv-booking-card {
                padding: 12px 8px;
            }

            #booking-calendar {
                font-size: 11px;
            }

            #booking-calendar .fc-toolbar-title {
                font-size: 14px;
            }

            #booking-calendar .fc-daygrid-day-frame {
                min-height: 48px;
            }

            #booking-calendar .fc-col-header-cell-cushion {
                font-size: 10px;
                padding: 7px 1px;
            }
        }
    </style>

    <div class="adv-booking-page">

        <div class="adv-booking-header">
            <div class="adv-booking-heading">
                <h2>Booking Management</h2>
                <p>Manage customer requests and monitor your appointment schedule.</p>
            </div>

            <button
                type="button"
                wire:click="toggleCalendar"
                class="adv-booking-toggle"
            >
                @if ($showCalendar)
                    <span>←</span>
                    <span>Back to Booking List</span>
                @else
                    <span>▦</span>
                    <span>View Calendar</span>
                @endif
            </button>
        </div>

        @if ($showCalendar)

            <div class="adv-booking-card">

                <div class="adv-booking-card-header">
                    <div>
                        <h3>Appointment Schedule</h3>
                        <p>View accepted customer bookings by date.</p>
                    </div>
                </div>

                <div class="adv-calendar-wrapper">

                    <div
                        wire:ignore
                        x-data="{
                            calendar: null,
                            resizeObserver: null,
                            resizeHandler: null,
                            resizeFrame: null,

                            updateCalendarSize() {
                                cancelAnimationFrame(this.resizeFrame);

                                this.resizeFrame = requestAnimationFrame(() => {
                                    this.calendar?.updateSize();
                                });
                            },

                            init() {
                                const bookings = JSON.parse(
                                    this.$el.dataset.bookings || '[]'
                                );

                                this.$nextTick(() => {
                                    if (typeof FullCalendar === 'undefined') {
                                        console.error('FullCalendar library was not loaded.');
                                        return;
                                    }

                                    this.calendar = new FullCalendar.Calendar(this.$el, {
                                        initialView: 'dayGridMonth',
                                        height: 'auto',
                                        contentHeight: 'auto',
                                        expandRows: true,
                                        fixedWeekCount: false,
                                        handleWindowResize: true,
                                        windowResizeDelay: 150,

                                        headerToolbar: {
                                            left: 'prev,next',
                                            center: 'title',
                                            right: 'today'
                                        },

                                        events: bookings,

                                        eventClick: (info) => {
                                            window.location.href =
                                                '/admin/bookings/' + info.event.id;
                                        }
                                    });

                                    this.calendar.render();

                                    this.resizeObserver = new ResizeObserver(() => {
                                        this.updateCalendarSize();
                                    });

                                    this.resizeObserver.observe(
                                        this.$el.parentElement
                                    );

                                    this.resizeObserver.observe(
                                        this.$el.closest('.adv-booking-card')
                                    );

                                    this.resizeHandler = () => {
                                        this.updateCalendarSize();
                                    };

                                    window.addEventListener(
                                        'resize',
                                        this.resizeHandler
                                    );

                                    document.addEventListener(
                                        'livewire:navigated',
                                        this.resizeHandler
                                    );

                                    this.updateCalendarSize();
                                });
                            },

                            destroy() {
                                this.resizeObserver?.disconnect();

                                if (this.resizeHandler) {
                                    window.removeEventListener(
                                        'resize',
                                        this.resizeHandler
                                    );

                                    document.removeEventListener(
                                        'livewire:navigated',
                                        this.resizeHandler
                                    );
                                }

                                cancelAnimationFrame(this.resizeFrame);
                                this.calendar?.destroy();
                            }
                        }"
                        x-init="init()"
                        data-bookings="{{ json_encode($this->getCalendarBookings()) }}"
                        id="booking-calendar"
                    ></div>

                </div>

            </div>

        @else

            <div class="adv-booking-card">
                {{ $this->table }}
            </div>

        @endif

    </div>

</x-filament-panels::page>
