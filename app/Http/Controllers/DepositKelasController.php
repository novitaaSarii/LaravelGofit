<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepositKelasResource;
use App\Models\DepositKelas;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DepositKelasController extends Controller
{
    public function index(Request $request)
    {
        // $cari = $request->cari;
        // $deposit_kelas = DepositKelas::where('nama_member', 'LIKE', '%'.$cari.'%')
        //                 ->paginate(5);

        //get Member
        $deposit_kelas = DepositKelas::latest()->get();
        //render view with posts
        return new DepositKelasResource(
            true,
            'List Deposit Kelas',
            $deposit_kelas,
            // $cari
        );
    }

    public function show($id){
        $deposit_kelas = DepositKelas::find($id); //find user by id

        if (!is_null($deposit_kelas)) {
            return response([
                'message' => 'Retrive User Success',
                'data' => $deposit_kelas
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

        ]);
           
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $totalDeposit = sprintf('%02d',(DepositKelas::all()->count())+1);
        $carbon=\Carbon\Carbon::now();
        $dateYY=$carbon->format('y');
       
        $dateMM=$carbon->format('m');
        $id_deposit=$dateYY.'.'.$dateMM.'.'.$totalDeposit;

        //Fungsi Post ke Database
        $deposit_kelas = DepositKelas::create([
            'id' => $totalDeposit,
            'id_deposit_kelas' => $id_deposit,
            'id_member' => $request->id_member,
            'id_promo' => $request->id_promo,

            'nama_member' => $request->nama_member,

            'tanggal_deposit_kelas' => $carbon,
            'waktu_pembayaran' => $request->waktu_pembayaran,

            'nama_kelas' => $request->nama_kelas,
            'total_deposit_kelas' => $request->total_deposit_kelas,
            'masa_berlaku' => $request->masa_berlaku,

            'id_pegawai' => $request->id_pegawai,

            'nama_pegawai' => $request->nama_pegawai,
            

        ]);
        return new DepositKelasResource(true, 'Data DepositKelas Berhasil Ditambahkan!', $deposit_kelas);
    }

}
