$(document).ready(function() {
    var style_day = [
        {"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}
    ];
    var style_night = [
        {"featureType":"all","elementType":"all","stylers":[{"invert_lightness":true},{"saturation":10},{"lightness":30},{"gamma":0.5},{"hue":"#435158"}]}
    ];
    var hr = (new Date()).getHours();
    if (hr >= 6 && hr < 18) {
        mapStyle = style_day;
    } else {
        mapStyle = style_night;
    }
    
    $('#picker').locationpicker({
        location: {
          latitude: -6.1751,
          longitude: 106.8650
        },
        styles: mapStyle,
        zoom: 15,
        markerInCenter: false,
        enableAutocomplete: true,
        enableReverseGeocode: true,
        radius: 0,
        inputBinding: {
            latitudeInput: $('#picker-lat'),
            longitudeInput: $('#picker-long'),
            radiusInput: $('#picker-radius'),
            locationNameInput: $('#picker-address')
        },
      //   onchanged: function (currentLocation, radius, isMarkerDropped) {
      //       var addressComponents = $(this).locationpicker('map').location.addressComponents;
      //       console.log(currentLocation);  //latlon  
      //       updateControls(addressComponents); //Data
      //   }
    });
});