<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class DoctorController extends Controller
{
    public function index(): JsonResponse
    {
        $doctors = User::where('role_id', 3)
            ->select('id', 'name')
            ->get();

        return response()->json([
            'data' => $doctors
        ], 200);
    }
}
