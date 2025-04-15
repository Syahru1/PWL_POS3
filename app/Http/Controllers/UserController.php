<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\LevelModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
class UserController extends Controller
{
    // public function index()
    // {     
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => Hash::make('12345'),
        // ];
        // UserModel::create($data);

        // $user = UserModel::all();
        // return view('user', ['data' => $user]);

        // $user = UserModel::findOrFail(1); 
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('username', 'manager9')->firstOrFail();
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('level_id', 2)->count();
        // // dd($user);
        // return view('user', ['user' => $user]);

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ],
        // );
        // return view('user', ['data' => $user]);

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // return view('user', ['data' => $user]);
        
        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ],
        // );
        // return view('user', ['data' => $user]);

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user->save();
        // return view('user', ['data' => $user]);

        // $user = UserModel::create(
        //     [
        //         'username' => 'manager55',
        //         'nama' => 'Manager55',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ]);

        //     $user->username = 'manager56';

        //     $user->isDirty(); // true
        //     $user->isDirty('username'); // true
        //     $user->isDirty('nama'); // false
        //     $user->isDirty(['nama', 'username']); // true
            
        //     $user->isClean(); // false
        //     $user->isClean('username'); // false
        //     $user->isClean('nama'); // true
        //     $user->isClean(['nama', 'username']); // false

        //     $user->save();

        //     $user->isDirty(); // false
        //     $user->isClean(); // true
        //     dd($user->isDirty());

    //     $user = UserModel::create([
    //         'username' => 'manager11',
    //         'nama' => 'Manager11',
    //         'password' => Hash::make('12345'),
    //         'level_id' => 2
    //     ]);

    //     $user->username = 'manager12';
    //     $user->save();

    //     $user->wasChanged(); // true
    //     $user->wasChanged('username'); // true
    //     $user->wasChanged(['username', 'level_id']); // true
    //     $user->wasChanged('nama'); // true
    //     dd($user->wasChanged(['nama', 'username'])); // true
    
    // $user = UserModel::all();
    // return view('user', ['data' => $user]);
    
    // }

    // public function index() {
    //     $user = UserModel::all();
    //     return view('user', ['data' => $user]);
    // }

    // public function tambah() {
    //     return view('user_tambah');
    // }

    // public function tambah_simpan(Request $request) {
    //     UserModel::create([
    //         'username' => $request->username,
    //         'nama' => $request->nama,
    //         'password' => Hash::make($request->password),
    //         'level_id' => $request->level_id
    //     ]);

    //     return redirect('/user');
    // }

    // public function ubah($id) {
    //     $user = UserModel::find($id);
    //     return view('user_ubah', ['data' => $user]);
    // }

    // public function ubah_simpan($id, Request $request) {
    //     $user = UserModel::find($id);

    //     $user->username => $request->username;
    //     $user->nama => $request->nama;
    //     $user->password => Hash::make($request->password);
    //     $user->level_id => $request->level_id;

    //     $user->save();

    //     return redirect('/user');
    // }

    // public function hapus($id) {
    //     $user = UserModel::find($id);
    //     $user->delete();

    //     return redirect('/user');
    // }

    // public function index() {
    //     $user = UserModel::with('level')->get();
    //     return view('user', ['data' => $user]);
    // }

    // // Menampilkan halaman awal user
    // public function index() {
    //     $breadcrumb = (object) [
    //         'title' => 'Daftar User',
    //         'list' => ['Home', 'User']
    //     ];

    //     $page = (object) [
    //         'title' => 'Daftar user yang terdaftar dalam sistem'
    //     ];

    //     $activeMenu = 'user'; // set menu sedang aktif
    //     $level = LevelModel::all(); // ambil data level untuk filter level

    //     return view('user.index', [
    //         'breadcrumb' => $breadcrumb,
    //         'page' => $page, 
    //         'level' => $level, 
    //         'activeMenu' => $activeMenu
    //     ]);
    // }

    // // Ambil data user dalam bentuk json untuk datatables
    // public function list(Request $request) {
    //     $users = UserModel::select('user_id', 'username', 'nama', 'level_id')->with('level');

    //     // Filter data user verdasarkan level_id
    //     if ($request->level_id) {
    //         $users->where('level_id', $request->level_id);
    //     }  

    //     return DataTables::of($users) 
    //         // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
    //         ->addIndexColumn()
    //         ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
    //             $btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
    //             $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
    //             $btn .= '<form class="d-inline-block" method="POST" action="'. url('/user/'.$user->user_id).'">' 
    //                     . csrf_field() 
    //                     . method_field('DELETE') 
    //                     . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">
    //                         Hapus
    //                     </button>'
    //                     . '</form>';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
    //     ->make(true);
    // }

    // // Menampilkan halaman form tambah user
    // public function create() {
    //     $breadcrumb = (object) [
    //         'title' => 'Tambah User',
    //         'list' => ['Home', 'User', 'Tambah']
    //     ];
    
    //     $page = (object) [
    //         'title' => 'Tambah user baru'
    //     ];
            
    //     $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
    //     $activeMenu = 'user'; // set menu sedang aktif
    
    //     return view('user.create', [
    //         'breadcrumb' => $breadcrumb, 
    //         'page' => $page, 
    //         'level' => $level, 
    //         'activeMenu' => $activeMenu
    //     ]);
    // }

    // // Menyimpan data user baru
    // public function store(Request $request) {
    //     $request->validate([
    //         // Username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
    //         'username' => 'required|string|min:3|unique:m_user,username',
    //         'nama'     => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
    //         'password' => 'required|min:5',          // password harus diisi dan minimal 5 karakter
    //         'level_id' => 'required|integer'        // level_id harus diisi dan berupa angka               
    //     ]);

    //     UserModel::create([
    //         'username' => $request->username,
    //         'nama'     => $request->nama,
    //         'password' => bcrypt($request->password), //password dienkripsi sebelum disimpan
    //         'level_id' => $request->level_id
    //     ]);

    //     return redirect('/user')->with('success', 'Data user berhasil disimpan');
    // }

    // // Menampilkan detail user
    // public function show(string $id) {
    //     $user = UserModel::with('level')->find($id);

    //     $breadcrumb = (object) [
    //         'title' => 'Detail User',
    //         'list' => ['Home', 'User', 'Detail']
    //     ];

    //     $page = (object) [
    //         'title' => 'Detail user'
    //     ];

    //     $activeMenu = 'user'; // set menu yang sedang aktif

    //     return view('user.show', [
    //         'breadcrumb' => $breadcrumb, 
    //         'page' => $page, 'user' => $user, 
    //         'activeMenu' => $activeMenu
    //     ]);
    // }

    // // Menampilkan halaman form edit user
    // public function edit(string $id) {
    //     $user = UserModel::find($id);
    //     $level = LevelModel::all();

    //     $breadcrumb = (object) [
    //         'title' => 'Edit User',
    //         'list' => ['Home', 'User', 'Edit']
    //     ];

    //     $page = (object) [
    //         'title' => 'Edit user'
    //     ];
    //     $activeMenu = 'user'; // set menu yang sedang aktif
        
    //     return view('user.edit',[
    //         'breadcrumb' => $breadcrumb, 
    //         'page' => $page, 
    //         'user' => $user, 
    //         'level' => $level, 
    //         'activeMenu' => $activeMenu]);
    // }

    // // Menyimpan perubahan data user
    // public function update(Request $request, string $id) {
    //     $request->validate([
    //         // username harus diisi, berupa string, minimal 3 karakter,
    //         // dan bernilai unik di tabel m_user kolom username kecuali untuk user dengan id yang sedang diedit
    //         'username' => 'required|string|min:3|unique:m_user,username,' .$id. ',user_id',
    //         'nama'     => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
    //         'password' => 'required|min:5',          // password harus diisi (minimal 5 karakter) dan bisa tidak diisi
    //         'level_id' => 'required|integer'        // level_id harus diisi dan berupa angka               
    //     ]);

    //     UserModel::find($id)->update([
    //         'username' => $request->username,
    //         'nama'     => $request->nama,
    //         'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password, //password dienkripsi sebelum disimpan
    //         'level_id' => $request->level_id
    //     ]);

    //     return redirect('/user')->with('success', 'Data user berhasil diubah');
    // }

    // // Menghapus data user
    // public function destroy(string $id) {
    //     $check = UserModel::find($id);
    //     if (!$check) { // Untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
    //         return redirect('/user')->with('error', 'Data user tidak ditemukan');
    //     }

    //     try {
    //         UserModel::destroy($id); //Hapus data level
    //         return redirect('/user')->with('success', 'Data user berhasil dihapus');
    //     }catch (\Illuminate\Database\QueryException $e) {
    //         // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
    //         return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    //     }
    // }

    // public function create_ajax() {
    //     $level = LevelModel::select('level_id', 'level_nama')->get();
    //     return view('user.create_ajax')->with('level', $level);
    // }

    // public function store_ajax(Request $request) {
    //     //cek apakah request berupa ajax
    //     if($request->ajax() || $request->wantsJson()) {
    //         $rules = [
    //             'level_id' => 'required|integer',
    //             'username' => 'required|string|min:3|unique:m_user,username',
    //             'nama'     => 'required|string|max:100',
    //             'password' => 'required|min:6'
    //         ];

    //         // use Illuminate\Support\Facades\Validator;
    //         $validator = Validator::make($request->all(), $rules);

    //         if($validator->fails()) {
    //             return response()->json([
    //                 'status' => false, // response status, false: error/gagal, true: berhasil
    //                 'message' => 'Validasi Gagal',
    //                 'msgField' => $validator->errors(), // pesan error validasi 
    //             ]);
    //         }

    //         UserModel::create($request->all());
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Data user berhasil disimpan'
    //         ]);
    //     }
    //     redirect('/');
    // }

    // // Ambil data user dalam bentuk json untuk datatables  
    // public function list(Request $request)  {  
    //     $users = UserModel::select('user_id', 'username', 'nama', 'level_id')  
    //     ->with('level'); 

    // // Filter data user berdasarkan level_id     
    // if ($request->level_id){ 
    //     $users->where('level_id',$request->level_id); 
    // }      
    // return DataTables::of($users) 
    //     ->addIndexColumn()  // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)  
    //     ->addColumn('aksi', function ($user) {  // menambahkan kolom aksi  
    //     /* $btn  = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btnsm">Detail</a> ';  
    //     $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btnwarning btn-sm">Edit</a> ';  
    //     $btn .= '<form class="d-inline-block" method="POST" action="'. url('/user/'.$user>user_id).'">'  
    //         . csrf_field() . method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm" 
    //         onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';*/             
    //     // $btn  = '<button onclick="modalAction(\''.url('/user/' . $user->user_id . 
    //     //         '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> '; 
    //     // $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . 
    //     //         '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> '; 
    //     // $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . 
    //     //         '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> '; 
    //     // return $btn;  
    //     $btn = '<a href="' . url('/user/' . $user->user_id . '/show') . '" class="btn btn-info btn-sm">Detail</a> ';
    //     $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
    //     $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

    //     return $btn;
    // })  
    // ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html  
    // ->make(true);  
    // } 

    // // Menampilkan halaman form edit user ajax
    // public function edit_ajax(string $id) {
    //     $user = UserModel::find($id);
    //     $level = LevelModel::select('level_id', 'level_nama')->get();

    //     return view('user.edit_ajax',['user' => $user, 'level' => $level]);
    // }

    // public function update_ajax(Request $request, $id){ 
    //     // cek apakah request dari ajax 
    //     if ($request->ajax() || $request->wantsJson()) {         
    //         $rules = [ 
    //             'level_id' => 'required|integer', 
    //             'username' => 'required|max:20|unique:m_user,username,'.$id.',user_id', 
    //             'nama'     => 'required|max:100', 
    //             'password' => 'nullable|min:6|max:20'         
    //         ]; 
    //             // use Illuminate\Support\Facades\Validator; 
    //         $validator = Validator::make($request->all(), $rules); 
    //         if ($validator->fails()) {             
    //             return response()->json([ 
    //                 'status'   => false,    // respon json, true: berhasil, false: gagal 
    //                 'message'  => 'Validasi gagal.', 
    //                 'msgField' => $validator->errors()  // menunjukkan field mana yang error 
    //             ]); 
    //         } 
        
    //         $check = UserModel::find($id);         
    //         if ($check) { 
    //             if(!$request->filled('password') ){ // jika password tidak diisi, maka hapus dari request 
    //                    $request->request->remove('password'); 
    //             } 
                    
    //             $check->update($request->all());             
    //             return response()->json([ 
    //                 'status'  => true, 
    //                 'message' => 'Data berhasil diupdate' 
    //             ]);         
    //         } else{ 
    //             return response()->json([ 
    //                 'status'  => false, 
    //                 'message' => 'Data tidak ditemukan' 
    //             ]); 
    //         }     
    //     } 
    //     return redirect('/'); 
    // } 

    // public function confirm_ajax(string $id) {
    //     $user = UserModel::find($id);

    //     return view('usser.confirm_ajax', ['user' => $user]);
    // }

    // public function delete_ajax(Request $request, $id) {
    //     // cek apakah request dari ajax
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $user = UserModel::find($id);
    //         if ($user) {
    //             $user->delete();
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
    //     return redirect('/');
    // }
     // Menampilkan halaman awal user
     public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar User',
             'list' => ['Home', 'User']
         ];
 
         $page = (object) [
             'title' => 'Daftar user yang terdaftar dalam sistem'
         ];
 
         $activeMenu = 'user'; // Set menu yang sedang aktif
 
         $level = LevelModel::all(); //ambil data level untuk filter level
 
         return view('user.index', [
             'breadcrumb' => $breadcrumb,
             'page' => $page,
             'level' => $level,
             'activeMenu' => $activeMenu
         ]);
     }
 
     // Menyimpan data user baru
     public function store(Request $request)
     {
         $request->validate([
             'username' => 'required|string|min:3|unique:m_user,username', // Username harus unik, minimal 3 karakter
             'nama' => 'required|string|max:100', // Nama wajib diisi dengan maksimal 100 karakter
             'password' => 'required|min:5', // Password minimal 5 karakter
             'level_id' => 'required|integer' // Level ID harus berupa angka
         ]);
 
         UserModel::create([
             'username' => $request->username,
             'nama' => $request->nama,
             'password' => bcrypt($request->password), // Mengenkripsi password sebelum disimpan
             'level_id' => $request->level_id
         ]);
 
         return redirect('/user')->with('success', 'Data user berhasil disimpan');
     }
 
    //  // Menampilkan detail user
    //  public function show($id)
    //  {
    //      $user = UserModel::with('level')->find($id);
 
    //      if (!$user) {
    //          return redirect('/user')->with('error', 'User tidak ditemukan');
    //      }
 
    //      $breadcrumb = (object) [
    //          'title' => 'Detail User',
    //          'list' => ['Home', 'User', 'Detail']
    //      ];
 
    //      $page = (object) [
    //          'title' => 'Detail user'
    //      ];
 
    //      $activeMenu = 'user'; // Set menu yang sedang aktif
 
    //      return view('user.show', [
    //          'user' => $user,
    //          'breadcrumb' => $breadcrumb,
    //          'page' => $page,
    //          'activeMenu' => $activeMenu
    //      ]);
    //  }

     // Menampilkan detail user
     public function show($id)
     {
         $user = UserModel::with('level')->find($id);
 
         $breadcrumb = (object) [
             'title' => 'Detail User',
             'list' => ['Home', 'User', 'Detail']
         ];
 
         $page = (object) [
             'title' => 'Detail user'
         ];
 
         $activeMenu = 'user'; // Set menu yang sedang aktif
 
         return view('user.show', [
             'user' => $user,
             'breadcrumb' => $breadcrumb,
             'page' => $page,
             'activeMenu' => $activeMenu
         ]);
     }
 
     // Menampilkan halaman form edit user
     public function edit(string $id)
     {
         $user = UserModel::find($id);
         $level = LevelModel::all();
 
         $breadcrumb = (object) [
             "title" => "Edit User",
             "list" => ['Home', 'User', 'Edit']
         ];
 
         $page = (object) [
             "title" => "Edit user"
         ];
 
         $activeMenu = 'user'; // set menu yang sedang aktif
 
         return view('user.edit', [
             'breadcrumb' => $breadcrumb,
             'page' => $page,
             'user' => $user,
             'level' => $level,
             'activeMenu' => $activeMenu
         ]);
     }
 
     // Menyimpan perubahan data user
     public function update(Request $request, string $id)
     {
         $request->validate([
             'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
             // username harus diisi, berupa string, minimal 3 karakter,
             // dan bernilai unik di tabel user kolom username kecuali untuk user dengan id yang sedang diedit
             'nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
             'password' => 'nullable|min:5', // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi
             'level_id' => 'required|integer' // level_id harus diisi dan berupa angka
         ]);
 
         UserModel::find($id)->update([
             'username' => $request->username,
             'nama' => $request->nama,
             'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
             'level_id' => $request->level_id
         ]);
 
         return redirect('/user')->with('success', 'Data user berhasil diubah');
     }
 
     // Menghapus data user
     public function destroy(string $id)
     {
         $check = UserModel::find($id);
         if (!$check) {      //untuk mengecek apakah data user yang akan dihapus ada atau tidak
             return redirect('/user')->with('error', 'Data user tidak ditemukan');
         }
         try {
             Usermodel::destroy($id);
             return redirect('/user')->with('success', 'Data user berhasil dihapus');
         } catch (\Illuminate\Database\QueryException $e) {
             //jika terjadi error ketika menghapus data, maka tampilkan pesan error dan redirect ke halaman user
             return redirect('/user')->with('error', 'Data user sedang digunakan');
         }
     }
 
     public function create_ajax()
     {
         $level = LevelModel::select('level_id', 'level_nama')->get();
 
         return view('user.create_ajax')->with('level', $level);
 
     }
 
     public function store_ajax(Request $request)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'level_id' => 'required|integer',
                 'username' => 'required|string|min:3|unique:m_user,username',
                 'nama' => 'required|string|max:100',
                 'password' => 'required|min:6'
             ];
 
             // use Illuminate\Support\Facades\Validator;
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false,
                     'message' => 'Validasi Gagal',
                     'msgField' => $validator->errors(),
                 ]);
             }
 
             UserModel::create($request->all());
             return response()->json([
                 'status' => true,
                 'message' => 'Data user berhasil disimpan'
             ]);
         }
         return redirect('/');
     }
 
      // Ambil data user dalam bentuk json untuk datatables
      public function list(Request $request)
      {
          $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
              ->with('level');

          // Filter data user berdasarkan level_id
          if ($request->level_id) {
              $users->where('level_id', $request->level_id);
          }

          return DataTables::of($users)
              ->addIndexColumn()  // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
              ->addColumn('aksi', function ($user) {  // menambahkan kolom aksi
                  /* $btn  = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn
                  sm">Detail</a> ';
                              $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn
                  warning btn-sm">Edit</a> ';
                              $btn .= '<form class="d-inline-block" method="POST" action="'. url('/user/'.$user
                  >user_id).'">'
                                      . csrf_field() . method_field('DELETE') .
                                      '<button type="submit" class="btn btn-danger btn-sm" onclick="return
                  confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';*/
                  $btn = '<button onclick="modalAction(\'' . url('/user/' . $user->user_id .
                      '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                  $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id .
                      '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                  $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id .
                      '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';

                  return $btn;
              })
              ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
              ->make(true);
      }
 
     //Menampilkan halaman form edit user ajax
     public function edit_ajax(string $id)
     {
         $user = UserModel::find($id);
         $level = LevelModel::select('level_id', 'level_nama')->get();
         return view('user.edit_ajax', [
             'user' => $user,
             'level' => $level
         ]);
     }
 
     public function update_ajax(Request $request, $id)
     {
         // cek apakah request dari ajax
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'level_id' => 'required|integer',
                 'username' => 'required|max:20|unique:m_user,username,' . $id . ',user_id',
                 'nama' => 'required|max:100',
                 'password' => 'nullable|min:6|max:20'
             ];
             // use Illuminate\Support\Facades\Validator;
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false,    // respon json, true: berhasil, false: gagal
                     'message' => 'Validasi gagal.',
                     'msgField' => $validator->errors()  // menunjukkan field mana yang error
                 ]);
             }
 
             $check = UserModel::find($id);
             if ($check) {
                 if (!$request->filled('password')) { // jika password tidak diisi, maka hapus dari request
                     $request->request->remove('password');
                 }
 
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
         return redirect('/user');
     }
 
     public function confirm_ajax(string $id)
     {
         $user = UserModel::find($id);
         return view('user.confirm_ajax', [
             'user' => $user
         ]);
     }
     public function delete_ajax(Request $request, $id)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $user = UserModel::find($id);
             if ($user) {
                 $user->delete();
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
         return redirect('/user');
     }
 
     public function import()
     {
         return view('user.import');
     }
 
     public function import_ajax(Request $request)
    {
        // Validasi file Excel
        $request->validate([
            'file_user' => 'required|mimes:xls,xlsx',
        ]);
        
        $file = $request->file('file_user');
        
        // Buka file Excel
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);
        
        $inserted = 0;
        $skipped = [];
        
        foreach ($rows as $index => $row) {
            // Skip header (baris pertama)
            if ($index == 1) continue;
        
            // Ambil data dari kolom A-D (misal A=username, B=nama, C=password, D=level_id)
            $data = [
                    'username' => trim($row['A']),
                    'nama' => trim($row['B']),
                    'password' => trim($row['C']),
                    'level_id' => trim($row['D']),
            ];
        
            // Validasi per baris
            $validator = Validator::make($data, [
                    'username' => 'required|string|min:3|unique:m_user,username',
                    'nama' => 'required|string|max:100',
                    'password' => 'required|string|min:6',
                    'level_id' => 'required|integer',
            ]);
        
            if ($validator->fails()) {
                // Simpan info gagal untuk dilaporkan nanti
                $skipped[] = [
                        'row' => $index,
                        'username' => $data['username'],
                        'errors' => $validator->errors()->all(),
                ];
                continue;
            }
        
            // Simpan ke database
            UserModel::create([
                    'username' => $data['username'],
                    'nama' => $data['nama'],
                    'password' => bcrypt($data['password']),
                    'level_id' => $data['level_id'],
            ]);
        
            $inserted++;
        }
        
        return response()->json([
                'status' => true,
                'message' => "Import selesai. $inserted data berhasil ditambahkan.",
                'skipped' => $skipped,
        ]);

        return redirect('/');
    }  
      //fungsi export
    public function export_excel()
    {
        //ambil data user
        $user = UserModel::select(
            'user_id',
            'level_id',
            'username',
            'nama',
            'password',
        )
            ->orderBy('user_id')
            ->with('level')
            ->get();

        //load spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        //set header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID User');
        $sheet->setCellValue('C1', 'Username');
        $sheet->setCellValue('D1', 'Nama User');
        $sheet->setCellValue('E1', 'Password');
        $sheet->setCellValue('F1', 'Level');

        $sheet->getStyle('A1:F1')->getFont()->setBold(true); ///bold header

        //set data
        $no = 1;
        $baris = 2;
        foreach ($user as $row) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $row->user_id);
            $sheet->setCellValue('C' . $baris, $row->username);
            $sheet->setCellValue('D' . $baris, $row->nama);
            $sheet->setCellValue('E' . $baris, $row->password);
            $sheet->setCellValue('F' . $baris, $row->level->level_nama);

            $no++;
            $baris++;
        }

        //set lebar kolom
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); //set autosize
        }

        //set judul file
        $sheet->setTitle('Data User'); // set title sheet

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data User ' . date(format: 'Y-m-d H:i:s') . '.xlsx';

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
};      