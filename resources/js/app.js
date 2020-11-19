// GENERAL IMPORT
require('./bootstrap');
require('chart.js/dist/Chart.min.js');
import WOW from 'wowjs';
import Typed from 'typed.js';
new WOW.WOW().init();
//------//

// PROVA ALGOLIA

$(document).ready(function() {

    if (window.location.pathname == '/'|| window.location.pathname == '/host/firstapartment/create') {
        
        // ALGOLIA INDEX

        var typed = new Typed('#smart-write', {
            strings: ["Benvenuti in ^1000 BoolBNB", "Cerca l'appartamento dei tuoi sogni!"],
            typeSpeed: 70,
            smartBackspace: true,
            backSpeed: 70,
          });          

        var placesAutocomplete = places({
            appId: 'pl19ZMXZ5X0L',
            apiKey: '035a9540a189547cb9889a73bf507a48',
            container: document.querySelector('#address-input')
        });
        
        placesAutocomplete.on('change', function(e) {

            $('#cordinates').val([e.suggestion.latlng.lat,e.suggestion.latlng.lng]);
    
        });

    }

    // MAPPA SHOW

    mapShow($('.card_show').data('lat'),$('.card_show').data('lng'));

      function mapShow(lat,lng) {
        const map = L.map("map_container").setView([lat,lng], 13);

        var osmLayer = new L.TileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              minZoom: 1,
              maxZoom: 13,
              attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
            }
        );

        map.addLayer(osmLayer);
    
        L.marker([lat, lng]).addTo(map);
    
        return map;
    }

});

//---//