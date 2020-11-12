<?php

namespace App\Models;

use App\Models\Nota;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function gerarNotas($disciplinas)
    {
        foreach ($disciplinas as $disciplina) {
            Nota::factory()->create(['aluno_id' => $this->id, 'disciplina_id' => $disciplina->id]);
        }
    }
}
