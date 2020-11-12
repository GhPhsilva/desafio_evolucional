@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Desáfio evolucional</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('db') }}" method="POST" onsubmit="db(event)">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg mr-2">Popular banco de dados</button>
                            </form>
                            <form action="{{ route('relatorio') }}" method="POST" onsubmit="relatorio(event)">
                                @csrf
                                <button type="submit" class="btn btn-lg btn-info">Relatório</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function loadText() {
            return '<i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Processando...';
        }

        function db(e) {
            e.preventDefault();
            let oldHTML = e.target[1].innerHTML;
            e.target[1].innerHTML = loadText();
            e.target[1].disabled = true;
            e.target.submit();
        }

        function relatorio(e) {
            e.preventDefault();
            let oldHTML = e.target[1].innerHTML;
            e.target[1].innerHTML = loadText();
            e.target[1].disabled = true;
            e.target.submit();
        }

    </script>
@endsection
