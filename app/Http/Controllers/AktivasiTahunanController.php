<?php

namespace App\Http\Controllers;

use App\Http\Resources\AktivasiTahunanResource;
use App\Models\AktivasiTahunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AktivasiTahunanController extends Controller
{
    public function index(Request $request)
    {
        // $cari = $request->cari;
        // $aktivasi_tahunan = AktivasiTahunan::where('nama_member', 'LIKE', '%'.$cari.'%')
        //                 ->paginate(5);

        //get Member
        $aktivasi_tahunan = AktivasiTahunan::latest()->get();
        //render view with posts
        return new AktivasiTahunanResource(
            true,
            'List Aktivasi Tahunan',
            $aktivasi_tahunan,
            // $cari
        );
    }

    public function show($id){
        $aktivasi_tahunan = AktivasiTahunan::find($id); //find user by id

        if (!is_null($aktivasi_tahunan)) {
            return response([
                'message' => 'Retrive User Success',
                'data' => $aktivasi_tahunan
            ], 200); //return user data by id
        }

        return response([
            'message' => 'User Not Found',
            'data' => null
        ], 404); //return if user by id not found 
    }

    // public function store(Request $request)
    // {
    //     //Validasi Formulir
    //     $validator = Validator::make($request->all(), [
    //         'id' => 'required',
    //         'id_aktivasi' => 'required',
    //         'id_member' => 'required',
            
    //         'nama_pegawai' => 'required',
    //         'id_pegawai ' => 'required',
    //         'nama_member' => 'required',

    //         'tanggal_aktivasi	' => 'required',
    //         'biaya_aktivasi' => 'required',
    //         'masa_aktif' => 'required'
    //         // 'masa_berlaku' => 'required',
    //         // 'id_pegawai' => 'required',
    //         // 'nama_pegawai' => 'required',
            


    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }
    //     //Fungsi Post ke Database
    //     $aktivasi_tahunan = AktivasiTahunan::create([
    //         'id' => $request->id,
    //         'id_aktivasi' => $request->id_aktivasi_tahunan,
    //         'id_member' => $request->id_member,
    //         'nama_pegawai' => $request->id_promo,

    //         'id_pegawai ' => $request->nama_member,

    //         'nama_member' => $request->tanggal_aktivasi_tahunan,
    //         // 'waktu_pembayaran' => $request->waktu_pembayaran,

    //         'tanggal_aktivasi	' => $request->nama_kelas,
    //         'biaya_aktivasi' => $request->total_aktivasi_tahunan,
    //         'masa_aktif' => $request->masa_berlaku,

    //         // 'id_pegawai' => $request->id_pegawai,

    //         // 'nama_pegawai' => $request->nama_pegawai,
            

    //     ]);
    //     return new AktivasiTahunanResource(true, 'Data AktivasiTahunan Berhasil Ditambahkan!', $aktivasi_tahunan);
    // }

    public function store(Request $request)
    {
        //Validasi Formulir
        $validator = Validator::make($request->all(), [
            // 'nama' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $totalAktivasi = sprintf('%02d',(AktivasiTahunan::all()->count())+1);
        $carbon=\Carbon\Carbon::now();
        $dateYY=$carbon->format('y');
        $kadaluarsa=\Carbon\Carbon::now()->addYears(3);
        $dateMM=$carbon->format('m');
        $id_aktivasi=$dateYY.'.'.$dateMM.'.'.$totalAktivasi;
        //Fungsi Post ke Database
        $aktivasi = AktivasiTahunan::create([
            'id' => $totalAktivasi,
            'id_aktivasi' => $id_aktivasi,
            'id_member' => $request->id_member,
            'nama_pegawai' => $request->nama_pegawai,
            'id_pegawai' => $request->id_pegawai,
            'nama_member' => $request->nama_member,
            'tanggal_aktivasi' => $carbon,
            'biaya_aktivasi' => $request->biaya_aktivasi,
            'masa_aktif' => $kadaluarsa,
        
        ]);

        return new AktivasiTahunanResource(true, 'Data Aktivasi Berhasil  Ditambahkan!', $aktivasi);
        
            return redirect()->route('aktivasi.index')->with(['success'
                => 'Data Berhasil Disimpan!']);

    }
}
