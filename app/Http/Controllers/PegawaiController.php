<?php

namespace App\Http\Controllers;

/* Import Model */

use Illuminate\Support\Facades\Mail;
use App\Mail\PegawaiMail; /* import model mail */
use App\Models\Pegawai; /* import model pegawai */
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\PegawaiResource;
use Illuminate\Support\Facades\Validator;


class PegawaiController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        $cari = $request->cari;
        $pegawai = Pegawai::where('nama_pegawai', 'LIKE', '%'.$cari.'%')
                        ->paginate(5);

        //get Member
        $pegawai = Pegawai::latest()->get();
        //render view with posts
        return new PegawaiResource(
            true,
            'List Data Member',
            $pegawai,
            $cari
        );
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('pegawai.create');
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
            'id_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'alamat_pegawai' => 'required',
            'email_pegawai' => 'required',
            'password_pegawai' => 'required',
            'telepon_pegawai' => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $pegawai = Pegawai::create([
            'id' => $request->id,
            'id_pegawai' => $request->id_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'alamat_pegawai' => $request->alamat_pegawai,

            'email_pegawai' => $request->email_pegawai,

            'password_pegawai' => $request->password_pegawai,
            'telepon_pegawai' => $request->telepon_pegawai,

        ]);
        return new PegawaiResource(true, 'Data Pegawai Berhasil Ditambahkan!', $pegawai);
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with(['success' => 'Data Pegawai telah dihapus!']);
    }

    public function show($id){
        $pegawai = Pegawai::find($id); //find user by id

        if (!is_null($pegawai)) {
            return response([
                'message' => 'Retrive User Success',
                'data' => $pegawai
            ], 200); //return user data by id
        }

        return response([
            'message' => 'User Not Found',
            'data' => null
        ], 404); //return if user by id not found 
    }

    public function edit($id)
    {
        $data = array(
            'content' => 'pegawais',
            'pegawai' => Pegawai::find($id)
        );

        return view('pegawai.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'id_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'alamat_pegawai' => 'required',
            'email_pegawai' => 'required',
            'password_pegawai' => 'required',
            'telepon_pegawai' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $pegawais = Pegawai::findOrFail($id);

        if ($pegawais) {

            $pegawais->update([
                'id' => $request->id,
                'id_pegawai' => $request->id_pegawai,
                'nama_pegawai' => $request->nama_pegawai,
                'alamat_pegawai' => $request->alamat_pegawai,
                'email_pegawai' => $request->email_pegawai,
                'password_pegawai' => $request->password_pegawai,
                'telepon_pegawai' => $request->telepon_pegawai,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post Updated',
                'data'    => $pegawais
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Post Not Found',
        ], 404);
    }
}
