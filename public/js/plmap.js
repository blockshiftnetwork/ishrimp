var screenHeight=700, defaultMaxZoomLevel=16, slider_from=0,slider_to=50, defaultLoad=0,IWShowHide=1,minLastest=0,maxLastest=5,hittedLocNames=0, defaultLocLat='16.5083',defaultLocLng='80.6417';
var varMarginLeft='177px', varPaddingLeft='170px', varColorBoard='185px';
var holdJSONPondsObject=[],holdJSONObjByLoc=[], myLocationsArray = [],locCenterPositions=[],globalPolygons=[], jsonLocations=[];
var holdJSONObject, holdSinglePondJSONObject, holdJSONFeedersObject;
var map, ownerid, selectedPondLocId, selectedPondId,  myDrawingManager, drawingModeEnabled=0; editModeEnabled=0;  
var maxABW=0,minABW=0,maxAWG=0,minAWG=0,maxDO=0,minDO=0,maxTemp=0,minTemp=0,maxPH=0,minPH=0,maxFEED=0,minFEED=0;
var objAlert_Schedules, objAlert_Communication,objAlert_Nofeed;  
var mapSearchslider, feedersList,schCommonList,schIndividualList; 
var msgNoSchFound='';
var globalStrokeColor="#cccccc",globalFillColor="#cccccc",globalHoverStrokeColor="#314230",globalHoverFillColor="#00FF00",globalDisableFillColor="#f1f1f1",hoverStrokeOpacity=0.5; 
//var StrokeColor = ["#000000","#066","#234567","#f1f1f1","#e1e1e1"];
var FillColor = ['#FFA500', '#FF99E6','#CCFF1A','#FF1A66','#E6331A','#33FFCC','#66994D','#B366CC','#3366E6', '#4D8000','#B33300','#CC80CC','#66664D','#991AFF','#E666FF','#4DB3FF','#1AB399','#E666B3','#33991A','#CC9999','#B3B31A','#00E680','#4D8066','#809980','#E6FF80','#1AFF33','#999933','#FF3380','#CCCC00','#66E64D','#4D80CC', '#9900B3','#E64D66','#4DB380','#FF4D4D','#99E6E6','#6666FF'	
		];	
var menuMapping = ['dashboard', 'mapview', 'ponds', 'feeding', 'pmschedules_ponds', 'pmschedules_group', 'ct', 'medNminerals', 'abw', 'labTest', 'yield', 'feedStock', 'medNmineralStock', 'gateway', 'reports', 'resources', 'settings'];

/* Common Funcitons  */ 
$(function () { 
    mapSearchslider=$("#txtMapSearchRange"); 
	mapSearchslider.ionRangeSlider({
      min: minLastest,  max: maxLastest, from: minLastest, to:maxLastest, type: 'double', prettify: true, hasGrid: true,
	  onChange:function(data){
			  slider_from=data.from;
			  slider_to=data.to;  
			  var active_tab = $("#navSearchOptions li a.active").attr('id'); 
			  var singleLocationPolygon = jQuery.grep(globalPolygons, function( elem ) {
					 return elem.locid === selectedPondLocId;
			  });  
			  display_search_options(active_tab,slider_from,slider_to,1,singleLocationPolygon,'onchange'); 
		} 
    }); 
});
// info window
var infoBubbleWindow = new InfoBubble({
	minWidth: 190,
	maxWidth:'auto',
	minHeight:130,
	maxHeight:'auto',
	arrowSize: 12,
	borderRadius:5,
	backgroundColor:'rgba(255,255,255,1)',
	padding:0,
	hideCloseButton:true,
	disableAutoPan:true
}); 
function setPolygonDefaultSetOptions()
{ 
	globalPolygons.forEach(function(varpoly) {  				
		varpoly.setOptions({visible:true, strokeOpacity:0.5, fillOpacity:0.3});  
	});	 
}
  
