<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Notification;
use App\Services\Midtrans\CallbackService;
use Illuminate\Http\Request;
use App\Services\Midtrans\CreateSnapTokenService;

class DonationApiController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'amount' => 'required',
       
        ]);

        $campaign = Campaign::find($request->campaign_id);

        $validatedData['amount'] = preg_replace('/[^0-9]/', '', $validatedData['amount']);

        $data = new Donation();
        $data->user_id = $request->user_id;
        $data->campaign_id = $request->campaign_id;
        $data->invoice_number = 'INV-DL-'.date('Ymdhis').'-'. $request->user_id;
        $data->amount = $validatedData['amount'] ;
        $data->status = "paid";
        $data->save();  

        $notification = new Notification();
        $notification->title = 'Donasi Diterima !';
        $notification->user_id = $request->user_id;
        $notification->description = 'Terima kasih atas donasi yang diberikan terhadap campaign ' . $campaign->name;
        $notification->type = 'announcement' ;
        $notification->save();  
        

        $id = $data->id;

        $snapToken = $data->snap_token;
        if (is_null($snapToken)) {
            $midtrans = new CreateSnapTokenService($data);
            $snapToken = $midtrans->getSnapToken();
            Donation::where("id", $id)->update(['snap_token' => $snapToken]);
        }
        
        return response()->json([
            // 'status' => 'success',
            // 'message' => 'Pembelian berhasil dilakukan.',
            // 'data' => Donation::find($id)
            'statusCode' => 200,
            'body' => Donation::find($id)
        ]);
    }

     public function callback()
    {
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();
            // dd($order);

            
            if ($callback->isSuccess()) {
                Donation::where('id', $order->id)->update([
                    'status' => 'paid',
                ]);

                
                // $active_until = $order->price_type == 'yearly' ? '+1 year' : '+1 month';
                // $add_month = $order->price_type == 'yearly' ? 12 : 1;
                // $checkWA = WaMitra::where('mitra_id', $order->mitra_id)->get();
                // $now = Carbon::now();

                // if (count($checkWA) > 0) {
                //     $transaction_time = Carbon::parse($checkWA[0]->active_until);


                //     if ( $now > $checkWA[0]->active_until) {
                //         WaMitra::where('id', $checkWA[0]->id)->update([
                //             'active_until' => Carbon::now()->addMonth($add_month)->format('Y/m/d'),
                //         ]);
                //     } else {
                //         WaMitra::where('id', $checkWA[0]->id)->update([
                //             'active_until' => $transaction_time->addMonth($add_month)->format('Y/m/d'),
                //         ]);
                //     }
            
                // } else {

                //     $new_id = 'kgm_' . Str::random(10);
                //     $user = Mitra::where('id', $order->mitra_id)->first();           
                //     $wa_mitra = new WaMitra;
                //     $wa_mitra->mitra_id = $user->id;
                //     $wa_mitra->user_id = $user->id;
                //     $wa_mitra->cs_name = $user->name;
                //     $wa_mitra->id_device = ($this->checkstatusWA($new_id) == 'false' ? $new_id : 'kgm1_' . Str::random(10));
                //     $wa_mitra->wabot_token = '';
                //     $wa_mitra->status = 0;
                //     $wa_mitra->active_until = date('Y-m-d', strtotime($active_until, strtotime($order->created_at)));
                //     $wa_mitra->save();

                // }
      
                

                
            }

            if ($callback->isExpire()) {
                Donation::where('id', $order->id)->update([
                    'status' => 'expired',
                ]);
            }

            if ($callback->isCancelled()) {
                Donation::where('id', $order->id)->update([
                    'status' => 'cancel',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Notifikasi berhasil diproses',
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Signature key tidak terverifikasi',
            ], 403);
        }
    }

    public function myDonation($id)
    {
        $donations = Donation::where('user_id', $id)->get();

        foreach ($donations as $donation) {
            $donation['campaign_name'] = $donation->campaign()->first()->name;
            $donation['campaign_slug'] = $donation->campaign()->first()->slug;
            $donation['campaign_image'] = $donation->campaign()->first()->image;
        }

        return response()->json([
            // 'status' => 'success',
            // 'message' => 'Pembelian berhasil dilakukan.',
            // 'data' => Donation::find($id)
            'statusCode' => 200,
            'body' => $donations
        ]);
    }
}
