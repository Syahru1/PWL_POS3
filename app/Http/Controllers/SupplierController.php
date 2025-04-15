<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
class SupplierController extends Controller
{
    // // Menampilkan halaman awal suplier
    // public function index()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Daftar Suplier',
    //         'list' => ['Home', 'Suplier']
    //     ];

    //     $page = (object) [
    //         'title' => 'Daftar suplier yang terdaftar dalam sistem'
    //     ];

    //     $activeMenu = 'suplier'; // Set menu yang sedang aktif

    //     return view('suplier.index', [
    //         'breadcrumb' => $breadcrumb,
    //         'page' => $page,
    //         'activeMenu' => $activeMenu
    //     ]);
    // }

    // // Menampilkan halaman form tambah suplier
    // public function create()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Tambah Suplier',
    //         'list' => ['Home', 'Suplier', 'Tambah']
    //     ];

    //     $page = (object) [
    //         'title' => 'Tambah suplier baru'
    //     ];

    //     $activeMenu = 'suplier'; // set menu yang sedang aktif

    //     return view('suplier.create', [
    //         'breadcrumb' => $breadcrumb,
    //         'page' => $page,
    //         'activeMenu' => $activeMenu
    //     ]);
    // }

    // // Menyimpan data suplier baru
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_suplier' => 'required|string|max:100', // Nama suplier wajib diisi dengan maksimal 100 karakter
    //         'kontak' => 'required|string|max:50', // Kontak wajib diisi
    //         'alamat' => 'required|string|max:200', // Alamat wajib diisi
    //     ]);

    //     SupplierModel::create([
    //         'nama_suplier' => $request->nama_suplier,
    //         'kontak' => $request->kontak,
    //         'alamat' => $request->alamat,
    //     ]);

    //     return redirect('/suplier')->with('success', 'Data suplier berhasil disimpan');
    // }

    // // Menampilkan detail suplier
    // public function show($id)
    // {
    //     $suplier = SupplierModel::find($id);

    //     if (!$suplier) {
    //         return redirect('/suplier')->with('error', 'Suplier tidak ditemukan');
    //     }

    //     $breadcrumb = (object) [
    //         'title' => 'Detail Suplier',
    //         'list' => ['Home', 'Suplier', 'Detail']
    //     ];

    //     $page = (object) [
    //         'title' => 'Detail suplier'
    //     ];

    //     $activeMenu = 'suplier'; // Set menu yang sedang aktif

    //     return view('suplier.suplierShow', [
    //         'suplier' => $suplier,
    //         'breadcrumb' => $breadcrumb,
    //         'page' => $page,
    //         'activeMenu' => $activeMenu
    //     ]);
    // }

    // // Menampilkan halaman form edit suplier
    // public function edit(string $id)
    // {
    //     $suplier = SupplierModel::find($id);

    //     $breadcrumb = (object) [
    //         "title" => "Edit Suplier",
    //         "list" => ['Home', 'Suplier', 'Edit']
    //     ];

    //     $page = (object) [
    //         "title" => "Edit suplier"
    //     ];

    //     $activeMenu = 'suplier'; // set menu yang sedang aktif

    //     return view('suplier.edit', [
    //         'breadcrumb' => $breadcrumb,
    //         'page' => $page,
    //         'suplier' => $suplier,
    //         'activeMenu' => $activeMenu
    //     ]);
    // }

    // // Menyimpan perubahan data suplier
    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'nama_suplier' => 'required|string|max:100', // nama suplier harus diisi, berupa string, dan maksimal 100 karakter
    //         'kontak' => 'required|string|max:50', // kontak harus diisi
    //         'alamat' => 'required|string|max:200', // alamat harus diisi
    //     ]);

    //     SupplierModel::find($id)->update([
    //         'nama_suplier' => $request->nama_suplier,
    //         'kontak' => $request->kontak,
    //         'alamat' => $request->alamat,
    //     ]);

    //     return redirect('/suplier')->with('success', 'Data suplier berhasil diubah');
    // }

    // // Menghapus data suplier
    // public function destroy(string $id)
    // {
    //     $check = SupplierModel::find($id);
    //     if (!$check) {      //untuk mengecek apakah data suplier yang akan dihapus ada atau tidak
    //         return redirect('/suplier')->with('error', 'Data suplier tidak ditemukan');
    //     }
    //     try {
    //         SupplierModel::destroy($id);
    //         return redirect('/suplier')->with('success', 'Data suplier berhasil dihapus');
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         //jika terjadi error ketika menghapus data, maka tampilkan pesan error dan redirect ke halaman suplier
    //         return redirect('/suplier')->with('error', 'Data suplier sedang digunakan');
    //     }
    // }

    // public function create_ajax()
    // {
    //     return view('suplier.create_ajax');
    // }

