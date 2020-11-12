<?php

namespace App\Http\Controllers;

use App\Exports\NotaExport;
use App\Models\Nota;
use App\Models\Aluno;
use App\Models\Disciplina;
use Faker\Factory as Faker;
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

    private function clearDb()
    {
        Aluno::query()->delete();
        Disciplina::query()->delete();

        if (Storage::disk('public')->exists('relatorio.xls')) {
            Storage::delete('relatorio.xls');
        }

        return true;
    }
    private function popularDB($total)
    {
        DB::disableQueryLog();
        $faker = Faker::create();
        $alunos = [];
        for ($i = 0; $i < $total; $i++) {
            $alunos[] = ['nome' => $faker->unique()->name];
        }
        Aluno::insert($alunos);

        $disciplinas = [
            ['disciplina' => 'Matemática'],
            ['disciplina' => 'Português'],
            ['disciplina' => 'História'],
            ['disciplina' => 'Geografica'],
            ['disciplina' => 'Inglês'],
            ['disciplina' => 'Biologia'],
            ['disciplina' => 'Filosofia'],
            ['disciplina' => 'Física'],
            ['disciplina' => 'Química'],
        ];
        Disciplina::insert($disciplinas);
        $disciplinas = Disciplina::all();
        $notas = [];
        foreach (Aluno::all() as $aluno) {
            foreach ($disciplinas as $disciplina) {
                $notas[] = ['aluno_id' => $aluno->id, 'disciplina_id' => $disciplina->id, 'nota' => $faker->randomFloat(2, 0, 10)];
            }
        }
        Nota::insert($notas);
    }

    public function db(Request $request)
    {
        $this->clearDb();
        $this->popularDB(1000);
        return redirect()->route('home')->with('status', 'Processo finalizado');
    }

    public function relatorio(Request $request)
    {
        return Excel::download(new NotaExport, 'relatorio.xls');
    }
}
