<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\JadwalHarianResource;
use App\Models\JadwalHarian;
use Illuminate\View\View;

class JadwalHarianController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->cari;
        $jadwal_harian = JadwalHarian::where('id_jadwal_harian', 'LIKE', '%'.$cari.'%')
                        ->paginate(5);

        //get Member
        $jadwal_harian = JadwalHarian::latest()->get();
        //render view with posts
        return new JadwalHarianResource(
            true,
            'List Jadwal Harian',
            $jadwal_harian,
            $cari
        );
    }
    
    public function show($id){
        $jadwal_harian = JadwalHarian::find($id); //find user by id

        if (!is_null($jadwal_harian)) {
            return response([
                'message' => 'Retrive User Success',
                'data' => $jadwal_harian
            ], 200); //return user data by id
        }

        return response([
            'message' => 'User Not Found',
            'data' => null
        ], 404); //return if user by id not found 
    }

    public function store(Request $request)
    {
        //Validasi Formulir
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'id_jadwal_harian' => 'required',
            'id_pegawai ' => 'required',
            'id_kelas ' => 'required',
            'tanggal' => 'required',
            'hari_jadwal_harian' => 'required',
            'waktu' => 'required',
            'jenis_kelas' => 'required',
            'keterangan_kelas' => 'required',
          
            
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $jadwal_harian = JadwalHarian::create([
            'id' => $request->id,
            'id_jadwal_harian' => $request->id_jadwal_harian,
            'id_pegawai' => $request->id_pegawai,
            'id_kelas' => $request->id_kelas,
            'tanggal' => $request->tanggal,
            'hari_jadwal_harian' => $request->hari_jadwal_harian,
            'waktu' => $request->waktu,
            'jenis_kelas' => $request->jenis_kelas,
            'keterangan_kelas' => $request->keteranagn_kelas,

        ]);
        return new JadwalHarianResource(true, 'Data JadwalHarian Berhasil Ditambahkan!', $jadwal_harian);
    }


    public function edit(string $id): View
    {
        $data = array(
            'content' => 'jadwal_harian',
            'jadwal_harians' => JadwalHarian::find($id)
        );

        return view('jadwal_harian.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'id_jadwal_harian' => 'required',
            'id_pegawai ' => 'required',
            'id_kelas ' => 'required',
            'tanggal' => 'required',
            'hari_jadwal_harian' => 'required',
            'waktu' => 'required',
            'jenis_kelas' => 'required',
            'keterangan_kelas' => 'required',
            
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $jadwal_harians = JadwalHarian::findOrFail($id);

        if($jadwal_harians) {

            $jadwal_harians->update([
            'id' => $request->id,
            'id_jadwal_harian' => $request->id_jadwal_harian,
            'id_pegawai' => $request->id_pegawai,
            'id_kelas' => $request->id_kelas,
            'tanggal' => $request->tanggal,
            'hari_jadwal_harian' => $request->hari_jadwal_harian,
            'waktu' => $request->waktu,
            'jenis_kelas' => $request->jenis_kelas,
            'keterangan_kelas' => $request->keterangan_kelas,
            
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post Updated',
            'data'    => $jadwal_harians
        ], 200);
    }

    return response()->json([
        'success' => false,
        'message' => 'Post Not Found',
    ], 404);

    return redirect()->route('jadwal_harian.index')->with(['success'
            => 'Data Berhasil Diubah!']);

        }
}
