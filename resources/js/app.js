// GENERAL IMPORT
require('./bootstrap');
require('chart.js/dist/Chart.min.js');
import WOW from 'wowjs';
import Typed from 'typed.js';
import { map } from 'jquery';
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
            showCursor: false
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

    if (window.location.pathname == '/search') {

      var placesAutocomplete = places({
          appId: 'pl19ZMXZ5X0L',
          apiKey: '035a9540a189547cb9889a73bf507a48',
          container: document.querySelector('#address-input')
      });

      // MARKER APPARTAMENTI MAPPA

      var apartments = $('.card_apartment_search');

      var arrayApartments = [];

      for (let i = 0; i < apartments.length; i++) {
        arrayApartments.push({lat : apartments[i].dataset.lat, lng : apartments[i].dataset.lng});
      }
      
      var startMap = mapShow($('#map_container').data('lat'),$('#map_container').data('lng'),arrayApartments);

      //----------------//

      placesAutocomplete.on('change', function(e) {

        $('#cordinates').val([e.suggestion.latlng.lat,e.suggestion.latlng.lng]);

        callApiApartmentSearch();

      });

      var markers = [];
      
      $('input').on('change',function() {

        callApiApartmentSearch();

      });

      // API CALL
      function callApiApartmentSearch() {

        var services = [];

        $("input[name='services']:checked").each(function() {
          services.push($(this).val());
        });

        $.ajax({
          method: 'GET',
          url: 'http://localhost:8000/api/search',
          data: {
            'stanze' : $('input[name=stanze]').val(), 
            'services' : services,
            'postiletto' : $('input[name=postiletto]').val(),
            'range' : $('input[name=range]').val(),
            'address' : $('input[name=address]').val(),
            'cordinates' : $('input[name=cordinates]').val(),
          },
          success: function(data) {


            $('.bs-example').empty();


            refreshApartments(data);
          }
        });
      }

      function refreshApartments(data) {
        
        var source = $('#template').html();
        var template = Handlebars.compile(source);
        
        var apartments = data.apartments.data;

        var rangeView = data.range;

        mapRefresh(data.lat,data.lng,apartments,rangeView);
  
        apartments.forEach(apartment => {
          var context = {
            latitude: apartment.latitude,
            longitude: apartment.longitude,
            title: apartment.title,
            description: apartment.description,
            cover: apartment.imgurl
          };

          var html = template(context);

          $('.bs-example').append(html);
          
        });

      }

      function mapRefresh(lat,lng,apartments,rangeView) {

        startMap.invalidateSize();

        startMap.setView([lat,lng],15);

        markers.forEach(marker => {

          removeMarker(marker);
        
        });

        markers = [];
  
        apartments.forEach(apartment => {
          addMarker(apartment.latitude,apartment.longitude);
        });
  
      }
  
      function addMarker(lat,lng) {
        var marker = L.marker([lat,lng]).addTo(startMap);
        markers.push(marker);
      }

      function removeMarker(marker) {
        startMap.removeLayer(marker);
      }



    }

    // MAPPA SHOW
    mapShow($('.card_show').data('lat'),$('.card_show').data('lng'));

    function mapShow(lat,lng,apartments) {    

        var map = L.map("map_container").setView([lat,lng], 13);

        var osmLayer = new L.TileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              minZoom: 10,
              maxZoom: 20,
              attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
            }
        );

        map.addLayer(osmLayer);

        if (window.location.pathname != '/search') {
          L.marker([lat, lng]).addTo(map); 
        }

        if (apartments) {
          
          for (var i = 0; i < apartments.length; i++) {
            
            var marker = L.marker([apartments[i].lat,apartments[i].lng]).addTo(map);
            

          }

        }
    
        return map;
    }

    function addMarkerInitial(lat,lng) {
      var marker = L.marker([lat,lng]).addTo(startMap);
      markers.push(marker);
    }

});

$(document).on('click','img.leaflet-marker-icon', function() {

  

});

//---//