$( document ).ready(function() { 
	$(".main-sidebar").css("width",'170px');
	screenHeight=screen.height;
	screenHeight=screenHeight*71.65/100;
	ownerid=$('#hdOwnerid').val();  
	// disable UTC 
	Highcharts.setOptions({
	 chart:{
		style:{
			fontFamily:'Arial'
		}
			
	 },
	  global: {
		useUTC: false
	  }
	}); 
	bindUserLocations(); // load user locations
	
	 
	// sidebar toggle 
	$(document).on("click", ".sidebar-toggle", function(e) {  
		  toggleLeftSideMenu('2'); // left side menu hide		 
	}); 
	// alert icon click event
	$(document).on("click", "#modalPondAlerts", function(e) {  
		displayAlerts(selectedPondId,selectedPondLocId,0); 
	});  
	// location change
	$(document).on("change", "input[name='ddlLocations']:radio", function(e) {	
		 // create new pond disabled
		 $('.gm-style-iw').removeClass('clsAddNewInfoWindow'); infoWindowAddNewPond.close(); $('.clsMapAddPond').show(); editModeEnabled=0;
		 createAddPondBtn(); 
		 if(drawingModeEnabled==1) deleteOverlay();  
		 var singleLocationPolygon = jQuery.grep(globalPolygons, function( elem ) { return elem.locid === selectedPondLocId; }); 
		 singleLocationPolygon.forEach(function(e) {  e.setEditable(false); });  
		 editModeEnabled=0;  
		 var locationValues=this.value; IWShowHide=1;
		 arrayLoc=locationValues.split('|');  
		 selectedPondLocId=arrayLoc[2]; 
		 
		 currentLocLatLng=arrayLoc[0]+','+arrayLoc[1];				
		 newPondLocationId=arrayLoc[2]; 
		 newPondLocationName=$(this).attr('id');  
				
		 LS_LocationId(selectedPondLocId);
		 chng_menu_href();
		 setPolygonDefaultSetOptions();  
		 newLocation(parseFloat(arrayLoc[0]),parseFloat(arrayLoc[1]), arrayLoc[2]);   
		 funLoadSingleLocInfoWinData(selectedPondLocId,0,0);	
	 }); 
	 // search filters 
	 $(document).on("click", ".mapSrchTab", function(e) { 
		if(editModeEnabled==0 && drawingModeEnabled==0){
			setPolygonDefaultSetOptions(); 
			slider_to=50;slider_from=0; IWShowHide=1;var sliderCheck=0; 
			minLastest=0;maxLastest=4; 
			var active_tab = this.id;  
			if(active_tab=="srchabw"){ minLastest=0; maxLastest=maxABW;step=1; }
			else if(active_tab=="srchawg"){ minLastest=minAWG; maxLastest=maxAWG; step=5; }
			else if(active_tab=="srchdo"){ minLastest=minDO; maxLastest=maxDO; step=1; }
			else if(active_tab=="srchph"){ minLastest=minPH; maxLastest=maxPH; step=1; }
			else if(active_tab=="srchtemp"){ minLastest=minTemp; maxLastest=maxTemp;step=1; }
			else if(active_tab=="srchfeed"){ minLastest=0; maxLastest=maxFEED;step=25; }
			else if(active_tab=="srchalerts"){ minLastest=0; maxLastest=10;step=1; }  
			if(maxLastest<=0) maxLastest=10;
			var sliderNew = $("#txtMapSearchRange").data("ionRangeSlider");  
			sliderNew.update({
				min: minLastest, max: maxLastest,from:minLastest,to:maxLastest,
			}); 		
			if(!$('.mapSrchTab').hasClass('active'))
			{ 
				sliderCheck=1;
				$('#'+this.id).addClass('active');
				$("#settingscroller").toggle('slow'); 
			}
			else
			{
				if($('#'+this.id).hasClass('active'))
				{
					sliderCheck=0;
					$('#'+this.id).removeClass('active');
					$("#settingscroller").toggle('slow');
				}
				else{
					$('.mapSrchTab').removeClass('active');
					$('#'+this.id).addClass('active');
					sliderCheck=1;				
				}  
			} 
			var singleLocationPolygon = jQuery.grep(globalPolygons, function( elem ) {
				return elem.locid === selectedPondLocId;
			}); 
			slider_to=maxLastest;slider_from=minLastest;
			display_search_options(this.id,slider_from,slider_to,sliderCheck,singleLocationPolygon,'onclick');	
		}
		else{
			alert(js_strings.Map_disable_drawing_mode +" !!!");
		}	
	 }); 
	  // Close modal popup
	$(document).on("click", ".closeModal", function(e) {
		  $('#mapPondDetailedView').hide();
		  toggleLeftSideMenu('1'); // left side menu hide		
	 }); 
	 // view single pond graphs 
	 $(document).on("click", "#aPonds", function(e) { 
		IWShowHide=1;$('#tabSchedules').hide();$('#tabPond').show();$('#tabAlerts').hide();
		$('.gm-style-iw').removeClass('clsAddNewInfoWindow'); 
		createAddPondBtn();
		ShowDrawingTools(false); 
		$(".clsMapAddPond").css("margin-left","7px");  
		toggleLeftSideMenu('3'); // left side menu hide	 
		$('.lblPondMap div span').hide(); 
		$('#tabPond').addClass('active in');  
		$('#tabSchedules').removeClass('active in');
		$('#tabAlerts').removeClass('active in');
		$('#aAlerts').parents('li').removeClass('active'); 
		$('#aSchedules').parents('li').removeClass('active'); 
		$('#aPonds').parents('li').addClass('active');   
		funcLoadSinglePondGraphs(selectedPondLocId,selectedPondId);
	 });  
	 // view single pond schedules	 
	$(document).on("click", "#aSchedules", function(e) { 
		 IWShowHide=1;$('#tabPond').hide();$('#tabSchedules').show();$('#tabAlerts').hide();
		 loadFeedersSchedules(selectedPondId);
	 });  
	 // view single pond alerts	 
	$(document).on("click", "#aAlerts", function(e) {
		displayAlerts(selectedPondId,selectedPondLocId,0); 
	 }); 
	 
	 // alert dropdown
	 $('.dropdown-menu').on('click', function(e) {
		  if($(this).hasClass('dropdown-menu-form')) {
			  e.stopPropagation();
		  }
	 }); 
	 // display alerts
	 $('#pondTabAlerts li a').on('click', function(e) {
			$('#pondTabAlerts li').removeClass('active'); IWShowHide=1;
			jQuery(this).parents('li').addClass('active');  
	 }); 
	 // create feeder tabls schedules
	 $(document).on("click", ".clsFeederTab", function(e) {  
			$('.clsFeederTab').removeClass('active');
			$(this).addClass('active');
			tabContentArray = this.id.split("-");  
			IWShowHide=1;
			pondid=tabContentArray[0];
			deviceId=tabContentArray[1]; 
			if(deviceId==0)
				displaySingleFeederSchedules(pondid,deviceId,schCommonList); 
			else
				displaySingleFeederSchedules(pondid,deviceId,schIndividualList); 
	 });  
});
function displayAlerts(clickedPondId,clickedLocId,aDisplayType)
{  
	toggleLeftSideMenu('3'); 
	IWShowHide=1;$('#tabPond').hide();$('#tabSchedules').hide();$('#tabAlerts').show();
	selectedPondId=clickedPondId;  
	selectedPondLocId=clickedLocId; 	
	ShowDrawingTools(false); 
	$('.lblPondMap div span').hide();  
	$('#mapPondDetailedView').show();
	loadAlerts(clickedPondId);
	if(aDisplayType==1){  
		$('.gm-style-iw').removeClass('clsAddNewInfoWindow'); 
		createAddPondBtn();
		ShowDrawingTools(false); 
		var filteredPondAlert = jQuery.grep(holdJSONPondsObject, function( alertElem ) {
			return alertElem.pondid === clickedPondId;
		});   
		if(filteredPondAlert.length>0){ 
			grpFrom=filteredPondAlert[0].doc;
			grpTo=filteredPondAlert[0].hoc; 
			var alertsCount=0;
			alertsCount=filteredPondAlert[0].alerts_count 
			$('#pondAlertCount').html(alertsCount);  
			$('#rtPopSchNavTab').html('');
			$('#rtPopSchNavTab').addClass('no-border'); 
			$('#tbl_pond_schedules').hide();  
			$('#modalPondName').html(filteredPondAlert[0].pondname+" <small class='label bg-blue'>"+filteredPondAlert[0].docDays+"</small>"); 
			
			var pondSpi=filteredPondAlert[0].pondsize;
			pondSpiArray=pondSpi.split(' ');
			$('#dvPopupArea').html(pondSpiArray[0]+' <span>'+pondSpiArray[1]+'</span>');  
			var tempABW='<strong>'+js_strings.ABW_abw+':</strong> NA',tempWG='<strong>'+js_strings.Comn_awg+':</strong> NA', tempph='NA',tempdo='NA', tempTemp='NA'
			if(filteredPondAlert[0].abw!='NA')   tempABW='<strong>'+js_strings.ABW_abw+':</strong> '+filteredPondAlert[0].abw+' <span>g</span>';
			if(filteredPondAlert[0].wg!='NA')   tempWG='<strong>'+js_strings.Comn_awg+':</strong> '+filteredPondAlert[0].wg+' <span>g</span>'; 
			if(filteredPondAlert[0].ph!='NA')   tempph=filteredPondAlert[0].ph+' <span>'+js_strings.Comn_ph+'</span>';
			if(filteredPondAlert[0].do!='NA')   tempdo=filteredPondAlert[0].do+' <span>mg/L</span>';
			if(filteredPondAlert[0].temp!='NA')   tempTemp=filteredPondAlert[0].temp+' <span><sub style="top: -.5em;">o</sub>C</span>';
			
			$('#dvPopupABW').html(tempABW);
			$('#dvPopupAWG').html(tempWG);			
			$('#dvPopupPH').html(tempph);
			$('#dvPopupDO').html(tempdo);
			$('#dvPopupTemp').html(tempTemp);  	
		} 	
	}  
	if(event.stopPropagation) event.stopPropagation();	
}
	
