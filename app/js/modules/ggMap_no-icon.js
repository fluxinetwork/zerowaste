
var siteURL = 'http://fete-des-possibles.org';
var themeURL = siteURL+'/wp-content/themes/fetedespossibles';

var map = null;

var windowW = jQuery(window).width();
var bpSmall = '400';

var nbMakers = 0;
var nbShowMakers = 0;
var nbloadedCards = 6;
var gmarkers = [];
var prevCardMapId = null;
var previousMarker = null;
var isOpenMarker = false;

var activateFilters = true;
var filterCat = 'all_cat';
var filterDate = 'all_cat';
var is_filtered = false;

var currentInfowindow;

var markerCluster = null;
var cluster_markers = [];

var stylesMap = [
    {
        "featureType": "administrative",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.country",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.country",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.neighborhood",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "administrative.land_parcel",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f7f7f7"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "simplified"
            },
            {
                "hue": "#0500ff"
            },
            {
                "saturation": "-100"
            },
            {
                "lightness": "45"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#007bff"
            },
            {
                "visibility": "on"
            },
            {
                "lightness": "-9"
            }
        ]
    }
];


var markerShadow;
var iconShadow = {
    url: themeURL+'/app/img/map/marker-shadow.png',
    size: new google.maps.Size(38, 38),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(34, 34)
};

var iconsMap = {
    atelier: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#ffffff',
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: '#e94ddc',
        fillOpacity: 1,
    },
    projection: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#ffffff',
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: '#4d54e9',
        fillOpacity: 1,
    },
    circuit: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#ffffff',
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: '#39d6ba',
        fillOpacity: 1,
    },
    portes_ouvertes: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#ffffff',
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: '#ff9933',
        fillOpacity: 1,
    },
    happening: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#ffffff',
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: '#E01DDD',
        fillOpacity: 1,
    },
    rassemblement: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#ffffff',
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: '#281DE0',
        fillOpacity: 1,
    },
    conference: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#ffffff',
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: '#1DE05D',
        fillOpacity: 1,
    }
};

var iconsSelMap = {
    atelier: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#e94ddc',
        strokeOpacity: 1,
        strokeWeight: 4,
        fillColor: '#ffffff',
        fillOpacity: 1,
    },
    projection: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#4d54e9',
        strokeOpacity: 1,
        strokeWeight: 4,
        fillColor: '#ffffff',
        fillOpacity: 1,
    },
    circuit: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#39d6ba',
        strokeOpacity: 1,
        strokeWeight: 4,
        fillColor: '#ffffff',
        fillOpacity: 1,
    },
    portes_ouvertes: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#ff9933',
        strokeOpacity: 1,
        strokeWeight: 4,
        fillColor: '#ffffff',
        fillOpacity: 1,
    },    
    happening: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#E01DDD',
        strokeOpacity: 1,
        strokeWeight: 4,
        fillColor: '#ffffff',
        fillOpacity: 1,
    },
    rassemblement: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#281DE0',
        strokeOpacity: 1,
        strokeWeight: 4,
        fillColor: '#ffffff',
        fillOpacity: 1,
    },
    conference: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#1DE05D',
        strokeOpacity: 1,
        strokeWeight: 4,
        fillColor: '#ffffff',
        fillOpacity: 1,
    },

};


/*
 * Init Adherents Map
 * - Add a dom container
 * - latlng = new google.maps.LatLng(47.50,2.20);
 * - activateFilters : default = false
 * - mapOptions = { zoom: 6, scrollwheel: false, panControl: true}
 */
function initMapRdv(){

    //console.log('Init Google Map Obj for "Adherents Map"');

    var mapContainer = document.getElementById("map");

    var latlng = new google.maps.LatLng(47.50,2.20);

    var mapOptions = {
        zoom: 6,
        scrollwheel: false,
        panControl: true,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
            position: google.maps.ControlPosition.LEFT_CENTER
        },
        mapTypeControl: false,
        streetViewControl: false,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROAD
    };

    loadGoogleMap(mapContainer, mapOptions);
}
/* Init the google map
 *  mapContainer = DOM element | mapOptions = option array
 */
function loadGoogleMap(mapContainer, mapOptions){

    //console.log('Load Google Map Obj');

    map = new google.maps.Map(mapContainer,mapOptions);
    map.setOptions({styles: stylesMap});

    //mapContainer.className += 'loader';

    loadMarkers(map);
}

/* Load markers by JSON ajax custom request
 * map = Google map object
 * filterCat : default = 'all_cat' / String : cat_slug
 */
