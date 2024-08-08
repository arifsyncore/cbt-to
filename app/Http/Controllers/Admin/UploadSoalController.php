<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FuncHelper;
use App\Http\Controllers\Controller;
use App\Models\admin\MJenis;
use App\Models\admin\MUploadSoal;
use App\Models\MBankSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UploadSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = MUploadSoal::with('soal', 'jenis')->get();
            return DataTables::of($data)
                ->addColumn('kode_soal', function ($data) {
                    return $data->soal ? $data->soal->kode : '';
                })
                ->addColumn('soal', function ($data) {
                    return $data->soal ? $data->soal->nama_soal : '';
                })
                ->addColumn('jenis', function ($data) {
                    return $data->soal ? $data->jenis->nama_jenis : '';
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
                })->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.upload-soal.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah';
        $action = 'add';
        $bank_soals = MBankSoal::with('detail', 'jenis')->withCount('detail')->get();
        $bank_soals = $bank_soals->filter(function ($bank_soals) {
            return $bank_soals->jenis->detail->sum('jml_soal') == $bank_soals->detail_count;
        });
        $tipe_soals = MJenis::all();
        return view('admin.upload-soal.components.form', compact(
            'title',
            'action',
            'bank_soals',
            'tipe_soals'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                FuncHelper::dxInsert(new MUploadSoal(), [
                    'id_jenis' => $request->jenis,
                    'id_bank_soal' => $request->soal,
                    'type_soal' => $request->tipe,
                    'tanggal_mulai' => $request->tanggal_mulai,
                    'tanggal_selesai' => $request->tanggal_selesai,
                    'durasi' => $request->durasi,
                    'acak_soal' => $request->acak_soal,
                    'acak_opsi' => $request->acak_opsi,
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
        $title = 'Ubah';
        $action = 'edit';
        $bank_soals = MBankSoal::with('detail')->withCount('detail')->get();
        $bank_soals = $bank_soals->filter(function ($bank_soals) {
            return $bank_soals->jml_soal == $bank_soals->detail_count;
        });
        $tipe_soals = MJenis::all();
        $data = MUploadSoal::with('soal', 'jenis')->where('id', $request->id)->first();
        return view('admin.upload-soal.components.form', compact(
            'title',
            'action',
            'bank_soals',
            'tipe_soals',
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
                FuncHelper::dxUpdate(new MUploadSoal(), ['id' => $request->id], [
                    'id_jenis' => $request->jenis,
                    'id_bank_soal' => $request->soal,
                    'type_soal' => $request->tipe,
                    'tanggal_mulai' => $request->tanggal_mulai,
                    'tanggal_selesai' => $request->tanggal_selesai,
                    'durasi' => $request->durasi,
                    'acak_soal' => $request->acak_soal,
                    'acak_opsi' => $request->acak_opsi,
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
            DB::transaction(function () use ($request) {
                FuncHelper::dxDelete(new MUploadSoal(), ['id' => $request->id]);
            });
            return ['status' => 200, 'message' => 'Berhasil Menghapus Data'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal Menghapus Data'];
        }
    }
}
