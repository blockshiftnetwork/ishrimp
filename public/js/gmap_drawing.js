var mapOverlays = new Array();
var infoWindowAddNewPond, mapContainerId=1, pondPreviousLatLng, newPondLatArray, newPondLngArray,currentPondId=0,currentPondName='Pond Name', newPondAreaSize, newPondLocationName, newPondLocationId, currentLocLatLng;
var isEditable = false, markerEditPond; 

$( document ).ready(function() { 
	$(document).on("click", ".clsButton", function(e) {  
		var htm = '';
		htm+= '<div class="map-draw-info">'; 
			htm+= '<p>'+js_strings.Map_click_field_shape_msg+'</p>';
			htm+= '<div class="sub"><a href="javascript: void(0)" id="draw_poly" onclick="selectPoly()" class="lblStyle">'+js_strings.Map_draw_ur_own+'</a> or <a href="javascript:void(0)" onclick="createAddPondBtn()" id="cancel" class="lblStyle">'+js_strings.Comn_cancel+'</a></div>';
		htm+='</div>';
		$(".clsMapAddPond").html(htm);  
	});  
	$(document).on("change", "#pond_name", function(e) {  
		currentPondName=$(this).val();  
	});  
}); 
function PolygonEditableSet(pondid)
{   
	$('#navSearchOptions').hide(); $('#txtGoogleLocationSearch').hide(); 
	currentPondId=pondid;
	$('.clsMapAddPond').hide(); 
	editModeEnabled=1; 
	infoBubbleWindow.close();
	$('#mapPondDetailedView').hide();
	toggleLeftSideMenu(3); 
	var singleLocationPolygon = jQuery.grep(globalPolygons, function( elem ) {
			return elem.locid === selectedPondLocId;
	}); 
	singleLocationPolygon.forEach(function(e) {  
		if(e.pondid==pondid)	{	 	
			e.setOptions({visible:true, strokeOpacity:1, fillOpacity:0.5, fillColor:'#f0ad4e', strokeColor:'#f0ad4e'  });
			e.setEditable(true); 
			pondPreviousLatLng=e.getPath(); 
			//Event Listeners for editing polygon
			google.maps.event.addListener(e.getPath(), 'set_at', function() {  
				GetFormData(e.getPath(),e.pondid,e.locid,e.locname,'edit'); 
			});
			google.maps.event.addListener(e.getPath(), 'insert_at', function() {  
				GetFormData(e.getPath(),e.pondid,e.locid,e.locname,'edit'); 
			});
			google.maps.event.addListener(e.getPath(), 'remove_at', function() { 
				GetFormData(e.getPath(),e.pondid,e.locid,e.locname,'edit'); 
			});	
			AttachClickEditListener(e.pondid);			
		}							
	});  
	if(event.stopPropagation) event.stopPropagation();	
}
//create a common infoWindow object
//infoWindowAddNewPond = new google.maps.InfoWindow();
infoWindowAddNewPond = new InfoBubble({
	minWidth: 190,
	maxWidth:'auto',
	minHeight:130,
	maxHeight:'auto',
	arrowSize: 12,
	borderRadius:5,
	backgroundColor:'rgba(255,255,255,1)',
	padding:0,
	hideCloseButton:true, 
	disableAutoPan:false
});  
infoWindowAddNewPond.setMap(map);		

