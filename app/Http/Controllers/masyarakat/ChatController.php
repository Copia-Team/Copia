<?php

namespace App\Http\Controllers\masyarakat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function handleChat(Request $request)
    {
        $message = $request->input('message');

        $KEY = env('CHAT_GPT_KEY', "");
        $OpenAI = \OpenAI::client($KEY);

        $response = $OpenAI->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'Hallo Saya Copia Bot, Tanyakan apa saja :D'],
                ['role' => 'user', 'content' => $message],
            ],
        ]);

        $botReply = $response['choices'][0]['message']['content'];

        return response()->json(['reply' => $botReply]);
    }

}
