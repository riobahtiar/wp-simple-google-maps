function initMap(){const a={lat:parseFloat(wpsgmVar.lat),lng:parseFloat(wpsgmVar.long)},o=new google.maps.Map(document.getElementById("wpsgm"),{zoom:parseInt(wpsgmVar.zoom),center:a});new google.maps.Marker({position:a,map:o})}