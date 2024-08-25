<?php

namespace App\Http\Controllers;

use App\Models\admin\MJenisUjianDet;
use App\Models\user\TRuangUjian;
use App\Models\user\TSoalSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $ruang_ujian = TRuangUjian::with('soalto', 'soalsesi')->where('id_user', Auth::user()->id)->where('status', 'Selesai')->get();
            $ujianArr = array();
            $nilaiArr = array();
            foreach ($ruang_ujian as $key => $ujian) {
                $nilai = 0;
                foreach ($ujian->soalsesi as $key => $sesi) {
                    if ($sesi->soal->jenissoal->type_jenis == 'benar_salah') {
                        $bobotSoal = $sesi->jenis->bobot_soal;
                        $jml_soal = $sesi->jenis->jml_soal;
                        $nilai_soal = $bobotSoal / $jml_soal;
                        if ($sesi->jawaban == $sesi->soal->jawaban) {
                            $nilai += $nilai_soal;
                        }
                    } else {
                        $nilai_soal = $sesi->soal->nilaijawaban->where('opsi', $sesi->jawaban)->first();
                        $nilai += $nilai_soal->nilai;
                    }
                }
                $ujianArr[] = $ujian->soalto->nama;
                $nilaiArr[] = $nilai;
            }
            return [
                'ujian' => $ujianArr,
                'nilai' => $nilaiArr
            ];
        }
        return view('home');
    }

    public function getChart(Request $request)
    {
        $jenis_soal = MJenisUjianDet::with('jenis')->get();
        $jenisArr = array();
        foreach ($jenis_soal as $key => $jenis) {
            $ruang_ujian = TRuangUjian::with('soalto', 'soalsesi')->where('id_user', Auth::user()->id)->where('status', 'Selesai')->get();
            $ujianArr = array();
            $nilaiArr = array();
            foreach ($ruang_ujian as $key => $ujian) {
                $sesis = $ujian->soalsesi->where('id_jenis_det', $jenis->id);
                $nilai = 0;
                foreach ($sesis as $key => $sesi) {
                    if ($sesi->soal->jenissoal->type_jenis == 'benar_salah') {
                        $bobotSoal = $sesi->jenis->bobot_soal;
                        $jml_soal = $sesi->jenis->jml_soal;
                        $nilai_soal = $bobotSoal / $jml_soal;
                        if ($sesi->jawaban == $sesi->soal->jawaban) {
                            $nilai += $nilai_soal;
                        }
                    } else {
                        $nilai_soal = $sesi->soal->nilaijawaban->where('opsi', $sesi->jawaban)->first();
                        $nilai += $nilai_soal->nilai;
                    }
                }
                $nilaiArr[] = $nilai;
                $ujianArr[] = $ujian->soalto->nama;
            }
            $jenisArr[] = [
                'name' => $jenis->nama . '-' . $jenis->jenis->jenis,
                'data' => $nilaiArr
            ];
        }
        return [
            'ujian' => $ujianArr,
            'detail' => $jenisArr,
        ];
    }

    public function getNilai()
    {
        $data = TRuangUjian::with('soalto', 'soalsesi')->where('id_user', Auth::user()->id)->where('status', 'Selesai')->get();
        return DataTables::of($data)
            ->addColumn('kode', function ($data) {
                return $data->soalto ? $data->soalto->soal->kode : '';
            })
            ->addColumn('nama_soal', function ($data) {
                return $data->soalto ? $data->soalto->nama : '';
            })
            ->addColumn('aksi', function ($data) {
                $nilai = 0;
                foreach ($data->soalsesi as $key => $sesi) {
                    if ($sesi->soal->jenissoal->type_jenis == 'benar_salah') {
                        $bobotSoal = $sesi->jenis->bobot_soal;
                        $jml_soal = $sesi->jenis->jml_soal;
                        $nilai_soal = $bobotSoal / $jml_soal;
                        if ($sesi->jawaban == $sesi->soal->jawaban) {
                            $nilai += $nilai_soal;
                        }
                    } else {
                        $nilai_soal = $sesi->soal->nilaijawaban->where('opsi', $sesi->jawaban)->first();
                        $nilai += $nilai_soal->nilai;
                    }
                }
                $button = "<a href='/ruang-ujian/hasil?id=$data->id'>$nilai</a>";
                return $button;
            })->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

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
