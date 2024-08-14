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
            $data = MSoal::with('jenissoal')->where('id_bank_soal', $request->id)->orderBy('id_jenis_det', 'ASC')->get();
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
                    $field = $data->jawaban;
                    return $field;
                })
                ->addColumn('jenis_soal', function ($data) {
                    return $data->jenissoal->nama;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '
                    <button type="button" class="btn btn-icon btn-warning btn-fab demo waves-effect waves-light" onclick="edit(' . $data->id . ')">
                        <span class="tf-icons ri-edit-line ri-22px"></span>
                    </button>
                    <button type="button" class="btn btn-icon btn-danger btn-fab demo waves-effect waves-light" onclick="hapus(' . $data->id . ')">
                        <span class="tf-icons ri-delete-bin-line ri-22px"></span>
                    </button>
                    ';
                    return $button;
                })->rawColumns(['aksi', 'soal', 'opsi'])
                ->make(true);
        }
        $bank_soal = MBankSoal::with('detail', 'jenis')
            ->where('id', $request->id)
            ->first();
        return view('admin.bank-soal.components.detail', compact(
            'bank_soal'
        ));
    }

    public function formDetail(Request $request)
    {
        try {
            $action = 'add';
            $title = 'Tambah';
            $bank_soal = MBankSoal::with('jenis')->where('id', $request->id)->first();
            $view = view('admin.bank-soal.components.form-detail', compact(
                'bank_soal',
                'action',
                'title'
            ))->render();
            return ['status' => 200, 'data' => $view];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal memuat data'];
        }
    }

    public function detailAdd(Request $request)
    {
        try {
            $jenis = MJenisUjianDet::where('id',  $request->jenis_soal)->first();
            $dibuat = MSoal::where('id_jenis_det', $request->jenis_soal)->count();
            if (round($jenis->jml_soal) <= $dibuat) {
                return ['status' => 500, 'message' => 'Jenis soal ini sudah terpenuhi'];
            }
            DB::transaction(function () use ($request) {
                FuncHelper::dxInsert(new MSoal(), [
                    'id_bank_soal' => $request->id_bank,
                    'id_jenis_det' => $request->jenis_soal,
                    'nomor_soal' => $this->getNo($request->id_bank),
                    'soal' => $request->soal,
                    'opsi_a' => $request->opsi_a,
                    'opsi_b' => $request->opsi_b,
                    'opsi_c' => $request->opsi_c,
                    'opsi_d' => $request->opsi_d,
                    'opsi_e' => $request->opsi_e,
                    'jawaban' => $request->jawaban,
                ]);
            });
            $bank_soal = MBankSoal::with('detail')->where('id', $request->id_bank)->first();
            return ['status' => 200, 'message' => 'Berhasil menyimpan data', 'bank' => $bank_soal];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal menyimpan data'];
        }
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

    public function editDetail(Request $request)
    {
        try {
            $action = 'edit';
            $title = 'Ubah';
            $bank_soal = MBankSoal::where('id', $request->id_bank)->first();
            $data = MSoal::where('id', $request->id)->first();
            $view = view('admin.bank-soal.components.form-detail', compact(
                'bank_soal',
                'action',
                'title',
                'data'
            ))->render();
            return ['status' => 200, 'data' => $view];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal memuat data'];
        }
    }

    public function detailEdit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                FuncHelper::dxUpdate(new MSoal(), ['id' => $request->id], [
                    'id_jenis_det' => $request->jenis_soal,
                    'soal' => $request->soal,
                    'opsi_a' => $request->opsi_a,
                    'opsi_b' => $request->opsi_b,
                    'opsi_c' => $request->opsi_c,
                    'opsi_d' => $request->opsi_d,
                    'opsi_e' => $request->opsi_e,
                    'jawaban' => $request->jawaban,
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
                FuncHelper::dxDelete(new MSoal(), ['id' => $request->id]);
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
            return ['status' => 200, 'message' => 'Berhasil import gambar'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal import soal'];
        }
    }

    public function downloadTemplate()
    {
        return Excel::download(new TemplateSoalExport, 'template_upload_soal.xlsx');
    }
}
