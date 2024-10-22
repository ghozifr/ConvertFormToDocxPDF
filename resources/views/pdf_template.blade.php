<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GANTI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin: 20px;
        }
        h1 {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .signature {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body>
    <h1>REVIEW TREASURY & TAX</h1>

    <table class="table">
        <tr>
            <td>No. Kontrak</td>
            <td>: {{ $request->NoKontrak }}</td>
        </tr>
        <tr>
            <td>Proyek</td>
            <td>: {{ $request->NamaProjek }}</td>
        </tr>
        <tr>
            <td>Nilai Kontrak</td>
            <td>: Rp. {{ $formattedNilaiKontrak ?? 'N/A' }} ,- ({{ $ppnText ?? 'N/A' }})</td>
        </tr>
        <tr>
            <td></td>
            <td>({{ $terbilangNilaiKontrak ?? 'N/A' }})</td>
        </tr>
        <tr>
            <td>Waktu Penyelesaian Pekerjaan</td>
            <td>: {{ $formattedWaktu ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Nama Mitra</td>
            <td>: {{ $request->NamaMitra }}</td>
        </tr>
        <tr>
            <td>Cara Bayar</td>
            <td>: {{ $request->CaraBayar }}</td>
        </tr>
        <tr>
            <td>Amandemen Pertama</td>
            <td>: {{ $request->AmandemenPertama }}</td>
        </tr>
    </table>

    <h3>Rencana Pembayaran:</h3>
    <p>• SPB No. {{ $request->SPBNumber }} adalah tagihan ke-2 dari nilai pekerjaan atau senilai Rp. {{ number_format((float) $request->RencanaPembayaran, 2, ',', '.') }} (tidak termasuk PPN)</p>

    <h3>Kelengkapan Dokumen tagihan sesuai Pasal Pembayaran dalam Kontrak:</h3>
    <ul>
        @foreach(explode("\n", $request->DetailKelengkapan) as $index => $line)
            <li>{{ $index + 1 }}. {{ $line }}</li>
        @endforeach
    </ul>

    <h3>Kesimpulan:</h3>
    <p>{{ $request->DetailKesimpulan }}</p>

    <div class="signature">
        <p>KETUT DARMA</p>
        <p>PUTRA</p>
        <p>VP Treasury & Tax</p>
    </div>
</body>
</html>
