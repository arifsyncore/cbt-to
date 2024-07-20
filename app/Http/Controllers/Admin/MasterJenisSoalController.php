<?php

namespace App\Http\Controllers\admin;

use App\Helpers\FuncHelper;
use App\Http\Controllers\Controller;
use App\Models\admin\MJenisUjian;
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
        try {
            $action = 'add';
            $view = view('admin.jenis-soal.components.form', compact(
                'action'
            ))->render();
            return ['status' => 200, 'data' => $view];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal memuat data'];
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                FuncHelper::dxInsert(new MJenisUjian(), [
                    'kode' => $request->kode,
                    'jenis' => $request->jenis
                ]);
            });
            return ['status' => 200, 'message' => 'Berhasil menyimpan data'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Berhasil menyimpan data'];
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
        try {
            $action = 'edit';
            $jenis = MJenisUjian::where('id', $request->id)->first();
            $view = view('admin.jenis-soal.components.form', compact(
                'action',
                'jenis'
            ))->render();
            return ['status' => 200, 'data' => $view];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal memuat data'];
        }
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
                FuncHelper::dxDelete(new MJenisUjian(), ['id' => $request->id]);
            });
            return ['status' => 200, 'message' => 'Berhasil Menghapus Data'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal Menghapus Data'];
        }
    }
}
