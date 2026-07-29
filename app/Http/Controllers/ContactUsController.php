<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        $message = $request->string('message');

        if ($message == null || $message == '') {
            return response()->json(['status' => 'not send'], 400);
        }

        ContactUs::query()->create([
            'user_id' => auth()->user()->id,
            'message' => $message,
        ]);

        return response()->json(['status' => 'send'], 201);
    }
}
