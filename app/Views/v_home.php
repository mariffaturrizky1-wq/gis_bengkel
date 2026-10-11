<?php
$Bengkel = $Bengkel ?? [];
?>

<style>
.bk-ui{
    --bk-primary:#0f766e;
    --bk-primary-dark:#0b4f4a;
    --bk-primary-soft:#e6f4f2;
    --bk-accent:#f59e0b;
    --bk-accent-2:#ea580c;
    --bk-ink:#1e293b;
    --bk-ink-soft:#64748b;
    --bk-bg:#f1f5f9;
    --bk-surface:#ffffff;
    --bk-border:#e2e8f0;
    --bk-dark:#0f172a;
    font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;
    color:var(--bk-ink);
}
.bk-ui *{ box-sizing:border-box; }
.bk-heading{ font-family:'Space Grotesk','Inter',sans-serif; font-weight:700; letter-spacing:-0.01em; }

.bk-map-shell{ position:relative; border-radius:14px; overflow:hidden; box-shadow:0 6px 20px -10px rgba(15,23,42,.35); }
#map{ width:100%; height:730px; }

/* Floating search box */
.bk-map-search{
    position:absolute; top:14px; left:14px; z-index:1000;
    background:var(--bk-surface); border-radius:10px; box-shadow:0 4px 14px -6px rgba(15,23,42,.35);
    padding:6px 10px; display:flex; align-items:center; gap:8px;
    width:min(300px, 70vw);
}
.bk-map-search i{ color:var(--bk-ink-soft); }
.bk-map-search input{
    border:none; outline:none; font-size:.88rem; width:100%; color:var(--bk-ink);
    font-family:'Inter',sans-serif;
}
.bk-search-results{
    position:absolute; top:52px; left:14px; z-index:1000;
    background:var(--bk-surface); border-radius:10px; box-shadow:0 4px 14px -6px rgba(15,23,42,.35);
    width:min(300px, 70vw); max-height:260px; overflow-y:auto; display:none;
}
.bk-search-results.show{ display:block; }
.bk-search-item{ padding:9px 12px; font-size:.83rem; cursor:pointer; border-bottom:1px solid var(--bk-border); }
.bk-search-item:last-child{ border-bottom:none; }
.bk-search-item:hover{ background:var(--bk-primary-soft); }
.bk-search-item .nm{ font-weight:600; color:var(--bk-ink); display:block; }
.bk-search-item .al{ color:var(--bk-ink-soft); font-size:.75rem; }

/* Legend / filter panel */
.bk-legend{
    position:absolute; top:14px; right:14px; z-index:1000;
    background:var(--bk-surface); border-radius:12px; box-shadow:0 4px 14px -6px rgba(15,23,42,.35);
    width:210px; overflow:hidden;
}
.bk-legend-head{
    background:var(--bk-dark); color:#fff; padding:9px 12px; font-size:.8rem; font-weight:700;
    display:flex; align-items:center; gap:6px; cursor:pointer;
}
.bk-legend-head span{ flex:1; }
.bk-legend-body{ padding:8px 10px; max-height:260px; overflow-y:auto; }
.bk-legend-item{ display:flex; align-items:center; gap:8px; padding:5px 2px; font-size:.8rem; }
.bk-legend-item img{ width:18px; height:18px; object-fit:contain; }
.bk-legend-item label{ margin:0; flex:1; cursor:pointer; color:var(--bk-ink); }
.bk-legend-empty{ font-size:.78rem; color:var(--bk-ink-soft); padding:6px 2px; font-style:italic; }

/* popup styling */
.leaflet-popup-content-wrapper{ border-radius:10px; }
.bk-popup .title{ font-weight:700; font-family:'Space Grotesk',sans-serif; margin-bottom:2px; color:var(--bk-primary-dark); }
.bk-popup .addr{ font-size:.8rem; color:var(--bk-ink-soft); margin-bottom:4px; }
.bk-popup .tag{
    display:inline-block; background:var(--bk-primary-soft); color:var(--bk-primary-dark);
    font-size:.7rem; font-weight:600; padding:2px 8px; border-radius:20px;
}

