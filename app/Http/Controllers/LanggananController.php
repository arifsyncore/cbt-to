<?php

namespace App\Http\Controllers;

use App\Helpers\FuncHelper;
use App\Models\TPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LanggananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('landing.langganan');
    }

    public function daftarLangganan()
    {
        $pesanan = TPesanan::where('id_user', Auth::user()->id)->first();
        if (!$pesanan) {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

            DB::transaction(function () use ($pesanan) {
                $pesan = FuncHelper::dxInsert(new TPesanan(), [
                    'id_user' => Auth::user()->id,
                    'no_pesanan' => 'INV' . rand(),
                    'tanggal_pesanan' => date("Y-m-d H:i:s"),
                    'status' => 'Belum Bayar',
                ]);

                $params = array(
                    'transaction_details' => array(
                        'order_id' => $pesan->no_pesanan,
                        'gross_amount' => 100000,
                    ),
                    'customer_details' => array(
                        'first_name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                    )
                );

                $snapToken = \Midtrans\Snap::getSnapToken($params);
                TPesanan::where('id', $pesan->id)->update([
                    'snap_token' => $snapToken,
                ]);
            });
            return redirect()->route('detail-pesanan');
        } else {
            return redirect()->route('detail-pesanan');
        }
    }

    public function detailPesanan()
    {
        $data = TPesanan::with('user')->where('id_user', Auth::user()->id)->first();
        return view('user.langganan.detail-pesanan', compact('data'));
    }

    // public function bayar(Request $request)
    // {
    //     $pesanan = TPesanan::with('user')->where('id', $request->id)->first();

    //     \Midtrans\Config::$serverKey = config('midtrans.server_key');
    //     \Midtrans\Config::$isProduction = config('midtrans.is_production');
    //     \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
    //     \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

    //     $params = array(
    //         'transaction_details' => array(
    //             'order_id' => rand(),
    //             'gross_amount' => 100000,
    //         ),
    //         'customer_details' => array(
    //             'first_name' => Auth::user()->name,
    //             'email' => Auth::user()->email,
    //         )
    //     );

    //     $snapToken = \Midtrans\Snap::getSnapToken($params);
    //     TPesanan::where('id', $pesanan->id)->update([
    //         'snap_token' => $snapToken
    //     ]);
    //     $data = [
    //         'id' => $pesanan->id,
    //         'token' => $snapToken,
    //     ];
    //     return ['status' => 200, 'data' => $data];
    // }

    public function bayarBerhasil($id)
    {
        DB::transaction(function () use ($id) {
            FuncHelper::dxUpdate(new TPesanan(), ['id' => $id], [
                'status' => 'Sudah Bayar'
            ]);
        });
        return redirect(route('detail-pesanan'));
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

    public function noPesanan()
    {
        try {
            $data = TPesanan::orderBy('no_pesanan', 'DESC')->limit(1)->get();
            $default = 'INV' . str_pad('0', '7', '0', STR_PAD_LEFT);
            $lastNum = $data->count() > 0 ? $data[0]->no_pesanan : $default;
            $no = FuncHelper::getNextNo($lastNum);
            return $no;
        } catch (\Throwable $th) {
            return "00";
        }
    }
}
