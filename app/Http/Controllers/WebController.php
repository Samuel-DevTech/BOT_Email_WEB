<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(){
        return view("web.index");
    }
    public function load(){
        return view('web.index1');
    }
    public function uploadFile(Request $request):JsonResponse{
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
    public function endLine(){
        return view('web.index2');
    }
    public function download(){
        return response()->download(file: storage_path().'/app/private/bot/result/Planilha1_atualizada.xlsx');
    }
    public function deleteFile(){
    $files = [
        storage_path('app/private/bot/resource/Planilha1.xlsx'),
        storage_path('app/private/bot/resource/Planilha1.csv'),
        storage_path('app/private/bot/resource/Planilha1.xls'),
        storage_path('app/private/bot/result/Planilha1_atualizada.xlsx'),
        storage_path('app/private/bot/result/Planilha1_atualizada.csv'),
        storage_path('app/private/bot/result/Planilha1_atualizada.xls')
    ];
    foreach ($files as $filePath) {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    return response()->noContent();
    }
    public function modal(){
        return view('componentes.modal');
    }
}