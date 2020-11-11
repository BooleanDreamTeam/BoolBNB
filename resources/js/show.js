require('./bootstrap');
require('chart.js/dist/Chart.min.js');
import WOW from 'wowjs';
import Typed from 'typed.js';

new WOW.WOW().init();

var typed = new Typed('.prova', {
    strings: ['Benvenuti a BOolbnb'],
    typeSpeed: 100,
    loop: true,
    loopCount: Infinity,
    backSpeed: 500,
    showCursor: false
});

var placesAutocomplete = places({
    appId: 'pl19ZMXZ5X0L',
    apiKey: '035a9540a189547cb9889a73bf507a48',
    container: document.querySelector('#address-input')
});

placesAutocomplete.on('change', e => console.log(e.suggestion));

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