function addPondCreationButton(controlDiv, map) {  
    // Set CSS for the control border.
    var addPondBtnUI = document.createElement('div'); 
	addPondBtnUI.title = 'js_strings.Map_click_creat_new_pond';
	addPondBtnUI.setAttribute("class","clsButton"); 
	controlDiv.appendChild(addPondBtnUI); 
	// Set CSS for the control interior.
	var addPondBtnText = document.createElement('div');  
	addPondBtnText.innerHTML = 'js_strings.Comn_add_pond';
	addPondBtnUI.appendChild(addPondBtnText);  
}
function createAddPondBtn() {
	$(".clsMapAddPond").html('<div title="'+'js_strings.Map_click_creat_new_pond'+'" class="clsButton"><div>'+'js_strings.Comn_add_pond'+'</div></div>');
}
function selectPoly() {  
	drawingModeEnabled=1;
	$('#mapPondDetailedView').hide();
	$('.gm-style-iw').addClass('clsAddNewInfoWindow'); 
	myDrawingManager.setDrawingMode('polygon');
	document.getElementsByClassName("clsMapAddPond")[0].innerHTML= cancelPolygonTool();
} 
function cancelPolygonTool() {  
	$('#navSearchOptions').hide(); 
	$('#txtGoogleLocationSearch').hide(); 
	var htm = '';
	htm+= '<div class="map-draw-info">';
	htm+= '<p>'+'js_strings.Map_trace_your_pond_boundaries'+'</p>';
	htm+= '<div class="sub"><a href="javascript:void(0)" id="cancel" onclick="deleteOverlayCom()">'+js_strings.Comn_cancel+'</a></div>';
	htm+='</div>';
	return htm;
} 
function deleteOverlay(){  
	infoWindowAddNewPond.close();
	ShowDrawingTools(false);  	 
	$('#navSearchOptions').show(); $('#txtGoogleLocationSearch').show();  
	if(editModeEnabled==0 && drawingModeEnabled==1){ 
		createAddPondBtn(); 
		$('.clsMapAddPond').show();   
		infoWindowAddNewPond.close();
		infoWindowAddNewPond.relatedOverlay.setMap( null ); 		
	}
	else{ 
		 window.location.href='mapview';
	} 
	drawingModeEnabled=0;
} 
function deleteOverlayCom()
{  
	drawingModeEnabled=0;
	myDrawingManager.setDrawingMode(null); 
	ShowDrawingTools(false); 
	$('.gm-style-iw').removeClass('clsAddNewInfoWindow'); 
	$('#navSearchOptions').show(); 
	$('#txtGoogleLocationSearch').show();    
	createAddPondBtn(); 
	$('.clsMapAddPond').show();  
	infoWindowAddNewPond.relatedOverlay.setMap( null );  
	infoWindowAddNewPond.close(); 
	infoWindowAddNewPond.setMap(null); 
}
function ShowDrawingTools(myDrawingManager ,val) {   
    myDrawingManager.setOptions({
         drawingMode: null,
            drawingControl: val
    });
}
function closeInfoWindow(){  
	$('.gm-style-iw').removeClass('clsAddNewInfoWindow'); 
	ShowDrawingTools(false); 
    updateOverlay();
    infoWindowAddNewPond.close();
}
/*** Show drawing tools */
function DrawingTools(myDrawingManager,map) {   
    myDrawingManager = new google.maps.drawing.DrawingManager({
    drawingMode: null,
    drawingControl: false,
		drawingControlOptions: {
			position: google.maps.ControlPosition.TOP_RIGHT,
			drawingModes: [
			google.maps.drawing.OverlayType.POLYGON
			]
		},
		polygonOptions: {
			draggable: false,
			editable: true,
			fillColor: '#000000',
			fillOpacity: 0.5,
			strokeColor: '#000000',
			strokeWidth: 5
		}
    });
    myDrawingManager.setMap(map);
    // when polygon drawing is complete, an event is raised by the map
    // this function will listen to the event and work appropriately
    
} 
function uniqid(){
    var newDate = new Date;
    return newDate.getTime();
}
function overlayDone( event ) {
console.log("event") ;
	if(drawingModeEnabled==1){ 
		ShowDrawingTools(false); 
		var uniqueid =  uniqid();
		//event.overlay.uniqueid =  uniqueid;
		event.overlay.title = "";
		event.overlay.content = "";
		event.overlay.type = event.type;
		mapOverlays.push( event.overlay );
		AttachClickListener( event.overlay );   
		openInfowindow( event.overlay, getShapeCenter( event.overlay ), getEditorContent( event.overlay ) ); 
	}
	else{ 
		ShowDrawingTools(false); 
		var uniqueid =  uniqid();
		//event.overlay.uniqueid =  uniqueid;
		event.overlay.title = "";
		event.overlay.content = "";
		event.overlay.type = event.type;
		mapOverlays.push( event.overlay );
		AttachClickListener( event.overlay );   
		infoWindowAddNewPond.relatedOverlay = event.overlay;
		getShapeCenter( event.overlay ); getEditorContent( event.overlay );
	}
}
function AttachClickListener( overlay ){    
	google.maps.event.addListener( overlay, "click", function(clkEvent){  
		newPondAreaSize=GetArea(overlay); 
		console.log(newPondAreaSize);
		newPondAreaSize= newPondAreaSize.replace(/[^0-9\.]/g, '');
		if(editModeEnabled==0){  
			currentPondId=0;  
			var infContent = getEditorContent( overlay );
		}else{
			//var infContent = GetContent( overlay );
			var infContent = getEditorContent( overlay );
		}
		openInfowindow( overlay, clkEvent.latLng, infContent );
	}); 
	google.maps.event.addListener(overlay, 'mousemove', function(clkEvent) { 
		newPondAreaSize=GetArea(overlay); 
		newPondAreaSize= newPondAreaSize.replace(/[^0-9\.]/g, '');
		$("#pond_size").val(newPondAreaSize);
	});	 	
}