function loadMarkers(map){

    //console.log('loadMarkers '+filterCat);

    var str = 'action=get_json_map&tag='+filterCat;

    jQuery.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_object.ajax_url,
        data: str,
        success: function(data){
            addMakers(map, data);
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
        }

    });
    return false;
}

function addMakers(map, data){

    //console.log('Add Makers ');

    nbMakers = Object.keys(data).length;

    jQuery.each(data, function(i){

        // If it's an adherent
        if(data[i].postType == 'rendez-vous'){

            // Slugs
            var tag = data[i].typeSlug;

            //  Add markers on the map only on desktop
            //if(windowW >= bpSmall){
                var newLatLng = {lat: Number(data[i].latitude), lng: Number(data[i].longitude)};

                var marker = new google.maps.Marker({
                    position: newLatLng,
                    map: map,
                    title: data[i].title,
                    icon: iconsMap[tag],
                    category : data[i].typeSlug,
                    dates : data[i].datesName,
                    datesSlug : data[i].dates,
                    text : data[i].text,
                    permalink : data[i].permalink
                });


                var infowindow = new google.maps.InfoWindow({
                    content:'<div class="infowindow__content">'+
                                '<div class="infowindow__content__header">'+
                                    '<p class="infowindow__content__header__type">'+
                                        data[i].typeName+                                	  
                                    '</p>'+
                                    '<h3 class="infowindow__content__header__title">'+
                                        data[i].title+
                                    '</h3>'+
                                    '<p class="infowindow__content__header__date">'+
                                        data[i].datesName+                                	  
                                    '</p>'+
                                '</div>'+
                                '<div class="infowindow__content__body">'+
                                    '<p class="infowindow__content__body__text">'+
                                    	data[i].text+
                                    '</p>'+
                                    '<a href="'+data[i].permalink+'" class="infowindow__content__body__link">En savoir plus</a>'+
                                '</div>'+
                            '</div>'
                });

                marker.addListener('click', function(e) {
                    onClickMarker(i,map,marker,tag,e,infowindow);
                });

                // Add class to info window
                google.maps.event.addListener(infowindow, 'domready', function() {

                    $infoBg = jQuery('.gm-style-iw').prev();

                    $infoBg.addClass('infowindow--bg');
                    jQuery('.gm-style-iw').next().addClass('infowindow__close').empty().append('<div class="c-roundBt c-roundBt--dark"><i class="fa fa-times"></i></div>');

                    $infoBg.find('div:eq(0)').addClass('infowindow--bg--shadow__corne')
                    $infoBg.find('div:eq(1)').addClass('infowindow--bg--shadow__bubble');

                    $infoBg.find('div:eq(2)').addClass('infowindow--bg--corne');
                    $infoBg.find('div:eq(2) div:eq(0)').addClass('infowindow--bg--corne__l');
                    $infoBg.find('div:eq(2) div:eq(0)').next().addClass('infowindow--bg--corne__r');

                    $infoBg.find('div:eq(2)').next().addClass('infowindow--bg--bubble');
                });

                gmarkers.push(marker);

                if(i==nbMakers-1 && activateFilters){
                    // Init all filters once if activateFilters = true
                    initFilters(map);
                    activateFilters=false;

                    markerCluster = new MarkerClusterer(map, gmarkers, {imagePath: themeURL+'/app/img/map/m'});
                    markerCluster.setIgnoreHidden(true);
                    markerCluster.setMaxZoom(10);

                    centerMapOnMarkers(map);

                }
            //}
            // Add info card
            var markerContent = '<div class="card-map c-'+tag+' hide">';
                    markerContent += '<a href="'+data[i].permalink+'">';
                        markerContent += data[i].title;
                    markerContent += '</a>';

                    markerContent += '<div class="details">';
                       markerContent += 'Des détails..........';
                    markerContent += '</div>';

                    markerContent += '<a class="button" href="'+data[i].permalink+'">Voir la fiche</a>';

                markerContent += '</div>';

            //jQuery('.map-cards').append(markerContent);

        }

        // End each
   });

}


