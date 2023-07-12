<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationApiController extends Controller
{
    public function notification($id)
    {
        $notifications = Notification::where('user_id', $id)->get();

        return response()->json([
            // 'status' => 'success',
            // 'message' => 'Pembelian berhasil dilakukan.',
            // 'data' => Donation::find($id)
            'statusCode' => 200,
            'body' => $notifications
        ]);
    }
    public function destroy($id)
    {
        $notifications = Notification::where('id', $id)->delete();

        return response()->json([
            // 'status' => 'success',
            // 'message' => 'Pembelian berhasil dilakukan.',
            // 'data' => Donation::find($id)
            'statusCode' => 200,
            'message' => 'Hapus pesan inbox berhasil dilakukan.'
        ]);
    }
}
