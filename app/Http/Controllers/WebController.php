<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(){
        return view("web.index");
    }
    public function load(){
        return view('web.index1');
    }
    public function uploadFile(Request $request)
    {
        // Verifica se o arquivo foi enviado
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Armazenar o arquivo no diretório desejado dentro de storage
            $path = $file->storeAs('bot/resource', $file->getClientOriginalName());
            
            return response()->json([
                'message' => 'Arquivo enviado com sucesso!',
                'path' => $path
            ]);
        }

        return response()->json(['message' => 'Nenhum arquivo enviado'], 400);
    }
}  