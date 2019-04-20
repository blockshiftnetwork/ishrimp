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
               strokeColor: pools[i].days != null ? defaultColor : '#FE2E2E',
               strokeWeight: 3,
               strokeOpacity: 0.5,
               fillColor: pools[i].days != null ? defaultColor : '#FE2E2E',
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
 
 if(dataPool.days!== null){

 return '<div class="card bg-white text-justify" style="width: 18rem;">'+
           '<img class="card-img-top" src="/images/top-login-header.svg" alt="Card image cap">'+
           '<div class="card-body">'+
             '<h5 class="card-title text-uppercase">'+dataPool.name+'</h5>'+
            '<table class="table table-responsive">'+
    '<tbody>'+
    '<tr><td>'+dataPool.days+' Dias</td><td></td><td> '+(dataPool.size).toFixed(2)+' Hectareas</td></tr>'+
    '<tr><td> abw: '+(dataPool.abw).toFixed(2)+'g</td><td></td><td> awg: '+(dataPool.awg).toFixed(2)+'g</td>'+
    '</tr>'+
    '<tr><td> RC: '+((dataPool.balanced*2.2)/((dataPool.abw*2.2/1000)*(dataPool.survival/100)*(dataPool.planted_larvae))).toFixed(2)+'Lbs</td><td></td><td>'+(dataPool.do).toFixed(2)+' DO/mg/L</td>'+
    '</tr>'+
    '</tbody>'+
    '</table>'+ 
          '</div>'+
        '</div>'

  }else{
    return '<div class="card bg-white text-justify" style="width: 18rem;">'+
           '<img class="card-img-top" src="/images/top-login-header.svg" alt="Card image cap">'+
           '<div class="card-body">'+
             '<h5 class="card-title text-uppercase">'+dataPool.name+'</h5>'+     
              '<div><h6 class="text-danger" >Aun no se ha realizado la siembra: </h6><div style="margin:0 24% 0 30%"><a href="/pools_sowing" class="btn btn-danger">Sembrar</a></div></div>'+

          '</div>'+
        '</div>'
  }

  }


}

