<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;


class BotController extends Controller
{
    public function startBot():JsonResponse
    {
        // Caminho correto para o script main.py do bot
        $script = base_path('app\bot\main.py');

        // Executa o script Python
        $output = shell_exec("python $script");

        return response()->json([
            'message' => 'Bot started successfully',
            'output' => $output
        ]);
    }
    
}
