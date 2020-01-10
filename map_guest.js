let map;
let currentPosition;
let markers = [];
let infoWindow = [];

let success = (pos) => {
    currentPosition = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
    map = new google.maps.Map(document.getElementById('map'), {
        center: currentPosition,
        zoom: 4
    });
    new google.maps.Circle({
        center: currentPosition,       // 中心点(google.maps.LatLng)
        fillOpacity: 0.1,       // 塗りつぶし透過度（0: 透明 ⇔ 1:不透明）
        map: map,             // 表示させる地図（google.maps.Map）
        radius: 500,          // 半径（ｍ）
        strokeColor: '#ff0000', // 外周色
        strokeOpacity: 1,       // 外周透過度（0: 透明 ⇔ 1:不透明）
        strokeWeight: 1         // 外周太さ（ピクセル）
    });
    new google.maps.Circle({
        center: currentPosition,       // 中心点(google.maps.LatLng)
        map: map,             // 表示させる地図（google.maps.Map）
        radius: 1000,          // 半径（ｍ）
        strokeColor: '#ff0000', // 外周色
        strokeOpacity: 1,       // 外周透過度（0: 透明 ⇔ 1:不透明）
        strokeWeight: 1         // 外周太さ（ピクセル）
    });
    new google.maps.Circle({
        center: currentPosition,       // 中心点(google.maps.LatLng)
        map: map,             // 表示させる地図（google.maps.Map）
        radius: 1500,          // 半径（ｍ）
        strokeColor: '#ff0000', // 外周色
        strokeOpacity: 1,       // 外周透過度（0: 透明 ⇔ 1:不透明）
        strokeWeight: 1         // 外周太さ（ピクセル）
    });

    nearbysearch(currentPosition);
};

let error = (err) => {
    let msg = 'エラーが発生しました: ' + err;
    console.log(msg);
};

let options = {
    enableHighAccuracy: false,
    timeout: 5000,
    maximumAge: 0
};

function createMarker(latlng, count) {
    markers.push(new google.maps.Marker({
        position: latlng,
        map: map,
        information: "test!!"
    }));
    let time = ['23:','00:','01:'];
    let last_time = time[Math.floor(Math.random()*3)] + Math.floor(Math.random()*60);
    infoWindow.push(new google.maps.InfoWindow({
        content: '<b>' + last_time + '</b>'
    }));
    infoWindow[count].open(map, markers[count]);
}

function nearbysearch() {
    let request = {
        location: currentPosition,
        radius: '1500',
        type: ['train_station']
    };

    let service = new google.maps.places.PlacesService(map);
    service.nearbySearch(request, callback);

    function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            for (let i = 0; i < results.length; i++) {
                let place = results[i];
                let latlng = place.geometry.location;

                let rendererOptions = {
                    map: map, // 描画先の地図
                    draggable: true, // ドラッグ可
                };
                let directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
                let directionsService = new google.maps.DirectionsService();
                directionsDisplay.setMap(map);
                let request = {
                    origin: currentPosition, // スタート地点
                    destination: latlng, // ゴール地点
                    travelMode: google.maps.DirectionsTravelMode.WALKING, // 移動手段
                };
                directionsService.route(request, function(response,status) {
                    if (status === google.maps.DirectionsStatus.OK) {
                        console.log(JSON.stringify(response.duration.text));
                        new google.maps.DirectionsRenderer({
                            map: map,
                            directions: response,
                            center: currentPosition,
                            suppressMarkers: true // デフォルトのマーカーを削除
                        });
                    }
                });
                createMarker(latlng, i);
            }
        }
    }
}

navigator.geolocation.getCurrentPosition(success, error, options);