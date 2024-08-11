<?php

namespace App\Http\Controllers\User;

use App\Helpers\FuncHelper;
use App\Http\Controllers\Controller;
use App\Models\admin\MUploadSoal;
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
    // public function index(Request $request)
    // {
    //     $sesi = TSesiUser::with('ruangujian')
    //         ->where('id_user', Auth::user()->id)
    //         ->where('id_ruang_ujian', $request->ujian)
    //         ->first();
    //     $nama_soal = $sesi->ruangujian->soalto->soal->nama_soal;
    //     // load soal tab soal
    //     $tab = TSoalSesi::where('id_sesi', $request->id)
    //         ->where('id_user', Auth::user()->id)
    //         ->where('id_ruang_ujian', $request->ujian)->get();

    //     $soal = TSoalSesi::with('sesi', 'soal')
    //         ->where('id_sesi', $request->id)
    //         ->where('id_user', Auth::user()->id)
    //         ->where('id_ruang_ujian', $request->ujian)
    //         ->first();
    //     $soalArr = [
    //         'id' => $soal->soal->id,
    //         'no' => $soal->soal->nomor_soal,
    //         'soal' => $soal->soal->soal,
    //         'opsi_jawaban' => [
    //             [
    //                 'opsi' => $soal->soal->opsi_a,
    //                 'value' => 'A',
    //             ],
    //             [
    //                 'opsi' => $soal->soal->opsi_b,
    //                 'value' => 'B',
    //             ],
    //             [
    //                 'opsi' => $soal->soal->opsi_c,
    //                 'value' => 'C',
    //             ],
    //             [
    //                 'opsi' => $soal->soal->opsi_d,
    //                 'value' => 'D',
    //             ],
    //             [
    //                 'opsi' => $soal->soal->opsi_e,
    //                 'value' => 'E',
    //             ],
    //         ],
    //     ];
    //     $waktu_sekarang = date("Y-m-d H:i:s");
    //     $waktu_sekarang = strtotime($waktu_sekarang);
    //     $waktu_selesai = $sesi->waktu_selesai;
    //     $waktu_selesai = strtotime($waktu_selesai);
    //     $timestamp = $waktu_selesai;
    //     $sisa_waktu = ($timestamp - $waktu_sekarang) * 1000;
    //     $data = [
    //         'sisa_waktu' => $sisa_waktu,
    //         'nama_soal' => $nama_soal,
    //         'tab' => $tab,
    //         'id_soal' => $tab[0]->id_soal,
    //         'id_sesi' => $request->id,
    //         'id_ruang_ujian' => $request->ujian
    //     ];
    //     return view('user.ruang-cbt.index', compact('data'));
    // }

    public function index(Request $request)
    {
        $sesi = TSesiUser::with('ruangujian')
            ->where('id_user', Auth::user()->id)
            ->where('id_ruang_ujian', $request->ujian)
            ->first();

        $nama_soal = $sesi->ruangujian->soalto->nama;

        $waktu_sekarang = date("Y-m-d H:i:s");
        $waktu_sekarang = strtotime($waktu_sekarang);
        $waktu_selesai = $sesi->waktu_selesai;
        $waktu_selesai = strtotime($waktu_selesai);
        $timestamp = $waktu_selesai;
        $sisa_waktu = ($timestamp - $waktu_sekarang) * 1000;

        $data = [
            'sisa_waktu' => $sisa_waktu,
            'nama_soal' => $nama_soal,
            'id_sesi' => $request->id,
            'id_ruang_ujian' => $request->ujian,
        ];
        return view('user.ruang-cbt.index', compact('data'));
    }

    public function addUjian(Request $request)
    {
        try {
            $waktu_sekarang = date("Y-m-d H:i:s");
            $waktu_sekarang = strtotime($waktu_sekarang);
            $ruang = TRuangUjian::where('id', $request->id)->first();
            // cek selesai apa belum
            $soal = MUploadSoal::where('id', $ruang->id_upload_soal)->first();
            $waktu_selesai = strtotime($soal->tanggal_selesai);
            $waktu_mulai = strtotime($soal->tanggal_mulai);
            if ($waktu_sekarang > $waktu_selesai) {
                return ['status' => 500, 'message' => 'Batas waktu pengerjaan sudah habis, soal tidak dapat dikerjakan'];
            }
            // cek soal sudah mulai apa belum
            if ($waktu_sekarang < $waktu_mulai) {
                return ['status' => 500, 'message' => 'Waktu pengerjaan belum mulai, harap tunggu sampai tanggal yang sudah dijadwalkan'];
            }
            // cek sudah selesai atau belum
            $checkStatus = TRuangUjian::where('id', $request->id)->where('status', 'Selesai')->first();
            if ($checkStatus) {
                return ['status' => 500, 'message' => 'Soal try-out sudah selesai dikerjakan'];
            }

            $checkExist = TSesiUser::where('id_user', Auth::user()->id)->where('id_ruang_ujian', $request->id)->first();
            if ($checkExist) {
                $data = [
                    'id' => $checkExist->id,
                    'user' => $checkExist->id_user,
                    'ujian' => $checkExist->id_ruang_ujian,
                ];
                return ['status' => 200, 'data' => $data];
            } else {
                $ruang_ujian = TRuangUjian::with('soalto')->where('id', $request->id)->first();
                TRuangUjian::where('id', $request->id)->update(['status' => 'Sedang Dikerjakan']);
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
                $soal = $ruang_ujian->soalto->soal->detail;
                foreach ($soal as $key => $soal) {
                    FuncHelper::dxInsert(new TSoalSesi(), [
                        'id_sesi' => $sesi->id,
                        'id_user' => Auth::user()->id,
                        'id_ruang_ujian' => $request->id,
                        'id_soal' => $soal->id,
                        'id_jenis_det' => $soal->id_jenis_det,
                        'no' => $this->getNo($sesi->id),
                    ]);
                }
                $data = [
                    'id' => $sesi->id,
                    'user' => $sesi->id_user,
                    'ujian' => $sesi->id_ruang_ujian,
                ];
                return ['status' => 200, 'data' => $data];
            }
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal masuk ruang ujian, harap hubungi admin'];
        }
    }

    public function loadSoal(Request $request)
    {
        try {
            $ruang_ujian = TRuangUjian::where('id', $request->id_ruang)->first();
            //tab nonor
            $jenis = $ruang_ujian->soalto->soal->jenis->detail;
            $tabArray = array();
            $nomor = array();
            foreach ($jenis as $key => $value) {
                $tabs = TSoalSesi::where('id_ruang_ujian', $request->id_ruang)
                    ->where('id_user', Auth::user()->id)
                    ->where('id_jenis_det', $value->id)
                    ->orderBy('id_jenis_det', 'ASC')
                    ->get();
                $detTabArray = array();
                foreach ($tabs as $key => $tab) {
                    $detTabArray[] = [
                        'id' => $tab->id,
                        'no' => $tab->no,
                        'status' => $tab->status
                    ];
                    $nomor[] = $tab->no;
                }
                $tabArray[] = [
                    'jenis' => $value->nama,
                    'detailTab' => $detTabArray
                ];
            }

            $viewTab = view('user.ruang-cbt.components.tab-soal', compact('tabArray'))->render();

            $id_soal_pertama = $tabArray[0]['detailTab'][0]['id'];
            $sesi = TSesiUser::where('id', $request->id_sesi)
                ->where('id_user', Auth::user()->id)
                ->where('id_ruang_ujian', $request->id_ruang)
                ->first();

            $id_soal_pertama = $request->nomor == null ? $id_soal_pertama : $request->nomor;

            $soal = TSoalSesi::with('soal')->where('id', $id_soal_pertama)->where('id_sesi', $sesi->id)->first();
            if (round($soal->soal->banksoal->jml_opsi_jwb) == 3) {
                $opsi = [
                    [
                        'opsi' =>  $soal->soal->opsi_a,
                        'value' => 'A'
                    ],
                    [
                        'opsi' =>  $soal->soal->opsi_b,
                        'value' => 'B'
                    ],
                    [
                        'opsi' =>  $soal->soal->opsi_c,
                        'value' => 'C'
                    ],
                ];
            } else if (round($soal->soal->banksoal->jml_opsi_jwb) == 4) {
                $opsi = [
                    [
                        'opsi' =>  $soal->soal->opsi_a,
                        'value' => 'A'
                    ],
                    [
                        'opsi' =>  $soal->soal->opsi_b,
                        'value' => 'B'
                    ],
                    [
                        'opsi' =>  $soal->soal->opsi_c,
                        'value' => 'C'
                    ],
                    [
                        'opsi' =>  $soal->soal->opsi_d,
                        'value' => 'D'
                    ],
                ];
            } else if (round($soal->soal->banksoal->jml_opsi_jwb) == 5) {
                $opsi = [
                    [
                        'opsi' =>  $soal->soal->opsi_a,
                        'value' => 'A'
                    ],
                    [
                        'opsi' =>  $soal->soal->opsi_b,
                        'value' => 'B'
                    ],
                    [
                        'opsi' =>  $soal->soal->opsi_c,
                        'value' => 'C'
                    ],
                    [
                        'opsi' =>  $soal->soal->opsi_d,
                        'value' => 'D'
                    ],
                    [
                        'opsi' =>  $soal->soal->opsi_e,
                        'value' => 'E'
                    ],
                ];
            }
            $soalArr = [
                'id' => $soal->id,
                'no' => $soal->no,
                'soal' => $soal->soal->soal,
                'jml_opsi' => round($soal->soal->banksoal->jml_opsi_jwb),
                'jawaban' => $soal->jawaban,
                'opsi' => $opsi,
            ];
            $maxNo = max($nomor);
            $viewSoal = view('user.ruang-cbt.components.soal', compact('soalArr', 'maxNo'))->render();

            return ['status' => 200, 'dataTab' => $viewTab, 'dataSoal' => $viewSoal];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Error'];
        }
    }

    public function simpanJawaban(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                TSoalSesi::where('id', $request->id)
                    ->update(['jawaban' => $request->value, 'status' => 'jawab']);
            });
            return ['status' => 200];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Error'];
        }
    }

    public function submitJawaban(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                FuncHelper::dxUpdate(new TRuangUjian(), ['id' => $request->id_ruang], [
                    'status' => 'Selesai'
                ]);
            });
            return ['status' => 200];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Error'];
        }
    }

    // public function loadSoal(Request $request)
    // {
    //     try {
    //         $soal = TSoalSesi::with('sesi', 'soal')
    //             ->where('id_soal', $request->id_soal)
    //             ->where('id_sesi', $request->id_sesi)
    //             ->where('id_user', Auth::user()->id)
    //             ->where('id_ruang_ujian', $request->id_ruang_ujian)
    //             ->first();

    //         $tab = TSoalSesi::where('id_sesi', $request->id_sesi)
    //             ->where('id_user', Auth::user()->id)
    //             ->where('id_ruang_ujian', $request->id_ruang_ujian)->get();

    //         $data = [
    //             'id' => $soal->id,
    //             'id_soal' => $soal->id_soal,
    //             'no' => $soal->no,
    //             'soal' => $soal->soal->soal,
    //             'opsi_jawaban' => [
    //                 [
    //                     'opsi' => $soal->soal->opsi_a,
    //                     'value' => 'A',
    //                 ],
    //                 [
    //                     'opsi' => $soal->soal->opsi_b,
    //                     'value' => 'B',
    //                 ],
    //                 [
    //                     'opsi' => $soal->soal->opsi_c,
    //                     'value' => 'C',
    //                 ],
    //                 [
    //                     'opsi' => $soal->soal->opsi_d,
    //                     'value' => 'D',
    //                 ],
    //                 [
    //                     'opsi' => $soal->soal->opsi_e,
    //                     'value' => 'E',
    //                 ],
    //             ],
    //             'jawaban' => $soal->jawaban
    //         ];
    //         $viewSoal = view('user.ruang-cbt.components.soal', compact(
    //             'data'
    //         ))->render();

    //         $viewTap = view('user.ruang-cbt.components.tab-soal', compact(
    //             'tab'
    //         ))->render();
    //         return ['status' => 200, 'data' => $viewSoal, 'data2' => $viewTap];
    //     } catch (\Throwable $th) {
    //         return ['status' => 500, 'message' => 'Gagal memuat soal'];
    //     }
    // }

    // public function tandaiSoal(Request $request)
    // {
    //     try {
    //         DB::transaction(function () use ($request) {
    //             FuncHelper::dxUpdate(new TSoalSesi(), ['id' => $request->id_soal], [
    //                 'jawaban' => $request->opsi,
    //                 'status' => 'ragu'
    //             ]);
    //         });
    //         return ['status' => 200, 'data' => $request->id_soal];
    //     } catch (\Throwable $th) {
    //         return ['status' => 500, 'message' => 'Gagal memuat soal'];
    //     }
    // }

    // public function lanjutSoal(Request $request)
    // {
    //     try {
    //         DB::transaction(function () use ($request) {
    //             FuncHelper::dxUpdate(new TSoalSesi(), ['id' => $request->id_soal], [
    //                 'jawaban' => $request->opsi,
    //                 'status' => 'jawab'
    //             ]);
    //         });
    //         return ['status' => 200, 'data' => $request->id_soal];
    //     } catch (\Throwable $th) {
    //         return ['status' => 500, 'message' => 'Gagal memuat soal'];
    //     }
    // }

    // public function loadSoalSelanjutnya(Request $request)
    // {
    //     try {
    //         $soal = TSoalSesi::with('sesi', 'soal')
    //             ->where('no', $request->no)
    //             ->where('id_sesi', $request->id_sesi)
    //             ->where('id_user', Auth::user()->id)
    //             ->where('id_ruang_ujian', $request->id_ruang_ujian)
    //             ->first();

    //         $tab = TSoalSesi::where('id_sesi', $request->id_sesi)
    //             ->where('id_user', Auth::user()->id)
    //             ->where('id_ruang_ujian', $request->id_ruang_ujian)->get();

    //         $data = [
    //             'id' => $soal->id,
    //             'id_soal' => $soal->id_soal,
    //             'no' => $soal->no,
    //             'soal' => $soal->soal->soal,
    //             'opsi_jawaban' => [
    //                 [
    //                     'opsi' => $soal->soal->opsi_a,
    //                     'value' => 'A',
    //                 ],
    //                 [
    //                     'opsi' => $soal->soal->opsi_b,
    //                     'value' => 'B',
    //                 ],
    //                 [
    //                     'opsi' => $soal->soal->opsi_c,
    //                     'value' => 'C',
    //                 ],
    //                 [
    //                     'opsi' => $soal->soal->opsi_d,
    //                     'value' => 'D',
    //                 ],
    //                 [
    //                     'opsi' => $soal->soal->opsi_e,
    //                     'value' => 'E',
    //                 ],
    //             ],
    //             'jawaban' => $soal->jawaban
    //         ];
    //         $viewSoal = view('user.ruang-cbt.components.soal', compact(
    //             'data'
    //         ))->render();

    //         $viewTap = view('user.ruang-cbt.components.tab-soal', compact(
    //             'tab'
    //         ))->render();
    //         return ['status' => 200, 'data' => $viewSoal, 'data2' => $viewTap];
    //     } catch (\Throwable $th) {
    //         return ['status' => 500, 'message' => 'Gagal memuat soal'];
    //     }
    // }

    public function getNo($id_sesi)
    {
        $sesi_user = TSoalSesi::where('id_sesi', $id_sesi)->orderBy('no', 'DESC')->limit(1)->get();
        $default = 0;
        $lastNo = $sesi_user->count() > 0 ? $sesi_user[0]->no : $default;
        $no = FuncHelper::getNextNo($lastNo);
        return $no;
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
