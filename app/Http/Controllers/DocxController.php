<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\ConvertedForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocxController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function convertToDocx(Request $request)
    {
        // Validate the input data
        $request->validate([
            'NamaMitra' => 'required|string',
            'CaraBayar' => 'required|string',
            'AmandemenPertama' => 'required|string',
            'DetailKelengkapan' => 'required|string',
            'NoKontrak' => 'required|string',
            'NamaProjek' => 'required|string',
            'NilaiKontrak' => 'required|int',
            'WaktuPenyelesaianPekerjaan' => 'required|string',
            'DetailKesimpulan' => 'required|string',
            'TandaTanganID' => 'required|string',
            'RencanaPembayaran' => 'required|string',
        ]);


        // 'Mitra' => 'required|integer',
            // 'DetailDokumenID' => 'required|string',
            // 'KesimpulanID' => 'required|string',
            // 'TulisanTtd' => 'required|file|mimes:jpeg,png',
            // 'DetailPembayaran' => 'required|integer',
            // 'DetailPembayaranID' => 'required|string',

        // Store the uploaded signature image
        // $signaturePath = $request->file('TulisanTtd')->store('public/signatures');

        // Create DOCX content
        // $docxContent = $this->generateDocxContent($request->all());
        $docxContent = "
No. Kontrak     : {$request->NoKontrak}
Proyek          : {$request->NamaProjek}
Nilai Kontrak   : {$request->NilaiKontrak}
Waktu Penyelesaian
Pekerjaan       : {$request->WaktuPenyelesaianPekerjaan}

Nama Mitra      : {$request->NamaMitra}
Cara Bayar      : {$request->CaraBayar}
Amandemen Pertama: {$request->AmandemenPertama}

Rencana Pembayaran:
• {$request->RencanaPembayaran}

Kelengkapan Dokumen tagihan sesuai Pasal Pembayaran dalam Kontrak:
- {$request->DetailKelengkapan}

Kesimpulan:
- {$request->DetailKesimpulan}
    ";

        // Generate a unique file name for the DOCX
        $fileName = 'converted_form_' . time() . '.docx';

        // Save the DOCX file to storage
        Storage::put('public/converted_forms/' . $fileName, $docxContent);

        // Save the record in the database
        ConvertedForm::create([
            'user_id' => Auth::id(),
            'nama_mitra' => $request->NamaMitra,
            'file_path' => 'converted_forms/' . $fileName, // Ensure file_path is saved
        ]);

        // Create a new PHPWord instance to generate the DOCX

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $table = $section->addTable();
        // Format Nilai Kontrak before adding it to the DOCX
    $formattedNilaiKontrak = $this->formatRupiah($request->NilaiKontrak);


        //REVIEW TREASURY & TAX
        $table->addRow();
        $table->addCell()->addText("REVIEW TREASURY AND TAX", ['bold' => true, 'size' => 13]);
        $table->addRow();$table->addRow();$table->addRow();$table->addRow();$table->addRow();
$table->addCell(4000)->addText("No. Kontrak");
$table->addCell(8000)->addText(": $request->NoKontrak");

$table->addRow();
$table->addCell(4000)->addText("Proyek");
$table->addCell(8000)->addText(": $request->NamaProjek");

$table->addRow();
    $table->addCell(4000)->addText("Nilai Kontrak");
    $table->addCell(8000)->addText(": " . $formattedNilaiKontrak);

$table->addRow();
$table->addCell(4000)->addText("Waktu Penyelesaian Pekerjaan");
$table->addCell(8000)->addText(": $request->WaktuPenyelesaianPekerjaan");

$table->addRow();

$table->addRow();
$table->addCell(4000)->addText('Nama Mitra');
$table->addCell(8000)->addText(": $request->NamaMitra");

$table->addRow();
$table->addCell(4000)->addText('Cara Bayar');
$table->addCell(8000)->addText(": $request->CaraBayar");

$table->addRow();
$table->addCell(4000)->addText('Amandemen Pertama');
$table->addCell(8000)->addText(": $request->AmandemenPertama");

$table->addRow();$table->addRow();$table->addRow();

$table->addRow();
$table->addCell(4000)->addText('Rencana Pembayaran');
$table->addCell(8000)->addText(": $request->RencanaPembayaran");

$table->addRow();$table->addRow();$table->addRow();
$table->addRow()->addCell()->addText('Kelengkapan Dokumen tagihan sesuai Pasal Pembayaran dalam Kontrak: ');
$cell = $table->addCell();
$lines = explode("\n", $request->DetailKelengkapan);
foreach ($lines as $line) {
    $table->addRow();
    $table->addCell()->addText('');
    $table->addCell()->addText($line);
}
$table->addRow();$table->addRow();$table->addRow();

$table->addRow();
$table->addCell(4000)->addText('Kesimpulan');
$table->addCell(8000)->addText(": $request->DetailKesimpulan");
$table->addRow();
$table->addCell(4000)->addText('Tanda Tangan ID');
$table->addCell(8000)->addText(": $request->TandaTanganID");

        // Add a section to the document and add form data

        // $section->addText('No Kontrak: ' . $request->NoKontrak, ['spaceAfter' => 240]);
        // $section->addText('Nama Projek: ' . $request->NamaProjek);
        // $section->addText('Nilai Kontrak: ' . $request->NilaiKontrak, ['spaceAfter' => 240]);
        // $section->addText('Waktu Penyelesaian Pekerjaan: ' . $request->WaktuPenyelesaianPekerjaan);
        // $section->addTextBreak(2);
        // $section->addText('Nama Mitra: ' . $request->NamaMitra);
        // $section->addText('Cara Bayar: ' . $request->CaraBayar);
        // $section->addText('Amandemen Pertama: ' . $request->AmandemenPertama);
        // $section->addText('Rencana Pembayaran: ' . $request->RencanaPembayaran);
        // $section->addText('Detail Kelengkapan: ' . $request->DetailKelengkapan);
        // $section->addText('Detail Kesimpulan: ' . $request->DetailKesimpulan);
        // $section->addText('Tanda Tangan ID: ' . $request->TandaTanganID);
        // $section->addText('Mitra: ' . $request->Mitra);
        // $section->addText('Detail Dokumen ID: ' . $request->DetailDokumenID);
        // $section->addText('Kesimpulan ID: ' . $request->KesimpulanID);
        // $section->addText('Detail Pembayaran: ' . $request->DetailPembayaran);
        // $section->addText('Detail Pembayaran ID: ' . $request->DetailPembayaranID);



        // Save the document as a temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'phpword') . '.docx';
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);

        // Return the DOCX file as a download
        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    // Function to generate the DOCX content
    private function generateDocxContent($data)
    {
        // Here you generate DOCX content using the provided data
        // Currently, it's just simple text, but you can customize it further
        $content = "Nama Mitra: {$data['NamaMitra']}\n";
        // $content .= "Mitra: {$data['Mitra']}\n";
        $content .= "Cara Bayar: {$data['CaraBayar']}\n";
        // Add other fields as necessary

        return $content;
    }

    public function formatRupiah($number)
{
    $number = preg_replace("/[^0-9]/", "", $number); // Remove non-numeric characters
    return 'Rp. ' . number_format($number, 0, ',', '.') . ',-';
}

    // Preview a specific DOCX file from the database
    public function previewDocx($id)
    {
        $convertedForm = ConvertedForm::findOrFail($id);

        // Get the file path from the database
        $filePath = $convertedForm->file_path;

        // Check if the file exists in storage
        if (Storage::exists('public/' . $filePath)) {
            // Return the file URL for preview or download
            return response()->json([
                'file_url' => Storage::url('public/' . $filePath)
            ]);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }
}

