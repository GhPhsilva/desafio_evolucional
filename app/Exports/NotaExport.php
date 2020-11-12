<?php

namespace App\Exports;

use App\Models\Aluno;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NotaExport implements FromView
{

    public function view(): View
    {
        $alunos = DB::select("SELECT nome, 	
                        ( 
                            SELECT nota 
                            FROM notas
                            INNER JOIN disciplinas on disciplina_id = disciplinas.id
                            where aluno_id = alunos.id and disciplinas.disciplina = 'Matemática'
                        ) as matematica,
                        ( 
                            SELECT nota 
                            FROM notas
                            INNER JOIN disciplinas on disciplina_id = disciplinas.id
                            where aluno_id = alunos.id and disciplinas.disciplina = 'Português'
                        ) as portugues,
                        ( 
                            SELECT nota 
                            FROM notas
                            INNER JOIN disciplinas on disciplina_id = disciplinas.id
                            where aluno_id = alunos.id and disciplinas.disciplina = 'História'
                        ) as historia,
                        ( 
                            SELECT nota 
                            FROM notas
                            INNER JOIN disciplinas on disciplina_id = disciplinas.id
                            where aluno_id = alunos.id and disciplinas.disciplina = 'História'
                        ) as geografia,
                        ( 
                            SELECT nota 
                            FROM notas
                            INNER JOIN disciplinas on disciplina_id = disciplinas.id
                            where aluno_id = alunos.id and disciplinas.disciplina = 'Inglês'
                        ) as ingles,
                        ( 
                            SELECT nota 
                            FROM notas
                            INNER JOIN disciplinas on disciplina_id = disciplinas.id
                            where aluno_id = alunos.id and disciplinas.disciplina = 'Biologia'
                        ) as biologia,
                        ( 
                            SELECT nota 
                            FROM notas
                            INNER JOIN disciplinas on disciplina_id = disciplinas.id
                            where aluno_id = alunos.id and disciplinas.disciplina = 'Filosofia'
                        ) as filosofia,
                        ( 
                            SELECT nota 
                            FROM notas
                            INNER JOIN disciplinas on disciplina_id = disciplinas.id
                            where aluno_id = alunos.id and disciplinas.disciplina = 'Física'
                        ) as fisica,
                        ( 
                            SELECT nota 
                            FROM notas
                            INNER JOIN disciplinas on disciplina_id = disciplinas.id
                            where aluno_id = alunos.id and disciplinas.disciplina = 'Química'
                        ) as quimica,
                        ( SELECT FORMAT(SUM(nota)/9,2) from notas where aluno_id = alunos.id ) as media
                        FROM
                        alunos

                        ");
        return view('relatorio', [
            'alunos' => $alunos
        ]);
    }
}
