<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepositRegulerResource;
use App\Models\DepositReguler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepositRegulerController extends Controller
{
    public function index(Request $request)
    {
        // $cari = $request->cari;
        // $deposit_reguler = DepositReguler::where('nama_member', 'LIKE', '%'.$cari.'%')
        //                 ->paginate(5);

        //get Member
        $deposit_reguler = DepositReguler::latest()->get();
        //render view with posts
        return new DepositRegulerResource(
            true,
            'List Deposit Reguler',
            $deposit_reguler,
            // $cari
        );
    }
    
    public function show($id){
        $deposit_reguler = DepositReguler::find($id); //find user by id

        if (!is_null($deposit_reguler)) {
            return response([
                'message' => 'Retrive User Success',
                'data' => $deposit_reguler
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
        $totalDeposit = sprintf('%02d',(DepositReguler::all()->count())+1);
        $carbon=\Carbon\Carbon::now();
        $dateYY=$carbon->format('y');
       
        $dateMM=$carbon->format('m');
        $id_deposit=$dateYY.'.'.$dateMM.'.'.$totalDeposit;

        $deposit_reguler = DepositReguler::create([
            'id' => $totalDeposit,
            'id_deposit_regulers' => $id_deposit,
            'id_promo' => $request->id_promo,
            'id_member' => $request->id_member,
            'nama_member' => $request->nama_member,
            'tanggal_transaksi_deposit' => $carbon,
            'bonus_deposit' => $request->bonus_deposit,
            'sisa_deposit' => $request->sisa_deposit,
            'id_pegawai' => $request->id_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'total_deposit' => $request->total_deposit,

        ]);
        return new DepositRegulerResource(true, 'Data Deposit Reguler Berhasil Ditambahkan!', $deposit_reguler);

        
    }

}
