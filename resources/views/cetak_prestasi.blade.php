<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Prestasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header-container {
            text-align: center;
            margin-top: 20px;
        }

        .header-container img {
            margin: 0 10px;
            display: inline-block;
            width: 60px;
            height: 60px;
        }

        .header-container p {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
        }

        .table-container {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        td {
            background-color: #fff;
        }

        @media print {
        body {
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .header-container {
            text-align: center;
            margin: 10px 0 !important;
        }

        .header-container img {
            max-width: 50px;
            max-height: 50px;
        }

        .table-container {
            margin: 0 !important;
            padding: 0 10px !important;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid black; 
        }

        th, td {
            padding: 6px;
            border: 1px solid black; 
            text-align: left;
            vertical-align: middle;
            background-color: #ffffff; 
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
            border-bottom: 2px solid black; 
        }

        tr {
            page-break-inside: avoid;
        }

        th:first-child, td:first-child {
            border-left: 1px solid black; 
        }

        th:last-child, td:last-child {
            border-right: 1px solid black; 
        }

        tr:last-child td {
            border-bottom: 1px solid black; 
        }
    }
    </style>
</head>
<body>

<div class="container">
    <div class="header-container">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
        <img src="{{ asset('img/smp.png') }}" alt="SMP">
        <p>Laporan Prestasi Mahasiswa</p>
    </div>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Juara</th>
                    <th>Lomba</th>
                    <th>Penyelenggara</th>
                    <th>Tingkat</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kejuaraan as $index => $prestasi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $prestasi->nama }}</td>
                    <td>{{ $prestasi->nisn }}</td>
                    <td>{{ $prestasi->kelas }}</td>
                    <td>{{ $prestasi->juara }}</td>
                    <td>{{ $prestasi->lomba }}</td>
                    <td>{{ $prestasi->penyelenggara }}</td>
                    <td>{{ $prestasi->tingkat }}</td>
                    <td>{{ \Carbon\Carbon::parse($prestasi->tanggal)->translatedFormat('d F Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Otomatis memunculkan dialog cetak saat halaman dimuat
    window.onload = function() {
        window.print();
    };
</script>

</body>
</html>
