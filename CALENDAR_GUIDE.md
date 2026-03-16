# Meeting Room Booking Calendar System - Implementation Guide

## Overview

The meeting room booking system has been enhanced with an interactive calendar feature that allows users to:
- **Browse available dates** with visual calendar display
- **Check room availability** for specific dates and months
- **View booked dates** at a glance
- **Calculate pricing** dynamically based on selected dates
- **Manage bookings** with an improved user interface

## Features Added

### 1. **Interactive Calendar Widget** (`calendar.js`)
A lightweight, vanilla JavaScript calendar system that provides:

#### Visual Calendar Display
- Month-by-month navigation
- Color-coded date indicators:
  - **Available dates** (light border, clickable)
  - **Booked dates** (red background, disabled)
  - **Past dates** (grayed out, disabled)
  - **Selected dates** (blue background, highlighted)

#### Availability Checking
- Real-time availability checking via API
- Displays booked rooms from the database
- Shows only available dates for selection

#### Price Calculation
- Automatic price calculation based on selected dates
- Displays:
  - Number of nights/days
  - Subtotal
  - Total price
  - Daily/nightly rates

#### Features:
```javascript
new BookingCalendar({
    containerId: 'booking-calendar',  // Target element ID
    roomId: 201,                      // Room ID to check availability
    nightlyRate: 149,                 // Price per night
    onDateSelect: function(dates) {   // Callback when dates selected
        console.log('Selected:', dates);
    }
});
```

### 2. **Improved UI Design**

#### Room Detail Page (`views/rooms/detail.php`)
- Gradient pricing header with premium look
- Two-column layout for better UX
- Integrated calendar widget
- Enhanced room amenities display
- Detailed room specifications
- Guest reviews section
- Responsive design for all devices

#### Booking Management Page (`views/bookings/index.php`)
- Calendar-based booking overview
- Two-column layout with calendar and bookings list
- Booking summary panel with real-time calculations
- Status indicators for room availability
- Quick booking reference

#### CSS Enhancements (`public/css/style.css`)
- New calendar styling with:
  - Responsive grid layout
  - Smooth transitions and hover effects
  - Color-coded visual indicators
  - Legend showing date meanings
  - Mobile-optimized calendar view
- Improved form styling
- Better typography and spacing
- Professional color scheme

### 3. **API Endpoint** (`api/availability.php`)

#### Endpoint Details
```
GET /api/availability?room_id={roomId}&month={month}&year={year}
```

#### Parameters
- `room_id` (int, required): Room ID to check availability
- `month` (int, 1-12): Month to check (default: current month)
- `year` (int): Year to check (default: current year)

#### Response
```json
{
    "success": true,
    "roomId": 201,
    "month": 3,
    "year": 2026,
    "bookedDates": [
        "2026-03-15",
        "2026-03-16",
        "2026-03-17"
    ],
    "availableDates": 18
}
```

#### Error Handling
- Returns HTTP 400 for invalid parameters
- Returns HTTP 500 for database errors
- Includes error messages in response

### 4. **Enhanced JavaScript** (`public/js/main.js`)

#### New Functions
```javascript
// Check room availability for a date range
checkRoomAvailability(roomId, startDate, endDate)

// Format date to YYYY-MM-DD
formatDate(date)

// Calculate nights between two dates
calculateNights(startDate, endDate)
```

#### Improvements
- Better error handling
- Form validation enhancements
- Price calculation refinements
- Tab switching for booking views
- Input field error state management

## Database Queries

The system queries the `bookings` table to find:
- Confirmed bookings
- Pending bookings
- Check-in and check-out dates for the selected month

```sql
SELECT DISTINCT DATE(check_in) as booking_date
FROM bookings
WHERE room_id = :room_id
AND status IN ('confirmed', 'pending')
AND DATE(check_in) >= :start_date
AND DATE(check_in) <= :end_date
```

