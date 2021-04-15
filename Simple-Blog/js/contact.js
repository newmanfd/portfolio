// the whole contact form fades into view smoothly
$(document).ready(function () {
    $('form').fadeIn(1400);
    $('.footer-line').fadeIn(1400);
    $('#footer').fadeIn(1400);
});


/* Contact form interaction: counter that shows how many characters are 
left to type in the <textarea> element */

function charCount(e) { 
    var userTextEntered, charDisplay, counter; 
    userTextEntered = document.getElementById('message').value; // User's text, <textarea>
    charDisplay = document.getElementById('charactersLeft'); // Counter element
    counter = (300 - (userTextEntered.length) + ' characters left available'); // Num of chars left
    charDisplay.textContent = counter; // Show chars left
}
var el = document.getElementById('message'); // Get message area, <textarea>
el.addEventListener('keyup', charCount, false); // keyup event


// To always show the current year
var today = new Date(); // New instance of Date object, Holds the current date and time 
var year = today.getFullYear();

var el = document.getElementById('copy');
el.innerHTML = '<p>&copy; Copyright ' + year + '</p>';