    // public function store_ajax(Request $request)
    // {
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $rules = [
    //             'nama_suplier' => 'required|string|max:100',
    //             'kontak' => 'required|string|max:50',
    //             'alamat' => 'required|string|max:200'
    //         ];

    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Validasi Gagal',
    //                 'msgField' => $validator->errors(),
    //             ]);
    //         }

    //         SupplierModel::create($request->all());
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Data suplier berhasil disimpan'
    //         ]);
    //     }
    //     return redirect('/');
    // }

    // // Ambil data suplier dalam bentuk json untuk datatables
    // public function list(Request $request)
    // {
    //     $suplier = SupplierModel::select('suplier_id', 'nama_suplier', 'kontak', 'alamat');

    //     return DataTables::of($suplier)
    //         ->addIndexColumn() // Menambahkan kolom index / no urut (default: DT_RowIndex)
    //         ->addColumn('aksi', function ($suplier) {
    //             $btn = '<a href="' . url('/suplier/' . $suplier->suplier_id . '/show') . '" class="btn btn-info btn-sm">Detail</a> ';
    //             $btn .= '<button onclick="modalAction(\'' . url('/suplier/' . $suplier->suplier_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
    //             $btn .= '<button onclick="modalAction(\'' . url('/suplier/' . $suplier->suplier_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

    //             return $btn;
    //         })
    //         ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi berisi HTML
    //         ->make(true);
    // }

    // //Menampilkan halaman form edit suplier ajax
    // public function edit_ajax(string $id)
    // {
    //     $suplier = SupplierModel::find($id);
    //     return view('suplier.edit_ajax', [
    //         'suplier' => $suplier
    //     ]);
    // }

    // public function update_ajax(Request $request, $id)
    // {
    //     // cek apakah request dari ajax
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $rules = [
    //             'nama_suplier' => 'required|string|max:100',
    //             'kontak' => 'required|string|max:50',
    //             'alamat' => 'required|string|max:200'
    //         ];

    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => false,    // respon json, true: berhasil, false: gagal
    //                 'message' => 'Validasi gagal.',
    //                 'msgField' => $validator->errors()  // menunjukkan field mana yang error
    //             ]);
    //         }

    //         $check = SupplierModel::find($id);
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
    //     return redirect('/suplier');
    // }

    // public function confirm_ajax(string $id)
    // {
    //     $suplier = SupplierModel::find($id);
    //     return view('suplier.confirm_ajax', [
    //         'suplier' => $suplier
    //     ]);
    // }

    // public function delete_ajax(Request $request, $id)
    // {
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $suplier = SupplierModel::find($id);
    //         if ($suplier) {
    //             $suplier->delete();
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
    //     return redirect('/suplier');
    // }

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];

        $page = (object) [
            'title' => 'Daftar supplier yang terdaftar dalam sistem',
        ];

        $activeMenu = 'supplier'; // untuk set menu yang sedang aktif

        return view('suplier.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list()
    {
        $suppliers = SupplierModel::select('supplier_id', 'nama_supplier','kontak', 'alamat');

        return DataTables::of($suppliers)->addIndexColumn()->addColumn('aksi', function ($supplier) {

            $btn  = '<button onclick="modalAction(\'' . url('/suplier/' . $supplier->supplier_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/suplier/' . $supplier->supplier_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/suplier/' . $supplier->supplier_id . '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah supplier baru',
        ];

        $activeMenu = 'supplier'; // untuk set menu yang sedang aktif

        return view('suplier.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'    => 'required|integer|unique:m_supplier,supplier_id',
            'nama_supplier'  => 'required|string|max:100',
            'kontak'         => 'required|string|max:20',
            'alamat'         => 'required|string|max:255',
        ]);

        SupplierModel::create($request->only(['supplier_id', 'nama_supplier', 'kontak', 'alamat']));

        return redirect('/suplier')->with('success', 'Data supplier berhasil ditambahkan!');
    }


    public function create_ajax()
    {
        return view('suplier.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_id'    => 'required|integer|unique:m_supplier,supplier_id',
                'nama_supplier'  => 'required|string|max:100',
                'kontak'         => 'required|string|max:20',
                'alamat'         => 'required|string|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validasi Gagal',
                    'errors'  => $validator->errors(), // Perbaikan: gunakan 'errors' bukan 'msgField'
                ]);
            }

            $supplier = SupplierModel::create($request->only(['supplier_id', 'nama_supplier', 'kontak', 'alamat']));

            return response()->json([
                'status'  => true,
                'message' => 'Data supplier berhasil disimpan',
                'data'    => $supplier, // Perbaikan: Kirim data supplier yang berhasil disimpan
            ]);
        }
        return redirect('/suplier');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Detail Supplier',
            'list' => ['Home', 'Supplier', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail supplier',
        ];

        $activeMenu = 'supplier'; // untuk set menu yang sedang aktif

        $supplier = SupplierModel::find($id);

        return view('suplier.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    public function show_ajax(string $id)
    {
        $supplier = SupplierModel::find($id);

        return view('suplier.show_ajax', ['supplier' => $supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Edit Supplier',
            'list' => ['Home', 'Supplier', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit supplier',
        ];

        $activeMenu = 'supplier'; // untuk set menu yang sedang aktif

        $supplier = SupplierModel::find($id);

        return view('suplier.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'nama_supplier' => 'required|string|max:100',
        'kontak'        => 'required|string|max:20',
        'alamat'        => 'required|string|max:255',
    ]);

    $supplier = SupplierModel::find($id);
    if (!$supplier) {
        return redirect('/suplier')->with('error', 'Data supplier tidak ditemukan!');
    }

    $supplier->update([
        'nama_supplier' => $request->nama_supplier,
        'kontak'        => $request->kontak,
        'alamat'        => $request->alamat,
    ]);

    return redirect('/suplier')->with('success', 'Data supplier berhasil diubah!');
}

public function edit_ajax(string $id)
{
    $supplier = SupplierModel::find($id);
    return view('suplier.edit_ajax', ['supplier' => $supplier]);
}

public function update_ajax(Request $request, string $id)
{
    if ($request->ajax() || $request->wantsJson()) {
        $rules = [
            'nama_supplier' => 'required|string|max:100',
            'kontak'        => 'required|string|max:20',
            'alamat'        => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validasi Gagal',
                'errors'  => $validator->errors(),
            ]);
        }

        $supplier = SupplierModel::find($id);
        if (!$supplier) {
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        $supplier->update($request->only(['nama_supplier', 'kontak', 'alamat']));

        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil diupdate',
            'data'    => $supplier,
        ]);
    }

    return redirect('/suplier');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = SupplierModel::find($id);

        if (!$check) {
            return redirect('/suplier')->with('error', 'Data supplier tidak ditemukan!');
        }

        try {
            SupplierModel::destroy($id);

            return redirect('/suplier')->with('success', 'Data supplier berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/suplier')->with('error', 'Data supplier gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini!');
        }
    }

