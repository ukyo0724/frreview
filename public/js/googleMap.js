function initMap(){
            const target = document.getElementById('google_map');
            const address = document.getElementById('address').textContent;
            const geocoder = new window.google.maps.Geocoder();
        
            geocoder.geocode({ address: address }, function (results, status) {
            if (status === 'OK' && results[0]) {
            console.log(results);
            console.log(results[0].geometry.location.lat());
                // Map取得
                const map = new window.google.maps.Map(target, {
                    zoom: 15,
                    center: results[0].geometry.location,
                    mapTypeId: 'roadmap'
                });

                // Marker取得
                const marker = new window.google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map
                });
                console.log("here");

                // 情報ウィンドウ設定
                const latlng = new window.google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                const info = '<div class="info">' +
                    '<p>' + address + '</p>' +
                    '<p><a href="https://maps.google.co.jp/maps?q=' + latlng + '&iwloc=J" target="_blank" rel="noopener noreferrer">Googleマップで見る</a></p>' +
                    '</div>';
                var infowindow = new window.google.maps.InfoWindow({
                    content: info
                });
                

                // 情報ウィンドウ表示
                infowindow.open(map, marker);

                // クリックイベント設定
                window.google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });
            } else {
                return;
            }
        });
        }