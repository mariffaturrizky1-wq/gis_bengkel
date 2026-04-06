<div id="map" style="width: 100%; height: 730px;"></div>
<script>
var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Data peta © kontributor <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Citra Â© <a href="https://www.mapbox.com/">Kotak Peta</a>',
		id: 'mapbox/streets-v11'
	});

var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Data peta © kontributor <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Citra Â© <a href="https://www.mapbox.com/">Kotak Peta</a>',
		id: 'mapbox/satellite-v9'
	});

var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '© <a href="https://www.openstreetmap.org/copyright">Kontributor OpenStreetMap</a>'
	});

var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Data peta © kontributor <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Citra Â© <a href="https://www.mapbox.com/">Kotak Peta</a>',
		id: 'mapbox/dark-v10'
	});
	//const map = L.map('map').setView([-7.2575022267624565, 109.0062579249614], 13);

	//const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	//	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	//}).addTo(map);

const map = L.map('map', {
    center: [-7.2575022267624565, 109.0062579249614],
    zoom: 12,
    layers: [peta3]
});

</script>