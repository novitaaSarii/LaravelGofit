<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\InstrukturMail; /* import model mail */
use App\Models\Instruktur; /* import model instruktur */
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\InstrukturResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use IntlChar;

class InstrukturController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        $cari = $request->cari;
        $instruktur = Instruktur::where('nama_instruktur', 'LIKE', '%'.$cari.'%')
                        ->paginate(5);

        //get Member
        $instruktur = Instruktur::latest()->get();
        //render view with posts
        return new InstrukturResource(
            true,
            'List Data Member',
            $instruktur,
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
        return view('instruktur.create');
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
            'id_instruktur' => 'required',
            'nama_instruktur' => 'required',
            'alamat_instruktur' => 'required',
            
            'telepon_instruktur' => 'required',
            'email_instruktur' => 'required',
            'password_instruktur' => 'required',
            


        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $instruktur = Instruktur::create([
            'id' => $request->id,
            'id_instruktur' => $request->id_instruktur,
            'nama_instruktur' => $request->nama_instruktur,
            'alamat_instruktur' => $request->alamat_instruktur,
            'telepon_instruktur' => $request->telepon_instruktur,
            'email_instruktur' => $request->email_instruktur,

            'password_instruktur' => $request->password_instruktur,
            

        ]);
        return new InstrukturResource(true, 'Data Instruktur Berhasil Ditambahkan!', $instruktur);
    }

    public function destroy($id)
    {
        $instruktur = Instruktur::find($id);
        $instruktur->delete();
        return redirect()->route('instruktur.index')->with(['success' => 'Data Instruktur telah dihapus!']);
    }

    public function show($id){
        $instruktur = Instruktur::find($id); //find user by id

        if (!is_null($instruktur)) {
            return response([
                'message' => 'Retrive User Success',
                'data' => $instruktur
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
            'content' => 'instrukturs',
            'instruktur' => Instruktur::find($id)
        );

        return view('instruktur.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'id_instruktur' => 'required',
            'nama_instruktur' => 'required',
            'alamat_instruktur' => 'required',
            
            'telepon_instruktur' => 'required',
            'email_instruktur' => 'required',
            'password_instruktur' => 'required',
            
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $instrukturs = Instruktur::findOrFail($id);

        if($instrukturs) {

            $instrukturs->update([
            'id' => $request->id,   
            'id_instruktur' => $request->id_instruktur,
            'nama_instruktur' => $request->nama_instruktur,
            'alamat_instruktur' => $request->alamat_instruktur,
            'telepon_instruktur' => $request->telepon_instruktur,
            'email_instruktur' => $request->email_instruktur,

            'password_instruktur' => $request->password_instruktur,
            
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post Updated',
            'data'    => $instrukturs
        ], 200);
    }

    return response()->json([
        'success' => false,
        'message' => 'Post Not Found',
    ], 404);
}
}

