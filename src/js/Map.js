const loadGoogleMapsApi = require('load-google-maps-api');

export class Map {
  static loadGoogleMapsApi() {
    return loadGoogleMapsApi({ key: process.env.API_KEY });
  }
  static createMap(googleMaps, mapElement) {
    return new google.maps.Map(mapElement, {
      center: { lat: 45.569858, lng: -73.6391385 },
      zoom: 10,
      mapTypeControl: false,
      zoomControl: false,
      streetViewControl: false,
      fullscreenControl: false
    });
  }
}
