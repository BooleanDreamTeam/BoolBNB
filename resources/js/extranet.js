$(document).ready(function() {

    var placesAutocomplete = places({
        appId: 'pl19ZMXZ5X0L',
        apiKey: '035a9540a189547cb9889a73bf507a48',
        container: document.querySelector('#Indirizzo')
    });

    placesAutocomplete.on('change', function(e) {

        $('#cordinates').val([e.suggestion.latlng.lat,e.suggestion.latlng.lng]);

    });    

});