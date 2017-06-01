<div id="map">
       <script>
            var customLabel = {
                restaurant: {
                    label: 'R'
                },
                bar: {
                    label: 'B'
                },
                pub: {
                    label: 'P'
                }
            };

            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                  center: new google.maps.LatLng(52.210498, 0.13293841),
                  zoom: 13
                });
                var infoWindow = new google.maps.InfoWindow;

                // Change this depending on the name of your PHP or XML file
                downloadUrl('/MapXML.php', function(data) {
                    var xml = data.responseXML;
                    var markers = xml.documentElement.getElementsByTagName('marker');
                    Array.prototype.forEach.call(markers, function(markerElem) {
                        var id = markerElem.getAttribute('id');
                        var name = markerElem.getAttribute('name');
                        var address = markerElem.getAttribute('address');
                        var web = markerElem.getAttribute('web');
                        var type = markerElem.getAttribute('type');
                        var point = new google.maps.LatLng(
                          parseFloat(markerElem.getAttribute('lat')),
                          parseFloat(markerElem.getAttribute('lng')));
                        
                        //var infowincontent = ('<p><b><a href="'+ web+'" target="_blank">' + name + '</a></b><br />' + address);
                        var infowincontent = ('<p><b><a href="/publist?pubid=' + id+'">' + name + '</a></b><br />' + address);
                        
                        var icon = customLabel[type] || {};
                        var marker = new google.maps.Marker({
                            map: map,
                            position: point,
                            label: icon.label
                        });
                        marker.addListener('click', function() {
                            infoWindow.setContent(infowincontent);
                            infoWindow.open(map, marker);
                        });
                    });
                });
            }



            function downloadUrl(url, callback) {
                var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

                request.onreadystatechange = function() {
                    if (request.readyState == 4) {
                        request.onreadystatechange = doNothing;
                        callback(request, request.status);
                    }
                };

                request.open('GET', url, true);
                request.send(null);
            }

            function doNothing() {}
        </script>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGfT-qPgBGBOdTbFS5Au9WtHK2XQ23dWg&callback=initMap">
        </script>
    </div>