<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans;

class PaymentController extends Controller
{
    public function generate(Request $request)
    {
        Midtrans\Config::$serverKey = config('app.midtrans.server_key');

        Midtrans\Config::$isSanitized = true;
        Midtrans\Config::$is3ds = true;

        $midtrans_transaction = Midtrans\Snap::createTransaction($request->data);
// Save redirect uri to order
        return response()->json([
            'code' => '00',
            'message' => 'success',
            'data' => $midtrans_transaction
        ]);

    }
}
