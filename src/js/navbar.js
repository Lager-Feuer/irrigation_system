function toggleCssMenu(icon) {
    var cssmenu = document.getElementById('cssmenu');
    if (icon.className.indexOf('active') == -1) {
        icon.className = 'menu-icon active';
        cssmenu.style.display = "block";
        setTimeout(function() { cssmenu.className = 'active'; }, 0);
    } else {
        icon.className = 'menu-icon';
        cssmenu.className = '';
        setTimeout(function() { cssmenu.style.display = "none"; }, 411);
    }
}