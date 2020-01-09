let map;
let currentPosition;

let success = (pos) => {
    currentPosition = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
    map = new google.maps.Map(document.getElementById('map'), {
        center: currentPosition,
        zoom: 14
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

function nearbysearch() {
    var request = {
        location: currentPosition,
        radius: '5000',
        type: ['train_station']
    };

    service = new google.maps.places.PlacesService(map);
    service.nearbySearch(request, callback);

    function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            //取得したカフェ情報をそれぞれcreateMarkerに入れて、マーカーを作成
            for (var i = 0; i < results.length; i++) {
                var place = results[i];
                //console.log(place)
                var latlng = place.geometry.location;
                var icn = place.icon;

                let rendererOptions = {
                    map: map, // 描画先の地図
                    draggable: true, // ドラッグ可
                    preserveViewport: true // centerの座標、ズームレベルで表示
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
                        new google.maps.DirectionsRenderer({
                            map: map,
                            directions: response,
                            center: currentPosition,
                            suppressMarkers: true // デフォルトのマーカーを削除
                        });
                        let leg = response.routes[0].legs[0];
                        makeMarker(leg.end_location, markers.goalMarker, map);
                    }
                });
                createMarker(latlng, icn, place);
            }
        }
    }
}

navigator.geolocation.getCurrentPosition(success, error, options);