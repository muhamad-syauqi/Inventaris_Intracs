<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class LaporanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | RIWAYAT STOK MASUK
    |--------------------------------------------------------------------------
    */

    public function riwayatStokMasuk(Request $request)
    {
        $query = StokMasuk::with([
            'barang.category',
            'user'
        ])->latest();

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate(
                'created_at',
                '>=',
                $request->tanggal_mulai
            );
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate(
                'created_at',
                '<=',
                $request->tanggal_sampai
            );
        }

        $stokMasuk = $query->paginate(15)->withQueryString();

        $totalTransaksi = $query->toBase()->getCountForPagination();

        $totalJumlah = (clone $query)->sum('jumlah');

        return view(
            'admin.riwayat-stok-masuk',
            compact(
                'stokMasuk',
                'totalTransaksi',
                'totalJumlah'
            )
        );
    }

    public function editStokMasuk($id)
    {
        $stokMasuk = StokMasuk::with('barang')->findOrFail($id);

        $barang = Barang::orderBy('nama_barang')->get();

        return view(
            'admin.riwayat-stok-masuk-edit',
            compact('stokMasuk', 'barang')
        );
    }

    public function updateStokMasuk(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'nomor_do' => 'required|string|max:100',
            'tanggal_request' => 'required|date',
            'nama_request' => 'required|string|max:150',
            'pengambil' => 'required|string|max:150',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $id) {

            $stokMasuk = StokMasuk::lockForUpdate()->findOrFail($id);

            $barangLama = Barang::lockForUpdate()
                ->findOrFail($stokMasuk->barang_id);

            $barangBaru = Barang::lockForUpdate()
                ->findOrFail($request->barang_id);

            // Kembalikan stok dari transaksi lama
            $barangLama->decrement('stok', $stokMasuk->jumlah);

            // Tambahkan stok berdasarkan transaksi baru
            $barangBaru->increment('stok', $request->jumlah);

            $stokMasuk->update([
                'barang_id' => $request->barang_id,
                'jumlah' => $request->jumlah,
                'nomor_do' => $request->nomor_do,
                'tanggal_request' => $request->tanggal_request,
                'nama_request' => $request->nama_request,
                'pengambil' => $request->pengambil,
                'keterangan' => $request->keterangan,
            ]);
        });

        return redirect()
            ->route('admin.riwayat-stok-masuk')
            ->with('success', 'Data stok masuk berhasil diperbarui.');
    }

    public function deleteStokMasuk($id)
    {
        DB::transaction(function () use ($id) {

            $stokMasuk = StokMasuk::lockForUpdate()->findOrFail($id);

            $barang = Barang::lockForUpdate()
                ->findOrFail($stokMasuk->barang_id);

            if ($barang->stok < $stokMasuk->jumlah) {
                abort(
                    redirect()
                        ->route('admin.riwayat-stok-masuk')
                        ->with(
                            'error',
                            'Data tidak dapat dihapus karena stok saat ini tidak mencukupi.'
                        )
                );
            }

            $barang->decrement('stok', $stokMasuk->jumlah);

            $stokMasuk->delete();
        });

        return redirect()
            ->route('admin.riwayat-stok-masuk')
            ->with('success', 'Data stok masuk berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT STOK KELUAR
    |--------------------------------------------------------------------------
    */

    public function riwayatStokKeluar(Request $request)
    {
        $query = StokKeluar::with([
            'barang.category',
            'user'
        ])->latest();

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate(
                'created_at',
                '>=',
                $request->tanggal_mulai
            );
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate(
                'created_at',
                '<=',
                $request->tanggal_sampai
            );
        }

        $stokKeluar = $query->paginate(15)->withQueryString();

        $totalTransaksi = $query->toBase()->getCountForPagination();

        $totalJumlah = (clone $query)->sum('jumlah');

        return view(
            'admin.riwayat-stok-keluar',
            compact(
                'stokKeluar',
                'totalTransaksi',
                'totalJumlah'
            )
        );
    }

    public function editStokKeluar($id)
    {
        $stokKeluar = StokKeluar::with('barang')->findOrFail($id);

        $barang = Barang::orderBy('nama_barang')->get();

        return view(
            'admin.riwayat-stok-keluar-edit',
            compact('stokKeluar', 'barang')
        );
    }

    public function updateStokKeluar(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'gerbang_tol' => 'required|string|max:100',
            'nomor_gardu' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $id) {

            $stokKeluar = StokKeluar::lockForUpdate()->findOrFail($id);

            $barangLama = Barang::lockForUpdate()
                ->findOrFail($stokKeluar->barang_id);

            $barangBaru = Barang::lockForUpdate()
                ->findOrFail($request->barang_id);

            // Kembalikan stok dari transaksi keluar lama
            $barangLama->increment('stok', $stokKeluar->jumlah);

            // Pastikan stok cukup untuk transaksi baru
            if ($barangBaru->stok < $request->jumlah) {
                abort(
                    redirect()
                        ->route('admin.riwayat-stok-keluar')
                        ->with(
                            'error',
                            'Stok tidak mencukupi untuk perubahan transaksi.'
                        )
                );
            }

            // Kurangi stok berdasarkan transaksi baru
            $barangBaru->decrement('stok', $request->jumlah);

            $stokKeluar->update([
                'barang_id' => $request->barang_id,
                'jumlah' => $request->jumlah,
                'gerbang_tol' => $request->gerbang_tol,
                'nomor_gardu' => $request->nomor_gardu,
                'keterangan' => $request->keterangan,
            ]);
        });

        return redirect()
            ->route('admin.riwayat-stok-keluar')
            ->with('success', 'Data stok keluar berhasil diperbarui.');
    }

    public function deleteStokKeluar($id)
    {
        DB::transaction(function () use ($id) {

            $stokKeluar = StokKeluar::lockForUpdate()->findOrFail($id);

            $barang = Barang::lockForUpdate()
                ->findOrFail($stokKeluar->barang_id);

            // Kembalikan stok yang sebelumnya dikeluarkan
            $barang->increment('stok', $stokKeluar->jumlah);

            $stokKeluar->delete();
        });

        return redirect()
            ->route('admin.riwayat-stok-keluar')
            ->with('success', 'Data stok keluar berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT EXCEL STOK MASUK
    |--------------------------------------------------------------------------
    */

    public function exportStokMasukExcel(Request $request)
    {
        $query = StokMasuk::with([
            'barang.category',
            'user'
        ])->latest();

        $this->filterTanggal(
            $query,
            $request
        );

        $data = $query->get();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Stok Masuk');

        $headers = [
            'No',
            'Tanggal & Jam',
            'Kode Barang',
            'Nama Barang',
            'Kategori',
            'Jumlah',
            'Satuan',
            'Nomor DO',
            'Tanggal Request',
            'Nama yang Request',
            'Keterangan',
            'Diinput Oleh',
        ];

        foreach ($headers as $column => $header) {
            $sheet->setCellValue(
                $this->columnLetter($column + 1) . '1',
                $header
            );
        }

        $row = 2;

        foreach ($data as $index => $item) {

            $sheet->setCellValue("A{$row}", $index + 1);
            $sheet->setCellValue(
                "B{$row}",
                $item->created_at?->format('d-m-Y H:i')
            );
            $sheet->setCellValue(
                "C{$row}",
                $item->barang->kode_barang ?? '-'
            );
            $sheet->setCellValue(
                "D{$row}",
                $item->barang->nama_barang ?? '-'
            );
            $sheet->setCellValue(
                "E{$row}",
                $item->barang->category->nama_kategori ?? '-'
            );
            $sheet->setCellValue("F{$row}", $item->jumlah);
            $sheet->setCellValue(
                "G{$row}",
                $item->barang->satuan ?? '-'
            );
            $sheet->setCellValue(
                "H{$row}",
                $item->nomor_do ?? '-'
            );
            $sheet->setCellValue(
                "I{$row}",
                $item->tanggal_request
                    ? \Carbon\Carbon::parse(
                        $item->tanggal_request
                    )->format('d-m-Y')
                    : '-'
            );
            $sheet->setCellValue(
                "J{$row}",
                $item->nama_request ?? '-'
            );
            $sheet->setCellValue(
                "K{$row}",
                $item->keterangan ?? '-'
            );
            $sheet->setCellValue(
                "L{$row}",
                $item->user->name ?? '-'
            );

            $row++;
        }

        foreach (range('A', 'L') as $column) {
            $sheet->getColumnDimension($column)
                ->setAutoSize(true);
        }

        $filename = 'riwayat-stok-masuk-' .
            now()->format('Y-m-d-His') .
            '.xlsx';

        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(
            function () use ($writer) {
                $writer->save('php://output');
            },
            $filename
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT EXCEL STOK KELUAR
    |--------------------------------------------------------------------------
    */

    public function exportStokKeluarExcel(Request $request)
    {
        $query = StokKeluar::with([
            'barang.category',
            'user'
        ])->latest();

        $this->filterTanggal(
            $query,
            $request
        );

        $data = $query->get();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Stok Keluar');

        $headers = [
            'No',
            'Tanggal & Jam',
            'Kode Barang',
            'Nama Barang',
            'Kategori',
            'Jumlah',
            'Satuan',
            'Gerbang Tol',
            'Nomor Gardu',
            'Keterangan',
            'Dikeluarkan Oleh',
        ];

        foreach ($headers as $column => $header) {
            $sheet->setCellValue(
                $this->columnLetter($column + 1) . '1',
                $header
            );
        }

        $row = 2;

        foreach ($data as $index => $item) {

            $sheet->setCellValue("A{$row}", $index + 1);
            $sheet->setCellValue(
                "B{$row}",
                $item->created_at?->format('d-m-Y H:i')
            );
            $sheet->setCellValue(
                "C{$row}",
                $item->barang->kode_barang ?? '-'
            );
            $sheet->setCellValue(
                "D{$row}",
                $item->barang->nama_barang ?? '-'
            );
            $sheet->setCellValue(
                "E{$row}",
                $item->barang->category->nama_kategori ?? '-'
            );
            $sheet->setCellValue("F{$row}", $item->jumlah);
            $sheet->setCellValue(
                "G{$row}",
                $item->barang->satuan ?? '-'
            );
            $sheet->setCellValue(
                "H{$row}",
                $item->gerbang_tol ?? '-'
            );
            $sheet->setCellValue(
                "I{$row}",
                $item->nomor_gardu
                    ? 'Gardu ' . $item->nomor_gardu
                    : '-'
            );
            $sheet->setCellValue(
                "J{$row}",
                $item->keterangan ?? '-'
            );
            $sheet->setCellValue(
                "K{$row}",
                $item->user->name ?? '-'
            );

            $row++;
        }

        foreach (range('A', 'K') as $column) {
            $sheet->getColumnDimension($column)
                ->setAutoSize(true);
        }

        $filename = 'riwayat-stok-keluar-' .
            now()->format('Y-m-d-His') .
            '.xlsx';

        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(
            function () use ($writer) {
                $writer->save('php://output');
            },
            $filename
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT WORD STOK MASUK
    |--------------------------------------------------------------------------
    */

    public function exportStokMasukWord(Request $request)
    {
        $query = StokMasuk::with([
            'barang.category',
            'user'
        ])->latest();

        $this->filterTanggal(
            $query,
            $request
        );

        $data = $query->get();

        $word = new PhpWord();

        $section = $word->addSection();

        $section->addTitle(
            'RIWAYAT STOK MASUK',
            1
        );

        $section->addText(
            'Tanggal Cetak: ' .
            now()->format('d-m-Y H:i') .
            ' WIB'
        );

        if (
            $request->filled('tanggal_mulai') ||
            $request->filled('tanggal_sampai')
        ) {

            $mulai = $request->tanggal_mulai
                ? \Carbon\Carbon::parse(
                    $request->tanggal_mulai
                )->format('d-m-Y')
                : '-';

            $sampai = $request->tanggal_sampai
                ? \Carbon\Carbon::parse(
                    $request->tanggal_sampai
                )->format('d-m-Y')
                : '-';

            $section->addText(
                "Periode: {$mulai} s/d {$sampai}"
            );
        }

        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80,
        ]);

        $headers = [
            'No',
            'Tanggal',
            'Barang',
            'Jumlah',
            'DO',
            'Tgl Request',
            'Nama Request',
            'Input Oleh',
        ];

        $table->addRow();

        foreach ($headers as $header) {
            $table->addCell(1200)
                ->addText($header);
        }

        foreach ($data as $index => $item) {

            $table->addRow();

            $table->addCell(500)
                ->addText((string) ($index + 1));

            $table->addCell(1300)
                ->addText(
                    $item->created_at?->format('d-m-Y H:i') ?? '-'
                );

            $table->addCell(1800)
                ->addText(
                    $item->barang->nama_barang ?? '-'
                );

            $table->addCell(800)
                ->addText(
                    $item->jumlah . ' ' .
                    ($item->barang->satuan ?? '')
                );

            $table->addCell(1200)
                ->addText(
                    $item->nomor_do ?? '-'
                );

            $table->addCell(1200)
                ->addText(
                    $item->tanggal_request
                        ? \Carbon\Carbon::parse(
                            $item->tanggal_request
                        )->format('d-m-Y')
                        : '-'
                );

            $table->addCell(1600)
                ->addText(
                    $item->nama_request ?? '-'
                );

            $table->addCell(1400)
                ->addText(
                    $item->user->name ?? '-'
                );
        }

        $filename = 'riwayat-stok-masuk-' .
            now()->format('Y-m-d-His') .
            '.docx';

        $tempFile = tempnam(
            sys_get_temp_dir(),
            'stok_masuk_'
        );

        $writer = IOFactory::createWriter(
            $word,
            'Word2007'
        );

        $writer->save($tempFile);

        return response()
            ->download(
                $tempFile,
                $filename
            )
            ->deleteFileAfterSend(true);
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT WORD STOK KELUAR
    |--------------------------------------------------------------------------
    */

    public function exportStokKeluarWord(Request $request)
    {
        $query = StokKeluar::with([
            'barang.category',
            'user'
        ])->latest();

        $this->filterTanggal(
            $query,
            $request
        );

        $data = $query->get();

        $word = new PhpWord();

        $section = $word->addSection();

        $section->addTitle(
            'RIWAYAT STOK KELUAR',
            1
        );

        $section->addText(
            'Tanggal Cetak: ' .
            now()->format('d-m-Y H:i') .
            ' WIB'
        );

        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80,
        ]);

        $headers = [
            'No',
            'Tanggal',
            'Barang',
            'Jumlah',
            'Gerbang Tol',
            'Gardu',
            'Keterangan',
            'Dikeluarkan Oleh',
        ];

        $table->addRow();

        foreach ($headers as $header) {
            $table->addCell(1300)
                ->addText($header);
        }

        foreach ($data as $index => $item) {

            $table->addRow();

            $table->addCell(500)
                ->addText((string) ($index + 1));

            $table->addCell(1300)
                ->addText(
                    $item->created_at?->format('d-m-Y H:i') ?? '-'
                );

            $table->addCell(1800)
                ->addText(
                    $item->barang->nama_barang ?? '-'
                );

            $table->addCell(800)
                ->addText(
                    $item->jumlah . ' ' .
                    ($item->barang->satuan ?? '')
                );

            $table->addCell(1600)
                ->addText(
                    $item->gerbang_tol ?? '-'
                );

            $table->addCell(1000)
                ->addText(
                    $item->nomor_gardu
                        ? 'Gardu ' . $item->nomor_gardu
                        : '-'
                );

            $table->addCell(1800)
                ->addText(
                    $item->keterangan ?? '-'
                );

            $table->addCell(1400)
                ->addText(
                    $item->user->name ?? '-'
                );
        }

        $filename = 'riwayat-stok-keluar-' .
            now()->format('Y-m-d-His') .
            '.docx';

        $tempFile = tempnam(
            sys_get_temp_dir(),
            'stok_keluar_'
        );

        $writer = IOFactory::createWriter(
            $word,
            'Word2007'
        );

        $writer->save($tempFile);

        return response()
            ->download(
                $tempFile,
                $filename
            )
            ->deleteFileAfterSend(true);
    }


    /*
    |--------------------------------------------------------------------------
    | FILTER TANGGAL
    |--------------------------------------------------------------------------
    */

    private function filterTanggal($query, Request $request)
    {
        if ($request->filled('tanggal_mulai')) {

            $query->whereDate(
                'created_at',
                '>=',
                $request->tanggal_mulai
            );
        }

        if ($request->filled('tanggal_sampai')) {

            $query->whereDate(
                'created_at',
                '<=',
                $request->tanggal_sampai
            );
        }

        return $query;
    }


    /*
    |--------------------------------------------------------------------------
    | KOLOM EXCEL
    |--------------------------------------------------------------------------
    */

    private function columnLetter($number)
    {
        $letter = '';

        while ($number > 0) {

            $mod = ($number - 1) % 26;

            $letter = chr(65 + $mod) . $letter;

            $number = intdiv(
                $number - $mod,
                26
            ) - 1;
        }

        return $letter;
    }
}