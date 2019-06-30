$(document).ready(function () {
    $('.column').fadeIn(1400);
    $('.newsletter').show();
    $('.footer-line').show();
    $('#footer').show(); 
});


 /* The newsletter box slides into view from the left hand-side of the page when the 
user has scrolled and almost reached the end of the page. When scrolled up then
the box slides off and dissapears. */

$(function() {
    var $window = $(window); 
    var $slideNewsBox = $('.newsletter'); 
    // calculates the height at which the box should come into view 
    var $endZone = $('footer').offset().top - $window.height() - 200; 

    // the scroll event triggers an anonymous function every time the user scrolls up or down 
    $window.on('scroll', function() { 
        /* a conditional statement checks if the user's position is further from
        the top of the page than the start of the end zone */
        if ( $endZone < $window.scrollTop() ) { 
            $slideNewsBox.animate({ 'left': '0px' }, 250);
        } else {
            $slideNewsBox.stop(true).animate({ 'left': '-400px' }, 250);
        }
    });
});  

/* When scrolling down 80px or more, the back to top button appears. Otherwise,
the button is hidden */

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
    $('html, body').animate({ scrollTop: 0}, 'slow'); // the page scrolls to the top with animation
});


// To always show the current year
var today = new Date(); // New instance of Date object, Holds the current date and time 
var year = today.getFullYear();

var el = document.getElementById('copy');
el.innerHTML = '<p>&copy; Copyright ' + year + '</p>';
