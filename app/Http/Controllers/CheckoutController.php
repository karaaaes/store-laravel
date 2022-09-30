<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Transaction;
use App\TransactionDetail;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //
    public function process(Request $request)
    {
        //Save Users Data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        //Proses checkout
        $code = 'STORE-' . mt_rand(00000, 99999);
        $carts = Cart::with(['product', 'user'])
            ->where('users_id', Auth::user()->id)
            ->get();

        //Transaction Create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transactions_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'STORE-' . mt_rand(00000, 99999);

            TransactionDetail::create([
                'trasanctions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }
        // return dd($transaction);

        //Delete Cart Data
        Cart::with(['product', 'user'])
        ->where('users_id', Auth::user()->id)
        ->delete();

        //Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3Ds');


        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                "phone" => Auth::user()->phone_number,
                "email" => Auth::user()->email,
            ],
            'enabled_payments' => [
                "gopay", "permata_va", "bank_transfer"
            ],
            'bca_va' => [
                "va_number" => "12345678911",
                "sub_company_code" => "00000",
            ],
            'vtweb' => [],
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        //Set konfigurasi Midtrans
        Config::$serverKey=config('services.midtrans.serverKey');
        Config::$isProduction=config('services.midtrans.isProduction');
        Config::$isSanitized=config('services.midtrans.isSanitized');
        Config::$is3ds=config('services.midtrans.is3Ds');

        //Instance midtrans notification
        $notification = new Notification();

        //Assign ke variable untuk memudahkan code
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        //Cari transaksi berdasarkan ID 
        $transaction = Transaction::findOrFail($order_id);

        //Handle notification status
        if($status == 'capture'){
            if($type == 'credit_card'){
                if($fraud == 'challenge'){
                    $transaction->status = 'PENDING';
                }else{
                    $transaction->status = 'SUCCESS';
                }
            }
        }else if($status == 'settlement'){
            $transaction->status = 'SUCCESS';
        }else if($status == 'pending'){
            $transaction->status = 'PENDING';
        }else if($status == 'deny'){
            $transaction->status = 'CANCELLED';
        }else if($status == 'expire'){
            $transaction->status = 'CANCELLED';
        }else if($status == 'cancel'){
            $transaction->status = 'CANCELLED';
        }

        //Simpan transaksi
        $transaction->save();
        
        //
    }
}
