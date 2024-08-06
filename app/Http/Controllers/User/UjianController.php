<?php

namespace App\Http\Controllers\User;

use App\Helpers\FuncHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\user\TRuangUjian;
use App\Models\user\TSesiUser;
use App\Models\user\TSoalSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sesi = TSesiUser::with('ruangujian')
            ->where('id_user', Auth::user()->id)
            ->where('id_ruang_ujian', $request->ujian)
            ->first();
        $nama_soal = $sesi->ruangujian->soalto->soal->nama_soal;
        // load soal tab soal
        $tab = TSoalSesi::where('id_sesi', $request->id)
            ->where('id_user', Auth::user()->id)
            ->where('id_ruang_ujian', $request->ujian)->get();

        $soal = TSoalSesi::with('sesi', 'soal')
            ->where('id_sesi', $request->id)
            ->where('id_user', Auth::user()->id)
            ->where('id_ruang_ujian', $request->ujian)
            ->first();
        // $soalArr = array();
        // foreach ($soals as $key => $soal) {
        $soalArr = [
            'id' => $soal->soal->id,
            'no' => $soal->soal->nomor_soal,
            'soal' => $soal->soal->soal,
            'opsi_jawaban' => [
                [
                    'opsi' => $soal->soal->opsi_a,
                    'value' => 'A',
                ],
                [
                    'opsi' => $soal->soal->opsi_b,
                    'value' => 'B',
                ],
                [
                    'opsi' => $soal->soal->opsi_c,
                    'value' => 'C',
                ],
                [
                    'opsi' => $soal->soal->opsi_d,
                    'value' => 'D',
                ],
                [
                    'opsi' => $soal->soal->opsi_e,
                    'value' => 'E',
                ],
            ],
        ];
        // }
        // return $soalArr;
        // menghitung sisa waktu
        $waktu_sekarang = date("Y-m-d H:i:s");
        $waktu_sekarang = strtotime($waktu_sekarang);
        $waktu_selesai = $sesi->waktu_selesai;
        $waktu_selesai = strtotime($waktu_selesai);
        $timestamp = $waktu_selesai;
        $sisa_waktu = ($timestamp - $waktu_sekarang) * 1000;
        $data = [
            'sisa_waktu' => $sisa_waktu,
            'nama_soal' => $nama_soal,
            'tab' => $tab,
            'id_soal' => $tab[0]->id_soal,
            'id_sesi' => $request->id,
            'id_ruang_ujian' => $request->ujian
        ];
        // return $data;
        return view('user.ruang-cbt.index', compact('data'));
    }

    public function addUjian(Request $request)
    {
        $checkExist = TSesiUser::where('id_user', Auth::user()->id)->where('id_ruang_ujian', $request->id)->first();
        if ($checkExist) {
            return redirect()->route('try-out', [
                'id' => $checkExist->id,
                'user' => $checkExist->id_user,
                'ujian' => $checkExist->id_ruang_ujian,
            ]);
        } else {
            $ruang_ujian = TRuangUjian::with('soalto')->where('id', $request->id)->first();
            $now = date("Y-m-d H:i:s");
            $timestampNow =  strtotime($now);
            $durasi = round($ruang_ujian->soalto->durasi);
            $waktu_selesai = $timestampNow + ($durasi * 60);
            $waktu_selesai = date('Y-m-d H:i:s', $waktu_selesai);
            $sesi = FuncHelper::dxInsert(new TSesiUser(), [
                'id_user' => Auth::user()->id,
                'id_ruang_ujian' => $request->id,
                'waktu_mulai' => $now,
                'waktu_selesai' => $waktu_selesai,
            ]);
            $soal = $ruang_ujian->soalto->soal->detail()->inRandomOrder()->get();
            $no = 0;
            foreach ($soal as $key => $soal) {
                FuncHelper::dxInsert(new TSoalSesi(), [
                    'id_sesi' => $sesi->id,
                    'id_user' => Auth::user()->id,
                    'id_ruang_ujian' => $request->id,
                    'id_soal' => $soal->id,
                    'no' => FuncHelper::getNextNo($no),
                ]);
                $no++;
            }
            return redirect()->route('try-out', [
                'id' => $sesi->id,
                'user' => $sesi->id_user,
                'ujian' => $sesi->id_ruang_ujian,
            ]);
        }
    }

    public function loadSoal(Request $request)
    {
        try {
            $soal = TSoalSesi::with('sesi', 'soal')
                ->where('id_soal', $request->id_soal)
                ->where('id_sesi', $request->id_sesi)
                ->where('id_user', Auth::user()->id)
                ->where('id_ruang_ujian', $request->id_ruang_ujian)
                ->first();

            $tab = TSoalSesi::where('id_sesi', $request->id_sesi)
                ->where('id_user', Auth::user()->id)
                ->where('id_ruang_ujian', $request->id_ruang_ujian)->get();

            $data = [
                'id' => $soal->id,
                'id_soal' => $soal->id_soal,
                'no' => $soal->no,
                'soal' => $soal->soal->soal,
                'opsi_jawaban' => [
                    [
                        'opsi' => $soal->soal->opsi_a,
                        'value' => 'A',
                    ],
                    [
                        'opsi' => $soal->soal->opsi_b,
                        'value' => 'B',
                    ],
                    [
                        'opsi' => $soal->soal->opsi_c,
                        'value' => 'C',
                    ],
                    [
                        'opsi' => $soal->soal->opsi_d,
                        'value' => 'D',
                    ],
                    [
                        'opsi' => $soal->soal->opsi_e,
                        'value' => 'E',
                    ],
                ],
                'jawaban' => $soal->jawaban
            ];
            $viewSoal = view('user.ruang-cbt.components.soal', compact(
                'data'
            ))->render();

            $viewTap = view('user.ruang-cbt.components.tab-soal', compact(
                'tab'
            ))->render();
            return ['status' => 200, 'data' => $viewSoal, 'data2' => $viewTap];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal memuat soal'];
        }
    }

    public function tandaiSoal(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                FuncHelper::dxUpdate(new TSoalSesi(), ['id' => $request->id_soal], [
                    'jawaban' => $request->opsi,
                    'status' => 'ragu'
                ]);
            });
            return ['status' => 200, 'data' => $request->id_soal];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal memuat soal'];
        }
    }

    public function lanjutSoal(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                FuncHelper::dxUpdate(new TSoalSesi(), ['id' => $request->id_soal], [
                    'jawaban' => $request->opsi,
                    'status' => 'jawab'
                ]);
            });
            return ['status' => 200, 'data' => $request->id_soal];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal memuat soal'];
        }
    }

    public function loadSoalSelanjutnya(Request $request)
    {
        try {
            $soal = TSoalSesi::with('sesi', 'soal')
                ->where('no', $request->no)
                ->where('id_sesi', $request->id_sesi)
                ->where('id_user', Auth::user()->id)
                ->where('id_ruang_ujian', $request->id_ruang_ujian)
                ->first();

            $tab = TSoalSesi::where('id_sesi', $request->id_sesi)
                ->where('id_user', Auth::user()->id)
                ->where('id_ruang_ujian', $request->id_ruang_ujian)->get();

            $data = [
                'id' => $soal->id,
                'id_soal' => $soal->id_soal,
                'no' => $soal->no,
                'soal' => $soal->soal->soal,
                'opsi_jawaban' => [
                    [
                        'opsi' => $soal->soal->opsi_a,
                        'value' => 'A',
                    ],
                    [
                        'opsi' => $soal->soal->opsi_b,
                        'value' => 'B',
                    ],
                    [
                        'opsi' => $soal->soal->opsi_c,
                        'value' => 'C',
                    ],
                    [
                        'opsi' => $soal->soal->opsi_d,
                        'value' => 'D',
                    ],
                    [
                        'opsi' => $soal->soal->opsi_e,
                        'value' => 'E',
                    ],
                ],
                'jawaban' => $soal->jawaban
            ];
            $viewSoal = view('user.ruang-cbt.components.soal', compact(
                'data'
            ))->render();

            $viewTap = view('user.ruang-cbt.components.tab-soal', compact(
                'tab'
            ))->render();
            return ['status' => 200, 'data' => $viewSoal, 'data2' => $viewTap];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal memuat soal'];
        }
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
