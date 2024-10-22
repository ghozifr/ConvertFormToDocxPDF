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
                <input type="text" class="form-control" name="namaProjek" required>
            </div>
            <div class="form-group">
                <label for="NilaiKontrak">Nilai Kontrak:</label>
                <input type="number" id="NilaiKontrak" class="form-control" name="NilaiKontrak" required>

                <!-- Display the formatted currency value -->
                <p>Formatted Nilai Kontrak: <span id="formattedNilaiKontrak">Rp. 0,-</span></p>

                <!-- Display the number in Indonesian words -->
                <p>Terbilang: <span id="terbilangNilaiKontrak">Nol Rupiah</span></p>
            </div>

            <!-- PPN Checkbox Section -->
<div class="form-group">
    <label>Termasuk PPN:</label><br>
    <input type="radio" id="ppn_yes" name="TermasukPPN" value="yes" required>
    <label for="ppn_yes">Yes</label><br>

    <input type="radio" id="ppn_no" name="TermasukPPN" value="no">
    <label for="ppn_no">No</label>
</div>

<div class="form-group">
    <label for="WaktuMulai">Waktu Penyelesaian Pekerjaan:</label><br>

    <!-- Start Date Input -->
    <input type="date" id="WaktuMulai" class="form-control" name="WaktuMulai" required>

    <!-- Text in between -->
    <span>Sampai</span>

    <!-- End Date Input -->
    <input type="date" id="WaktuSelesai" class="form-control" name="WaktuSelesai" required>
</div>

            <!-- Mitra Section -->
            <h3>Mitra</h3>
            <div class="form-group">
                <label for="NamaMitra">Nama Mitra:</label>
                <input type="text" class="form-control" name="namaMitra" required>
            </div>
            <div class="form-group">
                <label for="CaraBayar">Cara Bayar:</label>
                <input type="text" class="form-control" name="caraBayar" required>
            </div>
            <div class="form-group">
                <label for="AmandemenPertama">Amandemen Pertama:</label>
                <textarea rows="5" class="form-control" name="amandemenPertama" required></textarea>
            </div>

            <!-- Pembayaran Section -->
            <h3>Pembayaran</h3>
            <div class="form-group">
                <label for="RencanaPembayaran">Rencana Pembayaran:</label>
                <textarea rows="5" class="form-control" name="RencanaPembayaran" required></textarea>
            </div>

            <!-- KelengkapanDokumen Section -->
            <h3>Kelengkapan Dokumen</h3>
            <div class="form-group">
                <label for="DetailKelengkapan">Detail Kelengkapan:</label>
                <textarea rows="5" class="form-control" name="detailKelengkapan" required></textarea>
            </div>

            <!-- Kesimpulan Section -->
            <h3>Kesimpulan</h3>
            <div class="form-group">
                <label for="DetailKesimpulan">Detail Kesimpulan:</label>
                <textarea rows="5" class="form-control" name="detailKesimpulan" required></textarea>
            </div>

            <!-- Tanda Tangan Section -->
            {{-- <h3>Tanda Tangan</h3>
            <div class="form-group">
                <label for="TandaTanganID">Tanda Tangan ID:</label>
                <input type="text" class="form-control" name="TandaTanganID" required>
            </div> --}}

            <button type="submit" class="btn btn-primary">Convert & Display</button>

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
        const terbilangDisplay = document.getElementById('terbilangNilaiKontrak');

        nilaiKontrakInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, ''); // Only allow numbers

            // Update formatted currency display
            formattedDisplay.textContent = formatRupiah(value, 'Rp. ');

            // Update the Indonesian words display
            terbilangDisplay.textContent = terbilang(value) + ' Rupiah';
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

        // Function to convert numbers into Indonesian words
        function terbilang(number) {
            const angka = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan"];
            const level = ["", "Ribu", "Juta", "Milyar", "Triliun"];

            function toWords(n) {
                if (n == 0) return '';
                let str = '', num = n.toString();
                let len = num.length;
                let units = [1000000000, 1000000, 1000, 1];
                let unitLevel = [3, 2, 1, 0];

                units.forEach((unit, i) => {
                    if (Math.floor(n / unit) > 0) {
                        str += `${subWords(Math.floor(n / unit))} ${level[unitLevel[i]]} `;
                        n %= unit;
                    }
                });
                return str.trim();
            }

            function subWords(n) {
                if (n < 10) return angka[n];
                if (n < 20) return angka[n - 10] + ' Belas';
                if (n < 100) return angka[Math.floor(n / 10)] + ' Puluh ' + angka[n % 10];
                if (n < 200) return 'Seratus ' + subWords(n - 100);
                if (n < 1000) return angka[Math.floor(n / 100)] + ' Ratus ' + subWords(n % 100);
                return '';
            }

            return toWords(parseInt(number));
        }
        function printPage() {
        window.print(); // This triggers the browser's print dialog, like Ctrl + P
    }
    function redirectToResult() {
            // Get values from the form
            const noKontrak = document.getElementById('NoKontrak').value;
            const namaProjek = document.getElementById('NamaProjek').value;
            const nilaiKontrak = document.getElementById('NilaiKontrak').value;
            const termasukPPN = document.querySelector('input[name="TermasukPPN"]:checked').value;

            // Create a URL and pass parameters via query string
            const resultPageUrl = `result?noKontrak=${encodeURIComponent(noKontrak)}&namaProjek=${encodeURIComponent(namaProjek)}&nilaiKontrak=${encodeURIComponent(nilaiKontrak)}&termasukPPN=${encodeURIComponent(termasukPPN)}`;

            // Redirect to the result page
            window.location.href = resultPageUrl;
        }
    </script>

</body>

</html>
