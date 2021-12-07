<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans=Karyawan::all();

        if(count($karyawans)>0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $karyawans
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $karyawan = Karyawan::find($id);

        if(!is_null($karyawan)) {
            return response([
                'message' => 'Retrieve Karyawan Success',
                'data' => $karyawan
            ], 200);
        }

        return response([
            'message' => 'Karyawan Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData=$request->all();
        $validate=Validator::make($storeData, [
            'nama_karyawan' => 'required',
            'alamat_karyawan' => 'required',
            'gaji' => 'required|numeric',
            'nohp_karyawan' => 'required|numeric|regex:/(08)[0-9]{0,11}/'
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $karyawan=Karyawan::create($storeData);
        return response([
            'message' => 'Add Karyawan Success',
            'data' => $karyawan
        ], 200);
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);

        if(is_null($karyawan)) {
            return response([
                'message' => 'Karyawan Not Found',
                'data' => null
            ], 404);
        }

        if($karyawan->delete()) {
            return response([
                'message' => 'Delete Karyawan Success',
                'data' => $karyawan
            ], 200); 
        }

        return response([
            'message' => 'Delete Karyawan Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $karyawan=Karyawan::find($id);
        if(is_null($karyawan)) {
            return response([
                'message' => 'Karyawan Not Found',
                'data' => null
            ], 404);
        }

        $updateData=$request->all();
        $validate=Validator::make($updateData, [
            'nama_karyawan' => 'required',
            'alamat_karyawan' => 'required',
            'gaji' => 'required|numeric',
            'nohp_karyawan' => 'required|numeric|regex:/(08)[0-9]{0,11}/'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $karyawan->nama_karyawan=$updateData['nama_karyawan'];
        $karyawan->alamat_karyawan=$updateData['alamat_karyawan'];
        $karyawan->gaji=$updateData['gaji'];
        $karyawan->nohp_karyawan=$updateData['nohp_karyawan'];

        if($karyawan->save()) {
            return response([
                'message' => 'Update Karyawan Success',
                'data' => $karyawan
            ], 200);
        }

        return response([
            'message' => 'Update Karyawan Failed',
            'data' => null,
        ], 400);
    }
}
