<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(){
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        $response = array();
        $siswa = Siswa::all();
        $a = 1;
        foreach ($siswa as $key) {
            $h["no"] = $a;
            $h["id"] = $key->id;
            $h["nisn"] = $key->nisn;
            $h["nis"] = $key->nis;
            $h["nama"] = $key->nama;
            $h["id_kelas"] = $key->id_kelas;
            $h["alamat"] = $key->alamat;
            $h["no_telp"] = $key->no_telp;
            $h["id_spp"] = $key->id_spp;
            $h["created_at"] = $key->created_at;
            $h["updated_at"] = $key->updated_at;

            array_push($response, $h);
            $a++;
        }

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                "nisn" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "nis" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "nama" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "id_kelas" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "alamat" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "no_telp" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "id_spp" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
            ]);

            $siswa = Siswa::create([
                "nisn"=>$request->nisn,
                "nis"=>$request->nis,
                "nama"=>$request->nama,
                "id_kelas"=>$request->id_kelas,
                "alamat"=>$request->alamat,
                "no_telp"=>$request->no_telp,
                "id_spp"=>$request->id_spp,
            ]);

            return response()->json(['message' => "berhasil menambahkan siswa!"]);
        } catch (\Exception $e) {
            return response()->json(['message' => "Input hanya boleh menggunakan A-Z, a-z, 0-9, _ dan spasi"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa, Request $request, $id)
    {
        try {
            $siswa = Siswa::where("id", $id)->first();
            return response()->json([
                'id' => $siswa->id,
                'nisn' => $siswa->nisn,
                'nis' => $siswa->nis,
                'nama' => $siswa->nama,
                'id_kelas' => $siswa->id_kelas,
                'alamat' => $siswa->alamat,
                'no_telp' => $siswa->no_telp,
                'id_spp' => $siswa->id_spp,
                'created_at' => $siswa->created_at,
                'updated_at' => $siswa->updated_at,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => "id harus berupa angka"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa, $id)
    {
        try {
            $request->validate([
                "nisn" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "nis" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "nama" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "id_kelas" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "alamat" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "no_telp" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "id_spp" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => "Input hanya boleh menggunakan A-Z, a-z, 0-9, _ dan spasi"]);
        }

        $siswa = Siswa::where("id", $id)->first();

        if($siswa) {
            $siswa->update([
                "nisn" => $request->nisn,
                "nis" => $request->nis,
                "nama" => $request->nama,
                "id_kelas" => $request->id_kelas,
                "alamat" => $request->alamat,
                "no_telp" => $request->no_telp,
                "id_spp" => $request->id_spp,
            ]);
            return response()->json(['message' => "Update siswa berhasil"]);
        }else{
            return response()->json(['message' => "id siswa salah"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa, $id)
    {
        $siswa = Siswa::where("id", $id)->delete();

        if($siswa) {
            return response()->json(["message" => "berhasil menghapus data siswa"]);
        } else {
            return response()->json(['message' => "ID siswa salah"]);
        }
    }
}
