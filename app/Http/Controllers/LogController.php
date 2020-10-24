<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index()
    {
        $chats = ActivityLog::orderBy('created_at', 'desc')->with('causer')->get();

        return response()->json($chats, 200);
    }
}