## Usage Examples

### Basic Calendar Integration
```html
<div id="booking-calendar" data-room-id="201" data-rate="149"></div>
<script src="/public/js/calendar.js"></script>
```

### Accessing Selected Dates
```javascript
const selectedDates = window.calendar.getSelectedDates();
// Returns: ['2026-03-15', '2026-03-16', '2026-03-17']
```

### Clearing Selection
```javascript
window.calendar.clearSelection();
```

### Loading Booked Dates
```javascript
window.calendar.loadBookedDates(roomId);
```

## Styling Classes

### Calendar Classes
```css
.calendar-wrapper          /* Main calendar container */
.calendar-day             /* Individual date cell */
.calendar-day.available   /* Available date */
.calendar-day.booked      /* Booked date */
.calendar-day.selected    /* Selected date */
.calendar-day.past-date   /* Past date */

.booking-info-panel       /* Booking summary box */
.availability-status      /* Availability indicator */
```

### Component Classes
```css
.badge                    /* Status badge */
.badge-success           /* Success badge (green) */
.badge-danger            /* Danger badge (red) */

.legend-item             /* Calendar legend items */
.legend-color            /* Color indicator in legend */
```

## Browser Compatibility

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+
- Mobile browsers (iOS Safari 12+, Chrome Mobile)

## Performance Considerations

### Calendar Performance
- Lightweight vanilla JavaScript (no dependencies)
- Efficient DOM manipulation
- Debounced API calls
- LocalStorage support for caching (future enhancement)

### API Optimization
- Indexed queries on `room_id`, `status`, and date fields
- Limits queries to single month
- Returns only necessary data

## Future Enhancements

1. **Client-side Caching**
   - Cache booked dates in browser
   - Reduce API calls for navigation

2. **Multi-month View**
   - Show 2-3 months simultaneously
   - Better for longer bookings

3. **User Preferences**
   - Save default room selection
   - Quick booking templates

4. **Advanced Filtering**
   - Filter by amenities
   - Filter by price range
   - Filter by availability

5. **Notifications**
   - Email reminders for bookings
   - Availability alerts
   - Price change notifications

## Troubleshooting

### Calendar Not Showing
- Verify `BASE_URL` constant is defined
- Check browser console for errors
- Ensure `booking-calendar` container exists

### Availability Not Loading
- Verify API endpoint is accessible
- Check room ID parameter
- Review API response in Network tab

### Price Not Calculating
- Ensure `data-rate` attribute is set
- Check date inputs have valid values
- Verify `[data-nights]`, `[data-subtotal]`, `[data-total]` elements exist

### Database Connection Issues
- Verify database configuration in `config/database.php`
- Check PDO is available
- Ensure bookings table exists

## Security Notes

- All API parameters are validated
- SQL queries use prepared statements (PDO)
- HTML output is escaped
- No sensitive data in client-side calendar
- API returns only booking dates, not user information

## Testing Checklist

- [ ] Calendar displays current month
- [ ] Navigation between months works
- [ ] Past dates are disabled
- [ ] Booked dates show correctly
- [ ] Date selection updates price
- [ ] API returns correct availability
- [ ] Mobile layout is responsive
- [ ] Form submission works
- [ ] Error messages display properly
- [ ] Multiple bookings show correct status

## Files Modified/Created

### New Files
- `public/js/calendar.js` - Calendar widget
- `api/availability.php` - Availability API endpoint

### Modified Files
- `public/css/style.css` - Added calendar and enhanced styles
- `views/rooms/detail.php` - Enhanced with calendar
- `views/bookings/index.php` - Redesigned with calendar
- `public/js/main.js` - Enhanced functionality
- `public/index.php` - Added BASE_URL constant

## Support

For issues or questions about the calendar system:
1. Check browser console for JavaScript errors
2. Review API responses in Network tab
3. Verify all files are in correct locations
4. Ensure database queries have required data