// Event on click  on a marker
function onClickMarker(index,map,marker,tag,e,infowindow){

    // Add a shadow
   /* if (markerShadow && markerShadow.setPosition) {
        markerShadow.setPosition(marker.getPosition());
        markerShadow.show();
    } else {
        markerShadow = new MarkerShadow(marker.getPosition(), iconShadow, map);
        markerShadow.show();
    }*/
    // Modify previous marker
    if(isOpenMarker){
        previousMarker.setIcon(iconsMap[previousTag]);
        previousMarker.setZIndex(1);
        currentInfowindow.close();
    }
    // Change the icon
    marker.setIcon(iconsSelMap[tag]);
    previousMarker = marker;
    previousTag = tag;

    infowindow.open(map, marker);
    currentInfowindow = infowindow;

    marker.setZIndex(10000);
    // center on marker
    map.setCenter( e.latLng );

    // Get the card
    /*if(index != prevCardMapId){
        if(isOpenMarker){
            jQuery('.map-cards .card-map:eq('+prevCardMapId+')').toggleClass('hide');
            setTimeout(function() {
                jQuery('.map-cards .card-map:eq('+index+')').toggleClass('hide');

            }, 220);

        }else{
            jQuery('.map-cards .card-map:eq('+index+')').toggleClass('hide');

        }
    }
    prevCardMapId = index;*/
    isOpenMarker = true;

}

function initFilters(map){

    //console.log('Init filters');
    jQuery('#form-filter-map').on('submit', function(e){
        e.preventDefault();
        e.stopPropagation();
        var count_result = 0;

        if( jQuery('#type_rdv').val() || jQuery('#dates_rdv').val() ){
            is_filtered = true;
            resetMarkers();
            var $form = jQuery('#form-filter-map');

            if( jQuery('#type_rdv').val() ){
	            filterCat = jQuery('#type_rdv').val();
	        }
	        if( jQuery('#dates_rdv').val() ){
	            filterDate = jQuery('#dates_rdv').val();
	        }

            jQuery('#form-filter-map').find('.js-reload').removeClass('is-none');

            for (i = 0; i < nbMakers; i++) {
                // If is same category or category not picked
                if (gmarkers[i].category == filterCat || filterCat.length === 0 || filterCat == 'all_cat'){

					//console.log(filterDate,gmarkers[i].dates); 

					var current_dates = gmarkers[i].datesSlug;
	            	var arrayDates = current_dates.split(', ');

	            	//console.log('Filtre ==== '+filterDate);
                    //console.log('Marker date ==== '+current_dates);

                	if(jQuery.inArray(filterDate,arrayDates) != -1 || filterDate.length === 0 || filterDate == 'all_cat' ){

	                    gmarkers[i].setVisible(true);
	                    count_result++;

	                }else{

	                	gmarkers[i].setVisible(false);

	                }

                }else{ // Categories don't match

                    gmarkers[i].setVisible(false);

                }

                if(i==nbMakers-1 && windowW >= bpSmall){
                    markerCluster.repaint();
                    centerMapOnMarkers(map);

                    if(count_result==0) notify('<p class="c-error">Aucun rendez-vous ne correspond.</p>');
                }
            }

            //console.log('----------------------------');
        }else{
        	notify('<p class="c-error">Aucun filtre n\'est sélectionné</p>');
        }


    });

    /*jQuery('#type_rdv, #dates_rdv').on('change', function(e){
        jQuery('#form-filter-map').triggerHandler('submit');
    });*/

    // reset
    jQuery('button[type="reset"]').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        resetMarkers();
        if(is_filtered){
            jQuery('#form-filter-map').find('.js-reload').addClass('is-none');
            resetFilters();
            resetMarkers();
            markerCluster.repaint();
            centerMapOnMarkers(map);
            jQuery('#type_rdv option, #dates_rdv option').prop('selected', function() {
                return this.defaultSelected;
            });
            is_filtered = false;
        }
    });

}
/**
* Geolocation
*
*/

jQuery('.js-geoloc').on('click', function(e){
	e.preventDefault();	
	if(map){
		initGeoLoc(map);
	}
});

function initGeoLoc(map){
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        console.log(pos);

        var newLatLng = {lat: position.coords.latitude, lng: position.coords.longitude};

        var marker = new google.maps.Marker({
            position: newLatLng,
            map: map,
            title: "Moi",
            icon: themeURL+'/app/img/map/user_location.png'
        });


        map.setCenter(pos);
        map.setZoom(8);

      }, function() {
        notify('<p class="c-error">Géolocalisation refusée</p>');
      });
    } else {
      notify('<p class="c-error">Votre navigateur ne permet pas la géolocalisation</p>');
    }
}

function resetFilters(){
    for (i = 0; i < gmarkers.length; i++) {
        //if (gmarkers[i].category != filterCat ) {
            gmarkers[i].setVisible(true);
        //}
        if(i == gmarkers.length-1){
            filterCat = 'all_cat';
            filterDate = 'all_cat';
        }
    }
}


function resetMarkers() {
    if(isOpenMarker){
        // reset icon
        previousMarker.setIcon(iconsMap[previousTag]);
       // markerShadow.hide();
        // close infowindow
        if (isOpenMarker) { currentInfowindow.close();}
        isOpenMarker = false;
        // reset card
        //jQuery('.map-cards .card-map:eq('+prevCardMapId+')').toggleClass('hide');
        //prevCardMapId = null;
    }
}


