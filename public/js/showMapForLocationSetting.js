/**
 * Created by Nikita on 24.09.2017.
 */
/**
 * Created by Nikita on 25.08.2017.
 */

$(document).ready(function() {

    var curMarker;
    var mapIsOpen = false;
    $(document).delegate(".location", "click", function () {
        if(!mapIsOpen) {
            $("body").css("overflow", "hidden");
            $("body").append("<div id='map' class='map' ></div>");
            $.loadScript('https://maps.googleapis.com/maps/api/js?key=AIzaSyBV9F4GqQslHEyrq4QNO_md5XKIuBgoNhQ&callback=initMap', function () {
            });
            mapIsOpen = true;
        }
    });

    jQuery.loadScript = function (url, callback) {
        jQuery.ajax({
            url: url,
            dataType: 'script',
            success: callback,
            async: true
        });
    }

    $(document).delegate(".close-map", "click", function () {
        $("#map").remove();
        $("body").css("overflow", "auto");
        mapIsOpen = false;
    });

    window.initMap = function() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });

        //Set new location
        map.addListener('click', function(event) {
            if (typeof(curMarker) != "undefined")
                curMarker.setMap(null);
            $(".longlat").val(event.latLng.lat()+"_"+event.latLng.lng());
            placeMarker(event.latLng);
        });

        function placeMarker(location) {
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            curMarker = marker;
        }

        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

        $("#map").append("<img class='close-map' src='../../../resources/images/close20.png'>");
    }




    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }
    //google.maps.event.addDomListener($(".map"), "load", initMap);


});
//AIzaSyAhCQu06YUFI_I49FIzmRMVZYUlx04PvBA

