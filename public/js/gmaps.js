        var map;
        var locLat='-2.293005';
        var locLng='-79.7797965';
        var markers = [];
        var infoWindow;
        var locationSelect;

        function initMap() {

            map = new google.maps.Map(document.getElementById("map"), {
				center: new google.maps.LatLng(locLat,locLng),
				  zoom: 18,
				  mapTypeId: google.maps.MapTypeId.HYBRID,
				  mapTypeControl: false,
				  mapTypeControlOptions: {
					  style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
					  position: google.maps.ControlPosition.LEFT_BOTTOM
				  },
				  zoomControlOptions: {
					position: google.maps.ControlPosition.RIGHT_BOTTOM
                  },
				  fullscreenControl: false,
				  streetViewControl: false,
			});
          }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                                      'Error: The Geolocation service failed.' :
                                      'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);
              }

         function doNothing() {}
