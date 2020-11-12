<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = ['aluno_id', 'disciplina_id', 'nota'];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }
}