function AttachClickEditListener( pondid ){  
	if(currentPondId==pondid){ // avoid multiple ponds edit option
		var singleLocationPolygon = jQuery.grep(globalPolygons, function( elem ) {
				return elem.locid === selectedPondLocId;
		}); 
		singleLocationPolygon.forEach(function(e) {   
			if(e.pondid==pondid)	{ 
				e.setOptions({visible:true, strokeOpacity:1, fillOpacity:0.5, fillColor:'#f0ad4e', strokeColor:'#f0ad4e'  });
				e.setEditable(true);  
				GetFormData(e.getPath(),e.pondid,e.locid,e.locname,'new'); 
			}
			else{
				e.setEditable(false); 
			}	
		});  
	} 
}


	
/**
     * Get coordinates of the polygon and display information that should 
     * appear in the polygon's dialogue box when it is clicked
     */
function GetFormData(polygon,pondid,locid,locname,displayType) {   
	var polyPath=polygon.getArray();
	var polyString=JSON.stringify(polyPath); 
	var objCoordinates=JSON.parse(polyString);
	var centerPolygonCords=polygonCenter(objCoordinates); 
	var latArray = [];
	var lngArray = [];
	for (var index = 0; index < objCoordinates.length; index++) { 
		latArray.push(parseFloat(objCoordinates[index].lat));
		lngArray.push(parseFloat(objCoordinates[index].lng));  
	}
	newPondLatArray=latArray; 
	newPondLngArray=lngArray; 
	markerEditPond = new google.maps.Marker({
		position: centerPolygonCords,
		map: map 
	});
	markerEditPond.setVisible(false); 
	newPondAreaSize=GetAreaWithoutGetPath(polyPath); 
	newPondAreaSize= newPondAreaSize.replace(/[^0-9\.]/g, '');
	if(displayType=='new')
	{
		var filteredPond = jQuery.grep(holdJSONPondsObject, function( elem ) {
			return elem.pondid === pondid;
		});  	
		if(filteredPond.length>0){ 
			currentPondName=filteredPond[0].pondname;
		}  
	}   
	var retrnStringLatLng=polygonCenterString(objCoordinates);  
	newPondLocationName=locname;
	newPondLocationId=locid;
	currentLocLatLng=retrnStringLatLng; 
	currentPondId=pondid;  	
	var infContent = getEditorContent("");
	infoWindowAddNewPond.setContent(infContent);
	infoWindowAddNewPond.open(map, markerEditPond);	 
}





function getShapeCenter( shape ){  
	if( shape.type == "marker" ){
		return shape.position;
	}else if( shape.type == "circle" ){
		return shape.getCenter();
	}else if( shape.type == "rectangle" ){
		return new google.maps.LatLng( (shape.getBounds().getSouthWest().lat() + shape.getBounds().getNorthEast().lat() )/2, (shape.getBounds().getSouthWest().lng() + shape.getBounds().getNorthEast().lng() )/2 )
	}else if( shape.type == "polygon" ){ 
		var coordinates = shape.getPath().getArray(); 
		splitLatLng(coordinates);  
		newPondAreaSize=GetArea(shape); 
		newPondAreaSize= newPondAreaSize.replace(/[^0-9\.]/g, '');
		// $("input[name='ddlLocations']").each(function() { 
			// if ($(this).parent().hasClass("active")) {  
				// var locationValues=$(this).val(); 
				// var arrayLoc=locationValues.split('|');  
				// currentLocLatLng=arrayLoc[0]+','+arrayLoc[1];				
				// newPondLocationId=arrayLoc[2]; 
				// newPondLocationName=$(this).attr('id'); 
			// }
		// });  
		return shape.getPaths().getAt(0).getAt(0);
	}else if( shape.type == "polyline" ){
		return shape.getPath().getAt( Math.round( shape.getPath().getLength()/3 ) );
	}
}

