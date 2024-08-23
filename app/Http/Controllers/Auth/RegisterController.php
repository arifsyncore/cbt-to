<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegister()
    {
        $dataProvinsi = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json");
        $dataProvinsi = json_decode($dataProvinsi, true);
        return view('auth.register', compact('dataProvinsi'));
    }

    public function register(Request $request)
    {
        $email = User::where('email', $request->email)->get();
        if (count($email)) {
            return redirect()->back()->with('email', 'Email sudah terdaftar');
        }
        $username = User::where('username', $request->username)->get();
        if (count($username)) {
            return redirect()->back()->with('username', 'Username sudah terdaftar');
        }
        $user = User::create([
            'role_id' => 2,
            'name' => $request->name,
            'nama_alias' => $request->nama_alias,
            'jenis_kelamin' => $request->jekel,
            'no_telp' => $request->no_telp,
            'tanggal_lahir' => $request->tanggal_lahir,
            'provinsi' => $request->provinsi,
            'kota_kab' => $request->kab_kota,
            'alamat_lengkap' => $request->alamat_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        Auth::loginUsingId($user->id);

        return redirect()->route('dashboard');
    }

    public function getKota(Request $request)
    {
        try {
            $dataKota = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/$request->id.json");
            $dataKota = json_decode($dataKota, true);
            return ['resCode' => 200, 'data' => $dataKota];
        } catch (\Throwable $th) {
            return ['resCode' => 500, 'message' => 'Gagal memuat halaman'];
        }
    }
}
