<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form to DOCX</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eef2f7;
            font-family: 'Arial', sans-serif;
            color: #495057;
        }

        .container {
            margin-top: 50px;
            max-width: 650px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #4a4a4a;
        }

        h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        .form-group label {
            font-weight: 600;
            color: #555;
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 1rem;
            color: #555;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 1.1rem;
            border-radius: 6px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 8px 15px;
            font-size: 1rem;
            border-radius: 6px;
        }

        .text-right a {
            margin-right: 15px;
        }

        .logout button {
            background-color: #dc3545;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 6px;
            font-weight: bold;
        }

        .logout button:hover {
            background-color: #c82333;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 6px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Convert Form to DOCX</h1>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('form.convert') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Proyek Section -->
            <h3>Proyek</h3>
            <div class="form-group">
                <label for="NoKontrak">No Kontrak:</label>
                <input type="text" class="form-control" name="NoKontrak" required>
            </div>
            <div class="form-group">
                <label for="NamaProjek">Nama Proyek:</label>
                <input type="text" class="form-control" name="NamaProjek" required>
            </div>
            <div class="form-group">
                <label for="NilaiKontrak">Nilai Kontrak:</label>
                <input type="number" id="NilaiKontrak" class="form-control" name="NilaiKontrak" required>

                <!-- Display the formatted currency value below the input -->
                <p>Formatted Nilai Kontrak: <span id="formattedNilaiKontrak">Rp. 0,-</span></p>
            </div>
            <div class="form-group">
                <label for="WaktuPenyelesaianPekerjaan">Waktu Penyelesaian Pekerjaan:</label>
                <input type="text" class="form-control" name="WaktuPenyelesaianPekerjaan" required>
            </div>

            <!-- Mitra Section -->
            <h3>Mitra</h3>
            <div class="form-group">
                <label for="NamaMitra">Nama Mitra:</label>
                <input type="text" class="form-control" name="NamaMitra" required>
            </div>
            <div class="form-group">
                <label for="CaraBayar">Cara Bayar:</label>
                <input type="text" class="form-control" name="CaraBayar" required>
            </div>
            <div class="form-group">
                <label for="AmandemenPertama">Amandemen Pertama:</label>
                <input type="text" class="form-control" name="AmandemenPertama" required>
            </div>

            <!-- Pembayaran Section -->
            <h3>Pembayaran</h3>
            <div class="form-group">
                <label for="RencanaPembayaran">Rencana Pembayaran:</label>
                <input type="text" class="form-control" name="RencanaPembayaran" required>
            </div>

            <!-- KelengkapanDokumen Section -->
            <h3>Kelengkapan Dokumen</h3>
            <div class="form-group">
                <label for="DetailKelengkapan">Detail Kelengkapan:</label>
                <textarea class="form-control" name="DetailKelengkapan" required></textarea>
            </div>

            <!-- Kesimpulan Section -->
            <h3>Kesimpulan</h3>
            <div class="form-group">
                <label for="DetailKesimpulan">Detail Kesimpulan:</label>
                <textarea class="form-control" name="DetailKesimpulan" required></textarea>
            </div>

            <!-- Tanda Tangan Section -->
            <h3>Tanda Tangan</h3>
            <div class="form-group">
                <label for="TandaTanganID">Tanda Tangan ID:</label>
                <input type="text" class="form-control" name="TandaTanganID" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Convert to DOCX</button>
        </form>

        <div class="text-right mt-4">
            <a href="{{ route('profile') }}" class="btn btn-secondary">Profile</a>
        </div>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="logout mt-3">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const nilaiKontrakInput = document.getElementById('NilaiKontrak');
        const formattedDisplay = document.getElementById('formattedNilaiKontrak');

        nilaiKontrakInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, ''); // Only allow numbers
            formattedDisplay.textContent = formatRupiah(value, 'Rp. ');
        });

        // Function to format the number into Rupiah format
        function formatRupiah(number, prefix) {
            let number_string = number.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // Add dots every 3 digits
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah + ',-' : '');
        }
    </script>

</body>

</html>
