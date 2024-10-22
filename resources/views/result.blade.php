<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Treasury & Tax</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eef2f7;
            font-family: 'Arial', sans-serif;
            color: #495057;
        }

        .container {
            margin-top: 50px;
            max-width: 900px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-weight: bold;
            color: #4a4a4a;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        td {
            padding: 8px 12px;
            vertical-align: top;
        }

        .table-title {
            font-weight: bold;
            font-size: 14px;
        }

        .print-btn {
            margin-top: 20px;
            text-align: right;
        }

        .signature {
            margin-top: 50px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>REVIEW TREASURY & TAX</h1>

        <!-- Table Content -->
        <table>
            <tr>
                <td class="table-title">No. Kontrak</td>
                <td>: {{ $NoKontrak }}</td>
            </tr>
            <tr>
                <td class="table-title">Proyek</td>
                <td>: {{ $namaProjek }}</td>
            </tr>
            <tr>
                <td class="table-title">Nilai Kontrak</td>
                <td>: {{ $formattedNilaiKontrak }} ,- ({{ $ppnText }})</td>
            </tr>
            <tr>
                <td class="table-title">Terbilang</td>
                <td>: {{ $terbilangNilaiKontrak }}</td>
            </tr>
            <tr>
                <td class="table-title">Waktu Penyelesaian Pekerjaan</td>
                <td>: {{ $formattedWaktu }}</td>
            </tr>
            <tr>
                <td class="table-title">Nama Mitra</td>
                <td>: {{ $namaMitra }}</td>
            </tr>
            <tr>
                <td class="table-title">Cara Bayar</td>
                <td>: {{ $caraBayar }}</td>
            </tr>
            <tr>
                <td class="table-title">Amandemen Pertama</td>
                <td>: {{ $amandemenPertama }}</td>
            </tr>
            <tr>
                <td class="table-title">Rencana Pembayaran</td>
                <td>: {{ $rencanaPembayaran }}</td>
            </tr>
        </table>

        <!-- Kelengkapan Dokumen Section -->
        <p><strong>Kelengkapan Dokumen tagihan sesuai Pasal Pembayaran dalam Kontrak:</strong></p>
        <table>
            @foreach (explode("\n", $detailKelengkapan) as $line)
                <tr>
                    <td></td>
                    <td>{{ $line }}</td>
                </tr>
            @endforeach
        </table>

        <!-- Kesimpulan Section -->
        <h4>Kesimpulan</h4>
        <table>
            <tr>
                <td>{{ $detailKesimpulan }}</td>
            </tr>
        </table>

        <!-- Signature Section -->
        <div class="signature">
            <p>______________________________</p>
            <p>{{ $tandaTangan }}</p>
        </div>

        <div class="print-btn">
            <a href="{{ url()->previous() }}" class="btn btn-danger">Go Back</a>
        </div>

        <!-- Print Button -->
        <div class="print-btn">
            <button class="btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
</body>
</html>
