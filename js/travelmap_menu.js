var map = new Datamap({
  element: document.getElementById('travelmap'),
  responsive: true,
  width: 500,
  height: 500*0.5625
});

jQuery.$(".dropdown-menu").click( function() {
  map.resize();
});

d3.select(window).on('resize', function() {
    map.resize();
});
