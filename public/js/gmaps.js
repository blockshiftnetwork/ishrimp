        var map;
        var locLat='-2.293005';
        var locLng='-79.7797965';
        var hexVal = "0123456789ABCDEF".split("");
        var defaultColor = '#01B6F0';
        var myDrawingManager;
        var polygon;
        var pools;
        var infowindows;
        var drawMode = false;
            
      

  $( document ).ready(function() {
      infoWindow = new google.maps.InfoWindow;
       iniMap();
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
       
         

    myDrawingManager = new google.maps.drawing.DrawingManager({
    drawingMode: null,
    drawingControl: false
    });

  myDrawingManager.setMap(map);

    $('#createpool').on('click', function(){
      drawMode = true;
      drawTools();
    });

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
  cancelDraw(myDrawingManager,null);
  listenerOverlay();
}

function cancelDraw(overlay1, overlay2){
     $('#createpool').attr("style", "display:none");
   $('#cancel').attr("style", "display:block");
   $('#cancel').on('click', function(){
      if(overlay1 != null){
        overlay1.setMap(null);
      }
      if(overlay2 != null){
        overlay2.setMap(null);
      }
       
        $('#createpool').attr("style", "display:block");
         $('#cancel').attr("style", "display:none;");

         unloadFormpool();
    });
}

function listenerOverlay(){
    var npoly;
          google.maps.event.addListener(myDrawingManager, 'overlaycomplete', function(event) {
          console.log(event);
            polygon.currentColor = makeColor();
             npoly = new google.maps.Polygon({
                  path: event.overlay.getPath(),
                   map: map,
                   strokeColor: polygon.currentColor,
                   strokeWeight: 3,
                   strokeOpacity: 0.5,
                   fillColor: polygon.currentColor,
                   fillOpacity: 0.3,
                   clickable: false,
              });
               polygon.setMap(map);
             var size = google.maps.geometry.spherical.computeArea(npoly.getPath());
              closeDrawingTools();
              cancelDraw(npoly, event.overlay);
              loadFormpool((size/10000).toFixed(3), JSON.stringify(npoly.getPath().getArray()));
            });

}

function loadFormpool(size, coordinates){
  form_pool.style.display = "block";
  $('#size').val(size);
   $('#coordinates').val(coordinates);
}

function unloadFormpool(){
  form_pool.style.display = "none";
  $('#size').val('');
   $('#coordinates').val('');
}

function  listenerMouserOver(poly, pool) {
  poly.addListener('mouseover', function(event) {
   
     
      infoWindow.setContent(strInfoPools(pool));
      infoWindow.setPosition(event.latLng);
      infoWindow.open(map);
     
})
    poly.addListener('mouseout', function(event) {
     infoWindow.close();
     
})

  function strInfoPools(dataPool){
 return '<div class="card bg-white text-justify" style="width: 18rem;">'+
           '<img class="card-img-top" src="/images/top-login-header.svg" alt="Card image cap">'+
           '<div class="card-body">'+
             '<h5 class="card-title text-uppercase">'+dataPool.name+'</h5>'+
            '<table class="table table-responsive">'+
    '<tbody>'+
    '<tr><td>78 Dias</td><td></td><td> '+dataPool.size+' Hectareas</td></tr>'+
    '<tr><td>15.00 ABW</td><td></td><td>7.18 g</td>'+
    '</tr>'+
    '<tr><td>4 NA</td><td></td><td>0 mg/L</td>'+
    '</tr>'+
    '<tr><td>23 RC</td><td></td><td>0 DO/mg/L</td>'+
    '</tr>'+
    '</tbody>'+
    '</table>'+ 
          '</div>'+
        '</div>'

  }


}

