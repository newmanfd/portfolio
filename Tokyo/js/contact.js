$(document).ready(function () {
    $('h1').fadeIn(1400);
    $('h2').fadeIn(1400);
    $('form').fadeIn(1400);
    $('.footer-line').fadeIn(1400);
    $('footer').fadeIn(1400);
});


/* Contact form interaction: counter that shows how many characters are 
left to type in the <textarea> element */

var el; 

function charCount(e) { 
    var userTextEntered, charDisplay, counter; 
    userTextEntered = document.getElementById('message').value; // User's text, <textarea>
    charDisplay = document.getElementById('charactersLeft'); // Counter element
    counter = (500 - (userTextEntered.length) + ' characters left available'); // Num of chars left
    charDisplay.textContent = counter; // Show chars left
}
el = document.getElementById('message'); // Get message area, <textarea>
el.addEventListener('keyup', charCount, false); // keyup event