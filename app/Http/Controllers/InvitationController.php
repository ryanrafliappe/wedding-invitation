<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function show(Request $request)
    {
        $to = $request->query('to');

        $json = Storage::disk('local')->get('data/data.json');
        $data = json_decode($json, true);

        $loveStoryJson = Storage::disk('local')->get('data/love-story.json');
        $loveStory = json_decode($loveStoryJson, true);

        return Inertia::render('Design01/MainDesign', [
            'to' => $to,
            'data' => $data,
            'story' => $loveStory
        ]);
    }

    public function getLoveStory(): JsonResponse
    {
        $json = Storage::disk('local')->get('data/love-story.json');
        $data = json_decode($json, true);

        return response()->json($data);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'sender' => 'required|string|max:50',
            'message' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $newMessage = [
            'id' => (string) Str::uuid(),
            'sender' => $request->input('sender'),
            'message' => $request->input('message'),
            'timestamp' => now()->toDateTimeString(),
        ];

        $filePath = 'data/messages.json';

        try {
            if (Storage::disk('local')->exists($filePath)) {
                $content = Storage::disk('local')->get($filePath);
                $messages = json_decode($content, true);
                if ($messages === null || !is_array($messages)) {
                    $messages = [];
                }
            } else {
                $messages = [];
            }

            $messages[] = $newMessage;

            Storage::disk('local')->put($filePath, json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

            return response()->json(['message' => 'Pesan berhasil dikirim!'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Pesan gagal dikirim!', 'error' => $e->getMessage()], 500);
        }
    }

    public function getMessages(): JsonResponse
    {
        $path = Storage::disk('local')->path('data/messages.json');

        if (!file_exists($path)) {
            return response()->json([]);
        }

        $data = json_decode(file_get_contents($path), true);
        return response()->json($data ?: []);
    }
}
