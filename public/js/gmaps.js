        var map;
        var locLat='-2.293005';
        var locLng='-79.7797965';
        var markers = [];
        var infoWindow;
        var locationSelect;

window.onload = function () {
  var hexVal = "0123456789ABCDEF".split("");
  var defaultColor = '#ff0000';
          map = new google.maps.Map(document.getElementById("map"), {
            center: new google.maps.LatLng(locLat, locLng),
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
          //para dibujar el poligono
          var polygon = new google.maps.Polygon({
              path: [
                {lat:  -2.2918057558017075,lng:  -79.78164527542776},
                {lat:  -2.2928670605864863, lng:  -79.78157553799338},
                {lat:  -2.2931297065985965, lng:  -79.77879676945395},
                {lat:  -2.292063041882396, lng:  -79.77882895596}
              ],
               map: map,
               strokeColor: defaultColor,
               strokeWeight: 3,
               strokeOpacity: 0.5,
               fillColor: defaultColor,
               fillOpacity: 0.3,
               clickable: false,
               
          });
          //asigna colores a cada poligono
          polygon.currentColor = makeColor();
          polygon.setOptions({
            strokeColor: polygon.currentColor,
             fillColor: polygon.currentColor,
             clickable: true,
          });
          function makeColor(){
              /**
               * Otra forma de crear un color aleatoriamente:
               *
               * for(var color = Math.floor(Math.random()*0xffffff).toString(16); color.length < 6; color = '0'+color);
               * return '#' + color;
               */
              return '#' + hexVal.sort(function(){
                  return (Math.round(Math.random())-0.5);
              }).slice(0,6).join('');
          }
       
          polygon.currentColor = makeColor();
          google.maps.event.addListener(polygon, 'click', function(e){
              polygon.setOptions({
                  strokeColor: polygon.currentColor,
                   fillColor: polygon.currentColor,
                   clickable: true
              });
              polygon = this, this.setOptions({
                  strokeColor: defaultColor,
                   fillColor: defaultColor,
                   clickable: false
              });
          });
       
          google.maps.event.addListener(map, 'rightclick', function(){
              polygon.setOptions({
                  strokeColor: polygon.currentColor,
                   fillColor: polygon.currentColor,
                   clickable: true,
              });
              polygon = new google.maps.Polygon({
                  path: new google.maps.MVCArray()
                  , map: map
                  , strokeColor: defaultColor
                  , strokeWeight: 3
                  , strokeOpacity: 0.5
                  , fillColor: defaultColor
                  , fillOpacity: 0.3
                  , clickable: false
              });
       
              polygon.currentColor = makeColor();
              google.maps.event.addListener(polygon, 'click', function(){
                  polygon.setOptions({
                      strokeColor: polygon.currentColor
                      , fillColor: polygon.currentColor
                      , clickable: true
                  });
                  polygon = this, this.setOptions({
                      strokeColor: defaultColor
                      , fillColor: defaultColor
                      , clickable: false
                  });
              });
             console.log(polygon.getPath());
          });
       
          google.maps.event.addListener(map, 'click', function(e){
              polygon.getPath().push(e.latLng);
              console.log('lat: ' , e.latLng.lat(),'lng: ' , e.latLng.lng(), );
          });
      };
        