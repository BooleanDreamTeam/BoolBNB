// CHIAMATA IP E INVIO API CLICK

$(document).ready(function() {

    var id_apartment = $('.card').data('id');

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