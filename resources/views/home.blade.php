@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Desáfio evolucional</h3>
                    </div>
                    <div class="card-body">
                        @include('flash::message')
                        <div class="d-flex justify-content-center">
                            <div class="card">
                                {{-- <div class="card-header">
                                    <h3 class="card-title">Popular banco de dados</h3>
                                </div> --}}
                                <div class="card-body">
                                    <form action="{{ route('db') }}" method="POST" onsubmit="db(event)">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-lg mr-2">Popular banco de
                                            dados</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card card-primary ml-2">
                                {{-- <div class="card-header">
                                    <h3 class="card-title">Relatório</h3>
                                </div> --}}
                                <div class="card-body">
                                    <form action="{{ route('relatorio') }}" method="POST" onsubmit="relatorio(event)">
                                        @csrf
                                        <button type="submit" class="btn btn-lg btn-info">Gerar relatório</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/download.js') }}"></script>
    <script>
        $('#flash-overlay-modal').modal();

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
