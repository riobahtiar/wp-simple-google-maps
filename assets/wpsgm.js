// Initialize Google Maps
function initMap() {
    const markerPosition = {lat: parseFloat(wpsgmVar.lat), lng: parseFloat(wpsgmVar.long)};
    const map = new google.maps.Map(document.getElementById("wpsgm"), {
        zoom: parseInt(wpsgmVar.zoom),
        center: markerPosition,
    });
    const marker = new google.maps.Marker({
        position: markerPosition,
        map: map,
    });
}