//Split LatLng into arrays
function splitLatLng(latlngs) { 
	var latArray = [];
	var lngArray = [];
	for (var i = 0; i < latlngs.length; i++) {
		latArray.push(latlngs[i].lat());
		lngArray.push(latlngs[i].lng());
    } 
	newPondLatArray=latArray; 
	newPondLngArray=lngArray; 
}
/** Get area of the drawn polygon  */
function GetArea(poly) {
    var result = parseFloat(google.maps.geometry.spherical.computeArea(poly.getPath())) * 0.000247105;
    return result.toFixed(2);
}
function GetAreaWithoutGetPath(poly) {
    var result = parseFloat(google.maps.geometry.spherical.computeArea(poly)) * 0.000247105;
    return result.toFixed(2);
}
function getEditorContent( overlay ){   
	var locReadonly='readonly'; 
	if(editModeEnabled==0) locReadonly=''; 
	newPondAreaSize= newPondAreaSize.replace(/[^0-9\.]/g, '');  
	var content = '<form class="pond_form" id="pond_save"><div id="AddNewInfoWindow_container" style="height:100%">' 
	 + '<div class="form-group"><label>'+js_strings.Comn_location+'</label><input type="text" class="form-control" id="location_name" name="location_name" value="'+newPondLocationName+'" '+locReadonly+' /></div>'
	 + '<input type="hidden" name="location_id" id="location_id" value="'+newPondLocationId+'"><input type="hidden" name="location_latlng" id="latlng"  value="'+currentLocLatLng+'">'
	 + '<div class="form-group"><label>'+js_strings.Comn_pond_name+'</label><input type="text" class="form-control" id="pond_name" name="pond_name" value="'+currentPondName+'" /></div>'
	 + '<input type="hidden" name="pond_id" id="pond_id" value="'+currentPondId+'">'
	 + '<input type="hidden" name="pond_lats" id="pond_lats" value="'+newPondLatArray+'">'
	 + '<input type="hidden" name="pond_lngs" id="pond_lngs" value="'+newPondLngArray+'">'	 
	 + '<div class="form-group"><label>'+js_strings.Map_pond_size_acr+'</label><input type="text" class="form-control" name="pond_size" id="pond_size" value="'+newPondAreaSize+'" /></div>'		
     + '<div class="form-group"><input type="button" class="btn btn-danger pull-left" value="'+js_strings.Comn_cancel+'" onclick="deleteOverlay()" title="'+js_strings.Map_delete_shape+'" /> '
     + '<a class="btn btn-primary margin-l-5" title="'+js_strings.Map_create_new_pond+'" onclick="savePondDetails()" >'+js_strings.Comn_submit+'</button>'
	 + '<a class="pull-right btn btn-default" onclick="closeEditPondIW()" title="'+js_strings.Comn_close_window+'"><i class="fa fa-close"></i></a>'
     + '</div></form>'
	return content;
}
 