/* Bengkel Terdekat */
.bk-nearby-btn{
    position:absolute;
    bottom:30px;
    right:14px;
    z-index:1000;
}
.bk-nearby-panel{
    position:absolute;
    bottom:72px;
    right:14px;
    z-index:1000;
    background:var(--bk-surface); border-radius:12px;
    box-shadow:0 4px 14px -6px rgba(15,23,42,.35);
    width:280px; max-height:350px; overflow-y:auto; display:none;
}
.bk-nearby-panel.show{ display:block; }
.bk-nearby-head{
    background:var(--bk-dark); color:#fff; padding:9px 12px;
    font-size:.8rem; font-weight:700; border-radius:12px 12px 0 0;
    display:flex; align-items:center; justify-content:space-between;
}
.bk-nearby-close{
    cursor:pointer; opacity:.7; font-size:.9rem; line-height:1;
}
.bk-nearby-close:hover{ opacity:1; }
.bk-nearby-item{
    padding:9px 12px; border-bottom:1px solid var(--bk-border);
    font-size:.82rem; cursor:pointer;
}
.bk-nearby-item:hover{ background:var(--bk-primary-soft); }
.bk-nearby-item:last-child{ border-bottom:none; }
.bk-nearby-item .nm{ font-weight:600; color:var(--bk-ink); display:block; }
.bk-nearby-item .jarak{ color:var(--bk-accent-2); font-size:.75rem; font-weight:600; }
.bk-nearby-item .al{ color:var(--bk-ink-soft); font-size:.75rem; }

/* Fallback pin */
.bk-pin-fallback{
    width:28px; height:28px; border-radius:50% 50% 50% 0;
    background:#0f766e; border:2px solid #fff;
    box-shadow:0 2px 6px rgba(0,0,0,.35);
    transform:rotate(-45deg);
}
.bk-pin-fallback::after{
    content:''; display:block; width:8px; height:8px;
    background:#fff; border-radius:50%;
    margin:8px auto 0;
    transform:rotate(45deg);
}
</style>

<div class="bk-ui">
    <div class="bk-map-shell">
        <div id="map"></div>

        <!-- Search -->
        <div class="bk-map-search">
            <i class="fas fa-search"></i>
            <input type="text" id="bkSearchInput" placeholder="Cari nama bengkel...">
        </div>
        <div class="bk-search-results" id="bkSearchResults"></div>

        <!-- Legend / filter -->
        <div class="bk-legend" id="bkLegend">
            <div class="bk-legend-head" onclick="document.getElementById('bkLegendBody').classList.toggle('d-none')">
                <span><i class="fas fa-layer-group mr-1"></i> Kategori Bengkel</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="bk-legend-body" id="bkLegendBody"></div>
        </div>

        <!-- Bengkel Terdekat -->
        <div class="bk-nearby-btn">
            <button class="btn btn-sm fw-bold text-white"
                    style="background:#ff6600; border:none; border-radius:8px; padding:8px 14px;"
                    onclick="cariBengkelTerdekat()">
                <i class="fas fa-location-crosshairs"></i> Bengkel Terdekat
            </button>
        </div>
        <div class="bk-nearby-panel" id="bkNearbyPanel">
            <div class="bk-nearby-head">
                <span><i class="fas fa-map-pin mr-1"></i> Bengkel Terdekat dari Lokasi Anda</span>
                <span class="bk-nearby-close" onclick="document.getElementById('bkNearbyPanel').classList.remove('show')">✕</span>
            </div>
            <div id="bkNearbyList"></div>
        </div>
    </div>
</div>

<script>
var peta1 = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
});
var peta2 = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenTopoMap'
});
var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap HOT'
});
var peta4 = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}.png', {
    attribution: '&copy; Stadia Maps'
});

const map = L.map('map', {
    center: [<?= $web['coordinat_wilayah'] ?>],
    zoom: <?= $web['zoom_view'] ?>,
    layers: [peta1]
});

const baseMaps = {
    'OpenStreetMap': peta1,
    'Topo Map': peta2,
    'HOT Map': peta3,
    'Stadia Map': peta4
};
L.control.layers(baseMaps).addTo(map);
L.control.scale({ imperial: false }).addTo(map);

