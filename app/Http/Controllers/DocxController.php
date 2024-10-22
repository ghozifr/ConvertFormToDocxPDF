<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\ConvertedForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class DocxController extends Controller
{
    public function showResult(Request $request)
{
    $request->validate([
        'namaMitra' => 'required|string',
        'NoKontrak' => 'required|string',
        'namaProjek' => 'required|string',
        'NilaiKontrak' => 'required|numeric',
        'WaktuMulai' => 'required|date',
        'WaktuSelesai' => 'required|date',
        'caraBayar' => 'required|string',
        'amandemenPertama' => 'required|string',
        'detailKelengkapan' => 'required|string',
        'detailKesimpulan' => 'required|string',
        'RencanaPembayaran' => 'required|string',
        'TermasukPPN' => 'required|in:yes,no',
        // 'tandaTangan' => 'required|string',
    ]);

    $formattedNilaiKontrak = $this->formatRupiah($request->NilaiKontrak);
    $terbilangNilaiKontrak = $this->terbilang($request->NilaiKontrak);
    $formattedWaktu = $this->formatDateRange($request->WaktuMulai, $request->WaktuSelesai);
    $ppnText = $request->TermasukPPN === 'yes' ? 'sudah termasuk PPN' : 'belum termasuk PPN';

    $data = [
        'namaMitra' => $request->namaMitra,
        'NoKontrak' => $request->NoKontrak,
        'namaProjek' => $request->namaProjek,
        'formattedNilaiKontrak' => $formattedNilaiKontrak,
        'terbilangNilaiKontrak' => $terbilangNilaiKontrak,
        'formattedWaktu' => $formattedWaktu,
        'caraBayar' => $request->caraBayar,
        'amandemenPertama' => $request->amandemenPertama,
        'detailKelengkapan' => $request->detailKelengkapan,
        'detailKesimpulan' => $request->detailKesimpulan,
        'rencanaPembayaran' => $request->RencanaPembayaran, // Lowercase here
        'ppnText' => $ppnText,
        'tandaTangan' => 'TANDA TANGAN ',
    ];

    return view('result', $data);
}


public function terbilang($number)
{
    // Define the number words and levels arrays
    $angka = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan"];
    $level = ["", "Ribu", "Juta", "Milyar", "Triliun"];

    // Main function to convert number to words
    function toWords($n, $angka, $level) {
        if ($n == 0) return '';
        $str = '';
        $units = [1000000000, 1000000, 1000, 1];
        $unitLevel = [3, 2, 1, 0];

        // Process each unit (e.g., Billion, Million, Thousand, etc.)
        foreach ($units as $i => $unit) {
            if (floor($n / $unit) > 0) {
                $str .= subWords(floor($n / $unit), $angka) . ' ' . $level[$unitLevel[$i]] . ' ';
                $n %= $unit;
            }
        }

        return trim($str);
    }
}
public function formatRupiah($number)
{
    $number = preg_replace("/[^0-9]/", "", $number); // Remove non-numeric characters
    return 'Rp. ' . number_format($number, 0, ',', '.') . ',-';
}
public function formatDateRange($startDate, $endDate)
{
    $formattedStartDate = \Carbon\Carbon::parse($startDate)->format('d/m/Y');
    $formattedEndDate = \Carbon\Carbon::parse($endDate)->format('d/m/Y');

    return $formattedStartDate . ' - ' . $formattedEndDate;
}

}
