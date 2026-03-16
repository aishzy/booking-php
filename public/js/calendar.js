
/**
 * Meeting Room Booking Calendar System
 * Features: Date selection, availability checking, visual calendar
 */

class BookingCalendar {
    constructor(options = {}) {
        this.currentDate = new Date(options.year || new Date().getFullYear(), options.month || new Date().getMonth());
        this.selectedDates = [];
        this.bookedDates = [];
        this.roomId = options.roomId || null;
        this.onDateSelect = options.onDateSelect || null;
        this.nightlyRate = options.nightlyRate || 149;
        
        if (options.containerId) {
            this.init(options.containerId);
        }
    }

    init(containerId) {
        this.container = document.getElementById(containerId);
        if (!this.container) return;
        
        this.render();
        this.attachEventListeners();
        if (this.roomId) {
            this.loadBookedDates();
        }
    }

    render() {
        const year = this.currentDate.getFullYear();
        const month = this.currentDate.getMonth();
        
        let html = `
            <div class="calendar-wrapper">
                <div class="calendar-header">
                    <button class="calendar-nav prev-month" data-direction="prev" title="Previous month">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>
                    <h2 class="calendar-title">${this.getMonthYear(month, year)}</h2>
                    <button class="calendar-nav next-month" data-direction="next" title="Next month">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>

                <div class="calendar-weekdays">
                    <div class="weekday">Sun</div>
                    <div class="weekday">Mon</div>
                    <div class="weekday">Tue</div>
                    <div class="weekday">Wed</div>
                    <div class="weekday">Thu</div>
                    <div class="weekday">Fri</div>
                    <div class="weekday">Sat</div>
                </div>

                <div class="calendar-grid">
                    ${this.generateDays(year, month)}
                </div>

                <div class="calendar-legend">
                    <div class="legend-item">
                        <span class="legend-color available"></span>
                        <span>Available</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color booked"></span>
                        <span>Booked</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color selected"></span>
                        <span>Selected</span>
                    </div>
                </div>
            </div>
        `;

        this.container.innerHTML = html;
    }

    generateDays(year, month) {
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        let html = '';

        // Empty cells for days before month starts
        for (let i = 0; i < firstDay; i++) {
            html += '<div class="calendar-day empty"></div>';
        }

        // Days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const currentDate = new Date(year, month, day);
            currentDate.setHours(0, 0, 0, 0);
            const dateString = this.formatDate(currentDate);
            
            let classes = 'calendar-day';
            let isBooked = this.bookedDates.includes(dateString);
            let isSelected = this.selectedDates.includes(dateString);
            let isPast = currentDate < today;
            
            if (isBooked) classes += ' booked';
            if (isSelected) classes += ' selected';
            if (isPast) classes += ' past-date';
            if (!isPast && !isBooked) classes += ' available';

            const title = isBooked ? 'Booked' : (isPast ? 'Past date' : 'Available');
            
            html += `<div class="${classes}" data-date="${dateString}" title="${title}">${day}</div>`;
        }

        return html;
    }

    attachEventListeners() {
        const prevBtn = this.container.querySelector('.prev-month');
        const nextBtn = this.container.querySelector('.next-month');
        const dayElements = this.container.querySelectorAll('.calendar-day:not(.empty):not(.past-date)');

        if (prevBtn) prevBtn.addEventListener('click', () => this.previousMonth());
        if (nextBtn) nextBtn.addEventListener('click', () => this.nextMonth());

        dayElements.forEach(dayEl => {
            dayEl.addEventListener('click', (e) => this.selectDate(e.target.dataset.date, e.target));
        });
    }

    selectDate(dateString, element) {
        if (element.classList.contains('booked') || element.classList.contains('past-date')) {
            return;
        }

        const index = this.selectedDates.indexOf(dateString);
        if (index > -1) {
            this.selectedDates.splice(index, 1);
            element.classList.remove('selected');
        } else {
            this.selectedDates.push(dateString);
            element.classList.add('selected');
        }

        if (this.onDateSelect) {
            this.onDateSelect(this.selectedDates);
        }

        this.updatePriceSummary();
    }

    previousMonth() {
        this.currentDate.setMonth(this.currentDate.getMonth() - 1);
        this.render();
        this.attachEventListeners();
    }

    nextMonth() {
        this.currentDate.setMonth(this.currentDate.getMonth() + 1);
        this.render();
        this.attachEventListeners();
    }

    loadBookedDates(roomId = null) {
        if (roomId) this.roomId = roomId;
        if (!this.roomId) return;

        const year = this.currentDate.getFullYear();
        const month = this.currentDate.getMonth() + 1; // API expects 1-based month

        fetch(`${BASE_URL}/api/availability?room_id=${this.roomId}&month=${month}&year=${year}`)
            .then(response => response.json())
            .then(data => {
                this.bookedDates = data.bookedDates || [];
                this.render();
                this.attachEventListeners();
            })
            .catch(error => console.error('Error loading booked dates:', error));
    }

    updatePriceSummary() {
        const sortedDates = this.selectedDates.sort();
        if (sortedDates.length < 2) {
            this.updateDisplay('nights', '-');
            this.updateDisplay('subtotal', '-');
            this.updateDisplay('total', '-');
            return;
        }

        const checkIn = new Date(sortedDates[0]);
        const checkOut = new Date(sortedDates[sortedDates.length - 1]);
        checkOut.setDate(checkOut.getDate() + 1);

        const nights = Math.floor((checkOut - checkIn) / (1000 * 60 * 60 * 24));
        const subtotal = nights * this.nightlyRate;

        this.updateDisplay('nights', nights);
        this.updateDisplay('subtotal', '$' + subtotal.toFixed(2));
        this.updateDisplay('total', '$' + subtotal.toFixed(2));

        // Update form fields
        const checkInInput = document.getElementById('check-in');
        const checkOutInput = document.getElementById('check-out');
        if (checkInInput) checkInInput.value = sortedDates[0];
        if (checkOutInput) checkOutInput.value = this.formatDate(checkOut);
    }

    updateDisplay(identifier, value) {
        const element = document.querySelector(`[data-${identifier}]`);
        if (element) element.innerText = value;
    }

    formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    getMonthYear(month, year) {
        const months = ['January', 'February', 'March', 'April', 'May', 'June',
                       'July', 'August', 'September', 'October', 'November', 'December'];
        return `${months[month]} ${year}`;
    }

    getSelectedDates() {
        return this.selectedDates.sort();
    }

    clearSelection() {
        this.selectedDates = [];
        this.render();
        this.attachEventListeners();
        this.updatePriceSummary();
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const calendarContainer = document.getElementById('booking-calendar');
    if (calendarContainer) {
        const roomId = calendarContainer.dataset.roomId;
        const nightlyRate = parseFloat(calendarContainer.dataset.rate) || 149;
        
        window.calendar = new BookingCalendar({
            containerId: 'booking-calendar',
            roomId: roomId ? parseInt(roomId) : null,
            nightlyRate: nightlyRate,
            onDateSelect: function(dates) {
                console.log('Selected dates:', dates);
            }
        });
    }
});