function savePondDetails() { 
		var map_owner=$('#hdOwnerid').val(); 
			var errors = []; 
			if(($("#location_name").val()).length==0) {
				errors.push(js_strings.Comn_location_name_not_empty1);
			}  
			if(($("#pond_name").val()).length==0) {
				errors.push(js_strings.Map_pond_name_not_empty);
			} else {
				var string = $("#pond_name").val();
				//var reg = new RegExp("^ *([A-Za-z0-9._@]+ ?)+ *$");
				var reg = /^ *([A-Za-z0-9._@]+ ?)+ *$/;
				if (!(reg.test(string))) {
					errors.push(js_strings.Map_pond_name_not_valid_msg);
				} 
			}
			var varPondSize=$("#pond_size").val();
			if(($("#pond_size").val()).length==0 || varPondSize=="0.00" || varPondSize=="0")
			{
				errors.push(js_strings.Map_pond_size_greater0); 
			} 
			if(isNaN($("#pond_size").val())) {
				errors.push(js_strings.Map_pond_size_numaric);  
			}else{
				if(varPondSize<0){
					errors.push(js_strings.Map_pond_size_greater0);  
				}
			} 
			
			if(errors.length==0) {  
				varPondSize= varPondSize.replace(/[^0-9\.]/g, '');
				//$("#pond_size").val(varPondSize);
				var data = $(".pond_form").serialize();
				data+='&map_owner='+map_owner;
				$.post('actions/mapsActions/saveNewPond',{form_data: data},function(data){					
					var result = JSON.parse(data);
					if(result['responseCode'] == 'Ok'){
						var split_txt = result['responseData'].split(":");
						if(split_txt[0]=='Success') { 
							alert(js_strings.Pond_details_save_success);
							window.location.href='mapview';
						} else {
							alert(result);
						}
					} else{
						alert(result['responseMessage']);
					}
				});
			} else {
				var err_txt = js_strings.Comn_clr_errors_msg2+": \n";
				$.each(errors,function(i,v) {
					err_txt+= v+'\n';
				});
				alert(err_txt);
			}
}
  
function updateOverlay(){ 
    infoWindowAddNewPond.relatedOverlay.title = document.getElementById( 'BlitzMapInfoWindow_title' ).value;
    infoWindowAddNewPond.relatedOverlay.content = document.getElementById( 'BlitzMapInfoWindow_content' ).value;

    if( infoWindowAddNewPond.relatedOverlay.type == 'polygon' || infoWindowAddNewPond.relatedOverlay.type == 'circle' || infoWindowAddNewPond.relatedOverlay.type == 'rectangle' ){

        infoWindowAddNewPond.relatedOverlay.setOptions( {fillColor: '#'+document.getElementById( 'BlitzMapInfoWindow_fillcolor' ).value.replace('#','') } );
        setStyle( document.getElementById( 'BlitzMapInfoWindow_fillcolor' ), { 'background-color': '#'+document.getElementById( 'BlitzMapInfoWindow_fillcolor' ).value.replace('#','') } );

        infoWindowAddNewPond.relatedOverlay.setOptions( {fillOpacity: Number( document.getElementById( 'BlitzMapInfoWindow_fillopacity' ).value ) } );
    } 
    if( infoWindowAddNewPond.relatedOverlay.type != 'marker' ){
            infoWindowAddNewPond.relatedOverlay.setOptions( {strokeColor: '#'+document.getElementById( 'BlitzMapInfoWindow_strokecolor' ).value.replace('#','') } );

            infoWindowAddNewPond.relatedOverlay.setOptions( {strokeOpacity: Number( document.getElementById( 'BlitzMapInfoWindow_strokeopacity' ).value ) } );

            infoWindowAddNewPond.relatedOverlay.setOptions( {strokeWeight: Number( document.getElementById( 'BlitzMapInfoWindow_strokeweight' ).value ) } );
      }else{
            infoWindowAddNewPond.relatedOverlay.setOptions( {icon: document.getElementById( 'BlitzMapInfoWindow_icon' ).value } );
    }
}

function closeEditPondIW()
{
	infoWindowAddNewPond.close();
	//pondPreviousLatLng	
}

function openInfowindow( overlay, latLng, content ){
        var div = document.createElement('div');
        div.innerHTML = content;
        setStyle( div, {height: "100%"} );
        infoWindowAddNewPond.setContent( div );
        infoWindowAddNewPond.setPosition( latLng );
        infoWindowAddNewPond.relatedOverlay = overlay;
        var t = overlay.get( 'fillColor' );
        infoWindowAddNewPond.open( map );
		$('.gm-style-iw').addClass('clsAddNewInfoWindow'); 
		$(".clsAddNewInfoWindow").next("div").hide(); 
} 
 /**
     * Using the drawing tools, when a polygon is drawn an event is raised. 
     * This function catches that event and hides the drawing tool. It also
     * makes the polygon non-draggable and non-editable. It adds custom 
     * properties to the polygon and generates a listener to listen to click
     * events on the created polygon
*/ 
function setStyle( domElem, styleObj ){ 
   if( typeof styleObj == "object" ){
       for( var prop in styleObj ){
           domElem.style[ prop ] = styleObj[ prop ];
       }
   }
}

