var deleteSVG = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve" width="50px" height="50px"><path class="fill" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M19,8V5c0-1.1,0.9-2,2-2h8  c1.1,0,2,0.9,2,2v3"/><line fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" x1="8" y1="8" x2="42" y2="8"/><line fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" x1="25" y1="15" x2="25" y2="40"/><line fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" x1="31" y1="15" x2="31" y2="40"/><line fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" x1="19" y1="15" x2="19" y2="40"/><path class="fill" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M40,8v37c0,1.1-0.9,2-2,2H12  c-1.1,0-2-0.9-2-2V8"/></svg>';
var checkmarkSVG = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="24px" height="24px"><polyline style="fill-rule:evenodd;clip-rule:evenodd;fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;" points="  18.107,8.893 11,16 7,12 "/><circle style="fill-rule:evenodd;clip-rule:evenodd;fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;" cx="12" cy="12" r="10"/></svg>';

// When the user fills some text and clicks the OK button, the task gets added
// to the pending task list.
function addItem() {
    var userEnteredText = document.getElementById('item').value;
    var listItem = document.createElement('li');
    var pendingList = document.getElementById('pending');
    document.getElementById('item').value = ''; // restores the placeholder again;
    
    if (userEnteredText) { // checks if there is anything entered in the input field
        listItem.textContent = userEnteredText;
        pendingList.appendChild(listItem); 
        var buttons = document.createElement('div'); // create buttons container
        buttons.className = 'buttons';

        var button1 = document.createElement('button'); // create element button.delete
        button1.setAttribute('id', 'delete');
        button1.innerHTML = deleteSVG; // insert SVG
        buttons.appendChild(button1); 
        button1.addEventListener('click', removeItem, false);
        
        var button2 = document.createElement('button'); // create element button.complete
        button2.setAttribute('id', 'complete');
        button2.innerHTML = checkmarkSVG; // insert SVG
        buttons.appendChild(button2); 
        button2.addEventListener('click', completeItem, false); 

        listItem.appendChild(buttons);
    }   
}
var addBtn = document.getElementById('add');
addBtn.addEventListener('click', addItem, false);
 

// When checkmark icon is clicked, the task gets added to the completed task
// list (the tasks' background turns green).
function completeItem() {
    var item = this.parentNode.parentNode; // the <li>, (button2.buttonsdiv.li)
    var parent = item.parentNode; // the pending task list <ul>, (li.pendingul)
    var target = document.getElementById('completed'); // get completed task list

    parent.removeChild(item); // removes li from the pending task list ul
    target.appendChild(item); // adds li into the completed task list ul 
}

// When the delete icon is clicked
function removeItem() {
    var item = this.parentNode.parentNode; // the <li>
    var parent = item.parentNode; // the pending <ul>
    parent.removeChild(item); // removes li from whichever list it happens to be
}


 