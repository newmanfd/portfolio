var removeSVG = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve" width="50px" height="50px"><path class="fill" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M19,8V5c0-1.1,0.9-2,2-2h8  c1.1,0,2,0.9,2,2v3"/><line fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" x1="8" y1="8" x2="42" y2="8"/><line fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" x1="25" y1="15" x2="25" y2="40"/><line fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" x1="31" y1="15" x2="31" y2="40"/><line fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" x1="19" y1="15" x2="19" y2="40"/><path class="fill" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M40,8v37c0,1.1-0.9,2-2,2H12  c-1.1,0-2-0.9-2-2V8"/></svg>';

/* When Add to Cart is clicked */
var addToCartBtns = document.querySelectorAll('.add-to-cart');
var itemCount = 0; 
var currentPriceTotal = 0; 

for (var i=0; i < addToCartBtns.length; i++) { 
    addToCartBtns[i].addEventListener('click', function(e) {
        var btnClicked = e.target;
        var parentOfBtn = btnClicked.parentNode;
        var nameOfItem = parentOfBtn.children[1].textContent;
        var priceOfItem = parentOfBtn.children[3].textContent; 
         
        var itemsList = document.getElementById('items-list');
        var li = document.createElement('li');
        
        var deleteBtn = document.createElement('button');
        deleteBtn.setAttribute('id', 'remove-item');
        deleteBtn.innerHTML = removeSVG;

        // In case the delete icon is clicked 
        deleteBtn.addEventListener('click', function() { 
            itemsList.removeChild(li);
            // Decrease number of items in cart status button & their total
            // Decrease number of total inside the cart box
            itemCount--;
            var priceToPush = parseInt(priceOfItem.replace(/[^0-9]/gi, ''));   
            currentPriceTotal = currentPriceTotal - priceToPush;
        
            var totalPriceSum = (currentPriceTotal/100).toFixed(2); 
         
            cartStatusBtn.textContent = itemCount + ' item(s): ' + '$' + totalPriceSum;
            totalFinalAmount.textContent = 'Total: ' + '$' + totalPriceSum;
        }, false);

        li.textContent = '-' + ' ' + nameOfItem + ' ' + priceOfItem;
        li.appendChild(deleteBtn);
        itemsList.appendChild(li);
        alert('Item added to the cart.');
        
        
        // Increase number of items in cart status button & their total
        // Increase number of total inside the cart box
        // --------------------------------------------------------------------
        itemCount++;
        
        var priceToPush = parseInt(priceOfItem.replace(/[^0-9]/gi, ''));   
        currentPriceTotal = currentPriceTotal + priceToPush;
        
        var totalPriceSum = (currentPriceTotal/100).toFixed(2); 

        var cartStatusBtn = document.getElementById('cart-status-btn');
        cartStatusBtn.textContent = itemCount + ' item(s): ' + '$' + totalPriceSum;
        
        var totalFinalAmount = document.getElementById('total');
        totalFinalAmount.textContent = 'Total: ' + '$' + totalPriceSum;
    }, false);    
}


// When cart status button on the header is clicked. 
// Hide/show cart contents.
var cartBox = document.querySelector('.cart-contents-box');
var cartBoxShow = false; // Sets initial state of cart box

function toggleCartContents() {
    if (!cartBoxShow) {
        cartBox.classList.add('show');
        cartBoxShow = true;
    } else {
        cartBox.classList.remove('show');
        cartBoxShow = false;
    }
}
var cartStatusBtn = document.getElementById('cart-status-btn');
cartStatusBtn.addEventListener('click', toggleCartContents, false);


/* When cartBox is visible, click anywhere outside of it to hide it */
function hideCartBox() {
    if (cartBoxShow) {
        cartBox.classList.remove('show');
        cartBoxShow = false;
    }
}
var page = document.getElementById('page');
page.addEventListener('click', hideCartBox, false);


/* Clear Cart button */
function clearCart() { 
    var itemsList = document.getElementById('items-list');
    var parent = itemsList.parentNode;
    parent.removeChild(itemsList);
    
    var total = document.getElementById('total');
    total.textContent = 'Total: ' + '$00.00';
    location.reload();                
}
var clearCartBtn = document.getElementById('clear-cart-btn');
clearCartBtn.addEventListener('click', clearCart, false);
