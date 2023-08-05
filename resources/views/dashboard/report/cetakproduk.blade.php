<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CETAK PRODUK CVBRV</title>
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
        /* Add this CSS rule for the No column */
        .small-col,
        .small-col {
            width: 5%;
        }

        .kode-col, .harga-col {
            width: 20%;
        }

        .stok-col {
            width: 40%;
        }

        .harga-col {
            width:15%;
        }
        /* Rest of the CSS */
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

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
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

        th, td {
            width: 25%;
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

        .total-stock {
            text-align: center;
        }

      
    </style>
</head>
<body class="A4">
    <section class="sheet padding-10mm">
    <header >
        <h1>DATA BARANG</h1>
        <h2>CV. BERKAT REZEKI YOSEV</h2>
        <p class="nohp">No Hp: 083184206039</p>
        <p>Perumahan Mulya Asri 2 Blok E7 Kampung Baru Nan XX, Kecamatan Lubuk Begalung <br>Padang, Sumatera Barat</br></p>
    </header>
    <hr>
    <div class="container">
        <h1>Daftar Barang CV BRV</h1>
        <table>
            <tr>
                <th class="small-col">No</th>
                <th class="kode-col">Kode Produk</th>
                <th class="stok-col">Nama Produk</th>
                <th class="harga-col">Harga</th>
                <th>Jenis Produk</th>
            </tr>
            @php
                $totalKeseluruhan = 0;
                $index = 1;
            @endphp
            @foreach($produks as $item)
            <tr>
                <td class="small-col">{{$index}}</td>
                <td class="kode-col">{{ $item->kodeproduk }}</td>
                <td class="stok-col">{{ $item->namaproduk }}</td>
                <td class="harga-col">{{ $item->harga }}</td>
                @if($item->jenisproduk !== null)
                <td>{{ $item->jenisproduk->jenis }}</td>
                @else
                <td></td>
                @endif
            </tr>
            @php
                
                $index++; // Increment index for the next row
            @endphp
            @endforeach
        </table>
    </div>
    </section>
</body>
</html>