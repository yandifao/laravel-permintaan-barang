<html>

<head>
    <title>Print Permintaan Barang</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>

        @media print {
            #printPageButton {
                display: none;
            }
        }
        .top_rw {
            background-color: #f4f4f4;
        }

        .td_w {}

        button {
            padding: 5px 10px;
            font-size: 14px;
        }

        .invoice-box {
            max-width: 890px;
            margin: auto;
            padding: 10px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 14px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-bottom: solid 1px #ccc;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: middle;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            font-size: 12px;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div id="printableArea">
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="5">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="{{ asset('img/logo.png') }}" style="width:100%; max-width:300px;">
                                </td>
                                <td>
                                    <h3>PT SARANA MAKIN MULIA</h3>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="top_rw">
                    <td colspan="5">
                        <table style="background-color: #f4f4f4; width: 100%">
                            <tr>
                                <td>
                                    <b>PERMINTAAN BARANG</b><br>
                                    No. Permintaan : {{ $permintaan->id }}<br>
                                    Tanggal : {{ $permintaan->tanggal }}<br>
                                    Departemen : {{ $permintaan->departemen }}<br>
                                    Nama : {{ $permintaan->nama_karyawan }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="heading" style="background-color: #d4d4d4; border: 1px solid #d4d4d4">
                    <td style="width: 5%">No</td>
                    <td style="width: 30%">Nama Barang</td>
                    <td style="width: 10%">Jumlah</td>
                    <td style="width: 10%">Satuan</td>
                    <td style="width: 45%">Keterangan</td>
                </tr>
                @foreach ($barang as $item)
                    <tr class="item">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                @endforeach
            </table>
            <br>
            <br>
            <table>
                <tr>
                    <td style="width: 50%; text-align: center">
                        <p>Mengetahui</p>
                        <p>Kepala Divisi</p>
                        <br>
                        <br>
                        <br>
                        <p><u></u></p>
                    </td>
                    <td style="width: 50%; text-align: center">
                        <p>Menyetujui</p>
                        <p>Manager</p>
                        <br>
                        <br>
                        <br>
                        <p><u></u></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        window.print();
    });
</script>

</html>
