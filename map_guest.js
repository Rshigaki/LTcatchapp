let map;

let success = (pos) => {
    let currentPosition = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
    map = new google.maps.Map(document.getElementById('map'), {
        center: currentPosition,
        zoom: 15
    });
};

let error = (err) => {
    msg = 'エラーが発生しました: ' + err;
    console.log(msg);
};

let options = {
    enableHighAccuracy: false,
    timeout: 5000,
    maximumAge: 0
};

navigator.geolocation.getCurrentPosition(success, error, options);