<?php

namespace App\Http\Controllers\admin;

use App\Helpers\FuncHelper;
use App\Http\Controllers\Controller;
use App\Models\admin\MJenisUjian;
use App\Models\admin\MJenisUjianDet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class MasterJenisSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = MJenisUjian::all();
            return DataTables::of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '
                    <button type="button" class="btn btn-icon btn-primary btn-fab demo waves-effect waves-light" onclick="show(' . $data->id . ')">
                        <span class="tf-icons ri-information-line ri-22px"></span>
                    </button>
                    <button type="button" class="btn btn-icon btn-warning btn-fab demo waves-effect waves-light" onclick="edit(' . $data->id . ')">
                        <span class="tf-icons ri-edit-line ri-22px"></span>
                    </button>
                    <button type="button" class="btn btn-icon btn-danger btn-fab demo waves-effect waves-light" onclick="hapus(' . $data->id . ')">
                        <span class="tf-icons ri-delete-bin-line ri-22px"></span>
                    </button>
                    ';

                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.jenis-soal.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = 'add';
        $title = 'Tambah';
        $kode = $this->getKode();
        return view('admin.jenis-soal.components.form', compact(
            'action',
            'title',
            'kode',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            foreach ($request['group-a'] as $key => $value) {
                if ($value['nama'] == null) {
                    return ['status' => 500, 'message' => 'Periksa kembali data yang anda input'];
                }
                if ($value['bobot'] == null) {
                    return ['status' => 500, 'message' => 'Periksa kembali data yang anda input'];
                }
                if ($value['jml'] == null) {
                    return ['status' => 500, 'message' => 'Periksa kembali data yang anda input'];
                }
            }
            DB::transaction(function () use ($request) {
                $jenis = FuncHelper::dxInsert(new MJenisUjian(), [
                    'kode' => $request->kode,
                    'jenis' => $request->jenis
                ]);
                foreach ($request['group-a'] as $key => $value) {
                    FuncHelper::dxInsert(new MJenisUjianDet(), [
                        'id_jenis' => $jenis->id,
                        'nama' => $value['nama'],
                        'bobot_soal' => $value['bobot'],
                        'jml_soal' => $value['jml']
                    ]);
                }
            });
            return ['status' => 200, 'message' => 'Berhasil menyimpan data'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal menyimpan data'];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            $data = MJenisUjian::with('detail')
                ->withSum('detail', 'jml_soal')
                ->where('id', $request->id)
                ->first();
            $view = view('admin.jenis-soal.components.detail', compact('data'))->render();
            return ['status' => 200, 'data' => $view];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal memuat data'];
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $action = 'edit';
        $title = 'Ubah';
        $data = MJenisUjian::with('detail')->where('id', $request->id)->first();
        return view('admin.jenis-soal.components.form', compact(
            'action',
            'title',
            'data',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                FuncHelper::dxUpdate(new MJenisUjian(), ['id' => $request->id], [
                    'kode' => $request->kode,
                    'jenis' => $request->jenis
                ]);

                FuncHelper::dxDelete(new MJenisUjianDet(), ['id_jenis' => $request->id]);
                foreach ($request['group-a'] as $key => $value) {
                    FuncHelper::dxInsert(new MJenisUjianDet(), [
                        'id_jenis' => $request->id,
                        'nama' => $value['nama'],
                        'bobot_soal' => $value['bobot'],
                        'jml_soal' => $value['jml']
                    ]);
                }
            });
            return ['status' => 200, 'message' => 'Berhasil mengubah data'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Berhasil mengubah data'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                FuncHelper::dxDelete(new MJenisUjianDet(), ['id_jenis' => $request->id]);
                FuncHelper::dxDelete(new MJenisUjian(), ['id' => $request->id]);
            });
            return ['status' => 200, 'message' => 'Berhasil Menghapus Data'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal Menghapus Data'];
        }
    }

    public function getKode()
    {
        try {
            $jenis = MJenisUjian::orderBy('kode', 'DESC')->limit(1)->get();
            $default = 'K-' . str_pad('0', '3', '0', STR_PAD_LEFT);
            $lastKode = $jenis->count() > 0 ? $jenis[0]->kode : $default;
            $no = FuncHelper::getNextNo($lastKode);
            return $no;
        } catch (\Throwable $th) {
            return "000";
        }
    }
}
