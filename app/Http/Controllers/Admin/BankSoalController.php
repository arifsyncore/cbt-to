<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TemplateSoalExport;
use App\Helpers\FuncHelper;
use App\Http\Controllers\Controller;
use App\Imports\ImportSoal;
use App\Models\admin\MJadwal;
use App\Models\admin\MJenis;
use App\Models\admin\MJenisUjian;
use App\Models\admin\MJenisUjianDet;
use App\Models\admin\MNilaiJawaban;
use App\Models\admin\MPembahasan;
use App\Models\admin\MSoal;
use App\Models\admin\MUploadSoal;
use App\Models\MBankSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class BankSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = MBankSoal::with('jenis')->get();
            return DataTables::of($data)
                ->addColumn('jenis', function ($data) {
                    return $data->jenis ? $data->jenis->jenis : '';
                })
                ->addColumn('aksi', function ($data) {
                    $button = '
                     <button type="button" class="btn btn-icon btn-success btn-fab demo waves-effect waves-light" onclick="detail(' . $data->id . ')">
                        <span class="tf-icons ri-question-answer-line ri-22px"></span>
                    </button>
                    <button type="button" class="btn btn-icon btn-warning btn-fab demo waves-effect waves-light" onclick="edit(' . $data->id . ')">
                        <span class="tf-icons ri-edit-line ri-22px"></span>
                    </button>
                    <button type="button" class="btn btn-icon btn-danger btn-fab demo waves-effect waves-light" onclick="hapus(' . $data->id . ')">
                        <span class="tf-icons ri-delete-bin-line ri-22px"></span>
                    </button>
                    ';
                    return $button;
                })->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.bank-soal.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = 'add';
        $title = 'Tambah';
        $jenis_soals = MJenisUjian::all();
        $kode = $this->getKode();
        return view('admin.bank-soal.components.form', compact(
            'action',
            'title',
            'jenis_soals',
            'kode',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                FuncHelper::dxInsert(new MBankSoal(), [
                    'id_jenis' => $request->jenis_soal,
                    'nama_soal' => $request->nama,
                    'kode' => $request->kode,
                    'jml_opsi_jwb' => $request->opsi_jawab,
                ]);
            });
            return ['status' => 200, 'message' => 'Berhasil menyimpan data'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal menyimpan data'];
        }
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
    public function edit(Request $request)
    {
        $action = 'edit';
        $title = 'Edit';
        $jenis_soals = MJenisUjian::all();
        $types = MJenis::all();
        $data = MBankSoal::with('jadwal')->where('id', $request->id)->first();
        return view('admin.bank-soal.components.form', compact(
            'action',
            'title',
            'jenis_soals',
            'types',
            'data'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                FuncHelper::dxUpdate(new MBankSoal(), ['id' => $request->id], [
                    'id_jenis' => $request->jenis_soal,
                    'nama_soal' => $request->nama,
                    'kode' => $request->kode,
                    'jml_opsi_jwb' => $request->opsi_jawab,
                ]);
            });
            return ['status' => 200, 'message' => 'Berhasil mengubah data'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal mengubah data'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $check = MUploadSoal::where('id_bank_soal', $request->id)->get();
            if (count($check) > 0) {
                return ['status' => 500, 'message' => 'Bank soal sedang digunakan'];
            }
            DB::transaction(function () use ($request) {
                FuncHelper::dxDelete(new MBankSoal(), ['id' => $request->id]);
                FuncHelper::dxDelete(new MSoal(), ['id_bank_soal' => $request->id]);
            });
            return ['status' => 200, 'message' => 'Berhasil Menghapus Data'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal Menghapus Data'];
        }
    }

    public function getFromJenis(Request $request)
    {
        try {
            $data = MJenisUjian::with('detail')
                ->withSum('detail', 'jml_soal')
                ->withSum('detail', 'bobot_soal')
                ->where('id', $request->id)
                ->first();
            return ['status' => 200, 'data' => $data];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Terdapat kesalahan !'];
        }
    }

    public function getKode()
    {

        try {
            $bank = MBankSoal::orderBy('kode', 'DESC')->limit(1)->get();
            $default = 'S-' . str_pad('0', '3', '0', STR_PAD_LEFT);
            $lastKode = $bank->count() > 0 ? $bank[0]->kode : $default;
            $no = FuncHelper::getNextNo($lastKode);
            return $no;
        } catch (\Throwable $th) {
            return "000";
        }
    }

    public function detail(Request $request)
    {
        if (request()->ajax()) {
            $data = MSoal::with('jenissoal', 'nilaijawaban')->where('id_bank_soal', $request->id)->orderBy('id_jenis_det', 'ASC')->get();
            return DataTables::of($data)
                ->addColumn('soal', function ($data) {
                    $field = $data->soal;
                    return $field;
                })
                ->addColumn('opsi', function ($data) {
                    $field = '
                    <ol type="A">
                        <li>' . $data->opsi_a . '</li>
                        <li>' . $data->opsi_b . '</li>
                        <li>' . $data->opsi_c . '</li>
                        <li>' . $data->opsi_d . '</li>
                        <li>' . $data->opsi_e . '</li>
                    </ol> 
                    ';
                    return $field;
                })
                ->addColumn('jawaban', function ($data) {
                    if ($data->jenissoal->type_jenis == 'benar_salah') {
                        $field = $data->jawaban;
                    } else {
                        $value_a = $data->nilaijawaban->where('opsi', 'A')->first();
                        $value_b = $data->nilaijawaban->where('opsi', 'B')->first();
                        $value_c = $data->nilaijawaban->where('opsi', 'C')->first();
                        $value_d = $data->nilaijawaban->where('opsi', 'D')->first();
                        $value_d = $value_d->nilai ? $value_d->nilai : '';
                        $value_e = $data->nilaijawaban->where('opsi', 'E')->first();
                        $value_e = $value_e->nilai ? $value_e->nilai : '';
                        $field = '
                        <ol type="A">
                            <li>' . round($value_a->nilai) . '</li>
                            <li>' . round($value_b->nilai) . '</li>
                            <li>' . round($value_c->nilai) . '</li>
                            <li>' . round($value_d) . '</li>
                            <li>' . round($value_e) . '</li>
                        </ol>
                        ';
                    }

                    return $field;
                })
                ->addColumn('jenis_soal', function ($data) {
                    return $data->jenissoal->nama;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '
                    <button type="button" class="btn btn-icon btn-warning btn-fab demo waves-effect waves-light" data-id="' . $data->id . '" data-id_jenis="' . $data->jenissoal->id . '" onclick="edit(this)">
                        <span class="tf-icons ri-edit-line ri-22px"></span>
                    </button>
                    <button type="button" class="btn btn-icon btn-danger btn-fab demo waves-effect waves-light" onclick="hapus(' . $data->id . ')">
                        <span class="tf-icons ri-delete-bin-line ri-22px"></span>
                    </button>
                    ';
                    return $button;
                })->rawColumns(['aksi', 'soal', 'opsi', 'jawaban'])
                ->make(true);
        }
        $bank_soal = MBankSoal::with('detail', 'jenis')
            ->where('id', $request->id)
            ->first();
        return view('admin.bank-soal.components.detail', compact(
            'bank_soal'
        ));
    }

    public function pilihJenis(Request $request)
    {
        try {
            $bank_soal = MBankSoal::where('id', $request->id)->first();
            $jenis = MJenisUjian::with('detail')->where('id', $bank_soal->id_jenis)->first();
            $view = view('admin.bank-soal.components.pilih-jenis', compact('jenis'))->render();
            return ['status' => 200, 'data' => $view];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal memuat data'];
        }
    }

    public function formSoal(Request $request)
    {
        $action = 'add';
        $title = 'Tambah';
        $bank_soal = MBankSoal::where('id', $request->id_bank)->first();
        $jenis = MJenisUjianDet::where('id', $request->id)->first();
        if ($jenis->type_jenis == 'benar_salah') {
            return view('admin.bank-soal.components.form-benar-salah', compact(
                'action',
                'title',
                'jenis',
                'bank_soal',
            ));
        } else {
            return view('admin.bank-soal.components.form-nilai-jawaban', compact(
                'action',
                'title',
                'jenis',
                'bank_soal',
            ));
        }
    }

    public function detailAdd(Request $request)
    {
        try {
            $jenis = MJenisUjianDet::where('id',  $request->id_jenis)->first();
            $dibuat = MSoal::where('id_jenis_det', $request->id_jenis)->count();
            if (round($jenis->jml_soal) <= $dibuat) {
                return ['status' => 500, 'message' => 'Jenis soal ini sudah terpenuhi'];
            }
            DB::transaction(function () use ($request) {
                $soal = FuncHelper::dxInsert(new MSoal(), [
                    'id_bank_soal' => $request->id_bank,
                    'id_jenis_det' => $request->id_jenis,
                    'nomor_soal' => $this->getNo($request->id_bank),
                    'soal' => $request->soal,
                    'opsi_a' => $request->opsi_a,
                    'opsi_b' => $request->opsi_b,
                    'opsi_c' => $request->opsi_c,
                    'opsi_d' => $request->opsi_d,
                    'opsi_e' => $request->opsi_e,
                    'jawaban' => $request->jawaban ? $request->jawaban : '',
                ]);

                if ($request->jenis) {
                    if ($request->nilai_a) {
                        FuncHelper::dxInsert(new MNilaiJawaban(), [
                            'id_soal' => $soal->id,
                            'opsi' => 'A',
                            'nilai' => $request->nilai_a
                        ]);
                    }
                    if ($request->nilai_b) {
                        FuncHelper::dxInsert(new MNilaiJawaban(), [
                            'id_soal' => $soal->id,
                            'opsi' => 'B',
                            'nilai' => $request->nilai_b
                        ]);
                    }
                    if ($request->nilai_c) {
                        FuncHelper::dxInsert(new MNilaiJawaban(), [
                            'id_soal' => $soal->id,
                            'opsi' => 'C',
                            'nilai' => $request->nilai_c
                        ]);
                    }
                    if ($request->nilai_d) {
                        FuncHelper::dxInsert(new MNilaiJawaban(), [
                            'id_soal' => $soal->id,
                            'opsi' => 'D',
                            'nilai' => $request->nilai_d
                        ]);
                    }
                    if ($request->nilai_e) {
                        FuncHelper::dxInsert(new MNilaiJawaban(), [
                            'id_soal' => $soal->id,
                            'opsi' => 'E',
                            'nilai' => $request->nilai_e
                        ]);
                    }
                }

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('assets/gambar/pembahasan'), $imageName);
                    $imagePath = 'assets/gambar/pembahasan/' . $imageName;
                } else {
                    $imagePath = '';
                }

                FuncHelper::dxInsert(new MPembahasan(), [
                    'id_soal' => $soal->id,
                    'pembahasan' => $request->text_pembahasan,
                    'gambar' => $imagePath,
                    'url' => $request->url_video
                ]);
            });
            return ['status' => 200, 'message' => 'Berhasil menyimpan data'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal menyimpan data'];
        }
    }

    public function editDetail(Request $request)
    {
        $action = 'edit';
        $title = 'Ubah';
        $bank_soal = MBankSoal::where('id', $request->id_bank)->first();
        $jenis = MJenisUjianDet::where('id', $request->id_jenis)->first();
        $data = MSoal::with('nilaijawaban', 'pembahasan')->where('id', $request->id)->first();
        // return $data;
        if ($jenis->type_jenis == 'benar_salah') {
            return view('admin.bank-soal.components.form-benar-salah', compact(
                'action',
                'title',
                'jenis',
                'bank_soal',
                'data',
            ));
        } else {
            $value_a = $data->nilaijawaban->where('opsi', 'A')->first();
            $value_b = $data->nilaijawaban->where('opsi', 'B')->first();
            $value_c = $data->nilaijawaban->where('opsi', 'C')->first();
            $value_d = $data->nilaijawaban->where('opsi', 'D')->first();
            $nilai_d = $value_d->nilai ? $value_d->nilai : '';
            $id_d = $value_d->id ? $value_d->id : '';
            $value_e = $data->nilaijawaban->where('opsi', 'E')->first();
            $nilai_e = $value_e->nilai ? $value_e->nilai : '';
            $id_e = $value_e->id ? $value_e->id : '';
            $datanilai = [
                'a' => round($value_a->nilai),
                'b' => round($value_b->nilai),
                'c' => round($value_c->nilai),
                'd' => round($nilai_d),
                'e' => round($nilai_e),
                'id_a' => $value_a->id,
                'id_b' => $value_b->id,
                'id_c' => $value_c->id,
                'id_d' => $id_d,
                'id_e' => $id_e,
            ];
            return view('admin.bank-soal.components.form-nilai-jawaban', compact(
                'action',
                'title',
                'jenis',
                'bank_soal',
                'data',
                'datanilai'
            ));
        }
    }

    public function detailEdit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                FuncHelper::dxUpdate(new MSoal(), ['id' => $request->id], [
                    'soal' => $request->soal,
                    'opsi_a' => $request->opsi_a,
                    'opsi_b' => $request->opsi_b,
                    'opsi_c' => $request->opsi_c,
                    'opsi_d' => $request->opsi_d,
                    'opsi_e' => $request->opsi_e,
                    'jawaban' => $request->jawaban ? $request->jawaban : '',
                ]);

                if ($request->jenis) {
                    if ($request->nilai_a) {
                        FuncHelper::dxUpdate(new MNilaiJawaban(), ['id' => $request->id_a], [
                            'opsi' => 'A',
                            'nilai' => $request->nilai_a
                        ]);
                    }
                    if ($request->nilai_b) {
                        FuncHelper::dxUpdate(new MNilaiJawaban(), ['id' => $request->id_b], [
                            'opsi' => 'B',
                            'nilai' => $request->nilai_b
                        ]);
                    }
                    if ($request->nilai_c) {
                        FuncHelper::dxUpdate(new MNilaiJawaban(), ['id' => $request->id_c], [
                            'opsi' => 'C',
                            'nilai' => $request->nilai_c
                        ]);
                    }
                    if ($request->nilai_d) {
                        FuncHelper::dxUpdate(new MNilaiJawaban(), ['id' => $request->id_d], [
                            'opsi' => 'D',
                            'nilai' => $request->nilai_d
                        ]);
                    }
                    if ($request->nilai_e) {
                        FuncHelper::dxUpdate(new MNilaiJawaban(), ['id' => $request->id_e], [
                            'opsi' => 'E',
                            'nilai' => $request->nilai_e
                        ]);
                    }
                }

                $pembahasan = MPembahasan::where('id_soal', $request->id)->first();

                if ($request->hasFile('image')) {
                    if ($pembahasan->gambar <> '') {
                        $file_old = public_path() . '/' . $pembahasan->gambar;
                        unlink($file_old);
                    } else {
                        $file = $request->file('image');
                        $imageName = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('assets/gambar/pembahasan'), $imageName);
                        $imagePath = 'assets/gambar/pembahasan/' . $imageName;
                    }
                } else {
                    if ($pembahasan->gambar <> '') {
                        $file_old = public_path() . '/' . $pembahasan->gambar;
                        unlink($file_old);
                    }
                    $imagePath = '';
                }

                FuncHelper::dxUpdate(new MPembahasan(), ['id_soal' => $request->id], [
                    'pembahasan' => $request->text_pembahasan,
                    'gambar' => $imagePath,
                    'url_video' => $request->url_video
                ]);
            });
            return ['status' => 200, 'message' => 'Berhasil menyimpan data'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal menyimpan data'];
        }
    }

    public function detailHapus(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $soal = MSoal::with('nilaijawaban')->where('id', $request->id)->first();
                if (count($soal->nilaijawaban) > 0) {
                    FuncHelper::dxDelete(new MSoal(), ['id' => $request->id]);
                    FuncHelper::dxDelete(new MNilaiJawaban(), ['id_soal' => $request->id]);
                    FuncHelper::dxDelete(new MPembahasan(), ['id_soal' => $request->id]);
                } else {
                    FuncHelper::dxDelete(new MSoal(), ['id' => $request->id]);
                    FuncHelper::dxDelete(new MPembahasan(), ['id_soal' => $request->id]);
                }
            });
            return ['status' => 200, 'message' => 'Berhasil Menghapus Data'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal Menghapus Data'];
        }
    }

    public function importSoal(Request $request)
    {
        try {
            Excel::import(new ImportSoal($request), $request->file('import'));
            return ['status' => 200, 'message' => 'Berhasil import soal'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal import soal'];
        }
    }

    public function downloadTemplate()
    {
        return Excel::download(new TemplateSoalExport, 'template_upload_soal.xlsx');
    }

    public function getNo($id)
    {
        try {
            $data = MSoal::where('id_bank_soal', $id)->orderBy('nomor_soal', 'DESC')->limit(1)->get();
            $default = str_pad('0', '2', '0', STR_PAD_LEFT);
            $lastNum = $data->count() > 0 ? $data[0]->nomor_soal : $default;
            $no = FuncHelper::getNextNo($lastNum);
            return $no;
        } catch (\Throwable $th) {
            return "";
        }
    }
}
