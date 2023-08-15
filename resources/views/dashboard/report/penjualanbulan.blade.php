<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LAPORAN PENJUALAN Per Bulan CVBRV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <style type="text/css">
        header .nohp, header h1 {
            text-align : center;
            line-height: 0.5rem
        }

        header p {
            text-align : center;
        }

        h1, h3 {
            text-align : center;
        }

        table {
            width: 100%; /* Lebar tabel mengisi seluruh lebar kontainer */
            border-collapse: collapse; /* Menggabungkan garis-garis tepi sel */
        }

        th, td {
            padding: 8px; /* Padding pada sel untuk memberikan ruang di dalamnya */
            border: 1px solid black; /* Tambahkan garis tepi sel */
        }

        th {
            background-color: #f2f2f2; /* Warna latar belakang untuk header */
        }

        /* Pengaturan sel "Penjualan di Bulan" menjadi lebih lebar */
        th[colspan="2"], td[colspan="2"] {
            width: 30%; /* Ubah nilai lebar sesuai kebutuhan */
        }

        .kopsurat {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #000;
        }

        .image {
            flex-basis: 25%; /* Bagian gambar akan mengambil 25% lebar kontainer */
            padding-right: 20px; /* Tambahkan padding agar ada jarak antara gambar dan teks */
        }

        .image img {
            max-width: 100%;
            height: auto;
        }

        .title {
            flex-basis: 75%; /* Bagian judul dan teks akan mengambil 75% lebar kontainer */
        }

        .title h2 {
            font-size: 24px;
            margin: 0;
        }

        .nohp {
            font-size: 16px;
            margin: 5px 0;
        }

        .title p {
            font-size: 16px;
            margin: 0;
            line-height: 1.2;
        }

      
    </style>
</head>
<body class="A4">
    <section class="sheet padding-10mm">
    <header class="kopsurat" >
        <div class="image" width="25%">
            <img src="{{asset('assets/img/CV BERKAT REZEKI YOSEV.png')}}"></img>
        </div>
        <div class="title">
            <h1>CV. BERKAT REZEKI YOSEV</h1>
            <p class="nohp">No Hp: 083184206039</p>
            <p>Perumahan Mulya Asri 2 Blok E7 Kampung Baru Nan XX, Kecamatan Lubuk Begalung <br>Padang, Sumatera Barat</br></p>
        </div>
        
    </header>

        <h3>LAPORAN PENJUALAN CV BERKAT REZEKI YOSEV</h3>
        @php
        
        @endphp
            <h5>Bulan {{$namaBulan}} </h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th colspan="2">No Nota</th>
                            <th colspan="2">Tanggal Faktur</th>
                            <th colspan="2">Nama Toko</th>
                            <th colspan="1">Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalKeseluruhan = 0;
                            $index = 1;
                        @endphp
                        @foreach($fakturs as $item)
                        <tr>
                            <td class="text-center" width="20">{{$index}}</td>
                            <td colspan="2">{{ $item['nonota']}}</td>
                            <td colspan="2">{{ $item['tglfaktur']}}</td>
                            <td colspan="2">{{ $item['namatoko']}}</td>
                            <td colspan="1">{{ $item['total']}}</td>
                        </tr>
                            @php
                                $totalKeseluruhan += $item['total'];
                                $index++; // Increment index for the next row
                            @endphp
                        @endforeach
                            <tr>
                                <td colspan="7" style="text-align: right;">Total Keseluruhan</td>
                                <td colspan="1">{{ $totalKeseluruhan }}</td>
                            </tr>
                    </tbody>
                </table>
                 @php
                    $totalTahunIni = 0;
                    foreach($fakturs as $item){
                        $totalTahunIni += $item['total'];
                    }

                @endphp
                <p>Total Penjualan Tahun adalah : Rp. {{$totalTahunIni}}</p>

    </section>
</body>
</html>
<!-- Tambahkan bagian ini di bagian bawah tampilan Anda -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
