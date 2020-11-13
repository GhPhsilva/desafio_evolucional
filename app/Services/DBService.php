<?php

namespace App\Services;

use App\Models\Nota;
use App\Models\Aluno;
use App\Models\Disciplina;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DBService
{
    private function clearDb()
    {
        Aluno::query()->delete();
        Disciplina::query()->delete();

        if (Storage::disk('public')->exists('relatorio.xlsx')) {
            Storage::disk('public')->delete('relatorio.xlsx');
        }

        return true;
    }

    public function popularDB($total)
    {
        DB::disableQueryLog();
        $this->clearDb();
        $faker = Faker::create('pt_BR');
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
}