function toggleLeftSideMenu(displayType)
{  	 
	if(displayType==1)	
	{
		$(".main-sidebar").css("width",'170px');
		$(".main-sidebar").addClass('open');
		varMarginLeft='177px'; varPaddingLeft='170px';varColorBoard='185px';  
		$(".main-sidebar").show(); 
	}
	else if(displayType==2)	
	{ 
		if ($('.main-sidebar').hasClass( "open" )) {
			varMarginLeft='7px'; varPaddingLeft='0px';varColorBoard='10px'; 
			$(".main-sidebar").removeClass('open');
			$(".main-sidebar").css("width",'0px');
		}
		else{
			$(".main-sidebar").addClass('open'); 
			varMarginLeft='177px'; varPaddingLeft='170px'; varColorBoard='185px'; 
			$(".main-sidebar").css("width",'170px');			
		}
		$(".main-sidebar").toggle();
	}
	else if(displayType==3)	
	{
		$(".main-sidebar").hide(); 
		varMarginLeft='7px'; varPaddingLeft='0px';varColorBoard='10px';  
		$(".main-sidebar").removeClass('open'); 
	}
	else{
		// if ($('.main-sidebar').hasClass( "open" )) {
			// $("#plMapOptions").css("padding-left","0px"); 
			// $(".main-sidebar").removeClass('open');
		// }
		// else{
			// $(".main-sidebar").addClass('open');
			// $("#plMapOptions").css("padding-left","170px"); 
		// } 
		if($('#mapPondDetailedView').css('display') == 'block')
		{
			$(".main-sidebar").hide();  
			varMarginLeft='7px'; varPaddingLeft='0px';	varColorBoard='10px';  		
			$(".main-sidebar").removeClass('open'); 
		}
		else{
			$(".main-sidebar").show(); 
			$(".main-sidebar").addClass('open');
			varMarginLeft='177px'; varPaddingLeft='170px';   varColorBoard='185px';  
		}	
	} 
	$("#plMapOptions").css("left",varPaddingLeft); 
	$(".clsMapAddPond").css("margin-left",varMarginLeft); 
	$("#colors_board").css("margin-left",varColorBoard); 
}

function chng_menu_href()
{ 
	if (typeof selectedPondLocId == 'undefined'){
		selectedPondLocId=0;
	} 
	if(menuMapping.length>0){
		for (var iMenu = 0; iMenu < menuMapping.length; iMenu++) { 
			var newhref= baseUrl+''+menuMapping[iMenu]+'?loc='+selectedPondLocId; 			
			if(iMenu == 0){ 
				$('.mainLogo').attr("href", newhref); 
			} 
			else if(menuMapping[iMenu]== 'mapview'){ 
				newhref= baseUrl+''+menuMapping[iMenu]; 
			} 
			else if(menuMapping[iMenu]== 'settings'){ 
				$('.clsSettings').attr("href", newhref); 
			}  
			$('#a_'+menuMapping[iMenu]).attr("href", newhref); 
		} 
	} 
}

