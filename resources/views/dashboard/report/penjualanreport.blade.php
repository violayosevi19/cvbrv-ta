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

      
    </style>
</head>
<body class="A4">
    <section class="sheet padding-10mm">
    <header >
        <h1>CV. BERKAT REZEKI YOSEV</h1>
        <p class="nohp">No Hp: 083184206039</p>
        <p>Perumahan Mulya Asri 2 Blok E7 Kampung Baru Nan XX, Kecamatan Lubuk Begalung <br>Padang, Sumatera Barat</br></p>
    </header>
    <hr>
        <h3>LAPORAN PENJUALAN CV BERKAT REZEKI YOSEV</h3>
        @php
            // Buat associative array untuk mengelompokkan data penjualan berdasarkan bulan
            $penjualanPerBulan = [];
            foreach ($penjualans as $item) {
                foreach($item['faktur'] as $faktur){
                    $tglFaktur = $faktur['tglfaktur'];
                    $bulan = date('F', strtotime($tglFaktur));
                    $penjualanPerBulan[$bulan][] = $item;
                }
 
            }
            $bulanUrutan = ['July', 'August', 'September', 'October', 'November', 'December', 'January', 'February', 'March', 'April', 'May', 'June'];
        @endphp
        @foreach($bulanUrutan as $bulan)
        @if(isset($penjualanPerBulan[$bulan]))
            <h5>Bulan {{$bulan}}</h5>
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
                        @foreach($penjualanPerBulan[$bulan] as $item)
                        <tr>
                            <td class="text-center" width="20">{{$index}}</td>
                            <td colspan="2">{{ $item['nonota']}}</td>
                            <td colspan="2">{{ $item['faktur'][0]['tglfaktur']}}</td>
                            <td colspan="2">{{ $item['namatoko']}}</td>
                            <td colspan="1">{{ $item['totalpenjualan']}}</td>
                        </tr>
                            @php
                                $totalKeseluruhan += $item['totalpenjualan'];
                                $index++; // Increment index for the next row
                            @endphp
                        @endforeach
                            <tr>
                                <td colspan="7" style="text-align: right;">Total Keseluruhan</td>
                                <td colspan="1">{{ $totalKeseluruhan }}</td>
                            </tr>
                    </tbody>
                </table>
                @endif
            @endforeach
                 @php
                    $totalTahunIni = 0;
                    foreach($penjualans as $item){
                        $totalTahunIni += $item['totalpenjualan'];
                    }

                @endphp
                <p>Total Penjualan Tahun adalah : Rp. {{$totalTahunIni}}</p>

    </section>
</body>
</html>