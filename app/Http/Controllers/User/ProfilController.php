<?php

namespace App\Http\Controllers\User;

use App\Helpers\FuncHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('id', Auth::user()->id)->first();

        $dataProvinsi = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json");
        $dataProvinsi = json_decode($dataProvinsi, true);
        return view('user.profil.index', compact('data', 'dataProvinsi'));
    }

    public function updateDataDiri(Request $request)
    {
        // try {
        DB::transaction(function () use ($request) {
            FuncHelper::dxUpdate(new User(), ['id' => Auth::user()->id], [
                'name' => $request->nama_lengkap,
                'nama_alias' => $request->nama_alias,
                'email' => $request->email,
                'jenis_kelamin' => $request->jekel,
                'no_telp' => $request->telp,
                'tanggal_lahir' => $request->tanggal_lahir,
                'provinsi' => $request->provinsi,
                'kota_kab' => $request->kab_kota,
                'alamat_lengkap' => $request->alamat_lengkap,
            ]);
        });
        return ['status' => 200, 'message' => 'Berhasil menyimpan data'];
        // } catch (\Throwable $th) {
        //     return ['status' => 500, 'message' => 'Gagal menyimpan data'];
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
