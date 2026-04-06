<div id="map" style="width: 100%; height: 730px;"></div>
<script>
var peta1 = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
});

var peta2 = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
});

var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '© <a href="https://www.openstreetmap.org/copyright">Kontributor OpenStreetMap</a>'
	});

var peta4 = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
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