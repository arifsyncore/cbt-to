<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\user\TRuangUjian;
use App\Models\user\TSoalSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PeringkatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = TRuangUjian::with('soalto')->where('id_user', Auth::user()->id)->where('status', 'Selesai')->get();
            return DataTables::of($data)
                ->addColumn('kode', function ($data) {
                    return $data->soalto ? $data->soalto->soal->kode : '';
                })
                ->addColumn('nama_soal', function ($data) {
                    return $data->soalto ? $data->soalto->nama : '';
                })
                ->addColumn('aksi', function ($data) {
                    $button = '
                            <button type="button" class="btn btn-icon btn-primary btn-fab demo waves-effect waves-light" onclick="detail(' . $data->id_upload_soal . ')">
                                <span class="tf-icons ri-bar-chart-box-line ri-22px"></span>
                            </button>
                            ';
                    return $button;
                })->rawColumns(['aksi'])
                ->make(true);
        }
        return view('user.peringkat.index');
    }

    public function detail(Request $request)
    {
        $soal = TRuangUjian::with('soalto')->where('id_upload_soal', $request->id)->first();
        return view('user.peringkat.detail', compact('soal'));
    }

    public function listPeringkat($id)
    {
        $ruang_ujian = TRuangUjian::with('pengguna')->where('id_upload_soal', $id)->where('status', 'Selesai')->get();
        $peringkatArr = collect();
        $no = 1;
        foreach ($ruang_ujian as $key => $ujian) {
            $soal_sesi = TSoalSesi::with('soal', 'jenis')->where('id_ruang_ujian', $ujian->id)->get();
            $nilai = 0;
            foreach ($soal_sesi as $key => $sesi) {
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
            $param = [
                'id' => $ujian->id,
                'no' => $no++,
                'nama' => $ujian->pengguna->name,
                'skor' => $nilai
            ];
            $peringkatArr->add($param);
        }
        $data = $peringkatArr->sortByDesc('skor');
        $data = $data->values()->all();
        return DataTables::of($data)
            ->addColumn('no', function ($data) {
                return $data['no'];
            })
            ->addColumn('nama', function ($data) {
                return $data['nama'];
            })
            ->addColumn('skor', function ($data) {
                return $data['skor'];
            })
            ->addColumn('aksi', function ($data) {
                $id_ruang = $data['id'];
                $button = '
                            <button type="button" class="btn btn-icon btn-primary btn-fab demo waves-effect waves-light" onclick="detail(' . $id_ruang . ')">
                                <span class="tf-icons ri-book-open-line ri-22px"></span>
                            </button>
                            ';
                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function detailSoal(Request $request)
    {
        $soal = TRuangUjian::with('soalto')->where('id', $request->id)->first();
        return view('user.peringkat.detail-soal', compact('soal'));
    }

    public function listPeringkatDetail($data)
    {
        $param = json_decode($data, true);
        $id_jenis = $param['id_jenis'];
        $id_upload_soal = $param['id_upload_soal'];

        $ruang_ujian = TRuangUjian::with('pengguna')->where('id_upload_soal', $id_upload_soal)->where('status', 'Selesai')->get();
        $peringkatArr = collect();
        $no = 1;
        foreach ($ruang_ujian as $key => $ujian) {
            $soal_sesi = TSoalSesi::with('soal', 'jenis')->where('id_jenis_det', $id_jenis)->where('id_ruang_ujian', $ujian->id)->get();
            $nilai = 0;
            foreach ($soal_sesi as $key => $sesi) {
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
            $param = [
                'id' => $ujian->id,
                'no' => $no++,
                'nama' => $ujian->pengguna->name,
                'skor' => $nilai
            ];
            $peringkatArr->add($param);
        }
        $data = $peringkatArr->sortByDesc('skor');
        $data = $data->values()->all();
        return DataTables::of($data)
            ->addColumn('no', function ($data) {
                return $data['no'];
            })
            ->addColumn('nama', function ($data) {
                return $data['nama'];
            })
            ->addColumn('skor', function ($data) {
                return $data['skor'];
            })
            ->make(true);
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
