<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ManajemenUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = User::where('role_id', 2)->get();
            return DataTables::of($data)
                ->addColumn('aksi', function ($data) {
                    if ($data->status == 'aktif') {
                        $button = '
                        <button type="button" class="btn btn-icon btn-danger btn-fab demo waves-effect waves-light" onclick="nonaktif(' . $data->id . ')">
                            <span class="tf-icons ri-close-circle-line ri-22px"></span>
                        </button>';
                    } else {
                        $button = '
                        <button type="button" class="btn btn-icon btn-success btn-fab demo waves-effect waves-light" onclick="aktif(' . $data->id . ')">
                            <span class="tf-icons ri-checkbox-circle-line ri-22px"></span>
                        </button>';
                    }
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.manajemen-user.index');
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
    public function destroy(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                User::where('id', $request->id)->update(['status' => 'non aktif']);
            });
            return ['status' => 200, 'message' => 'Berhasil Non Aktif Akun'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal Non Aktif Akun'];
        }
    }

    public function aktifUser(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                User::where('id', $request->id)->update(['status' => 'aktif']);
            });
            return ['status' => 200, 'message' => 'Berhasil Mengaktifkan Akun'];
        } catch (\Throwable $th) {
            return ['status' => 500, 'message' => 'Gagal Mengaktifkan Akun'];
        }
    }
}
