<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        $user = Auth::user();
        $portfolio = Portfolio::firstOrCreate([
            'id' => 1
        ]);

        return view('admin_portifolio', compact('user', 'portfolio'));
    }

    public function update(Request $request) 
    {
        // Pega o portifolio atual (ou cria se não existir)
        $portfolio = Portfolio::firstOrCreate([
            'id' => 1
        ]);

        // Pega todos os dados do request, menos os tokens do laravel e arquivos
        $data = $request->except(['_token', 'curriculo', 'banner_home']);

        // Upload do Currículo
        if ($request->hasFile('curriculo')) {
            $file = $request->file('curriculo');
            // Pega o conteúdo binário e converte para base64
            $base64 = base64_encode(file_get_contents($file->getRealPath()));
            // Monta o formato Data URI
            $data['curriculo'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
            // Salvar o nome do arquivo original para exibição
            $data['curriculo_name'] = $file->getClientOriginalName();
        }

        // Upload do Banner
        if ($request->hasFile('banner_home')) {
            $file = $request->file('banner_home');
            $base64 = base64_encode(file_get_contents($file->getRealPath()));
            $data['banner_home'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        // Atualiza o banco com os novos textos e base64 dos arquivos
        $portfolio->update($data);

        // Se for requisição via JavaScript (Fetch/AJAX), retorna JSON
        if ($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'message' => 'Salvo com sucesso!',
                'portfolio' => $portfolio
            ]);
        }

        return redirect()->route('admin')->with('success', 'Portfólio atualizado com sucesso!');
    }
}
