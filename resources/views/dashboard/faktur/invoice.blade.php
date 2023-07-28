
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style type="text/css">
        @page {
            size: A4; /* Ukuran kertas yang Anda inginkan, seperti A4 */
            margin: 0.2rem;
        }

        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

        a {
        color: #5D6975;
        text-decoration: underline;
        }

        body {
        position: relative;
        width: 21cm;  
        height: 29.7cm; 
        color: #001028;
        background: #FFFFFF; 
        font-family: Arial, sans-serif; 
        font-size: 12px; 
        font-family: Arial;
        }

        header {
        padding: 10px 0;
        margin-bottom: 30px;
        }

        #logo {
        text-align: center;
        margin-bottom: 10px;
        }

        #logo img {
        width: 90px;
        }

        h1 {
        color: #5D6975;
        font-size: 1.6em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background: url(dimension.png);
        }

       .header-faktur {
            display : grid;
            grid-row: 1fr 1fr;
       }

       .data-cv, .data-toko{
        margin-top:0.5rem;
        
       }

       .data-toko {
        display :grid;
        grid-template-columns : 1fr 1fr;
        gap:10px;
       }

       #project-toko {
            float: right;
            text-align: left;
            margin-right: 2rem;
       }

        #project span {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 12px;
        }

        #project {
            float: left;
            font-size: 12px;
        }

        #company {
            padding: 5px 20px;
            font-weight: normal;  
        }

        #project div,
        #company div,
        #project-toko div{
            white-space: nowrap;        
        }

        .tabel-produk {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        }

        .tabel-produk tr:nth-child(2n-1) td {
        background: #F5F5F5;
        }

        .tabel-produk th,
        .tabel-produk td {
        text-align: center;
        }

        .tabel-produk th {
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;        
        font-weight: normal;
        }

        .tabel-toko th {
            padding: 5px 20px;
            color: #5D6975;
            font-weight: normal;
        }

        .tabel-produk .no,
        .tabel-produk .produk,
        .tabel-produk .satuan,
        .tabel-produk .harga,
        .tabel-produk .qty,
        .tabel-produk .jumlah,
        .tabel-produk .disc,
        .tabel-produk .totalharga{
        text-align: center;
        }

        .tabel-produk td {
        padding: 5px;
        text-align: right;
        }

        .tabel-produk td.no,
        .tabel-produk td.produk {
        vertical-align: top;
        }

        .tabel-produk td.no,
        .tabel-produk td.produk,
        .tabel-produk td.total {
        font-size: 12px;
        text-align: center;
        }

        .tabel-produk td.grand {
        border-top: 1px solid #5D6975;;
        }

        #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
        }

        #notices {
            margin:1rem;
        }

        footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
        }

        main {
            margin-top: -2rem;
        }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div class="header-faktur">
        <div class="data-cv">
            <div id="company" class="clearfix">
                <div>CV.BERKAT REZEKI YOSEV</div>
                <div>Perumahan Mulya Asri 2 Blok E7 Kampung Baru Nan XX</div>
                <div>+628 3184 206039</div>
            </div>
        </div>
        <div class="data-cv">
            <h1>Faktur Penjualan</h1>
        </div>
        <div class="data-toko">
            <div id="project">
                <table class="tabel-toko">
                    <tr>
                        <th>Nama Toko</th>
                        <td>:</td>
                        <td>{{$detailtokos[0]['namatoko']}}</td>
                    </tr>
                    <tr>
                        <th>Alamat Toko</th>
                        <td>:</td>
                        <td>{{$detailtokos[0]['alamat']}}</td>
                    </tr>
                </table>
            </div>
            <div></div>
            <div id="project-toko">
                <table class="tabel-toko">
                    <tr>
                        <th>Nonota</th>
                        <td>:</td>
                        <td>{{$detailtokos[0]['nonota']}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>:</td>
                        <td>{{$detailtokos[0]['tglfaktur']}}</td>
                    </tr>
                    <tr>
                        <th>Jatuh Tempo</th>
                        <td>:</td>
                        <td>{{$detailtokos[0]['jatuhtempo']}}</td>
                    </tr>
                    <tr>
                        <th>Sales</th>
                        <td>:</td>
                        <td>{{$detailtokos[0]['namasales']}}</td>
                    </tr>
                </table>
            </div>
        </div>
      </div>
    </header>
    <main>
      <table class="tabel-produk">
        <thead>
          <tr>
            <th class="no">No</th>
            <th class="produk">Nama Produk</th>
            <th class="qty">Kuantitas</th>
            <th class="satuan">Satuan</th> 
            <th class="harga">Harga</th>  
            <th class="disc">Disc</th>
            <th class="disc">Disc</th>
            <th class="jumlah">Jumlah</th>
          </tr>
        </thead>
        <tbody>
            @foreach($detailproduks as $detail)
          <tr>
            <td class="no">{{$detail['kodeproduk']}}</td>
            <td class="produk">{{$detail['namaproduk']}}</td>
            <td class="qty">{{$detail['kuantitas']}}</td>
            <td class="satuan">pcs</td>
            <td class="harga">{{$detail['harga']}}</td>
            <td class="disc">{{$detail['diskon']}}</td>
            <td class="disc">{{$detail['diskon']}}</td>
            <td class="jumlah">{{$detail['jumlah']}}</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="7">SUBTOTAL</td>
            <td class="total">$5,200.00</td>
          </tr>
          <tr>
            <td colspan="7">TAX 25%</td>
            <td class="total">$1,300.00</td>
          </tr>
          <tr>
            <td colspan="7" class="grand total">GRAND TOTAL</td>
            <td class="grand total">{{$bayar}}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>