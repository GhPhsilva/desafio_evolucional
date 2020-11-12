<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Matemática</th>
            <th>Português</th>
            <th>História</th>
            <th>Geografia</th>
            <th>Inglês</th>
            <th>Biologia</th>
            <th>Filosofia</th>
            <th>Física</th>
            <th>Química</th>
            <th>Média</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($alunos as $aluno)
            <tr>
                <td>{{ $aluno->nome }}</td>
                <td>{{ $aluno->matematica }}</td>
                <td>{{ $aluno->portugues }}</td>
                <td>{{ $aluno->historia }}</td>
                <td>{{ $aluno->geografia }}</td>
                <td>{{ $aluno->ingles }}</td>
                <td>{{ $aluno->biologia }}</td>
                <td>{{ $aluno->filosofia }}</td>
                <td>{{ $aluno->fisica }}</td>
                <td>{{ $aluno->quimica }}</td>
                <td>{{ $aluno->media }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
