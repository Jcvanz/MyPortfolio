<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CoreStack;
use App\Models\Project;

class AdminController extends Controller
{
    public function index() {
        $user = Auth::user();
        $portfolio = Portfolio::firstOrCreate([
            'id' => 1
        ]);

        $coreStacks = CoreStack::all();
        $projects = Project::latest()->get();
        return view('admin_portifolio', compact('user', 'portfolio', 'coreStacks', 'projects'));
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

    public function storeCoreStack(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string', 
            'invert' => 'nullable|boolean'
        ]);

        CoreStack::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'invert' => $request->has('invert') ? true : false,
        ]);

        return redirect()->route('admin')->with('success', 'Core Stack adicionada com sucesso!');
    }

    public function destroyCoreStack($id)
    {
        CoreStack::findOrFail($id)->delete();
        return redirect()->route('admin')->with('success', 'Core Stack removida com sucesso!');
    }

    public function storeProject(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string',
            'link' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'description', 'link']);
        
        // Handle tags: transform string "Laravel, React" into array ["Laravel", "React"]
        if ($request->tags) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        } else {
            $data['tags'] = [];
        }

        // Handle Image as Base64
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $base64 = base64_encode(file_get_contents($file->getRealPath()));
            $data['image'] = 'data:' . $file->getMimeType() . ';base64,' . $base64;
        }

        Project::create($data);

        return redirect()->route('admin')->with('success', 'Projeto adicionado com sucesso!');
    }

    public function destroyProject($id)
    {
        Project::findOrFail($id)->delete();
        return redirect()->route('admin')->with('success', 'Projeto removido com sucesso!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('admin')->with('success', 'Senha alterada com sucesso!');
    }
}
