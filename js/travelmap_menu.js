// https://github.com/markmarkoh/datamaps
var map = new Datamap({
  element: document.getElementById('travelmap'),
  responsive: true,
  width: 500,
  height: 500*0.5625,
  geographyConfig: {
    borderWidth: 0.3,
    borderColor: '#adb5bd' // Bootstrap Grey-500
  },
  fills: {
    defaultFill: '#fff',
    felixHasVisited: '#17a2b8', //Bootstrap Info
    felixHome: '#ffc107' // Bootstrap Warning
  },
  data: {
    // Ländercodes: https://en.wikipedia.org/wiki/ISO_3166-1_alpha-3
    DEU: { fillKey: 'felixHome' },
    SWE: { fillKey: 'felixHasVisited' },
    FIN: { fillKey: 'felixHasVisited' },
    EST: { fillKey: 'felixHasVisited' },
    LVA: { fillKey: 'felixHasVisited' },
    POL: { fillKey: 'felixHasVisited' },
    CZE: { fillKey: 'felixHasVisited' },
    HUN: { fillKey: 'felixHasVisited' },
    SVK: { fillKey: 'felixHasVisited' },
    ROU: { fillKey: 'felixHasVisited' },
    MDA: { fillKey: 'felixHasVisited' },
    UKR: { fillKey: 'felixHasVisited' },
    RUS: { fillKey: 'felixHasVisited' },
    MNE: { fillKey: 'felixHasVisited' },
    ALB: { fillKey: 'felixHasVisited' },
    SRB: { fillKey: 'felixHasVisited' },
    GRC: { fillKey: 'felixHasVisited' },
    FRA: { fillKey: 'felixHasVisited' },
    NLD: { fillKey: 'felixHasVisited' },
    BEL: { fillKey: 'felixHasVisited' },
    AUT: { fillKey: 'felixHasVisited' },
    TUR: { fillKey: 'felixHasVisited' },
    IRN: { fillKey: 'felixHasVisited' },
    LBN: { fillKey: 'felixHasVisited' },
    JOR: { fillKey: 'felixHasVisited' },
    ARE: { fillKey: 'felixHasVisited' },
    OMN: { fillKey: 'felixHasVisited' },
    MEX: { fillKey: 'felixHasVisited' },
    DZA: { fillKey: 'felixHasVisited' },
    GBR: { fillKey: 'felixHasVisited' },
    EGY: { fillKey: 'felixHasVisited' },
    SDN: { fillKey: 'felixHasVisited' },
    ETH: { fillKey: 'felixHasVisited' },
    SAU: { fillKey: 'felixHasVisited' },
    BHR: { fillKey: 'felixHasVisited' },
    KWT: { fillKey: 'felixHasVisited' },
    QAT: { fillKey: 'felixHasVisited' },
    IRQ: { fillKey: 'felixHasVisited' },
    CYP: { fillKey: 'felixHasVisited' },
    PHL: { fillKey: 'felixHasVisited' },
    HKG: { fillKey: 'felixHasVisited' },
    MAC: { fillKey: 'felixHasVisited' },
    CHN: { fillKey: 'felixHasVisited' },
    TWN: { fillKey: 'felixHasVisited' },
    KAZ: { fillKey: 'felixHasVisited' },
    KGZ: { fillKey: 'felixHasVisited' },
    TJK: { fillKey: 'felixHasVisited' },
    UZB: { fillKey: 'felixHasVisited' },
    AFG: { fillKey: 'felixHasVisited' },
    GEO: { fillKey: 'felixHasVisited' },
    CUB: { fillKey: 'felixHasVisited' },
  }
});

// 100% der div-Breite für Karte ausnutzen
// Bootstrap: This event is fired when the dropdown has been made visible to the user (will wait for CSS transitions, to complete).
jQuery('#travelreports').on('shown.bs.dropdown', function () {
    map.resize();
});

// Größenanpassung der Karte bei Veränderung der Fenstergröße
jQuery(window).on('resize', function() {
   map.resize();
});
