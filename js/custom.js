// Navbar-Suche
// Open the full screen search box
function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
  document.getElementById("myOverlay").style.opacity = "1";
  document.getElementById("searchInput").focus();
}

// Close the full screen search box
function closeSearch() {
  document.getElementById("myOverlay").style.opacity = "0";
  document.getElementById("myOverlay").style.display = "none";
  document.getElementById("searchInput").value = "";
}

// Bei ESC closeSearch() ausführen
$(document).keyup(function(e) {
  if ((e.keyCode == 27) && (document.getElementById("myOverlay").style.display == "block")) { // escape key maps to keycode `27`
    closeSearch();
  }
});

// Social Popup
$(".social-wrap").not(".pinterest").click( function() {
  window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=900');
  return false;
});
