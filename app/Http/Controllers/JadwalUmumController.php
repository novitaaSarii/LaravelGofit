<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\JadwalUmumMail; /* import model mail */
use App\Models\JadwalUmum; /* import model jadwalUmum */
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\JadwalUmumResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class JadwalUmumController extends Controller
{
   /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get JadwalUmum
        $jadwalUmum = JadwalUmum::latest()->get();
        //render view with posts
        return new JadwalUmumResource(
            true,
            'List Data Jadwal Umum',
            $jadwalUmum
        );
    }
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('jadwal_umum.create');
    }
    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //Validasi Formulir
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'id_kelas' => 'required',
            'id_instruktur' => 'required',
            'hari_jadwal_umum' => 'required',
            'waktu' => 'required',
            'jenis_kelas' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $jadwalUmum = JadwalUmum::create([
            'id' => $request->id,
            'id_kelas' => $request->id_kelas,
            'id_instruktur' => $request->id_instruktur,
            'hari_jadwal_umum' => $request->hari_jadwal_umum,
            'waktu' => $request->waktu,
            'jenis_kelas' => $request->jenis_kelas,
            

        ]);
        return new JadwalUmumResource(true, 'Data Jadwal Umum Berhasil Ditambahkan!', $jadwalUmum);
    }

    public function destroy($id)
    {
        $jadwalUmum = JadwalUmum::find($id);
        $jadwalUmum->delete();
        return redirect()->route('jadwal_umum.index')->with(['success' => 'Data JadwalUmum telah dihapus!']);
    }

    public function show($id){
        $jadwal_umum = JadwalUmum::find($id); //find user by id

        if (!is_null($jadwal_umum)) {
            return response([
                'message' => 'Retrive User Success',
                'data' => $jadwal_umum
            ], 200); //return user data by id
        }

        return response([
            'message' => 'User Not Found',
            'data' => null
        ], 404); //return if user by id not found 
    }

    public function edit(string $id): View
    {
        $data = array(
            'content' => 'jadwalUmums',
            'jadwalUmum' => JadwalUmum::find($id)
        );

        return view('jadwalUmum.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'id_kelas' => 'required',
            'id_instruktur' => 'required',
            'hari_jadwal_umum' => 'required',
            'waktu' => 'required',
            'jenis_kelas' => 'required',
            
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $jadwalUmums = JadwalUmum::findOrFail($id);

        if($jadwalUmums) {

            $jadwalUmums->update([
                'id' => $request->id,
                'id_kelas' => $request->id_kelas,
                'id_instruktur' => $request->id_instruktur,
                'hari_jadwal_umum' => $request->hari_jadwal_umum,
                'waktu' => $request->waktu,
                'jenis_kelas' => $request->jenis_kelas,
            
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post Updated',
            'data'    => $jadwalUmums
        ], 200);
    }

    return response()->json([
        'success' => false,
        'message' => 'Post Not Found',
    ], 404);
}
}
