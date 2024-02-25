const navItems= document.querySelector('.nav-items');
const openNavButton=document.getElementById('open-nav-btn');
const closeNavButton=document.getElementById('close-nav-btn');

openNavButton.addEventListener('click',openNav);
closeNavButton.addEventListener('click',closeNav);

function openNav(){
    [...navItems.children].forEach( child=> child.classList.remove('close'));
    navItems.style.display= 'flex';
    openNavButton.style.display='none';
    closeNavButton.style.display='inline-block';
}
function closeNav(){
    [...navItems.children].forEach( child=> child.classList.add('close'));
    openNavButton.style.display='inline-block';
    closeNavButton.style.display='none';
    
}


// DASHBOARD

const sidebar = document.querySelector('aside');
const showSidebarButton = document.querySelector('#show-sidebar-btn');
const hideSidebarButton = document.querySelector('#hide-sidebar-btn');

const showSidebar= () => {
    sidebar.style.left="0";
    showSidebarButton.style.display='none';
    hideSidebarButton.style.display='inline-block';
};
const hideSidebar= () => {
    sidebar.style.left="-100%";
    showSidebarButton.style.display='inline-block';
    hideSidebarButton.style.display='none';
};

showSidebarButton.addEventListener('click',showSidebar);
hideSidebarButton.addEventListener('click',hideSidebar);

