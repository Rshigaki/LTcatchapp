$(function () {

    'use strict';
    var map;
    var service;
    var infowindow;
    var pyrmont;
    geoLocationInit();
    map.setCenter(new google.maps.LatLng(pyrmont));

    // 現在地取得
    document.getElementById('getcurrentlocation').onclick = function () {
        geoLocationInit();
    };

    function geoLocationInit() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, fail);

        } else {
            createMap(pyrmont);
        }
    }

    // success
    function success(position) {
        var currentLat = position.coords.latitude;
        var currentLng = position.coords.longitude;
        var pyrmont = new google.maps.LatLng(currentLat, currentLng);

        createMap(pyrmont);
        CurrentPositionMarker(pyrmont);

        var circleOptions1 = {
            map: map,
            center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
            radius: 500,//0.5km
            strokeColor: "#009933",
            strokeOpacity: 1,
            strokeWeight: 1,
            fillColor: "#00ffcc",
            fillOpacity: 0.1
        };


        var circleOptions2 = {
            map: map,
            center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
            radius: 1000,//1km
            strokeColor: "#009933",
            strokeOpacity: 1,
            strokeWeight: 1,
            fillColor: "#00ffcc",
            fillOpacity: 0.1
        };

        var circleOptions3 = {
            map: map,
            center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
            radius: 1500,//1.5km
            strokeColor: "#009933",
            strokeOpacity: 1,
            strokeWeight: 1,
            fillColor: "#00ffcc",
            fillOpacity: 0.1
        };

        var circle1 = new google.maps.Circle(circleOptions1);
        var circle2 = new google.maps.Circle(circleOptions2);
        var circle3 = new google.maps.Circle(circleOptions3);
    }

    // fail
    function fail(pyrmont) {
        createMap(pyrmont);
    }

    function createMap(pyrmont) {

        map = new google.maps.Map(document.getElementById('map'), {
            center: pyrmont,
            zoom: 15
        });
        nearbysearch(pyrmont)
    }

    function createMarker(latlng, icn, place) {
        var marker = new google.maps.Marker({
            position: latlng,
            map: map
        });

        var placename = place.name;
        // 吹き出しにカフェの名前を埋め込む
        var contentString = `<div class="sample"><p id="place_name">${placename}</p></div>`;

        // 吹き出し
        var infoWindow = new google.maps.InfoWindow({ // 吹き出しの追加
            content: contentString// 吹き出しに表示する内容
        });


        marker.addListener('click', function () { // マーカーをクリックしたとき
            infoWindow.open(map, marker); // 吹き出しの表示
        });

    }

    // 現在地のアイコンを表示
    function CurrentPositionMarker(pyrmont) {
        var image = 'http://i.stack.imgur.com/orZ4x.png';
        var marker = new google.maps.Marker({
            position: pyrmont,
            map: map,
            icon: image
        });
        marker.setMap(map);
    }

    // 周辺のカフェを検索
    function nearbysearch(pyrmont) {
        var request = {
            location: pyrmont,
            radius: '1500',
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
                        origin: pyrmont, // スタート地点
                        destination: latlng, // ゴール地点
                        travelMode: google.maps.DirectionsTravelMode.WALKING, // 移動手段
                    };
                    directionsService.route(request, function (response, status) {
                        if (status === google.maps.DirectionsStatus.OK) {
                            new google.maps.DirectionsRenderer({
                                map: map,
                                directions: response,
                                center: pyrmont,
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
});