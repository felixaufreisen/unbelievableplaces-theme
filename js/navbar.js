// Add .fixed-top to nav when scrolled >150px
$(window).scroll(function () {
  if ( $(this).scrollTop() > 150 && !$('nav').hasClass('fixed-top') ) {
    $('nav').addClass('fixed-top');
    // on pages with cover-picture reset the overlapping nav
    if ( $('nav').hasClass('cover-picture') ) {
      $('nav').addClass('navbar-light');
      $('nav').removeClass('navbar-dark');
      $('nav').css('margin-bottom','0');
    } else {
      // Avoid content jumping up when nav is made sticky (and removed from top)
      $('body').css('margin-top', '80px')
    }
  } else if ( $(this).scrollTop() <= 10 ) {
    $('nav').removeClass('fixed-top');
    // on pages with cover-picture restore the overlapping nav
    if ( $('nav').hasClass('cover-picture') ) {
      $('nav').removeClass('navbar-light');
      $('nav').addClass('navbar-dark');
      $('nav').css('margin-bottom','-80px');
    } else {
      $('body').css('margin-top', '0')
    }
  }
});
