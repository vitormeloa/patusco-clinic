<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => User::where('role_id', 1)->select('id', 'name')->get()
        ], 200);
    }

}
