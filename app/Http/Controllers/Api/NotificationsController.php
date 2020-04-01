<?php

/*
 * @author weifan
 * Tuesday 31st of March 2020 09:28:21 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->paginate();

        return NotificationResource::collection($notifications);
    }

    public function stas(Request $request)
    {
        return response()->json([
            'unread_count' => $request->user()->notification_count
        ]);
    }
}
