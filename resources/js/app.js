// GENERAL IMPORT
require('./bootstrap');
require('chart.js/dist/Chart.min.js');
import WOW from 'wowjs';
import Typed from 'typed.js';
new WOW.WOW().init();
//------//


// CHIAMATA IP E INVIO API CLICK

$(document).on('click','.click',function() {

    var id_apartment = $(this).children().data('id'); 

    $.ajax({
        type: 'GET',
        url: 'https://jsonip.com',
        success: function(data) {
            var ip = data.ip;
            var browser = navigator.userAgent;
            getDetailsIp(ip,browser,id_apartment);
        }
    });

});




function getDetailsIp(ip,browser,id_apartment) {
    $.ajax({
        method: 'GET',
        url: 'http://api.ipapi.com/api/' + ip,
        data: {
            access_key : '9c7bb63fc1fe38664d28c9bf1e2dc75f',
        },
        success: function(data) {
            data['browser'] = browser;
            data['id_apartment'] = id_apartment;
            console.log(data);
            postClick(data);
        }
    });
}

function postClick(data) {
    $.ajax({
        method: 'POST',
        url: 'http://localhost:8000/api/clicks',
        data: {
            'id_apartment' : data['id_apartment'],
            'browser' : data['browser'],
            'geo_area' : data['region_name'],
            'visitor' : data['ip']
        },
        success: function(data) {
            console.log(data); 
        }
    });
}

//---//


// PROVA TYPED
var typed = new Typed('.prova', {
    strings: ['Benvenuti a BOolbnb'],
    typeSpeed: 100,
    loop: true,
    loopCount: Infinity,
    backSpeed: 500,
    showCursor: false
});
//---//

// PROVA ALGOLIA
var placesAutocomplete = places({
    appId: 'pl19ZMXZ5X0L',
    apiKey: '035a9540a189547cb9889a73bf507a48',
    container: document.querySelector('#address-input')
});

placesAutocomplete.on('change', e => console.log(e.suggestion));

//---//

// PROVA CHART
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

//---//