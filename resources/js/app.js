
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

function initializeBookingCalendar() {
    const element = document.getElementById('booking-calendar');

    if (!element || element.dataset.initialized === 'true') {
        return;
    }

    element.dataset.initialized = 'true';

    const bookings = JSON.parse(element.dataset.bookings || '[]');

    const calendar = new Calendar(element, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        height: 'auto',
        fixedWeekCount: false,

        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'today',
        },

        events: bookings,

        eventClick(info) {
            window.location.href = '/admin/bookings/' + info.event.id;
        },
    });

    calendar.render();
}

document.addEventListener('livewire:navigated', initializeBookingCalendar);
document.addEventListener('DOMContentLoaded', initializeBookingCalendar);

document.addEventListener('livewire:initialized', () => {
    Livewire.hook('morph.updated', ({ el }) => {
        if (el.querySelector?.('#booking-calendar') || el.id === 'booking-calendar') {
            initializeBookingCalendar();
        }
    });
});
