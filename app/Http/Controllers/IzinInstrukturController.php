<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\IzinInstrukturResource;
use App\Models\IzinInstruktur;
use Illuminate\View\View;

class IzinInstrukturController extends Controller
{
    public function index(Request $request)
    {
        // $cari = $request->cari;
        // $izin_instruktur = IzinInstruktur::where('id_izin_instruktur', 'LIKE', '%'.$cari.'%')
        //                 ->paginate(5);

        //get Member
        $izin_instruktur = IzinInstruktur::latest()->get();
        //render view with posts
        return new IzinInstrukturResource(
            true,
            'List Izin Instruktur',
            $izin_instruktur,
            // $cari
        );
    }

    public function show($id){
        $izin_instruktur = IzinInstruktur::find($id); //find user by id

        if (!is_null($izin_instruktur)) {
            return response([
                'message' => 'Retrive User Success',
                'data' => $izin_instruktur
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
            'id_instruktur ' => 'required',
            'id_jadwal_harian' => 'required',
            'nama_instruktur' => 'required',
            'tanggal_izin' => 'required',
            'keterangan_izin' => 'required',
            'sesi_izin' => 'required',
            'id_pegawai' => 'required',
            
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $izin_instruktur = IzinInstruktur::create([
            'id' => $request->id,
            'id_instruktur' => $request->id_instruktur,
            'id_jadwal_harian' => $request->id_jadwal_harian,
            'nama_instruktur' => $request->nama_instruktur,
            'tanggal_izin' => $request->tanggal_izin,
            'keterangan_izin' => $request->keterangan_izin,
            'sesi_izin' => $request->sesi_izin,
            'id_pegawai' => $request->id_pegawai,
            'status' => $request->status
        ]);
        return new IzinInstrukturResource(true, 'Data Izin Instruktur Berhasil Ditambahkan!', $izin_instruktur);
    }


    public function konfirmasiIzin(string $id): View
    {
        $data = array(
            'content' => 'izin_instruktur',
            'izin_instrukturs' => IzinInstruktur::find($id)
        );

        return view('jadwal_harian.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $izin_instrukturs = IzinInstruktur::findOrFail($id);

        if($izin_instrukturs) {

            $izin_instrukturs->update([
                
                'status' => $request->status
            
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post Updated',
            'data'    => $izin_instrukturs
        ], 200);
    }

    return response()->json([
        'success' => false,
        'message' => 'Post Not Found',
    ], 404);

    return redirect()->route('izin_instruktur.index')->with(['success'
            => 'Data Berhasil Diubah!']);

        }
}
