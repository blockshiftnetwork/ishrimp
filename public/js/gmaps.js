        var map;
        var locLat='-2.293005';
        var locLng='-79.7797965';
        var hexVal = "0123456789ABCDEF".split("");
        var defaultColor = '#ff0000';
        var myDrawingManager;
        var polygon;
        var pools;
        var infowindows;
            
      

  $( document ).ready(function() {
      infoWindow = new google.maps.InfoWindow;
       $.ajax({
                  url: 'pools',
                  type: 'GET',
                  dataType: 'json',
                  success: function(response){
                    pools =response.data;

          for (var i = 0; i < pools.length; i++) {
              var pool = pools[i];
              var latLng = JSON.parse(pools[i].coordinates);
              var polygon = new google.maps.Polygon({
               path: latLng,
               map: map,
               strokeColor: defaultColor,
               strokeWeight: 3,
               strokeOpacity: 0.5,
               fillColor: defaultColor,
               fillOpacity: 0.3,
               clickable: true,
             });
              polygon.setMap(map);
             listenerMouserOver(polygon, pool);
            }
         }
      });
       
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

    myDrawingManager = new google.maps.drawing.DrawingManager({
    drawingMode: null,
    drawingControl: false
    });

  myDrawingManager.setMap(map);

    $('#createpool').on('click', function(){
      drawTools();

    })
          //ShowDrawingTools(myDrawingManager,true); 
       
         
          //para dibujar el poligono
          polygon = new google.maps.Polygon({});
          listenerMouserOver(polygon);
          var area = google.maps.geometry.spherical.computeArea(polygon.getPath());
          console.log('area', area);
          //asigna colores a cada poligono
          polygon.currentColor = makeColor();
          polygon.setOptions({
            strokeColor: polygon.currentColor,
             fillColor: polygon.currentColor,
             clickable: true,
          });
       
       
    
      });
          
          function makeColor(){
              return '#' + hexVal.sort(function(){
                  return (Math.round(Math.random())-0.5);
              }).slice(0,6).join('');
          }

function closeDrawingTools() {   
    myDrawingManager.setOptions({
         drawingMode: null,
            drawingControl: false,
    });
}

function iniMap(){
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

}

function drawTools(){
       
    myDrawingManager = new google.maps.drawing.DrawingManager({
    drawingMode: google.maps.drawing.OverlayType.POLYLINE,
    drawingControl: false,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_RIGHT,
      drawingModes: ['polyline']
    },
    });

  myDrawingManager.setMap(map);
  listenerOverlay();
}

function listenerOverlay(){
    var npoly;
          google.maps.event.addListener(myDrawingManager, 'overlaycomplete', function(event) {
          console.log(event);
            polygon.currentColor = makeColor();
             npoly = new google.maps.Polygon({
                  path: event.overlay.getPath(),
                  icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
                   map: map,
                   strokeColor: polygon.currentColor,
                   strokeWeight: 3,
                   strokeOpacity: 0.5,
                   fillColor: polygon.currentColor,
                   fillOpacity: 0.3,
                   clickable: false,
              });
             var size = google.maps.geometry.spherical.computeArea(npoly.getPath());
              closeDrawingTools();
              loadFormpool((size/10000).toFixed(2), JSON.stringify(npoly.getPath().getArray()));
            });

}

function loadFormpool(size, coordinates){
  form_pool.style.display = "block";
  $('#size').val(size);
   $('#coordinates').val(coordinates);
}

function  listenerMouserOver(poly, pool) {
  poly.addListener('mouseover', function(event) {
    var contentString = '<div class="card bg-white" style="width: 100%"><div class="card-body" style="width: 100%">'+ '<h3 style="font-size:3rem">'+ pool.name+ '</h3>' +
     '<ul class="list-group">' + 
     '<li class="list-item-group" style="font-size:2rem">' + 'Hectáreas: ' + pool.size + '</li>'+
     '</div> </div>' ;
     
      infoWindow.setContent(contentString);
      infoWindow.setPosition(event.latLng);
      infoWindow.open(map);
     
})
    poly.addListener('mouseout', function(event) {
     infoWindow.close();
     
})
}

