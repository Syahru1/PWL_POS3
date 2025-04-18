<?php

namespace App\Http\Controllers;

use App\Models\LevelModel; 
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory; 
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{
    // Menampilkan halaman awal barang
    // public function index()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Daftar Barang',
    //         'list' => ['Home', 'Barang']
    //     ];

    //     $page = (object) [
    //         'title' => 'Daftar barang yang terdaftar dalam sistem'
    //     ];

    //     $activeMenu = 'barang'; // Set menu yang sedang aktif

    //     $kategori = KategoriModel::all(); //ambil data kategori untuk filter kategori

    //     return view('barang.index', [
    //         'breadcrumb' => $breadcrumb,
    //         'page' => $page,
    //         'barang' => $kategori,
    //         'activeMenu' => $activeMenu
    //     ]);
    // }

    public function index()
    {

        $activeMenu = 'barang';
        $breadcrumb = (object) [
            'title' => 'Data Barang',
            'list' => ['Home', 'Barang']
        ];

        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
        return view('barang.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'kategori' => $kategori
        ]);
    }
    
    public function list(Request $request)
    {
        $barang = BarangModel::select(
            'barang_id',
            'barang_kode',
            'barang_nama',
            'harga_beli',
            'harga_jual',
            'kategori_id'
        )->with('kategori');

        $kategori_id = $request->input('filter_kategori');
        if (!empty($kategori_id)) {
            $barang->where('kategori_id', $kategori_id);
        }

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
/*$btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn
info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/barang/' . $barang->barang_id .
'/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.
                    url('/barang/'.$barang->barang_id).'">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return
confirm(\'Apakah Kita yakit menghapus data ini?\');">Hapus</button></form>';*/
                $btn = '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id
                    . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id 
                    . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id 
                    . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // ada teks html
            ->make(true);
    }

    // Menampilkan halaman form tambah barang
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah barang baru'
        ];

        $kategori = KategoriModel::all(); // ambil data kategori untuk ditampilkan di form
        $activeMenu = 'barang'; // set menu yang sedang aktif

        return view('barang.barangCreate', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|string|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:m_kategori,kategori_id' // Validasi kategori_id
        ]);

        $data = [
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id, // Pastikan ini ada
        ];

        // Langsung gunakan kategori_id tanpa mencari kategori_nama
        BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->input('kategori_id') // Simpan ID kategori
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    // Menampilkan detail barang
    public function show($id)
    {
        $barang = BarangModel::with('kategori')->find($id);

        if (!$barang) {
            return redirect('/barang')->with('error', 'Barang tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang'; // Set menu yang sedang aktif

        return view('barang.barangShow', [
            'barang' => $barang,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan halaman form edit barang
    public function edit(string $id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();

        $breadcrumb = (object) [
            "title" => "Edit Barang",
            "list" => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            "title" => "Edit barang"
        ];

        $activeMenu = 'barang'; // set menu yang sedang aktif

        return view('barang.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data barang
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string|unique:barang,barang_kode,' . $id . ',barang_id',
            // kode barang harus diisi, berupa string, dan bernilai unik kecuali untuk barang dengan id yang sedang diedit
            'barang_nama' => 'required|string|max:100', // nama barang harus diisi, berupa string, dan maksimal 100 karakter
            'harga_beli' => 'required|numeric|min:0', // harga beli harus diisi dan berupa angka
            'harga_jual' => 'required|numeric|min:0', // harga jual harus diisi dan berupa angka
            'kategori_id' => 'required|integer' // kategori_id harus diisi dan berupa angka
        ]);

        BarangModel::find($id)->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    // Menghapus data barang
    public function destroy(string $id)
    {
        $check = BarangModel::find($id);
        if (!$check) {      //untuk mengecek apakah data barang yang akan dihapus ada atau tidak
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }
        try {
            BarangModel::destroy($id);
            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            //jika terjadi error ketika menghapus data, maka tampilkan pesan error dan redirect ke halaman barang
            return redirect('/barang')->with('error', 'Data barang sedang digunakan');
        }
    }

    // public function create_ajax()
    // {
    //     $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();

    //     return view('barang.create_ajax')->with('kategori', $kategori);
    // }

    // public function store_ajax(Request $request)
    // {
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $rules = [
    //             'kategori_id' => 'required|integer',
    //             'barang_kode' => 'required|string|unique:m_barang,barang_kode',
    //             'barang_nama' => 'required|string|max:100',
    //             'harga_beli' => 'required|numeric|min:0',
    //             'harga_jual' => 'required|numeric|min:0'
    //         ];

    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Validasi Gagal',
    //                 'msgField' => $validator->errors(),
    //             ]);
    //         }

    //         BarangModel::create($request->all());
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Data barang berhasil disimpan'
    //         ]);
    //     }
    //     return redirect('/barang');
    // }

    public function create_ajax()
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
        return view('barang.create_ajax')->with('kategori', $kategori);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_id' => ['required', 'integer', 'exists:m_kategori,kategori_id'],
                'barang_kode' => [
                    'required',
                    'min:3',
                    'max:20',
                    'unique:m_barang,barang_kode'
                ],
                'barang_nama' => ['required', 'string', 'max:100'],
                'harga_beli' => ['required', 'numeric'],
                'harga_jual' => ['required', 'numeric'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            BarangModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }
        redirect('/barang');
    }

    // // Ambil data barang dalam bentuk json untuk datatables
    // public function list(Request $request)
    // {
    //     $barang = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'kategori_id')
    //         ->with('kategori');

    //     // Filter data barang berdasarkan kategori_id
    //     if ($request->kategori_id) {
    //         $barang->where('kategori_id', $request->kategori_id);
    //     }

    //     return DataTables::of($barang)
    //         ->addIndexColumn() // Menambahkan kolom index / no urut (default: DT_RowIndex)
    //         ->addColumn('aksi', function ($barang) {
    //             $btn = '<a href="' . url('/barang/' . $barang->barang_id . '/show') . '" class="btn btn-info btn-sm">Detail</a> ';
    //             $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
    //             $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi berisi HTML
    //         ->make(true);
    // }

    // //Menampilkan halaman form edit barang ajax
    // public function edit_ajax(string $id)
    // {
    //     $barang = BarangModel::find($id);
    //     $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
    //     return view('barang.edit_ajax', [
    //         'barang' => $barang,
    //         'kategori' => $kategori
    //     ]);
    // }

    // public function update_ajax(Request $request, $id)
    // {
    //     // cek apakah request dari ajax
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $rules = [
    //             'kategori_id' => 'required|integer',
    //             'barang_kode' => 'required|string|unique:barang,barang_kode,' . $id . ',barang_id',
    //             'barang_nama' => 'required|string|max:100',
    //             'harga_beli' => 'required|numeric|min:0',
    //             'harga_jual' => 'required|numeric|min:0'
    //         ];

    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => false,    // respon json, true: berhasil, false: gagal
    //                 'message' => 'Validasi gagal.',
    //                 'msgField' => $validator->errors()  // menunjukkan field mana yang error
    //             ]);
    //         }

    //         $check = BarangModel::find($id);
    //         if ($check) {
    //             $check->update($request->all());
    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Data berhasil diupdate'
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Data tidak ditemukan'
    //             ]);
    //         }
    //     }
    //     return redirect('/barang');
    // }

    public function edit_ajax($id)
    {
        $barang = BarangModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('barang.edit_ajax', ['barang' => $barang, 'level' => $level]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_id' => ['required', 'integer', 'exists:m_kategori,kategori_id'],
                'barang_kode' => [
                    'required',
                    'min:3',
                    'max:20',
                    'unique:m_barang,barang_kode, ' . $id . ',barang_id'
                ],
                'barang_nama' => ['required', 'string', 'max:100'],
                'harga_beli' => ['required', 'numeric'],
                'harga_jual' => ['required', 'numeric'],
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }

            $check = BarangModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/barang');
    }

    // public function confirm_ajax(string $id)
    // {
    //     $barang = BarangModel::find($id);
    //     return view('barang.confirm_ajax', [
    //         'barang' => $barang
    //     ]);
    // }

    // public function delete_ajax(Request $request, $id)
    // {
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $barang = BarangModel::find($id);
    //         if ($barang) {
    //             $barang->delete();
    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Data berhasil dihapus'
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Data tidak ditemukan'
    //             ]);
    //         }
    //     }
    //     return redirect('/barang');
    // }

    public function confirm_ajax($id)
    {
        $barang = BarangModel::find($id);
        return view('barang.confirm_ajax', ['barang' => $barang]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $barang = BarangModel::find($id);
            if ($barang) { // jika sudah ditemuikan
                $barang->delete(); // barang di hapus
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/barang');
    }

    public function import()
    {
        return view('barang.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_barang' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_barang');  // ambil file dari request

            $reader = IOFactory::createReader('Xlsx');  // load reader file excel
            $reader->setReadDataOnly(true);             // hanya membaca data
            $spreadsheet = $reader->load($file->getRealPath()); // load file excel
            $sheet = $spreadsheet->getActiveSheet();    // ambil sheet yang aktif

            $data = $sheet->toArray(null, false, true, true);   // ambil data excel

            $insert = [];
            if (count($data) > 1) { // jika data lebih dari 1 baris
                foreach ($data as $baris => $value) {
                    if ($baris > 1) { // baris ke 1 adalah header, maka lewati
                        $insert[] = [
                            'kategori_id' => $value['A'],
                            'barang_kode' => $value['B'],
                            'barang_nama' => $value['C'],
                            'harga_beli' => $value['D'],
                            'harga_jual' => $value['E'],
                            'created_at' => now(),
                        ];
                    }
                }

                if (count($insert) > 0) {
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    BarangModel::insertOrIgnore($insert);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/barang');
    }

     //fungsi export
     public function export_excel()
     {
         //ambil data barang
         $barang = BarangModel::select(
             'kategori_id',
             'barang_kode',
             'barang_nama',
             'harga_beli',
             'harga_jual',
         )
             ->orderBy('kategori_id')
             ->with('kategori')
             ->get();
 
         //load spreadsheet
         $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
         $sheet = $spreadsheet->getActiveSheet();
 
         //set header
         $sheet->setCellValue('A1', 'No');
         $sheet->setCellValue('B1', 'Kode Barang');
         $sheet->setCellValue('C1', 'Nama Barang');
         $sheet->setCellValue('D1', 'Harga Beli');
         $sheet->setCellValue('E1', 'Harga Jual');
         $sheet->setCellValue('F1', 'Kategori');
 
         $sheet->getStyle('A1:F1')->getFont()->setBold(true); ///bold header
 
         //set data
         $no = 1;
         $baris = 2;
         foreach ($barang as $row) {
             $sheet->setCellValue('A' . $baris, $no);
             $sheet->setCellValue('B' . $baris, $row->barang_kode);
             $sheet->setCellValue('C' . $baris, $row->barang_nama);
             $sheet->setCellValue('D' . $baris, $row->harga_beli);
             $sheet->setCellValue('E' . $baris, $row->harga_jual);
             $sheet->setCellValue('F' . $baris, $row->kategori->kategori_nama);
             $no++;
             $baris++;
         }
 
         //set lebar kolom
         foreach (range('A', 'F') as $columnID) {
             $sheet->getColumnDimension($columnID)->setAutoSize(true); //set autosize
         }
 
         //set judul file
         $sheet->setTitle('Data Barang'); // set title sheet
 
         $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
         $filename = 'Data Barang ' . date('Y-m-d H:i:s') . '.xlsx';
 
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename="' . $filename . '"');
         header('Cache-Control: max-age=0');
         header('Cache-Control: max-age=1');
         header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
         header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
         header('Cache-Control: cache, must-revalidate');
         header('Pragma: public');
 
         $writer->save('php://output');
         exit;
    }

     //export pdf
    public function export_pdf()
    {
        $barang = BarangModel::orderBy('kategori_id')
            ->orderBy('kategori_id')
            ->orderBy('barang_kode')
            ->with('kategori')
            ->get();

        //gunakan barryvdh dompdf
        $pdf = PDF::loadview('barang.export_pdf', ['barang' => $barang]);
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption("isRemoteEnabled", true);
        $pdf->render();

        return $pdf->stream('Data Barang ' . date('Y-m-d H:i:s') . '.pdf');
    }
}