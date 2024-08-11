<?php

namespace App\Http\Controllers\User;

use App\Helpers\FuncHelper;
use App\Http\Controllers\Controller;
use App\Models\admin\MUploadSoal;
use App\Models\user\TRuangUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RuangUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = TRuangUjian::with('soalto')->where('id_user', Auth::user()->id)->get();
            return DataTables::of($data)
                ->addColumn('kode', function ($data) {
                    return $data->soalto ? $data->soalto->soal->kode : '';
                })
                ->addColumn('nama_soal', function ($data) {
                    return $data->soalto ? $data->soalto->nama : '';
                })
                ->addColumn('tanggal_mulai', function ($data) {
                    return $data->soalto ? Carbon::parse($data->soalto->tanggal_mulai)->translatedFormat('d F Y H:i:s') : '';
                })
                ->addColumn('tanggal_selesai', function ($data) {
                    return $data->soalto ? Carbon::parse($data->soalto->tanggal_selesai)->translatedFormat('d F Y H:i:s') : '';
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 'Belum Dikerjakan') {
                        $badge = '<span class="badge rounded-pill bg-label-primary">' . $data->status . '</span>';
                    } else if ($data->status == 'Sedang Dikerjakan') {
                        $badge = '<span class="badge rounded-pill bg-label-warning">' . $data->status . '</span>';
                    } else if ($data->status == 'Selesai') {
                        $badge = '<span class="badge rounded-pill bg-label-success">' . $data->status . '</span>';
                    }
                    return $badge;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '
                     <button type="button" class="btn btn-icon btn-success btn-fab demo waves-effect waves-light" onclick="detail(' . $data->id . ')">
                        <span class="tf-icons ri-arrow-right-fill ri-22px"></span>
                    </button>
                    ';
                    return $button;
                })->rawColumns(['aksi', 'status'])
                ->make(true);
        }
        return view('user.ruang-ujian.index');
    }

    public function addRuangUjian(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $checkExist = TRuangUjian::where('id_user', Auth::user()->id)
                    ->where('id_upload_soal', $request->id)->first();
                if (!$checkExist) {
                    FuncHelper::dxInsert(new TRuangUjian(), [
                        'id_user' => Auth::user()->id,
                        'id_upload_soal' => $request->id,
                        'nomor_ujian' => $this->getNo($request->id),
                        'status' => 'Belum Dikerjakan'
                    ]);
                }
            });
            return redirect()->route('ruang-ujian');
        } catch (\Throwable $th) {
            return redirect()->route('landing');
        }
    }

    public function detail(Request $request)
    {
        $data = TRuangUjian::with('soalto')->where('id', $request->id)->first();
        // return $data->soalto->soal->jenis->detail;
        return view('user.ruang-ujian.detail', compact('data'));
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

    public function getNo($id)
    {
        try {
            $bank_soal = MUploadSoal::with('soal')->where('id', $id)->first();
            $data = TRuangUjian::with('soalto')->where('id_upload_soal', $id)->orderBy('id', 'DESC')->limit(1)->get();
            $default = $bank_soal->soal->kode . '/' .  str_pad('0', '5', '0', STR_PAD_LEFT);
            $lastNum = $data->count() > 0 ? $data[0]->nomor_ujian : $default;
            $no = FuncHelper::getNextNo($lastNum);
            return $no;
        } catch (\Throwable $th) {
            return "00";
        }
    }
}