function bindUserLocations() {     
	// get each location center position  	 
	var defaultLat,defaultLng;
	var  json_data = $.getJSON('mapview/getUserLocations',{ownerid:ownerid});  
	json_data.then(function(result) { 
		pondlogs.initialize();   	
		if(result['responseCode']== 'Ok'){ 
			jsonLocations=result['locations'];   
			var htmlLocationsDDL="";  
			if(jsonLocations.length>0){ 
				var processedLocId;  
				if (typeof(Storage) === "undefined") { 
					processedLocId=jsonLocations[0].locid; 
				}
				else{   
					if (localStorage.getItem("locid") !== null) {
						// check having location id or not
						var filteredLSLocation = jQuery.grep(jsonLocations, function( elem ) {
							return elem.locid === localStorage.locid;
						}); 
						if(filteredLSLocation.length>0) {
								processedLocId= localStorage.locid;
						}
						else{
							processedLocId=jsonLocations[0].locid; 
							LS_LocationId(processedLocId);
						}
					}  
					else{
						processedLocId=jsonLocations[0].locid; 
						LS_LocationId(processedLocId);
					}
				}
				for (var iLoc = 0; iLoc < jsonLocations.length; iLoc++) {    
					// center posision 			
					myLocationsArray.push(jsonLocations[iLoc].locid);					
					var valu= jsonLocations[iLoc].lat+"|"+jsonLocations[iLoc].lng+"|"+jsonLocations[iLoc].locid;
					var selected=""; 
					if(jsonLocations[iLoc].locid==processedLocId)
					{ 
						defaultLat=jsonLocations[iLoc].lat;
						defaultLng=jsonLocations[iLoc].lng;
						currentLocLatLng=jsonLocations[iLoc].lat+','+jsonLocations[iLoc].lng;				
						newPondLocationId=jsonLocations[iLoc].locid; 
						newPondLocationName=jsonLocations[iLoc].locname;   
						selected="active"; selectedPondLocId=jsonLocations[iLoc].locid; chng_menu_href();  
						funLoadSingleLocInfoWinData(selectedPondLocId,0,0); // load single location data
						jsonLocations[iLoc].type=1; // catched data
						mapLocationNames(99,0); 
						LS_LocationId(selectedPondLocId);
					} 
					htmlLocationsDDL+="<label for='"+jsonLocations[iLoc].locname+"' class='btn btn-default clsCommonLoc btn-sm "+selected+"'><input type='radio' name='ddlLocations' id='"+jsonLocations[iLoc].locname+"' value='"+valu+"'>"+jsonLocations[iLoc].locname+"</label>";
					defaultLoad=1; 
				}   
				$('#rbtnLocations').html(htmlLocationsDDL);   
			}
			else{
				navigator.geolocation.getCurrentPosition(function(position, html5Error) { 
					 geo_loc = processGeolocationResult(position);
					 currLatLong = geo_loc.split(","); 
					 defaultLat=currLatLong[0];
					 defaultLng=currLatLong[1];  
				}); 
			} 
			map = new google.maps.Map(document.getElementById("googleMap"), {
				center: new google.maps.LatLng(defaultLat,defaultLng),
				  zoom: defaultMaxZoomLevel,
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
			// Add pond button create
			var centerControlDiv = document.createElement('div');
			var centerControl = new addPondCreationButton(centerControlDiv, map); 
			centerControlDiv.index = 1; 
			centerControlDiv.setAttribute("class","clsMapAddPond"); 
			map.controls[google.maps.ControlPosition.LEFT_TOP].push(centerControlDiv);
			
			// create a dialogue box but don't bind it to anything yet
			// location search textbox
			locationSearchTool();
				
			// show drawing tools
			DrawingTools(map);	
			
			map.addListener('zoom_changed', function() {
				if(editModeEnabled==0 && drawingModeEnabled==0){
					setPolygonDefaultSetOptions();
					currentZoomLevel=map.getZoom();  
					change_location_zoom('zoom'); // change locations function
				}
			});	
			map.addListener('click', function() {		
				infoBubbleWindow.close();
				$('#mapPondDetailedView').hide();
				toggleLeftSideMenu('1'); // left side menu hide	
			});	
			// info window click event
			google.maps.event.addDomListener(infoBubbleWindow.bubble_, 'click', function(e) { 
				if(editModeEnabled==0  && drawingModeEnabled==0){ 
					$('.gm-style-iw').removeClass('clsAddNewInfoWindow'); 
					createAddPondBtn();
					ShowDrawingTools(false); 
					$(".clsMapAddPond").css("margin-left","7px");  
					toggleLeftSideMenu('3'); // left side menu hide	
					$('.lblPondMap div span').hide(); 
					$('#tabPond').addClass('active in');  
					$('#tabSchedules').removeClass('active in');
					$('#tabAlerts').removeClass('active in');
					$('#aAlerts').parents('li').removeClass('active'); 
					$('#aSchedules').parents('li').removeClass('active'); 
					$('#aPonds').parents('li').addClass('active');  
					var pondid = $('.wg-pond').attr('id'); 
					change_location_zoom('pondclick');  
					mapLocationNames(88,0); 
					if ( $('#pond_'+pondid ).hasClass("clsInactive") ) {
						$('#mapPondDetailedView').hide();
						var settings_link = '<a class="pond_link" href="settings?loc='+selectedPondLocId+'></a>';
						alert(js_strings.PM_culture_not_started_msg+'!!!');
					}
					else{
						funcLoadSinglePondGraphs(selectedPondLocId,pondid); 
					}  
				}				 
			}); 	
			pondlogs.initialize();
			// marker
			for (var iLoc = 0; iLoc < jsonLocations.length; iLoc++) {   					 
				var LocationNameMarker=new google.maps.Marker({
					position: new google.maps.LatLng(parseFloat(jsonLocations[iLoc].lat),parseFloat(jsonLocations[iLoc].lng)), 
					icon: baseUrl+'/v1/map_assets/img/icons/dot.jpg', 
					map:map,
					label:{
						text:jsonLocations[iLoc].locname,
						color:'#FFF',
						fontSize:'18px' 
					}
				}); 
				locCenterPositions.push(LocationNameMarker); 				
			}  
		}  
	}); 
} 

function LS_LocationId(locid)
{
	if (typeof(Storage) !== "undefined") {
		localStorage.locid=locid;
	} else {
		console.log(js_strings.PM_no_web_storage_supp+'..');
	}
}
  

var pondlogs = {
    // Utility function to make a polygon with some standard properties set
    makePolygon: function(paths, color,locid,locname,pondid,pondstatus) { 
        return (new google.maps.Polygon({ 
			paths: paths,
            strokeColor: '#fff',
            strokeOpacity: 0.5,
            strokeWeight: 3,
            fillColor: 'gainsboro',
            fillOpacity: 0.3,
			locid:locid,
			locname:locname,
			pondid:pondid,
			pondstatus:pondstatus			
        }));
    }, 
    // initialize google map
    initialize: function() {
		// Global Variables Declaration
        var clusMaxZoom=14,clusGridSize=500; minimumClusterSize=5; 	
		// -------- Common Functions -------- //			
		// Add useful missing method 
		google.maps.Polygon.prototype.getBoundingBox = function() { 
			var bounds = new google.maps.LatLngBounds();
			this.getPath().forEach(function(element,index) {
				bounds.extend(element)
			});
			//map.fitBounds(bounds);  // Identified Zoom level without overlap
			return(bounds);
		};
        // Add center position calculation method
        google.maps.Polygon.prototype.getApproximateCenter = function(centerPolygonCords) { 
			var pondCenterlatLng = new google.maps.LatLng(centerPolygonCords);  
			// Within Function variable declaration
            var boundsHeight = 0,boundsWidth = 0,centerPoint,heightIncr = 0,maxSearchLoops,maxSearchSteps = 10,n = 1,northWest,polygonBounds = this.getBoundingBox(),testPos,widthIncr = 0;
            // Get polygon Centroid
            centerPoint = polygonBounds.getCenter(); 
            if (google.maps.geometry.poly.containsLocation(centerPoint, this)) {  		
                return centerPoint; // Nothing to do Centroid is in polygon use it as is
            } else { 
                maxSearchLoops = maxSearchSteps / 2;                
                // Calculate NorthWest point so we can work out height of polygon NW->SE
                northWest = new google.maps.LatLng(polygonBounds.getNorthEast().lat(), polygonBounds.getSouthWest().lng());
                // Work out how tall and wide the bounds are and what our search increment will be
                boundsHeight = google.maps.geometry.spherical.computeDistanceBetween(northWest, polygonBounds.getSouthWest());
                heightIncr = boundsHeight / maxSearchSteps;
                boundsWidth = google.maps.geometry.spherical.computeDistanceBetween(northWest, polygonBounds.getNorthEast());
                widthIncr = boundsWidth / maxSearchSteps; 
                // Expand out from Centroid and find a point within polygon at 0, 90, 180, 270 degrees
                for (; n <= maxSearchLoops; n++) {
                    // Test point North of Centroid
                    testPos = google.maps.geometry.spherical.computeOffset(centerPoint, (heightIncr * n), 0);
                    if (google.maps.geometry.poly.containsLocation(testPos, this)) { 
                        break;
                    }
                    // Test point East of Centroid
                    testPos = google.maps.geometry.spherical.computeOffset(centerPoint, (widthIncr * n), 90);
                    if (google.maps.geometry.poly.containsLocation(testPos, this)) { 
                        break;
                    }
                    // Test point South of Centroid
                    testPos = google.maps.geometry.spherical.computeOffset(centerPoint, (heightIncr * n), 180);
                    if (google.maps.geometry.poly.containsLocation(testPos, this)) { 
                        break;
                    }
                    // Test point West of Centroid
                    testPos = google.maps.geometry.spherical.computeOffset(centerPoint, (widthIncr * n), 270);
                    if (google.maps.geometry.poly.containsLocation(testPos, this)) { 
                        break;
                    }
                }  
				return(testPos);				
               // return(pondCenterlatLng);
            }
        };  
		// -------- End of Common Functions -------- //		 
			
		// Looping through the JSON data 
		var globalCenterCoordinates=[];
		// loop - user locations  
		if(jsonLocations.length>0){
			for (var iUserLocations = 0; iUserLocations < jsonLocations.length; iUserLocations++) { 
				var locations = [],polygons = [];
				var varLocationId=jsonLocations[iUserLocations].locid; 
				var varLocationName=jsonLocations[iUserLocations].locname; 			
				// change center position pond to location
				//new google.maps.LatLng(parseFloat(jsonLocations[iLoc].lat),parseFloat(jsonLocations[iLoc].lng)) 
				// load current location ponds to avoid unnecessary loops
				var filteredPonds = jsonLocations[iUserLocations].ponds;  		
				// loop - location oriented ponds 
				for (var iPonds = 0; iPonds < filteredPonds.length; iPonds++) {
					// Varialbe declaration
					var marker, centerPoint, rowCenterAll={}, polyFillColor="";
					var singleObject = filteredPonds[iPonds];    			
					//var objCoordinates=JSON.parse(singleObject.coordinates);
					var objCoordinates=singleObject.coordinates;  
					// convert string coordinates to number
					for (var index = 0; index < objCoordinates.length; index++) { 
						objCoordinates[index]['lat']=parseFloat(objCoordinates[index].lat);
						objCoordinates[index]['lng']=parseFloat(objCoordinates[index].lng);  
					}   
					
					if(selectedPondLocId==varLocationId)
						polyFillColor=FillColor[myLocationsArray.indexOf(varLocationId)];
					else
						polyFillColor=globalFillColor; 
					
					polygons.push(this.makePolygon(objCoordinates,polyFillColor,varLocationId,varLocationName,singleObject.pondid,singleObject.pondStatus));   
					var centerPolygonCords=polygonCenter(objCoordinates);   
					polygons.forEach(function(poly) {
						poly.setMap(map);
						centerPoint=poly.getApproximateCenter(centerPolygonCords); 
						marker = new google.maps.Marker({
							position: centerPoint,
							map: map,
							title: singleObject.pondname
						});
						marker.setVisible(false); 	
					}); 
				
					
					var js_centerPoint=JSON.stringify(centerPoint);
					var jp_centerPoint=JSON.parse(js_centerPoint);  
					// pond center position
					var rowLocations={};  
					rowLocations['lat']=parseFloat(jp_centerPoint.lat);
					rowLocations['lng']=parseFloat(jp_centerPoint.lng);
					locations.push(rowLocations); 
					// remove below obj
					rowCenterAll['lat']=parseFloat(jp_centerPoint.lat);
					rowCenterAll['lng']=parseFloat(jp_centerPoint.lng);
					globalCenterCoordinates.push(rowCenterAll); 			
					// load map this position
					var finalPolygonCords = new Object();
					finalPolygonCords.lat = parseFloat(jp_centerPoint.lat);
					finalPolygonCords.lng = parseFloat(jp_centerPoint.lng);   
					latLng = new google.maps.LatLng(finalPolygonCords); 
					// set label
					var pondname=singleObject.pondname; 
					if(pondname.length>8)
					{
						 pondname='<marquee scrolldelay="350">'+pondname + '</marquee>';
					}
					 
					var varTitle=pondname+"<br/><span></span>";
					var label = new Label({  map: map, title:varTitle, pondid:singleObject.pondid, locid:varLocationId, pondstatus:singleObject.pondStatus });
						label.bindTo('position', marker, 'position');
						label.bindTo('text', marker, 'position'); 
						
						
					(function(marker, singleObject) { 
						marker.setVisible(false); // marker disable   
			  
						var varInfoWindow= '';  
						// Attaching a click event to the current marker
						google.maps.event.addListener(polygons[iPonds], "click", function(e) {
							if(editModeEnabled==0 && drawingModeEnabled==0){
								// create new pond disabled
								$('.gm-style-iw').removeClass('clsAddNewInfoWindow'); 
								createAddPondBtn();
								ShowDrawingTools(false); 
								$(".clsMapAddPond").css("margin-left","7px");  
								toggleLeftSideMenu('3'); // left side menu hide	
								selectedPondLocId=this.locid;
								selectedPondId=this.pondid; 
								$('.lblPondMap div span').hide(); 
								$('#tabPond').addClass('active in');  
								$('#tabSchedules').removeClass('active in');
								$('#tabAlerts').removeClass('active in');
								$('#aAlerts').parents('li').removeClass('active'); 
								$('#aSchedules').parents('li').removeClass('active'); 
								$('#aPonds').parents('li').addClass('active');  
								if(currentZoomLevel<defaultMaxZoomLevel)
								{ 
									map.panTo(e.latLng);
								}
								change_location_zoom('pondclick');  
								mapLocationNames(88,0);
								if(this.pondstatus=="Active"){
									funcLoadSinglePondGraphs(this.locid,this.pondid);
								}
								else{
									$('#mapPondDetailedView').hide();
									var settings_link = '<a class="pond_link" href="settings?loc='+this.locid+'>'+js_strings.Comn_click_here+'</a>';
									alert(js_strings.PM_culture_not_started_msg+'!!!');
								}
							}	
							else{ 

								 AttachClickEditListener(this.pondid);
							}	
						}); 
						google.maps.event.addListener(polygons[iPonds], "mouseover", function(e) { 
							if(editModeEnabled==0 && drawingModeEnabled==0){					
								currentZoomLevel=map.getZoom();   
								hoverStrokeOpacity=this.strokeOpacity; 
								if(currentZoomLevel>14)
								{  
									 if(this.locid==selectedPondLocId){
										this.setOptions({strokeOpacity:1});
										//infoBubbleWindow.setContent(varInfoWindow);  
										infoBubbleWindow.setContent(externalBindInfoWindow(this.locid,this.pondid)); 
										if (IWShowHide == 0)	 								
											infoBubbleWindow.close();
										else
											infoBubbleWindow.open(map, marker); 								
									  }  
									  else{  
										  infoBubbleWindow.close();   
									  }   
								}  
							}
						}); 
					 
						google.maps.event.addListener(polygons[iPonds], "mouseout", function(e) {	
							/* if(editModeEnabled==0 && drawingModeEnabled==0){					
								 if(hoverStrokeOpacity=='0.3')					
									this.setOptions({strokeOpacity:0.5, fillOpacity:0.1});
								else
									this.setOptions({strokeOpacity:hoverStrokeOpacity, fillOpacity:0.1}); 
							} */
							infoBubbleWindow.close(); 
						}); 
						 
						
					})(marker, singleObject);  
				} // end loop - location oriented ponds   
				$.merge(globalPolygons,polygons); // merge individual polygons  
			}// end loop - user locations  
		} 
		else{ 
			chng_menu_href();
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			}
			else {
				defaultLocLat='16.5083';
				defaultLocLng='80.6417';  
			}  
			map = new google.maps.Map(document.getElementById("googleMap"), {
				center: new google.maps.LatLng(defaultLocLat,defaultLocLng) , 
				  zoom: 11,
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
			// Add pond button create
			var centerControlDiv = document.createElement('div');
			var centerControl = new addPondCreationButton(centerControlDiv, map); 
			centerControlDiv.index = 1; 
			centerControlDiv.setAttribute("class","clsMapAddPond"); 
			map.controls[google.maps.ControlPosition.LEFT_TOP].push(centerControlDiv); 
			// create a dialogue box but don't bind it to anything yet
			// location search textbox
			$('#txtGoogleLocationSearch').show(); 
			$('#navSearchOptions').show();
			locationSearchTool(); 
			// show drawing tools
			DrawingTools(map); 
		}
    }
}	
function showPosition(position) {
	defaultLocLat=position.coords.latitude;
	defaultLocLng=position.coords.longitude; 
}
function externalBindInfoWindow(locid,pondid)
{  
	var varInfoWindow='<div id="IWEmpty'+pondid+'"></div>';
	if(holdJSONPondsObject.length==0){
		IWShowHide=0;
		 varInfoWindow='<div class="wg-pond" id="'+pondid+'"><div class="IW-empty">'+js_strings.Comn_loading+' ...</div></div>'; 
	}
	else{  
		var singlePondObject = jQuery.grep(holdJSONPondsObject, function( elem ) {
			return elem.pondid === pondid;
		});  	 		
		if(singlePondObject.length==0)
		{
			IWShowHide=0;
			varInfoWindow='<div class="wg-pond" id="'+pondid+'"><div class="IW-empty">'+js_strings.Comn_loading+' ...</div></div>'; 
		}
		else{ 
			IWShowHide=1;
			//----------- Alerts Monitoring -----------//
			var alertsCount=singlePondObject[0].alerts_count;
			var alerts_icon=''; 
			if(alertsCount==0) alerts_icon='hide';
			
			var alertsBGColor=' bg-red'; var alert_tooltip=''; 
			// 4 weeks wg  
			var objABW=JSON.parse(singlePondObject[0].abwJSON);
			var varsWG = ['NA','NA','NA','NA','NA']; 
			var varsWGChk = ['text-green','text-green','text-green','text-green','text-green']; 
			if(objABW.length>0)
			{ 
				var first_abw = 0;
				var row_count=0;
				for (var indexWG= 0; indexWG < objABW.length; indexWG++) { 
					row_count++; 
					var previous_day_abw = (objABW.length==row_count) ? first_abw : objABW[row_count]['abw'];
					varsWG[indexWG]=objABW[indexWG].abw - previous_day_abw;
					varsWG[indexWG] = Math.round(varsWG[indexWG], 2);
				} 
			}
			if(objABW.length>0){
				if(varsWG[0]!='NA'){ if(chkPosNagValue(varsWG[0])=='-1') varsWGChk[0]='text-red'; } else { varsWGChk[0]='text-gray'; }
				if(varsWG[1]!='NA'){ if(chkPosNagValue(varsWG[1])=='-1') varsWGChk[1]='text-red'; }  else { varsWGChk[1]='text-gray'; }
				if(varsWG[2]!='NA'){ if(chkPosNagValue(varsWG[2])=='-1') varsWGChk[2]='text-red'; } else { varsWGChk[2]='text-gray'; } 
				if(varsWG[3]!='NA'){ if(chkPosNagValue(varsWG[3])=='-1') varsWGChk[3]='text-red'; }  else { varsWGChk[3]='text-gray'; }
			} else{
				varsWGChk[0]='text-gray';varsWGChk[1]='text-gray';varsWGChk[2]='text-gray';varsWGChk[3]='text-gray';
			}
			
			var temp=singlePondObject[0].temp; 
			var tempABW='NA',tempCumfeed='0',tempDisfeed='0'; 
			if(singlePondObject[0].abw!='NA')   tempABW= (objABW.length>0) ? objABW[0]['abw']+' g' : 'NA';
			if(singlePondObject[0].cumfeed!=null)   tempCumfeed=singlePondObject[0].cumfeed;
			if(singlePondObject[0].disfeed!=null)   tempDisfeed=singlePondObject[0].disfeed;  
			
			varInfoWindow= 
			'<div class="wg-pond"  id="'+pondid+'"><div class="wg-header">' +  
			'<h5 class="wg-name">'+
			'<a class="pond_link" href="ponds?psno='+pondid+'&amp;loc='+locid+'">'+singlePondObject[0].pondname+'</a>' +  
			 '<a title="'+js_strings.Map_edit_pond+'"  onclick="PolygonEditableSet('+pondid+');"   class="clsEditPond" href="javascript:void(0);"><i class="fa fa-edit pull-right text-blue"></i></a><a title="'+js_strings.Pond_alerts+'"  onclick="displayAlerts(&quot;'+pondid+'&quot;,&quot;'+locid+'&quot;,1);"><span class="wg-alerts '+alerts_icon+'"><div><i class="fa fa-bell-o text-red"></i></div></span></a></h5>'+ 			 
			'<h3 class="wg-doc">'+singlePondObject[0].docDays+'<span class="wg-awg"  title="'+js_strings.PM_dispensed_config_feed+'">'+tempDisfeed+'<b style="font-size:14px;"> / </b>'+tempCumfeed+'</span></h3>' + 
			'<h3 class="wg-area">'+singlePondObject[0].pondsize+'<span class="wg-awg" title="'+js_strings.ABW_abw+'"><i class="fa flaticon-shrimp" style="font-size:12px !important;"></i>&nbsp;'+tempABW+'</span></h3>'+   
			'</div>' +
			'<div class="box-footer no-padding">' + 
			'<ul class="nav nav-stacked">' + 
			'<li class="abw_wrapper" title="'+js_strings.Comn_avg_wgt_gain+'"><div><span class="'+varsWGChk[3]+'">'+varsWG[3]+'</span></div><div><span class="'+varsWGChk[2]+'">'+varsWG[2]+'</span></div><div><span class="'+varsWGChk[1]+'">'+varsWG[1]+'</span></div><div><span class="'+varsWGChk[0]+'">'+varsWG[0]+'</span></div></li>' +  			
			' <li class="no-border sensor_wrapper"><div>'+js_strings.Comn_ph+'<span>'+singlePondObject[0].ph+'</span></div><div title="'+js_strings.PM_dissolved_oxygen+'"><span>'+singlePondObject[0].do+'</span> mg/L</div><div title="'+js_strings.Comn_temperature+'"><span>'+temp+'</span><sup>o</sup>C</div></li></ul>'+ 
			'</div>';
		}
	}		
	return varInfoWindow; 
}	
function chkPosNagValue(varnumber)
{
	return parseFloat(varnumber) > 0 ? 1 : varnumber == 0 ? 0 : -1;  
} 
function change_location_zoom(fromInfo)
{  
	var showHideLocations=99;
	$('.mapSrchTab').removeClass('active');
	$("#settingscroller").hide(); 
	//$('.lblPondMap div span').hide(); 
	$('.lblPondMap').addClass('hidden');  
	currentZoomLevel=map.getZoom();   
	globalPolygons.forEach(function(poly) {  
		var newFillColor=FillColor[myLocationsArray.indexOf(poly.locid)];  
		if(fromInfo=='zoom'){
			if(currentZoomLevel<=15) 
			{   
				showHideLocations=99;
				//poly.setOptions({visible:true, fillColor:'#3a4534', strokeColor:'#fff'});
				$('.lblPondMap').addClass('hidden'); 
				infoBubbleWindow.close();  
				// if(currentZoomLevel<13)
				// {   
					// showHideLocations=99;
				// } 	
				// else{ 
					// showHideLocations=88;
				// }
			} 
			else if(currentZoomLevel>15)
			{  	 	
				//poly.setOptions({visible:true, fillColor:globalFillColor, strokeColor:globalStrokeColor  });
				$('.clsPoly'+selectedPondLocId).removeClass('hidden'); 
				showHideLocations=88;
			}  
		}
		else if(fromInfo=='pondclick'){  		
			if(poly.locid==selectedPondLocId) { 			
				$("label[for='" +  poly.locname  + "']").addClass("active");
			}
			else{
				$("label[for='" +  poly.locname  + "']").removeClass("active");
				poly.setOptions({visible:true, fillColor:globalDisableFillColor, strokeColor:globalDisableFillColor  }); 
				//$('.lblPondMap div span').hide(); 
			}
			$('.clsPoly'+selectedPondLocId).removeClass('hidden');
				 
			if(currentZoomLevel<defaultMaxZoomLevel)
			map.setZoom(defaultMaxZoomLevel);   
		}  
		else if(fromInfo=='newlocation'){ 
			 if(poly.locid==selectedPondLocId) {
				$('.clsPoly'+poly.locid).removeClass('hidden');
				//mapLocationNames(0,myLocationsArray.indexOf(poly.locid)); 
			 }
			 else{
				 $('.clsPoly'+poly.locid).addClass('hidden');
				 $('.lblPondMap div span').hide(); 
			 } 
			poly.setOptions({visible:true, fillColor:globalDisableFillColor, strokeColor:globalDisableFillColor  });  
			if(currentZoomLevel<defaultMaxZoomLevel)
			map.setZoom(defaultMaxZoomLevel); 
		}
	}); 
	mapLocationNames(showHideLocations,0); 
} 
function mapLocationNames(displayStatus, hideMarkerIndex)
{   
	// 0 hide, 1 show, 99 show all, 88 hide all, defaultLoad 1 means onload event  
	for(var iPositions=0; iPositions<locCenterPositions.length;iPositions++)
	{ 
		if(displayStatus==99)
		{
			locCenterPositions[iPositions].setMap(map);
		}
		else if(displayStatus==88)
		{
			locCenterPositions[iPositions].setMap(null);
		}
		else{ 
			if(displayStatus==1)
			{
				if(hideMarkerIndex==iPositions)
				{
					if(defaultLoad!=1){
						//if(hideMarkerIndex==iPositions){
							locCenterPositions[iPositions].setMap(null);
						// }
						// else{
							// locCenterPositions[iPositions].setMap(map);
						// }
					}
					else
					locCenterPositions[iPositions].setMap(map);
				}
				else
					locCenterPositions[iPositions].setMap(map);
			} 
		}
	} 
}
function polygonCenter(polygonObj)
{ 
	var polygonObj, lowx,  highx, lowy,  highy, lats = [], lngs = []; 
	for(var i=0; i<polygonObj.length; i++) {   
		lngs.push(polygonObj[i].lng);
		lats.push(polygonObj[i].lat);
	}
	lats.sort();
    lngs.sort();
    lowx = lats[0];
    highx = lats[polygonObj.length - 1];
    lowy = lngs[0];
    highy = lngs[polygonObj.length - 1]; 
    center_x = lowx + ((highx - lowx) / 2);
    center_y = lowy + ((highy - lowy) / 2);	 
	var finalPoint = new Object();
	finalPoint.lat = center_x;
	finalPoint.lng = center_y;    
	return 	finalPoint;
}

function polygonCenterString(polygonObj)
{ 
	var polygonObj, lowx,  highx, lowy,  highy, lats = [], lngs = []; 
	for(var i=0; i<polygonObj.length; i++) {   
		lngs.push(polygonObj[i].lng);
		lats.push(polygonObj[i].lat);
	}
	lats.sort();
    lngs.sort();
    lowx = lats[0];
    highx = lats[polygonObj.length - 1];
    lowy = lngs[0];
    highy = lngs[polygonObj.length - 1]; 
    center_x = lowx + ((highx - lowx) / 2);
    center_y = lowy + ((highy - lowy) / 2);	   
	return 	center_x+','+center_y;
}



  
// Define the overlay, derived from google.maps.OverlayView
function Label(opt_options) {
	 // Initialization
	 var clsPondDeactive="clsInactive";
	 this.setValues(opt_options);
	 var pondid=this.get('pondid').toString();  
	 var locid=this.get('locid').toString(); 
	 var pondstatus=this.get('pondstatus').toString(); 
	 if(pondstatus=='Active') clsPondDeactive=""; 
	 // Label specific
	 var spanPerc = this.span_ = document.createElement('div');
	 spanPerc.setAttribute("id", "span_"+pondid);
	 var divPond = this.div_ = document.createElement('div');
	 divPond.setAttribute("id", "pond_"+pondid);  
	 if(locid==selectedPondLocId)
		divPond.setAttribute("class", "lblPondMap "+clsPondDeactive+" clsPoly"+locid);
	 else
		divPond.setAttribute("class", "lblPondMap "+clsPondDeactive+" hidden clsPoly"+locid); 
	 divPond.appendChild(spanPerc); 
};
Label.prototype = new google.maps.OverlayView;

// Implement onAdd
Label.prototype.onAdd = function() {
	 var pane = this.getPanes().overlayLayer;
	 pane.appendChild(this.div_);

	 // Ensures the label is redrawn if the text or position is changed.
	 var me = this;
	 this.listeners_ = [
	   google.maps.event.addListener(this, 'position_changed',
		   function() { me.draw(); }),
	   google.maps.event.addListener(this, 'text_changed',
		   function() { me.draw(); })
	 ];
};

// Implement onRemove
Label.prototype.onRemove = function() {
	 this.div_.parentNode.removeChild(this.div_); 
	 // Label is removed from the map, stop updating its position/text.
	 for (var i = 0, I = this.listeners_.length; i < I; ++i) {
	   google.maps.event.removeListener(this.listeners_[i]);
	 }
};

// Implement draw
Label.prototype.draw = function() {
	 var projection = this.getProjection();
	 var position = projection.fromLatLngToDivPixel(this.get('position'));

	 var div = this.div_;
	 div.style.left = position.x-20 + 'px';
	 div.style.top = position.y-15 + 'px';
	 div.style.display = 'block';

	 //this.span_.innerHTML = this.get('text').toString();
	  this.span_.innerHTML = this.get('title').toString();
};
function newLocation(newLat,newLng,locid)
{   
	var filteredLocation = jQuery.grep(holdJSONPondsObject, function( elem ) {
		return elem.locid === locid;
	});    
	if(filteredLocation.length>0) {
		$('#navSearchOptions').show(); $('#txtGoogleLocationSearch').show(); 
	}
	else {
		$('#navSearchOptions').hide(); $('#txtGoogleLocationSearch').hide(); 
	}		
	map.setCenter({
		lat : newLat,
		lng : newLng
	}); 
	selectedPondLocId=	locid;
	change_location_zoom('newlocation');  
}
 
function display_search_options(active_tab,slider_from,slider_to,sliderCheck,singleLocationPolygon,highlight)
{   
	//highlight 1 means onclick - 2 means onchange
    infoBubbleWindow.close(); 
	if(sliderCheck==0)
	{
		$('.lblPondMap div span').hide(); 
	}
	else{  
		if(holdJSONPondsObject.length>0){ 
				for (var iPonds = 0; iPonds < holdJSONPondsObject.length; iPonds++) {		
					var displayValue="";
					// maxABW=0; var minABW=0; var maxAWG=0; var minAWG=0; var maxFEED=0; var minFEED=0
					if(active_tab=="srchabw"){ displayValue=holdJSONPondsObject[iPonds].abw;  }
					else if(active_tab=="srchawg"){ displayValue=holdJSONPondsObject[iPonds].wg; }
					else if(active_tab=="srchdo"){ displayValue=holdJSONPondsObject[iPonds].do; }
					else if(active_tab=="srchph"){ displayValue=holdJSONPondsObject[iPonds].ph; }
					else if(active_tab=="srchtemp"){ displayValue=holdJSONPondsObject[iPonds].temp; }
					else if(active_tab=="srchfeed"){ displayValue=holdJSONPondsObject[iPonds].disfeed; }
					else if(active_tab=="srchalerts"){  
							var alertsCount=0;var alertsBGColor=' bg-red';var alert_tooltip='';
							var objAlert_Schedules=JSON.parse(holdJSONPondsObject[iPonds].alerts_schedules);
							var objAlert_Communication=JSON.parse(holdJSONPondsObject[iPonds].alerts_comm);
							var objAlert_Nofeed=JSON.parse(holdJSONPondsObject[iPonds].alert_nofeed);						
							// var objAlert_Schedules=alerts_schedules; 
							// var objAlert_Communication=alerts_comm; 
							// var objAlert_Nofeed=alert_nofeed; 						
							alertsCount+=objAlert_Schedules.length;
							alertsCount+=objAlert_Communication.length;
							alertsCount+=objAlert_Nofeed.length;  
							displayValue=alertsCount;  
					} 				
					var pondId=holdJSONPondsObject[iPonds].pondid;    
					if(displayValue>=slider_from && displayValue<=slider_to){
						$('#pond_'+pondId).show(); 
						$('#span_'+pondId +' span').css('opacity', '1');
						$('#span_'+pondId +' span').show(); 
						if(highlight=='onchange'){
							singleLocationPolygon.forEach(function(e) {  
								if(e.pondid==pondId)	{					
									e.setOptions({visible:true, strokeOpacity:0.7, fillOpacity:0.3 }); 
								}							
							});	
						}  					
					}
					else{ 
						$('#pond_'+pondId +' span').css('opacity', '0.5');
						//$('#span_'+pondId +' span').hide(); 
						//$('#pond_'+pondId).hide();
						if(highlight=='onchange'){
							singleLocationPolygon.forEach(function(e) {  				
								if(e.pondid==pondId)	{					
									e.setOptions({visible:true, strokeOpacity:0.5, fillOpacity:0.3}); 
								}						
							});	
						}						
					} 
					// inactive ponds don't show any options
					if ($('#pond_'+pondId).hasClass( "clsInactive" )) {
						$('#span_'+pondId +' span').hide(); 
					} 
					if(displayValue=='0') displayValue='NA';
					$('#span_'+pondId +' span').html(displayValue);  
				}  
		} 
	}
}
	
  

 