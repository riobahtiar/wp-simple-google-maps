// Initialize Google Maps
function initMap() {
    const markerPosition = {lat: wpsgmVar.lat, lng: wpsgmVar.long};
    const map = new google.maps.Map(document.getElementById("wpsgm"), {
        zoom: wpsgmVar.zoom,
        center: markerPosition,
    });
    const marker = new google.maps.Marker({
        position: markerPosition,
        map: map,
    });
}