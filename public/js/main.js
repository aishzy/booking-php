// Modern Minimalist Meeting Room Booking System - JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initializeFormValidation();
    initializeInteractiveElements();
    initializePriceCalculation();
});

/**
 * Form Validation
 */
function initializeFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
    });
}

function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('error');
            isValid = false;
        } else {
            input.classList.remove('error');
        }
    });
    
    return isValid;
}

/**
 * Price Calculation
 */
function initializePriceCalculation() {
    const checkInInput = document.getElementById('check-in');
    const checkOutInput = document.getElementById('check-out');
    
    if (checkInInput && checkOutInput) {
        checkInInput.addEventListener('change', updatePrice);
        checkOutInput.addEventListener('change', updatePrice);
    }
}

function updatePrice() {
    const checkInInput = document.getElementById('check-in');
    const checkOutInput = document.getElementById('check-out');
    
    if (!checkInInput || !checkOutInput || !checkInInput.value || !checkOutInput.value) return;
    
    const checkIn = new Date(checkInInput.value);
    const checkOut = new Date(checkOutInput.value);
    
    if (checkOut <= checkIn) {
        alert('Check-out date must be after check-in date');
        checkOutInput.value = '';
        return;
    }
    
    const nights = Math.floor((checkOut - checkIn) / (1000 * 60 * 60 * 24));
    const nightlyRate = 149;
    const total = nights * nightlyRate;
    
    // Update the display (if these elements exist)
    const nightsDisplay = document.querySelector('[data-nights]');
    const subtotalDisplay = document.querySelector('[data-subtotal]');
    const totalDisplay = document.querySelector('[data-total]');
    
    if (nightsDisplay) nightsDisplay.innerText = nights;
    if (subtotalDisplay) subtotalDisplay.innerText = '$' + total.toFixed(2);
    if (totalDisplay) totalDisplay.innerText = '$' + total.toFixed(2);
}

/**
 * Interactive Elements
 */
function initializeInteractiveElements() {
    // Mobile Navigation Toggle
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('nav');
    
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);
            if (target) {
                target.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Tab switching functionality
    const tabs = document.querySelectorAll('.btn-secondary');
    tabs.forEach((tab, index) => {
        tab.addEventListener('click', function() {
            // Remove active state from all tabs
            tabs.forEach(t => t.classList.remove('active-tab'));
            // Add active state to clicked tab
            this.classList.add('active-tab');
        });
    });

    // Input field error handling
    document.querySelectorAll('input, textarea, select').forEach(input => {
        input.addEventListener('change', function() {
            if (this.value.trim()) {
                this.classList.remove('error');
            }
        });
    });
}

/**
 * Room Availability Checker
 */
function checkRoomAvailability(roomId, startDate, endDate) {
    return fetch(`${BASE_URL}/api/availability?room_id=${roomId}&start_date=${startDate}&end_date=${endDate}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                return {
                    available: data.available,
                    bookedDates: data.bookedDates || []
                };
            }
            throw new Error('Failed to check availability');
        })
        .catch(error => {
            console.error('Availability check error:', error);
            return { available: true, bookedDates: [] };
        });
}

/**
 * Utility: Format Date
 */
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

/**
 * Utility: Calculate nights between dates
 */
function calculateNights(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const nights = Math.floor((end - start) / (1000 * 60 * 60 * 24));
    return nights > 0 ? nights : 0;
}

// Export functions for use in other scripts
window.bookingSystem = {
    checkRoomAvailability,
    formatDate,
    calculateNights,
    updatePrice
};

            }
        });
    });
    
    // Close modals on escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal.active').forEach(modal => {
                modal.classList.remove('active');
            });
        }
    });
}

/**
 * Utility Functions
 */
function formatPrice(price) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(price);
}

function formatDate(date) {
    return new Intl.DateTimeFormat('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }).format(new Date(date));
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 16px 24px;
        background-color: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#0066cc'};
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1000;
        animation: slideIn 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

/**
 * API Helper
 */
async function apiCall(endpoint, options = {}) {
    const defaultOptions = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    };
    
    const config = { ...defaultOptions, ...options };
    
    try {
        const response = await fetch(endpoint, config);
        
        if (!response.ok) {
            throw new Error(`API Error: ${response.status}`);
        }
        
        return await response.json();
    } catch (error) {
        console.error('API Call Error:', error);
        showNotification('An error occurred. Please try again.', 'error');
        throw error;
    }
}

/**
 * CSS Animations
 */
const styles = document.createElement('style');
styles.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    input.error {
        border-color: #dc3545 !important;
    }
`;
document.head.appendChild(styles);

// Export functions for global use
window.bookingApp = {
    formatPrice,
    formatDate,
    showNotification,
    apiCall,
    calculateBookingPrice
};
