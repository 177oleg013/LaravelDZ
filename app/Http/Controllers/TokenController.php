<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function store(Request $request)
    {
        $request->user()->tokens()->delete();

        $token = $request->user()->createToken('api-client')->plainTextToken;

        return redirect()->route('tasks.show', 3)->with('token', $token);
    }
}
