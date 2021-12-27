<?php

namespace App\Http\Controllers;

use App\Models\ChallengeModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChallengeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request){
        return 'Halo, Selamat Datang! Kamu datang dari: ' .$request->path();
    }

    public function hello(){
        $data['status'] = 'Success!';
        $data['message'] = 'Hello, from Lumen';
        return (new Response($data, 201))
            ->header('Content-type', 'application/json');
    }

    public function lihat() {
        $success = ChallengeModel::all();
        $output['success'] = true;
        $output['data'] = ChallengeModel::all();
        if($success) {
            return (new Response($output))
            ->header('Content-type', 'application/json');
        }
        return 'Failed to fetch data :(';
    }

    public function tambah(Request $request) {
        $this->validate($request, [
            'nama' => 'required',
            'porsi' => 'required',
            'harga' => 'required',
        ]);
        $success = ChallengeModel::create($request->all());
        $output['success'] = true;
        $output['data'] = ChallengeModel::all();
        if($success) {
            return (new Response($output))
            ->header('Content-type', 'application/json');
        }
        return 'Failed to add data :(';
    }

    public function update(Request $request, $id) {
        $success = ChallengeModel::find($id);
        $output['success'] = $success->update($request->all());
        $output['data'] = ChallengeModel::where('id','=',$id)->get();
        if($success) {
            // $success->update($request->all());
            return (new Response($output))
            ->header('Content-type', 'application/json');
        }
        return 'Failed to update data :(';
    }

    public function hapus($id) {
        $success = ChallengeModel::find($id);
        $output['success'] = $success->delete();
        $output['data'] = ChallengeModel::all();
        if($success) {
            return (new Response($output))
            ->header('Content-type', 'application/json');
        }
        return 'Failed to delete data :(';
    }
}
