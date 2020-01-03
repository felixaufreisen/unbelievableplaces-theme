function initMap() {

  // https://plugins.trac.wordpress.org/browser/meks-easy-maps/trunk/public/js/main.js
  // https://www.sitepoint.com/use-html5-data-attributes/
  var karte = $('#map');
  var settings = karte.data("settings");
  var locations = karte.data("locations");
  console.log(settings);
  console.log(locations);

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: settings.zoom,
    center: {
      lat: settings.lat,
      lng: settings.lng
    },
    styles: [{
        "featureType": "administrative.land_parcel",
        "elementType": "labels",
        "stylers": [{
          "visibility": "off"
        }]
      },
      {
        "featureType": "administrative.neighborhood",
        "elementType": "labels.text",
        "stylers": [{
          "visibility": "off"
        }]
      },
      {
        "featureType": "administrative.province",
        "elementType": "geometry.stroke",
        "stylers": [{
          "visibility": "off"
        }]
      },
      {
        "featureType": "landscape.natural",
        "elementType": "geometry.fill",
        "stylers": [{
            "saturation": 20
          },
          {
            "lightness": -10
          }
        ]
      },
      {
        "featureType": "landscape.natural.terrain",
        "elementType": "geometry.fill",
        "stylers": [{
          "visibility": "off"
        }]
      },
      {
        "featureType": "poi",
        "elementType": "labels.text",
        "stylers": [{
          "visibility": "off"
        }]
      },
      {
        "featureType": "poi.business",
        "stylers": [{
          "visibility": "off"
        }]
      },
      {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [{
          "visibility": "off"
        }]
      },
      {
        "featureType": "road.arterial",
        "stylers": [{
          "visibility": "off"
        }]
      },
      {
        "featureType": "road.highway",
        "elementType": "labels",
        "stylers": [{
          "visibility": "off"
        }]
      },
      {
        "featureType": "road.local",
        "stylers": [{
          "visibility": "off"
        }]
      },
      {
        "featureType": "road.local",
        "elementType": "labels",
        "stylers": [{
          "visibility": "off"
        }]
      },
      {
        "featureType": "transit",
        "stylers": [{
          "visibility": "off"
        }]
      },
      {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [{
            "color": "#17a2b8"
          },
          {
            "weight": 2
          }
        ]
      },
      {
        "featureType": "water",
        "elementType": "labels.text",
        "stylers": [{
          "visibility": "off"
        }]
      }
    ]
  });

  // Add some markers to the map.
  // Note: The code uses the JavaScript Array.prototype.map() method to
  // create an array of markers based on a given "locations" array.
  // The map() method here has nothing to do with the Google Maps API.
  var markers = locations.map(function(location, i) {
    var marker = new google.maps.Marker({
      position: location,
      icon: {
        path: 'M60,14.147c-17.855,0-32.331,14.475-32.331,32.331C27.669,76.314,60,107.292,60,107.292s32.331-34.111,32.331-60.815  C92.331,28.622,77.855,14.147,60,14.147z M60.001,58.015c-7.4,0-13.398-5.999-13.398-13.398c0-7.399,5.999-13.398,13.398-13.398  c7.399,0,13.397,5.999,13.397,13.398C73.398,52.016,67.4,58.015,60.001,58.015z',
        fillColor: location.color,
        fillOpacity: 1,
        strokeOpacity: 0,
        strokeWeight: 1,
        scale: 0.5,
        anchor: new google.maps.Point(60, 102)
      },
    });
    google.maps.event.addListener(marker, 'click', function(evt) {

			// Formatierung der Infobox
      var html = '<div class="ibmap-infobox">' +
        '<div class="thumbnail"><a href="' + location.link + '">' + location.thumbnail + '</a></div>' +
        '<div class="close-btn"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" class="svg-inline--fa fa-times fa-w-11"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" class=""></path></svg></div><div class="mks-map-element-pos-abs">' +
        '<div class="desc-wrap">' +
        '<h6><a href="' + location.link + '">' + location.title + '</a></h6>' +
        '<div class="meta"><p>' + location.category + '</p>' +
        '<p>' + location.date + '</p></div>' +
        '</div>' +
        '</div>';

      var infoBox = new InfoBox(infoBoxOptions);
      infoBox.setContent(html);
      infoBox.open(map, marker);

      // Listener für Close-Event
      google.maps.event.addListener(infoBox, 'domready', function() {
        $('.close-btn').click(function() {
          infoBox.close();
        });
      });
    })
    return marker;
  });

  // Add a marker clusterer to manage the markers.
  var markerCluster = new MarkerClusterer(map, markers, {
    imagePath: 'https://www.felixaufreisen.de/images/markerclusterer/m'
  });

  // Setup InfoBox
  // https://github.com/googlemaps/v3-utility-library/tree/master/infobox

  var infoBoxWrapper = document.createElement("div");
  infoBoxWrapper.className = 'ibmap';

  var infoBoxOptions = {
    content: infoBoxWrapper,
    disableAutoPan: false,
    alignBottom: true,
    maxWidth: 0,
    pixelOffset: new google.maps.Size(-60, -46),
    zIndex: null,
    boxStyle: {
      width: "280px"
    },
    closeBoxMargin: "0px",
    closeBoxURL: "",
    enableEventPropagation: false
  };
}
