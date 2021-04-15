$(document).ready(function() { // after the page finishes loading
    $('#blog').fadeIn(1400);
    $('footer').fadeIn(1400);
    $('.footer-line').fadeIn(1400);
});


// When you scroll down 80px from the top of the page, the Back to Top button appears
$(function() {
    var $window = $(window);

    $window.on('scroll', function() {
        if ($window.scrollTop() >= 80) { 
            $('#top-btn').show(); 
        } else {
            $('#top-btn').hide(); 
        }
    });
});


// For the Back to Top button
$('#top-btn').on('click', function() { // when the button is clicked
    $('html, body').animate({ scrollTop: 0 }, 'slow'); // the page scrolls to the top with animation
});

