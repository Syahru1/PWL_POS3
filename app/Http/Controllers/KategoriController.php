<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class KategoriController extends Controller
{
    // public function index()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Daftar Kategori',
    //         'list' => ['Home', 'Kategori']
    //     ];

    //     $page = (object) [
    //         'title' => 'Daftar kategori dalam sistem'
    //     ];

    //     $activeMenu = 'kategori';

    //     $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama')->get();

    //     return view('kategori.index', [
    //         'breadcrumb' => $breadcrumb,
    //         'page' => $page,
    //         'activeMenu' => $activeMenu,
    //         'kategori' => $kategori
    //     ]);
    // }

    // public function create()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Tambah Kategori',
    //         'list' => ['Home', 'Kategori', 'Tambah']
    //     ];

    //     $page = (object) [
    //         'title' => 'Tambah kategori baru'
    //     ];

    //     $kategori = KategoriModel::all(); // Ambil data kategori untuk ditampilkan di form
    //     $activeMenu = 'kategori'; // Set menu yang sedang aktif

    //     return view('kategori.kategoriCreate', [
    //         'breadcrumb' => $breadcrumb,
    //         'page' => $page,
    //         'kategori' => $kategori,
    //         'activeMenu' => $activeMenu
    //     ]);
    // }

    // public function list(Request $request)
    // {
    //     $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

    //     if ($request->kategori_id) {
    //         $kategori->where('kategori_id', $request->kategori_id);
    //     }

    //     return DataTables::of($kategori)
    //         ->addIndexColumn()
    //         ->addColumn('aksi', function ($kategori) {
    //             $btn = '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/show') . '\')" class="btn btn-info btn-sm">Detail</button> ';
    //             $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
    //             $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi'])
    //         ->make(true);
    // }

    // public function store_ajax(Request $request)
    // {
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $rules = [
    //             'kategori_kode' => 'required|string|max:10|unique:kategoris,kategori_kode',
    //             'kategori_nama' => 'required|string|max:100',
    //         ];

    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Validasi Gagal',
    //                 'msgField' => $validator->errors(),
    //             ]);
    //         }

    //         // Simpan data kategori ke database
    //         KategoriModel::create([
    //             'kategori_kode' => $request->kategori_kode,
    //             'kategori_nama' => $request->kategori_nama,
    //         ]);

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Data kategori berhasil disimpan'
    //         ]);
    //     }

    //     // Redirect jika bukan AJAX request
    //     return redirect('/');
    // }


    // public function create_ajax()
    // {
    //     return view('kategori.create_ajax');
    // }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'kategori_kode' => 'required|string|max:10|unique:kategoris,kategori_kode',
    //         'kategori_nama' => 'required|string|max:100',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Validasi Gagal',
    //             'msgField' => $validator->errors()
    //         ]);
    //     }

    //     // Simpan ke database jika validasi lolos
    //     $kategori = KategoriModel::create([
    //         'kategori_kode' => $request->kategori_kode,
    //         'kategori_nama' => $request->kategori_nama
    //     ]);

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Data berhasil disimpan!',
    //         'data' => $kategori
    //     ]);
    // }

    // public function edit_ajax(string $id)
    // {
    //     $kategori = KategoriModel::find($id);
    //     return view('kategori.edit_ajax', ['kategori' => $kategori]);
    // }

    // public function update_ajax(Request $request, $id)
    // {
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $kategori = KategoriModel::find($id);
    //         if (!$kategori) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Data tidak ditemukan'
    //             ]);
    //         }

    //         $rules = [
    //             'kategori_kode' => [
    //                 'sometimes',
    //                 'required',
    //                 'string',
    //                 'max:10',
    //                 Rule::unique('m_kategori', 'kategori_kode')->ignore($id, 'kategori_id')
    //             ],
    //             'kategori_nama' => 'sometimes|required|string|max:100'
    //         ];

    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Validasi gagal.',
    //                 'msgField' => $validator->errors()
    //             ]);
    //         }

    //         // Update hanya jika ada perubahan
    //         $kategori->update($request->only(['kategori_kode', 'kategori_nama']));

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Data kategori berhasil diupdate'
    //         ]);
    //     }

    //     return redirect('/kategori');
    // }

    // public function confirm_ajax(string $id)
    // {
    //     $kategori = KategoriModel::find($id);
    //     return view('kategori.confirm_ajax', ['kategori' => $kategori]);
    // }

    // public function delete_ajax(Request $request, $id)
    // {
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $kategori = KategoriModel::find($id);
    //         if ($kategori) {
    //             $kategori->delete();
    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Data kategori berhasil dihapus'
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Data tidak ditemukan'
    //             ]);
    //         }
    //     }
    //     return redirect('/kategori');
    // }

    // public function show($kategori_id)
    // {
    //     $kategori = KategoriModel::find($kategori_id);

    //     $breadcrumb = (object) [
    //         'title' => 'Detail Kategori',
    //         'list' => ['Home', 'Kategori', 'Detail']
    //     ];

    //     $page = (object) [
    //         'title' => 'Detail kategori'
    //     ];

    //     $activeMenu = 'kategori';

    //     return view('kategori.kategoriShow', [
    //         'kategori' => $kategori,
    //         'breadcrumb' => $breadcrumb,
    //         'page' => $page,
    //         'activeMenu' => $activeMenu
    //     ]);
    // }
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang terdaftar dalam sistem',
        ];

        $activeMenu = 'kategori'; // untuk set menu yang sedang aktif

        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list()
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($kategori)->addIndexColumn()->addColumn('aksi', function ($kategori) {

            $btn  = '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah kategori baru',
        ];

        $activeMenu = 'kategori';

        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|string|max:100',
        ]);

        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil ditambahkan.');
    }

    public function create_ajax()
    {
        return view('kategori.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode',
                'kategori_nama' => 'required|string|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            KategoriModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data kategori berhasil disimpan'
            ]);
        }
        return redirect('/kategori');
    }

    public function show(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail kategori',
        ];

        $activeMenu = 'kategori'; // untuk set menu yang sedang aktif

        $kategori = KategoriModel::find($id);

        return view('kategori.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }

    public function show_ajax(string $id)
    {
        $kategori = KategoriModel::find($id);

        return view('kategori.show_ajax', ['kategori' => $kategori]);
    }

    public function edit(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kategori',
        ];

        $activeMenu = 'kategori'; // untuk set menu yang sedang aktif

        $kategori = KategoriModel::find($id);

        return view('kategori.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'kategori_nama' => 'required|string|max:100',
        ]);

        KategoriModel::find($id)->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah!');
    }

    public function edit_ajax(string $id)
    {
        $kategori = KategoriModel::find($id);

        return view('kategori.edit_ajax', ['kategori' => $kategori]);
    }

    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
                'kategori_nama' => 'required|string|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $check = KategoriModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/kategori');
    }

    public function destroy(string $id)
    {
        $check = KategoriModel::find($id);

        if (!$check) {
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan!');
        }

        try {
            KategoriModel::destroy($id);

            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini!');
        }
    }

    public function confirm_ajax(string $id)
    {
        $kategori = KategoriModel::find($id);

        return view('kategori.confirm_ajax', ['kategori' => $kategori]);
    }

    public function delete_ajax(Request $request, $id)
    {
        try {
            if ($request->ajax() || $request->wantsJson()) {
                $kategori = KategoriModel::find($id);
                if ($kategori) {
                    $kategori->delete();
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
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini'
            ]);
        }
        return redirect('/kategori');
    }

    public function import()
    {
        return view('kategori.import');
    }

