let map;

let success = (pos) => {
    map = new google.maps.Map(document.getElementById('map'), {
        center: pos,
        zoom: 8
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