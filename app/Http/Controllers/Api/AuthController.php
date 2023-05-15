<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerPegawai(Request $request){
        $registrationData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel registratinoData
         $validate = Validator::make($registrationData, [
            'id_pegawai' => 'required|id_pegawai',
            'password_pegawai' => 'required',
            
         ]);    // rule validasi input saat register

         if($validate->fails())    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => $validate->errors()], 400);   // Mengembalikan error validasi input


        $registrationData['password_pegawai'] = bcrypt($request->password_pegawao); // Untuk meng-enkripsi password
         
        $pegawai = Pegawai::create($registrationData);    // Membuat user baru

        auth()->login($pegawai);

        return response([
            'message' => 'Register Success',
            'user' => $pegawai
        ], 200);
    }

    public function login(Request $request){
        $loginData = $request->all();

        $validate = Validator::make($loginData, [
            'id_pegawai' => 'required',
            'password' => 'required'
        ]);

        if($validate->fails())
            return response(['message'=>$validate->errors()->first(),'errors'=>$validate->errors()], 400);
        
        
        if(!auth()->guard('pegawai')->attempt(['email_pegawai'=>$request->email_pegawai, 'password_pegawai)'=>$request->password]))
            return response(['message' => 'Invalid Credentials','data'=>$loginData], 401);

        
        $user = Auth::guard('pegawai')->user();

        $token = $user->createToken('Authentication Token')->accessToken; 

        return response([
            'message' => 'Authenticated',
            'user' => $user,
            'token_type' => 'Bearer',
            'access_token' => $token
        ]); // return data user dan token dalam bentuk json
    }

    public function logout(Request $request){
        $user = Auth::user()->token();
        $dataUser = Auth::user();
        $user->revoke();
        return response([
            'message' => 'Logout Succes',
            'user' => $dataUser
        ]);
    }

    public function authCheck(){
        if(auth()->user()){
            return response([
                'message' => 'Authenticated',
                'data' => auth()->user()
            ], 200);
        }else{
            return response(
                [
                    'message' => 'Unauthenticated',
                    'data' => null
                ], 401
            );
        }
    }
}
