<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\MemberMail; /* import model mail */
use App\Models\Member; /* import model member */
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\MemberResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class MemberController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        $cari = $request->cari;
        $member = Member::where('nama_member', 'LIKE', '%'.$cari.'%')
                        ->paginate(5);

        //get Member
        $member = Member::latest()->get();
        //render view with posts
        return new MemberResource(
            true,
            'List Data Member',
            $member,
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
        return view('member.create');
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
            'id_member' => 'required',
            'nama_member' => 'required',
            'alamat_member' => 'required',
            'telepon_member' => 'required',
            'email_member' => 'required',
            'lahir_member' => 'required',
            'jumlah_deposit_kelas' => 'required',
            'jumlah_deposit_reguler' => 'required',
            'masa_kadaluarsa_member' => 'required',
            'masa_kadaluarsa_deposit' => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $member = Member::create([
            'id' => $request->id,
            'id_member' => $request->id_member,
            'nama_member' => $request->nama_member,
            'alamat_member' => $request->alamat_member,
            'telepon_member' => $request->telepon_member,
            'email_member' => $request->email_member,
            'lahir_member' => $request->lahir_member,
            'password_member' => $request->password_member,
            'jumlah_deposit_kelas' => $request->jumlah_deposit_kelas ,
            'jumlah_deposit_reguler' => $request->jumlah_deposit_reguler,
            'masa_kadaluarsa_member' => $request->masa_kadaluarsa_member,
            'masa_kadaluarsa_deposit' => $request->masa_kadaluarsa_deposit,
        ]);
        return new MemberResource(true, 'Data Member Berhasil Ditambahkan!', $member);
    }

    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect()->route('member.index')->with(['success' => 'Data Member telah dihapus!']);
    }

    public function show($id){
        $member = Member::find($id); //find user by id

        if (!is_null($member)) {
            return response([
                'message' => 'Retrive User Success',
                'data' => $member
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
            'content' => 'members',
            'member' => Member::find($id)
        );

        return view('member.edit')->with($data);
    }

    

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
           'id_member' => 'required',
            'nama_member' => 'required',
            'alamat_member' => 'required',
            'telepon_member' => 'required',
            'email_member' => 'required',
            'lahir_member' => 'required',
            'jumlah_deposit_kelas' => 'required',
            'jumlah_deposit_reguler' => 'required',
            'masa_kadaluarsa_member' => 'required',
            'masa_kadaluarsa_deposit' => 'required',
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $members = Member::findOrFail($id);

        if($members) {

            $members->update([
                'id' => $request->id,
                'id_member' => $request->id_member,
                'nama_member' => $request->nama_member,
                'alamat_member' => $request->alamat_member,
                'telepon_member' => $request->telepon_member,
                'email_member' => $request->email_member,
                'lahir_member' => $request->lahir_member,
                'password_member' => $request->password_member,
                'jumlah_deposit_kelas' => $request->jumlah_deposit_kelas,
                'jumlah_deposit_reguler' => $request->jumlah_deposit_reguler,
                'masa_kadaluarsa_member' => $request->masa_kadaluarsa_member,
                'masa_kadaluarsa_deposit' => $request->masa_kadaluarsa_deposit,
    
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post Updated',
            'data'    => $members
        ], 200);
    }

    return response()->json([
        'success' => false,
        'message' => 'Post Not Found',
    ], 404);
}

public function resetPassword($id){
    $member = member::find($id);

    $member->password_member = Hash::make($member->lahir_member);
    $member->update();

    return response([
        'message' => 'Reset Password Member Success',
        'data' => $member
    ], 200);
}
}
