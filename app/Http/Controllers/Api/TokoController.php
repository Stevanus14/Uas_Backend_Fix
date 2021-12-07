<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Toko;

class TokoController extends Controller
{
    public function index() 
    {
        $tokos = Toko::all();

        if(count($tokos)>0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $tokos
            ], 200);
        }

        return response([
            'message' => 'Toko Empty',
            'data' => null
        ], 400);
    }

    public function show($id) {
        $toko = Toko::find($id);

        if(!is_null($toko)) {
            return response([
                'message' => 'Retrieve Toko Success',
                'data' => $toko
            ], 200);
        }

        return response([
            'message' => 'Toko Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_toko' => 'required|unique:tokos',
            'kode_toko' => 'required|min:5|max:5|unique:tokos',
            'alamat_toko' => 'required|unique:tokos'
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $toko = Toko::create($storeData);
        return response([
            'message' => 'Add Toko Success',
            'data' => $toko
        ], 200);
    }

    public function destroy($id) {
        $toko = Toko::find($id);

        if(is_null($toko)) {
            return response([
                'message' => 'Toko Not Found',
                'data' => null
            ], 404);
        }

        if($toko->delete()) {
            return response([
                'message' => 'Delete Toko Success',
                'data' => $toko
            ], 200); 
        }

        return response([
            'message' => 'Delete Toko Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id) {
        $toko = Toko::find($id);
        if(is_null($toko)) {
            return response([
                'message' => 'Toko Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_toko' => ['required', Rule::unique('tokos')->ignore($toko)],
            'kode_toko' => ['min:5', 'max:5', 'required', Rule::unique('tokos')->ignore($toko)],
            'alamat_toko' => ['required', Rule::unique('tokos')->ignore($toko)],
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $toko->nama_toko=$updateData['nama_toko'];
        $toko->kode_toko=$updateData['kode_toko'];
        $toko->alamat_toko=$updateData['alamat_toko'];

        if($toko->save()) {
            return response([
                'message' => 'Update Toko Success',
                'data' => $toko
            ], 200);
        }

        return response([
            'message' => 'Update Toko Failed',
            'data' => null,
        ], 400);
    }
}
