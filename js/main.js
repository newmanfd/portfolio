const menuBtn = document.querySelector('.menu-btn');
const menu = document.querySelector('.menu');
const menuNav = document.querySelector('.menu-nav');
const navItems = document.querySelectorAll('.nav-item');

let showMenu = false; // Sets initial state of menu
 
// Hide/show menu sidebar
function toggleMenu() {
   if (!showMenu) {
       menu.classList.add('show');
       menuNav.classList.add('show');
       
       navItems.forEach(item => item.classList.add('show'));
       
       showMenu = true; // Set menu state
   } else {
       menu.classList.remove('show');
       menuNav.classList.remove('show');
       
       navItems.forEach(item => item.classList.remove('show'));  

       showMenu = false; // Set menu state
   }
}
menuBtn.addEventListener('click', toggleMenu, false);