/*   Removed */
	function GetContent( overlay ){
        var content =
            '<div><h3>'+overlay.title+'</h3>'+overlay.content+'<br></div>'
                + GetInfoWindowFooter( overlay );
        return content;
    } 
	 function GetInfoWindowFooter( overlay ){
        var content =
            '<div id="'+mapContainerId+'_dirContainer" style="bottom:0;padding-top:3px; font-size:13px;font-family:arial">'
                + '<div  style="border-top:1px dotted #999;">'
                + '<style>.BlitzMap_Menu:hover{text-decoration:underline; }</style>'
                + '<span class="BlitzMap_Menu" style="color:#ff0000; cursor:pointer;padding:0 5px;" onclick="BlitzMap.getDirections()">Directions</span>'
                + '<span class="BlitzMap_Menu" style="color:#ff0000; cursor:pointer;padding:0 5px;">Search nearby</span>'
                + '<span class="BlitzMap_Menu" style="color:#ff0000; cursor:pointer;padding:0 5px;">Save to map</span>'
                + '</div></div>';
        return content;
    } 
	
	
	
/*** Using the location search textbox, can quickly find the location. */
function locationSearchTool() {
		// Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input); 
        var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo('bounds', map);
		var infowindow = new google.maps.InfoWindow();
		var marker = new google.maps.Marker({
			map: map,
			anchorPoint: new google.maps.Point(0, -29)
		});
		google.maps.event.addListener(autocomplete, 'place_changed', function() { 
			infowindow.close();
			marker.setVisible(false);
			var place = autocomplete.getPlace();
			if (!place.geometry) {
				return;
			}
			// If the place has a geometry, then present it on a map.
			if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
				//locLatLng = place.geometry.viewport.lat()+','+place.geometry.viewport.lng();
			} else {
				map.setCenter(place.geometry.location);
				map.setZoom(17);  // Why 17? Because it looks good.
			} 
			locLatLng = place.geometry.location.lat()+','+place.geometry.location.lng();
			currentLocLatLng=locLatLng;
			marker.setIcon(/** @type {google.maps.Icon} */({
				url: place.icon,
				size: new google.maps.Size(71, 71),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(17, 34),
				scaledSize: new google.maps.Size(35, 35)
			}));
			marker.setPosition(place.geometry.location);
			marker.setVisible(true);
			var address = '';
			if (place.address_components) {
				address = [
					(place.address_components[0] && place.address_components[0].short_name || ''),
					(place.address_components[1] && place.address_components[1].short_name || ''),
					(place.address_components[2] && place.address_components[2].short_name || '')
				].join(' ');
			}
			infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
		infowindow.open(map, marker);
		//To check location available in our database
		checkLocationAvail(place.name);
		newPondLocationName=place.name; 
		//document.getElementById("location_name").value=place.name; 
	});
}
//To check location available in our database
function checkLocationAvail(loc) {		
		var xmlhttp;
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 ) {
				if(xmlhttp.status == 200){
					//console.log(xmlhttp.responseText);
					var result_loc = JSON.parse(xmlhttp.responseText);
					if(result_loc['responseCode'] == 'Ok'){
						var locVal = result_loc['responseData'];
						//document.getElementById("location_id").value = xmlhttp.responseText;
						//document.getElementById("location_id").value = locVal;
						newPondLocationId=locVal; 
					} else{
						alert(result_loc['responseMessage']);
					}				   
				}
				else if(xmlhttp.status == 400) {
					alert(js_strings.Comn_there_was_400error)
				}
				else {
					alert(js_strings.Map_other_than_200_returned_msg)
				}
			}
		}

		xmlhttp.open('POST', 'actions/mapsActions/chk_loc');
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlhttp.send('loc='+loc);
	}	