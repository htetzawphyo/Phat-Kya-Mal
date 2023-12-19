<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\BookRequestNoti;
use Exception;
use Illuminate\Http\Request;

class DiscordNotification extends Controller
{
    public function notification(Request $request)
    {
        // dispatch(new BookRequestNoti())->onQueue('discordNoti');
        try{
            BookRequestNoti::dispatch($request->all());

            return response()->json(['status' => 200]);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
