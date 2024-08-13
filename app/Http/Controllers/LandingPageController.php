<?php

namespace App\Http\Controllers;

use App\Helpers\FuncHelper;
use App\Models\admin\MJenisUjian;
use App\Models\admin\MUploadSoal;
use App\Models\MBankSoal;
use App\Models\user\TRuangUjian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bank_soal = MUploadSoal::with('soal')->get();
        $jenis_soal = MJenisUjian::with('detail')->get();
        return view('landing.index', compact(
            'bank_soal',
            'jenis_soal'
        ));
    }

    public function detailTo(Request $request)
    {
        $data = MUploadSoal::with('soal')->where('id', $request->id)->first();
        return view('landing.detail', compact(
            'data'
        ));
    }

    public function addUjian(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('add-ruang-ujian', ['id' => $request->id]);
        } else {
            return redirect()->route('login');
        }
    }

    public function kategori(Request $request)
    {
        $kategori = MJenisUjian::with('detail')->orderBy('kode')->get();
        return view('landing.kategori', compact(
            'kategori'
        ));
    }

    public function detailKat(Request $request)
    {
        $data = MJenisUjian::with('detailSoal')->where('id', $request->id)->first();
        $soal = MUploadSoal::with('soal')->whereHas('soal', function ($q) use ($data) {
            $q->where('id_jenis', $data->id);
        })->get();
        return view('landing.detail-kategori', compact(
            'data',
            'soal'
        ));
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
    public function store(Request $request) {}

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
