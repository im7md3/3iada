<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return back()->with('success', 'تم حذف الاشعار بنجاح.');
    }

    public function destroyAll()
    {
        Notification::whereNull('user_id')->orWhere('user_id', auth()->user()->id)->delete();

        return back()->with('success', 'تم حذف جميع الاشعارات بنجاح.');
    }
}
