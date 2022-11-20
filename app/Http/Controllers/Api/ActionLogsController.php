<?php

namespace App\Http\Controllers\Api;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionLogsController extends Controller
{
    //set action log
    public function setActionLogs(Request $request){
        $data = [
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ];

        ActionLog::create($data); //insert

        $data = ActionLog::where('post_id', $request->post_id)->get();


        return response()->json([
            'post' => $data
        ], 200);
    }
}
