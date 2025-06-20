<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Fasum</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #map {
            height: 400px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ccc;
        }
    </style>
    
</head>
<body>

    <h2>Peta Fasilitas Umum</h2>
    <div id="map"></div>

    <h2>Daftar Fasum</h2>
        <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fasums as $index => $fasum)
            <tr>
                <td>{{ $fasums->firstItem() + $index }}</td>
                <td>{{ $fasum->nama }}</td>
                <td>{{ $fasum->kategori }}</td>
                <td>{{ $fasum->latitude }}</td>
                <td>{{ $fasum->longitude }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-3">
           {{ $fasums->links('pagination::bootstrap-5') }}
        </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([-6.8602316, 107.9055812], 11); // pusatkan ke Jakarta default

        // Tambahkan layer peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Data marker dari Laravel
        var fasums = @json($fasums->items());

        // Tambahkan marker ke peta
        fasums.forEach(function(fasum) {
            if (fasum.latitude && fasum.longitude) {
                var marker = L.marker([fasum.latitude, fasum.longitude]).addTo(map);
                marker.bindPopup("<strong>" + fasum.nama + "</strong><br>" + fasum.kategori);
            }
        });
    </script>

</body>
</html>