// ---- Wilayah polygons ----
<?php foreach ($Wilayah as $key => $value) { ?>
    L.geoJSON(<?= $value['geojson'] ?>, {
        fillColor: '<?= $value['warna'] ?>',
        fillOpacity: 0.5,
    }).bindPopup("<b><?= $value['nama_wilayah'] ?></b>").addTo(map);
<?php } ?>

// ---- Helper: tebak file marker dari nama/kategori ----
function tebaKMarker(namaBengkel, kategori) {
    var nama = (namaBengkel || '').toLowerCase();
    var kat  = (kategori   || '').toLowerCase();

    // Cek kategori dulu (lebih reliable)
    if (kat.includes('motor'))  return 'motor.png';
    if (kat.includes('mobil'))  return 'mobil.png';
    if (kat.includes('truk') || kat.includes('truck')) return 'mobil.png';

    // Fallback tebak dari nama
    if (nama.includes('motor'))  return 'motor.png';
    if (nama.includes('mobil'))  return 'mobil.png';
    if (nama.includes(' ac ')  || nama.endsWith(' ac')) return 'mobil.png';
    if (nama.includes('sparepart') || nama.includes('variasi')) return 'motor.png';

    return null; // benar-benar tidak bisa ditebak
}

// ---- Helper: buat Leaflet icon ----
function bkIcon(markerFile, namaBengkel, kategori) {
    // Kalau marker dari DB ada, pakai langsung
    var file = markerFile;

    // Kalau null/kosong, coba tebak
    if (!file) {
        file = tebaKMarker(namaBengkel, kategori);
    }

    if (file) {
        return L.icon({
            iconUrl: '<?= base_url('marker/') ?>' + file,
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -28]
        });
    }

    // Benar-benar tidak ada → pin fallback
    return L.divIcon({
        html: '<div class="bk-pin-fallback"></div>',
        className: '',
        iconSize: [28, 28],
        iconAnchor: [14, 28],
        popupAnchor: [0, -26]
    });
}

// ---- Bengkel markers ----
var bengkelData = <?= json_encode($Bengkel) ?>;
var kategoriLayers = {};
var allMarkers = [];

bengkelData.forEach(function(b) {
    if (!b.latitude || !b.longitude) return;

    var kategoriName = b.kategori || 'Lainnya';

    if (!kategoriLayers[kategoriName]) {
        kategoriLayers[kategoriName] = L.layerGroup().addTo(map);
    }

    var marker = L.marker([parseFloat(b.latitude), parseFloat(b.longitude)], {
        icon: bkIcon(b.marker, b.nama_bengkel, b.kategori)
    });

    var popupHtml = '<div class="bk-popup">'
        + '<div class="title">' + (b.nama_bengkel || 'Bengkel') + '</div>'
        + '<div class="addr">' + (b.alamat || '') + '</div>'
        + '<span class="tag">' + kategoriName + '</span>'
        + (b.telp ? '<div class="addr mt-1"><i class="fas fa-phone-alt"></i> ' + b.telp + '</div>' : '')
        + '</div>';

    marker.bindPopup(popupHtml);
    marker.addTo(kategoriLayers[kategoriName]);
    allMarkers.push({ marker: marker, nama_bengkel: b.nama_bengkel || '', alamat: b.alamat || '' });
});

// ---- Legend / filter panel ----
var legendBody  = document.getElementById('bkLegendBody');
var kategoriKeys = Object.keys(kategoriLayers);

if (kategoriKeys.length === 0) {
    legendBody.innerHTML = '<div class="bk-legend-empty">Belum ada data bengkel.</div>';
} else {
    kategoriKeys.sort().forEach(function(name, idx) {
        var id  = 'bkCat' + idx;
        var row = document.createElement('div');
        row.className = 'bk-legend-item';
        row.innerHTML = '<input type="checkbox" id="' + id + '" checked> <label for="' + id + '">' + name + '</label>';
        legendBody.appendChild(row);
        row.querySelector('input').addEventListener('change', function(e) {
            if (e.target.checked) map.addLayer(kategoriLayers[name]);
            else map.removeLayer(kategoriLayers[name]);
        });
    });
}

// ---- Search ----
var searchInput   = document.getElementById('bkSearchInput');
var searchResults = document.getElementById('bkSearchResults');

