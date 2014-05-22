$(document).ready(function() {
    map.init();
    dom.init();
});



// Map object
var map ={
    url: 'http://digitaslbi-id-test.herokuapp.com/bus-stops',
    send: null,
    reqType: 'all',
    londonMap: null,
    stop: null,
    geocoder: null,
    mapMarkers: [],
    // Init function for the map
    init: function(){
            this.send = this.url;
            this.loadMap();
            //click check
            $("#btn").click(function(){
                map.locateAddress();
                return false;
            });
    },
    area : {
        northEast:'51.523858, -0.153594',
        southWest:'51.508208 , -0.081968'
    },
    //initial setup for lat/lng (cetral london)
    mapOptions: {
        zoom: 16,
        center: new google.maps.LatLng(51.51258,-0.1366),
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
        }
    },
    // init and load map and search listener
    loadMap:function(){
        this.geocoder  = new google.maps.Geocoder();
        this.londonMap = new google.maps.Map(document.getElementById('map'), map.mapOptions);
        google.maps.event.addListener(this.londonMap, 'mouseup', function(event) {
            map.resetArea();
        });
         
        this.apiRequest('initial',map.area);
    },
    // Api ajax request handler.
    // @params {string} type of request for the switch/case
    // @params {object} data to send to the API
    apiRequest:function(type,reqData){
        $.ajax({
            dataType: "jsonp",
            type: "GET",
            url: map.send,
            data:reqData
        }).done(function(data,status) {
            if(status === 'success'){
                switch(type){
                    case 'initial':
                        map.populateMap(data.markers);
                    break;
                    case 'stop':
                        map.stopData(data);
                    break;    
                }
            }
            return false;
        });
    },
    //search with geocoder from the input 
    locateAddress: function(){
        dom.hideError();
        dom.close();
        var address = document.getElementById('txt').value;
        map.geocoder.geocode( {'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.londonMap.setCenter(results[0].geometry.location);
                map.resetArea();
            } else {
               dom.searchError(status); 
            }
        });

    },
    //check where the map is and send the request for the bus stops
    resetArea: function(){
        map.area = {
            northEast:map.londonMap.getBounds().getNorthEast().lat()+', '+map.londonMap.getBounds().getNorthEast().lng(),
            southWest:map.londonMap.getBounds().getSouthWest().lat()+', '+map.londonMap.getBounds().getSouthWest().lng()
        }
        map.cleanMap();
        map.send = map.url;
        map.apiRequest('initial',map.area);       
    },
    //clean map
    cleanMap: function(){
        for(i=0; i <map.mapMarkers.length; i++){
            map.mapMarkers[i].setMap(null);
        }
        map.mapMarkers = [];
    },
    // Callback function to poulate map (called after api response)
    // @params {object} 
    populateMap: function(markers){
        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        if(markers === undefined){
            return false;
        }
        if(markers.length > 0){
            for(i=0; i<markers.length; i++){//loop markers
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(markers[i].lat, markers[i].lng),
                    map: map.londonMap
                });
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        if (infowindow) infowindow.close();
                        infowindow.setContent(map.markerContent(markers[i]));
                        infowindow.open(map.londonMap, marker);
                    }
                })(marker, i));
                map.mapMarkers[i] = marker;  
          }
        }else{
            //if not bus sto in the location
            dom.searchError('NO_BUS_STOP');
        }
        
        return false;
    },
    // Create marker html
    // @params {object} marker 
    markerContent: function(marker){
        dom.close();
        dom.hideError();
        map.send = null;
        map.send = map.url+'/'+marker.id;
        map.apiRequest('stop',{});
        map.stop = marker.id;
        
        var html = '<div class="marker-txt">'+marker.name;
        var routes =marker.routes;
        if(routes !== undefined && routes.length > 0){
            html+=' (towards: '+marker.towards+')</br>Routes: ';
            for(var i=0; i<routes.length; i++){
                html+=routes[i].name+' ';
                }    
                html+='<br/><span><a href="javascript:dom.clickOp();" class="showdep">See departures</a></span>'
            }
        
        html+='</div>';
        return html;
    },
    // Callback function to display the timing
    // @params {object} stops with timing
    stopData: function(data){
        var html = '';
        if(data.arrivals !== undefined){
            var arrivals = data.arrivals;
            if(arrivals.length > 0){
                for(i=0; i<arrivals.length; i++){
                    html+=arrivals[i].routeName;
                    html+=' destination: '+arrivals[i].destination;
                    html+=' estimated: '+arrivals[i].estimatedWait;
                    html+='<br/>';
                }
            }
            else{
                html="Can't find bus info "+"last update "+data.lastUpdated;
            }
            $("#stops").html(html);
        }
    }
}

// Dom object to manage html
var dom ={
    init: function(){
        $(".close").click(function(){
            dom.slideInOut();
        });
    },
    // open display
    clickOp:function(){
        this.close();
        this.slideInOut();
    },
    // close display
    close: function(){
        $("#results").hide();
    },
    // slide effect display
    slideInOut : function(){
        $("#results").slideToggle('slow');
    },
    //manage search
    searchError: function(error){
        var msg = '';
        switch(error){
            case 'ZERO_RESULTS':
                msg = 'No location found';
            break;
            case 'NO_BUS_STOP':
                msg = 'No bus stops in this location';
            break;
            default:
                msg = 'Undefined error';
            break;    
        }
        $(".error").html(msg);
        $(".error").fadeIn();
    },
    //hide error
    hideError: function(){
        $(".error").hide();
    }
}