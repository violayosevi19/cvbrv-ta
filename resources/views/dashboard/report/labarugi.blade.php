<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LAPORAN CVBRV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <style type="text/css">
        @page {
            size: A4 portrait; /* Pengaturan ukuran halaman dan orientasi potret */
            margin: 10mm; /* Margin halaman */
        }

        .variabel-total-keluar, .total-keluar {
            padding: 8px;
            text-align: center;
            color: #C70039;
            width: 50%; /* Tambahkan properti lebar */
            font-size: 10px; /* Ganti ukuran font jika diperlukan */
        }

        /* Untuk mengurangi margin atau padding jika perlu */
        .kopsurat, .container {
            margin: 0; /* Coba ganti margin menjadi 0 */
            padding: 10px; /* Coba kurangi padding */
        }
        header .nohp, header h1 {
            text-align : center;
            line-height: 0.5rem
        }

        body {
            font-size: 12px;
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

        @media print {
            /* Mengatur tampilan halaman cetak */
            body {
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 800px;
                margin: 0;
                padding: 0;
            }

            .sheet {
                page-break-before: always; /* Memisahkan setiap halaman */
            }

            /* Mengatur tampilan header kopsurat pada setiap halaman */
            .kopsurat {
                display: flex;
                align-items: center;
                border-bottom: 1px solid #000;
            }

            .image {
                flex-basis: 25%;
                padding-right: 20px;
            }

            .image img {
                max-width: 100%;
                height: auto;
            }

            .title {
                flex-basis: 75%;
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
    <h1>Tahun 2023</h1>
    <h2>CV. BERKAT REZEKI YOSEV</h2>
    @php
    setlocale(LC_TIME, 'id_ID'); // Set locale ke bahasa Indonesia
    $bulan = [];
    $penjualanPerBulan = [];

    foreach ($labarugi as $item) {
        $bulan[] = strftime('%B', strtotime($item->tglmulai));
        $penjualanPerBulan[strftime('%B', strtotime($item->tglmulai))][] = $item;
    }

    // Menghapus nilai duplikat dari array bulan (jika diperlukan)
    $bulan = array_unique($bulan);

    $totalLabaTahun = collect($labarugi)->sum('laba_setelah_pajak');
    $totalRugiTahun = collect($labarugi)->sum('rugi_setelah_pajak');
@endphp

<section>
    <h3>Laba Per Bulan</h3>
    <table>
        @foreach($bulan as $namaBulan)
            @php
                $totalLabaBulan = 0;
                $totalRugiBulan = 0;
            @endphp
            @foreach($penjualanPerBulan[$namaBulan] ?? [] as $item)
                @if($item->laba_setelah_pajak >= 0)
                    @php $totalLabaBulan += $item->laba_setelah_pajak; @endphp
                @else
                    @php $totalRugiBulan += $item->rugi_setelah_pajak; @endphp
                @endif
            @endforeach
            <tr>
                <td class="variabel">Bulan {{ $namaBulan }}</td>
                <td class="nominal">
                    @if($totalLabaBulan > 0)
                        Rp{{ number_format($totalLabaBulan, 0, ',', '.') }}
                    @else
                        Rp{{ number_format($totalRugiBulan, 0, ',', '.') }}
                    @endif
                </td>
            </tr>
        @endforeach
        <tr>
            <td class="variabel-total"><strong>Total Laba Kotor</strong></td>
            <td class="total">
                Rp{{ number_format($totalLabaTahun, 0, ',', '.') }}
            </td>
        </tr>
    </table>
</section>

<section>
    <h3>Rugi Per Bulan</h3>
    <table>
        @foreach($bulan as $namaBulan)
            @php
                $totalRugiBulan = 0;
            @endphp
            @foreach($penjualanPerBulan[$namaBulan] ?? [] as $item)
                @php $totalRugiBulan += $item->rugi_setelah_pajak; @endphp
            @endforeach
            <tr>
                <td class="variabel">Bulan {{ $namaBulan }}</td>
                <td class="nominal">
                    Rp{{ number_format($totalRugiBulan, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td class="variabel-total"><strong>Total Rugi Kotor</strong></td>
            <td class="total">
                Rp{{ number_format($totalRugiTahun, 0, ',', '.') }}
            </td>
        </tr>
    </table>
    <table class="hasil-akhir">
        <tr style="font-weight:bold;">
            @if($totalLabaTahun >  $totalRugiTahun )
                <td class="variabel">Penghasilan Bersih (laba)</td>
                <td class="nominal">Rp{{ number_format($totalLabaTahun-$totalRugiTahun, 0, ',', '.') }} </td>
            @elseif($totalLabaTahun <  $totalRugiTahun )
                <td class="variabel">Penghasilan Bersih (Rugi)</td>
                <td class="nominal">Rp{{ number_format($totalRugiTahun-$totalLabaTahun, 0, ',', '.') }} </td>
            @else
                <td class="variabel">Laba/Rugi Bersih</td>
                <td class="nominal">Rp{{ number_format(0, 0, ',', '.') }} </td>
            @endif
        </tr>
    </table>
</section>
  
    </section>
</body>
</html>