    public function confirm_ajax(string $id)
    {
        $supplier = SupplierModel::find($id);

        return view('suplier.confirm_ajax', ['supplier' => $supplier]);
    }

    public function delete_ajax(Request $request, $id)
{
    try {
        if ($request->ajax() || $request->wantsJson()) {
            $supplier = SupplierModel::find($id);
            if ($supplier) {
                $supplier->delete();
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil dihapus',
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        }
    } catch (\Illuminate\Database\QueryException $e) {
        return response()->json([
            'status'  => false,
            'message' => 'Data supplier gagal dihapus karena masih terdapat tabel lain yang terkait',
        ]);
    }
    return redirect('/suplier');
    }

    public function import()
    {
        return view('suplier.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_supplier' => ['required', 'mimes:xlsx,xls', 'max:1024'] // max 1MB
            ];
    
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi Gagal',
                    'errors'   => $validator->errors()
                ]);
            }
    
            try {
                $file = $request->file('file_supplier');
                $spreadsheet = IOFactory::load($file);
                $sheet = $spreadsheet->getActiveSheet();
                $rows = $sheet->toArray();
    
                // Asumsikan baris pertama adalah header
                unset($rows[0]);
    
                $imported = 0;
                foreach ($rows as $row) {
                    $supplierId    = $row[0] ?? null;
                    $namaSupplier  = $row[1] ?? null;
                    $kontak        = $row[2] ?? null;
                    $alamat        = $row[3] ?? null;
    
                    // Validasi sederhana tiap baris (bisa dikembangkan)
                    if ($supplierId && $namaSupplier && $kontak && $alamat) {
                        // Hindari duplikasi berdasarkan supplier_id
                        $exists = SupplierModel::find($supplierId);
                        if (!$exists) {
                            SupplierModel::create([
                                'supplier_id'   => $supplierId,
                                'nama_supplier' => $namaSupplier,
                                'kontak'        => $kontak,
                                'alamat'        => $alamat,
                            ]);
                            $imported++;
                        }
                    }
                }
    
                return response()->json([
                    'status'  => true,
                    'message' => "$imported data supplier berhasil diimport.",
                ]);
    
            } catch (\Exception $e) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Terjadi kesalahan saat membaca file: ' . $e->getMessage()
                ]);
            }
        }
    
        return redirect('/suplier');
    }
    //fungsi export
    public function export_excel()
    {
        //ambil data suplier
        $suplier = SupplierModel::select(
            'suplier_id',
            'nama_suplier',
            'kontak',
            'alamat',
        )
            ->orderBy('suplier_id')
            ->get();

        //load spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        //set header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID suplier');
        $sheet->setCellValue('C1', 'Nama suplier');
        $sheet->setCellValue('D1', 'Kontak');
        $sheet->setCellValue('E1', 'Alamat');

        $sheet->getStyle('A1:E1')->getFont()->setBold(true); ///bold header

        //set data
        $no = 1;
        $baris = 2;
        foreach ($suplier as $row) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $row->suplier_id);
            $sheet->setCellValue('C' . $baris, $row->nama_suplier);
            $sheet->setCellValue('D' . $baris, $row->kontak);
            $sheet->setCellValue('E' . $baris, $row->alamat);
            $no++;
            $baris++;
        }

        //set lebar kolom
        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); //set autosize
        }

        //set judul file
        $sheet->setTitle('Data Suplier'); // set title sheet

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Suplier ' . date(format: 'Y-m-d H:i:s') . '.xlsx';

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
}