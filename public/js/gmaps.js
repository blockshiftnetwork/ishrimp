var map;
        var markers = [];
        var infoWindow;
        var locationSelect;

        function initMap() {

            var map = new google.maps.Map(document.getElementById('map'), {zoom: 12, mapTypeId: 'hybrid'});
            var geocoder = new google.maps.Geocoder;

            geocoder.geocode({'address': 'Guayaquil'}, function(results, status) {
              if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location
                });
              } else {
                window.alert('Geocode was not successful for the following reason: ' +
                    status);
              }
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
