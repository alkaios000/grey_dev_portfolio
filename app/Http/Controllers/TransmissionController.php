<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransmissionController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ContactMessage::query()->create($validated);

        return response()->json([
            'status' => 'ok',
            'message' => 'SIGNAL RECEIVED // Pesan Anda telah tersimpan ke Command Inbox.',
        ], 201);
    }
}
