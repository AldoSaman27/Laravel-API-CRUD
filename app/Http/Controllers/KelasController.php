<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware("auth:sanctum",['except'=>["index"]]);
    }

    public function index()
    {
        $response = array();
        $kelas = Kelas::all();
        $a = 1;
        foreach ($kelas as $key) {
            $h["no"] = $a;
            $h["id"] = $key->id;
            $h["nama_kelas"] = $key->nama_kelas;
            $h["kompetensi_keahlian"] = $key->kompetensi_keahlian;
            $h["created_at"] = $key->created_at;
            $h["updated_at"] = $key->updated_at;

            array_push($response, $h);
            $a++;
        }

        return response()->json(['data' => $response,'Response' => "True"]);
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
                "nama_kelas" => "required|regex:/^[a-zA-Z0-9_ -]*$/",
                "kompetensi_keahlian" => "required|regex:/^[a-zA-Z0-9_ -]*$/",
            ]);

            $kelas = Kelas::create([
                "nama_kelas"=>$request->nama_kelas,
                "kompetensi_keahlian"=>$request->kompetensi_keahlian,
            ]);

            return response()->json(['message' => "berhasil menambahkan kelas!"]);
        } catch (\Exception $e) {
            return response()->json(['message' => "Input hanya boleh menggunakan A-Z, a-z, 0-9, _ dan spasi"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas, Request $request, $id)
    {
        try {
            $kelas = Kelas::where("id", $id)->first();
            return response()->json([
                'id' => $kelas->id,
                'nama_kelas' => $kelas->nama_kelas,
                'kompetensi_keahlian' => $kelas->kompetensi_keahlian,
                'created_at' => $kelas->created_at,
                'updated_at' => $kelas->updated_at,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => "id harus berupa angka",]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas, $id)
    {
        try {
            $request->validate([
                "nama_kelas" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
                "kompetensi_keahlian" => "required|regex:/^[a-zA-Z0-9._ -]*$/",
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => "Input hanya boleh menggunakan A-Z, a-z, 0-9, _ dan spasi"]);
        }

        $kelas = Kelas::where("id", $id)->first();
       

        if($kelas) {
            $kelas->update([
                "nama_kelas" => $request->nama_kelas,
                "kompetensi_keahlian" => $request->kompetensi_keahlian,
            ]);
            return response()->json(['message' => "Update kelas berhasil"]);
        }else{
            return response()->json(['message' => "id kelas salah"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas, $id)
    {
        $kelas = Kelas::where("id", $id)->delete();

        if($kelas) {
            return response()->json(["message" => "berhasil menghapus data kelas"]);
        } else {
            return response()->json(['message' => "id kelas salah"]);
        }
    }
}
