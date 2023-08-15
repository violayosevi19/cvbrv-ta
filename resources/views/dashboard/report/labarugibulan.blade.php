<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LAPORAN PENJUALAN CVBRV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <style type="text/css">
        header .nohp, header h1 {
            text-align : center;
            line-height: 0.5rem
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        h1, h2, p {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .variabel {
           
            padding: 8px;
            text-align: left;
        }

        .nominal, .total, .total-keluar {
            padding: 8px;
            text-align: right;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:last-child {
            background-color: #ddd;
        }

        tr:last-child td {
            font-weight: bold;
        }

        th, td {
            width: 50%;
        }

        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .subtitle {
            font-size: 18px;
            margin-bottom: 10px;
            margin-top: 30px;
        }
        .date-range {
            margin-bottom: 10px;
        }

        .variabel-laba-kotor, .laba-kotor{
            padding:8px;
            text-align:center;
        }

        .variabel-total {
            padding: 8px;
            text-align: center;
            color:#4477CE;
        }

         .total {
             color:#4477CE;
         }

         .variabel-total-keluar {
            padding: 8px;
            text-align: center;
            color:#C70039;
        }

         .total-keluar {
             color:#C70039;
         }

         .hasil-akhir {
            margin-top:2rem;
         }

         .variabel-laba-rugi, .value-laba-rugi{
            color:#17594A;
            padding:8px;
            text-align:center;
         }

        /* CSS untuk header kopsurat */
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
            <h2>CV. BERKAT REZEKI YOSEV</h2>
            <p class="nohp">No Hp: 083184206039</p>
            <p>Perumahan Mulya Asri 2 Blok E7 Kampung Baru Nan XX, Kecamatan Lubuk Begalung <br>Padang, Sumatera Barat</br></p>
        </div>
        
    </header>

    <div class="container">
        <h1>Laporan Laba Rugi</h1>
        <h1>Bulan {{ $namaBulan }}</h1>
        <h2>CV. BERKAT REZEKI YOSEV</h2>
        <h3>Pendapatan</h3>
        <table>
            <tr>
                <td class="variabel">Modal</td>
                <td class="nominal">Rp{{ number_format($labarugi->modal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="variabel">Penjualan Bersih</td>
                <td class="nominal">Rp{{ number_format($totalPenjualan, 0, ',', '.') }}</td>
            </tr>
            <!-- Add more rows for other income and expense items -->
            <tr>
                <td class="variabel-total"><strong>Pendapatan Kotor</strong></td>
                <td class="total"><strong>Rp{{ number_format( $labarugi->modal + $totalPenjualan, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
        <h3>Pengeluaran</h3>
        <table>
            <tr>
                <td class="variabel">Gaji Karyawan</td>
                <td class="nominal">Rp{{ number_format($labarugi->gajikaryawan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="variabel">Biaya Operasional</td>
                <td class="nominal">Rp{{ number_format($labarugi->biayaoperasional, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="variabel">Biaya Listrik</td>
                <td class="nominal">Rp{{ number_format($labarugi->biayalistrik, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="variabel">Biaya ATK</td>
                <td class="nominal">Rp{{ number_format($labarugi->biayaATK, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="variabel">Biaya Internet/Wifi</td>
                <td class="nominal">Rp{{ number_format($labarugi->biayaInternet, 0, ',', '.') }}</td>
            </tr>
            @php
             $pengeluaranKotor = 0;
             $labaKotor = 0;
             $rugikotor = 0;
             $result= 0;
             $pajak = 0;
             $pendapatanKotor = $labarugi->modal + $totalPenjualan;
             $pengeluaranKotor = $labarugi->gajikaryawan + 
                    $labarugi->biayaoperasional + $labarugi->biayalistrik + $labarugi->biayaATK + $labarugi->biayainternet;
             if($pendapatanKotor > $pengeluaranKotor){
                $labaKotor = $pendapatanKotor - $pengeluaranKotor;
                $pajak = 10 * $labaKotor / 100;
                $result = $labaKotor-$pajak;
             } else if($pendapatanKotor < $pengeluaranKotor){
                $rugikotor = $pengeluaranKotor - $pendapatanKotor;
                $pajak = 10 * $rugikotor / 100;
                $result = $rugikotor-$pajak;

             }
            
            @endphp
            <!-- Add more rows for other income and expense items -->
            <tr>
                <td class="variabel-total-keluar"><strong>Pengeluaran</strong></td>
                <td class="total-keluar"><strong>Rp{{ number_format($pengeluaranKotor, 0, ',', '.') }}</strong></td>
            </tr>
        </table>

        <table class="hasil-akhir">
            <tr style="font-weight:bold;">
            @if($pendapatanKotor > $pengeluaranKotor)
                <td class="variabel">Laba Kotor</td>
                <td class="nominal">Rp{{ number_format($labaKotor, 0, ',', '.') }} </td>
            @elseif($pendapatanKotor < $pengeluaranKotor)
                 <td class="variabel">Rugi Kotor</td>
                <td class="nominal">Rp{{ number_format($rugikotor, 0, ',', '.') }} </td>
            @endif
            </tr>
            <tr style="font-weight:bold;">
                <td class="variabel">Pajak 10%</td>
                <td class="nominal">Rp{{ number_format($pajak, 0, ',', '.') }}</td>
            </tr>
            <!-- Add more rows for other income and expense items -->
            <tr>
            @if($pendapatanKotor > $pengeluaranKotor)
                <td class="variabel-laba-rugi"><strong>Laba Bersih</strong></td>
                <td class="value-laba-rugi"><strong>Rp{{ number_format($result, 0, ',', '.') }}</strong></td>
            @elseif($pendapatanKotor < $pengeluaranKotor)
                <td class="variabel-laba-rugi"><strong>Rugi Bersih</strong></td>
                <td class="value-laba-rugi"><strong>Rp{{ number_format($result, 0, ',', '.') }}</strong></td>
            @endif
            </tr>
        </table>
        
    </div>
               
    </section>
</body>
</html>