public function import_ajax(Request $request)
{
    if ($request->ajax() || $request->wantsJson()) {
        $rules = [
            'file_kategori' => ['required', 'mimes:xlsx,xls', 'max:1024'] // 1MB max
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors()
            ]);
        }

        $file = $request->file('file_kategori');

        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, false, true, true); // ['A' => 'kode', 'B' => 'nama']

        $insert = [];
        if (count($data) > 1) {
            foreach ($data as $row => $value) {
                if ($row > 1) { // Lewati baris pertama (header)
                    if (!empty($value['A']) && !empty($value['B'])) {
                        $insert[] = [
                            'kategori_kode' => $value['A'],
                            'kategori_nama' => $value['B'],
                        ];
                    }
                }
            }

            if (!empty($insert)) {
                // Optional: validasi unik kategori_kode sebelum insert
                foreach ($insert as $item) {
                    $exists = KategoriModel::where('kategori_kode', $item['kategori_kode'])->exists();
                    if (!$exists) {
                        KategoriModel::create($item);
                    }
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Data kategori berhasil diimport'
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Tidak ada data yang bisa diimport'
        ]);
    }

    return redirect('/kategori');
}
//fungsi export
public function export_excel()
{
    //ambil data kategori
    $kategori = KategoriModel::select(
        'kategori_id',
        'kategori_kode',
        'kategori_nama',
    )
        ->orderBy('kategori_id')
        ->get();

    //load spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    //set header
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Kode kategori');
    $sheet->setCellValue('C1', 'Nama kategori');

    $sheet->getStyle('A1:C1')->getFont()->setBold(true); ///bold header

    //set data
    $no = 1;
    $baris = 2;
    foreach ($kategori as $row) {
        $sheet->setCellValue('A' . $baris, $no);
        $sheet->setCellValue('B' . $baris, $row->kategori_kode);
        $sheet->setCellValue('C' . $baris, $row->kategori_nama);
        $no++;
        $baris++;
    }

    //set lebar kolom
    foreach (range('A', 'C') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true); //set autosize
    }

    //set judul file
    $sheet->setTitle('Data Kategori'); // set title sheet

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $filename = 'Data Kategori ' . date(format: 'Y-m-d H:i:s') . '.xlsx';

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
        $kategori = KategoriModel::orderBy('kategori_id')
            ->orderBy('kategori_kode')
            ->get();
 
        //gunakan barryvdh dompdf
        $pdf = PDF::loadview('kategori.export_pdf', ['kategori' => $kategori]);
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption("isRemoteEnabled", true);
        $pdf->render();
 
        return $pdf->download('Data kategori ' . date('Y-m-d H:i:s') . '.pdf');
    }

}