function centerMapOnMarkers(map){
    nbShowMakers = nbMakers;
    var LatLngList = new Array ();
    var bounds = new google.maps.LatLngBounds ();
    // Bind all marker's positions
    for (i = 0; i < gmarkers.length; i++) {
        if(gmarkers[i].visible)
        LatLngList.push(gmarkers[i].getPosition());
        else
        nbShowMakers--;
    }
    //  And increase the bounds to take this point
    for (var j = 0, LtLgLen = LatLngList.length; j < LtLgLen; j++) {
        bounds.extend (LatLngList[j]);
    }

    if(nbShowMakers >= 3){
        map.fitBounds (bounds);
    }else if(nbShowMakers == 2){
        map.setZoom(6);
        map.setCenter(bounds.getCenter());
    }else if(nbShowMakers == 1){
        map.setZoom(7);
        map.setCenter(bounds.getCenter());
    }
}

function removeMarkers() {
    //console.log('Remove All Markers');
     for(i=0; i<gmarkers.length; i++){
        gmarkers[i].setMap(null);
    }
}

/*
 * Reload map page on resize
 *
 */
function reloadCurrentPage(){
    if(lastWindowW <= bpSmall && windowW >= bpSmall && jQuery('#map').length == 1){
        location.reload(true);
        lastWindowW = windowW;
    }
}


/*
 * Marker shadow prototype
 *
 */
MarkerShadow.prototype = new google.maps.OverlayView();
MarkerShadow.prototype.setPosition = function(latlng) {
    this.posn_ = latlng;
    this.draw();
  }
  /** @constructor */

function MarkerShadow(position, options, map) {

    // Initialize all properties.
    this.posn_ = position;
    this.map_ = map;
    if (typeof(options) == "string") {
      this.image = options;
    } else {
      this.options_ = options;
      if (!!options.size) this.size_ = options.size;
      if (!!options.url) this.image_ = options.url;
    }

    // Define a property to hold the image's div. We'll
    // actually create this div upon receipt of the onAdd()
    // method so we'll leave it null for now.
    this.div_ = null;

    // Explicitly call setMap on this overlay.
    this.setMap(map);
  }
  /**
   * onAdd is called when the map's panes are ready and the overlay has been
   * added to the map.
   */
MarkerShadow.prototype.onAdd = function() {
  // if no url, return, nothing to do.
  if (!this.image_) return;
  var div = document.createElement('div');
  div.style.borderStyle = 'none';
  div.style.borderWidth = '0px';
  div.style.position = 'absolute';

  // Create the img element and attach it to the div.
  var img = document.createElement('img');
  img.src = this.image_;
  img.style.width = this.options_.size.x + 'px';
  img.style.height = this.options_.size.y + 'px';
  img.style.position = 'absolute';

  div.appendChild(img);

  this.div_ = div;

  // Add the element to the "overlayLayer" pane.
  var panes = this.getPanes();
  panes.overlayShadow.appendChild(div);
};

MarkerShadow.prototype.draw = function() {
  // if no url, return, nothing to do.
  if (!this.image_) return;
  // We use the coordinates of the overlay to peg it to the correct position
  // To do this, we need to retrieve the projection from the overlay.
  var overlayProjection = this.getProjection();

  var posn = overlayProjection.fromLatLngToDivPixel(this.posn_);

  // Resize the image's div to fit the indicated dimensions.
  if (!this.div_) return;
  var div = this.div_;
  if (!!this.options_.anchor) {
    div.style.left = Math.floor(posn.x - this.options_.anchor.x) + 'px';
    div.style.top = Math.floor(posn.y - this.options_.anchor.y) + 'px';
  }
  if (!!this.options_.size) {
    div.style.width = this.size_.x + 'px';
    div.style.height = this.size_.y + 'px';
  }
};

// The onRemove() method will be called automatically from the API if
// we ever set the overlay's map property to 'null'.
MarkerShadow.prototype.onRemove = function() {
  if (!this.div_) return;
  this.div_.parentNode.removeChild(this.div_);
  this.div_ = null;
};

// Set the visibility to 'hidden' or 'visible'.
MarkerShadow.prototype.hide = function() {
  if (this.div_) {
    // The visibility property must be a string enclosed in quotes.
    this.div_.style.visibility = 'hidden';
  }
};

MarkerShadow.prototype.show = function() {
  if (this.div_) {
    this.div_.style.visibility = 'visible';
  }
};