searchInput.addEventListener('input', function() {
    var q = this.value.trim().toLowerCase();
    if (!q) { searchResults.classList.remove('show'); searchResults.innerHTML = ''; return; }

    var matches = allMarkers.filter(function(m) {
        return m.nama_bengkel.toLowerCase().indexOf(q) !== -1;
    }).slice(0, 8);

    if (matches.length === 0) {
        searchResults.innerHTML = '<div class="bk-search-item"><span class="al">Tidak ditemukan</span></div>';
    } else {
        searchResults.innerHTML = matches.map(function(m, idx) {
            return '<div class="bk-search-item" data-idx="' + idx + '">'
                + '<span class="nm">' + m.nama_bengkel + '</span>'
                + '<span class="al">' + m.alamat + '</span>'
                + '</div>';
        }).join('');
        searchResults.querySelectorAll('.bk-search-item').forEach(function(el, idx) {
            el.addEventListener('click', function() {
                var m = matches[idx];
                map.setView(m.marker.getLatLng(), 16);
                m.marker.openPopup();
                searchResults.classList.remove('show');
                searchInput.value = m.nama_bengkel;
            });
        });
    }
    searchResults.classList.add('show');
});

document.addEventListener('click', function(e) {
    if (!searchResults.contains(e.target) && e.target !== searchInput) {
        searchResults.classList.remove('show');
    }
});

// ---- Bengkel Terdekat ----
var userMarker = null;

function cariBengkelTerdekat() {
    if (!navigator.geolocation) {
        alert('Browser kamu tidak mendukung geolocation.');
        return;
    }
    navigator.geolocation.getCurrentPosition(function(pos) {
        var lat = pos.coords.latitude;
        var lng = pos.coords.longitude;

        if (userMarker) map.removeLayer(userMarker);
        userMarker = L.marker([lat, lng], {
            icon: L.divIcon({
                html: '<div style="background:#ff6600;width:14px;height:14px;border-radius:50%;border:2px solid #fff;box-shadow:0 0 6px rgba(0,0,0,.4)"></div>',
                className: '',
                iconAnchor: [7, 7]
            })
        }).addTo(map).bindPopup('📍 Lokasi Anda').openPopup();
        map.setView([lat, lng], 14);

        fetch('<?= base_url('api/bengkel/terdekat') ?>?lat=' + lat + '&lng=' + lng + '&radius=5000')
            .then(function(res) { return res.json(); })
            .then(function(json) {
                var list  = document.getElementById('bkNearbyList');
                var panel = document.getElementById('bkNearbyPanel');
                panel.classList.add('show');

                if (!json.data || json.data.length === 0) {
                    list.innerHTML = '<div class="bk-nearby-item"><span class="al">Tidak ada bengkel dalam radius 5km.</span></div>';
                    return;
                }

                list.innerHTML = json.data.map(function(b, i) {
                    var jarak     = parseFloat(b.jarak_meter);
                    var jarakText = jarak >= 1000
                        ? (jarak / 1000).toFixed(1) + ' km'
                        : Math.round(jarak) + ' m';
                    return '<div class="bk-nearby-item" onclick="focusBengkel(' + i + ')">'
                        + '<span class="nm">' + (i + 1) + '. ' + b.nama_bengkel + '</span>'
                        + '<span class="jarak"><i class="fas fa-route"></i> ' + jarakText + '</span>'
                        + '<span class="al">' + b.alamat + '</span>'
                        + '</div>';
                }).join('');

                window._nearbyData = json.data;
            })
            .catch(function() {
                alert('Gagal mengambil data bengkel terdekat.');
            });
    }, function() {
        alert('Izin lokasi ditolak. Aktifkan GPS/lokasi di browser kamu.');
    });
}

function focusBengkel(idx) {
    var b = window._nearbyData[idx];
    if (!b || !b.coordinat) return;
    var coords = b.coordinat.split(',');
    var lat = parseFloat(coords[0]);
    var lng = parseFloat(coords[1]);
    map.setView([lat, lng], 17);
    allMarkers.forEach(function(m) {
        if (m.nama_bengkel === b.nama_bengkel) {
            m.marker.openPopup();
        }
    });
}
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">