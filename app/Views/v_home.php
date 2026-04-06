<div id="map" style="width: 100%; height: 730px;"></div>
<script>

	const map = L.map('map').setView([-7.2575022267624565, 109.0062579249614], 13);

	const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

</script>