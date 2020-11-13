<?php

namespace App\Http\Controllers;

use App\Exports\NotaExport;
use App\Models\Nota;
use App\Models\Aluno;
use App\Models\Disciplina;
use Facades\App\Services\DBService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Sequence;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function db(Request $request)
    {
        DBService::popularDB(1000);
        flash()->success('Processo finalizado!');
        return redirect()->route('home');
    }

    public function relatorio(Request $request)
    {
        if (!Storage::disk('public')->exists('relatorio.xlsx')) {
            Excel::store(new NotaExport, 'relatorio.xlsx', 'public');
        }
        $path = route('download');
        $funcao = "download(this,'" . $path . "')";
        $button = '<button class="btn btn-secondary" onclick="' . $funcao . '">Baixar relatório</button>';
        flash()->overlay($button, 'Baixar relatório');
        return redirect()->route('home');
    }

    public function download()
    {
        return Storage::download('relatorio.xlsx');
    }
}
