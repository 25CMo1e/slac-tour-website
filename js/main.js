/**
 * Main JavaScript for SLAC Website
 * Handles general website functionality
 */
/* 
 * @dev: Wang Kaixin
 * @id: 1306318
 * @hex: 0x13E8FE (1306318 in hexadecimal)
 */

$(document).ready(function () {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Smooth scrolling for anchor links
    $("a.nav-link, a.btn, footer a").on('click', function (event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "" && this.hash !== "#" && $(this.hash).length) {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 70 // Offset for fixed navbar
            }, 800, function () {
                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        }
    });

    // Navbar scroll behavior
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('.navbar').addClass('navbar-scrolled');
        } else {
            $('.navbar').removeClass('navbar-scrolled');
        }
    });

    // Mobile detection for touch vs hover interactions
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    if (isMobile) {
        // Add mobile-specific classes
        $('body').addClass('mobile-device');

        // Disable hover effects that might cause issues on touch devices
        $('.floor-selector .list-group-item').off('mouseenter mouseleave');
    }

    // Form validation for contact form (will be implemented on contact.html)
    if ($('#contactForm').length) {
        $('#contactForm').on('submit', function (event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            $(this).addClass('was-validated');
        });
    }

    // Login/Register form toggle (will be implemented on auth pages)
    $('.toggle-form').on('click', function (e) {
        e.preventDefault();
        $('.form-container').toggleClass('show-register');
    });

    // Preload floor plan images for smoother transitions
    function preloadImages() {
        const floorPlans = [
            'img/floor-plans/floor-1.svg',
            'img/floor-plans/floor-2.svg',
            'img/floor-plans/floor-3.svg',
            'img/floor-plans/floor-4.svg'
        ];

        floorPlans.forEach(function (src) {
            const img = new Image();
            img.src = src;
        });
    }

    // Call preload function
    preloadImages();

    // Accessibility improvements
    // Add keyboard navigation for floor selection
    $('.floor-selector .list-group-item').on('keydown', function (e) {
        // Enter or space key
        if (e.which === 13 || e.which === 32) {
            e.preventDefault();
            $(this).click();
        }
    });

    // Set focus to modal content when opened for better screen reader experience
    $('#locationModal').on('shown.bs.modal', function () {
        $('#location-name').focus();
    });

    // Add aria-labels to improve accessibility
    $('area').each(function () {
        const locationName = $(this).attr('alt');
        $(this).attr('aria-label', 'View details for ' + locationName);
    });
});


$(document).ready(function () {
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();

        // Clear previous messages
        $('#formResponse').removeClass('alert-danger alert-success').html('');

        // Submit form via AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Show success message
                    $('#formResponse').addClass('alert alert-success').html(response.message);
                    // Reset form if successful
                    $('#contactForm')[0].reset();
                } else {
                    // Show error message
                    $('#formResponse').addClass('alert alert-danger').html(response.message);
                }
            },
            error: function () {
                $('#formResponse').addClass('alert alert-danger').html('An error occurred while submitting the form. Please try again.');
            }
        });
    });
});