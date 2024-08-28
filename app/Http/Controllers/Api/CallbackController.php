<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TJenisUser;
use App\Models\TPesanan;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');
    }

    public function index(Request $request)
    {
        $payload      = $request->getContent();
        $notification = json_decode($payload);

        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . config('midtrans.server_key'));

        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $transaction  = $notification->transaction_status;
        $type         = $notification->payment_type;
        $orderId      = $notification->order_id;
        $fraud        = $notification->fraud_status;

        $data_pesanan = TPesanan::where('no_pesanan', $orderId)->first();
        $jenis_user = TJenisUser::where('id_user', $data_pesanan->id_user)->first();

        if ($transaction == 'capture') {

            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {

                if ($fraud == 'challenge') {

                    /**
                     *   update invoice to pending
                     */
                    $data_pesanan->update([
                        'status' => 'Belum Bayar'
                    ]);
                } else {

                    /**
                     *   update invoice to success
                     */
                    $data_pesanan->update([
                        'status' => 'Sudah Bayar'
                    ]);

                    $jenis_user->update([
                        'jenis' => 'Premium'
                    ]);
                }
            }
        } elseif ($transaction == 'settlement') {

            /**
             *   update invoice to success
             */
            $data_pesanan->update([
                'status' => 'Sudah Bayar'
            ]);

            $jenis_user->update([
                'jenis' => 'Premium'
            ]);
        } elseif ($transaction == 'pending') {


            /**
             *   update invoice to pending
             */
            $data_pesanan->update([
                'status' => 'Belum Bayar'
            ]);
        } elseif ($transaction == 'deny') {


            /**
             *   update invoice to failed
             */
            $data_pesanan->update([
                'status' => 'Belum Bayar'
            ]);
        } elseif ($transaction == 'expire') {


            /**
             *   update invoice to expired
             */
            $data_pesanan->update([
                'status' => 'Belum Bayar'
            ]);
        } elseif ($transaction == 'cancel') {

            /**
             *   update invoice to failed
             */
            $data_pesanan->update([
                'status' => 'Belum Bayar'
            ]);
        }
    }
}
