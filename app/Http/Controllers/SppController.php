<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
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
        $spp = Spp::all();
        $a = 1;
        foreach ($spp as $key) {
            $h["no"] = $a;
            $h["id"] = $key->id;
            $h["tahun"] = $key->tahun;
            $h["nominal"] = $key->nominal;
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
                "tahun" => "required|regex:/^[0-9 -]*$/",
                "nominal" => "required|regex:/^[0-9 -]*$/",
            ]);

            $spp = Spp::create([
                "tahun" => $request->tahun,
                "nominal" => $request->nominal,
            ]);

            return response()->json(['message' => "berhasil menambahkan spp"]);
        } catch (\Exception $e){
            return response()->json(['message' => "Input hanya boleh menggunakan 0-9"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function show(Spp $spp, Request $request, $id)
    {
        try {
            $spp = Spp::where("id", $id)->first();
            return response()->json([
                'id' => $spp->id,
                'tahun' => $spp->tahun,
                'nominal' => $spp->nominal,
                'created_at' => $spp->created_at,
                'updated_at' => $spp->updated_at,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => "id harus berupa angka"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function edit(Spp $spp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spp $spp, $id)
    {
        try {
            $request->validate([
                "tahun" => "required|regex:/^[0-9 -]*$/",
                "nominal" => "required|regex:/^[0-9 -]*$/",
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => "Input hanya boleh menggunakan 0-9"]);
        }

        $spp = Spp::where("id", $id)->first();

        if($spp) {
            $spp->update([
                "tahun" => $request->tahun,
                "nominal" => $request->nominal,
            ]);
            return response()->json(['message' => "Update spp berhasil"]);
        }else{
            return response()->json(['message' => "id spp salah"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spp $spp, $id)
    {
        $spp = Spp::where("id", $id)->delete();

        if($spp) {
            return response()->json(["message" => "berhasil menghapus data spp"]);
        } else {
            return response()->json(['message' => "id spp salah"]);
        }
    }
}
