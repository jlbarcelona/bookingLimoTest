function initMap() {
    let stopss = 0;
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: { lat: 42.323851, lng: -71.246732 }
    });


    let locations = [];
    stopss = 0;
    document.querySelectorAll("input[id$='.lat']").forEach((latInput) => {

        let parts = latInput.id.split(".");

        let index = parts[1]; // 0, 1, 2
        let lngInput = document.getElementById(`locations.${index}.lng`);
        if (latInput.value && lngInput && lngInput.value) {
            locations.push({
                key: index,
                name: "Stop " + stopss++,
                lat: parseFloat(latInput.value),
                lng: parseFloat(lngInput.value)
            });
        }
    });

    if (locations.length === 0) return;

    // center map on first location
    map.setCenter({
        lat: locations[0].lat,
        lng: locations[0].lng
    });

    locations.forEach((loc, index) => {

        let icon = "https://maps.google.com/mapfiles/ms/icons/blue-dot.png"; // waypoint default
        let map_name  = loc.name;
        // START (first)
        if (index === 0) {
            icon = "https://maps.google.com/mapfiles/ms/icons/green-dot.png";
            map_name = 'Pickup Point';
        }

        // END (last)
        if (index === locations.length - 1) {
            icon = "https://maps.google.com/mapfiles/ms/icons/red-dot.png";
            map_name = 'Drop off location';
        }

        new google.maps.Marker({
            position: { lat: loc.lat, lng: loc.lng },
            map: map,
            title: map_name,
            icon: icon
        });
    });

    const pathCoordinates = locations.map(loc => ({
        lat: loc.lat,
        lng: loc.lng
    }));

    const pathLine = new google.maps.Polyline({
        path: pathCoordinates,
        geodesic: true,
        strokeColor: "#FF0000",
        strokeOpacity: 1.0,
        strokeWeight: 4
    });

    pathLine.setMap(map);
}

$(document).ready(function(){
    initMap();
});