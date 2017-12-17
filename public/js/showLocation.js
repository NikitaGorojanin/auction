/**
 * Created by Nikita on 25.08.2017.
 */

$(document).ready(function() {


    var mapOpen = false;
    $(document).delegate(".location", "click", function () {
        if(!mapOpen) {
            $("body").css("overflow", "hidden");
            $("body").append("<div id='map' class='map' ></div>");
            $.loadScript('https://maps.googleapis.com/maps/api/js?key=AIzaSyBV9F4GqQslHEyrq4QNO_md5XKIuBgoNhQ&callback=initMap', function () {
            });
            mapOpen = true;
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
        mapOpen = false;
    });

    window.initMap = function() {
        //var uluru = {lat: -25.363, lng: 131.044};
        var lat = parseFloat($(".location").attr("lat"))-0.003;
        var lng = parseFloat($(".location").attr("lng"));
        var location = {lat: lat, lng: lng};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            maxZoom: 11,
            center: location,
            scrollwheel: false,
        });
        var marker = new google.maps.Marker({
            position: location,
            icon: "../../../../resources/images/marker.png",
            map: map
        });

        $("#map").append("<img class='close-map' src='../../../../resources/images/close20.png'>");

        //var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        /*if (navigator.geolocation) {
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
        }*/
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

